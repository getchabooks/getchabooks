<?php


/**
 * Base class that represents a query for the 'course' table.
 *
 * 
 *
 * @method     CourseQuery orderByNum($order = Criteria::ASC) Order by the num column
 * @method     CourseQuery orderByNbSections($order = Criteria::ASC) Order by the nb_sections column
 * @method     CourseQuery orderByName($order = Criteria::ASC) Order by the name column
 * @method     CourseQuery orderByDeptId($order = Criteria::ASC) Order by the dept_id column
 * @method     CourseQuery orderBySpideredAt($order = Criteria::ASC) Order by the spidered_at column
 * @method     CourseQuery orderByShallowSpideredAt($order = Criteria::ASC) Order by the shallow_spidered_at column
 * @method     CourseQuery orderByTouched($order = Criteria::ASC) Order by the touched column
 * @method     CourseQuery orderByBId($order = Criteria::ASC) Order by the b_id column
 * @method     CourseQuery orderByBookstoreType($order = Criteria::ASC) Order by the bookstore_type column
 * @method     CourseQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     CourseQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method     CourseQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 *
 * @method     CourseQuery groupByNum() Group by the num column
 * @method     CourseQuery groupByNbSections() Group by the nb_sections column
 * @method     CourseQuery groupByName() Group by the name column
 * @method     CourseQuery groupByDeptId() Group by the dept_id column
 * @method     CourseQuery groupBySpideredAt() Group by the spidered_at column
 * @method     CourseQuery groupByShallowSpideredAt() Group by the shallow_spidered_at column
 * @method     CourseQuery groupByTouched() Group by the touched column
 * @method     CourseQuery groupByBId() Group by the b_id column
 * @method     CourseQuery groupByBookstoreType() Group by the bookstore_type column
 * @method     CourseQuery groupById() Group by the id column
 * @method     CourseQuery groupByCreatedAt() Group by the created_at column
 * @method     CourseQuery groupByUpdatedAt() Group by the updated_at column
 *
 * @method     CourseQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     CourseQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     CourseQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     CourseQuery leftJoinDept($relationAlias = null) Adds a LEFT JOIN clause to the query using the Dept relation
 * @method     CourseQuery rightJoinDept($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Dept relation
 * @method     CourseQuery innerJoinDept($relationAlias = null) Adds a INNER JOIN clause to the query using the Dept relation
 *
 * @method     CourseQuery leftJoinSection($relationAlias = null) Adds a LEFT JOIN clause to the query using the Section relation
 * @method     CourseQuery rightJoinSection($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Section relation
 * @method     CourseQuery innerJoinSection($relationAlias = null) Adds a INNER JOIN clause to the query using the Section relation
 *
 * @method     Course findOne(PropelPDO $con = null) Return the first Course matching the query
 * @method     Course findOneOrCreate(PropelPDO $con = null) Return the first Course matching the query, or a new Course object populated from the query conditions when no match is found
 *
 * @method     Course findOneByNum(string $num) Return the first Course filtered by the num column
 * @method     Course findOneByNbSections(int $nb_sections) Return the first Course filtered by the nb_sections column
 * @method     Course findOneByName(string $name) Return the first Course filtered by the name column
 * @method     Course findOneByDeptId(int $dept_id) Return the first Course filtered by the dept_id column
 * @method     Course findOneBySpideredAt(string $spidered_at) Return the first Course filtered by the spidered_at column
 * @method     Course findOneByShallowSpideredAt(string $shallow_spidered_at) Return the first Course filtered by the shallow_spidered_at column
 * @method     Course findOneByTouched(boolean $touched) Return the first Course filtered by the touched column
 * @method     Course findOneByBId(string $b_id) Return the first Course filtered by the b_id column
 * @method     Course findOneByBookstoreType(string $bookstore_type) Return the first Course filtered by the bookstore_type column
 * @method     Course findOneById(int $id) Return the first Course filtered by the id column
 * @method     Course findOneByCreatedAt(string $created_at) Return the first Course filtered by the created_at column
 * @method     Course findOneByUpdatedAt(string $updated_at) Return the first Course filtered by the updated_at column
 *
 * @method     array findByNum(string $num) Return Course objects filtered by the num column
 * @method     array findByNbSections(int $nb_sections) Return Course objects filtered by the nb_sections column
 * @method     array findByName(string $name) Return Course objects filtered by the name column
 * @method     array findByDeptId(int $dept_id) Return Course objects filtered by the dept_id column
 * @method     array findBySpideredAt(string $spidered_at) Return Course objects filtered by the spidered_at column
 * @method     array findByShallowSpideredAt(string $shallow_spidered_at) Return Course objects filtered by the shallow_spidered_at column
 * @method     array findByTouched(boolean $touched) Return Course objects filtered by the touched column
 * @method     array findByBId(string $b_id) Return Course objects filtered by the b_id column
 * @method     array findByBookstoreType(string $bookstore_type) Return Course objects filtered by the bookstore_type column
 * @method     array findById(int $id) Return Course objects filtered by the id column
 * @method     array findByCreatedAt(string $created_at) Return Course objects filtered by the created_at column
 * @method     array findByUpdatedAt(string $updated_at) Return Course objects filtered by the updated_at column
 *
 * @package    propel.generator..om
 */
