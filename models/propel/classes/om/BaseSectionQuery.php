<?php


/**
 * Base class that represents a query for the 'section' table.
 *
 * 
 *
 * @method     SectionQuery orderByNum($order = Criteria::ASC) Order by the num column
 * @method     SectionQuery orderByRequiresBooks($order = Criteria::ASC) Order by the requires_books column
 * @method     SectionQuery orderByName($order = Criteria::ASC) Order by the name column
 * @method     SectionQuery orderBySlug($order = Criteria::ASC) Order by the slug column
 * @method     SectionQuery orderBySchoolSlug($order = Criteria::ASC) Order by the school_slug column
 * @method     SectionQuery orderByCampusSlug($order = Criteria::ASC) Order by the campus_slug column
 * @method     SectionQuery orderByTermSlug($order = Criteria::ASC) Order by the term_slug column
 * @method     SectionQuery orderByFId($order = Criteria::ASC) Order by the f_id column
 * @method     SectionQuery orderByNbItems($order = Criteria::ASC) Order by the nb_items column
 * @method     SectionQuery orderByProfessor($order = Criteria::ASC) Order by the professor column
 * @method     SectionQuery orderByCourseId($order = Criteria::ASC) Order by the course_id column
 * @method     SectionQuery orderBySpideredAt($order = Criteria::ASC) Order by the spidered_at column
 * @method     SectionQuery orderByShallowSpideredAt($order = Criteria::ASC) Order by the shallow_spidered_at column
 * @method     SectionQuery orderByTouched($order = Criteria::ASC) Order by the touched column
 * @method     SectionQuery orderByBId($order = Criteria::ASC) Order by the b_id column
 * @method     SectionQuery orderByBookstoreType($order = Criteria::ASC) Order by the bookstore_type column
 * @method     SectionQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     SectionQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method     SectionQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 *
 * @method     SectionQuery groupByNum() Group by the num column
 * @method     SectionQuery groupByRequiresBooks() Group by the requires_books column
 * @method     SectionQuery groupByName() Group by the name column
 * @method     SectionQuery groupBySlug() Group by the slug column
 * @method     SectionQuery groupBySchoolSlug() Group by the school_slug column
 * @method     SectionQuery groupByCampusSlug() Group by the campus_slug column
 * @method     SectionQuery groupByTermSlug() Group by the term_slug column
 * @method     SectionQuery groupByFId() Group by the f_id column
 * @method     SectionQuery groupByNbItems() Group by the nb_items column
 * @method     SectionQuery groupByProfessor() Group by the professor column
 * @method     SectionQuery groupByCourseId() Group by the course_id column
 * @method     SectionQuery groupBySpideredAt() Group by the spidered_at column
 * @method     SectionQuery groupByShallowSpideredAt() Group by the shallow_spidered_at column
 * @method     SectionQuery groupByTouched() Group by the touched column
 * @method     SectionQuery groupByBId() Group by the b_id column
 * @method     SectionQuery groupByBookstoreType() Group by the bookstore_type column
 * @method     SectionQuery groupById() Group by the id column
 * @method     SectionQuery groupByCreatedAt() Group by the created_at column
 * @method     SectionQuery groupByUpdatedAt() Group by the updated_at column
 *
 * @method     SectionQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     SectionQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     SectionQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     SectionQuery leftJoinCourse($relationAlias = null) Adds a LEFT JOIN clause to the query using the Course relation
 * @method     SectionQuery rightJoinCourse($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Course relation
 * @method     SectionQuery innerJoinCourse($relationAlias = null) Adds a INNER JOIN clause to the query using the Course relation
 *
 * @method     SectionQuery leftJoinSectionHasItem($relationAlias = null) Adds a LEFT JOIN clause to the query using the SectionHasItem relation
 * @method     SectionQuery rightJoinSectionHasItem($relationAlias = null) Adds a RIGHT JOIN clause to the query using the SectionHasItem relation
 * @method     SectionQuery innerJoinSectionHasItem($relationAlias = null) Adds a INNER JOIN clause to the query using the SectionHasItem relation
 *
 * @method     Section findOne(PropelPDO $con = null) Return the first Section matching the query
 * @method     Section findOneOrCreate(PropelPDO $con = null) Return the first Section matching the query, or a new Section object populated from the query conditions when no match is found
 *
 * @method     Section findOneByNum(string $num) Return the first Section filtered by the num column
 * @method     Section findOneByRequiresBooks(boolean $requires_books) Return the first Section filtered by the requires_books column
 * @method     Section findOneByName(string $name) Return the first Section filtered by the name column
 * @method     Section findOneBySlug(string $slug) Return the first Section filtered by the slug column
 * @method     Section findOneBySchoolSlug(string $school_slug) Return the first Section filtered by the school_slug column
 * @method     Section findOneByCampusSlug(string $campus_slug) Return the first Section filtered by the campus_slug column
 * @method     Section findOneByTermSlug(string $term_slug) Return the first Section filtered by the term_slug column
 * @method     Section findOneByFId(string $f_id) Return the first Section filtered by the f_id column
 * @method     Section findOneByNbItems(int $nb_items) Return the first Section filtered by the nb_items column
 * @method     Section findOneByProfessor(string $professor) Return the first Section filtered by the professor column
 * @method     Section findOneByCourseId(int $course_id) Return the first Section filtered by the course_id column
 * @method     Section findOneBySpideredAt(string $spidered_at) Return the first Section filtered by the spidered_at column
 * @method     Section findOneByShallowSpideredAt(string $shallow_spidered_at) Return the first Section filtered by the shallow_spidered_at column
 * @method     Section findOneByTouched(boolean $touched) Return the first Section filtered by the touched column
 * @method     Section findOneByBId(string $b_id) Return the first Section filtered by the b_id column
 * @method     Section findOneByBookstoreType(string $bookstore_type) Return the first Section filtered by the bookstore_type column
 * @method     Section findOneById(int $id) Return the first Section filtered by the id column
 * @method     Section findOneByCreatedAt(string $created_at) Return the first Section filtered by the created_at column
 * @method     Section findOneByUpdatedAt(string $updated_at) Return the first Section filtered by the updated_at column
 *
 * @method     array findByNum(string $num) Return Section objects filtered by the num column
 * @method     array findByRequiresBooks(boolean $requires_books) Return Section objects filtered by the requires_books column
 * @method     array findByName(string $name) Return Section objects filtered by the name column
 * @method     array findBySlug(string $slug) Return Section objects filtered by the slug column
 * @method     array findBySchoolSlug(string $school_slug) Return Section objects filtered by the school_slug column
 * @method     array findByCampusSlug(string $campus_slug) Return Section objects filtered by the campus_slug column
 * @method     array findByTermSlug(string $term_slug) Return Section objects filtered by the term_slug column
 * @method     array findByFId(string $f_id) Return Section objects filtered by the f_id column
 * @method     array findByNbItems(int $nb_items) Return Section objects filtered by the nb_items column
 * @method     array findByProfessor(string $professor) Return Section objects filtered by the professor column
 * @method     array findByCourseId(int $course_id) Return Section objects filtered by the course_id column
 * @method     array findBySpideredAt(string $spidered_at) Return Section objects filtered by the spidered_at column
 * @method     array findByShallowSpideredAt(string $shallow_spidered_at) Return Section objects filtered by the shallow_spidered_at column
 * @method     array findByTouched(boolean $touched) Return Section objects filtered by the touched column
 * @method     array findByBId(string $b_id) Return Section objects filtered by the b_id column
 * @method     array findByBookstoreType(string $bookstore_type) Return Section objects filtered by the bookstore_type column
 * @method     array findById(int $id) Return Section objects filtered by the id column
 * @method     array findByCreatedAt(string $created_at) Return Section objects filtered by the created_at column
 * @method     array findByUpdatedAt(string $updated_at) Return Section objects filtered by the updated_at column
 *
 * @package    propel.generator..om
 */
