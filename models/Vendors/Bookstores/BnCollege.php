<?php

class BnCollegeError extends BookstoreError {}

class BnCollege extends BaseBookstore implements Vendor, Bookstore {

    protected static $proxy = array(PROXY1_URL, PROXY1_AUTH);

    public static function getUrl(array $prices) {
        global $school, $numItems, $sections;
        if (count($prices) == 1 && current($prices) !== null) {
            return self::getItemUrl($school, current($prices)->item);
        } else {
            // the only case where $prices doesn't contain prices for all of the
            // items is handled in BDP->toString()
            return self::getSectionsUrl($sections, $school);
        }
    }

    public static function getSectionsUrl($sections, $school) {
        $subdomain = $school['Subdomain'];
        $storeId = $school['BId'];
        $url = "http://$subdomain.bncollege.com/webapp/wcs/stores/servlet/"
            . "TBListView?catalogId=10001&clearAll=&langId=-1&mcEnabled=N"
            . "&numberOfCourseAlready=0&removeSectionId=&savedListAdded=true"
            . "&sectionList=newSectionNumber&storeId=$storeId&viewName=TBWizardView";
        $i = 1;
        foreach ($sections as $s) {
            $url .= '&section_'.($i++).'='.$s['BId'];
        }
        return $url;
    }

    public static function getItemUrl($school, $item) {
        $subdomain = $school['Subdomain'];
        $storeId = $school['BId'];
        $productId = $item['ProductId'];
        $partNumber = $item['PartNumber'];
        return "http://$subdomain.bncollege.com/webapp/wcs/stores/servlet/"
            . "BNCB_TextbookDetailView?catalogId=10001&storeId=$storeId"
            . "&langId=-1&productId=$productId&partNumber=$partNumber&"
            . "item=Y&displayStoreId=$storeId";
    }

    public static function getItemSubtotal($item) {
        // in-store availability of used copies is not guaranteed
        return $item['BNew'];
    }

    public static function showAsterisk() {
        return true;
    }

    public static function getTax($subtotal, $state=null) {
        return 0;
    }

    protected static function doBnRequest($obj, $view, array $data) {
        if (isset($obj['Subdomain'])) {
            $storeId = $obj['BId'];
            $subdomain = $obj['Subdomain'];
        } else {
            $storeId = $obj['SchoolBId'];
            $subdomain = $obj['SchoolSubdomain'];
        }

        $base = "http://$subdomain.bncollege.com/webapp/wcs/stores/servlet/";
        $referer = $base . "TBWizardView?catalogId=10001&storeId=$storeId&langId=-1";

        if (php_sapi_name() == 'cli') {
            sleep(1);
        }

        // the first condition will happen (only) with command-line operation
        static $uses = 0;
        if (++$uses % 10 == 0 || !isset($_SESSION['BnCollegeSession'])) {
            unset($_SESSION['UserAgent']);
            file_put_contents("/tmp/" . session_id(), "");
            self::get($referer);
            $_SESSION['BnCollegeSession'] = true;
        }

        if ($view == 'TBListView') {
            $params = array(
                'storeId'           => $storeId,
                'langId'            => '-1',
                'catalogId'         => '10001',
                'savedListAdded'    => 'true',
                'clearAll'          => '',
                'viewName'          => 'TBWizardView',
                'removeSectionId'   => '',
                'mcEnabled'         => 'N',
                'numberOfCourseAlready' => '0',
                'viewTextbooks.x'   => rand(0, 115),
                'viewTextbooks.y'   => rand(0, 20),
                'sectionList'       => 'newSectionNumber'
            );
        } else {
            $params = array(
                'campusId'          => '',
                'termId'            => '',
                'deptId'            => '',
                'courseId'          => '',
                'sectionId'         => '',
                'catalogId'         => '10001',
                'storeId'           => $storeId,
                'langId'            => '-1',
                'dojo.transport'    => 'xmlhttp',
                'dojo.preventCache' => intval(microtime(true)*1000),
            );
        }

        $params = array_merge($params, $data);

        return self::get($base . $view, $params, array(CURLOPT_REFERER => $referer));
    }

