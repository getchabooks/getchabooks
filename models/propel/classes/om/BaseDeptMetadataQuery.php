<?php


/**
 * Base class that represents a query for the 'dept_metadata' table.
 *
 * 
 *
 * @method     DeptMetadataQuery orderByDeptBId($order = Criteria::ASC) Order by the dept_b_id column
 * @method     DeptMetadataQuery orderByName($order = Criteria::ASC) Order by the name column
 * @method     DeptMetadataQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     DeptMetadataQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method     DeptMetadataQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 *
 * @method     DeptMetadataQuery groupByDeptBId() Group by the dept_b_id column
 * @method     DeptMetadataQuery groupByName() Group by the name column
 * @method     DeptMetadataQuery groupById() Group by the id column
 * @method     DeptMetadataQuery groupByCreatedAt() Group by the created_at column
 * @method     DeptMetadataQuery groupByUpdatedAt() Group by the updated_at column
 *
 * @method     DeptMetadataQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     DeptMetadataQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     DeptMetadataQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     DeptMetadataQuery leftJoinDept($relationAlias = null) Adds a LEFT JOIN clause to the query using the Dept relation
 * @method     DeptMetadataQuery rightJoinDept($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Dept relation
 * @method     DeptMetadataQuery innerJoinDept($relationAlias = null) Adds a INNER JOIN clause to the query using the Dept relation
 *
 * @method     DeptMetadata findOne(PropelPDO $con = null) Return the first DeptMetadata matching the query
 * @method     DeptMetadata findOneOrCreate(PropelPDO $con = null) Return the first DeptMetadata matching the query, or a new DeptMetadata object populated from the query conditions when no match is found
 *
 * @method     DeptMetadata findOneByDeptBId(string $dept_b_id) Return the first DeptMetadata filtered by the dept_b_id column
 * @method     DeptMetadata findOneByName(string $name) Return the first DeptMetadata filtered by the name column
 * @method     DeptMetadata findOneById(int $id) Return the first DeptMetadata filtered by the id column
 * @method     DeptMetadata findOneByCreatedAt(string $created_at) Return the first DeptMetadata filtered by the created_at column
 * @method     DeptMetadata findOneByUpdatedAt(string $updated_at) Return the first DeptMetadata filtered by the updated_at column
 *
 * @method     array findByDeptBId(string $dept_b_id) Return DeptMetadata objects filtered by the dept_b_id column
 * @method     array findByName(string $name) Return DeptMetadata objects filtered by the name column
 * @method     array findById(int $id) Return DeptMetadata objects filtered by the id column
 * @method     array findByCreatedAt(string $created_at) Return DeptMetadata objects filtered by the created_at column
 * @method     array findByUpdatedAt(string $updated_at) Return DeptMetadata objects filtered by the updated_at column
 *
 * @package    propel.generator..om
 */
abstract class BaseDeptMetadataQuery extends ModelCriteria
{
	
	/**
	 * Initializes internal state of BaseDeptMetadataQuery object.
	 *
	 * @param     string $dbName The dabase name
	 * @param     string $modelName The phpName of a model, e.g. 'Book'
	 * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
	 */
	public function __construct($dbName = GB_DATABASE, $modelName = 'DeptMetadata', $modelAlias = null)
	{
		parent::__construct($dbName, $modelName, $modelAlias);
	}

