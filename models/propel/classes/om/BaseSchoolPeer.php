<?php


/**
 * Base static class for performing query and update operations on the 'school' table.
 *
 * 
 *
 * @package    propel.generator..om
 */
abstract class BaseSchoolPeer {

	/** the default database name for this class */
	const DATABASE_NAME = GB_DATABASE;

	/** the table name for this class */
	const TABLE_NAME = 'school';

	/** the related Propel class for this table */
	const OM_CLASS = 'School';

	/** the related TableMap class for this table */
	const TM_CLASS = 'SchoolTableMap';

	/** The total number of columns. */
	const NUM_COLUMNS = 19;

	/** The number of lazy-loaded columns. */
	const NUM_LAZY_LOAD_COLUMNS = 0;

	/** The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS) */
	const NUM_HYDRATE_COLUMNS = 19;

	/** the column name for the SHALLOW_SPIDERED_AT field */
	const SHALLOW_SPIDERED_AT = 'school.SHALLOW_SPIDERED_AT';

	/** the column name for the ENABLED field */
	const ENABLED = 'school.ENABLED';

	/** the column name for the NAME field */
	const NAME = 'school.NAME';

	/** the column name for the SHORT_NAME field */
	const SHORT_NAME = 'school.SHORT_NAME';

	/** the column name for the SLUG field */
	const SLUG = 'school.SLUG';

	/** the column name for the STATE field */
	const STATE = 'school.STATE';

	/** the column name for the ZIP field */
	const ZIP = 'school.ZIP';

	/** the column name for the LOCAL_TAX field */
	const LOCAL_TAX = 'school.LOCAL_TAX';

	/** the column name for the AMAZON_TAG field */
	const AMAZON_TAG = 'school.AMAZON_TAG';

	/** the column name for the SUBDOMAIN field */
	const SUBDOMAIN = 'school.SUBDOMAIN';

	/** the column name for the DEPTS_TO_IGNORE field */
	const DEPTS_TO_IGNORE = 'school.DEPTS_TO_IGNORE';

	/** the column name for the NB_CAMPUSES field */
	const NB_CAMPUSES = 'school.NB_CAMPUSES';

	/** the column name for the SPIDERED_AT field */
	const SPIDERED_AT = 'school.SPIDERED_AT';

	/** the column name for the TOUCHED field */
	const TOUCHED = 'school.TOUCHED';

	/** the column name for the B_ID field */
	const B_ID = 'school.B_ID';

	/** the column name for the BOOKSTORE_TYPE field */
	const BOOKSTORE_TYPE = 'school.BOOKSTORE_TYPE';

	/** the column name for the ID field */
	const ID = 'school.ID';

	/** the column name for the CREATED_AT field */
	const CREATED_AT = 'school.CREATED_AT';

	/** the column name for the UPDATED_AT field */
	const UPDATED_AT = 'school.UPDATED_AT';

	/** The default string format for model objects of the related table **/
	const DEFAULT_STRING_FORMAT = 'YAML';

	/**
	 * An identiy map to hold any loaded instances of School objects.
	 * This must be public so that other peer classes can access this when hydrating from JOIN
	 * queries.
	 * @var        array School[]
	 */
	public static $instances = array();