    public static function getCampuses($data) {
        $r = self::doBnRequest($data, 'TBWizardView', array());

        if (strstr($r, 'Select Campus') !== false) {
            $regex = "/value\=(?:'|\")(?P<BId>\d{8})(?:'|\")\s*>(?P<Name>.+?)</";
        } else {
            $regex = "/campusId(?:'|\")\s*value\=(?:'|\")(?P<BId>\d{8})(?P<Name>)/";
        }

        if (preg_match_all($regex, $r, $matches, PREG_SET_ORDER)) {
            return $matches;
        } else if (strpos($r, "select name") !== false) {
            return false;
        } else {
            throw new BnCollegeError("Error finding campuses (School {$data['BId']}).\n\nResponse text:\n$r");

        }
    }

    public static function getTerms($data) {
        $r = self::doBnRequest($data, 'TextBookProcessDropdownsCmd', array(
            'campusId' => $data['BId']
        ));

        $regex = "/(?P<BId>\d+)'\s*>(?P<Name>[^>]+)</";
        if (preg_match_all($regex, $r, $matches, PREG_SET_ORDER)) {
            return $matches;
        } else if (strpos($r, "select name") !== false) {
            return false;
        } else {
            throw new BnCollegeError("Error finding terms (Campus {$data['BId']}).\n\nResponse text:\n$r");
        }
    }

    public static function getDepts($data) {
        $r = self::doBnRequest($data, 'TextBookProcessDropdownsCmd', array(
            'campusId' => $data['CampusBId'],
            'termId' => $data['BId']
        ));

        $regex = "/(?P<BId>\d+)'\s*>\s*(?P<Abbr>.+?)\s*</";
        if (preg_match_all($regex, $r, $matches, PREG_SET_ORDER)) {
            return $matches;
        } else if (strpos($r, "select name") !== false) {
            return false;
        } else {
            throw new BnCollegeError("Error finding departments (Term {$data['BId']}).\n\nResponse text:\n$r");

        }
    }

    public static function getCourses($data) {
        $r = self::doBnRequest($data, 'TextBookProcessDropdownsCmd', array(
            'campusId' => $data['CampusBId'],
            'termId' => $data['TermBId'],
            'deptId' => $data['BId']
        ));

        $regex = "/(?P<BId>\d+)'\s*>\s*(?P<Num>.+?)\s*</";
        if (preg_match_all($regex, $r, $matches, PREG_SET_ORDER)) {
            return $matches;
        } else if (strpos($r, "select name") !== false) {
            return false;
        } else {
            throw new BnCollegeError("Error finding courses (Dept {$data['BId']}).\n\nResponse text:\n$r");;
        }
    }

    public static function getSections($data) {
        $r = self::doBnRequest($data, 'TextBookProcessDropdownsCmd', array(
            'campusId'  => $data['CampusBId'],
            'termId'    => $data['TermBId'],
            'deptId'    => $data['DeptBId'],
            'courseId'  => $data['BId']
        ));

        $regex = "/(?P<BId>\d+)(?P<RequiresBooks>[A-Z])_\d*'\s*>(?P<Num>.+?)</";
        if (preg_match_all($regex, $r, $matches, PREG_SET_ORDER)) {
            foreach ($matches as &$match) {
                $match['RequiresBooks'] = ($match['RequiresBooks'] == 'N');
            }
            return $matches;
        } else if (strpos($r, "select name") !== false) {
            return false;
        } else {
            throw new BnCollegeError("Error finding sections (Course {$data['BId']}).\n\nResponse text:\n$r");;

        }
    }

    public static function getSectionsHaveItems($sections) {
        $params = array();
        $i = 1;
        foreach ($sections as $section) {
            $params['section_' . $i++] = $section['BId'];
        }

        $result = self::doBnRequest($sections[0], 'TBListView', $params);

        if (!$result) {
            throw new BnCollegeError("Empty response for sections "
                . implode(' ', $sectionIds));
        }

        $itemDivs = explode("tbListHolding", $result);
        unset($itemDivs[0]);

        // group items by section
        $items = array();
        foreach ($itemDivs as $div) {
            if ($itemInfo = self::processItemDiv($div)) {
                if ($itemInfo[1] === false) {
                    $items[$itemInfo[0]] = array();
                } else {
                    $items[$itemInfo[0]][] = $itemInfo[1];
                }
            }
        }

        return array_map('self::processItems', $items);
    }

