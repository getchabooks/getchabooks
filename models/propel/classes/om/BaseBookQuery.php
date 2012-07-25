<?php


/**
 * Base class that represents a query for the 'book' table.
 *
 * 
 *
 * @method     BookQuery orderByIsbn($order = Criteria::ASC) Order by the isbn column
 * @method     BookQuery orderByTitle($order = Criteria::ASC) Order by the title column
 * @method     BookQuery orderByAuthor($order = Criteria::ASC) Order by the author column
 * @method     BookQuery orderByPublisher($order = Criteria::ASC) Order by the publisher column
 * @method     BookQuery orderByEdition($order = Criteria::ASC) Order by the edition column
 * @method     BookQuery orderByEditionNum($order = Criteria::ASC) Order by the edition_num column
 * @method     BookQuery orderByPubdate($order = Criteria::ASC) Order by the pubdate column
 * @method     BookQuery orderByIsPaperback($order = Criteria::ASC) Order by the is_paperback column
 * @method     BookQuery orderByImageUrl($order = Criteria::ASC) Order by the image_url column
 * @method     BookQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     BookQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method     BookQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 *
 * @method     BookQuery groupByIsbn() Group by the isbn column
 * @method     BookQuery groupByTitle() Group by the title column
 * @method     BookQuery groupByAuthor() Group by the author column
 * @method     BookQuery groupByPublisher() Group by the publisher column
 * @method     BookQuery groupByEdition() Group by the edition column
 * @method     BookQuery groupByEditionNum() Group by the edition_num column
 * @method     BookQuery groupByPubdate() Group by the pubdate column
 * @method     BookQuery groupByIsPaperback() Group by the is_paperback column
 * @method     BookQuery groupByImageUrl() Group by the image_url column
 * @method     BookQuery groupById() Group by the id column
 * @method     BookQuery groupByCreatedAt() Group by the created_at column
 * @method     BookQuery groupByUpdatedAt() Group by the updated_at column
 *
 * @method     BookQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     BookQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     BookQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     BookQuery leftJoinItem($relationAlias = null) Adds a LEFT JOIN clause to the query using the Item relation
 * @method     BookQuery rightJoinItem($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Item relation
 * @method     BookQuery innerJoinItem($relationAlias = null) Adds a INNER JOIN clause to the query using the Item relation
 *
 * @method     Book findOne(PropelPDO $con = null) Return the first Book matching the query
 * @method     Book findOneOrCreate(PropelPDO $con = null) Return the first Book matching the query, or a new Book object populated from the query conditions when no match is found
 *
 * @method     Book findOneByIsbn(string $isbn) Return the first Book filtered by the isbn column
 * @method     Book findOneByTitle(string $title) Return the first Book filtered by the title column
 * @method     Book findOneByAuthor(string $author) Return the first Book filtered by the author column
 * @method     Book findOneByPublisher(string $publisher) Return the first Book filtered by the publisher column
 * @method     Book findOneByEdition(string $edition) Return the first Book filtered by the edition column
 * @method     Book findOneByEditionNum(string $edition_num) Return the first Book filtered by the edition_num column
 * @method     Book findOneByPubdate(string $pubdate) Return the first Book filtered by the pubdate column
 * @method     Book findOneByIsPaperback(boolean $is_paperback) Return the first Book filtered by the is_paperback column
 * @method     Book findOneByImageUrl(string $image_url) Return the first Book filtered by the image_url column
 * @method     Book findOneById(int $id) Return the first Book filtered by the id column
 * @method     Book findOneByCreatedAt(string $created_at) Return the first Book filtered by the created_at column
 * @method     Book findOneByUpdatedAt(string $updated_at) Return the first Book filtered by the updated_at column
 *
 * @method     array findByIsbn(string $isbn) Return Book objects filtered by the isbn column
 * @method     array findByTitle(string $title) Return Book objects filtered by the title column
 * @method     array findByAuthor(string $author) Return Book objects filtered by the author column
 * @method     array findByPublisher(string $publisher) Return Book objects filtered by the publisher column
 * @method     array findByEdition(string $edition) Return Book objects filtered by the edition column
 * @method     array findByEditionNum(string $edition_num) Return Book objects filtered by the edition_num column
 * @method     array findByPubdate(string $pubdate) Return Book objects filtered by the pubdate column
 * @method     array findByIsPaperback(boolean $is_paperback) Return Book objects filtered by the is_paperback column
 * @method     array findByImageUrl(string $image_url) Return Book objects filtered by the image_url column
 * @method     array findById(int $id) Return Book objects filtered by the id column
 * @method     array findByCreatedAt(string $created_at) Return Book objects filtered by the created_at column
 * @method     array findByUpdatedAt(string $updated_at) Return Book objects filtered by the updated_at column
 *
 * @package    propel.generator..om
 */
