<?php


/**
 * Base class that represents a query for the 'term' table.
 *
 * 
 *
 * @method     TermQuery orderByShallowSpideredAt($order = Criteria::ASC) Order by the shallow_spidered_at column
 * @method     TermQuery orderByName($order = Criteria::ASC) Order by the name column
 * @method     TermQuery orderBySlug($order = Criteria::ASC) Order by the slug column
 * @method     TermQuery orderByStatus($order = Criteria::ASC) Order by the status column
 * @method     TermQuery orderByHasCourseInfo($order = Criteria::ASC) Order by the has_course_info column
 * @method     TermQuery orderByCampusId($order = Criteria::ASC) Order by the campus_id column
 * @method     TermQuery orderBySpideredAt($order = Criteria::ASC) Order by the spidered_at column
 * @method     TermQuery orderByTouched($order = Criteria::ASC) Order by the touched column
 * @method     TermQuery orderByBId($order = Criteria::ASC) Order by the b_id column
 * @method     TermQuery orderByBookstoreType($order = Criteria::ASC) Order by the bookstore_type column
 * @method     TermQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     TermQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method     TermQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 *
 * @method     TermQuery groupByShallowSpideredAt() Group by the shallow_spidered_at column
 * @method     TermQuery groupByName() Group by the name column
 * @method     TermQuery groupBySlug() Group by the slug column
 * @method     TermQuery groupByStatus() Group by the status column
 * @method     TermQuery groupByHasCourseInfo() Group by the has_course_info column
 * @method     TermQuery groupByCampusId() Group by the campus_id column
 * @method     TermQuery groupBySpideredAt() Group by the spidered_at column
 * @method     TermQuery groupByTouched() Group by the touched column
 * @method     TermQuery groupByBId() Group by the b_id column
 * @method     TermQuery groupByBookstoreType() Group by the bookstore_type column
 * @method     TermQuery groupById() Group by the id column
 * @method     TermQuery groupByCreatedAt() Group by the created_at column
 * @method     TermQuery groupByUpdatedAt() Group by the updated_at column
 *
 * @method     TermQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     TermQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     TermQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     TermQuery leftJoinCampus($relationAlias = null) Adds a LEFT JOIN clause to the query using the Campus relation
 * @method     TermQuery rightJoinCampus($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Campus relation
 * @method     TermQuery innerJoinCampus($relationAlias = null) Adds a INNER JOIN clause to the query using the Campus relation
 *
 * @method     TermQuery leftJoinDept($relationAlias = null) Adds a LEFT JOIN clause to the query using the Dept relation
 * @method     TermQuery rightJoinDept($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Dept relation
 * @method     TermQuery innerJoinDept($relationAlias = null) Adds a INNER JOIN clause to the query using the Dept relation
 *
 * @method     Term findOne(PropelPDO $con = null) Return the first Term matching the query
 * @method     Term findOneOrCreate(PropelPDO $con = null) Return the first Term matching the query, or a new Term object populated from the query conditions when no match is found
 *
 * @method     Term findOneByShallowSpideredAt(string $shallow_spidered_at) Return the first Term filtered by the shallow_spidered_at column
 * @method     Term findOneByName(string $name) Return the first Term filtered by the name column
 * @method     Term findOneBySlug(string $slug) Return the first Term filtered by the slug column
 * @method     Term findOneByStatus(int $status) Return the first Term filtered by the status column
 * @method     Term findOneByHasCourseInfo(boolean $has_course_info) Return the first Term filtered by the has_course_info column
 * @method     Term findOneByCampusId(int $campus_id) Return the first Term filtered by the campus_id column
 * @method     Term findOneBySpideredAt(string $spidered_at) Return the first Term filtered by the spidered_at column
 * @method     Term findOneByTouched(boolean $touched) Return the first Term filtered by the touched column
 * @method     Term findOneByBId(string $b_id) Return the first Term filtered by the b_id column
 * @method     Term findOneByBookstoreType(string $bookstore_type) Return the first Term filtered by the bookstore_type column
 * @method     Term findOneById(int $id) Return the first Term filtered by the id column
 * @method     Term findOneByCreatedAt(string $created_at) Return the first Term filtered by the created_at column
 * @method     Term findOneByUpdatedAt(string $updated_at) Return the first Term filtered by the updated_at column
 *
 * @method     array findByShallowSpideredAt(string $shallow_spidered_at) Return Term objects filtered by the shallow_spidered_at column
 * @method     array findByName(string $name) Return Term objects filtered by the name column
 * @method     array findBySlug(string $slug) Return Term objects filtered by the slug column
 * @method     array findByStatus(int $status) Return Term objects filtered by the status column
 * @method     array findByHasCourseInfo(boolean $has_course_info) Return Term objects filtered by the has_course_info column
 * @method     array findByCampusId(int $campus_id) Return Term objects filtered by the campus_id column
 * @method     array findBySpideredAt(string $spidered_at) Return Term objects filtered by the spidered_at column
 * @method     array findByTouched(boolean $touched) Return Term objects filtered by the touched column
 * @method     array findByBId(string $b_id) Return Term objects filtered by the b_id column
 * @method     array findByBookstoreType(string $bookstore_type) Return Term objects filtered by the bookstore_type column
 * @method     array findById(int $id) Return Term objects filtered by the id column
 * @method     array findByCreatedAt(string $created_at) Return Term objects filtered by the created_at column
 * @method     array findByUpdatedAt(string $updated_at) Return Term objects filtered by the updated_at column
 *
 * @package    propel.generator..om
 */