    /**
     * @return  an array of item metadata: productId, partNumber, isbn, title, author,
     *                                      edition, publisher, imageUrl, usedPrice, newPrice, required
     */
    protected static function getItemMetadata($itemText) {
        $details = array();
        $productId = $partNumber = $isbn = $title = $author = $edition = $publisher = "";
        $usedPrice = $newPrice = $required = $isPackage = $isComponent = "";

        if (preg_match("/productId\=(.+?)&/", $itemText, $matches)) {
            $details['productId'] = trim($matches[1]);
        }
        if (preg_match("/partNumber\=(.+?)&/", $itemText, $matches)) {
            $details['partNumber'] = rtrim($matches[1], "&amp;");
        }
        if (preg_match("/ISBN\:\<\/span\>.+?(\d+).+?\</s", $itemText, $matches)) {
            $isbn = trim($matches[1]);
            $isbn = Isbn::validate($isbn) ? $isbn : "";
            if ($isbn[0] == '2') {
                $isbn = "";
            }
            $details['isbn'] = $isbn;
        }

        if (preg_match("/\d{5}'\stitle\=\"(.+?)\"\>.+?\<img/s", $itemText, $matches)) {
            $details['title'] = titleCase(trim(htmlspecialchars_decode($matches[1], ENT_QUOTES)));
        }
        if (preg_match("/\<span\>Author:.*?\<\/span\>(.+?)\<\/li/s", $itemText, $matches)) {
            $author = ucname(trim($matches[1]));
            $details['author'] = is_numeric($author) ? "" : $author;
        }
        if (preg_match("/Edition:\<\/span\>(.+?)\<br/", $itemText, $matches)) {
            $details['edition'] = strtolower(trim($matches[1]));
        }
        if (preg_match("/Publisher:\<\/span\>(.+?)\<br/", $itemText, $matches)) {
            $details['publisher'] = titleCase(trim($matches[1]));
        }
        if (preg_match("/Used.+?(\d{1,3}\.\d{2})/s", $itemText, $matches)) {
            $details['usedPrice'] = $matches[1];
        }
        if (preg_match("/New.+?(\d{1,3}\.\d{2})/s", $itemText, $matches)) {
            $details['newPrice'] = $matches[1];
        }
        if (strpos($itemText, "The price of the textbook is not yet available")) {
            $details['newPrice'] = $details['usedPrice'] = 0;
        }
        if (!$details['title'] && !$details['author']) {
            return false;
        }
        $details['imageUrl'] = "";     // todo

        $options = array("REQUIRED\sPACKAGE", "RECOMMENDED\sPACKAGE", "REQUIRED", "RECOMMENDED",
            "PACKAGE\sCOMPONENT", "GO\sTO\sCLASS FIRST", "BOOKSTORE\sRECOMMENDED");

        preg_match("/".implode('|', $options)."/", $itemText, $matches);
        $required = trim($matches[0]);
        $details['isPackage'] = ($required == "REQUIRED PACKAGE" || $required == "RECOMMENDED PACKAGE");
        $details['isComponent'] = ($required == "PACKAGE COMPONENT");

        if ($required == "REQUIRED PACKAGE" || $required == "REQUIRED") {
            $required = SectionHasItem::REQUIRED;
        } else if ($required == "RECOMMENDED PACKAGE" || $required == "RECOMMENDED") {
            $required = SectionHasItem::RECOMMENDED;
        } else if ($required == "GO TO CLASS FIRST") {
            $required = SectionHasItem::GO_TO_CLASS_FIRST;
        } else if ($required == "BOOKSTORE RECOMMENDED") {
            $required = SectionHasItem::BOOKSTORE_RECOMMENDED;
        } else {
            $required = SectionHasItem::REQUIRED;
        }

        $details['requiredStatus'] = $required;

        return $details;
    }

    public static function processItemDiv($text) {
        if (!preg_match("/value\='(\d{8})'/", $text, $match)) {
            return false;
        }
        $sectionId = $match[1];

        if (strpos($text, "Currently no textbook") || strpos($text, "Pre-Order")) {
            return array($sectionId, false);
        }

        if (!($details = self::getItemMetadata($text))) {
            return false;
        }

        return array($sectionId, $details);
    }

