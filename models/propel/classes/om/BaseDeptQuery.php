<?php


/**
 * Base class that represents a query for the 'dept' table.
 *
 * 
 *
 * @method     DeptQuery orderByAbbr($order = Criteria::ASC) Order by the abbr column
 * @method     DeptQuery orderByName($order = Criteria::ASC) Order by the name column
 * @method     DeptQuery orderByTermId($order = Criteria::ASC) Order by the term_id column
 * @method     DeptQuery orderBySpideredAt($order = Criteria::ASC) Order by the spidered_at column
 * @method     DeptQuery orderByShallowSpideredAt($order = Criteria::ASC) Order by the shallow_spidered_at column
 * @method     DeptQuery orderByTouched($order = Criteria::ASC) Order by the touched column
 * @method     DeptQuery orderByBId($order = Criteria::ASC) Order by the b_id column
 * @method     DeptQuery orderByBookstoreType($order = Criteria::ASC) Order by the bookstore_type column
 * @method     DeptQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     DeptQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method     DeptQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 *
 * @method     DeptQuery groupByAbbr() Group by the abbr column
 * @method     DeptQuery groupByName() Group by the name column
 * @method     DeptQuery groupByTermId() Group by the term_id column
 * @method     DeptQuery groupBySpideredAt() Group by the spidered_at column
 * @method     DeptQuery groupByShallowSpideredAt() Group by the shallow_spidered_at column
 * @method     DeptQuery groupByTouched() Group by the touched column
 * @method     DeptQuery groupByBId() Group by the b_id column
 * @method     DeptQuery groupByBookstoreType() Group by the bookstore_type column
 * @method     DeptQuery groupById() Group by the id column
 * @method     DeptQuery groupByCreatedAt() Group by the created_at column
 * @method     DeptQuery groupByUpdatedAt() Group by the updated_at column
 *
 * @method     DeptQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     DeptQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     DeptQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     DeptQuery leftJoinTerm($relationAlias = null) Adds a LEFT JOIN clause to the query using the Term relation
 * @method     DeptQuery rightJoinTerm($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Term relation
 * @method     DeptQuery innerJoinTerm($relationAlias = null) Adds a INNER JOIN clause to the query using the Term relation
 *
 * @method     DeptQuery leftJoinCourse($relationAlias = null) Adds a LEFT JOIN clause to the query using the Course relation
 * @method     DeptQuery rightJoinCourse($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Course relation
 * @method     DeptQuery innerJoinCourse($relationAlias = null) Adds a INNER JOIN clause to the query using the Course relation
 *
 * @method     Dept findOne(PropelPDO $con = null) Return the first Dept matching the query
 * @method     Dept findOneOrCreate(PropelPDO $con = null) Return the first Dept matching the query, or a new Dept object populated from the query conditions when no match is found
 *
 * @method     Dept findOneByAbbr(string $abbr) Return the first Dept filtered by the abbr column
 * @method     Dept findOneByName(string $name) Return the first Dept filtered by the name column
 * @method     Dept findOneByTermId(int $term_id) Return the first Dept filtered by the term_id column
 * @method     Dept findOneBySpideredAt(string $spidered_at) Return the first Dept filtered by the spidered_at column
 * @method     Dept findOneByShallowSpideredAt(string $shallow_spidered_at) Return the first Dept filtered by the shallow_spidered_at column
 * @method     Dept findOneByTouched(boolean $touched) Return the first Dept filtered by the touched column
 * @method     Dept findOneByBId(string $b_id) Return the first Dept filtered by the b_id column
 * @method     Dept findOneByBookstoreType(string $bookstore_type) Return the first Dept filtered by the bookstore_type column
 * @method     Dept findOneById(int $id) Return the first Dept filtered by the id column
 * @method     Dept findOneByCreatedAt(string $created_at) Return the first Dept filtered by the created_at column
 * @method     Dept findOneByUpdatedAt(string $updated_at) Return the first Dept filtered by the updated_at column
 *
 * @method     array findByAbbr(string $abbr) Return Dept objects filtered by the abbr column
 * @method     array findByName(string $name) Return Dept objects filtered by the name column
 * @method     array findByTermId(int $term_id) Return Dept objects filtered by the term_id column
 * @method     array findBySpideredAt(string $spidered_at) Return Dept objects filtered by the spidered_at column
 * @method     array findByShallowSpideredAt(string $shallow_spidered_at) Return Dept objects filtered by the shallow_spidered_at column
 * @method     array findByTouched(boolean $touched) Return Dept objects filtered by the touched column
 * @method     array findByBId(string $b_id) Return Dept objects filtered by the b_id column
 * @method     array findByBookstoreType(string $bookstore_type) Return Dept objects filtered by the bookstore_type column
 * @method     array findById(int $id) Return Dept objects filtered by the id column
 * @method     array findByCreatedAt(string $created_at) Return Dept objects filtered by the created_at column
 * @method     array findByUpdatedAt(string $updated_at) Return Dept objects filtered by the updated_at column
 *
 * @package    propel.generator..om
 */