abstract class BaseCourseQuery extends ModelCriteria
{
	
	/**
	 * Initializes internal state of BaseCourseQuery object.
	 *
	 * @param     string $dbName The dabase name
	 * @param     string $modelName The phpName of a model, e.g. 'Book'
	 * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
	 */
	public function __construct($dbName = GB_DATABASE, $modelName = 'Course', $modelAlias = null)
	{
		parent::__construct($dbName, $modelName, $modelAlias);
	}

	/**
	 * Returns a new CourseQuery object.
	 *
	 * @param     string $modelAlias The alias of a model in the query
	 * @param     Criteria $criteria Optional Criteria to build the query from
	 *
	 * @return    CourseQuery
	 */
	public static function create($modelAlias = null, $criteria = null)
	{
		if ($criteria instanceof CourseQuery) {
			return $criteria;
		}
		$query = new CourseQuery();
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
	 * @return    Course|array|mixed the result, formatted by the current formatter
	 */
	public function findPk($key, $con = null)
	{
		if ($key === null) {
			return null;
		}
		if ((null !== ($obj = CoursePeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
			// the object is alredy in the instance pool
			return $obj;
		}
		if ($con === null) {
			$con = Propel::getConnection(CoursePeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
	 * @return    Course A model object, or null if the key is not found
	 */
	protected function findPkSimple($key, $con)
	{
		$sql = 'SELECT `NUM`, `NB_SECTIONS`, `NAME`, `DEPT_ID`, `SPIDERED_AT`, `SHALLOW_SPIDERED_AT`, `TOUCHED`, `B_ID`, `BOOKSTORE_TYPE`, `ID`, `CREATED_AT`, `UPDATED_AT` FROM `course` WHERE `ID` = :p0';
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
			$obj = new Course();
			$obj->hydrate($row);
			CoursePeer::addInstanceToPool($obj, (string) $key);
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
	 * @return    Course|array|mixed the result, formatted by the current formatter
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
	 * @return    CourseQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKey($key)
	{
		return $this->addUsingAlias(CoursePeer::ID, $key, Criteria::EQUAL);
	}

	/**
	 * Filter the query by a list of primary keys
	 *
	 * @param     array $keys The list of primary key to use for the query
	 *
	 * @return    CourseQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKeys($keys)
	{
		return $this->addUsingAlias(CoursePeer::ID, $keys, Criteria::IN);
	}

	/**
	 * Filter the query on the num column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByNum('fooValue');   // WHERE num = 'fooValue'
	 * $query->filterByNum('%fooValue%'); // WHERE num LIKE '%fooValue%'
	 * </code>
	 *
	 * @param     string $num The value to use as filter.
	 *              Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    CourseQuery The current query, for fluid interface
	 */
	public function filterByNum($num = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($num)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $num)) {
				$num = str_replace('*', '%', $num);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(CoursePeer::NUM, $num, $comparison);
	}

	/**
	 * Filter the query on the nb_sections column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByNbSections(1234); // WHERE nb_sections = 1234
	 * $query->filterByNbSections(array(12, 34)); // WHERE nb_sections IN (12, 34)
	 * $query->filterByNbSections(array('min' => 12)); // WHERE nb_sections > 12
	 * </code>
	 *
	 * @param     mixed $nbSections The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    CourseQuery The current query, for fluid interface
	 */
	public function filterByNbSections($nbSections = null, $comparison = null)
	{
		if (is_array($nbSections)) {
			$useMinMax = false;
			if (isset($nbSections['min'])) {
				$this->addUsingAlias(CoursePeer::NB_SECTIONS, $nbSections['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($nbSections['max'])) {
				$this->addUsingAlias(CoursePeer::NB_SECTIONS, $nbSections['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(CoursePeer::NB_SECTIONS, $nbSections, $comparison);
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
	 * @return    CourseQuery The current query, for fluid interface
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
		return $this->addUsingAlias(CoursePeer::NAME, $name, $comparison);
	}

	/**
	 * Filter the query on the dept_id column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByDeptId(1234); // WHERE dept_id = 1234
	 * $query->filterByDeptId(array(12, 34)); // WHERE dept_id IN (12, 34)
	 * $query->filterByDeptId(array('min' => 12)); // WHERE dept_id > 12
	 * </code>
	 *
	 * @see       filterByDept()
	 *
	 * @param     mixed $deptId The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    CourseQuery The current query, for fluid interface
	 */
	public function filterByDeptId($deptId = null, $comparison = null)
	{
		if (is_array($deptId)) {
			$useMinMax = false;
			if (isset($deptId['min'])) {
				$this->addUsingAlias(CoursePeer::DEPT_ID, $deptId['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($deptId['max'])) {
				$this->addUsingAlias(CoursePeer::DEPT_ID, $deptId['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(CoursePeer::DEPT_ID, $deptId, $comparison);
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
	 * @return    CourseQuery The current query, for fluid interface
	 */
	public function filterBySpideredAt($spideredAt = null, $comparison = null)
	{
		if (is_array($spideredAt)) {
			$useMinMax = false;
			if (isset($spideredAt['min'])) {
				$this->addUsingAlias(CoursePeer::SPIDERED_AT, $spideredAt['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($spideredAt['max'])) {
				$this->addUsingAlias(CoursePeer::SPIDERED_AT, $spideredAt['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(CoursePeer::SPIDERED_AT, $spideredAt, $comparison);
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
	 * @return    CourseQuery The current query, for fluid interface
	 */
	public function filterByShallowSpideredAt($shallowSpideredAt = null, $comparison = null)
	{
		if (is_array($shallowSpideredAt)) {
			$useMinMax = false;
			if (isset($shallowSpideredAt['min'])) {
				$this->addUsingAlias(CoursePeer::SHALLOW_SPIDERED_AT, $shallowSpideredAt['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($shallowSpideredAt['max'])) {
				$this->addUsingAlias(CoursePeer::SHALLOW_SPIDERED_AT, $shallowSpideredAt['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(CoursePeer::SHALLOW_SPIDERED_AT, $shallowSpideredAt, $comparison);
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
	 * @return    CourseQuery The current query, for fluid interface
	 */
	public function filterByTouched($touched = null, $comparison = null)
	{
		if (is_string($touched)) {
			$touched = in_array(strtolower($touched), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
		}
		return $this->addUsingAlias(CoursePeer::TOUCHED, $touched, $comparison);
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
	 * @return    CourseQuery The current query, for fluid interface
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
		return $this->addUsingAlias(CoursePeer::B_ID, $bId, $comparison);
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
	 * @return    CourseQuery The current query, for fluid interface
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
		return $this->addUsingAlias(CoursePeer::BOOKSTORE_TYPE, $bookstoreType, $comparison);
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
	 * @return    CourseQuery The current query, for fluid interface
	 */
	public function filterById($id = null, $comparison = null)
	{
		if (is_array($id) && null === $comparison) {
			$comparison = Criteria::IN;
		}
		return $this->addUsingAlias(CoursePeer::ID, $id, $comparison);
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
	 * @return    CourseQuery The current query, for fluid interface
	 */
	public function filterByCreatedAt($createdAt = null, $comparison = null)
	{
		if (is_array($createdAt)) {
			$useMinMax = false;
			if (isset($createdAt['min'])) {
				$this->addUsingAlias(CoursePeer::CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($createdAt['max'])) {
				$this->addUsingAlias(CoursePeer::CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(CoursePeer::CREATED_AT, $createdAt, $comparison);
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
	 * @return    CourseQuery The current query, for fluid interface
	 */
	public function filterByUpdatedAt($updatedAt = null, $comparison = null)
	{
		if (is_array($updatedAt)) {
			$useMinMax = false;
			if (isset($updatedAt['min'])) {
				$this->addUsingAlias(CoursePeer::UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($updatedAt['max'])) {
				$this->addUsingAlias(CoursePeer::UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(CoursePeer::UPDATED_AT, $updatedAt, $comparison);
	}

	/**
	 * Filter the query by a related Dept object
	 *
	 * @param     Dept|PropelCollection $dept The related object(s) to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    CourseQuery The current query, for fluid interface
	 */
	public function filterByDept($dept, $comparison = null)
	{
		if ($dept instanceof Dept) {
			return $this
				->addUsingAlias(CoursePeer::DEPT_ID, $dept->getId(), $comparison);
		} elseif ($dept instanceof PropelCollection) {
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
			return $this
				->addUsingAlias(CoursePeer::DEPT_ID, $dept->toKeyValue('PrimaryKey', 'Id'), $comparison);
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
	 * @return    CourseQuery The current query, for fluid interface
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
	 * Filter the query by a related Section object
	 *
	 * @param     Section $section  the related object to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    CourseQuery The current query, for fluid interface
	 */
	public function filterBySection($section, $comparison = null)
	{
		if ($section instanceof Section) {
			return $this
				->addUsingAlias(CoursePeer::ID, $section->getCourseId(), $comparison);
		} elseif ($section instanceof PropelCollection) {
			return $this
				->useSectionQuery()
				->filterByPrimaryKeys($section->getPrimaryKeys())
				->endUse();
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
	 * @return    CourseQuery The current query, for fluid interface
	 */
	public function joinSection($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
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
	public function useSectionQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
	{
		return $this
			->joinSection($relationAlias, $joinType)
			->useQuery($relationAlias ? $relationAlias : 'Section', 'SectionQuery');
	}

	/**
	 * Exclude object from result
	 *
	 * @param     Course $course Object to remove from the list of results
	 *
	 * @return    CourseQuery The current query, for fluid interface
	 */
	public function prune($course = null)
	{
		if ($course) {
			$this->addUsingAlias(CoursePeer::ID, $course->getId(), Criteria::NOT_EQUAL);
		}

		return $this;
	}

	// timestampable behavior
	
	/**
	 * Filter by the latest updated
	 *
	 * @param      int $nbDays Maximum age of the latest update in days
	 *
	 * @return     CourseQuery The current query, for fluid interface
	 */
	public function recentlyUpdated($nbDays = 7)
	{
		return $this->addUsingAlias(CoursePeer::UPDATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);
	}
	
	/**
	 * Filter by the latest created
	 *
	 * @param      int $nbDays Maximum age of in days
	 *
	 * @return     CourseQuery The current query, for fluid interface
	 */
	public function recentlyCreated($nbDays = 7)
	{
		return $this->addUsingAlias(CoursePeer::CREATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);
	}
	
	/**
	 * Order by update date desc
	 *
	 * @return     CourseQuery The current query, for fluid interface
	 */
	public function lastUpdatedFirst()
	{
		return $this->addDescendingOrderByColumn(CoursePeer::UPDATED_AT);
	}
	
	/**
	 * Order by update date asc
	 *
	 * @return     CourseQuery The current query, for fluid interface
	 */
	public function firstUpdatedFirst()
	{
		return $this->addAscendingOrderByColumn(CoursePeer::UPDATED_AT);
	}
	
	/**
	 * Order by create date desc
	 *
	 * @return     CourseQuery The current query, for fluid interface
	 */
	public function lastCreatedFirst()
	{
		return $this->addDescendingOrderByColumn(CoursePeer::CREATED_AT);
	}
	
	/**
	 * Order by create date asc
	 *
	 * @return     CourseQuery The current query, for fluid interface
	 */
	public function firstCreatedFirst()
	{
		return $this->addAscendingOrderByColumn(CoursePeer::CREATED_AT);
	}

} // BaseCourseQuery