abstract class BaseTermQuery extends ModelCriteria
{
	
	/**
	 * Initializes internal state of BaseTermQuery object.
	 *
	 * @param     string $dbName The dabase name
	 * @param     string $modelName The phpName of a model, e.g. 'Book'
	 * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
	 */
	public function __construct($dbName = GB_DATABASE, $modelName = 'Term', $modelAlias = null)
	{
		parent::__construct($dbName, $modelName, $modelAlias);
	}

	/**
	 * Returns a new TermQuery object.
	 *
	 * @param     string $modelAlias The alias of a model in the query
	 * @param     Criteria $criteria Optional Criteria to build the query from
	 *
	 * @return    TermQuery
	 */
	public static function create($modelAlias = null, $criteria = null)
	{
		if ($criteria instanceof TermQuery) {
			return $criteria;
		}
		$query = new TermQuery();
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
	 * @return    Term|array|mixed the result, formatted by the current formatter
	 */
	public function findPk($key, $con = null)
	{
		if ($key === null) {
			return null;
		}
		if ((null !== ($obj = TermPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
			// the object is alredy in the instance pool
			return $obj;
		}
		if ($con === null) {
			$con = Propel::getConnection(TermPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
	 * @return    Term A model object, or null if the key is not found
	 */
	protected function findPkSimple($key, $con)
	{
		$sql = 'SELECT `SHALLOW_SPIDERED_AT`, `NAME`, `SLUG`, `STATUS`, `HAS_COURSE_INFO`, `CAMPUS_ID`, `SPIDERED_AT`, `TOUCHED`, `B_ID`, `BOOKSTORE_TYPE`, `ID`, `CREATED_AT`, `UPDATED_AT` FROM `term` WHERE `ID` = :p0';
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
			$obj = new Term();
			$obj->hydrate($row);
			TermPeer::addInstanceToPool($obj, (string) $key);
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
	 * @return    Term|array|mixed the result, formatted by the current formatter
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
	 * @return    TermQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKey($key)
	{
		return $this->addUsingAlias(TermPeer::ID, $key, Criteria::EQUAL);
	}

	/**
	 * Filter the query by a list of primary keys
	 *
	 * @param     array $keys The list of primary key to use for the query
	 *
	 * @return    TermQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKeys($keys)
	{
		return $this->addUsingAlias(TermPeer::ID, $keys, Criteria::IN);
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
	 * @return    TermQuery The current query, for fluid interface
	 */
	public function filterByShallowSpideredAt($shallowSpideredAt = null, $comparison = null)
	{
		if (is_array($shallowSpideredAt)) {
			$useMinMax = false;
			if (isset($shallowSpideredAt['min'])) {
				$this->addUsingAlias(TermPeer::SHALLOW_SPIDERED_AT, $shallowSpideredAt['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($shallowSpideredAt['max'])) {
				$this->addUsingAlias(TermPeer::SHALLOW_SPIDERED_AT, $shallowSpideredAt['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(TermPeer::SHALLOW_SPIDERED_AT, $shallowSpideredAt, $comparison);
	}

	/**
	 * Filter the query on the name column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByName('fooValue');   // WHERE name = 'fooValue'
	 * $query->filterByName('%fooValue%'); // WHERE name LIKE '%fooValue%'
	 * </code>
	 *
	 * @param     string $name The value to use as filter.
	 *              Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    TermQuery The current query, for fluid interface
	 */
	public function filterByName($name = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($name)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $name)) {
				$name = str_replace('*', '%', $name);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(TermPeer::NAME, $name, $comparison);
	}

	/**
	 * Filter the query on the slug column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterBySlug('fooValue');   // WHERE slug = 'fooValue'
	 * $query->filterBySlug('%fooValue%'); // WHERE slug LIKE '%fooValue%'
	 * </code>
	 *
	 * @param     string $slug The value to use as filter.
	 *              Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    TermQuery The current query, for fluid interface
	 */
	public function filterBySlug($slug = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($slug)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $slug)) {
				$slug = str_replace('*', '%', $slug);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(TermPeer::SLUG, $slug, $comparison);
	}

	/**
	 * Filter the query on the status column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByStatus(1234); // WHERE status = 1234
	 * $query->filterByStatus(array(12, 34)); // WHERE status IN (12, 34)
	 * $query->filterByStatus(array('min' => 12)); // WHERE status > 12
	 * </code>
	 *
	 * @param     mixed $status The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    TermQuery The current query, for fluid interface
	 */
	public function filterByStatus($status = null, $comparison = null)
	{
		if (is_array($status)) {
			$useMinMax = false;
			if (isset($status['min'])) {
				$this->addUsingAlias(TermPeer::STATUS, $status['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($status['max'])) {
				$this->addUsingAlias(TermPeer::STATUS, $status['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(TermPeer::STATUS, $status, $comparison);
	}

	/**
	 * Filter the query on the has_course_info column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByHasCourseInfo(true); // WHERE has_course_info = true
	 * $query->filterByHasCourseInfo('yes'); // WHERE has_course_info = true
	 * </code>
	 *
	 * @param     boolean|string $hasCourseInfo The value to use as filter.
	 *              Non-boolean arguments are converted using the following rules:
	 *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
	 *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
	 *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    TermQuery The current query, for fluid interface
	 */
	public function filterByHasCourseInfo($hasCourseInfo = null, $comparison = null)
	{
		if (is_string($hasCourseInfo)) {
			$has_course_info = in_array(strtolower($hasCourseInfo), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
		}
		return $this->addUsingAlias(TermPeer::HAS_COURSE_INFO, $hasCourseInfo, $comparison);
	}

	/**
	 * Filter the query on the campus_id column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByCampusId(1234); // WHERE campus_id = 1234
	 * $query->filterByCampusId(array(12, 34)); // WHERE campus_id IN (12, 34)
	 * $query->filterByCampusId(array('min' => 12)); // WHERE campus_id > 12
	 * </code>
	 *
	 * @see       filterByCampus()
	 *
	 * @param     mixed $campusId The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    TermQuery The current query, for fluid interface
	 */
	public function filterByCampusId($campusId = null, $comparison = null)
	{
		if (is_array($campusId)) {
			$useMinMax = false;
			if (isset($campusId['min'])) {
				$this->addUsingAlias(TermPeer::CAMPUS_ID, $campusId['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($campusId['max'])) {
				$this->addUsingAlias(TermPeer::CAMPUS_ID, $campusId['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(TermPeer::CAMPUS_ID, $campusId, $comparison);
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
	 * @return    TermQuery The current query, for fluid interface
	 */
	public function filterBySpideredAt($spideredAt = null, $comparison = null)
	{
		if (is_array($spideredAt)) {
			$useMinMax = false;
			if (isset($spideredAt['min'])) {
				$this->addUsingAlias(TermPeer::SPIDERED_AT, $spideredAt['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($spideredAt['max'])) {
				$this->addUsingAlias(TermPeer::SPIDERED_AT, $spideredAt['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(TermPeer::SPIDERED_AT, $spideredAt, $comparison);
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
	 * @return    TermQuery The current query, for fluid interface
	 */
	public function filterByTouched($touched = null, $comparison = null)
	{
		if (is_string($touched)) {
			$touched = in_array(strtolower($touched), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
		}
		return $this->addUsingAlias(TermPeer::TOUCHED, $touched, $comparison);
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
	 * @return    TermQuery The current query, for fluid interface
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
		return $this->addUsingAlias(TermPeer::B_ID, $bId, $comparison);
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
	 * @return    TermQuery The current query, for fluid interface
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
		return $this->addUsingAlias(TermPeer::BOOKSTORE_TYPE, $bookstoreType, $comparison);
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
	 * @return    TermQuery The current query, for fluid interface
	 */
	public function filterById($id = null, $comparison = null)
	{
		if (is_array($id) && null === $comparison) {
			$comparison = Criteria::IN;
		}
		return $this->addUsingAlias(TermPeer::ID, $id, $comparison);
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
	 * @return    TermQuery The current query, for fluid interface
	 */
	public function filterByCreatedAt($createdAt = null, $comparison = null)
	{
		if (is_array($createdAt)) {
			$useMinMax = false;
			if (isset($createdAt['min'])) {
				$this->addUsingAlias(TermPeer::CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($createdAt['max'])) {
				$this->addUsingAlias(TermPeer::CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(TermPeer::CREATED_AT, $createdAt, $comparison);
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
	 * @return    TermQuery The current query, for fluid interface
	 */
	public function filterByUpdatedAt($updatedAt = null, $comparison = null)
	{
		if (is_array($updatedAt)) {
			$useMinMax = false;
			if (isset($updatedAt['min'])) {
				$this->addUsingAlias(TermPeer::UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($updatedAt['max'])) {
				$this->addUsingAlias(TermPeer::UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(TermPeer::UPDATED_AT, $updatedAt, $comparison);
	}

	/**
	 * Filter the query by a related Campus object
	 *
	 * @param     Campus|PropelCollection $campus The related object(s) to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    TermQuery The current query, for fluid interface
	 */
	public function filterByCampus($campus, $comparison = null)
	{
		if ($campus instanceof Campus) {
			return $this
				->addUsingAlias(TermPeer::CAMPUS_ID, $campus->getId(), $comparison);
		} elseif ($campus instanceof PropelCollection) {
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
			return $this
				->addUsingAlias(TermPeer::CAMPUS_ID, $campus->toKeyValue('PrimaryKey', 'Id'), $comparison);
		} else {
			throw new PropelException('filterByCampus() only accepts arguments of type Campus or PropelCollection');
		}
	}

	/**
	 * Adds a JOIN clause to the query using the Campus relation
	 *
	 * @param     string $relationAlias optional alias for the relation
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    TermQuery The current query, for fluid interface
	 */
	public function joinCampus($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
	{
		$tableMap = $this->getTableMap();
		$relationMap = $tableMap->getRelation('Campus');

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
			$this->addJoinObject($join, 'Campus');
		}

		return $this;
	}

	/**
	 * Use the Campus relation Campus object
	 *
	 * @see       useQuery()
	 *
	 * @param     string $relationAlias optional alias for the relation,
	 *                                   to be used as main alias in the secondary query
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    CampusQuery A secondary query class using the current class as primary query
	 */
	public function useCampusQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
	{
		return $this
			->joinCampus($relationAlias, $joinType)
			->useQuery($relationAlias ? $relationAlias : 'Campus', 'CampusQuery');
	}

	/**
	 * Filter the query by a related Dept object
	 *
	 * @param     Dept $dept  the related object to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    TermQuery The current query, for fluid interface
	 */
	public function filterByDept($dept, $comparison = null)
	{
		if ($dept instanceof Dept) {
			return $this
				->addUsingAlias(TermPeer::ID, $dept->getTermId(), $comparison);
		} elseif ($dept instanceof PropelCollection) {
			return $this
				->useDeptQuery()
				->filterByPrimaryKeys($dept->getPrimaryKeys())
				->endUse();
		} else {
			throw new PropelException('filterByDept() only accepts arguments of type Dept or PropelCollection');
		}
	}

	/**
	 * Adds a JOIN clause to the query using the Dept relation
	 *
	 * @param     string $relationAlias optional alias for the relation
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    TermQuery The current query, for fluid interface
	 */
	public function joinDept($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
	{
		$tableMap = $this->getTableMap();
		$relationMap = $tableMap->getRelation('Dept');

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
			$this->addJoinObject($join, 'Dept');
		}

		return $this;
	}

	/**
	 * Use the Dept relation Dept object
	 *
	 * @see       useQuery()
	 *
	 * @param     string $relationAlias optional alias for the relation,
	 *                                   to be used as main alias in the secondary query
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    DeptQuery A secondary query class using the current class as primary query
	 */
	public function useDeptQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
	{
		return $this
			->joinDept($relationAlias, $joinType)
			->useQuery($relationAlias ? $relationAlias : 'Dept', 'DeptQuery');
	}

	/**
	 * Exclude object from result
	 *
	 * @param     Term $term Object to remove from the list of results
	 *
	 * @return    TermQuery The current query, for fluid interface
	 */
	public function prune($term = null)
	{
		if ($term) {
			$this->addUsingAlias(TermPeer::ID, $term->getId(), Criteria::NOT_EQUAL);
		}

		return $this;
	}

	// timestampable behavior
	
	/**
	 * Filter by the latest updated
	 *
	 * @param      int $nbDays Maximum age of the latest update in days
	 *
	 * @return     TermQuery The current query, for fluid interface
	 */
	public function recentlyUpdated($nbDays = 7)
	{
		return $this->addUsingAlias(TermPeer::UPDATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);
	}
	
	/**
	 * Filter by the latest created
	 *
	 * @param      int $nbDays Maximum age of in days
	 *
	 * @return     TermQuery The current query, for fluid interface
	 */
	public function recentlyCreated($nbDays = 7)
	{
		return $this->addUsingAlias(TermPeer::CREATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);
	}
	
	/**
	 * Order by update date desc
	 *
	 * @return     TermQuery The current query, for fluid interface
	 */
	public function lastUpdatedFirst()
	{
		return $this->addDescendingOrderByColumn(TermPeer::UPDATED_AT);
	}
	
	/**
	 * Order by update date asc
	 *
	 * @return     TermQuery The current query, for fluid interface
	 */
	public function firstUpdatedFirst()
	{
		return $this->addAscendingOrderByColumn(TermPeer::UPDATED_AT);
	}
	
	/**
	 * Order by create date desc
	 *
	 * @return     TermQuery The current query, for fluid interface
	 */
	public function lastCreatedFirst()
	{
		return $this->addDescendingOrderByColumn(TermPeer::CREATED_AT);
	}
	
	/**
	 * Order by create date asc
	 *
	 * @return     TermQuery The current query, for fluid interface
	 */
	public function firstCreatedFirst()
	{
		return $this->addAscendingOrderByColumn(TermPeer::CREATED_AT);
	}

} // BaseTermQuery