<?php


/**
 * Base class that represents a query for the 'school' table.
 *
 * 
 *
 * @method     SchoolQuery orderByShallowSpideredAt($order = Criteria::ASC) Order by the shallow_spidered_at column
 * @method     SchoolQuery orderByEnabled($order = Criteria::ASC) Order by the enabled column
 * @method     SchoolQuery orderByName($order = Criteria::ASC) Order by the name column
 * @method     SchoolQuery orderByShortName($order = Criteria::ASC) Order by the short_name column
 * @method     SchoolQuery orderBySlug($order = Criteria::ASC) Order by the slug column
 * @method     SchoolQuery orderByState($order = Criteria::ASC) Order by the state column
 * @method     SchoolQuery orderByZip($order = Criteria::ASC) Order by the zip column
 * @method     SchoolQuery orderByLocalTax($order = Criteria::ASC) Order by the local_tax column
 * @method     SchoolQuery orderByAmazonTag($order = Criteria::ASC) Order by the amazon_tag column
 * @method     SchoolQuery orderBySubdomain($order = Criteria::ASC) Order by the subdomain column
 * @method     SchoolQuery orderByDeptsToIgnore($order = Criteria::ASC) Order by the depts_to_ignore column
 * @method     SchoolQuery orderByNbCampuses($order = Criteria::ASC) Order by the nb_campuses column
 * @method     SchoolQuery orderBySpideredAt($order = Criteria::ASC) Order by the spidered_at column
 * @method     SchoolQuery orderByTouched($order = Criteria::ASC) Order by the touched column
 * @method     SchoolQuery orderByBId($order = Criteria::ASC) Order by the b_id column
 * @method     SchoolQuery orderByBookstoreType($order = Criteria::ASC) Order by the bookstore_type column
 * @method     SchoolQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     SchoolQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method     SchoolQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 *
 * @method     SchoolQuery groupByShallowSpideredAt() Group by the shallow_spidered_at column
 * @method     SchoolQuery groupByEnabled() Group by the enabled column
 * @method     SchoolQuery groupByName() Group by the name column
 * @method     SchoolQuery groupByShortName() Group by the short_name column
 * @method     SchoolQuery groupBySlug() Group by the slug column
 * @method     SchoolQuery groupByState() Group by the state column
 * @method     SchoolQuery groupByZip() Group by the zip column
 * @method     SchoolQuery groupByLocalTax() Group by the local_tax column
 * @method     SchoolQuery groupByAmazonTag() Group by the amazon_tag column
 * @method     SchoolQuery groupBySubdomain() Group by the subdomain column
 * @method     SchoolQuery groupByDeptsToIgnore() Group by the depts_to_ignore column
 * @method     SchoolQuery groupByNbCampuses() Group by the nb_campuses column
 * @method     SchoolQuery groupBySpideredAt() Group by the spidered_at column
 * @method     SchoolQuery groupByTouched() Group by the touched column
 * @method     SchoolQuery groupByBId() Group by the b_id column
 * @method     SchoolQuery groupByBookstoreType() Group by the bookstore_type column
 * @method     SchoolQuery groupById() Group by the id column
 * @method     SchoolQuery groupByCreatedAt() Group by the created_at column
 * @method     SchoolQuery groupByUpdatedAt() Group by the updated_at column
 *
 * @method     SchoolQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     SchoolQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     SchoolQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     SchoolQuery leftJoinCampus($relationAlias = null) Adds a LEFT JOIN clause to the query using the Campus relation
 * @method     SchoolQuery rightJoinCampus($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Campus relation
 * @method     SchoolQuery innerJoinCampus($relationAlias = null) Adds a INNER JOIN clause to the query using the Campus relation
 *
 * @method     School findOne(PropelPDO $con = null) Return the first School matching the query
 * @method     School findOneOrCreate(PropelPDO $con = null) Return the first School matching the query, or a new School object populated from the query conditions when no match is found
 *
 * @method     School findOneByShallowSpideredAt(string $shallow_spidered_at) Return the first School filtered by the shallow_spidered_at column
 * @method     School findOneByEnabled(boolean $enabled) Return the first School filtered by the enabled column
 * @method     School findOneByName(string $name) Return the first School filtered by the name column
 * @method     School findOneByShortName(string $short_name) Return the first School filtered by the short_name column
 * @method     School findOneBySlug(string $slug) Return the first School filtered by the slug column
 * @method     School findOneByState(string $state) Return the first School filtered by the state column
 * @method     School findOneByZip(string $zip) Return the first School filtered by the zip column
 * @method     School findOneByLocalTax(string $local_tax) Return the first School filtered by the local_tax column
 * @method     School findOneByAmazonTag(string $amazon_tag) Return the first School filtered by the amazon_tag column
 * @method     School findOneBySubdomain(string $subdomain) Return the first School filtered by the subdomain column
 * @method     School findOneByDeptsToIgnore(string $depts_to_ignore) Return the first School filtered by the depts_to_ignore column
 * @method     School findOneByNbCampuses(int $nb_campuses) Return the first School filtered by the nb_campuses column
 * @method     School findOneBySpideredAt(string $spidered_at) Return the first School filtered by the spidered_at column
 * @method     School findOneByTouched(boolean $touched) Return the first School filtered by the touched column
 * @method     School findOneByBId(string $b_id) Return the first School filtered by the b_id column
 * @method     School findOneByBookstoreType(string $bookstore_type) Return the first School filtered by the bookstore_type column
 * @method     School findOneById(int $id) Return the first School filtered by the id column
 * @method     School findOneByCreatedAt(string $created_at) Return the first School filtered by the created_at column
 * @method     School findOneByUpdatedAt(string $updated_at) Return the first School filtered by the updated_at column
 *
 * @method     array findByShallowSpideredAt(string $shallow_spidered_at) Return School objects filtered by the shallow_spidered_at column
 * @method     array findByEnabled(boolean $enabled) Return School objects filtered by the enabled column
 * @method     array findByName(string $name) Return School objects filtered by the name column
 * @method     array findByShortName(string $short_name) Return School objects filtered by the short_name column
 * @method     array findBySlug(string $slug) Return School objects filtered by the slug column
 * @method     array findByState(string $state) Return School objects filtered by the state column
 * @method     array findByZip(string $zip) Return School objects filtered by the zip column
 * @method     array findByLocalTax(string $local_tax) Return School objects filtered by the local_tax column
 * @method     array findByAmazonTag(string $amazon_tag) Return School objects filtered by the amazon_tag column
 * @method     array findBySubdomain(string $subdomain) Return School objects filtered by the subdomain column
 * @method     array findByDeptsToIgnore(string $depts_to_ignore) Return School objects filtered by the depts_to_ignore column
 * @method     array findByNbCampuses(int $nb_campuses) Return School objects filtered by the nb_campuses column
 * @method     array findBySpideredAt(string $spidered_at) Return School objects filtered by the spidered_at column
 * @method     array findByTouched(boolean $touched) Return School objects filtered by the touched column
 * @method     array findByBId(string $b_id) Return School objects filtered by the b_id column
 * @method     array findByBookstoreType(string $bookstore_type) Return School objects filtered by the bookstore_type column
 * @method     array findById(int $id) Return School objects filtered by the id column
 * @method     array findByCreatedAt(string $created_at) Return School objects filtered by the created_at column
 * @method     array findByUpdatedAt(string $updated_at) Return School objects filtered by the updated_at column
 *
 * @package    propel.generator..om
 */
