<?php


/**
 * Base class that represents a query for the 'section_has_item' table.
 *
 * 
 *
 * @method     SectionHasItemQuery orderBySectionId($order = Criteria::ASC) Order by the section_id column
 * @method     SectionHasItemQuery orderByItemId($order = Criteria::ASC) Order by the item_id column
 * @method     SectionHasItemQuery orderByRequiredStatus($order = Criteria::ASC) Order by the required_status column
 * @method     SectionHasItemQuery orderBySpideredAt($order = Criteria::ASC) Order by the spidered_at column
 * @method     SectionHasItemQuery orderByShallowSpideredAt($order = Criteria::ASC) Order by the shallow_spidered_at column
 * @method     SectionHasItemQuery orderByTouched($order = Criteria::ASC) Order by the touched column
 * @method     SectionHasItemQuery orderByBId($order = Criteria::ASC) Order by the b_id column
 * @method     SectionHasItemQuery orderByBookstoreType($order = Criteria::ASC) Order by the bookstore_type column
 * @method     SectionHasItemQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     SectionHasItemQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method     SectionHasItemQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 *
 * @method     SectionHasItemQuery groupBySectionId() Group by the section_id column
 * @method     SectionHasItemQuery groupByItemId() Group by the item_id column
 * @method     SectionHasItemQuery groupByRequiredStatus() Group by the required_status column
 * @method     SectionHasItemQuery groupBySpideredAt() Group by the spidered_at column
 * @method     SectionHasItemQuery groupByShallowSpideredAt() Group by the shallow_spidered_at column
 * @method     SectionHasItemQuery groupByTouched() Group by the touched column
 * @method     SectionHasItemQuery groupByBId() Group by the b_id column
 * @method     SectionHasItemQuery groupByBookstoreType() Group by the bookstore_type column
 * @method     SectionHasItemQuery groupById() Group by the id column
 * @method     SectionHasItemQuery groupByCreatedAt() Group by the created_at column
 * @method     SectionHasItemQuery groupByUpdatedAt() Group by the updated_at column
 *
 * @method     SectionHasItemQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     SectionHasItemQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     SectionHasItemQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     SectionHasItemQuery leftJoinSection($relationAlias = null) Adds a LEFT JOIN clause to the query using the Section relation
 * @method     SectionHasItemQuery rightJoinSection($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Section relation
 * @method     SectionHasItemQuery innerJoinSection($relationAlias = null) Adds a INNER JOIN clause to the query using the Section relation
 *
 * @method     SectionHasItemQuery leftJoinItem($relationAlias = null) Adds a LEFT JOIN clause to the query using the Item relation
 * @method     SectionHasItemQuery rightJoinItem($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Item relation
 * @method     SectionHasItemQuery innerJoinItem($relationAlias = null) Adds a INNER JOIN clause to the query using the Item relation
 *
 * @method     SectionHasItem findOne(PropelPDO $con = null) Return the first SectionHasItem matching the query
 * @method     SectionHasItem findOneOrCreate(PropelPDO $con = null) Return the first SectionHasItem matching the query, or a new SectionHasItem object populated from the query conditions when no match is found
 *
 * @method     SectionHasItem findOneBySectionId(int $section_id) Return the first SectionHasItem filtered by the section_id column
 * @method     SectionHasItem findOneByItemId(int $item_id) Return the first SectionHasItem filtered by the item_id column
 * @method     SectionHasItem findOneByRequiredStatus(int $required_status) Return the first SectionHasItem filtered by the required_status column
 * @method     SectionHasItem findOneBySpideredAt(string $spidered_at) Return the first SectionHasItem filtered by the spidered_at column
 * @method     SectionHasItem findOneByShallowSpideredAt(string $shallow_spidered_at) Return the first SectionHasItem filtered by the shallow_spidered_at column
 * @method     SectionHasItem findOneByTouched(boolean $touched) Return the first SectionHasItem filtered by the touched column
 * @method     SectionHasItem findOneByBId(string $b_id) Return the first SectionHasItem filtered by the b_id column
 * @method     SectionHasItem findOneByBookstoreType(string $bookstore_type) Return the first SectionHasItem filtered by the bookstore_type column
 * @method     SectionHasItem findOneById(int $id) Return the first SectionHasItem filtered by the id column
 * @method     SectionHasItem findOneByCreatedAt(string $created_at) Return the first SectionHasItem filtered by the created_at column
 * @method     SectionHasItem findOneByUpdatedAt(string $updated_at) Return the first SectionHasItem filtered by the updated_at column
 *
 * @method     array findBySectionId(int $section_id) Return SectionHasItem objects filtered by the section_id column
 * @method     array findByItemId(int $item_id) Return SectionHasItem objects filtered by the item_id column
 * @method     array findByRequiredStatus(int $required_status) Return SectionHasItem objects filtered by the required_status column
 * @method     array findBySpideredAt(string $spidered_at) Return SectionHasItem objects filtered by the spidered_at column
 * @method     array findByShallowSpideredAt(string $shallow_spidered_at) Return SectionHasItem objects filtered by the shallow_spidered_at column
 * @method     array findByTouched(boolean $touched) Return SectionHasItem objects filtered by the touched column
 * @method     array findByBId(string $b_id) Return SectionHasItem objects filtered by the b_id column
 * @method     array findByBookstoreType(string $bookstore_type) Return SectionHasItem objects filtered by the bookstore_type column
 * @method     array findById(int $id) Return SectionHasItem objects filtered by the id column
 * @method     array findByCreatedAt(string $created_at) Return SectionHasItem objects filtered by the created_at column
 * @method     array findByUpdatedAt(string $updated_at) Return SectionHasItem objects filtered by the updated_at column
 *
 * @package    propel.generator..om
 */
