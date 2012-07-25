<?php


/**
 * Base class that represents a query for the 'campus' table.
 *
 * 
 *
 * @method     CampusQuery orderByShallowSpideredAt($order = Criteria::ASC) Order by the shallow_spidered_at column
 * @method     CampusQuery orderByName($order = Criteria::ASC) Order by the name column
 * @method     CampusQuery orderBySlug($order = Criteria::ASC) Order by the slug column
 * @method     CampusQuery orderBySchoolId($order = Criteria::ASC) Order by the school_id column
 * @method     CampusQuery orderBySpideredAt($order = Criteria::ASC) Order by the spidered_at column
 * @method     CampusQuery orderByTouched($order = Criteria::ASC) Order by the touched column
 * @method     CampusQuery orderByBId($order = Criteria::ASC) Order by the b_id column
 * @method     CampusQuery orderByBookstoreType($order = Criteria::ASC) Order by the bookstore_type column
 * @method     CampusQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     CampusQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method     CampusQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 *
 * @method     CampusQuery groupByShallowSpideredAt() Group by the shallow_spidered_at column
 * @method     CampusQuery groupByName() Group by the name column
 * @method     CampusQuery groupBySlug() Group by the slug column
 * @method     CampusQuery groupBySchoolId() Group by the school_id column
 * @method     CampusQuery groupBySpideredAt() Group by the spidered_at column
 * @method     CampusQuery groupByTouched() Group by the touched column
 * @method     CampusQuery groupByBId() Group by the b_id column
 * @method     CampusQuery groupByBookstoreType() Group by the bookstore_type column
 * @method     CampusQuery groupById() Group by the id column
 * @method     CampusQuery groupByCreatedAt() Group by the created_at column
 * @method     CampusQuery groupByUpdatedAt() Group by the updated_at column
 *
 * @method     CampusQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     CampusQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     CampusQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     CampusQuery leftJoinSchool($relationAlias = null) Adds a LEFT JOIN clause to the query using the School relation
 * @method     CampusQuery rightJoinSchool($relationAlias = null) Adds a RIGHT JOIN clause to the query using the School relation
 * @method     CampusQuery innerJoinSchool($relationAlias = null) Adds a INNER JOIN clause to the query using the School relation
 *
 * @method     CampusQuery leftJoinTerm($relationAlias = null) Adds a LEFT JOIN clause to the query using the Term relation
 * @method     CampusQuery rightJoinTerm($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Term relation
 * @method     CampusQuery innerJoinTerm($relationAlias = null) Adds a INNER JOIN clause to the query using the Term relation
 *
 * @method     Campus findOne(PropelPDO $con = null) Return the first Campus matching the query
 * @method     Campus findOneOrCreate(PropelPDO $con = null) Return the first Campus matching the query, or a new Campus object populated from the query conditions when no match is found
 *
 * @method     Campus findOneByShallowSpideredAt(string $shallow_spidered_at) Return the first Campus filtered by the shallow_spidered_at column
 * @method     Campus findOneByName(string $name) Return the first Campus filtered by the name column
 * @method     Campus findOneBySlug(string $slug) Return the first Campus filtered by the slug column
 * @method     Campus findOneBySchoolId(int $school_id) Return the first Campus filtered by the school_id column
 * @method     Campus findOneBySpideredAt(string $spidered_at) Return the first Campus filtered by the spidered_at column
 * @method     Campus findOneByTouched(boolean $touched) Return the first Campus filtered by the touched column
 * @method     Campus findOneByBId(string $b_id) Return the first Campus filtered by the b_id column
 * @method     Campus findOneByBookstoreType(string $bookstore_type) Return the first Campus filtered by the bookstore_type column
 * @method     Campus findOneById(int $id) Return the first Campus filtered by the id column
 * @method     Campus findOneByCreatedAt(string $created_at) Return the first Campus filtered by the created_at column
 * @method     Campus findOneByUpdatedAt(string $updated_at) Return the first Campus filtered by the updated_at column
 *
 * @method     array findByShallowSpideredAt(string $shallow_spidered_at) Return Campus objects filtered by the shallow_spidered_at column
 * @method     array findByName(string $name) Return Campus objects filtered by the name column
 * @method     array findBySlug(string $slug) Return Campus objects filtered by the slug column
 * @method     array findBySchoolId(int $school_id) Return Campus objects filtered by the school_id column
 * @method     array findBySpideredAt(string $spidered_at) Return Campus objects filtered by the spidered_at column
 * @method     array findByTouched(boolean $touched) Return Campus objects filtered by the touched column
 * @method     array findByBId(string $b_id) Return Campus objects filtered by the b_id column
 * @method     array findByBookstoreType(string $bookstore_type) Return Campus objects filtered by the bookstore_type column
 * @method     array findById(int $id) Return Campus objects filtered by the id column
 * @method     array findByCreatedAt(string $created_at) Return Campus objects filtered by the created_at column
 * @method     array findByUpdatedAt(string $updated_at) Return Campus objects filtered by the updated_at column
 *
 * @package    propel.generator..om
 */