	/**
	 * holds an array of fieldnames
	 *
	 * first dimension keys are the type constants
	 * e.g. self::$fieldNames[self::TYPE_PHPNAME][0] = 'Id'
	 */
	protected static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('ShallowSpideredAt', 'Enabled', 'Name', 'ShortName', 'Slug', 'State', 'Zip', 'LocalTax', 'AmazonTag', 'Subdomain', 'DeptsToIgnore', 'NbCampuses', 'SpideredAt', 'Touched', 'BId', 'BookstoreType', 'Id', 'CreatedAt', 'UpdatedAt', ),
		BasePeer::TYPE_STUDLYPHPNAME => array ('shallowSpideredAt', 'enabled', 'name', 'shortName', 'slug', 'state', 'zip', 'localTax', 'amazonTag', 'subdomain', 'deptsToIgnore', 'nbCampuses', 'spideredAt', 'touched', 'bId', 'bookstoreType', 'id', 'createdAt', 'updatedAt', ),
		BasePeer::TYPE_COLNAME => array (self::SHALLOW_SPIDERED_AT, self::ENABLED, self::NAME, self::SHORT_NAME, self::SLUG, self::STATE, self::ZIP, self::LOCAL_TAX, self::AMAZON_TAG, self::SUBDOMAIN, self::DEPTS_TO_IGNORE, self::NB_CAMPUSES, self::SPIDERED_AT, self::TOUCHED, self::B_ID, self::BOOKSTORE_TYPE, self::ID, self::CREATED_AT, self::UPDATED_AT, ),
		BasePeer::TYPE_RAW_COLNAME => array ('SHALLOW_SPIDERED_AT', 'ENABLED', 'NAME', 'SHORT_NAME', 'SLUG', 'STATE', 'ZIP', 'LOCAL_TAX', 'AMAZON_TAG', 'SUBDOMAIN', 'DEPTS_TO_IGNORE', 'NB_CAMPUSES', 'SPIDERED_AT', 'TOUCHED', 'B_ID', 'BOOKSTORE_TYPE', 'ID', 'CREATED_AT', 'UPDATED_AT', ),
		BasePeer::TYPE_FIELDNAME => array ('shallow_spidered_at', 'enabled', 'name', 'short_name', 'slug', 'state', 'zip', 'local_tax', 'amazon_tag', 'subdomain', 'depts_to_ignore', 'nb_campuses', 'spidered_at', 'touched', 'b_id', 'bookstore_type', 'id', 'created_at', 'updated_at', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, )
	);

	/**
	 * holds an array of keys for quick access to the fieldnames array
	 *
	 * first dimension keys are the type constants
	 * e.g. self::$fieldNames[BasePeer::TYPE_PHPNAME]['Id'] = 0
	 */
	protected static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('ShallowSpideredAt' => 0, 'Enabled' => 1, 'Name' => 2, 'ShortName' => 3, 'Slug' => 4, 'State' => 5, 'Zip' => 6, 'LocalTax' => 7, 'AmazonTag' => 8, 'Subdomain' => 9, 'DeptsToIgnore' => 10, 'NbCampuses' => 11, 'SpideredAt' => 12, 'Touched' => 13, 'BId' => 14, 'BookstoreType' => 15, 'Id' => 16, 'CreatedAt' => 17, 'UpdatedAt' => 18, ),
		BasePeer::TYPE_STUDLYPHPNAME => array ('shallowSpideredAt' => 0, 'enabled' => 1, 'name' => 2, 'shortName' => 3, 'slug' => 4, 'state' => 5, 'zip' => 6, 'localTax' => 7, 'amazonTag' => 8, 'subdomain' => 9, 'deptsToIgnore' => 10, 'nbCampuses' => 11, 'spideredAt' => 12, 'touched' => 13, 'bId' => 14, 'bookstoreType' => 15, 'id' => 16, 'createdAt' => 17, 'updatedAt' => 18, ),
		BasePeer::TYPE_COLNAME => array (self::SHALLOW_SPIDERED_AT => 0, self::ENABLED => 1, self::NAME => 2, self::SHORT_NAME => 3, self::SLUG => 4, self::STATE => 5, self::ZIP => 6, self::LOCAL_TAX => 7, self::AMAZON_TAG => 8, self::SUBDOMAIN => 9, self::DEPTS_TO_IGNORE => 10, self::NB_CAMPUSES => 11, self::SPIDERED_AT => 12, self::TOUCHED => 13, self::B_ID => 14, self::BOOKSTORE_TYPE => 15, self::ID => 16, self::CREATED_AT => 17, self::UPDATED_AT => 18, ),
		BasePeer::TYPE_RAW_COLNAME => array ('SHALLOW_SPIDERED_AT' => 0, 'ENABLED' => 1, 'NAME' => 2, 'SHORT_NAME' => 3, 'SLUG' => 4, 'STATE' => 5, 'ZIP' => 6, 'LOCAL_TAX' => 7, 'AMAZON_TAG' => 8, 'SUBDOMAIN' => 9, 'DEPTS_TO_IGNORE' => 10, 'NB_CAMPUSES' => 11, 'SPIDERED_AT' => 12, 'TOUCHED' => 13, 'B_ID' => 14, 'BOOKSTORE_TYPE' => 15, 'ID' => 16, 'CREATED_AT' => 17, 'UPDATED_AT' => 18, ),
		BasePeer::TYPE_FIELDNAME => array ('shallow_spidered_at' => 0, 'enabled' => 1, 'name' => 2, 'short_name' => 3, 'slug' => 4, 'state' => 5, 'zip' => 6, 'local_tax' => 7, 'amazon_tag' => 8, 'subdomain' => 9, 'depts_to_ignore' => 10, 'nb_campuses' => 11, 'spidered_at' => 12, 'touched' => 13, 'b_id' => 14, 'bookstore_type' => 15, 'id' => 16, 'created_at' => 17, 'updated_at' => 18, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, )
	);

	/**
	 * Translates a fieldname to another type
	 *
	 * @param      string $name field name
	 * @param      string $fromType One of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME
	 *                         BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM
	 * @param      string $toType   One of the class type constants
	 * @return     string translated name of the field.
	 * @throws     PropelException - if the specified name could not be found in the fieldname mappings.
	 */
	static public function translateFieldName($name, $fromType, $toType)
	{
		$toNames = self::getFieldNames($toType);
		$key = isset(self::$fieldKeys[$fromType][$name]) ? self::$fieldKeys[$fromType][$name] : null;
		if ($key === null) {
			throw new PropelException("'$name' could not be found in the field names of type '$fromType'. These are: " . print_r(self::$fieldKeys[$fromType], true));
		}
		return $toNames[$key];
	}

	/**
	 * Returns an array of field names.
	 *
	 * @param      string $type The type of fieldnames to return:
	 *                      One of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME
	 *                      BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM
	 * @return     array A list of field names
	 */

	static public function getFieldNames($type = BasePeer::TYPE_PHPNAME)
	{
		if (!array_key_exists($type, self::$fieldNames)) {
			throw new PropelException('Method getFieldNames() expects the parameter $type to be one of the class constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME, BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM. ' . $type . ' was given.');
		}
		return self::$fieldNames[$type];
	}

	/**
	 * Convenience method which changes table.column to alias.column.
	 *
	 * Using this method you can maintain SQL abstraction while using column aliases.
	 * <code>
	 *		$c->addAlias("alias1", TablePeer::TABLE_NAME);
	 *		$c->addJoin(TablePeer::alias("alias1", TablePeer::PRIMARY_KEY_COLUMN), TablePeer::PRIMARY_KEY_COLUMN);
	 * </code>
	 * @param      string $alias The alias for the current table.
	 * @param      string $column The column name for current table. (i.e. SchoolPeer::COLUMN_NAME).
	 * @return     string
	 */
	public static function alias($alias, $column)
	{
		return str_replace(SchoolPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	/**
	 * Add all the columns needed to create a new object.
	 *
	 * Note: any columns that were marked with lazyLoad="true" in the
	 * XML schema will not be added to the select list and only loaded
	 * on demand.
	 *
	 * @param      Criteria $criteria object containing the columns to add.
	 * @param      string   $alias    optional table alias
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function addSelectColumns(Criteria $criteria, $alias = null)
	{
		if (null === $alias) {
			$criteria->addSelectColumn(SchoolPeer::SHALLOW_SPIDERED_AT);
			$criteria->addSelectColumn(SchoolPeer::ENABLED);
			$criteria->addSelectColumn(SchoolPeer::NAME);
			$criteria->addSelectColumn(SchoolPeer::SHORT_NAME);
			$criteria->addSelectColumn(SchoolPeer::SLUG);
			$criteria->addSelectColumn(SchoolPeer::STATE);
			$criteria->addSelectColumn(SchoolPeer::ZIP);
			$criteria->addSelectColumn(SchoolPeer::LOCAL_TAX);
			$criteria->addSelectColumn(SchoolPeer::AMAZON_TAG);
			$criteria->addSelectColumn(SchoolPeer::SUBDOMAIN);
			$criteria->addSelectColumn(SchoolPeer::DEPTS_TO_IGNORE);
			$criteria->addSelectColumn(SchoolPeer::NB_CAMPUSES);
			$criteria->addSelectColumn(SchoolPeer::SPIDERED_AT);
			$criteria->addSelectColumn(SchoolPeer::TOUCHED);
			$criteria->addSelectColumn(SchoolPeer::B_ID);
			$criteria->addSelectColumn(SchoolPeer::BOOKSTORE_TYPE);
			$criteria->addSelectColumn(SchoolPeer::ID);
			$criteria->addSelectColumn(SchoolPeer::CREATED_AT);
			$criteria->addSelectColumn(SchoolPeer::UPDATED_AT);
		} else {
			$criteria->addSelectColumn($alias . '.SHALLOW_SPIDERED_AT');
			$criteria->addSelectColumn($alias . '.ENABLED');
			$criteria->addSelectColumn($alias . '.NAME');
			$criteria->addSelectColumn($alias . '.SHORT_NAME');
			$criteria->addSelectColumn($alias . '.SLUG');
			$criteria->addSelectColumn($alias . '.STATE');
			$criteria->addSelectColumn($alias . '.ZIP');
			$criteria->addSelectColumn($alias . '.LOCAL_TAX');
			$criteria->addSelectColumn($alias . '.AMAZON_TAG');
			$criteria->addSelectColumn($alias . '.SUBDOMAIN');
			$criteria->addSelectColumn($alias . '.DEPTS_TO_IGNORE');
			$criteria->addSelectColumn($alias . '.NB_CAMPUSES');
			$criteria->addSelectColumn($alias . '.SPIDERED_AT');
			$criteria->addSelectColumn($alias . '.TOUCHED');
			$criteria->addSelectColumn($alias . '.B_ID');
			$criteria->addSelectColumn($alias . '.BOOKSTORE_TYPE');
			$criteria->addSelectColumn($alias . '.ID');
			$criteria->addSelectColumn($alias . '.CREATED_AT');
			$criteria->addSelectColumn($alias . '.UPDATED_AT');
		}
	}

	/**
	 * Returns the number of rows matching criteria.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
	 * @param      PropelPDO $con
	 * @return     int Number of matching rows.
	 */
	public static function doCount(Criteria $criteria, $distinct = false, PropelPDO $con = null)
	{
		// we may modify criteria, so copy it first
		$criteria = clone $criteria;

		// We need to set the primary table name, since in the case that there are no WHERE columns
		// it will be impossible for the BasePeer::createSelectSql() method to determine which
		// tables go into the FROM clause.
		$criteria->setPrimaryTableName(SchoolPeer::TABLE_NAME);

		if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->setDistinct();
		}

		if (!$criteria->hasSelectClause()) {
			SchoolPeer::addSelectColumns($criteria);
		}

		$criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count
		$criteria->setDbName(self::DATABASE_NAME); // Set the correct dbName

		if ($con === null) {
			$con = Propel::getConnection(SchoolPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}
		// BasePeer returns a PDOStatement
		$stmt = BasePeer::doCount($criteria, $con);

		if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$count = (int) $row[0];
		} else {
			$count = 0; // no rows returned; we infer that means 0 matches.
		}
		$stmt->closeCursor();
		return $count;
	}
	/**
	 * Selects one object from the DB.
	 *
	 * @param      Criteria $criteria object used to create the SELECT statement.
	 * @param      PropelPDO $con
	 * @return     School
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelectOne(Criteria $criteria, PropelPDO $con = null)
	{
		$critcopy = clone $criteria;
		$critcopy->setLimit(1);
		$objects = SchoolPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	/**
	 * Selects several row from the DB.
	 *
	 * @param      Criteria $criteria The Criteria object used to build the SELECT statement.
	 * @param      PropelPDO $con
	 * @return     array Array of selected Objects
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doSelect(Criteria $criteria, PropelPDO $con = null)
	{
		return SchoolPeer::populateObjects(SchoolPeer::doSelectStmt($criteria, $con));
	}
	/**
	 * Prepares the Criteria object and uses the parent doSelect() method to execute a PDOStatement.
	 *
	 * Use this method directly if you want to work with an executed statement durirectly (for example
	 * to perform your own object hydration).
	 *
	 * @param      Criteria $criteria The Criteria object used to build the SELECT statement.
	 * @param      PropelPDO $con The connection to use
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 * @return     PDOStatement The executed PDOStatement object.
	 * @see        BasePeer::doSelect()
	 */
	public static function doSelectStmt(Criteria $criteria, PropelPDO $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(SchoolPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		if (!$criteria->hasSelectClause()) {
			$criteria = clone $criteria;
			SchoolPeer::addSelectColumns($criteria);
		}

		// Set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		// BasePeer returns a PDOStatement
		return BasePeer::doSelect($criteria, $con);
	}
	/**
	 * Adds an object to the instance pool.
	 *
	 * Propel keeps cached copies of objects in an instance pool when they are retrieved
	 * from the database.  In some cases -- especially when you override doSelect*()
	 * methods in your stub classes -- you may need to explicitly add objects
	 * to the cache in order to ensure that the same objects are always returned by doSelect*()
	 * and retrieveByPK*() calls.
	 *
	 * @param      School $value A School object.
	 * @param      string $key (optional) key to use for instance map (for performance boost if key was already calculated externally).
	 */
	public static function addInstanceToPool($obj, $key = null)
	{
		if (Propel::isInstancePoolingEnabled()) {
			if ($key === null) {
				$key = (string) $obj->getId();
			} // if key === null
			self::$instances[$key] = $obj;
		}
	}

	/**
	 * Removes an object from the instance pool.
	 *
	 * Propel keeps cached copies of objects in an instance pool when they are retrieved
	 * from the database.  In some cases -- especially when you override doDelete
	 * methods in your stub classes -- you may need to explicitly remove objects
	 * from the cache in order to prevent returning objects that no longer exist.
	 *
	 * @param      mixed $value A School object or a primary key value.
	 */
	public static function removeInstanceFromPool($value)
	{
		if (Propel::isInstancePoolingEnabled() && $value !== null) {
			if (is_object($value) && $value instanceof School) {
				$key = (string) $value->getId();
			} elseif (is_scalar($value)) {
				// assume we've been passed a primary key
				$key = (string) $value;
			} else {
				$e = new PropelException("Invalid value passed to removeInstanceFromPool().  Expected primary key or School object; got " . (is_object($value) ? get_class($value) . ' object.' : var_export($value,true)));
				throw $e;
			}

			unset(self::$instances[$key]);
		}
	} // removeInstanceFromPool()

	/**
	 * Retrieves a string version of the primary key from the DB resultset row that can be used to uniquely identify a row in this table.
	 *
	 * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
	 * a multi-column primary key, a serialize()d version of the primary key will be returned.
	 *
	 * @param      string $key The key (@see getPrimaryKeyHash()) for this instance.
	 * @return     School Found object or NULL if 1) no instance exists for specified key or 2) instance pooling has been disabled.
	 * @see        getPrimaryKeyHash()
	 */
	public static function getInstanceFromPool($key)
	{
		if (Propel::isInstancePoolingEnabled()) {
			if (isset(self::$instances[$key])) {
				return self::$instances[$key];
			}
		}
		return null; // just to be explicit
	}
	
	/**
	 * Clear the instance pool.
	 *
	 * @return     void
	 */
	public static function clearInstancePool()
	{
		self::$instances = array();
	}
	
	/**
	 * Method to invalidate the instance pool of all tables related to school
	 * by a foreign key with ON DELETE CASCADE
	 */
	public static function clearRelatedInstancePool()
	{
		// Invalidate objects in CampusPeer instance pool,
		// since one or more of them may be deleted by ON DELETE CASCADE/SETNULL rule.
		CampusPeer::clearInstancePool();
	}

	/**
	 * Retrieves a string version of the primary key from the DB resultset row that can be used to uniquely identify a row in this table.
	 *
	 * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
	 * a multi-column primary key, a serialize()d version of the primary key will be returned.
	 *
	 * @param      array $row PropelPDO resultset row.
	 * @param      int $startcol The 0-based offset for reading from the resultset row.
	 * @return     string A string version of PK or NULL if the components of primary key in result array are all null.
	 */
	public static function getPrimaryKeyHashFromRow($row, $startcol = 0)
	{
		// If the PK cannot be derived from the row, return NULL.
		if ($row[$startcol + 16] === null) {
			return null;
		}
		return (string) $row[$startcol + 16];
	}

	/**
	 * Retrieves the primary key from the DB resultset row
	 * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
	 * a multi-column primary key, an array of the primary key columns will be returned.
	 *
	 * @param      array $row PropelPDO resultset row.
	 * @param      int $startcol The 0-based offset for reading from the resultset row.
	 * @return     mixed The primary key of the row
	 */
	public static function getPrimaryKeyFromRow($row, $startcol = 0)
	{
		return (int) $row[$startcol + 16];
	}
	
	/**
	 * The returned array will contain objects of the default type or
	 * objects that inherit from the default.
	 *
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function populateObjects(PDOStatement $stmt)
	{
		$results = array();
	
		// set the class once to avoid overhead in the loop
		$cls = SchoolPeer::getOMClass();
		// populate the object(s)
		while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$key = SchoolPeer::getPrimaryKeyHashFromRow($row, 0);
			if (null !== ($obj = SchoolPeer::getInstanceFromPool($key))) {
				// We no longer rehydrate the object, since this can cause data loss.
				// See http://www.propelorm.org/ticket/509
				// $obj->hydrate($row, 0, true); // rehydrate
				$results[] = $obj;
			} else {
				$obj = new $cls();
				$obj->hydrate($row);
				$results[] = $obj;
				SchoolPeer::addInstanceToPool($obj, $key);
			} // if key exists
		}
		$stmt->closeCursor();
		return $results;
	}
	/**
	 * Populates an object of the default type or an object that inherit from the default.
	 *
	 * @param      array $row PropelPDO resultset row.
	 * @param      int $startcol The 0-based offset for reading from the resultset row.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 * @return     array (School object, last column rank)
	 */
	public static function populateObject($row, $startcol = 0)
	{
		$key = SchoolPeer::getPrimaryKeyHashFromRow($row, $startcol);
		if (null !== ($obj = SchoolPeer::getInstanceFromPool($key))) {
			// We no longer rehydrate the object, since this can cause data loss.
			// See http://www.propelorm.org/ticket/509
			// $obj->hydrate($row, $startcol, true); // rehydrate
			$col = $startcol + SchoolPeer::NUM_HYDRATE_COLUMNS;
		} else {
			$cls = SchoolPeer::OM_CLASS;
			$obj = new $cls();
			$col = $obj->hydrate($row, $startcol);
			SchoolPeer::addInstanceToPool($obj, $key);
		}
		return array($obj, $col);
	}

	/**
	 * Returns the TableMap related to this peer.
	 * This method is not needed for general use but a specific application could have a need.
	 * @return     TableMap
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function getTableMap()
	{
		return Propel::getDatabaseMap(self::DATABASE_NAME)->getTable(self::TABLE_NAME);
	}

	/**
	 * Add a TableMap instance to the database for this peer class.
	 */
	public static function buildTableMap()
	{
	  $dbMap = Propel::getDatabaseMap(BaseSchoolPeer::DATABASE_NAME);
	  if (!$dbMap->hasTable(BaseSchoolPeer::TABLE_NAME))
	  {
	    $dbMap->addTableObject(new SchoolTableMap());
	  }
	}

	/**
	 * The class that the Peer will make instances of.
	 *
	 *
	 * @return     string ClassName
	 */
	public static function getOMClass()
	{
		return SchoolPeer::OM_CLASS;
	}

	/**
	 * Performs an INSERT on the database, given a School or Criteria object.
	 *
	 * @param      mixed $values Criteria or School object containing data that is used to create the INSERT statement.
	 * @param      PropelPDO $con the PropelPDO connection to use
	 * @return     mixed The new primary key.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doInsert($values, PropelPDO $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(SchoolPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; // rename for clarity
		} else {
			$criteria = $values->buildCriteria(); // build Criteria from School object
		}

		if ($criteria->containsKey(SchoolPeer::ID) && $criteria->keyContainsValue(SchoolPeer::ID) ) {
			throw new PropelException('Cannot insert a value for auto-increment primary key ('.SchoolPeer::ID.')');
		}


		// Set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		try {
			// use transaction because $criteria could contain info
			// for more than one table (I guess, conceivably)
			$con->beginTransaction();
			$pk = BasePeer::doInsert($criteria, $con);
			$con->commit();
		} catch(PropelException $e) {
			$con->rollBack();
			throw $e;
		}

		return $pk;
	}

	/**
	 * Performs an UPDATE on the database, given a School or Criteria object.
	 *
	 * @param      mixed $values Criteria or School object containing data that is used to create the UPDATE statement.
	 * @param      PropelPDO $con The connection to use (specify PropelPDO connection object to exert more control over transactions).
	 * @return     int The number of affected rows (if supported by underlying database driver).
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function doUpdate($values, PropelPDO $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(SchoolPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		$selectCriteria = new Criteria(self::DATABASE_NAME);

		if ($values instanceof Criteria) {
			$criteria = clone $values; // rename for clarity

			$comparison = $criteria->getComparison(SchoolPeer::ID);
			$value = $criteria->remove(SchoolPeer::ID);
			if ($value) {
				$selectCriteria->add(SchoolPeer::ID, $value, $comparison);
			} else {
				$selectCriteria->setPrimaryTableName(SchoolPeer::TABLE_NAME);
			}

		} else { // $values is School object
			$criteria = $values->buildCriteria(); // gets full criteria
			$selectCriteria = $values->buildPkeyCriteria(); // gets criteria w/ primary key(s)
		}

		// set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		return BasePeer::doUpdate($selectCriteria, $criteria, $con);
	}

	/**
	 * Deletes all rows from the school table.
	 *
	 * @param      PropelPDO $con the connection to use
	 * @return     int The number of affected rows (if supported by underlying database driver).
	 */
	public static function doDeleteAll(PropelPDO $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(SchoolPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		$affectedRows = 0; // initialize var to track total num of affected rows
		try {
			// use transaction because $criteria could contain info
			// for more than one table or we could emulating ON DELETE CASCADE, etc.
			$con->beginTransaction();
			$affectedRows += SchoolPeer::doOnDeleteCascade(new Criteria(SchoolPeer::DATABASE_NAME), $con);
			$affectedRows += BasePeer::doDeleteAll(SchoolPeer::TABLE_NAME, $con, SchoolPeer::DATABASE_NAME);
			// Because this db requires some delete cascade/set null emulation, we have to
			// clear the cached instance *after* the emulation has happened (since
			// instances get re-added by the select statement contained therein).
			SchoolPeer::clearInstancePool();
			SchoolPeer::clearRelatedInstancePool();
			$con->commit();
			return $affectedRows;
		} catch (PropelException $e) {
			$con->rollBack();
			throw $e;
		}
	}

	/**
	 * Performs a DELETE on the database, given a School or Criteria object OR a primary key value.
	 *
	 * @param      mixed $values Criteria or School object or primary key or array of primary keys
	 *              which is used to create the DELETE statement
	 * @param      PropelPDO $con the connection to use
	 * @return     int 	The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
	 *				if supported by native driver or if emulated using Propel.
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	 public static function doDelete($values, PropelPDO $con = null)
	 {
		if ($con === null) {
			$con = Propel::getConnection(SchoolPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		if ($values instanceof Criteria) {
			// rename for clarity
			$criteria = clone $values;
		} elseif ($values instanceof School) { // it's a model object
			// create criteria based on pk values
			$criteria = $values->buildPkeyCriteria();
		} else { // it's a primary key, or an array of pks
			$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(SchoolPeer::ID, (array) $values, Criteria::IN);
		}

		// Set the correct dbName
		$criteria->setDbName(self::DATABASE_NAME);

		$affectedRows = 0; // initialize var to track total num of affected rows

		try {
			// use transaction because $criteria could contain info
			// for more than one table or we could emulating ON DELETE CASCADE, etc.
			$con->beginTransaction();
			
			// cloning the Criteria in case it's modified by doSelect() or doSelectStmt()
			$c = clone $criteria;
			$affectedRows += SchoolPeer::doOnDeleteCascade($c, $con);
			
			// Because this db requires some delete cascade/set null emulation, we have to
			// clear the cached instance *after* the emulation has happened (since
			// instances get re-added by the select statement contained therein).
			if ($values instanceof Criteria) {
				SchoolPeer::clearInstancePool();
			} elseif ($values instanceof School) { // it's a model object
				SchoolPeer::removeInstanceFromPool($values);
			} else { // it's a primary key, or an array of pks
				foreach ((array) $values as $singleval) {
					SchoolPeer::removeInstanceFromPool($singleval);
				}
			}
			
			$affectedRows += BasePeer::doDelete($criteria, $con);
			SchoolPeer::clearRelatedInstancePool();
			$con->commit();
			return $affectedRows;
		} catch (PropelException $e) {
			$con->rollBack();
			throw $e;
		}
	}

	/**
	 * This is a method for emulating ON DELETE CASCADE for DBs that don't support this
	 * feature (like MySQL or SQLite).
	 *
	 * This method is not very speedy because it must perform a query first to get
	 * the implicated records and then perform the deletes by calling those Peer classes.
	 *
	 * This method should be used within a transaction if possible.
	 *
	 * @param      Criteria $criteria
	 * @param      PropelPDO $con
	 * @return     int The number of affected rows (if supported by underlying database driver).
	 */
	protected static function doOnDeleteCascade(Criteria $criteria, PropelPDO $con)
	{
		// initialize var to track total num of affected rows
		$affectedRows = 0;

		// first find the objects that are implicated by the $criteria
		$objects = SchoolPeer::doSelect($criteria, $con);
		foreach ($objects as $obj) {


			// delete related Campus objects
			$criteria = new Criteria(CampusPeer::DATABASE_NAME);
			
			$criteria->add(CampusPeer::SCHOOL_ID, $obj->getId());
			$affectedRows += CampusPeer::doDelete($criteria, $con);
		}
		return $affectedRows;
	}

	/**
	 * Validates all modified columns of given School object.
	 * If parameter $columns is either a single column name or an array of column names
	 * than only those columns are validated.
	 *
	 * NOTICE: This does not apply to primary or foreign keys for now.
	 *
	 * @param      School $obj The object to validate.
	 * @param      mixed $cols Column name or array of column names.
	 *
	 * @return     mixed TRUE if all columns are valid or the error message of the first invalid column.
	 */
	public static function doValidate($obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(SchoolPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(SchoolPeer::TABLE_NAME);

			if (! is_array($cols)) {
				$cols = array($cols);
			}

			foreach ($cols as $colName) {
				if ($tableMap->containsColumn($colName)) {
					$get = 'get' . $tableMap->getColumn($colName)->getPhpName();
					$columns[$colName] = $obj->$get();
				}
			}
		} else {

		}

		return BasePeer::doValidate(SchoolPeer::DATABASE_NAME, SchoolPeer::TABLE_NAME, $columns);
	}

	/**
	 * Retrieve a single object by pkey.
	 *
	 * @param      int $pk the primary key.
	 * @param      PropelPDO $con the connection to use
	 * @return     School
	 */
	public static function retrieveByPK($pk, PropelPDO $con = null)
	{

		if (null !== ($obj = SchoolPeer::getInstanceFromPool((string) $pk))) {
			return $obj;
		}

		if ($con === null) {
			$con = Propel::getConnection(SchoolPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$criteria = new Criteria(SchoolPeer::DATABASE_NAME);
		$criteria->add(SchoolPeer::ID, $pk);

		$v = SchoolPeer::doSelect($criteria, $con);

		return !empty($v) > 0 ? $v[0] : null;
	}

	/**
	 * Retrieve multiple objects by pkey.
	 *
	 * @param      array $pks List of primary keys
	 * @param      PropelPDO $con the connection to use
	 * @throws     PropelException Any exceptions caught during processing will be
	 *		 rethrown wrapped into a PropelException.
	 */
	public static function retrieveByPKs($pks, PropelPDO $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(SchoolPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		$objs = null;
		if (empty($pks)) {
			$objs = array();
		} else {
			$criteria = new Criteria(SchoolPeer::DATABASE_NAME);
			$criteria->add(SchoolPeer::ID, $pks, Criteria::IN);
			$objs = SchoolPeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} // BaseSchoolPeer

// This is the static code needed to register the TableMap for this table with the main Propel class.
//
BaseSchoolPeer::buildTableMap();