abstract class BaseSectionQuery extends ModelCriteria
{
	
	/**
	 * Initializes internal state of BaseSectionQuery object.
	 *
	 * @param     string $dbName The dabase name
	 * @param     string $modelName The phpName of a model, e.g. 'Book'
	 * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
	 */
	public function __construct($dbName = GB_DATABASE, $modelName = 'Section', $modelAlias = null)
	{
		parent::__construct($dbName, $modelName, $modelAlias);
	}

	/**
	 * Returns a new SectionQuery object.
	 *
	 * @param     string $modelAlias The alias of a model in the query
	 * @param     Criteria $criteria Optional Criteria to build the query from
	 *
	 * @return    SectionQuery
	 */
	public static function create($modelAlias = null, $criteria = null)
	{
		if ($criteria instanceof SectionQuery) {
			return $criteria;
		}
		$query = new SectionQuery();
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
	 * @return    Section|array|mixed the result, formatted by the current formatter
	 */
	public function findPk($key, $con = null)
	{
		if ($key === null) {
			return null;
		}
		if ((null !== ($obj = SectionPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
			// the object is alredy in the instance pool
			return $obj;
		}
		if ($con === null) {
			$con = Propel::getConnection(SectionPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
	 * @return    Section A model object, or null if the key is not found
	 */
	protected function findPkSimple($key, $con)
	{
		$sql = 'SELECT `NUM`, `REQUIRES_BOOKS`, `NAME`, `SLUG`, `SCHOOL_SLUG`, `CAMPUS_SLUG`, `TERM_SLUG`, `F_ID`, `NB_ITEMS`, `PROFESSOR`, `COURSE_ID`, `SPIDERED_AT`, `SHALLOW_SPIDERED_AT`, `TOUCHED`, `B_ID`, `BOOKSTORE_TYPE`, `ID`, `CREATED_AT`, `UPDATED_AT` FROM `section` WHERE `ID` = :p0';
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
			$obj = new Section();
			$obj->hydrate($row);
			SectionPeer::addInstanceToPool($obj, (string) $key);
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
	 * @return    Section|array|mixed the result, formatted by the current formatter
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
	 * @return    SectionQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKey($key)
	{
		return $this->addUsingAlias(SectionPeer::ID, $key, Criteria::EQUAL);
	}

	/**
	 * Filter the query by a list of primary keys
	 *
	 * @param     array $keys The list of primary key to use for the query
	 *
	 * @return    SectionQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKeys($keys)
	{
		return $this->addUsingAlias(SectionPeer::ID, $keys, Criteria::IN);
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
	 * @return    SectionQuery The current query, for fluid interface
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
		return $this->addUsingAlias(SectionPeer::NUM, $num, $comparison);
	}

	/**
	 * Filter the query on the requires_books column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByRequiresBooks(true); // WHERE requires_books = true
	 * $query->filterByRequiresBooks('yes'); // WHERE requires_books = true
	 * </code>
	 *
	 * @param     boolean|string $requiresBooks The value to use as filter.
	 *              Non-boolean arguments are converted using the following rules:
	 *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
	 *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
	 *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    SectionQuery The current query, for fluid interface
	 */
	public function filterByRequiresBooks($requiresBooks = null, $comparison = null)
	{
		if (is_string($requiresBooks)) {
			$requires_books = in_array(strtolower($requiresBooks), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
		}
		return $this->addUsingAlias(SectionPeer::REQUIRES_BOOKS, $requiresBooks, $comparison);
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
	 * @return    SectionQuery The current query, for fluid interface
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
		return $this->addUsingAlias(SectionPeer::NAME, $name, $comparison);
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
	 * @return    SectionQuery The current query, for fluid interface
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
		return $this->addUsingAlias(SectionPeer::SLUG, $slug, $comparison);
	}

	/**
	 * Filter the query on the school_slug column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterBySchoolSlug('fooValue');   // WHERE school_slug = 'fooValue'
	 * $query->filterBySchoolSlug('%fooValue%'); // WHERE school_slug LIKE '%fooValue%'
	 * </code>
	 *
	 * @param     string $schoolSlug The value to use as filter.
	 *              Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    SectionQuery The current query, for fluid interface
	 */
	public function filterBySchoolSlug($schoolSlug = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($schoolSlug)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $schoolSlug)) {
				$schoolSlug = str_replace('*', '%', $schoolSlug);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(SectionPeer::SCHOOL_SLUG, $schoolSlug, $comparison);
	}

	/**
	 * Filter the query on the campus_slug column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByCampusSlug('fooValue');   // WHERE campus_slug = 'fooValue'
	 * $query->filterByCampusSlug('%fooValue%'); // WHERE campus_slug LIKE '%fooValue%'
	 * </code>
	 *
	 * @param     string $campusSlug The value to use as filter.
	 *              Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    SectionQuery The current query, for fluid interface
	 */
	public function filterByCampusSlug($campusSlug = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($campusSlug)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $campusSlug)) {
				$campusSlug = str_replace('*', '%', $campusSlug);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(SectionPeer::CAMPUS_SLUG, $campusSlug, $comparison);
	}

	/**
	 * Filter the query on the term_slug column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByTermSlug('fooValue');   // WHERE term_slug = 'fooValue'
	 * $query->filterByTermSlug('%fooValue%'); // WHERE term_slug LIKE '%fooValue%'
	 * </code>
	 *
	 * @param     string $termSlug The value to use as filter.
	 *              Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    SectionQuery The current query, for fluid interface
	 */
	public function filterByTermSlug($termSlug = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($termSlug)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $termSlug)) {
				$termSlug = str_replace('*', '%', $termSlug);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(SectionPeer::TERM_SLUG, $termSlug, $comparison);
	}

	/**
	 * Filter the query on the f_id column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByFId('fooValue');   // WHERE f_id = 'fooValue'
	 * $query->filterByFId('%fooValue%'); // WHERE f_id LIKE '%fooValue%'
	 * </code>
	 *
	 * @param     string $fId The value to use as filter.
	 *              Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    SectionQuery The current query, for fluid interface
	 */
	public function filterByFId($fId = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($fId)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $fId)) {
				$fId = str_replace('*', '%', $fId);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(SectionPeer::F_ID, $fId, $comparison);
	}

	/**
	 * Filter the query on the nb_items column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByNbItems(1234); // WHERE nb_items = 1234
	 * $query->filterByNbItems(array(12, 34)); // WHERE nb_items IN (12, 34)
	 * $query->filterByNbItems(array('min' => 12)); // WHERE nb_items > 12
	 * </code>
	 *
	 * @param     mixed $nbItems The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    SectionQuery The current query, for fluid interface
	 */
	public function filterByNbItems($nbItems = null, $comparison = null)
	{
		if (is_array($nbItems)) {
			$useMinMax = false;
			if (isset($nbItems['min'])) {
				$this->addUsingAlias(SectionPeer::NB_ITEMS, $nbItems['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($nbItems['max'])) {
				$this->addUsingAlias(SectionPeer::NB_ITEMS, $nbItems['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(SectionPeer::NB_ITEMS, $nbItems, $comparison);
	}

	/**
	 * Filter the query on the professor column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByProfessor('fooValue');   // WHERE professor = 'fooValue'
	 * $query->filterByProfessor('%fooValue%'); // WHERE professor LIKE '%fooValue%'
	 * </code>
	 *
	 * @param     string $professor The value to use as filter.
	 *              Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    SectionQuery The current query, for fluid interface
	 */
	public function filterByProfessor($professor = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($professor)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $professor)) {
				$professor = str_replace('*', '%', $professor);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(SectionPeer::PROFESSOR, $professor, $comparison);
	}

	/**
	 * Filter the query on the course_id column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByCourseId(1234); // WHERE course_id = 1234
	 * $query->filterByCourseId(array(12, 34)); // WHERE course_id IN (12, 34)
	 * $query->filterByCourseId(array('min' => 12)); // WHERE course_id > 12
	 * </code>
	 *
	 * @see       filterByCourse()
	 *
	 * @param     mixed $courseId The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    SectionQuery The current query, for fluid interface
	 */
	public function filterByCourseId($courseId = null, $comparison = null)
	{
		if (is_array($courseId)) {
			$useMinMax = false;
			if (isset($courseId['min'])) {
				$this->addUsingAlias(SectionPeer::COURSE_ID, $courseId['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($courseId['max'])) {
				$this->addUsingAlias(SectionPeer::COURSE_ID, $courseId['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(SectionPeer::COURSE_ID, $courseId, $comparison);
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
	 * @return    SectionQuery The current query, for fluid interface
	 */
	public function filterBySpideredAt($spideredAt = null, $comparison = null)
	{
		if (is_array($spideredAt)) {
			$useMinMax = false;
			if (isset($spideredAt['min'])) {
				$this->addUsingAlias(SectionPeer::SPIDERED_AT, $spideredAt['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($spideredAt['max'])) {
				$this->addUsingAlias(SectionPeer::SPIDERED_AT, $spideredAt['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(SectionPeer::SPIDERED_AT, $spideredAt, $comparison);
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
	 * @return    SectionQuery The current query, for fluid interface
	 */
	public function filterByShallowSpideredAt($shallowSpideredAt = null, $comparison = null)
	{
		if (is_array($shallowSpideredAt)) {
			$useMinMax = false;
			if (isset($shallowSpideredAt['min'])) {
				$this->addUsingAlias(SectionPeer::SHALLOW_SPIDERED_AT, $shallowSpideredAt['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($shallowSpideredAt['max'])) {
				$this->addUsingAlias(SectionPeer::SHALLOW_SPIDERED_AT, $shallowSpideredAt['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(SectionPeer::SHALLOW_SPIDERED_AT, $shallowSpideredAt, $comparison);
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
	 * @return    SectionQuery The current query, for fluid interface
	 */
	public function filterByTouched($touched = null, $comparison = null)
	{
		if (is_string($touched)) {
			$touched = in_array(strtolower($touched), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
		}
		return $this->addUsingAlias(SectionPeer::TOUCHED, $touched, $comparison);
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
	 * @return    SectionQuery The current query, for fluid interface
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
		return $this->addUsingAlias(SectionPeer::B_ID, $bId, $comparison);
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
	 * @return    SectionQuery The current query, for fluid interface
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
		return $this->addUsingAlias(SectionPeer::BOOKSTORE_TYPE, $bookstoreType, $comparison);
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
	 * @return    SectionQuery The current query, for fluid interface
	 */
	public function filterById($id = null, $comparison = null)
	{
		if (is_array($id) && null === $comparison) {
			$comparison = Criteria::IN;
		}
		return $this->addUsingAlias(SectionPeer::ID, $id, $comparison);
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
	 * @return    SectionQuery The current query, for fluid interface
	 */
	public function filterByCreatedAt($createdAt = null, $comparison = null)
	{
		if (is_array($createdAt)) {
			$useMinMax = false;
			if (isset($createdAt['min'])) {
				$this->addUsingAlias(SectionPeer::CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($createdAt['max'])) {
				$this->addUsingAlias(SectionPeer::CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(SectionPeer::CREATED_AT, $createdAt, $comparison);
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
	 * @return    SectionQuery The current query, for fluid interface
	 */
	public function filterByUpdatedAt($updatedAt = null, $comparison = null)
	{
		if (is_array($updatedAt)) {
			$useMinMax = false;
			if (isset($updatedAt['min'])) {
				$this->addUsingAlias(SectionPeer::UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($updatedAt['max'])) {
				$this->addUsingAlias(SectionPeer::UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(SectionPeer::UPDATED_AT, $updatedAt, $comparison);
	}

	/**
	 * Filter the query by a related Course object
	 *
	 * @param     Course|PropelCollection $course The related object(s) to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    SectionQuery The current query, for fluid interface
	 */
	public function filterByCourse($course, $comparison = null)
	{
		if ($course instanceof Course) {
			return $this
				->addUsingAlias(SectionPeer::COURSE_ID, $course->getId(), $comparison);
		} elseif ($course instanceof PropelCollection) {
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
			return $this
				->addUsingAlias(SectionPeer::COURSE_ID, $course->toKeyValue('PrimaryKey', 'Id'), $comparison);
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
	 * @return    SectionQuery The current query, for fluid interface
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
	 * Filter the query by a related SectionHasItem object
	 *
	 * @param     SectionHasItem $sectionHasItem  the related object to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    SectionQuery The current query, for fluid interface
	 */
	public function filterBySectionHasItem($sectionHasItem, $comparison = null)
	{
		if ($sectionHasItem instanceof SectionHasItem) {
			return $this
				->addUsingAlias(SectionPeer::ID, $sectionHasItem->getSectionId(), $comparison);
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
	 * @return    SectionQuery The current query, for fluid interface
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
	 * Filter the query by a related Item object
	 * using the section_has_item table as cross reference
	 *
	 * @param     Item $item the related object to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    SectionQuery The current query, for fluid interface
	 */
	public function filterByItem($item, $comparison = Criteria::EQUAL)
	{
		return $this
			->useSectionHasItemQuery()
			->filterByItem($item, $comparison)
			->endUse();
	}

	/**
	 * Exclude object from result
	 *
	 * @param     Section $section Object to remove from the list of results
	 *
	 * @return    SectionQuery The current query, for fluid interface
	 */
	public function prune($section = null)
	{
		if ($section) {
			$this->addUsingAlias(SectionPeer::ID, $section->getId(), Criteria::NOT_EQUAL);
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
		$this->findRelatedCourses($con);

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
		$this->updateRelatedCourses($con);

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
		$this->findRelatedCourses($con);

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
		$this->updateRelatedCourses($con);

		return $this->postUpdate($affectedRows, $con);
	}

	// timestampable behavior
	
	/**
	 * Filter by the latest updated
	 *
	 * @param      int $nbDays Maximum age of the latest update in days
	 *
	 * @return     SectionQuery The current query, for fluid interface
	 */
	public function recentlyUpdated($nbDays = 7)
	{
		return $this->addUsingAlias(SectionPeer::UPDATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);
	}
	
	/**
	 * Filter by the latest created
	 *
	 * @param      int $nbDays Maximum age of in days
	 *
	 * @return     SectionQuery The current query, for fluid interface
	 */
	public function recentlyCreated($nbDays = 7)
	{
		return $this->addUsingAlias(SectionPeer::CREATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);
	}
	
	/**
	 * Order by update date desc
	 *
	 * @return     SectionQuery The current query, for fluid interface
	 */
	public function lastUpdatedFirst()
	{
		return $this->addDescendingOrderByColumn(SectionPeer::UPDATED_AT);
	}
	
	/**
	 * Order by update date asc
	 *
	 * @return     SectionQuery The current query, for fluid interface
	 */
	public function firstUpdatedFirst()
	{
		return $this->addAscendingOrderByColumn(SectionPeer::UPDATED_AT);
	}
	
	/**
	 * Order by create date desc
	 *
	 * @return     SectionQuery The current query, for fluid interface
	 */
	public function lastCreatedFirst()
	{
		return $this->addDescendingOrderByColumn(SectionPeer::CREATED_AT);
	}
	
	/**
	 * Order by create date asc
	 *
	 * @return     SectionQuery The current query, for fluid interface
	 */
	public function firstCreatedFirst()
	{
		return $this->addAscendingOrderByColumn(SectionPeer::CREATED_AT);
	}

	// aggregate_column_relation behavior
	
	/**
	 * Finds the related Course objects and keep them for later
	 *
	 * @param PropelPDO $con A connection object
	 */
	protected function findRelatedCourses($con)
	{
		$criteria = clone $this;
		if ($this->useAliasInSQL) {
			$alias = $this->getModelAlias();
			$criteria->removeAlias($alias);
		} else {
			$alias = '';
		}
		$this->courses = CourseQuery::create()
			->joinSection($alias)
			->mergeWith($criteria)
			->find($con);
	}
	
	protected function updateRelatedCourses($con)
	{
		foreach ($this->courses as $course) {
			$course->updateNbSections($con);
		}
		$this->courses = array();
	}

} // BaseSectionQuery