abstract class BaseDeptQuery extends ModelCriteria
{
	
	/**
	 * Initializes internal state of BaseDeptQuery object.
	 *
	 * @param     string $dbName The dabase name
	 * @param     string $modelName The phpName of a model, e.g. 'Book'
	 * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
	 */
	public function __construct($dbName = GB_DATABASE, $modelName = 'Dept', $modelAlias = null)
	{
		parent::__construct($dbName, $modelName, $modelAlias);
	}

	/**
	 * Returns a new DeptQuery object.
	 *
	 * @param     string $modelAlias The alias of a model in the query
	 * @param     Criteria $criteria Optional Criteria to build the query from
	 *
	 * @return    DeptQuery
	 */
	public static function create($modelAlias = null, $criteria = null)
	{
		if ($criteria instanceof DeptQuery) {
			return $criteria;
		}
		$query = new DeptQuery();
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
	 * @return    Dept|array|mixed the result, formatted by the current formatter
	 */
	public function findPk($key, $con = null)
	{
		if ($key === null) {
			return null;
		}
		if ((null !== ($obj = DeptPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
			// the object is alredy in the instance pool
			return $obj;
		}
		if ($con === null) {
			$con = Propel::getConnection(DeptPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
	 * @return    Dept A model object, or null if the key is not found
	 */
	protected function findPkSimple($key, $con)
	{
		$sql = 'SELECT `ABBR`, `NAME`, `TERM_ID`, `SPIDERED_AT`, `SHALLOW_SPIDERED_AT`, `TOUCHED`, `B_ID`, `BOOKSTORE_TYPE`, `ID`, `CREATED_AT`, `UPDATED_AT` FROM `dept` WHERE `ID` = :p0';
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
			$obj = new Dept();
			$obj->hydrate($row);
			DeptPeer::addInstanceToPool($obj, (string) $key);
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
	 * @return    Dept|array|mixed the result, formatted by the current formatter
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
	 * @return    DeptQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKey($key)
	{
		return $this->addUsingAlias(DeptPeer::ID, $key, Criteria::EQUAL);
	}

	/**
	 * Filter the query by a list of primary keys
	 *
	 * @param     array $keys The list of primary key to use for the query
	 *
	 * @return    DeptQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKeys($keys)
	{
		return $this->addUsingAlias(DeptPeer::ID, $keys, Criteria::IN);
	}

	/**
	 * Filter the query on the abbr column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByAbbr('fooValue');   // WHERE abbr = 'fooValue'
	 * $query->filterByAbbr('%fooValue%'); // WHERE abbr LIKE '%fooValue%'
	 * </code>
	 *
	 * @param     string $abbr The value to use as filter.
	 *              Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    DeptQuery The current query, for fluid interface
	 */
	public function filterByAbbr($abbr = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($abbr)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $abbr)) {
				$abbr = str_replace('*', '%', $abbr);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(DeptPeer::ABBR, $abbr, $comparison);
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
	 * @return    DeptQuery The current query, for fluid interface
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
		return $this->addUsingAlias(DeptPeer::NAME, $name, $comparison);
	}

	/**
	 * Filter the query on the term_id column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByTermId(1234); // WHERE term_id = 1234
	 * $query->filterByTermId(array(12, 34)); // WHERE term_id IN (12, 34)
	 * $query->filterByTermId(array('min' => 12)); // WHERE term_id > 12
	 * </code>
	 *
	 * @see       filterByTerm()
	 *
	 * @param     mixed $termId The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    DeptQuery The current query, for fluid interface
	 */
	public function filterByTermId($termId = null, $comparison = null)
	{
		if (is_array($termId)) {
			$useMinMax = false;
			if (isset($termId['min'])) {
				$this->addUsingAlias(DeptPeer::TERM_ID, $termId['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($termId['max'])) {
				$this->addUsingAlias(DeptPeer::TERM_ID, $termId['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(DeptPeer::TERM_ID, $termId, $comparison);
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
	 * @return    DeptQuery The current query, for fluid interface
	 */
	public function filterBySpideredAt($spideredAt = null, $comparison = null)
	{
		if (is_array($spideredAt)) {
			$useMinMax = false;
			if (isset($spideredAt['min'])) {
				$this->addUsingAlias(DeptPeer::SPIDERED_AT, $spideredAt['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($spideredAt['max'])) {
				$this->addUsingAlias(DeptPeer::SPIDERED_AT, $spideredAt['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(DeptPeer::SPIDERED_AT, $spideredAt, $comparison);
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
	 * @return    DeptQuery The current query, for fluid interface
	 */
	public function filterByShallowSpideredAt($shallowSpideredAt = null, $comparison = null)
	{
		if (is_array($shallowSpideredAt)) {
			$useMinMax = false;
			if (isset($shallowSpideredAt['min'])) {
				$this->addUsingAlias(DeptPeer::SHALLOW_SPIDERED_AT, $shallowSpideredAt['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($shallowSpideredAt['max'])) {
				$this->addUsingAlias(DeptPeer::SHALLOW_SPIDERED_AT, $shallowSpideredAt['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(DeptPeer::SHALLOW_SPIDERED_AT, $shallowSpideredAt, $comparison);
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
	 * @return    DeptQuery The current query, for fluid interface
	 */
	public function filterByTouched($touched = null, $comparison = null)
	{
		if (is_string($touched)) {
			$touched = in_array(strtolower($touched), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
		}
		return $this->addUsingAlias(DeptPeer::TOUCHED, $touched, $comparison);
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
	 * @return    DeptQuery The current query, for fluid interface
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
		return $this->addUsingAlias(DeptPeer::B_ID, $bId, $comparison);
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
	 * @return    DeptQuery The current query, for fluid interface
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
		return $this->addUsingAlias(DeptPeer::BOOKSTORE_TYPE, $bookstoreType, $comparison);
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
	 * @return    DeptQuery The current query, for fluid interface
	 */
	public function filterById($id = null, $comparison = null)
	{
		if (is_array($id) && null === $comparison) {
			$comparison = Criteria::IN;
		}
		return $this->addUsingAlias(DeptPeer::ID, $id, $comparison);
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
	 * @return    DeptQuery The current query, for fluid interface
	 */
	public function filterByCreatedAt($createdAt = null, $comparison = null)
	{
		if (is_array($createdAt)) {
			$useMinMax = false;
			if (isset($createdAt['min'])) {
				$this->addUsingAlias(DeptPeer::CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($createdAt['max'])) {
				$this->addUsingAlias(DeptPeer::CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(DeptPeer::CREATED_AT, $createdAt, $comparison);
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
	 * @return    DeptQuery The current query, for fluid interface
	 */
	public function filterByUpdatedAt($updatedAt = null, $comparison = null)
	{
		if (is_array($updatedAt)) {
			$useMinMax = false;
			if (isset($updatedAt['min'])) {
				$this->addUsingAlias(DeptPeer::UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($updatedAt['max'])) {
				$this->addUsingAlias(DeptPeer::UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(DeptPeer::UPDATED_AT, $updatedAt, $comparison);
	}

	/**
	 * Filter the query by a related Term object
	 *
	 * @param     Term|PropelCollection $term The related object(s) to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    DeptQuery The current query, for fluid interface
	 */
	public function filterByTerm($term, $comparison = null)
	{
		if ($term instanceof Term) {
			return $this
				->addUsingAlias(DeptPeer::TERM_ID, $term->getId(), $comparison);
		} elseif ($term instanceof PropelCollection) {
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
			return $this
				->addUsingAlias(DeptPeer::TERM_ID, $term->toKeyValue('PrimaryKey', 'Id'), $comparison);
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
	 * @return    DeptQuery The current query, for fluid interface
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
	 * Filter the query by a related Course object
	 *
	 * @param     Course $course  the related object to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    DeptQuery The current query, for fluid interface
	 */
	public function filterByCourse($course, $comparison = null)
	{
		if ($course instanceof Course) {
			return $this
				->addUsingAlias(DeptPeer::ID, $course->getDeptId(), $comparison);
		} elseif ($course instanceof PropelCollection) {
			return $this
				->useCourseQuery()
				->filterByPrimaryKeys($course->getPrimaryKeys())
				->endUse();
		} else {
			throw new PropelException('filterByCourse() only accepts arguments of type Course or PropelCollection');
		}
	}

	/**
	 * Adds a JOIN clause to the query using the Course relation
	 *
	 * @param     string $relationAlias optional alias for the relation
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    DeptQuery The current query, for fluid interface
	 */
	public function joinCourse($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
	{
		$tableMap = $this->getTableMap();
		$relationMap = $tableMap->getRelation('Course');

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
			$this->addJoinObject($join, 'Course');
		}

		return $this;
	}

	/**
	 * Use the Course relation Course object
	 *
	 * @see       useQuery()
	 *
	 * @param     string $relationAlias optional alias for the relation,
	 *                                   to be used as main alias in the secondary query
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    CourseQuery A secondary query class using the current class as primary query
	 */
	public function useCourseQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
	{
		return $this
			->joinCourse($relationAlias, $joinType)
			->useQuery($relationAlias ? $relationAlias : 'Course', 'CourseQuery');
	}

	/**
	 * Exclude object from result
	 *
	 * @param     Dept $dept Object to remove from the list of results
	 *
	 * @return    DeptQuery The current query, for fluid interface
	 */
	public function prune($dept = null)
	{
		if ($dept) {
			$this->addUsingAlias(DeptPeer::ID, $dept->getId(), Criteria::NOT_EQUAL);
		}

		return $this;
	}

	// timestampable behavior
	
	/**
	 * Filter by the latest updated
	 *
	 * @param      int $nbDays Maximum age of the latest update in days
	 *
	 * @return     DeptQuery The current query, for fluid interface
	 */
	public function recentlyUpdated($nbDays = 7)
	{
		return $this->addUsingAlias(DeptPeer::UPDATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);
	}
	
	/**
	 * Filter by the latest created
	 *
	 * @param      int $nbDays Maximum age of in days
	 *
	 * @return     DeptQuery The current query, for fluid interface
	 */
	public function recentlyCreated($nbDays = 7)
	{
		return $this->addUsingAlias(DeptPeer::CREATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);
	}
	
	/**
	 * Order by update date desc
	 *
	 * @return     DeptQuery The current query, for fluid interface
	 */
	public function lastUpdatedFirst()
	{
		return $this->addDescendingOrderByColumn(DeptPeer::UPDATED_AT);
	}
	
	/**
	 * Order by update date asc
	 *
	 * @return     DeptQuery The current query, for fluid interface
	 */
	public function firstUpdatedFirst()
	{
		return $this->addAscendingOrderByColumn(DeptPeer::UPDATED_AT);
	}
	
	/**
	 * Order by create date desc
	 *
	 * @return     DeptQuery The current query, for fluid interface
	 */
	public function lastCreatedFirst()
	{
		return $this->addDescendingOrderByColumn(DeptPeer::CREATED_AT);
	}
	
	/**
	 * Order by create date asc
	 *
	 * @return     DeptQuery The current query, for fluid interface
	 */
	public function firstCreatedFirst()
	{
		return $this->addAscendingOrderByColumn(DeptPeer::CREATED_AT);
	}

} // BaseDeptQuery