abstract class BaseBookQuery extends ModelCriteria
{
	
	/**
	 * Initializes internal state of BaseBookQuery object.
	 *
	 * @param     string $dbName The dabase name
	 * @param     string $modelName The phpName of a model, e.g. 'Book'
	 * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
	 */
	public function __construct($dbName = GB_DATABASE, $modelName = 'Book', $modelAlias = null)
	{
		parent::__construct($dbName, $modelName, $modelAlias);
	}

	/**
	 * Returns a new BookQuery object.
	 *
	 * @param     string $modelAlias The alias of a model in the query
	 * @param     Criteria $criteria Optional Criteria to build the query from
	 *
	 * @return    BookQuery
	 */
	public static function create($modelAlias = null, $criteria = null)
	{
		if ($criteria instanceof BookQuery) {
			return $criteria;
		}
		$query = new BookQuery();
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
	 * @return    Book|array|mixed the result, formatted by the current formatter
	 */
	public function findPk($key, $con = null)
	{
		if ($key === null) {
			return null;
		}
		if ((null !== ($obj = BookPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
			// the object is alredy in the instance pool
			return $obj;
		}
		if ($con === null) {
			$con = Propel::getConnection(BookPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
	 * @return    Book A model object, or null if the key is not found
	 */
	protected function findPkSimple($key, $con)
	{
		$sql = 'SELECT `ISBN`, `TITLE`, `AUTHOR`, `PUBLISHER`, `EDITION`, `EDITION_NUM`, `PUBDATE`, `IS_PAPERBACK`, `IMAGE_URL`, `ID`, `CREATED_AT`, `UPDATED_AT` FROM `book` WHERE `ID` = :p0';
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
			$obj = new Book();
			$obj->hydrate($row);
			BookPeer::addInstanceToPool($obj, (string) $key);
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
	 * @return    Book|array|mixed the result, formatted by the current formatter
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
	 * @return    BookQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKey($key)
	{
		return $this->addUsingAlias(BookPeer::ID, $key, Criteria::EQUAL);
	}

	/**
	 * Filter the query by a list of primary keys
	 *
	 * @param     array $keys The list of primary key to use for the query
	 *
	 * @return    BookQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKeys($keys)
	{
		return $this->addUsingAlias(BookPeer::ID, $keys, Criteria::IN);
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
	 * @return    BookQuery The current query, for fluid interface
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
		return $this->addUsingAlias(BookPeer::ISBN, $isbn, $comparison);
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
	 * @return    BookQuery The current query, for fluid interface
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
		return $this->addUsingAlias(BookPeer::TITLE, $title, $comparison);
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
	 * @return    BookQuery The current query, for fluid interface
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
		return $this->addUsingAlias(BookPeer::AUTHOR, $author, $comparison);
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
	 * @return    BookQuery The current query, for fluid interface
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
		return $this->addUsingAlias(BookPeer::PUBLISHER, $publisher, $comparison);
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
	 * @return    BookQuery The current query, for fluid interface
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
		return $this->addUsingAlias(BookPeer::EDITION, $edition, $comparison);
	}

	/**
	 * Filter the query on the edition_num column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByEditionNum('fooValue');   // WHERE edition_num = 'fooValue'
	 * $query->filterByEditionNum('%fooValue%'); // WHERE edition_num LIKE '%fooValue%'
	 * </code>
	 *
	 * @param     string $editionNum The value to use as filter.
	 *              Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    BookQuery The current query, for fluid interface
	 */
	public function filterByEditionNum($editionNum = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($editionNum)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $editionNum)) {
				$editionNum = str_replace('*', '%', $editionNum);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(BookPeer::EDITION_NUM, $editionNum, $comparison);
	}

	/**
	 * Filter the query on the pubdate column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByPubdate('fooValue');   // WHERE pubdate = 'fooValue'
	 * $query->filterByPubdate('%fooValue%'); // WHERE pubdate LIKE '%fooValue%'
	 * </code>
	 *
	 * @param     string $pubdate The value to use as filter.
	 *              Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    BookQuery The current query, for fluid interface
	 */
	public function filterByPubdate($pubdate = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($pubdate)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $pubdate)) {
				$pubdate = str_replace('*', '%', $pubdate);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(BookPeer::PUBDATE, $pubdate, $comparison);
	}

	/**
	 * Filter the query on the is_paperback column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByIsPaperback(true); // WHERE is_paperback = true
	 * $query->filterByIsPaperback('yes'); // WHERE is_paperback = true
	 * </code>
	 *
	 * @param     boolean|string $isPaperback The value to use as filter.
	 *              Non-boolean arguments are converted using the following rules:
	 *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
	 *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
	 *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    BookQuery The current query, for fluid interface
	 */
	public function filterByIsPaperback($isPaperback = null, $comparison = null)
	{
		if (is_string($isPaperback)) {
			$is_paperback = in_array(strtolower($isPaperback), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
		}
		return $this->addUsingAlias(BookPeer::IS_PAPERBACK, $isPaperback, $comparison);
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
	 * @return    BookQuery The current query, for fluid interface
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
		return $this->addUsingAlias(BookPeer::IMAGE_URL, $imageUrl, $comparison);
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
	 * @return    BookQuery The current query, for fluid interface
	 */
	public function filterById($id = null, $comparison = null)
	{
		if (is_array($id) && null === $comparison) {
			$comparison = Criteria::IN;
		}
		return $this->addUsingAlias(BookPeer::ID, $id, $comparison);
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
	 * @return    BookQuery The current query, for fluid interface
	 */
	public function filterByCreatedAt($createdAt = null, $comparison = null)
	{
		if (is_array($createdAt)) {
			$useMinMax = false;
			if (isset($createdAt['min'])) {
				$this->addUsingAlias(BookPeer::CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($createdAt['max'])) {
				$this->addUsingAlias(BookPeer::CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(BookPeer::CREATED_AT, $createdAt, $comparison);
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
	 * @return    BookQuery The current query, for fluid interface
	 */
	public function filterByUpdatedAt($updatedAt = null, $comparison = null)
	{
		if (is_array($updatedAt)) {
			$useMinMax = false;
			if (isset($updatedAt['min'])) {
				$this->addUsingAlias(BookPeer::UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
				$useMinMax = true;
			}
			if (isset($updatedAt['max'])) {
				$this->addUsingAlias(BookPeer::UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
				$useMinMax = true;
			}
			if ($useMinMax) {
				return $this;
			}
			if (null === $comparison) {
				$comparison = Criteria::IN;
			}
		}
		return $this->addUsingAlias(BookPeer::UPDATED_AT, $updatedAt, $comparison);
	}

	/**
	 * Filter the query by a related Item object
	 *
	 * @param     Item $item  the related object to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    BookQuery The current query, for fluid interface
	 */
	public function filterByItem($item, $comparison = null)
	{
		if ($item instanceof Item) {
			return $this
				->addUsingAlias(BookPeer::ISBN, $item->getIsbn(), $comparison);
		} elseif ($item instanceof PropelCollection) {
			return $this
				->useItemQuery()
				->filterByPrimaryKeys($item->getPrimaryKeys())
				->endUse();
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
	 * @return    BookQuery The current query, for fluid interface
	 */
	public function joinItem($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
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
	public function useItemQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
	{
		return $this
			->joinItem($relationAlias, $joinType)
			->useQuery($relationAlias ? $relationAlias : 'Item', 'ItemQuery');
	}

	/**
	 * Exclude object from result
	 *
	 * @param     Book $book Object to remove from the list of results
	 *
	 * @return    BookQuery The current query, for fluid interface
	 */
	public function prune($book = null)
	{
		if ($book) {
			$this->addUsingAlias(BookPeer::ID, $book->getId(), Criteria::NOT_EQUAL);
		}

		return $this;
	}

	// timestampable behavior
	
	/**
	 * Filter by the latest updated
	 *
	 * @param      int $nbDays Maximum age of the latest update in days
	 *
	 * @return     BookQuery The current query, for fluid interface
	 */
	public function recentlyUpdated($nbDays = 7)
	{
		return $this->addUsingAlias(BookPeer::UPDATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);
	}
	
	/**
	 * Filter by the latest created
	 *
	 * @param      int $nbDays Maximum age of in days
	 *
	 * @return     BookQuery The current query, for fluid interface
	 */
	public function recentlyCreated($nbDays = 7)
	{
		return $this->addUsingAlias(BookPeer::CREATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);
	}
	
	/**
	 * Order by update date desc
	 *
	 * @return     BookQuery The current query, for fluid interface
	 */
	public function lastUpdatedFirst()
	{
		return $this->addDescendingOrderByColumn(BookPeer::UPDATED_AT);
	}
	
	/**
	 * Order by update date asc
	 *
	 * @return     BookQuery The current query, for fluid interface
	 */
	public function firstUpdatedFirst()
	{
		return $this->addAscendingOrderByColumn(BookPeer::UPDATED_AT);
	}
	
	/**
	 * Order by create date desc
	 *
	 * @return     BookQuery The current query, for fluid interface
	 */
	public function lastCreatedFirst()
	{
		return $this->addDescendingOrderByColumn(BookPeer::CREATED_AT);
	}
	
	/**
	 * Order by create date asc
	 *
	 * @return     BookQuery The current query, for fluid interface
	 */
	public function firstCreatedFirst()
	{
		return $this->addAscendingOrderByColumn(BookPeer::CREATED_AT);
	}

} // BaseBookQuery