abstract class BaseSchoolQuery extends ModelCriteria
{
	
	/**
	 * Initializes internal state of BaseSchoolQuery object.
	 *
	 * @param     string $dbName The dabase name
	 * @param     string $modelName The phpName of a model, e.g. 'Book'
	 * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
	 */
	public function __construct($dbName = GB_DATABASE, $modelName = 'School', $modelAlias = null)
	{
		parent::__construct($dbName, $modelName, $modelAlias);
	}

	/**
	 * Returns a new SchoolQuery object.
	 *
	 * @param     string $modelAlias The alias of a model in the query
	 * @param     Criteria $criteria Optional Criteria to build the query from
	 *
	 * @return    SchoolQuery
	 */
	public static function create($modelAlias = null, $criteria = null)
	{
		if ($criteria instanceof SchoolQuery) {
			return $criteria;
		}
		$query = new SchoolQuery();
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
	 * @return    School|array|mixed the result, formatted by the current formatter
	 */
	public function findPk($key, $con = null)
	{
		if ($key === null) {
			return null;
		}
		if ((null !== ($obj = SchoolPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
			// the object is alredy in the instance pool
			return $obj;
		}
		if ($con === null) {
			$con = Propel::getConnection(SchoolPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
	 * @return    School A model object, or null if the key is not found
	 */
	protected function findPkSimple($key, $con)
	{
		$sql = 'SELECT `SHALLOW_SPIDERED_AT`, `ENABLED`, `NAME`, `SHORT_NAME`, `SLUG`, `STATE`, `ZIP`, `LOCAL_TAX`, `AMAZON_TAG`, `SUBDOMAIN`, `DEPTS_TO_IGNORE`, `NB_CAMPUSES`, `SPIDERED_AT`, `TOUCHED`, `B_ID`, `BOOKSTORE_TYPE`, `ID`, `CREATED_AT`, `UPDATED_AT` FROM `school` WHERE `ID` = :p0';
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
			$obj = new School();
			$obj->hydrate($row);
			SchoolPeer::addInstanceToPool($obj, (string) $key);
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
	 * @return    School|array|mixed the result, formatted by the current formatter
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
	 * @return    SchoolQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKey($key)
	{
		return $this->addUsingAlias(SchoolPeer::ID, $key, Criteria::EQUAL);
	}

	/**
	 * Filter the query by a list of primary keys
	 *
	 * @param     array $keys The list of primary key to use for the query
	 *
	 * @return    SchoolQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKeys($keys)
	{
		return $this->addUsingAlias(SchoolPeer::ID, $keys, Criteria::IN);
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
	 * @return    SchoolQuery The current query, for fluid interface
	 */
	public function filterByShallowSpideredAt($shallowSpideredAt = null, $comparison = null)
	{
		if (is_array($shallowSpideredAt)) {
			$useMinMax = false;
			if (isset($shallowSpideredAt['min'])) {
				$this->addUsingAlias(SchoolPeer::SHALLOW_SPIDERED_AT, $shallowSpideredAt['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($shallowSpideredAt['max'])) {
				$this->addUsingAlias(SchoolPeer::SHALLOW_SPIDERED_AT, $shallowSpideredAt['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(SchoolPeer::SHALLOW_SPIDERED_AT, $shallowSpideredAt, $comparison);
	}

	/**
	 * Filter the query on the enabled column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByEnabled(true); // WHERE enabled = true
	 * $query->filterByEnabled('yes'); // WHERE enabled = true
	 * </code>
	 *
	 * @param     boolean|string $enabled The value to use as filter.
	 *              Non-boolean arguments are converted using the following rules:
	 *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
	 *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
	 *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    SchoolQuery The current query, for fluid interface
	 */
	public function filterByEnabled($enabled = null, $comparison = null)
	{
		if (is_string($enabled)) {
			$enabled = in_array(strtolower($enabled), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
		}
		return $this->addUsingAlias(SchoolPeer::ENABLED, $enabled, $comparison);
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
	 * @return    SchoolQuery The current query, for fluid interface
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
		return $this->addUsingAlias(SchoolPeer::NAME, $name, $comparison);
	}

	/**
	 * Filter the query on the short_name column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByShortName('fooValue');   // WHERE short_name = 'fooValue'
	 * $query->filterByShortName('%fooValue%'); // WHERE short_name LIKE '%fooValue%'
	 * </code>
	 *
	 * @param     string $shortName The value to use as filter.
	 *              Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    SchoolQuery The current query, for fluid interface
	 */
	public function filterByShortName($shortName = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($shortName)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $shortName)) {
				$shortName = str_replace('*', '%', $shortName);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(SchoolPeer::SHORT_NAME, $shortName, $comparison);
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
	 * @return    SchoolQuery The current query, for fluid interface
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
		return $this->addUsingAlias(SchoolPeer::SLUG, $slug, $comparison);
	}

	/**
	 * Filter the query on the state column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByState('fooValue');   // WHERE state = 'fooValue'
	 * $query->filterByState('%fooValue%'); // WHERE state LIKE '%fooValue%'
	 * </code>
	 *
	 * @param     string $state The value to use as filter.
	 *              Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    SchoolQuery The current query, for fluid interface
	 */
	public function filterByState($state = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($state)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $state)) {
				$state = str_replace('*', '%', $state);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(SchoolPeer::STATE, $state, $comparison);
	}

	/**
	 * Filter the query on the zip column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByZip('fooValue');   // WHERE zip = 'fooValue'
	 * $query->filterByZip('%fooValue%'); // WHERE zip LIKE '%fooValue%'
	 * </code>
	 *
	 * @param     string $zip The value to use as filter.
	 *              Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    SchoolQuery The current query, for fluid interface
	 */
	public function filterByZip($zip = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($zip)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $zip)) {
				$zip = str_replace('*', '%', $zip);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(SchoolPeer::ZIP, $zip, $comparison);
	}

	/**
	 * Filter the query on the local_tax column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByLocalTax(1234); // WHERE local_tax = 1234
	 * $query->filterByLocalTax(array(12, 34)); // WHERE local_tax IN (12, 34)
	 * $query->filterByLocalTax(array('min' => 12)); // WHERE local_tax > 12
	 * </code>
	 *
	 * @param     mixed $localTax The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    SchoolQuery The current query, for fluid interface
	 */
	public function filterByLocalTax($localTax = null, $comparison = null)
	{
		if (is_array($localTax)) {
			$useMinMax = false;
			if (isset($localTax['min'])) {
				$this->addUsingAlias(SchoolPeer::LOCAL_TAX, $localTax['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($localTax['max'])) {
				$this->addUsingAlias(SchoolPeer::LOCAL_TAX, $localTax['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(SchoolPeer::LOCAL_TAX, $localTax, $comparison);
	}

	/**
	 * Filter the query on the amazon_tag column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByAmazonTag('fooValue');   // WHERE amazon_tag = 'fooValue'
	 * $query->filterByAmazonTag('%fooValue%'); // WHERE amazon_tag LIKE '%fooValue%'
	 * </code>
	 *
	 * @param     string $amazonTag The value to use as filter.
	 *              Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    SchoolQuery The current query, for fluid interface
	 */
	public function filterByAmazonTag($amazonTag = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($amazonTag)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $amazonTag)) {
				$amazonTag = str_replace('*', '%', $amazonTag);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(SchoolPeer::AMAZON_TAG, $amazonTag, $comparison);
	}

	/**
	 * Filter the query on the subdomain column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterBySubdomain('fooValue');   // WHERE subdomain = 'fooValue'
	 * $query->filterBySubdomain('%fooValue%'); // WHERE subdomain LIKE '%fooValue%'
	 * </code>
	 *
	 * @param     string $subdomain The value to use as filter.
	 *              Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    SchoolQuery The current query, for fluid interface
	 */
	public function filterBySubdomain($subdomain = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($subdomain)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $subdomain)) {
				$subdomain = str_replace('*', '%', $subdomain);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(SchoolPeer::SUBDOMAIN, $subdomain, $comparison);
	}

	/**
	 * Filter the query on the depts_to_ignore column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByDeptsToIgnore('fooValue');   // WHERE depts_to_ignore = 'fooValue'
	 * $query->filterByDeptsToIgnore('%fooValue%'); // WHERE depts_to_ignore LIKE '%fooValue%'
	 * </code>
	 *
	 * @param     string $deptsToIgnore The value to use as filter.
	 *              Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    SchoolQuery The current query, for fluid interface
	 */
	public function filterByDeptsToIgnore($deptsToIgnore = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($deptsToIgnore)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $deptsToIgnore)) {
				$deptsToIgnore = str_replace('*', '%', $deptsToIgnore);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(SchoolPeer::DEPTS_TO_IGNORE, $deptsToIgnore, $comparison);
	}

	/**
	 * Filter the query on the nb_campuses column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByNbCampuses(1234); // WHERE nb_campuses = 1234
	 * $query->filterByNbCampuses(array(12, 34)); // WHERE nb_campuses IN (12, 34)
	 * $query->filterByNbCampuses(array('min' => 12)); // WHERE nb_campuses > 12
	 * </code>
	 *
	 * @param     mixed $nbCampuses The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    SchoolQuery The current query, for fluid interface
	 */
	public function filterByNbCampuses($nbCampuses = null, $comparison = null)
	{
		if (is_array($nbCampuses)) {
			$useMinMax = false;
			if (isset($nbCampuses['min'])) {
				$this->addUsingAlias(SchoolPeer::NB_CAMPUSES, $nbCampuses['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($nbCampuses['max'])) {
				$this->addUsingAlias(SchoolPeer::NB_CAMPUSES, $nbCampuses['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(SchoolPeer::NB_CAMPUSES, $nbCampuses, $comparison);
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
	 * @return    SchoolQuery The current query, for fluid interface
	 */
	public function filterBySpideredAt($spideredAt = null, $comparison = null)
	{
		if (is_array($spideredAt)) {
			$useMinMax = false;
			if (isset($spideredAt['min'])) {
				$this->addUsingAlias(SchoolPeer::SPIDERED_AT, $spideredAt['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($spideredAt['max'])) {
				$this->addUsingAlias(SchoolPeer::SPIDERED_AT, $spideredAt['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(SchoolPeer::SPIDERED_AT, $spideredAt, $comparison);
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
	 * @return    SchoolQuery The current query, for fluid interface
	 */
	public function filterByTouched($touched = null, $comparison = null)
	{
		if (is_string($touched)) {
			$touched = in_array(strtolower($touched), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
		}
		return $this->addUsingAlias(SchoolPeer::TOUCHED, $touched, $comparison);
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
	 * @return    SchoolQuery The current query, for fluid interface
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
		return $this->addUsingAlias(SchoolPeer::B_ID, $bId, $comparison);
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
	 * @return    SchoolQuery The current query, for fluid interface
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
		return $this->addUsingAlias(SchoolPeer::BOOKSTORE_TYPE, $bookstoreType, $comparison);
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
	 * @return    SchoolQuery The current query, for fluid interface
	 */
	public function filterById($id = null, $comparison = null)
	{
		if (is_array($id) && null === $comparison) {
			$comparison = Criteria::IN;
		}
		return $this->addUsingAlias(SchoolPeer::ID, $id, $comparison);
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
	 * @return    SchoolQuery The current query, for fluid interface
	 */
	public function filterByCreatedAt($createdAt = null, $comparison = null)
	{
		if (is_array($createdAt)) {
			$useMinMax = false;
			if (isset($createdAt['min'])) {
				$this->addUsingAlias(SchoolPeer::CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($createdAt['max'])) {
				$this->addUsingAlias(SchoolPeer::CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(SchoolPeer::CREATED_AT, $createdAt, $comparison);
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
	 * @return    SchoolQuery The current query, for fluid interface
	 */
	public function filterByUpdatedAt($updatedAt = null, $comparison = null)
	{
		if (is_array($updatedAt)) {
			$useMinMax = false;
			if (isset($updatedAt['min'])) {
				$this->addUsingAlias(SchoolPeer::UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($updatedAt['max'])) {
				$this->addUsingAlias(SchoolPeer::UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(SchoolPeer::UPDATED_AT, $updatedAt, $comparison);
	}

	/**
	 * Filter the query by a related Campus object
	 *
	 * @param     Campus $campus  the related object to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    SchoolQuery The current query, for fluid interface
	 */
	public function filterByCampus($campus, $comparison = null)
	{
		if ($campus instanceof Campus) {
			return $this
				->addUsingAlias(SchoolPeer::ID, $campus->getSchoolId(), $comparison);
		} elseif ($campus instanceof PropelCollection) {
			return $this
				->useCampusQuery()
				->filterByPrimaryKeys($campus->getPrimaryKeys())
				->endUse();
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
	 * @return    SchoolQuery The current query, for fluid interface
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
	 * Exclude object from result
	 *
	 * @param     School $school Object to remove from the list of results
	 *
	 * @return    SchoolQuery The current query, for fluid interface
	 */
	public function prune($school = null)
	{
		if ($school) {
			$this->addUsingAlias(SchoolPeer::ID, $school->getId(), Criteria::NOT_EQUAL);
		}

		return $this;
	}

	// timestampable behavior
	
	/**
	 * Filter by the latest updated
	 *
	 * @param      int $nbDays Maximum age of the latest update in days
	 *
	 * @return     SchoolQuery The current query, for fluid interface
	 */
	public function recentlyUpdated($nbDays = 7)
	{
		return $this->addUsingAlias(SchoolPeer::UPDATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);
	}
	
	/**
	 * Filter by the latest created
	 *
	 * @param      int $nbDays Maximum age of in days
	 *
	 * @return     SchoolQuery The current query, for fluid interface
	 */
	public function recentlyCreated($nbDays = 7)
	{
		return $this->addUsingAlias(SchoolPeer::CREATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);
	}
	
	/**
	 * Order by update date desc
	 *
	 * @return     SchoolQuery The current query, for fluid interface
	 */
	public function lastUpdatedFirst()
	{
		return $this->addDescendingOrderByColumn(SchoolPeer::UPDATED_AT);
	}
	
	/**
	 * Order by update date asc
	 *
	 * @return     SchoolQuery The current query, for fluid interface
	 */
	public function firstUpdatedFirst()
	{
		return $this->addAscendingOrderByColumn(SchoolPeer::UPDATED_AT);
	}
	
	/**
	 * Order by create date desc
	 *
	 * @return     SchoolQuery The current query, for fluid interface
	 */
	public function lastCreatedFirst()
	{
		return $this->addDescendingOrderByColumn(SchoolPeer::CREATED_AT);
	}
	
	/**
	 * Order by create date asc
	 *
	 * @return     SchoolQuery The current query, for fluid interface
	 */
	public function firstCreatedFirst()
	{
		return $this->addAscendingOrderByColumn(SchoolPeer::CREATED_AT);
	}

} // BaseSchoolQuery