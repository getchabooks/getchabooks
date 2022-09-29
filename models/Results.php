<?php

class Results {
    /**
     * Iterable of SectionHasItem objects with appropriate joins for fast
     * hydration of related objects
     */
    public $shis = array();

    /**
     * Iterable of Books in ISBN mode.
     */
    public $books = array();

    /**
     * Array of Combo objects keyed by Vendor class name for all items 
     * (excluding package components and Go To Class First items) ordered by 
     * most items and then lowest price.
     */
    public $combos = array();

    /**
     * Best Deal Period object.
     */
    public $bdp;

    /**
     * The number of valid sections.
     */
    public $numSections = null;

    /**
     * The total number of Items in the result (excluding package components).
     */
    public $numItems;

    /**
     * The total cost of all Items from the bookstore (excluding package
     * components).
     */
    public $bookstoreCost = null;

    /**
     * The number of Items for which the bookstore actually has a price (some
     * Bookstores may occasionally not have a listed price for an item) --
     * excluding package components.
     */
    public $numBookstoreBooks;

    /**
     * Whether the Bookstore has all of the required books (excluding package
     * components).
     */
    public $bookstoreHasAllBooks = null;

    /**
     * Ids/ISBNs of all items that are packages.
     */
    protected $packageIds = array();

    /**
     * Ids/ISBNs of all items to exclude from Combos and BDP, i.e., package 
     * components and "go to class first" items.
     */
    protected $excludeIds = array();

    protected $schoolSlug, $sectionSlugs;
    protected $isbns;
    protected $pricesByIsbn = array();
    protected $pricesByVendor = array();
    public $bookstore = null;

    /**
     * @param array $isbns        array of potentially invalid 10 or 13-digit ISBNs
     * @param array $slugs        array of potentially invalid Section slugs
     */
    public function __construct($isbns, $sectionSlugs=array(), $schoolSlug='', $termSlug='', $campusSlug='') {
        global $tag, $school, $vendors, $state, $defaultTag;

        $this->isbns = array_map('Isbn::to13', $isbns);
        $this->sectionSlugs = $sectionSlugs;
        $this->schoolSlug = $schoolSlug;
        $this->campusSlug = $campusSlug;
        $this->termSlug = $termSlug;

        $school = SchoolQuery::create()->findOneBySlug($this->schoolSlug); // 1 query

        // process school
        if ($school) {
            $tag = $school->getAmazonTag();        // uses session tag if set
            $this->bookstore = $school->getBookstoreType();
            $vendors[array_search('Bookstore', $vendors)] = $this->bookstore;
            $state = $school->getState();
        } else if ($schoolSlug) {
            throw new GetchabooksError("Unknown school slug: $schoolSlug");
        } else {
            $this->sectionSlugs = null;
            $tag = isset($_SESSION['tag']) ? $_SESSION['tag'] : $defaultTag;
            unset($vendors[array_search('Bookstore', $vendors)]);
            $state = null;
        }

        if ($this->schoolSlug) {
            $this->spiderSections();
        }

        $this->fetchData();
        $this->makePackages();
    }

    protected function spiderSections() {
        // used by Bookstores to construct Combo urls
        global $sections;

        $sections = SectionQuery::create()                          // 1 query
            ->filterBySchoolSlug($this->schoolSlug)
            ->filterByTermSlug($this->termSlug)
            ->filterBySlug($this->sectionSlugs);

        if ($this->campusSlug) {
            $sections->filterByCampusSlug($this->campusSlug);
        }
        $sections = $sections->find();

        if ($this->numSections = count($sections)) {
            $bookstoreClass = $this->bookstore;
            $bookstore = new $bookstoreClass;
            $bookstore->spiderSections($sections, false);
        }
    }

    /**
     * Fetch prices. Amazon also creates any Books that don't exist.
     *
     * We've tried one script that forks for all vendors itself, but it
     * doesn't work.  The problem was something like
     * http://www.php.net/manual/en/function.pcntl-fork.php#99350
     */
    public static function fetchPrices(array $isbns) {
        $exclude = array('AmazonMarketplace');
        $marker = rand();

        $isbnString = implode(',', $isbns);
        foreach (array_diff($GLOBALS['vendors'], $exclude) as $vendor) {
            if (!(new $vendor instanceof Bookstore)) {
                $cmd = "php " . BASE_DIR . "/scripts/fetch_prices.php $vendor $isbnString $marker";
                exec("nohup $cmd > /dev/null 2>&1 & echo $!");
            }
        }

        // wait until all processes are done
        while (strpos(shell_exec("ps ax | grep $marker"), 'fetch') !== false) {
            usleep(100000);
        }
    }

