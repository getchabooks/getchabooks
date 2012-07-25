<?php


/**
 * Base class that represents a query for the 'section_metadata' table.
 *
 * 
 *
 * @method     SectionMetadataQuery orderBySectionBId($order = Criteria::ASC) Order by the section_b_id column
 * @method     SectionMetadataQuery orderByProfessor($order = Criteria::ASC) Order by the professor column
 * @method     SectionMetadataQuery orderByProfessorEmail($order = Criteria::ASC) Order by the professor_email column
 * @method     SectionMetadataQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     SectionMetadataQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method     SectionMetadataQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 *
 * @method     SectionMetadataQuery groupBySectionBId() Group by the section_b_id column
 * @method     SectionMetadataQuery groupByProfessor() Group by the professor column
 * @method     SectionMetadataQuery groupByProfessorEmail() Group by the professor_email column
 * @method     SectionMetadataQuery groupById() Group by the id column
 * @method     SectionMetadataQuery groupByCreatedAt() Group by the created_at column
 * @method     SectionMetadataQuery groupByUpdatedAt() Group by the updated_at column
 *
 * @method     SectionMetadataQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     SectionMetadataQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     SectionMetadataQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     SectionMetadataQuery leftJoinSection($relationAlias = null) Adds a LEFT JOIN clause to the query using the Section relation
 * @method     SectionMetadataQuery rightJoinSection($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Section relation
 * @method     SectionMetadataQuery innerJoinSection($relationAlias = null) Adds a INNER JOIN clause to the query using the Section relation
 *
 * @method     SectionMetadata findOne(PropelPDO $con = null) Return the first SectionMetadata matching the query
 * @method     SectionMetadata findOneOrCreate(PropelPDO $con = null) Return the first SectionMetadata matching the query, or a new SectionMetadata object populated from the query conditions when no match is found
 *
 * @method     SectionMetadata findOneBySectionBId(string $section_b_id) Return the first SectionMetadata filtered by the section_b_id column
 * @method     SectionMetadata findOneByProfessor(string $professor) Return the first SectionMetadata filtered by the professor column
 * @method     SectionMetadata findOneByProfessorEmail(string $professor_email) Return the first SectionMetadata filtered by the professor_email column
 * @method     SectionMetadata findOneById(int $id) Return the first SectionMetadata filtered by the id column
 * @method     SectionMetadata findOneByCreatedAt(string $created_at) Return the first SectionMetadata filtered by the created_at column
 * @method     SectionMetadata findOneByUpdatedAt(string $updated_at) Return the first SectionMetadata filtered by the updated_at column
 *
 * @method     array findBySectionBId(string $section_b_id) Return SectionMetadata objects filtered by the section_b_id column
 * @method     array findByProfessor(string $professor) Return SectionMetadata objects filtered by the professor column
 * @method     array findByProfessorEmail(string $professor_email) Return SectionMetadata objects filtered by the professor_email column
 * @method     array findById(int $id) Return SectionMetadata objects filtered by the id column
 * @method     array findByCreatedAt(string $created_at) Return SectionMetadata objects filtered by the created_at column
 * @method     array findByUpdatedAt(string $updated_at) Return SectionMetadata objects filtered by the updated_at column
 *
 * @package    propel.generator..om
 */
abstract class BaseSectionMetadataQuery extends ModelCriteria
{
	
	/**
	 * Initializes internal state of BaseSectionMetadataQuery object.
	 *
	 * @param     string $dbName The dabase name
	 * @param     string $modelName The phpName of a model, e.g. 'Book'
	 * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
	 */
	public function __construct($dbName = GB_DATABASE, $modelName = 'SectionMetadata', $modelAlias = null)
	{
		parent::__construct($dbName, $modelName, $modelAlias);
	}