	/**
	 * Returns a new DeptMetadataQuery object.
	 *
	 * @param     string $modelAlias The alias of a model in the query
	 * @param     Criteria $criteria Optional Criteria to build the query from
	 *
	 * @return    DeptMetadataQuery
	 */
	public static function create($modelAlias = null, $criteria = null)
	{
		if ($criteria instanceof DeptMetadataQuery) {
			return $criteria;
		}
		$query = new DeptMetadataQuery();
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
	 * @return    DeptMetadata|array|mixed the result, formatted by the current formatter
	 */
	public function findPk($key, $con = null)
	{
		if ($key === null) {
			return null;
		}
		if ((null !== ($obj = DeptMetadataPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
			// the object is alredy in the instance pool
			return $obj;
		}
		if ($con === null) {
			$con = Propel::getConnection(DeptMetadataPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
	 * @return    DeptMetadata A model object, or null if the key is not found
	 */
	protected function findPkSimple($key, $con)
	{
		$sql = 'SELECT `DEPT_B_ID`, `NAME`, `ID`, `CREATED_AT`, `UPDATED_AT` FROM `dept_metadata` WHERE `ID` = :p0';
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
			$obj = new DeptMetadata();
			$obj->hydrate($row);
			DeptMetadataPeer::addInstanceToPool($obj, (string) $key);
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
	 * @return    DeptMetadata|array|mixed the result, formatted by the current formatter
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
	 * @return    DeptMetadataQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKey($key)
	{
		return $this->addUsingAlias(DeptMetadataPeer::ID, $key, Criteria::EQUAL);
	}

	/**
	 * Filter the query by a list of primary keys
	 *
	 * @param     array $keys The list of primary key to use for the query
	 *
	 * @return    DeptMetadataQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKeys($keys)
	{
		return $this->addUsingAlias(DeptMetadataPeer::ID, $keys, Criteria::IN);
	}

	/**
	 * Filter the query on the dept_b_id column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByDeptBId('fooValue');   // WHERE dept_b_id = 'fooValue'
	 * $query->filterByDeptBId('%fooValue%'); // WHERE dept_b_id LIKE '%fooValue%'
	 * </code>
	 *
	 * @param     string $deptBId The value to use as filter.
	 *              Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    DeptMetadataQuery The current query, for fluid interface
	 */
	public function filterByDeptBId($deptBId = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($deptBId)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $deptBId)) {
				$deptBId = str_replace('*', '%', $deptBId);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(DeptMetadataPeer::DEPT_B_ID, $deptBId, $comparison);
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
	 * @return    DeptMetadataQuery The current query, for fluid interface
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
		return $this->addUsingAlias(DeptMetadataPeer::NAME, $name, $comparison);
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
	 * @return    DeptMetadataQuery The current query, for fluid interface
	 */
	public function filterById($id = null, $comparison = null)
	{
		if (is_array($id) && null === $comparison) {
			$comparison = Criteria::IN;
		}
		return $this->addUsingAlias(DeptMetadataPeer::ID, $id, $comparison);
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
	 * @return    DeptMetadataQuery The current query, for fluid interface
	 */
	public function filterByCreatedAt($createdAt = null, $comparison = null)
	{
		if (is_array($createdAt)) {
			$useMinMax = false;
			if (isset($createdAt['min'])) {
				$this->addUsingAlias(DeptMetadataPeer::CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($createdAt['max'])) {
				$this->addUsingAlias(DeptMetadataPeer::CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(DeptMetadataPeer::CREATED_AT, $createdAt, $comparison);
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
	 * @return    DeptMetadataQuery The current query, for fluid interface
	 */
	public function filterByUpdatedAt($updatedAt = null, $comparison = null)
	{
		if (is_array($updatedAt)) {
			$useMinMax = false;
			if (isset($updatedAt['min'])) {
				$this->addUsingAlias(DeptMetadataPeer::UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($updatedAt['max'])) {
				$this->addUsingAlias(DeptMetadataPeer::UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(DeptMetadataPeer::UPDATED_AT, $updatedAt, $comparison);
	}

	/**
	 * Filter the query by a related Dept object
	 *
	 * @param     Dept|PropelCollection $dept The related object(s) to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    DeptMetadataQuery The current query, for fluid interface
	 */
	public function filterByDept($dept, $comparison = null)
	{
		if ($dept instanceof Dept) {
			return $this
				->addUsingAlias(DeptMetadataPeer::DEPT_B_ID, $dept->getBId(), $comparison);
		} elseif ($dept instanceof PropelCollection) {
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
			return $this
				->addUsingAlias(DeptMetadataPeer::DEPT_B_ID, $dept->toKeyValue('PrimaryKey', 'BId'), $comparison);
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
	 * @return    DeptMetadataQuery The current query, for fluid interface
	 */
	public function joinDept($relationAlias = null, $joinType = Criteria::INNER_JOIN)
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
	public function useDeptQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
	{
		return $this
			->joinDept($relationAlias, $joinType)
			->useQuery($relationAlias ? $relationAlias : 'Dept', 'DeptQuery');
	}

	/**
	 * Exclude object from result
	 *
	 * @param     DeptMetadata $deptMetadata Object to remove from the list of results
	 *
	 * @return    DeptMetadataQuery The current query, for fluid interface
	 */
	public function prune($deptMetadata = null)
	{
		if ($deptMetadata) {
			$this->addUsingAlias(DeptMetadataPeer::ID, $deptMetadata->getId(), Criteria::NOT_EQUAL);
		}

		return $this;
	}

	// timestampable behavior
	
	/**
	 * Filter by the latest updated
	 *
	 * @param      int $nbDays Maximum age of the latest update in days
	 *
	 * @return     DeptMetadataQuery The current query, for fluid interface
	 */
	public function recentlyUpdated($nbDays = 7)
	{
		return $this->addUsingAlias(DeptMetadataPeer::UPDATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);
	}
	
	/**
	 * Filter by the latest created
	 *
	 * @param      int $nbDays Maximum age of in days
	 *
	 * @return     DeptMetadataQuery The current query, for fluid interface
	 */
	public function recentlyCreated($nbDays = 7)
	{
		return $this->addUsingAlias(DeptMetadataPeer::CREATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);
	}
	
	/**
	 * Order by update date desc
	 *
	 * @return     DeptMetadataQuery The current query, for fluid interface
	 */
	public function lastUpdatedFirst()
	{
		return $this->addDescendingOrderByColumn(DeptMetadataPeer::UPDATED_AT);
	}
	
	/**
	 * Order by update date asc
	 *
	 * @return     DeptMetadataQuery The current query, for fluid interface
	 */
	public function firstUpdatedFirst()
	{
		return $this->addAscendingOrderByColumn(DeptMetadataPeer::UPDATED_AT);
	}
	
	/**
	 * Order by create date desc
	 *
	 * @return     DeptMetadataQuery The current query, for fluid interface
	 */
	public function lastCreatedFirst()
	{
		return $this->addDescendingOrderByColumn(DeptMetadataPeer::CREATED_AT);
	}
	
	/**
	 * Order by create date asc
	 *
	 * @return     DeptMetadataQuery The current query, for fluid interface
	 */
	public function firstCreatedFirst()
	{
		return $this->addAscendingOrderByColumn(DeptMetadataPeer::CREATED_AT);
	}

} // BaseDeptMetadataQuery