    protected function fetchData() {
        $this->allIsbns = $this->isbns;
        $this->items = array();

        if ($this->sectionSlugs) {
            $this->shis = SectionHasItemQuery::create()                           // 1 query
                ->rightJoinWith('SectionHasItem.Section')
                ->leftJoinWith('SectionHasItem.Item')
                ->leftJoinWith('Item.Book')
                ->where('Section.SchoolSlug = ?', $this->schoolSlug);

            if ($this->campusSlug) {
                $this->shis->where('Section.CampusSlug = ?', $this->campusSlug);
            }

            $this->shis = $this->shis                                             
                ->where('Section.TermSlug = ?', $this->termSlug)
                ->where('Section.Slug IN ?', $this->sectionSlugs)
                ->where('SectionHasItem.RequiredStatus > 0')
                ->orWhere('SectionHasItem.RequiredStatus IS NULL')
                ->withColumn('Section.NbItems != 0', 'HasItems')
                ->orderBy('HasItems', 'desc')
                ->orderBy('Section.Slug', 'asc')
                ->orderBy('SectionHasItem.RequiredStatus', 'desc')
                ->orderBy('Item.Title', 'asc')
                ->find();

            foreach ($this->shis as $shi) {
                if ($item = $shi->getItem()) {
                    $isbn = $item->getIsbn() ?: $item->getId();
                    $this->items[$isbn] = $item;
                    $this->allIsbns[] = $isbn;

                    if ($item->getIsPackage()) {
                        $packageIds[] = $isbn;
                        $components = Item::getComponents(array($item->getId()));    // 1 query per package
                        foreach ($components as $c) {
                            $isbn = $c->getIsbn() ?: $c->getId();
                            $this->items[$isbn] = $c;
                            $this->allIsbns[] = $isbn;
                            $this->excludeIds[] = $isbn;
                        }
                    }

                    if ($shi->getRequiredStatus() <= SectionHasItem::GO_TO_CLASS_FIRST) {
                        $this->excludeIds[] = $isbn;
                    }
                }
            }
        }

        self::fetchPrices($this->allIsbns);

        // populate loose books
        if ($this->isbns) {
            $this->books = BookQuery::create()                          // 1 query
                ->filterByIsbn($this->isbns)
                ->find();
        }

    }

    /**
     * Creates the combos and best deal period from raw price data.
     */
    protected function makePackages() {
        foreach ($GLOBALS['vendors'] as $vendor) {
            $this->pricesByVendor[$vendor] = $vendor::getPrices($this->allIsbns, $this->items);
        }

        foreach ($this->pricesByVendor as $vendor => $prices) {
            foreach ($prices as $isbn => $price) {
                $this->pricesByIsbn[$isbn][$vendor] = $price;
            }
        }
        /* pricesByIsbn and pricesByVendor now each contain a Price or null for
         * every book, and are in the order of $vendors. */

        // This is utilized by the magic Item->prices attribute.
        $GLOBALS['pricesByIsbn'] = $this->pricesByIsbn;

        $this->numItems = count(array_diff(array_keys($this->pricesByIsbn), $this->excludeIds));

        // create combos
        foreach ($this->pricesByVendor as $vendor => $prices) {
            $includePrices = array();
            foreach ($prices as $id => $price) {
                if (!in_array($id, $this->excludeIds)) {
                    $includePrices[$id] = $price;
                }
            }
            $this->combos[$vendor] = new Combo($includePrices, $vendor);
        }

        // create BDP
        $includePrices = array();
        foreach ($this->pricesByIsbn as $id => $prices) {
            if (!in_array($id, $this->excludeIds)) {
                $includePrices[$id] = $prices;
            }
        }
        $this->bdp = new BestDealPeriod($includePrices);

        // update bookstore stats
        if ($this->bookstore) {
            $this->bookstoreCost = $this->combos[$this->bookstore]->total;
            $this->numBookstoreBooks = 0;
            foreach ($this->pricesByVendor[$this->bookstore] as $id => $price) {
                if ($price && $price->total > 0 && !in_array($id, $this->excludeIds)) {
                    $this->numBookstoreBooks++;
                }
            }

            $this->bookstoreHasAllBooks = ($this->numItems == $this->numBookstoreBooks);
        } else {
            $this->bookstoreCost = null;
        }

        // update combo and bdp isComplete, amountSaved, etc.
        foreach ($this->combos as $combo) {
            $combo->setComparisonInfo($this->numItems, $this->bookstoreCost);
        }

        $this->bdp->setComparisonInfo($this->numItems, $this->bookstoreCost);

        // sort combos by number of books, then total price
        uasort($this->combos, function ($c1, $c2) {
            if ($c1->isComplete != $c2->isComplete) {
                return $c1->isComplete > $c2->isComplete ? -1 : 1;
            }

            if ($c1->total == $c2->total) {
                return 0;
            } else {
                return $c1->total < $c2->total ? -1 : 1;
            }
        });

    }

}