    public static function getSchools() {

        $slugFixes = array(
            'wsubookie'         =>  'wsu',
            'fordham-rosehill'  =>  'fordham',
            'harvardcoopbooks'  =>  'harvard',
            'harvardcoopmed'    =>  'harvard-med',
            'mitcoopbooks'      =>  'mit',
            'sbx'               =>  'etsu',
            'universitylofts'   =>  'csuohio',
            'dartmouthbooks'    =>  'dartmouth',
            'harvard-lawcoopbooks'=>    'harvard-law'

        );

        $nameFixes = array(
            'colorado'          =>  'University of Colorado at Boulder',
            'harvard-law'       =>  'Harvard Law School',
            'harvard'           =>  'Harvard University',
            'mit'               =>  'Massachusetts Institute of Technology',
            'tamu-sa'           =>  'Texas A&M University - San Antonio',
            'csuohio'           =>  'Cleveland State University',
            'bentley'           =>  'Bentley University',
            'gatech'            =>  'Georgia Tech'
        );

        $shortNameFixes = array(
            'wpi'               =>  'WPI',
            'mit'               =>  'MIT'
        );

        /**
         * These subdomains actually don't point to a valid website, or there aren't any terms,
         * or they are a redirect to another subdomain.
         */
        $invalidSubdomains = array(
            'exeter',       // no terms
            'mainstore',
            'aiubuckhead',
            'bakersfield',
            'dsl',
            'fiu-nomiami',
            'fordham-lc',
            'gadsdenstcc-ayers',
            'gadsdenstcc-mcclellan',    'nmsu-alamogordo',
            'nmsu-carlsbad',
            'nmsu-dacc',
            'nmsu-grants',
            'newbury',
            'nsuok-brokenarrow',
            'radford',
            'msjc-north',
            'msjc-south',
            'shulaw',
            'susccwadley',
            'templeambler',
            'templecenter',
            'temple-med',
            'templelaw',
            'templetyler',
            'twu',
            'dothan',
            'montgomery',
            'phenix',
            'umlowell-downtown',
            'wsubookie-stadium',
            'wsubookie-spokane',
            'wsu-tri',
            'wsubookie-vancouver',
            'wvuevansdale',
            'yalemed',
            'jsr',
            'brevardcc-melbourne',
            'brevardcc-palmbay',
            'brevardcc-titusville',
            'nvcc',
            'kctcs',
            'tcc',
            'columbia-med',
            'cornell-med',
            'pcom',
        );

        /* these are redirects, etc. */
        $replaceSubdomains = array(
            'cuyahoga'      => 'cuyahoga-west',
            'chicagogsb'    => 'chicagobooth',
            'depaul'        => 'depaul-lincolnpark',
            'harvard'       => 'harvardcoopbooks',
            'harvard-law'   => 'harvard-lawcoopbooks',
            'columbus-iupui'=>  'iupuc',
            'mwsc'          => 'missouriwestern',
            'mit'           => 'mitcoopbooks',
            'psudelaware'   =>  'psubrandywine',
            'psumk'         =>  'psuga',
            'ppc'           =>  'pointpark',
            'santafecc'     => 'santafe',
            'osumarion1'    =>  'marionbookstore',
            'ucok'          =>  'uco',
            'cwru'          =>  'case',
            'cfcc'          =>  'cf',
            'swic-belleville'=> 'swic',
            'sosu'          =>  'se',
            'yale1'         =>  'yale',
        );

        $manualSchools = array(
            'eiccbookstore' => "Eastern Iowa Community Colleges",
            'jsr-parham'    => "J. Sargeant Reynolds Community College - Parham Road / Western Campus",
            'jsr-downtown'  => "J. Sargeant Reynolds Community College - Downtown Campus",
            'ashlandctcstore'   => 'KCTCS - Ashland Community & Technical College',
            'bigsandyctcstore'  => 'KCTCS - Big Sandy Community & Technical College',
            'bgctccooperstore'  => 'KCTCS - Bluegrass Community & Technical College, Cooper Campus',
            'bctccleestownstore'=> 'KCTCS - Bluegrass Community & Technical College, Leestown Campus',
            'bgtcstore'     => 'KCTCS - Bowling Green Technical College',
            'elizabethtownctcstore' => 'KCTCS - Elizabethtown Community & Technical College Bookstore',
            'gatewayctcstore'   => 'KCTCS - Gateway Community & Technical College',
            'gctc-gatewayboonestore'=> 'KCTCS - Gateway CTC, Boone Campus',
            'hazardctcstore'    => 'KCTCS - Hazard Community & Technical College',
            'hazardleesstore'   => 'KCTCS - Hazard Community & Technical College, Lees Campus',
            'hendersonstore'    => 'KCTCS - Henderson Community College',
            'hopkinsvilleccstore'=> 'KCTCS - Hopinksville Community College',
            'jeffersonctcstore' => 'KCTCS - Jefferson Community & Technical College',
            'jeffersonswstore'  => 'KCTCS - Jefferson Community College Southwest',
            'madisonvillectcstore'=> 'KCTCS - Madisonville Community College',
            'maysvillectcstore' => 'KCTCS - Maysville Community & Technical College',
            'rowanctcstore'     => 'KCTCS - Maysville Community & Technical College, Rowan Campus',
            'owensboroctcstore' => 'KCTCS - Owensboro Community & Technical College',
            'somersetccstore'   => 'KCTCS - Somerset Community College',
            'somersetcc-laurelstore'    => 'KCTCS - Somerset Community College, Laurel Campus',
            'seccstore'         => 'Southeast KY Community & Technical College/Cumberland and Whitesburg Campus',
            'secc-middlesborostore' => 'KCTCS - Southeast Middlesboro',
            'westkentuckyctcstore'  => 'KCTCS - West Kentucky Community & Technical College Bookstore',
            'nvcc-alexandria'   => 'NVCC ELI Distance Learning/Alexandria Campus',
            'nvcc-annandale'    => 'NVCC - Annandale Campus',
            'nvcc-loudoun'      => 'NVCC - Loudoun Campus/Reston Center',
            'nvcc-manassas'     => 'NVCC - Manassas',
            'nvcc-woodbridge'   => 'NVCC - Woodbridge',
            'nvccmedical'       => 'NVCC - Medical Education',
            'tcc-vabeach'       => 'Tidewater Community College - Virginia Beach Campus'

        );

        // ones that for some reason don't work
        $manualIds = array(
            'bloomfield'    =>  '65119',
            'coppin'        =>  '65115',
            'furman'        =>  '65121',
            'latech'        =>  '65097',
            'uco'           =>  '22563',
            'marionbookstore'=> '15057',
            'thecitadel'    =>  '65095',
            'santafe'       =>  '22566',
            'cf'            =>  '29557'
        );

        $content = self::get("http://www.bncollege.com/partners-search/");

        $regex = "/([^\/\.]*)\.(?:bncollege|bkstore).*?title\=\"(.+?)\"/";
        preg_match_all($regex, $content, $matches, PREG_SET_ORDER);

        foreach ($manualSchools as $sub => $name) {
            $matches[] = array(
                0 => '',
                1 => $sub,
                2 => $name
            );
        }

        $ret = array();
        foreach ($matches as $match) {
            $subdomain = $match[1];

            if (in_array($subdomain, $invalidSubdomains)) {
                continue;
            }

            if (isset($replaceSubdomains[$subdomain])) {
                $subdomain = $replaceSubdomains[$subdomain];
            }

            $slug = isset($slugFixes[$subdomain]) ? $slugFixes[$subdomain] : $subdomain;

            if (isset($nameFixes[$slug])) {
                $name = $nameFixes[$slug];
            } else {
                $name = htmlspecialchars_decode(html_entity_decode($match[2], ENT_COMPAT, 'UTF-8'));
                $name = trim(preg_replace("/Barnes.+?(at|@)/", "", $name));
                $name = str_replace("Bookstore", "", $name);
            }

            $slug = str_replace(array("bookstore", "store"), "", $slug);

            $bid = false;
            if (preg_match("/storeId=(\d{5})/", $match[0], $m)) {
                $bid = $m[1];
            } else {
                $homepage = self::get("http://$subdomain.bncollege.com");
                unset($_SESSION['BnCollegeSession']);

                sleep(1);
                if (preg_match("/storeId=(\d{5})/", $homepage, $foo)) {
                    $bid = $foo[1];
                } else if (isset($manualIds[$subdomain])) {
                    $bid = $manualIds[$subdomain];
                } else {
                    echo "No id match on homepage, skipping ($slug).\n";
                    continue;
                }
            }

            $foo = array(
                'BId' => $bid,
                'Slug' => $slug,
                'Subdomain' => $subdomain,
                'Name' => $name,
            );

            if (isset($shortNameFixes[$slug])) {
                $foo['ShortName'] = $shortNameFixes[$slug];
            }

            $ret[] = $foo;
        }

        return $ret;

    }

}