	/**
	 * Returns a new SectionMetadataQuery object.
	 *
	 * @param     string $modelAlias The alias of a model in the query
	 * @param     Criteria $criteria Optional Criteria to build the query from
	 *
	 * @return    SectionMetadataQuery
	 */
	public static function create($modelAlias = null, $criteria = null)
	{
		if ($criteria instanceof SectionMetadataQuery) {
			return $criteria;
		}
		$query = new SectionMetadataQuery();
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
	 * @return    SectionMetadata|array|mixed the result, formatted by the current formatter
	 */
	public function findPk($key, $con = null)
	{
		if ($key === null) {
			return null;
		}
		if ((null !== ($obj = SectionMetadataPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
			// the object is alredy in the instance pool
			return $obj;
		}
		if ($con === null) {
			$con = Propel::getConnection(SectionMetadataPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
	 * @return    SectionMetadata A model object, or null if the key is not found
	 */
	protected function findPkSimple($key, $con)
	{
		$sql = 'SELECT `SECTION_B_ID`, `PROFESSOR`, `PROFESSOR_EMAIL`, `ID`, `CREATED_AT`, `UPDATED_AT` FROM `section_metadata` WHERE `ID` = :p0';
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
			$obj = new SectionMetadata();
			$obj->hydrate($row);
			SectionMetadataPeer::addInstanceToPool($obj, (string) $key);
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
	 * @return    SectionMetadata|array|mixed the result, formatted by the current formatter
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
	 * @return    SectionMetadataQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKey($key)
	{
		return $this->addUsingAlias(SectionMetadataPeer::ID, $key, Criteria::EQUAL);
	}

	/**
	 * Filter the query by a list of primary keys
	 *
	 * @param     array $keys The list of primary key to use for the query
	 *
	 * @return    SectionMetadataQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKeys($keys)
	{
		return $this->addUsingAlias(SectionMetadataPeer::ID, $keys, Criteria::IN);
	}

	/**
	 * Filter the query on the section_b_id column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterBySectionBId('fooValue');   // WHERE section_b_id = 'fooValue'
	 * $query->filterBySectionBId('%fooValue%'); // WHERE section_b_id LIKE '%fooValue%'
	 * </code>
	 *
	 * @param     string $sectionBId The value to use as filter.
	 *              Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    SectionMetadataQuery The current query, for fluid interface
	 */
	public function filterBySectionBId($sectionBId = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($sectionBId)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $sectionBId)) {
				$sectionBId = str_replace('*', '%', $sectionBId);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(SectionMetadataPeer::SECTION_B_ID, $sectionBId, $comparison);
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
	 * @return    SectionMetadataQuery The current query, for fluid interface
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
		return $this->addUsingAlias(SectionMetadataPeer::PROFESSOR, $professor, $comparison);
	}

	/**
	 * Filter the query on the professor_email column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByProfessorEmail('fooValue');   // WHERE professor_email = 'fooValue'
	 * $query->filterByProfessorEmail('%fooValue%'); // WHERE professor_email LIKE '%fooValue%'
	 * </code>
	 *
	 * @param     string $professorEmail The value to use as filter.
	 *              Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    SectionMetadataQuery The current query, for fluid interface
	 */
	public function filterByProfessorEmail($professorEmail = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($professorEmail)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $professorEmail)) {
				$professorEmail = str_replace('*', '%', $professorEmail);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(SectionMetadataPeer::PROFESSOR_EMAIL, $professorEmail, $comparison);
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
	 * @return    SectionMetadataQuery The current query, for fluid interface
	 */
	public function filterById($id = null, $comparison = null)
	{
		if (is_array($id) && null === $comparison) {
			$comparison = Criteria::IN;
		}
		return $this->addUsingAlias(SectionMetadataPeer::ID, $id, $comparison);
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
	 * @return    SectionMetadataQuery The current query, for fluid interface
	 */
	public function filterByCreatedAt($createdAt = null, $comparison = null)
	{
		if (is_array($createdAt)) {
			$useMinMax = false;
			if (isset($createdAt['min'])) {
				$this->addUsingAlias(SectionMetadataPeer::CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($createdAt['max'])) {
				$this->addUsingAlias(SectionMetadataPeer::CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(SectionMetadataPeer::CREATED_AT, $createdAt, $comparison);
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
	 * @return    SectionMetadataQuery The current query, for fluid interface
	 */
	public function filterByUpdatedAt($updatedAt = null, $comparison = null)
	{
		if (is_array($updatedAt)) {
			$useMinMax = false;
			if (isset($updatedAt['min'])) {
				$this->addUsingAlias(SectionMetadataPeer::UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($updatedAt['max'])) {
				$this->addUsingAlias(SectionMetadataPeer::UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(SectionMetadataPeer::UPDATED_AT, $updatedAt, $comparison);
	}

	/**
	 * Filter the query by a related Section object
	 *
	 * @param     Section|PropelCollection $section The related object(s) to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    SectionMetadataQuery The current query, for fluid interface
	 */
	public function filterBySection($section, $comparison = null)
	{
		if ($section instanceof Section) {
			return $this
				->addUsingAlias(SectionMetadataPeer::SECTION_B_ID, $section->getBId(), $comparison);
		} elseif ($section instanceof PropelCollection) {
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
			return $this
				->addUsingAlias(SectionMetadataPeer::SECTION_B_ID, $section->toKeyValue('PrimaryKey', 'BId'), $comparison);
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
	 * @return    SectionMetadataQuery The current query, for fluid interface
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
	 * Exclude object from result
	 *
	 * @param     SectionMetadata $sectionMetadata Object to remove from the list of results
	 *
	 * @return    SectionMetadataQuery The current query, for fluid interface
	 */
	public function prune($sectionMetadata = null)
	{
		if ($sectionMetadata) {
			$this->addUsingAlias(SectionMetadataPeer::ID, $sectionMetadata->getId(), Criteria::NOT_EQUAL);
		}

		return $this;
	}

	// timestampable behavior
	
	/**
	 * Filter by the latest updated
	 *
	 * @param      int $nbDays Maximum age of the latest update in days
	 *
	 * @return     SectionMetadataQuery The current query, for fluid interface
	 */
	public function recentlyUpdated($nbDays = 7)
	{
		return $this->addUsingAlias(SectionMetadataPeer::UPDATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);
	}
	
	/**
	 * Filter by the latest created
	 *
	 * @param      int $nbDays Maximum age of in days
	 *
	 * @return     SectionMetadataQuery The current query, for fluid interface
	 */
	public function recentlyCreated($nbDays = 7)
	{
		return $this->addUsingAlias(SectionMetadataPeer::CREATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);
	}
	
	/**
	 * Order by update date desc
	 *
	 * @return     SectionMetadataQuery The current query, for fluid interface
	 */
	public function lastUpdatedFirst()
	{
		return $this->addDescendingOrderByColumn(SectionMetadataPeer::UPDATED_AT);
	}
	
	/**
	 * Order by update date asc
	 *
	 * @return     SectionMetadataQuery The current query, for fluid interface
	 */
	public function firstUpdatedFirst()
	{
		return $this->addAscendingOrderByColumn(SectionMetadataPeer::UPDATED_AT);
	}
	
	/**
	 * Order by create date desc
	 *
	 * @return     SectionMetadataQuery The current query, for fluid interface
	 */
	public function lastCreatedFirst()
	{
		return $this->addDescendingOrderByColumn(SectionMetadataPeer::CREATED_AT);
	}
	
	/**
	 * Order by create date asc
	 *
	 * @return     SectionMetadataQuery The current query, for fluid interface
	 */
	public function firstCreatedFirst()
	{
		return $this->addAscendingOrderByColumn(SectionMetadataPeer::CREATED_AT);
	}

} // BaseSectionMetadataQuery