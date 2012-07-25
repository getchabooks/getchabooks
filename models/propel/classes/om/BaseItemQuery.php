<?php


/**
 * Base class that represents a query for the 'item' table.
 *
 * 
 *
 * @method     ItemQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ItemQuery orderByIsbn($order = Criteria::ASC) Order by the isbn column
 * @method     ItemQuery orderByPackageId($order = Criteria::ASC) Order by the package_id column
 * @method     ItemQuery orderByIsPackage($order = Criteria::ASC) Order by the is_package column
 * @method     ItemQuery orderByTitle($order = Criteria::ASC) Order by the title column
 * @method     ItemQuery orderByAuthor($order = Criteria::ASC) Order by the author column
 * @method     ItemQuery orderByEdition($order = Criteria::ASC) Order by the edition column
 * @method     ItemQuery orderByPublisher($order = Criteria::ASC) Order by the publisher column
 * @method     ItemQuery orderByBNew($order = Criteria::ASC) Order by the b_new column
 * @method     ItemQuery orderByBUsed($order = Criteria::ASC) Order by the b_used column
 * @method     ItemQuery orderByBEbook($order = Criteria::ASC) Order by the b_ebook column
 * @method     ItemQuery orderByImageUrl($order = Criteria::ASC) Order by the image_url column
 * @method     ItemQuery orderByProductId($order = Criteria::ASC) Order by the product_id column
 * @method     ItemQuery orderByPartNumber($order = Criteria::ASC) Order by the part_number column
 * @method     ItemQuery orderBySpideredAt($order = Criteria::ASC) Order by the spidered_at column
 * @method     ItemQuery orderByShallowSpideredAt($order = Criteria::ASC) Order by the shallow_spidered_at column
 * @method     ItemQuery orderByTouched($order = Criteria::ASC) Order by the touched column
 * @method     ItemQuery orderByBId($order = Criteria::ASC) Order by the b_id column
 * @method     ItemQuery orderByBookstoreType($order = Criteria::ASC) Order by the bookstore_type column
 * @method     ItemQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method     ItemQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 *
 * @method     ItemQuery groupById() Group by the id column
 * @method     ItemQuery groupByIsbn() Group by the isbn column
 * @method     ItemQuery groupByPackageId() Group by the package_id column
 * @method     ItemQuery groupByIsPackage() Group by the is_package column
 * @method     ItemQuery groupByTitle() Group by the title column
 * @method     ItemQuery groupByAuthor() Group by the author column
 * @method     ItemQuery groupByEdition() Group by the edition column
 * @method     ItemQuery groupByPublisher() Group by the publisher column
 * @method     ItemQuery groupByBNew() Group by the b_new column
 * @method     ItemQuery groupByBUsed() Group by the b_used column
 * @method     ItemQuery groupByBEbook() Group by the b_ebook column
 * @method     ItemQuery groupByImageUrl() Group by the image_url column
 * @method     ItemQuery groupByProductId() Group by the product_id column
 * @method     ItemQuery groupByPartNumber() Group by the part_number column
 * @method     ItemQuery groupBySpideredAt() Group by the spidered_at column
 * @method     ItemQuery groupByShallowSpideredAt() Group by the shallow_spidered_at column
 * @method     ItemQuery groupByTouched() Group by the touched column
 * @method     ItemQuery groupByBId() Group by the b_id column
 * @method     ItemQuery groupByBookstoreType() Group by the bookstore_type column
 * @method     ItemQuery groupByCreatedAt() Group by the created_at column
 * @method     ItemQuery groupByUpdatedAt() Group by the updated_at column
 *
 * @method     ItemQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ItemQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ItemQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ItemQuery leftJoinBook($relationAlias = null) Adds a LEFT JOIN clause to the query using the Book relation
 * @method     ItemQuery rightJoinBook($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Book relation
 * @method     ItemQuery innerJoinBook($relationAlias = null) Adds a INNER JOIN clause to the query using the Book relation
 *
 * @method     ItemQuery leftJoinItemRelatedByPackageId($relationAlias = null) Adds a LEFT JOIN clause to the query using the ItemRelatedByPackageId relation
 * @method     ItemQuery rightJoinItemRelatedByPackageId($relationAlias = null) Adds a RIGHT JOIN clause to the query using the ItemRelatedByPackageId relation
 * @method     ItemQuery innerJoinItemRelatedByPackageId($relationAlias = null) Adds a INNER JOIN clause to the query using the ItemRelatedByPackageId relation
 *
 * @method     ItemQuery leftJoinItemRelatedById($relationAlias = null) Adds a LEFT JOIN clause to the query using the ItemRelatedById relation
 * @method     ItemQuery rightJoinItemRelatedById($relationAlias = null) Adds a RIGHT JOIN clause to the query using the ItemRelatedById relation
 * @method     ItemQuery innerJoinItemRelatedById($relationAlias = null) Adds a INNER JOIN clause to the query using the ItemRelatedById relation
 *
 * @method     ItemQuery leftJoinSectionHasItem($relationAlias = null) Adds a LEFT JOIN clause to the query using the SectionHasItem relation
 * @method     ItemQuery rightJoinSectionHasItem($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SectionHasItem relation
 * @method     ItemQuery innerJoinSectionHasItem($relationAlias = null) Adds a INNER JOIN clause to the query using the SectionHasItem relation
 *
 * @method     Item findOne(PropelPDO $con = null) Return the first Item matching the query
 * @method     Item findOneOrCreate(PropelPDO $con = null) Return the first Item matching the query, or a new Item object populated from the query conditions when no match is found
 *
 * @method     Item findOneById(int $id) Return the first Item filtered by the id column
 * @method     Item findOneByIsbn(string $isbn) Return the first Item filtered by the isbn column
 * @method     Item findOneByPackageId(int $package_id) Return the first Item filtered by the package_id column
 * @method     Item findOneByIsPackage(boolean $is_package) Return the first Item filtered by the is_package column
 * @method     Item findOneByTitle(string $title) Return the first Item filtered by the title column
 * @method     Item findOneByAuthor(string $author) Return the first Item filtered by the author column
 * @method     Item findOneByEdition(string $edition) Return the first Item filtered by the edition column
 * @method     Item findOneByPublisher(string $publisher) Return the first Item filtered by the publisher column
 * @method     Item findOneByBNew(string $b_new) Return the first Item filtered by the b_new column
 * @method     Item findOneByBUsed(string $b_used) Return the first Item filtered by the b_used column
 * @method     Item findOneByBEbook(string $b_ebook) Return the first Item filtered by the b_ebook column
 * @method     Item findOneByImageUrl(string $image_url) Return the first Item filtered by the image_url column
 * @method     Item findOneByProductId(string $product_id) Return the first Item filtered by the product_id column
 * @method     Item findOneByPartNumber(string $part_number) Return the first Item filtered by the part_number column
 * @method     Item findOneBySpideredAt(string $spidered_at) Return the first Item filtered by the spidered_at column
 * @method     Item findOneByShallowSpideredAt(string $shallow_spidered_at) Return the first Item filtered by the shallow_spidered_at column
 * @method     Item findOneByTouched(boolean $touched) Return the first Item filtered by the touched column
 * @method     Item findOneByBId(string $b_id) Return the first Item filtered by the b_id column
 * @method     Item findOneByBookstoreType(string $bookstore_type) Return the first Item filtered by the bookstore_type column
 * @method     Item findOneByCreatedAt(string $created_at) Return the first Item filtered by the created_at column
 * @method     Item findOneByUpdatedAt(string $updated_at) Return the first Item filtered by the updated_at column
 *
 * @method     array findById(int $id) Return Item objects filtered by the id column
 * @method     array findByIsbn(string $isbn) Return Item objects filtered by the isbn column
 * @method     array findByPackageId(int $package_id) Return Item objects filtered by the package_id column
 * @method     array findByIsPackage(boolean $is_package) Return Item objects filtered by the is_package column
 * @method     array findByTitle(string $title) Return Item objects filtered by the title column
 * @method     array findByAuthor(string $author) Return Item objects filtered by the author column
 * @method     array findByEdition(string $edition) Return Item objects filtered by the edition column
 * @method     array findByPublisher(string $publisher) Return Item objects filtered by the publisher column
 * @method     array findByBNew(string $b_new) Return Item objects filtered by the b_new column
 * @method     array findByBUsed(string $b_used) Return Item objects filtered by the b_used column
 * @method     array findByBEbook(string $b_ebook) Return Item objects filtered by the b_ebook column
 * @method     array findByImageUrl(string $image_url) Return Item objects filtered by the image_url column
 * @method     array findByProductId(string $product_id) Return Item objects filtered by the product_id column
 * @method     array findByPartNumber(string $part_number) Return Item objects filtered by the part_number column
 * @method     array findBySpideredAt(string $spidered_at) Return Item objects filtered by the spidered_at column
 * @method     array findByShallowSpideredAt(string $shallow_spidered_at) Return Item objects filtered by the shallow_spidered_at column
 * @method     array findByTouched(boolean $touched) Return Item objects filtered by the touched column
 * @method     array findByBId(string $b_id) Return Item objects filtered by the b_id column
 * @method     array findByBookstoreType(string $bookstore_type) Return Item objects filtered by the bookstore_type column
 * @method     array findByCreatedAt(string $created_at) Return Item objects filtered by the created_at column
 * @method     array findByUpdatedAt(string $updated_at) Return Item objects filtered by the updated_at column
 *
 * @package    propel.generator..om
 */