abstract class BaseCampusQuery extends ModelCriteria
{
	
	/**
	 * Initializes internal state of BaseCampusQuery object.
	 *
	 * @param     string $dbName The dabase name
	 * @param     string $modelName The phpName of a model, e.g. 'Book'
	 * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
	 */
	public function __construct($dbName = GB_DATABASE, $modelName = 'Campus', $modelAlias = null)
	{
		parent::__construct($dbName, $modelName, $modelAlias);
	}

	/**
	 * Returns a new CampusQuery object.
	 *
	 * @param     string $modelAlias The alias of a model in the query
	 * @param     Criteria $criteria Optional Criteria to build the query from
	 *
	 * @return    CampusQuery
	 */
	public static function create($modelAlias = null, $criteria = null)
	{
		if ($criteria instanceof CampusQuery) {
			return $criteria;
		}
		$query = new CampusQuery();
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
	 * @return    Campus|array|mixed the result, formatted by the current formatter
	 */
	public function findPk($key, $con = null)
	{
		if ($key === null) {
			return null;
		}
		if ((null !== ($obj = CampusPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
			// the object is alredy in the instance pool
			return $obj;
		}
		if ($con === null) {
			$con = Propel::getConnection(CampusPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
	 * @return    Campus A model object, or null if the key is not found
	 */
	protected function findPkSimple($key, $con)
	{
		$sql = 'SELECT `SHALLOW_SPIDERED_AT`, `NAME`, `SLUG`, `SCHOOL_ID`, `SPIDERED_AT`, `TOUCHED`, `B_ID`, `BOOKSTORE_TYPE`, `ID`, `CREATED_AT`, `UPDATED_AT` FROM `campus` WHERE `ID` = :p0';
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
			$obj = new Campus();
			$obj->hydrate($row);
			CampusPeer::addInstanceToPool($obj, (string) $key);
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
	 * @return    Campus|array|mixed the result, formatted by the current formatter
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
	 * @return    CampusQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKey($key)
	{
		return $this->addUsingAlias(CampusPeer::ID, $key, Criteria::EQUAL);
	}

	/**
	 * Filter the query by a list of primary keys
	 *
	 * @param     array $keys The list of primary key to use for the query
	 *
	 * @return    CampusQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKeys($keys)
	{
		return $this->addUsingAlias(CampusPeer::ID, $keys, Criteria::IN);
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
	 * @return    CampusQuery The current query, for fluid interface
	 */
	public function filterByShallowSpideredAt($shallowSpideredAt = null, $comparison = null)
	{
		if (is_array($shallowSpideredAt)) {
			$useMinMax = false;
			if (isset($shallowSpideredAt['min'])) {
				$this->addUsingAlias(CampusPeer::SHALLOW_SPIDERED_AT, $shallowSpideredAt['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($shallowSpideredAt['max'])) {
				$this->addUsingAlias(CampusPeer::SHALLOW_SPIDERED_AT, $shallowSpideredAt['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(CampusPeer::SHALLOW_SPIDERED_AT, $shallowSpideredAt, $comparison);
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
	 * @return    CampusQuery The current query, for fluid interface
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
		return $this->addUsingAlias(CampusPeer::NAME, $name, $comparison);
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
	 * @return    CampusQuery The current query, for fluid interface
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
		return $this->addUsingAlias(CampusPeer::SLUG, $slug, $comparison);
	}

	/**
	 * Filter the query on the school_id column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterBySchoolId(1234); // WHERE school_id = 1234
	 * $query->filterBySchoolId(array(12, 34)); // WHERE school_id IN (12, 34)
	 * $query->filterBySchoolId(array('min' => 12)); // WHERE school_id > 12
	 * </code>
	 *
	 * @see       filterBySchool()
	 *
	 * @param     mixed $schoolId The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    CampusQuery The current query, for fluid interface
	 */
	public function filterBySchoolId($schoolId = null, $comparison = null)
	{
		if (is_array($schoolId)) {
			$useMinMax = false;
			if (isset($schoolId['min'])) {
				$this->addUsingAlias(CampusPeer::SCHOOL_ID, $schoolId['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($schoolId['max'])) {
				$this->addUsingAlias(CampusPeer::SCHOOL_ID, $schoolId['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(CampusPeer::SCHOOL_ID, $schoolId, $comparison);
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
	 * @return    CampusQuery The current query, for fluid interface
	 */
	public function filterBySpideredAt($spideredAt = null, $comparison = null)
	{
		if (is_array($spideredAt)) {
			$useMinMax = false;
			if (isset($spideredAt['min'])) {
				$this->addUsingAlias(CampusPeer::SPIDERED_AT, $spideredAt['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($spideredAt['max'])) {
				$this->addUsingAlias(CampusPeer::SPIDERED_AT, $spideredAt['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(CampusPeer::SPIDERED_AT, $spideredAt, $comparison);
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
	 * @return    CampusQuery The current query, for fluid interface
	 */
	public function filterByTouched($touched = null, $comparison = null)
	{
		if (is_string($touched)) {
			$touched = in_array(strtolower($touched), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
		}
		return $this->addUsingAlias(CampusPeer::TOUCHED, $touched, $comparison);
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
	 * @return    CampusQuery The current query, for fluid interface
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
		return $this->addUsingAlias(CampusPeer::B_ID, $bId, $comparison);
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
	 * @return    CampusQuery The current query, for fluid interface
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
		return $this->addUsingAlias(CampusPeer::BOOKSTORE_TYPE, $bookstoreType, $comparison);
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
	 * @return    CampusQuery The current query, for fluid interface
	 */
	public function filterById($id = null, $comparison = null)
	{
		if (is_array($id) && null === $comparison) {
			$comparison = Criteria::IN;
		}
		return $this->addUsingAlias(CampusPeer::ID, $id, $comparison);
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
	 * @return    CampusQuery The current query, for fluid interface
	 */
	public function filterByCreatedAt($createdAt = null, $comparison = null)
	{
		if (is_array($createdAt)) {
			$useMinMax = false;
			if (isset($createdAt['min'])) {
				$this->addUsingAlias(CampusPeer::CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($createdAt['max'])) {
				$this->addUsingAlias(CampusPeer::CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(CampusPeer::CREATED_AT, $createdAt, $comparison);
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
	 * @return    CampusQuery The current query, for fluid interface
	 */
	public function filterByUpdatedAt($updatedAt = null, $comparison = null)
	{
		if (is_array($updatedAt)) {
			$useMinMax = false;
			if (isset($updatedAt['min'])) {
				$this->addUsingAlias(CampusPeer::UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($updatedAt['max'])) {
				$this->addUsingAlias(CampusPeer::UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(CampusPeer::UPDATED_AT, $updatedAt, $comparison);
	}

	/**
	 * Filter the query by a related School object
	 *
	 * @param     School|PropelCollection $school The related object(s) to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    CampusQuery The current query, for fluid interface
	 */
	public function filterBySchool($school, $comparison = null)
	{
		if ($school instanceof School) {
			return $this
				->addUsingAlias(CampusPeer::SCHOOL_ID, $school->getId(), $comparison);
		} elseif ($school instanceof PropelCollection) {
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
			return $this
				->addUsingAlias(CampusPeer::SCHOOL_ID, $school->toKeyValue('PrimaryKey', 'Id'), $comparison);
		} else {
			throw new PropelException('filterBySchool() only accepts arguments of type School or PropelCollection');
		}
	}

	/**
	 * Adds a JOIN clause to the query using the School relation
	 *
	 * @param     string $relationAlias optional alias for the relation
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    CampusQuery The current query, for fluid interface
	 */
	public function joinSchool($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
	{
		$tableMap = $this->getTableMap();
		$relationMap = $tableMap->getRelation('School');

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
			$this->addJoinObject($join, 'School');
		}

		return $this;
	}

	/**
	 * Use the School relation School object
	 *
	 * @see       useQuery()
	 *
	 * @param     string $relationAlias optional alias for the relation,
	 *                                   to be used as main alias in the secondary query
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    SchoolQuery A secondary query class using the current class as primary query
	 */
	public function useSchoolQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
	{
		return $this
			->joinSchool($relationAlias, $joinType)
			->useQuery($relationAlias ? $relationAlias : 'School', 'SchoolQuery');
	}

	/**
	 * Filter the query by a related Term object
	 *
	 * @param     Term $term  the related object to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    CampusQuery The current query, for fluid interface
	 */
	public function filterByTerm($term, $comparison = null)
	{
		if ($term instanceof Term) {
			return $this
				->addUsingAlias(CampusPeer::ID, $term->getCampusId(), $comparison);
		} elseif ($term instanceof PropelCollection) {
			return $this
				->useTermQuery()
				->filterByPrimaryKeys($term->getPrimaryKeys())
				->endUse();
		} else {
			throw new PropelException('filterByTerm() only accepts arguments of type Term or PropelCollection');
		}
	}

	/**
	 * Adds a JOIN clause to the query using the Term relation
	 *
	 * @param     string $relationAlias optional alias for the relation
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    CampusQuery The current query, for fluid interface
	 */
	public function joinTerm($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
	{
		$tableMap = $this->getTableMap();
		$relationMap = $tableMap->getRelation('Term');

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
			$this->addJoinObject($join, 'Term');
		}

		return $this;
	}

	/**
	 * Use the Term relation Term object
	 *
	 * @see       useQuery()
	 *
	 * @param     string $relationAlias optional alias for the relation,
	 *                                   to be used as main alias in the secondary query
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    TermQuery A secondary query class using the current class as primary query
	 */
	public function useTermQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
	{
		return $this
			->joinTerm($relationAlias, $joinType)
			->useQuery($relationAlias ? $relationAlias : 'Term', 'TermQuery');
	}

	/**
	 * Exclude object from result
	 *
	 * @param     Campus $campus Object to remove from the list of results
	 *
	 * @return    CampusQuery The current query, for fluid interface
	 */
	public function prune($campus = null)
	{
		if ($campus) {
			$this->addUsingAlias(CampusPeer::ID, $campus->getId(), Criteria::NOT_EQUAL);
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
		$this->findRelatedSchools($con);

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
		$this->updateRelatedSchools($con);

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
		$this->findRelatedSchools($con);

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
		$this->updateRelatedSchools($con);

		return $this->postUpdate($affectedRows, $con);
	}

	// timestampable behavior
	
	/**
	 * Filter by the latest updated
	 *
	 * @param      int $nbDays Maximum age of the latest update in days
	 *
	 * @return     CampusQuery The current query, for fluid interface
	 */
	public function recentlyUpdated($nbDays = 7)
	{
		return $this->addUsingAlias(CampusPeer::UPDATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);
	}
	
	/**
	 * Filter by the latest created
	 *
	 * @param      int $nbDays Maximum age of in days
	 *
	 * @return     CampusQuery The current query, for fluid interface
	 */
	public function recentlyCreated($nbDays = 7)
	{
		return $this->addUsingAlias(CampusPeer::CREATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);
	}
	
	/**
	 * Order by update date desc
	 *
	 * @return     CampusQuery The current query, for fluid interface
	 */
	public function lastUpdatedFirst()
	{
		return $this->addDescendingOrderByColumn(CampusPeer::UPDATED_AT);
	}
	
	/**
	 * Order by update date asc
	 *
	 * @return     CampusQuery The current query, for fluid interface
	 */
	public function firstUpdatedFirst()
	{
		return $this->addAscendingOrderByColumn(CampusPeer::UPDATED_AT);
	}
	
	/**
	 * Order by create date desc
	 *
	 * @return     CampusQuery The current query, for fluid interface
	 */
	public function lastCreatedFirst()
	{
		return $this->addDescendingOrderByColumn(CampusPeer::CREATED_AT);
	}
	
	/**
	 * Order by create date asc
	 *
	 * @return     CampusQuery The current query, for fluid interface
	 */
	public function firstCreatedFirst()
	{
		return $this->addAscendingOrderByColumn(CampusPeer::CREATED_AT);
	}

	// aggregate_column_relation behavior
	
	/**
	 * Finds the related School objects and keep them for later
	 *
	 * @param PropelPDO $con A connection object
	 */
	protected function findRelatedSchools($con)
	{
		$criteria = clone $this;
		if ($this->useAliasInSQL) {
			$alias = $this->getModelAlias();
			$criteria->removeAlias($alias);
		} else {
			$alias = '';
		}
		$this->schools = SchoolQuery::create()
			->joinCampus($alias)
			->mergeWith($criteria)
			->find($con);
	}
	
	protected function updateRelatedSchools($con)
	{
		foreach ($this->schools as $school) {
			$school->updateNbCampuses($con);
		}
		$this->schools = array();
	}

} // BaseCampusQuery