abstract class BaseSectionHasItemQuery extends ModelCriteria
{
	
	/**
	 * Initializes internal state of BaseSectionHasItemQuery object.
	 *
	 * @param     string $dbName The dabase name
	 * @param     string $modelName The phpName of a model, e.g. 'Book'
	 * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
	 */
	public function __construct($dbName = GB_DATABASE, $modelName = 'SectionHasItem', $modelAlias = null)
	{
		parent::__construct($dbName, $modelName, $modelAlias);
	}

	/**
	 * Returns a new SectionHasItemQuery object.
	 *
	 * @param     string $modelAlias The alias of a model in the query
	 * @param     Criteria $criteria Optional Criteria to build the query from
	 *
	 * @return    SectionHasItemQuery
	 */
	public static function create($modelAlias = null, $criteria = null)
	{
		if ($criteria instanceof SectionHasItemQuery) {
			return $criteria;
		}
		$query = new SectionHasItemQuery();
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
	 * @return    SectionHasItem|array|mixed the result, formatted by the current formatter
	 */
	public function findPk($key, $con = null)
	{
		if ($key === null) {
			return null;
		}
		if ((null !== ($obj = SectionHasItemPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
			// the object is alredy in the instance pool
			return $obj;
		}
		if ($con === null) {
			$con = Propel::getConnection(SectionHasItemPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
	 * @return    SectionHasItem A model object, or null if the key is not found
	 */
	protected function findPkSimple($key, $con)
	{
		$sql = 'SELECT `SECTION_ID`, `ITEM_ID`, `REQUIRED_STATUS`, `SPIDERED_AT`, `SHALLOW_SPIDERED_AT`, `TOUCHED`, `B_ID`, `BOOKSTORE_TYPE`, `ID`, `CREATED_AT`, `UPDATED_AT` FROM `section_has_item` WHERE `ID` = :p0';
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
			$obj = new SectionHasItem();
			$obj->hydrate($row);
			SectionHasItemPeer::addInstanceToPool($obj, (string) $key);
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
	 * @return    SectionHasItem|array|mixed the result, formatted by the current formatter
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
	 * @return    SectionHasItemQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKey($key)
	{
		return $this->addUsingAlias(SectionHasItemPeer::ID, $key, Criteria::EQUAL);
	}

	/**
	 * Filter the query by a list of primary keys
	 *
	 * @param     array $keys The list of primary key to use for the query
	 *
	 * @return    SectionHasItemQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKeys($keys)
	{
		return $this->addUsingAlias(SectionHasItemPeer::ID, $keys, Criteria::IN);
	}

	/**
	 * Filter the query on the section_id column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterBySectionId(1234); // WHERE section_id = 1234
	 * $query->filterBySectionId(array(12, 34)); // WHERE section_id IN (12, 34)
	 * $query->filterBySectionId(array('min' => 12)); // WHERE section_id > 12
	 * </code>
	 *
	 * @see       filterBySection()
	 *
	 * @param     mixed $sectionId The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    SectionHasItemQuery The current query, for fluid interface
	 */
	public function filterBySectionId($sectionId = null, $comparison = null)
	{
		if (is_array($sectionId)) {
			$useMinMax = false;
			if (isset($sectionId['min'])) {
				$this->addUsingAlias(SectionHasItemPeer::SECTION_ID, $sectionId['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($sectionId['max'])) {
				$this->addUsingAlias(SectionHasItemPeer::SECTION_ID, $sectionId['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(SectionHasItemPeer::SECTION_ID, $sectionId, $comparison);
	}

	/**
	 * Filter the query on the item_id column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByItemId(1234); // WHERE item_id = 1234
	 * $query->filterByItemId(array(12, 34)); // WHERE item_id IN (12, 34)
	 * $query->filterByItemId(array('min' => 12)); // WHERE item_id > 12
	 * </code>
	 *
	 * @see       filterByItem()
	 *
	 * @param     mixed $itemId The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    SectionHasItemQuery The current query, for fluid interface
	 */
	public function filterByItemId($itemId = null, $comparison = null)
	{
		if (is_array($itemId)) {
			$useMinMax = false;
			if (isset($itemId['min'])) {
				$this->addUsingAlias(SectionHasItemPeer::ITEM_ID, $itemId['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($itemId['max'])) {
				$this->addUsingAlias(SectionHasItemPeer::ITEM_ID, $itemId['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(SectionHasItemPeer::ITEM_ID, $itemId, $comparison);
	}

	/**
	 * Filter the query on the required_status column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByRequiredStatus(1234); // WHERE required_status = 1234
	 * $query->filterByRequiredStatus(array(12, 34)); // WHERE required_status IN (12, 34)
	 * $query->filterByRequiredStatus(array('min' => 12)); // WHERE required_status > 12
	 * </code>
	 *
	 * @param     mixed $requiredStatus The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    SectionHasItemQuery The current query, for fluid interface
	 */
	public function filterByRequiredStatus($requiredStatus = null, $comparison = null)
	{
		if (is_array($requiredStatus)) {
			$useMinMax = false;
			if (isset($requiredStatus['min'])) {
				$this->addUsingAlias(SectionHasItemPeer::REQUIRED_STATUS, $requiredStatus['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($requiredStatus['max'])) {
				$this->addUsingAlias(SectionHasItemPeer::REQUIRED_STATUS, $requiredStatus['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(SectionHasItemPeer::REQUIRED_STATUS, $requiredStatus, $comparison);
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
	 * @return    SectionHasItemQuery The current query, for fluid interface
	 */
	public function filterBySpideredAt($spideredAt = null, $comparison = null)
	{
		if (is_array($spideredAt)) {
			$useMinMax = false;
			if (isset($spideredAt['min'])) {
				$this->addUsingAlias(SectionHasItemPeer::SPIDERED_AT, $spideredAt['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($spideredAt['max'])) {
				$this->addUsingAlias(SectionHasItemPeer::SPIDERED_AT, $spideredAt['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(SectionHasItemPeer::SPIDERED_AT, $spideredAt, $comparison);
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
	 * @return    SectionHasItemQuery The current query, for fluid interface
	 */
	public function filterByShallowSpideredAt($shallowSpideredAt = null, $comparison = null)
	{
		if (is_array($shallowSpideredAt)) {
			$useMinMax = false;
			if (isset($shallowSpideredAt['min'])) {
				$this->addUsingAlias(SectionHasItemPeer::SHALLOW_SPIDERED_AT, $shallowSpideredAt['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($shallowSpideredAt['max'])) {
				$this->addUsingAlias(SectionHasItemPeer::SHALLOW_SPIDERED_AT, $shallowSpideredAt['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(SectionHasItemPeer::SHALLOW_SPIDERED_AT, $shallowSpideredAt, $comparison);
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
	 * @return    SectionHasItemQuery The current query, for fluid interface
	 */
	public function filterByTouched($touched = null, $comparison = null)
	{
		if (is_string($touched)) {
			$touched = in_array(strtolower($touched), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
		}
		return $this->addUsingAlias(SectionHasItemPeer::TOUCHED, $touched, $comparison);
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
	 * @return    SectionHasItemQuery The current query, for fluid interface
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
		return $this->addUsingAlias(SectionHasItemPeer::B_ID, $bId, $comparison);
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
	 * @return    SectionHasItemQuery The current query, for fluid interface
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
		return $this->addUsingAlias(SectionHasItemPeer::BOOKSTORE_TYPE, $bookstoreType, $comparison);
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
	 * @return    SectionHasItemQuery The current query, for fluid interface
	 */
	public function filterById($id = null, $comparison = null)
	{
		if (is_array($id) && null === $comparison) {
			$comparison = Criteria::IN;
		}
		return $this->addUsingAlias(SectionHasItemPeer::ID, $id, $comparison);
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
	 * @return    SectionHasItemQuery The current query, for fluid interface
	 */
	public function filterByCreatedAt($createdAt = null, $comparison = null)
	{
		if (is_array($createdAt)) {
			$useMinMax = false;
			if (isset($createdAt['min'])) {
				$this->addUsingAlias(SectionHasItemPeer::CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($createdAt['max'])) {
				$this->addUsingAlias(SectionHasItemPeer::CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(SectionHasItemPeer::CREATED_AT, $createdAt, $comparison);
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
	 * @return    SectionHasItemQuery The current query, for fluid interface
	 */
	public function filterByUpdatedAt($updatedAt = null, $comparison = null)
	{
		if (is_array($updatedAt)) {
			$useMinMax = false;
			if (isset($updatedAt['min'])) {
				$this->addUsingAlias(SectionHasItemPeer::UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($updatedAt['max'])) {
				$this->addUsingAlias(SectionHasItemPeer::UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(SectionHasItemPeer::UPDATED_AT, $updatedAt, $comparison);
	}

	/**
	 * Filter the query by a related Section object
	 *
	 * @param     Section|PropelCollection $section The related object(s) to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    SectionHasItemQuery The current query, for fluid interface
	 */
	public function filterBySection($section, $comparison = null)
	{
		if ($section instanceof Section) {
			return $this
				->addUsingAlias(SectionHasItemPeer::SECTION_ID, $section->getId(), $comparison);
		} elseif ($section instanceof PropelCollection) {
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
			return $this
				->addUsingAlias(SectionHasItemPeer::SECTION_ID, $section->toKeyValue('PrimaryKey', 'Id'), $comparison);
		} else {
			throw new PropelException('filterBySection() only accepts arguments of type Section or PropelCollection');
		}
	}

	/**
	 * Adds a JOIN clause to the query using the Section relation
	 *
	 * @param     string $relationAlias optional alias for the relation
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    SectionHasItemQuery The current query, for fluid interface
	 */
	public function joinSection($relationAlias = null, $joinType = Criteria::INNER_JOIN)
	{
		$tableMap = $this->getTableMap();
		$relationMap = $tableMap->getRelation('Section');

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
			$this->addJoinObject($join, 'Section');
		}

		return $this;
	}

	/**
	 * Use the Section relation Section object
	 *
	 * @see       useQuery()
	 *
	 * @param     string $relationAlias optional alias for the relation,
	 *                                   to be used as main alias in the secondary query
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    SectionQuery A secondary query class using the current class as primary query
	 */
	public function useSectionQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
	{
		return $this
			->joinSection($relationAlias, $joinType)
			->useQuery($relationAlias ? $relationAlias : 'Section', 'SectionQuery');
	}

	/**
	 * Filter the query by a related Item object
	 *
	 * @param     Item|PropelCollection $item The related object(s) to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    SectionHasItemQuery The current query, for fluid interface
	 */
	public function filterByItem($item, $comparison = null)
	{
		if ($item instanceof Item) {
			return $this
				->addUsingAlias(SectionHasItemPeer::ITEM_ID, $item->getId(), $comparison);
		} elseif ($item instanceof PropelCollection) {
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
			return $this
				->addUsingAlias(SectionHasItemPeer::ITEM_ID, $item->toKeyValue('PrimaryKey', 'Id'), $comparison);
		} else {
			throw new PropelException('filterByItem() only accepts arguments of type Item or PropelCollection');
		}
	}

	/**
	 * Adds a JOIN clause to the query using the Item relation
	 *
	 * @param     string $relationAlias optional alias for the relation
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    SectionHasItemQuery The current query, for fluid interface
	 */
	public function joinItem($relationAlias = null, $joinType = Criteria::INNER_JOIN)
	{
		$tableMap = $this->getTableMap();
		$relationMap = $tableMap->getRelation('Item');

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
			$this->addJoinObject($join, 'Item');
		}

		return $this;
	}

	/**
	 * Use the Item relation Item object
	 *
	 * @see       useQuery()
	 *
	 * @param     string $relationAlias optional alias for the relation,
	 *                                   to be used as main alias in the secondary query
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    ItemQuery A secondary query class using the current class as primary query
	 */
	public function useItemQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
	{
		return $this
			->joinItem($relationAlias, $joinType)
			->useQuery($relationAlias ? $relationAlias : 'Item', 'ItemQuery');
	}

	/**
	 * Exclude object from result
	 *
	 * @param     SectionHasItem $sectionHasItem Object to remove from the list of results
	 *
	 * @return    SectionHasItemQuery The current query, for fluid interface
	 */
	public function prune($sectionHasItem = null)
	{
		if ($sectionHasItem) {
			$this->addUsingAlias(SectionHasItemPeer::ID, $sectionHasItem->getId(), Criteria::NOT_EQUAL);
		}

		return $this;
	}

	/**
	 * Code to execute before every DELETE statement
	 *
	 * @param     PropelPDO $con The connection object used by the query
	 */
	protected function basePreDelete(PropelPDO $con)
	{
		// aggregate_column_relation behavior
		$this->findRelatedSections($con);

		return $this->preDelete($con);
	}

	/**
	 * Code to execute after every DELETE statement
	 *
	 * @param     int $affectedRows the number of deleted rows
	 * @param     PropelPDO $con The connection object used by the query
	 */
	protected function basePostDelete($affectedRows, PropelPDO $con)
	{
		// aggregate_column_relation behavior
		$this->updateRelatedSections($con);

		return $this->postDelete($affectedRows, $con);
	}

	/**
	 * Code to execute before every UPDATE statement
	 *
	 * @param     array $values The associatiove array of columns and values for the update
	 * @param     PropelPDO $con The connection object used by the query
	 * @param     boolean $forceIndividualSaves If false (default), the resulting call is a BasePeer::doUpdate(), ortherwise it is a series of save() calls on all the found objects
	 */
	protected function basePreUpdate(&$values, PropelPDO $con, $forceIndividualSaves = false)
	{
		// aggregate_column_relation behavior
		$this->findRelatedSections($con);

		return $this->preUpdate($values, $con, $forceIndividualSaves);
	}

	/**
	 * Code to execute after every UPDATE statement
	 *
	 * @param     int $affectedRows the number of udated rows
	 * @param     PropelPDO $con The connection object used by the query
	 */
	protected function basePostUpdate($affectedRows, PropelPDO $con)
	{
		// aggregate_column_relation behavior
		$this->updateRelatedSections($con);

		return $this->postUpdate($affectedRows, $con);
	}

	// timestampable behavior
	
	/**
	 * Filter by the latest updated
	 *
	 * @param      int $nbDays Maximum age of the latest update in days
	 *
	 * @return     SectionHasItemQuery The current query, for fluid interface
	 */
	public function recentlyUpdated($nbDays = 7)
	{
		return $this->addUsingAlias(SectionHasItemPeer::UPDATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);
	}
	
	/**
	 * Filter by the latest created
	 *
	 * @param      int $nbDays Maximum age of in days
	 *
	 * @return     SectionHasItemQuery The current query, for fluid interface
	 */
	public function recentlyCreated($nbDays = 7)
	{
		return $this->addUsingAlias(SectionHasItemPeer::CREATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);
	}
	
	/**
	 * Order by update date desc
	 *
	 * @return     SectionHasItemQuery The current query, for fluid interface
	 */
	public function lastUpdatedFirst()
	{
		return $this->addDescendingOrderByColumn(SectionHasItemPeer::UPDATED_AT);
	}
	
	/**
	 * Order by update date asc
	 *
	 * @return     SectionHasItemQuery The current query, for fluid interface
	 */
	public function firstUpdatedFirst()
	{
		return $this->addAscendingOrderByColumn(SectionHasItemPeer::UPDATED_AT);
	}
	
	/**
	 * Order by create date desc
	 *
	 * @return     SectionHasItemQuery The current query, for fluid interface
	 */
	public function lastCreatedFirst()
	{
		return $this->addDescendingOrderByColumn(SectionHasItemPeer::CREATED_AT);
	}
	
	/**
	 * Order by create date asc
	 *
	 * @return     SectionHasItemQuery The current query, for fluid interface
	 */
	public function firstCreatedFirst()
	{
		return $this->addAscendingOrderByColumn(SectionHasItemPeer::CREATED_AT);
	}

	// aggregate_column_relation behavior
	
	/**
	 * Finds the related Section objects and keep them for later
	 *
	 * @param PropelPDO $con A connection object
	 */
	protected function findRelatedSections($con)
	{
		$criteria = clone $this;
		if ($this->useAliasInSQL) {
			$alias = $this->getModelAlias();
			$criteria->removeAlias($alias);
		} else {
			$alias = '';
		}
		$this->sections = SectionQuery::create()
			->joinSectionHasItem($alias)
			->mergeWith($criteria)
			->find($con);
	}
	
	protected function updateRelatedSections($con)
	{
		foreach ($this->sections as $section) {
			$section->updateNbItems($con);
		}
		$this->sections = array();
	}

} // BaseSectionHasItemQuery