abstract class BaseItemQuery extends ModelCriteria
{
	
	/**
	 * Initializes internal state of BaseItemQuery object.
	 *
	 * @param     string $dbName The dabase name
	 * @param     string $modelName The phpName of a model, e.g. 'Book'
	 * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
	 */
	public function __construct($dbName = GB_DATABASE, $modelName = 'Item', $modelAlias = null)
	{
		parent::__construct($dbName, $modelName, $modelAlias);
	}

	/**
	 * Returns a new ItemQuery object.
	 *
	 * @param     string $modelAlias The alias of a model in the query
	 * @param     Criteria $criteria Optional Criteria to build the query from
	 *
	 * @return    ItemQuery
	 */
	public static function create($modelAlias = null, $criteria = null)
	{
		if ($criteria instanceof ItemQuery) {
			return $criteria;
		}
		$query = new ItemQuery();
		if (null !== $modelAlias) {
			$query->setModelAlias($modelAlias);
		}
		if ($criteria instanceof Criteria) {
			$query->mergeWith($criteria);
		}
		return $query;
	}

	/**
	 * Find object by primary key.
	 * Propel uses the instance pool to skip the database if the object exists.
	 * Go fast if the query is untouched.
	 *
	 * <code>
	 * $obj  = $c->findPk(12, $con);
	 * </code>
	 *
	 * @param     mixed $key Primary key to use for the query
	 * @param     PropelPDO $con an optional connection object
	 *
	 * @return    Item|array|mixed the result, formatted by the current formatter
	 */
	public function findPk($key, $con = null)
	{
		if ($key === null) {
			return null;
		}
		if ((null !== ($obj = ItemPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
			// the object is alredy in the instance pool
			return $obj;
		}
		if ($con === null) {
			$con = Propel::getConnection(ItemPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}
		$this->basePreSelect($con);
		if ($this->formatter || $this->modelAlias || $this->with || $this->select
		 || $this->selectColumns || $this->asColumns || $this->selectModifiers
		 || $this->map || $this->having || $this->joins) {
			return $this->findPkComplex($key, $con);
		} else {
			return $this->findPkSimple($key, $con);
		}
	}

	/**
	 * Find object by primary key using raw SQL to go fast.
	 * Bypass doSelect() and the object formatter by using generated code.
	 *
	 * @param     mixed $key Primary key to use for the query
	 * @param     PropelPDO $con A connection object
	 *
	 * @return    Item A model object, or null if the key is not found
	 */
	protected function findPkSimple($key, $con)
	{
		$sql = 'SELECT `ID`, `ISBN`, `PACKAGE_ID`, `IS_PACKAGE`, `TITLE`, `AUTHOR`, `EDITION`, `PUBLISHER`, `B_NEW`, `B_USED`, `B_EBOOK`, `IMAGE_URL`, `PRODUCT_ID`, `PART_NUMBER`, `SPIDERED_AT`, `SHALLOW_SPIDERED_AT`, `TOUCHED`, `B_ID`, `BOOKSTORE_TYPE`, `CREATED_AT`, `UPDATED_AT` FROM `item` WHERE `ID` = :p0';
		try {
			$stmt = $con->prepare($sql);
			$stmt->bindValue(':p0', $key, PDO::PARAM_INT);
			$stmt->execute();
		} catch (Exception $e) {
			Propel::log($e->getMessage(), Propel::LOG_ERR);
			throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), $e);
		}
		$obj = null;
		if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$obj = new Item();
			$obj->hydrate($row);
			ItemPeer::addInstanceToPool($obj, (string) $key);
		}
		$stmt->closeCursor();

		return $obj;
	}

	/**
	 * Find object by primary key.
	 *
	 * @param     mixed $key Primary key to use for the query
	 * @param     PropelPDO $con A connection object
	 *
	 * @return    Item|array|mixed the result, formatted by the current formatter
	 */
	protected function findPkComplex($key, $con)
	{
		// As the query uses a PK condition, no limit(1) is necessary.
		$criteria = $this->isKeepQuery() ? clone $this : $this;
		$stmt = $criteria
			->filterByPrimaryKey($key)
			->doSelect($con);
		return $criteria->getFormatter()->init($criteria)->formatOne($stmt);
	}

	/**
	 * Find objects by primary key
	 * <code>
	 * $objs = $c->findPks(array(12, 56, 832), $con);
	 * </code>
	 * @param     array $keys Primary keys to use for the query
	 * @param     PropelPDO $con an optional connection object
	 *
	 * @return    PropelObjectCollection|array|mixed the list of results, formatted by the current formatter
	 */
	public function findPks($keys, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection($this->getDbName(), Propel::CONNECTION_READ);
		}
		$this->basePreSelect($con);
		$criteria = $this->isKeepQuery() ? clone $this : $this;
		$stmt = $criteria
			->filterByPrimaryKeys($keys)
			->doSelect($con);
		return $criteria->getFormatter()->init($criteria)->format($stmt);
	}

	/**
	 * Filter the query by primary key
	 *
	 * @param     mixed $key Primary key to use for the query
	 *
	 * @return    ItemQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKey($key)
	{
		return $this->addUsingAlias(ItemPeer::ID, $key, Criteria::EQUAL);
	}

	/**
	 * Filter the query by a list of primary keys
	 *
	 * @param     array $keys The list of primary key to use for the query
	 *
	 * @return    ItemQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKeys($keys)
	{
		return $this->addUsingAlias(ItemPeer::ID, $keys, Criteria::IN);
	}

	/**
	 * Filter the query on the id column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterById(1234); // WHERE id = 1234
	 * $query->filterById(array(12, 34)); // WHERE id IN (12, 34)
	 * $query->filterById(array('min' => 12)); // WHERE id > 12
	 * </code>
	 *
	 * @param     mixed $id The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    ItemQuery The current query, for fluid interface
	 */
	public function filterById($id = null, $comparison = null)
	{
		if (is_array($id) && null === $comparison) {
			$comparison = Criteria::IN;
		}
		return $this->addUsingAlias(ItemPeer::ID, $id, $comparison);
	}

	/**
	 * Filter the query on the isbn column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByIsbn('fooValue');   // WHERE isbn = 'fooValue'
	 * $query->filterByIsbn('%fooValue%'); // WHERE isbn LIKE '%fooValue%'
	 * </code>
	 *
	 * @param     string $isbn The value to use as filter.
	 *              Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    ItemQuery The current query, for fluid interface
	 */
	public function filterByIsbn($isbn = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($isbn)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $isbn)) {
				$isbn = str_replace('*', '%', $isbn);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(ItemPeer::ISBN, $isbn, $comparison);
	}

	/**
	 * Filter the query on the package_id column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByPackageId(1234); // WHERE package_id = 1234
	 * $query->filterByPackageId(array(12, 34)); // WHERE package_id IN (12, 34)
	 * $query->filterByPackageId(array('min' => 12)); // WHERE package_id > 12
	 * </code>
	 *
	 * @see       filterByItemRelatedByPackageId()
	 *
	 * @param     mixed $packageId The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    ItemQuery The current query, for fluid interface
	 */
	public function filterByPackageId($packageId = null, $comparison = null)
	{
		if (is_array($packageId)) {
			$useMinMax = false;
			if (isset($packageId['min'])) {
				$this->addUsingAlias(ItemPeer::PACKAGE_ID, $packageId['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($packageId['max'])) {
				$this->addUsingAlias(ItemPeer::PACKAGE_ID, $packageId['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(ItemPeer::PACKAGE_ID, $packageId, $comparison);
	}

	/**
	 * Filter the query on the is_package column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByIsPackage(true); // WHERE is_package = true
	 * $query->filterByIsPackage('yes'); // WHERE is_package = true
	 * </code>
	 *
	 * @param     boolean|string $isPackage The value to use as filter.
	 *              Non-boolean arguments are converted using the following rules:
	 *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
	 *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
	 *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    ItemQuery The current query, for fluid interface
	 */
	public function filterByIsPackage($isPackage = null, $comparison = null)
	{
		if (is_string($isPackage)) {
			$is_package = in_array(strtolower($isPackage), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
		}
		return $this->addUsingAlias(ItemPeer::IS_PACKAGE, $isPackage, $comparison);
	}

	/**
	 * Filter the query on the title column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByTitle('fooValue');   // WHERE title = 'fooValue'
	 * $query->filterByTitle('%fooValue%'); // WHERE title LIKE '%fooValue%'
	 * </code>
	 *
	 * @param     string $title The value to use as filter.
	 *              Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    ItemQuery The current query, for fluid interface
	 */
	public function filterByTitle($title = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($title)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $title)) {
				$title = str_replace('*', '%', $title);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(ItemPeer::TITLE, $title, $comparison);
	}

	/**
	 * Filter the query on the author column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByAuthor('fooValue');   // WHERE author = 'fooValue'
	 * $query->filterByAuthor('%fooValue%'); // WHERE author LIKE '%fooValue%'
	 * </code>
	 *
	 * @param     string $author The value to use as filter.
	 *              Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    ItemQuery The current query, for fluid interface
	 */
	public function filterByAuthor($author = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($author)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $author)) {
				$author = str_replace('*', '%', $author);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(ItemPeer::AUTHOR, $author, $comparison);
	}

	/**
	 * Filter the query on the edition column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByEdition('fooValue');   // WHERE edition = 'fooValue'
	 * $query->filterByEdition('%fooValue%'); // WHERE edition LIKE '%fooValue%'
	 * </code>
	 *
	 * @param     string $edition The value to use as filter.
	 *              Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    ItemQuery The current query, for fluid interface
	 */
	public function filterByEdition($edition = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($edition)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $edition)) {
				$edition = str_replace('*', '%', $edition);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(ItemPeer::EDITION, $edition, $comparison);
	}

	/**
	 * Filter the query on the publisher column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByPublisher('fooValue');   // WHERE publisher = 'fooValue'
	 * $query->filterByPublisher('%fooValue%'); // WHERE publisher LIKE '%fooValue%'
	 * </code>
	 *
	 * @param     string $publisher The value to use as filter.
	 *              Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    ItemQuery The current query, for fluid interface
	 */
	public function filterByPublisher($publisher = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($publisher)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $publisher)) {
				$publisher = str_replace('*', '%', $publisher);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(ItemPeer::PUBLISHER, $publisher, $comparison);
	}

	/**
	 * Filter the query on the b_new column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByBNew(1234); // WHERE b_new = 1234
	 * $query->filterByBNew(array(12, 34)); // WHERE b_new IN (12, 34)
	 * $query->filterByBNew(array('min' => 12)); // WHERE b_new > 12
	 * </code>
	 *
	 * @param     mixed $bNew The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    ItemQuery The current query, for fluid interface
	 */
	public function filterByBNew($bNew = null, $comparison = null)
	{
		if (is_array($bNew)) {
			$useMinMax = false;
			if (isset($bNew['min'])) {
				$this->addUsingAlias(ItemPeer::B_NEW, $bNew['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($bNew['max'])) {
				$this->addUsingAlias(ItemPeer::B_NEW, $bNew['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(ItemPeer::B_NEW, $bNew, $comparison);
	}

	/**
	 * Filter the query on the b_used column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByBUsed(1234); // WHERE b_used = 1234
	 * $query->filterByBUsed(array(12, 34)); // WHERE b_used IN (12, 34)
	 * $query->filterByBUsed(array('min' => 12)); // WHERE b_used > 12
	 * </code>
	 *
	 * @param     mixed $bUsed The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    ItemQuery The current query, for fluid interface
	 */
	public function filterByBUsed($bUsed = null, $comparison = null)
	{
		if (is_array($bUsed)) {
			$useMinMax = false;
			if (isset($bUsed['min'])) {
				$this->addUsingAlias(ItemPeer::B_USED, $bUsed['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($bUsed['max'])) {
				$this->addUsingAlias(ItemPeer::B_USED, $bUsed['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(ItemPeer::B_USED, $bUsed, $comparison);
	}

	/**
	 * Filter the query on the b_ebook column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByBEbook(1234); // WHERE b_ebook = 1234
	 * $query->filterByBEbook(array(12, 34)); // WHERE b_ebook IN (12, 34)
	 * $query->filterByBEbook(array('min' => 12)); // WHERE b_ebook > 12
	 * </code>
	 *
	 * @param     mixed $bEbook The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    ItemQuery The current query, for fluid interface
	 */
	public function filterByBEbook($bEbook = null, $comparison = null)
	{
		if (is_array($bEbook)) {
			$useMinMax = false;
			if (isset($bEbook['min'])) {
				$this->addUsingAlias(ItemPeer::B_EBOOK, $bEbook['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($bEbook['max'])) {
				$this->addUsingAlias(ItemPeer::B_EBOOK, $bEbook['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(ItemPeer::B_EBOOK, $bEbook, $comparison);
	}

	/**
	 * Filter the query on the image_url column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByImageUrl('fooValue');   // WHERE image_url = 'fooValue'
	 * $query->filterByImageUrl('%fooValue%'); // WHERE image_url LIKE '%fooValue%'
	 * </code>
	 *
	 * @param     string $imageUrl The value to use as filter.
	 *              Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    ItemQuery The current query, for fluid interface
	 */
	public function filterByImageUrl($imageUrl = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($imageUrl)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $imageUrl)) {
				$imageUrl = str_replace('*', '%', $imageUrl);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(ItemPeer::IMAGE_URL, $imageUrl, $comparison);
	}

	/**
	 * Filter the query on the product_id column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByProductId('fooValue');   // WHERE product_id = 'fooValue'
	 * $query->filterByProductId('%fooValue%'); // WHERE product_id LIKE '%fooValue%'
	 * </code>
	 *
	 * @param     string $productId The value to use as filter.
	 *              Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    ItemQuery The current query, for fluid interface
	 */
	public function filterByProductId($productId = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($productId)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $productId)) {
				$productId = str_replace('*', '%', $productId);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(ItemPeer::PRODUCT_ID, $productId, $comparison);
	}

	/**
	 * Filter the query on the part_number column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByPartNumber('fooValue');   // WHERE part_number = 'fooValue'
	 * $query->filterByPartNumber('%fooValue%'); // WHERE part_number LIKE '%fooValue%'
	 * </code>
	 *
	 * @param     string $partNumber The value to use as filter.
	 *              Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    ItemQuery The current query, for fluid interface
	 */
	public function filterByPartNumber($partNumber = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($partNumber)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $partNumber)) {
				$partNumber = str_replace('*', '%', $partNumber);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(ItemPeer::PART_NUMBER, $partNumber, $comparison);
	}

	/**
	 * Filter the query on the spidered_at column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterBySpideredAt('2011-03-14'); // WHERE spidered_at = '2011-03-14'
	 * $query->filterBySpideredAt('now'); // WHERE spidered_at = '2011-03-14'
	 * $query->filterBySpideredAt(array('max' => 'yesterday')); // WHERE spidered_at > '2011-03-13'
	 * </code>
	 *
	 * @param     mixed $spideredAt The value to use as filter.
	 *              Values can be integers (unix timestamps), DateTime objects, or strings.
	 *              Empty strings are treated as NULL.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    ItemQuery The current query, for fluid interface
	 */
	public function filterBySpideredAt($spideredAt = null, $comparison = null)
	{
		if (is_array($spideredAt)) {
			$useMinMax = false;
			if (isset($spideredAt['min'])) {
				$this->addUsingAlias(ItemPeer::SPIDERED_AT, $spideredAt['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($spideredAt['max'])) {
				$this->addUsingAlias(ItemPeer::SPIDERED_AT, $spideredAt['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(ItemPeer::SPIDERED_AT, $spideredAt, $comparison);
	}

	/**
	 * Filter the query on the shallow_spidered_at column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByShallowSpideredAt('2011-03-14'); // WHERE shallow_spidered_at = '2011-03-14'
	 * $query->filterByShallowSpideredAt('now'); // WHERE shallow_spidered_at = '2011-03-14'
	 * $query->filterByShallowSpideredAt(array('max' => 'yesterday')); // WHERE shallow_spidered_at > '2011-03-13'
	 * </code>
	 *
	 * @param     mixed $shallowSpideredAt The value to use as filter.
	 *              Values can be integers (unix timestamps), DateTime objects, or strings.
	 *              Empty strings are treated as NULL.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    ItemQuery The current query, for fluid interface
	 */
	public function filterByShallowSpideredAt($shallowSpideredAt = null, $comparison = null)
	{
		if (is_array($shallowSpideredAt)) {
			$useMinMax = false;
			if (isset($shallowSpideredAt['min'])) {
				$this->addUsingAlias(ItemPeer::SHALLOW_SPIDERED_AT, $shallowSpideredAt['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($shallowSpideredAt['max'])) {
				$this->addUsingAlias(ItemPeer::SHALLOW_SPIDERED_AT, $shallowSpideredAt['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(ItemPeer::SHALLOW_SPIDERED_AT, $shallowSpideredAt, $comparison);
	}

	/**
	 * Filter the query on the touched column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByTouched(true); // WHERE touched = true
	 * $query->filterByTouched('yes'); // WHERE touched = true
	 * </code>
	 *
	 * @param     boolean|string $touched The value to use as filter.
	 *              Non-boolean arguments are converted using the following rules:
	 *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
	 *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
	 *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    ItemQuery The current query, for fluid interface
	 */
	public function filterByTouched($touched = null, $comparison = null)
	{
		if (is_string($touched)) {
			$touched = in_array(strtolower($touched), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
		}
		return $this->addUsingAlias(ItemPeer::TOUCHED, $touched, $comparison);
	}

	/**
	 * Filter the query on the b_id column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByBId('fooValue');   // WHERE b_id = 'fooValue'
	 * $query->filterByBId('%fooValue%'); // WHERE b_id LIKE '%fooValue%'
	 * </code>
	 *
	 * @param     string $bId The value to use as filter.
	 *              Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    ItemQuery The current query, for fluid interface
	 */
	public function filterByBId($bId = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($bId)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $bId)) {
				$bId = str_replace('*', '%', $bId);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(ItemPeer::B_ID, $bId, $comparison);
	}

	/**
	 * Filter the query on the bookstore_type column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByBookstoreType('fooValue');   // WHERE bookstore_type = 'fooValue'
	 * $query->filterByBookstoreType('%fooValue%'); // WHERE bookstore_type LIKE '%fooValue%'
	 * </code>
	 *
	 * @param     string $bookstoreType The value to use as filter.
	 *              Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    ItemQuery The current query, for fluid interface
	 */
	public function filterByBookstoreType($bookstoreType = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($bookstoreType)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $bookstoreType)) {
				$bookstoreType = str_replace('*', '%', $bookstoreType);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(ItemPeer::BOOKSTORE_TYPE, $bookstoreType, $comparison);
	}

	/**
	 * Filter the query on the created_at column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByCreatedAt('2011-03-14'); // WHERE created_at = '2011-03-14'
	 * $query->filterByCreatedAt('now'); // WHERE created_at = '2011-03-14'
	 * $query->filterByCreatedAt(array('max' => 'yesterday')); // WHERE created_at > '2011-03-13'
	 * </code>
	 *
	 * @param     mixed $createdAt The value to use as filter.
	 *              Values can be integers (unix timestamps), DateTime objects, or strings.
	 *              Empty strings are treated as NULL.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    ItemQuery The current query, for fluid interface
	 */
	public function filterByCreatedAt($createdAt = null, $comparison = null)
	{
		if (is_array($createdAt)) {
			$useMinMax = false;
			if (isset($createdAt['min'])) {
				$this->addUsingAlias(ItemPeer::CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($createdAt['max'])) {
				$this->addUsingAlias(ItemPeer::CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(ItemPeer::CREATED_AT, $createdAt, $comparison);
	}

	/**
	 * Filter the query on the updated_at column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByUpdatedAt('2011-03-14'); // WHERE updated_at = '2011-03-14'
	 * $query->filterByUpdatedAt('now'); // WHERE updated_at = '2011-03-14'
	 * $query->filterByUpdatedAt(array('max' => 'yesterday')); // WHERE updated_at > '2011-03-13'
	 * </code>
	 *
	 * @param     mixed $updatedAt The value to use as filter.
	 *              Values can be integers (unix timestamps), DateTime objects, or strings.
	 *              Empty strings are treated as NULL.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    ItemQuery The current query, for fluid interface
	 */
	public function filterByUpdatedAt($updatedAt = null, $comparison = null)
	{
		if (is_array($updatedAt)) {
			$useMinMax = false;
			if (isset($updatedAt['min'])) {
				$this->addUsingAlias(ItemPeer::UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($updatedAt['max'])) {
				$this->addUsingAlias(ItemPeer::UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(ItemPeer::UPDATED_AT, $updatedAt, $comparison);
	}

	/**
	 * Filter the query by a related Book object
	 *
	 * @param     Book|PropelCollection $book The related object(s) to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    ItemQuery The current query, for fluid interface
	 */
	public function filterByBook($book, $comparison = null)
	{
		if ($book instanceof Book) {
			return $this
				->addUsingAlias(ItemPeer::ISBN, $book->getIsbn(), $comparison);
		} elseif ($book instanceof PropelCollection) {
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
			return $this
				->addUsingAlias(ItemPeer::ISBN, $book->toKeyValue('PrimaryKey', 'Isbn'), $comparison);
		} else {
			throw new PropelException('filterByBook() only accepts arguments of type Book or PropelCollection');
		}
	}

	/**
	 * Adds a JOIN clause to the query using the Book relation
	 *
	 * @param     string $relationAlias optional alias for the relation
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    ItemQuery The current query, for fluid interface
	 */
	public function joinBook($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
	{
		$tableMap = $this->getTableMap();
		$relationMap = $tableMap->getRelation('Book');

		// create a ModelJoin object for this join
		$join = new ModelJoin();
		$join->setJoinType($joinType);
		$join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
		if ($previousJoin = $this->getPreviousJoin()) {
			$join->setPreviousJoin($previousJoin);
		}

		// add the ModelJoin to the current object
		if($relationAlias) {
			$this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
			$this->addJoinObject($join, $relationAlias);
		} else {
			$this->addJoinObject($join, 'Book');
		}

		return $this;
	}

	/**
	 * Use the Book relation Book object
	 *
	 * @see       useQuery()
	 *
	 * @param     string $relationAlias optional alias for the relation,
	 *                                   to be used as main alias in the secondary query
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    BookQuery A secondary query class using the current class as primary query
	 */
	public function useBookQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
	{
		return $this
			->joinBook($relationAlias, $joinType)
			->useQuery($relationAlias ? $relationAlias : 'Book', 'BookQuery');
	}

	/**
	 * Filter the query by a related Item object
	 *
	 * @param     Item|PropelCollection $item The related object(s) to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    ItemQuery The current query, for fluid interface
	 */
	public function filterByItemRelatedByPackageId($item, $comparison = null)
	{
		if ($item instanceof Item) {
			return $this
				->addUsingAlias(ItemPeer::PACKAGE_ID, $item->getId(), $comparison);
		} elseif ($item instanceof PropelCollection) {
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
			return $this
				->addUsingAlias(ItemPeer::PACKAGE_ID, $item->toKeyValue('PrimaryKey', 'Id'), $comparison);
		} else {
			throw new PropelException('filterByItemRelatedByPackageId() only accepts arguments of type Item or PropelCollection');
		}
	}

	/**
	 * Adds a JOIN clause to the query using the ItemRelatedByPackageId relation
	 *
	 * @param     string $relationAlias optional alias for the relation
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    ItemQuery The current query, for fluid interface
	 */
	public function joinItemRelatedByPackageId($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
	{
		$tableMap = $this->getTableMap();
		$relationMap = $tableMap->getRelation('ItemRelatedByPackageId');

		// create a ModelJoin object for this join
		$join = new ModelJoin();
		$join->setJoinType($joinType);
		$join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
		if ($previousJoin = $this->getPreviousJoin()) {
			$join->setPreviousJoin($previousJoin);
		}

		// add the ModelJoin to the current object
		if($relationAlias) {
			$this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
			$this->addJoinObject($join, $relationAlias);
		} else {
			$this->addJoinObject($join, 'ItemRelatedByPackageId');
		}

		return $this;
	}

	/**
	 * Use the ItemRelatedByPackageId relation Item object
	 *
	 * @see       useQuery()
	 *
	 * @param     string $relationAlias optional alias for the relation,
	 *                                   to be used as main alias in the secondary query
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    ItemQuery A secondary query class using the current class as primary query
	 */
	public function useItemRelatedByPackageIdQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
	{
		return $this
			->joinItemRelatedByPackageId($relationAlias, $joinType)
			->useQuery($relationAlias ? $relationAlias : 'ItemRelatedByPackageId', 'ItemQuery');
	}

	/**
	 * Filter the query by a related Item object
	 *
	 * @param     Item $item  the related object to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    ItemQuery The current query, for fluid interface
	 */
	public function filterByItemRelatedById($item, $comparison = null)
	{
		if ($item instanceof Item) {
			return $this
				->addUsingAlias(ItemPeer::ID, $item->getPackageId(), $comparison);
		} elseif ($item instanceof PropelCollection) {
			return $this
				->useItemRelatedByIdQuery()
				->filterByPrimaryKeys($item->getPrimaryKeys())
				->endUse();
		} else {
			throw new PropelException('filterByItemRelatedById() only accepts arguments of type Item or PropelCollection');
		}
	}

	/**
	 * Adds a JOIN clause to the query using the ItemRelatedById relation
	 *
	 * @param     string $relationAlias optional alias for the relation
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    ItemQuery The current query, for fluid interface
	 */
	public function joinItemRelatedById($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
	{
		$tableMap = $this->getTableMap();
		$relationMap = $tableMap->getRelation('ItemRelatedById');

		// create a ModelJoin object for this join
		$join = new ModelJoin();
		$join->setJoinType($joinType);
		$join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
		if ($previousJoin = $this->getPreviousJoin()) {
			$join->setPreviousJoin($previousJoin);
		}

		// add the ModelJoin to the current object
		if($relationAlias) {
			$this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
			$this->addJoinObject($join, $relationAlias);
		} else {
			$this->addJoinObject($join, 'ItemRelatedById');
		}

		return $this;
	}

	/**
	 * Use the ItemRelatedById relation Item object
	 *
	 * @see       useQuery()
	 *
	 * @param     string $relationAlias optional alias for the relation,
	 *                                   to be used as main alias in the secondary query
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    ItemQuery A secondary query class using the current class as primary query
	 */
	public function useItemRelatedByIdQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
	{
		return $this
			->joinItemRelatedById($relationAlias, $joinType)
			->useQuery($relationAlias ? $relationAlias : 'ItemRelatedById', 'ItemQuery');
	}

	/**
	 * Filter the query by a related SectionHasItem object
	 *
	 * @param     SectionHasItem $sectionHasItem  the related object to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    ItemQuery The current query, for fluid interface
	 */
	public function filterBySectionHasItem($sectionHasItem, $comparison = null)
	{
		if ($sectionHasItem instanceof SectionHasItem) {
			return $this
				->addUsingAlias(ItemPeer::ID, $sectionHasItem->getItemId(), $comparison);
		} elseif ($sectionHasItem instanceof PropelCollection) {
			return $this
				->useSectionHasItemQuery()
				->filterByPrimaryKeys($sectionHasItem->getPrimaryKeys())
				->endUse();
		} else {
			throw new PropelException('filterBySectionHasItem() only accepts arguments of type SectionHasItem or PropelCollection');
		}
	}

	/**
	 * Adds a JOIN clause to the query using the SectionHasItem relation
	 *
	 * @param     string $relationAlias optional alias for the relation
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    ItemQuery The current query, for fluid interface
	 */
	public function joinSectionHasItem($relationAlias = null, $joinType = Criteria::INNER_JOIN)
	{
		$tableMap = $this->getTableMap();
		$relationMap = $tableMap->getRelation('SectionHasItem');

		// create a ModelJoin object for this join
		$join = new ModelJoin();
		$join->setJoinType($joinType);
		$join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
		if ($previousJoin = $this->getPreviousJoin()) {
			$join->setPreviousJoin($previousJoin);
		}

		// add the ModelJoin to the current object
		if($relationAlias) {
			$this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
			$this->addJoinObject($join, $relationAlias);
		} else {
			$this->addJoinObject($join, 'SectionHasItem');
		}

		return $this;
	}

	/**
	 * Use the SectionHasItem relation SectionHasItem object
	 *
	 * @see       useQuery()
	 *
	 * @param     string $relationAlias optional alias for the relation,
	 *                                   to be used as main alias in the secondary query
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    SectionHasItemQuery A secondary query class using the current class as primary query
	 */
	public function useSectionHasItemQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
	{
		return $this
			->joinSectionHasItem($relationAlias, $joinType)
			->useQuery($relationAlias ? $relationAlias : 'SectionHasItem', 'SectionHasItemQuery');
	}

	/**
	 * Filter the query by a related Section object
	 * using the section_has_item table as cross reference
	 *
	 * @param     Section $section the related object to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    ItemQuery The current query, for fluid interface
	 */
	public function filterBySection($section, $comparison = Criteria::EQUAL)
	{
		return $this
			->useSectionHasItemQuery()
			->filterBySection($section, $comparison)
			->endUse();
	}

	/**
	 * Exclude object from result
	 *
	 * @param     Item $item Object to remove from the list of results
	 *
	 * @return    ItemQuery The current query, for fluid interface
	 */
	public function prune($item = null)
	{
		if ($item) {
			$this->addUsingAlias(ItemPeer::ID, $item->getId(), Criteria::NOT_EQUAL);
		}

		return $this;
	}

	// timestampable behavior
	
	/**
	 * Filter by the latest updated
	 *
	 * @param      int $nbDays Maximum age of the latest update in days
	 *
	 * @return     ItemQuery The current query, for fluid interface
	 */
	public function recentlyUpdated($nbDays = 7)
	{
		return $this->addUsingAlias(ItemPeer::UPDATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);
	}
	
	/**
	 * Filter by the latest created
	 *
	 * @param      int $nbDays Maximum age of in days
	 *
	 * @return     ItemQuery The current query, for fluid interface
	 */
	public function recentlyCreated($nbDays = 7)
	{
		return $this->addUsingAlias(ItemPeer::CREATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);
	}
	
	/**
	 * Order by update date desc
	 *
	 * @return     ItemQuery The current query, for fluid interface
	 */
	public function lastUpdatedFirst()
	{
		return $this->addDescendingOrderByColumn(ItemPeer::UPDATED_AT);
	}
	
	/**
	 * Order by update date asc
	 *
	 * @return     ItemQuery The current query, for fluid interface
	 */
	public function firstUpdatedFirst()
	{
		return $this->addAscendingOrderByColumn(ItemPeer::UPDATED_AT);
	}
	
	/**
	 * Order by create date desc
	 *
	 * @return     ItemQuery The current query, for fluid interface
	 */
	public function lastCreatedFirst()
	{
		return $this->addDescendingOrderByColumn(ItemPeer::CREATED_AT);
	}
	
	/**
	 * Order by create date asc
	 *
	 * @return     ItemQuery The current query, for fluid interface
	 */
	public function firstCreatedFirst()
	{
		return $this->addAscendingOrderByColumn(ItemPeer::CREATED_AT);
	}

} // BaseItemQuery