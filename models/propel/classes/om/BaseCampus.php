<?php


/**
 * Base class that represents a row from the 'campus' table.
 *
 * 
 *
 * @package    propel.generator..om
 */
abstract class BaseCampus extends Spiderable  implements Persistent
{

	/**
	 * Peer class name
	 */
	const PEER = 'CampusPeer';

	/**
	 * The Peer class.
	 * Instance provides a convenient way of calling static methods on a class
	 * that calling code may not be able to identify.
	 * @var        CampusPeer
	 */
	protected static $peer;

	/**
	 * The flag var to prevent infinit loop in deep copy
	 * @var       boolean
	 */
	protected $startCopy = false;

	/**
	 * The value for the shallow_spidered_at field.
	 * @var        string
	 */
	protected $shallow_spidered_at;

	/**
	 * The value for the name field.
	 * @var        string
	 */
	protected $name;

	/**
	 * The value for the slug field.
	 * @var        string
	 */
	protected $slug;

	/**
	 * The value for the school_id field.
	 * @var        int
	 */
	protected $school_id;

	/**
	 * The value for the spidered_at field.
	 * @var        string
	 */
	protected $spidered_at;

	/**
	 * The value for the touched field.
	 * @var        boolean
	 */
	protected $touched;

	/**
	 * The value for the b_id field.
	 * @var        string
	 */
	protected $b_id;

	/**
	 * The value for the bookstore_type field.
	 * @var        string
	 */
	protected $bookstore_type;

	/**
	 * The value for the id field.
	 * @var        int
	 */
	protected $id;

	/**
	 * The value for the created_at field.
	 * @var        string
	 */
	protected $created_at;

	/**
	 * The value for the updated_at field.
	 * @var        string
	 */
	protected $updated_at;

	/**
	 * @var        School
	 */
	protected $aSchool;

	/**
	 * @var        array Term[] Collection to store aggregation of Term objects.
	 */
	protected $collTerms;

	/**
	 * Flag to prevent endless save loop, if this object is referenced
	 * by another object which falls in this transaction.
	 * @var        boolean
	 */
	protected $alreadyInSave = false;

	/**
	 * Flag to prevent endless validation loop, if this object is referenced
	 * by another object which falls in this transaction.
	 * @var        boolean
	 */
	protected $alreadyInValidation = false;

	// aggregate_column_relation behavior
	protected $oldSchool;

	/**
	 * An array of objects scheduled for deletion.
	 * @var		array
	 */
	protected $termsScheduledForDeletion = null;

	/**
	 * Get the [optionally formatted] temporal [shallow_spidered_at] column value.
	 * 
	 *
	 * @param      string $format The date/time format string (either date()-style or strftime()-style).
	 *							If format is NULL, then the raw DateTime object will be returned.
	 * @return     mixed Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL, and 0 if column value is 0000-00-00 00:00:00
	 * @throws     PropelException - if unable to parse/validate the date/time value.
	 */
	public function getShallowSpideredAt($format = 'Y-m-d H:i:s')
	{
		if ($this->shallow_spidered_at === null) {
			return null;
		}


		if ($this->shallow_spidered_at === '0000-00-00 00:00:00') {
			// while technically this is not a default value of NULL,
			// this seems to be closest in meaning.
			return null;
		} else {
			try {
				$dt = new DateTime($this->shallow_spidered_at);
			} catch (Exception $x) {
				throw new PropelException("Internally stored date/time/timestamp value could not be converted to DateTime: " . var_export($this->shallow_spidered_at, true), $x);
			}
		}

		if ($format === null) {
			// Because propel.useDateTimeClass is TRUE, we return a DateTime object.
			return $dt;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $dt->format('U'));
		} else {
			return $dt->format($format);
		}
	}

	/**
	 * Get the [name] column value.
	 * 
	 * @return     string
	 */
	public function getName()
	{
		return $this->name;
	}

	/**
	 * Get the [slug] column value.
	 * 
	 * @return     string
	 */
	public function getSlug()
	{
		return $this->slug;
	}

	/**
	 * Get the [school_id] column value.
	 * 
	 * @return     int
	 */
	public function getSchoolId()
	{
		return $this->school_id;
	}

	/**
	 * Get the [optionally formatted] temporal [spidered_at] column value.
	 * 
	 *
	 * @param      string $format The date/time format string (either date()-style or strftime()-style).
	 *							If format is NULL, then the raw DateTime object will be returned.
	 * @return     mixed Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL, and 0 if column value is 0000-00-00 00:00:00
	 * @throws     PropelException - if unable to parse/validate the date/time value.
	 */
	public function getSpideredAt($format = 'Y-m-d H:i:s')
	{
		if ($this->spidered_at === null) {
			return null;
		}


		if ($this->spidered_at === '0000-00-00 00:00:00') {
			// while technically this is not a default value of NULL,
			// this seems to be closest in meaning.
			return null;
		} else {
			try {
				$dt = new DateTime($this->spidered_at);
			} catch (Exception $x) {
				throw new PropelException("Internally stored date/time/timestamp value could not be converted to DateTime: " . var_export($this->spidered_at, true), $x);
			}
		}

		if ($format === null) {
			// Because propel.useDateTimeClass is TRUE, we return a DateTime object.
			return $dt;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $dt->format('U'));
		} else {
			return $dt->format($format);
		}
	}

	/**
	 * Get the [touched] column value.
	 * 
	 * @return     boolean
	 */
	public function getTouched()
	{
		return $this->touched;
	}

	/**
	 * Get the [b_id] column value.
	 * 
	 * @return     string
	 */
	public function getBId()
	{
		return $this->b_id;
	}

	/**
	 * Get the [bookstore_type] column value.
	 * 
	 * @return     string
	 */
	public function getBookstoreType()
	{
		return $this->bookstore_type;
	}

	/**
	 * Get the [id] column value.
	 * 
	 * @return     int
	 */
	public function getId()
	{
		return $this->id;
	}

	/**
	 * Get the [optionally formatted] temporal [created_at] column value.
	 * 
	 *
	 * @param      string $format The date/time format string (either date()-style or strftime()-style).
	 *							If format is NULL, then the raw DateTime object will be returned.
	 * @return     mixed Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL, and 0 if column value is 0000-00-00 00:00:00
	 * @throws     PropelException - if unable to parse/validate the date/time value.
	 */
	public function getCreatedAt($format = 'Y-m-d H:i:s')
	{
		if ($this->created_at === null) {
			return null;
		}


		if ($this->created_at === '0000-00-00 00:00:00') {
			// while technically this is not a default value of NULL,
			// this seems to be closest in meaning.
			return null;
		} else {
			try {
				$dt = new DateTime($this->created_at);
			} catch (Exception $x) {
				throw new PropelException("Internally stored date/time/timestamp value could not be converted to DateTime: " . var_export($this->created_at, true), $x);
			}
		}

		if ($format === null) {
			// Because propel.useDateTimeClass is TRUE, we return a DateTime object.
			return $dt;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $dt->format('U'));
		} else {
			return $dt->format($format);
		}
	}

	/**
	 * Get the [optionally formatted] temporal [updated_at] column value.
	 * 
	 *
	 * @param      string $format The date/time format string (either date()-style or strftime()-style).
	 *							If format is NULL, then the raw DateTime object will be returned.
	 * @return     mixed Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL, and 0 if column value is 0000-00-00 00:00:00
	 * @throws     PropelException - if unable to parse/validate the date/time value.
	 */
	public function getUpdatedAt($format = 'Y-m-d H:i:s')
	{
		if ($this->updated_at === null) {
			return null;
		}


		if ($this->updated_at === '0000-00-00 00:00:00') {
			// while technically this is not a default value of NULL,
			// this seems to be closest in meaning.
			return null;
		} else {
			try {
				$dt = new DateTime($this->updated_at);
			} catch (Exception $x) {
				throw new PropelException("Internally stored date/time/timestamp value could not be converted to DateTime: " . var_export($this->updated_at, true), $x);
			}
		}

		if ($format === null) {
			// Because propel.useDateTimeClass is TRUE, we return a DateTime object.
			return $dt;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $dt->format('U'));
		} else {
			return $dt->format($format);
		}
	}

	/**
	 * Sets the value of [shallow_spidered_at] column to a normalized version of the date/time value specified.
	 * 
	 * @param      mixed $v string, integer (timestamp), or DateTime value.
	 *               Empty strings are treated as NULL.
	 * @return     Campus The current object (for fluent API support)
	 */
	public function setShallowSpideredAt($v)
	{
		$dt = PropelDateTime::newInstance($v, null, 'DateTime');
		if ($this->shallow_spidered_at !== null || $dt !== null) {
			$currentDateAsString = ($this->shallow_spidered_at !== null && $tmpDt = new DateTime($this->shallow_spidered_at)) ? $tmpDt->format('Y-m-d H:i:s') : null;
			$newDateAsString = $dt ? $dt->format('Y-m-d H:i:s') : null;
			if ($currentDateAsString !== $newDateAsString) {
				$this->shallow_spidered_at = $newDateAsString;
				$this->modifiedColumns[] = CampusPeer::SHALLOW_SPIDERED_AT;
			}
		} // if either are not null

		return $this;
	} // setShallowSpideredAt()

	/**
	 * Set the value of [name] column.
	 * 
	 * @param      string $v new value
	 * @return     Campus The current object (for fluent API support)
	 */
	public function setName($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->name !== $v) {
			$this->name = $v;
			$this->modifiedColumns[] = CampusPeer::NAME;
		}

		return $this;
	} // setName()

	/**
	 * Set the value of [slug] column.
	 * 
	 * @param      string $v new value
	 * @return     Campus The current object (for fluent API support)
	 */
	public function setSlug($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->slug !== $v) {
			$this->slug = $v;
			$this->modifiedColumns[] = CampusPeer::SLUG;
		}

		return $this;
	} // setSlug()

	/**
	 * Set the value of [school_id] column.
	 * 
	 * @param      int $v new value
	 * @return     Campus The current object (for fluent API support)
	 */
	public function setSchoolId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->school_id !== $v) {
			$this->school_id = $v;
			$this->modifiedColumns[] = CampusPeer::SCHOOL_ID;
		}

		if ($this->aSchool !== null && $this->aSchool->getId() !== $v) {
			$this->aSchool = null;
		}

		return $this;
	} // setSchoolId()

	/**
	 * Sets the value of [spidered_at] column to a normalized version of the date/time value specified.
	 * 
	 * @param      mixed $v string, integer (timestamp), or DateTime value.
	 *               Empty strings are treated as NULL.
	 * @return     Campus The current object (for fluent API support)
	 */
	public function setSpideredAt($v)
	{
		$dt = PropelDateTime::newInstance($v, null, 'DateTime');
		if ($this->spidered_at !== null || $dt !== null) {
			$currentDateAsString = ($this->spidered_at !== null && $tmpDt = new DateTime($this->spidered_at)) ? $tmpDt->format('Y-m-d H:i:s') : null;
			$newDateAsString = $dt ? $dt->format('Y-m-d H:i:s') : null;
			if ($currentDateAsString !== $newDateAsString) {
				$this->spidered_at = $newDateAsString;
				$this->modifiedColumns[] = CampusPeer::SPIDERED_AT;
			}
		} // if either are not null

		return $this;
	} // setSpideredAt()

	/**
	 * Sets the value of the [touched] column.
	 * Non-boolean arguments are converted using the following rules:
	 *   * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
	 *   * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
	 * Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
	 * 
	 * @param      boolean|integer|string $v The new value
	 * @return     Campus The current object (for fluent API support)
	 */
	public function setTouched($v)
	{
		if ($v !== null) {
			if (is_string($v)) {
				$v = in_array(strtolower($v), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
			} else {
				$v = (boolean) $v;
			}
		}

		if ($this->touched !== $v) {
			$this->touched = $v;
			$this->modifiedColumns[] = CampusPeer::TOUCHED;
		}

		return $this;
	} // setTouched()

	/**
	 * Set the value of [b_id] column.
	 * 
	 * @param      string $v new value
	 * @return     Campus The current object (for fluent API support)
	 */
	public function setBId($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->b_id !== $v) {
			$this->b_id = $v;
			$this->modifiedColumns[] = CampusPeer::B_ID;
		}

		return $this;
	} // setBId()

	/**
	 * Set the value of [bookstore_type] column.
	 * 
	 * @param      string $v new value
	 * @return     Campus The current object (for fluent API support)
	 */
	public function setBookstoreType($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->bookstore_type !== $v) {
			$this->bookstore_type = $v;
			$this->modifiedColumns[] = CampusPeer::BOOKSTORE_TYPE;
		}

		return $this;
	} // setBookstoreType()

	/**
	 * Set the value of [id] column.
	 * 
	 * @param      int $v new value
	 * @return     Campus The current object (for fluent API support)
	 */
	public function setId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = CampusPeer::ID;
		}

		return $this;
	} // setId()

	/**
	 * Sets the value of [created_at] column to a normalized version of the date/time value specified.
	 * 
	 * @param      mixed $v string, integer (timestamp), or DateTime value.
	 *               Empty strings are treated as NULL.
	 * @return     Campus The current object (for fluent API support)
	 */
	public function setCreatedAt($v)
	{
		$dt = PropelDateTime::newInstance($v, null, 'DateTime');
		if ($this->created_at !== null || $dt !== null) {
			$currentDateAsString = ($this->created_at !== null && $tmpDt = new DateTime($this->created_at)) ? $tmpDt->format('Y-m-d H:i:s') : null;
			$newDateAsString = $dt ? $dt->format('Y-m-d H:i:s') : null;
			if ($currentDateAsString !== $newDateAsString) {
				$this->created_at = $newDateAsString;
				$this->modifiedColumns[] = CampusPeer::CREATED_AT;
			}
		} // if either are not null

		return $this;
	} // setCreatedAt()

	/**
	 * Sets the value of [updated_at] column to a normalized version of the date/time value specified.
	 * 
	 * @param      mixed $v string, integer (timestamp), or DateTime value.
	 *               Empty strings are treated as NULL.
	 * @return     Campus The current object (for fluent API support)
	 */
	public function setUpdatedAt($v)
	{
		$dt = PropelDateTime::newInstance($v, null, 'DateTime');
		if ($this->updated_at !== null || $dt !== null) {
			$currentDateAsString = ($this->updated_at !== null && $tmpDt = new DateTime($this->updated_at)) ? $tmpDt->format('Y-m-d H:i:s') : null;
			$newDateAsString = $dt ? $dt->format('Y-m-d H:i:s') : null;
			if ($currentDateAsString !== $newDateAsString) {
				$this->updated_at = $newDateAsString;
				$this->modifiedColumns[] = CampusPeer::UPDATED_AT;
			}
		} // if either are not null

		return $this;
	} // setUpdatedAt()

	/**
	 * Indicates whether the columns in this object are only set to default values.
	 *
	 * This method can be used in conjunction with isModified() to indicate whether an object is both
	 * modified _and_ has some values set which are non-default.
	 *
	 * @return     boolean Whether the columns in this object are only been set with default values.
	 */
	public function hasOnlyDefaultValues()
	{
		// otherwise, everything was equal, so return TRUE
		return true;
	} // hasOnlyDefaultValues()

	/**
	 * Hydrates (populates) the object variables with values from the database resultset.
	 *
	 * An offset (0-based "start column") is specified so that objects can be hydrated
	 * with a subset of the columns in the resultset rows.  This is needed, for example,
	 * for results of JOIN queries where the resultset row includes columns from two or
	 * more tables.
	 *
	 * @param      array $row The row returned by PDOStatement->fetch(PDO::FETCH_NUM)
	 * @param      int $startcol 0-based offset column which indicates which restultset column to start with.
	 * @param      boolean $rehydrate Whether this object is being re-hydrated from the database.
	 * @return     int next starting column
	 * @throws     PropelException  - Any caught Exception will be rewrapped as a PropelException.
	 */
	public function hydrate($row, $startcol = 0, $rehydrate = false)
	{
		try {

			$this->shallow_spidered_at = ($row[$startcol + 0] !== null) ? (string) $row[$startcol + 0] : null;
			$this->name = ($row[$startcol + 1] !== null) ? (string) $row[$startcol + 1] : null;
			$this->slug = ($row[$startcol + 2] !== null) ? (string) $row[$startcol + 2] : null;
			$this->school_id = ($row[$startcol + 3] !== null) ? (int) $row[$startcol + 3] : null;
			$this->spidered_at = ($row[$startcol + 4] !== null) ? (string) $row[$startcol + 4] : null;
			$this->touched = ($row[$startcol + 5] !== null) ? (boolean) $row[$startcol + 5] : null;
			$this->b_id = ($row[$startcol + 6] !== null) ? (string) $row[$startcol + 6] : null;
			$this->bookstore_type = ($row[$startcol + 7] !== null) ? (string) $row[$startcol + 7] : null;
			$this->id = ($row[$startcol + 8] !== null) ? (int) $row[$startcol + 8] : null;
			$this->created_at = ($row[$startcol + 9] !== null) ? (string) $row[$startcol + 9] : null;
			$this->updated_at = ($row[$startcol + 10] !== null) ? (string) $row[$startcol + 10] : null;
			$this->resetModified();

			$this->setNew(false);

			if ($rehydrate) {
				$this->ensureConsistency();
			}

			return $startcol + 11; // 11 = CampusPeer::NUM_HYDRATE_COLUMNS.

		} catch (Exception $e) {
			throw new PropelException("Error populating Campus object", $e);
		}
	}

	/**
	 * Checks and repairs the internal consistency of the object.
	 *
	 * This method is executed after an already-instantiated object is re-hydrated
	 * from the database.  It exists to check any foreign keys to make sure that
	 * the objects related to the current object are correct based on foreign key.
	 *
	 * You can override this method in the stub class, but you should always invoke
	 * the base method from the overridden method (i.e. parent::ensureConsistency()),
	 * in case your model changes.
	 *
	 * @throws     PropelException
	 */
	public function ensureConsistency()
	{

		if ($this->aSchool !== null && $this->school_id !== $this->aSchool->getId()) {
			$this->aSchool = null;
		}
	} // ensureConsistency

	/**
	 * Reloads this object from datastore based on primary key and (optionally) resets all associated objects.
	 *
	 * This will only work if the object has been saved and has a valid primary key set.
	 *
	 * @param      boolean $deep (optional) Whether to also de-associated any related objects.
	 * @param      PropelPDO $con (optional) The PropelPDO connection to use.
	 * @return     void
	 * @throws     PropelException - if this object is deleted, unsaved or doesn't have pk match in db
	 */
	public function reload($deep = false, PropelPDO $con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("Cannot reload a deleted object.");
		}

		if ($this->isNew()) {
			throw new PropelException("Cannot reload an unsaved object.");
		}

		if ($con === null) {
			$con = Propel::getConnection(CampusPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		// We don't need to alter the object instance pool; we're just modifying this instance
		// already in the pool.

		$stmt = CampusPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
		$row = $stmt->fetch(PDO::FETCH_NUM);
		$stmt->closeCursor();
		if (!$row) {
			throw new PropelException('Cannot find matching row in the database to reload object values.');
		}
		$this->hydrate($row, 0, true); // rehydrate

		if ($deep) {  // also de-associate any related objects?

			$this->aSchool = null;
			$this->collTerms = null;

		} // if (deep)
	}

	/**
	 * Removes this object from datastore and sets delete attribute.
	 *
	 * @param      PropelPDO $con
	 * @return     void
	 * @throws     PropelException
	 * @see        BaseObject::setDeleted()
	 * @see        BaseObject::isDeleted()
	 */
	public function delete(PropelPDO $con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(CampusPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		$con->beginTransaction();
		try {
			$deleteQuery = CampusQuery::create()
				->filterByPrimaryKey($this->getPrimaryKey());
			$ret = $this->preDelete($con);
			if ($ret) {
				$deleteQuery->delete($con);
				$this->postDelete($con);
				$con->commit();
				$this->setDeleted(true);
			} else {
				$con->commit();
			}
		} catch (Exception $e) {
			$con->rollBack();
			throw $e;
		}
	}

	/**
	 * Persists this object to the database.
	 *
	 * If the object is new, it inserts it; otherwise an update is performed.
	 * All modified related objects will also be persisted in the doSave()
	 * method.  This method wraps all precipitate database operations in a
	 * single transaction.
	 *
	 * @param      PropelPDO $con
	 * @return     int The number of rows affected by this insert/update and any referring fk objects' save() operations.
	 * @throws     PropelException
	 * @see        doSave()
	 */
	public function save(PropelPDO $con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(CampusPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		$con->beginTransaction();
		$isInsert = $this->isNew();
		try {
			$ret = $this->preSave($con);
			if ($isInsert) {
				$ret = $ret && $this->preInsert($con);
				// spiderable behavior
				if (!$this->isColumnModified(CampusPeer::SPIDERED_AT)) {
				            $this->setSpideredAt(NULL);
				    }
				// timestampable behavior
				if (!$this->isColumnModified(CampusPeer::CREATED_AT)) {
					$this->setCreatedAt(time());
				}
				if (!$this->isColumnModified(CampusPeer::UPDATED_AT)) {
					$this->setUpdatedAt(time());
				}
			} else {
				$ret = $ret && $this->preUpdate($con);
				// timestampable behavior
				if ($this->isModified() && !$this->isColumnModified(CampusPeer::UPDATED_AT)) {
					$this->setUpdatedAt(time());
				}
			}
			if ($ret) {
				$affectedRows = $this->doSave($con);
				if ($isInsert) {
					$this->postInsert($con);
				} else {
					$this->postUpdate($con);
				}
				$this->postSave($con);
				// aggregate_column_relation behavior
				$this->updateRelatedSchool($con);
				CampusPeer::addInstanceToPool($this);
			} else {
				$affectedRows = 0;
			}
			$con->commit();
			return $affectedRows;
		} catch (Exception $e) {
			$con->rollBack();
			throw $e;
		}
	}

	/**
	 * Performs the work of inserting or updating the row in the database.
	 *
	 * If the object is new, it inserts it; otherwise an update is performed.
	 * All related objects are also updated in this method.
	 *
	 * @param      PropelPDO $con
	 * @return     int The number of rows affected by this insert/update and any referring fk objects' save() operations.
	 * @throws     PropelException
	 * @see        save()
	 */
	protected function doSave(PropelPDO $con)
	{
		$affectedRows = 0; // initialize var to track total num of affected rows
		if (!$this->alreadyInSave) {
			$this->alreadyInSave = true;

			// We call the save method on the following object(s) if they
			// were passed to this object by their coresponding set
			// method.  This object relates to these object(s) by a
			// foreign key reference.

			if ($this->aSchool !== null) {
				if ($this->aSchool->isModified() || $this->aSchool->isNew()) {
					$affectedRows += $this->aSchool->save($con);
				}
				$this->setSchool($this->aSchool);
			}

			if ($this->isNew() || $this->isModified()) {
				// persist changes
				if ($this->isNew()) {
					$this->doInsert($con);
				} else {
					$this->doUpdate($con);
				}
				$affectedRows += 1;
				$this->resetModified();
			}

			if ($this->termsScheduledForDeletion !== null) {
				if (!$this->termsScheduledForDeletion->isEmpty()) {
					TermQuery::create()
						->filterByPrimaryKeys($this->termsScheduledForDeletion->getPrimaryKeys(false))
						->delete($con);
					$this->termsScheduledForDeletion = null;
				}
			}

			if ($this->collTerms !== null) {
				foreach ($this->collTerms as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			$this->alreadyInSave = false;

		}
		return $affectedRows;
	} // doSave()

	/**
	 * Insert the row in the database.
	 *
	 * @param      PropelPDO $con
	 *
	 * @throws     PropelException
	 * @see        doSave()
	 */
	protected function doInsert(PropelPDO $con)
	{
		$modifiedColumns = array();
		$index = 0;

		$this->modifiedColumns[] = CampusPeer::ID;
		if (null !== $this->id) {
			throw new PropelException('Cannot insert a value for auto-increment primary key (' . CampusPeer::ID . ')');
		}

		 // check the columns in natural order for more readable SQL queries
		if ($this->isColumnModified(CampusPeer::SHALLOW_SPIDERED_AT)) {
			$modifiedColumns[':p' . $index++]  = '`SHALLOW_SPIDERED_AT`';
		}
		if ($this->isColumnModified(CampusPeer::NAME)) {
			$modifiedColumns[':p' . $index++]  = '`NAME`';
		}
		if ($this->isColumnModified(CampusPeer::SLUG)) {
			$modifiedColumns[':p' . $index++]  = '`SLUG`';
		}
		if ($this->isColumnModified(CampusPeer::SCHOOL_ID)) {
			$modifiedColumns[':p' . $index++]  = '`SCHOOL_ID`';
		}
		if ($this->isColumnModified(CampusPeer::SPIDERED_AT)) {
			$modifiedColumns[':p' . $index++]  = '`SPIDERED_AT`';
		}
		if ($this->isColumnModified(CampusPeer::TOUCHED)) {
			$modifiedColumns[':p' . $index++]  = '`TOUCHED`';
		}
		if ($this->isColumnModified(CampusPeer::B_ID)) {
			$modifiedColumns[':p' . $index++]  = '`B_ID`';
		}
		if ($this->isColumnModified(CampusPeer::BOOKSTORE_TYPE)) {
			$modifiedColumns[':p' . $index++]  = '`BOOKSTORE_TYPE`';
		}
		if ($this->isColumnModified(CampusPeer::ID)) {
			$modifiedColumns[':p' . $index++]  = '`ID`';
		}
		if ($this->isColumnModified(CampusPeer::CREATED_AT)) {
			$modifiedColumns[':p' . $index++]  = '`CREATED_AT`';
		}
		if ($this->isColumnModified(CampusPeer::UPDATED_AT)) {
			$modifiedColumns[':p' . $index++]  = '`UPDATED_AT`';
		}

		$sql = sprintf(
			'INSERT INTO `campus` (%s) VALUES (%s)',
			implode(', ', $modifiedColumns),
			implode(', ', array_keys($modifiedColumns))
		);

		try {
			$stmt = $con->prepare($sql);
			foreach ($modifiedColumns as $identifier => $columnName) {
				switch ($columnName) {
					case '`SHALLOW_SPIDERED_AT`':
						$stmt->bindValue($identifier, $this->shallow_spidered_at, PDO::PARAM_STR);
						break;
					case '`NAME`':
						$stmt->bindValue($identifier, $this->name, PDO::PARAM_STR);
						break;
					case '`SLUG`':
						$stmt->bindValue($identifier, $this->slug, PDO::PARAM_STR);
						break;
					case '`SCHOOL_ID`':
						$stmt->bindValue($identifier, $this->school_id, PDO::PARAM_INT);
						break;
					case '`SPIDERED_AT`':
						$stmt->bindValue($identifier, $this->spidered_at, PDO::PARAM_STR);
						break;
					case '`TOUCHED`':
						$stmt->bindValue($identifier, (int) $this->touched, PDO::PARAM_INT);
						break;
					case '`B_ID`':
						$stmt->bindValue($identifier, $this->b_id, PDO::PARAM_STR);
						break;
					case '`BOOKSTORE_TYPE`':
						$stmt->bindValue($identifier, $this->bookstore_type, PDO::PARAM_STR);
						break;
					case '`ID`':
						$stmt->bindValue($identifier, $this->id, PDO::PARAM_INT);
						break;
					case '`CREATED_AT`':
						$stmt->bindValue($identifier, $this->created_at, PDO::PARAM_STR);
						break;
					case '`UPDATED_AT`':
						$stmt->bindValue($identifier, $this->updated_at, PDO::PARAM_STR);
						break;
				}
			}
			$stmt->execute();
		} catch (Exception $e) {
			Propel::log($e->getMessage(), Propel::LOG_ERR);
			throw new PropelException(sprintf('Unable to execute INSERT statement [%s]', $sql), $e);
		}

		try {
			$pk = $con->lastInsertId();
		} catch (Exception $e) {
			throw new PropelException('Unable to get autoincrement id.', $e);
		}
		$this->setId($pk);

		$this->setNew(false);
	}

	/**
	 * Update the row in the database.
	 *
	 * @param      PropelPDO $con
	 *
	 * @see        doSave()
	 */
	protected function doUpdate(PropelPDO $con)
	{
		$selectCriteria = $this->buildPkeyCriteria();
		$valuesCriteria = $this->buildCriteria();
		BasePeer::doUpdate($selectCriteria, $valuesCriteria, $con);
	}

	/**
	 * Array of ValidationFailed objects.
	 * @var        array ValidationFailed[]
	 */
	protected $validationFailures = array();

	/**
	 * Gets any ValidationFailed objects that resulted from last call to validate().
	 *
	 *
	 * @return     array ValidationFailed[]
	 * @see        validate()
	 */
	public function getValidationFailures()
	{
		return $this->validationFailures;
	}

	/**
	 * Validates the objects modified field values and all objects related to this table.
	 *
	 * If $columns is either a column name or an array of column names
	 * only those columns are validated.
	 *
	 * @param      mixed $columns Column name or an array of column names.
	 * @return     boolean Whether all columns pass validation.
	 * @see        doValidate()
	 * @see        getValidationFailures()
	 */
	public function validate($columns = null)
	{
		$res = $this->doValidate($columns);
		if ($res === true) {
			$this->validationFailures = array();
			return true;
		} else {
			$this->validationFailures = $res;
			return false;
		}
	}

	/**
	 * This function performs the validation work for complex object models.
	 *
	 * In addition to checking the current object, all related objects will
	 * also be validated.  If all pass then <code>true</code> is returned; otherwise
	 * an aggreagated array of ValidationFailed objects will be returned.
	 *
	 * @param      array $columns Array of column names to validate.
	 * @return     mixed <code>true</code> if all validations pass; array of <code>ValidationFailed</code> objets otherwise.
	 */
	protected function doValidate($columns = null)
	{
		if (!$this->alreadyInValidation) {
			$this->alreadyInValidation = true;
			$retval = null;

			$failureMap = array();


			// We call the validate method on the following object(s) if they
			// were passed to this object by their coresponding set
			// method.  This object relates to these object(s) by a
			// foreign key reference.

			if ($this->aSchool !== null) {
				if (!$this->aSchool->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aSchool->getValidationFailures());
				}
			}


			if (($retval = CampusPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collTerms !== null) {
					foreach ($this->collTerms as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}


			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	/**
	 * Retrieves a field from the object by name passed in as a string.
	 *
	 * @param      string $name name
	 * @param      string $type The type of fieldname the $name is of:
	 *                     one of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME
	 *                     BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM
	 * @return     mixed Value of field.
	 */
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = CampusPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		$field = $this->getByPosition($pos);
		return $field;
	}

	/**
	 * Retrieves a field from the object by Position as specified in the xml schema.
	 * Zero-based.
	 *
	 * @param      int $pos position in xml schema
	 * @return     mixed Value of field at $pos
	 */
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getShallowSpideredAt();
				break;
			case 1:
				return $this->getName();
				break;
			case 2:
				return $this->getSlug();
				break;
			case 3:
				return $this->getSchoolId();
				break;
			case 4:
				return $this->getSpideredAt();
				break;
			case 5:
				return $this->getTouched();
				break;
			case 6:
				return $this->getBId();
				break;
			case 7:
				return $this->getBookstoreType();
				break;
			case 8:
				return $this->getId();
				break;
			case 9:
				return $this->getCreatedAt();
				break;
			case 10:
				return $this->getUpdatedAt();
				break;
			default:
				return null;
				break;
		} // switch()
	}

	/**
	 * Exports the object as an array.
	 *
	 * You can specify the key type of the array by passing one of the class
	 * type constants.
	 *
	 * @param     string  $keyType (optional) One of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME,
	 *                    BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM.
	 *                    Defaults to BasePeer::TYPE_PHPNAME.
	 * @param     boolean $includeLazyLoadColumns (optional) Whether to include lazy loaded columns. Defaults to TRUE.
	 * @param     array $alreadyDumpedObjects List of objects to skip to avoid recursion
	 * @param     boolean $includeForeignObjects (optional) Whether to include hydrated related objects. Default to FALSE.
	 *
	 * @return    array an associative array containing the field names (as keys) and field values
	 */
	public function toArray($keyType = BasePeer::TYPE_PHPNAME, $includeLazyLoadColumns = true, $alreadyDumpedObjects = array(), $includeForeignObjects = false)
	{
		if (isset($alreadyDumpedObjects['Campus'][$this->getPrimaryKey()])) {
			return '*RECURSION*';
		}
		$alreadyDumpedObjects['Campus'][$this->getPrimaryKey()] = true;
		$keys = CampusPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getShallowSpideredAt(),
			$keys[1] => $this->getName(),
			$keys[2] => $this->getSlug(),
			$keys[3] => $this->getSchoolId(),
			$keys[4] => $this->getSpideredAt(),
			$keys[5] => $this->getTouched(),
			$keys[6] => $this->getBId(),
			$keys[7] => $this->getBookstoreType(),
			$keys[8] => $this->getId(),
			$keys[9] => $this->getCreatedAt(),
			$keys[10] => $this->getUpdatedAt(),
		);
		if ($includeForeignObjects) {
			if (null !== $this->aSchool) {
				$result['School'] = $this->aSchool->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
			}
			if (null !== $this->collTerms) {
				$result['Terms'] = $this->collTerms->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
			}
		}
		return $result;
	}

	/**
	 * Sets a field from the object by name passed in as a string.
	 *
	 * @param      string $name peer name
	 * @param      mixed $value field value
	 * @param      string $type The type of fieldname the $name is of:
	 *                     one of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME
	 *                     BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM
	 * @return     void
	 */
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = CampusPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	/**
	 * Sets a field from the object by Position as specified in the xml schema.
	 * Zero-based.
	 *
	 * @param      int $pos position in xml schema
	 * @param      mixed $value field value
	 * @return     void
	 */
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setShallowSpideredAt($value);
				break;
			case 1:
				$this->setName($value);
				break;
			case 2:
				$this->setSlug($value);
				break;
			case 3:
				$this->setSchoolId($value);
				break;
			case 4:
				$this->setSpideredAt($value);
				break;
			case 5:
				$this->setTouched($value);
				break;
			case 6:
				$this->setBId($value);
				break;
			case 7:
				$this->setBookstoreType($value);
				break;
			case 8:
				$this->setId($value);
				break;
			case 9:
				$this->setCreatedAt($value);
				break;
			case 10:
				$this->setUpdatedAt($value);
				break;
		} // switch()
	}

	/**
	 * Populates the object using an array.
	 *
	 * This is particularly useful when populating an object from one of the
	 * request arrays (e.g. $_POST).  This method goes through the column
	 * names, checking to see whether a matching key exists in populated
	 * array. If so the setByName() method is called for that column.
	 *
	 * You can specify the key type of the array by additionally passing one
	 * of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME,
	 * BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM.
	 * The default key type is the column's phpname (e.g. 'AuthorId')
	 *
	 * @param      array  $arr     An array to populate the object from.
	 * @param      string $keyType The type of keys the array uses.
	 * @return     void
	 */
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = CampusPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setShallowSpideredAt($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setName($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setSlug($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setSchoolId($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setSpideredAt($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setTouched($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setBId($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setBookstoreType($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setId($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setCreatedAt($arr[$keys[9]]);
		if (array_key_exists($keys[10], $arr)) $this->setUpdatedAt($arr[$keys[10]]);
	}

	/**
	 * Build a Criteria object containing the values of all modified columns in this object.
	 *
	 * @return     Criteria The Criteria object containing all modified values.
	 */
	public function buildCriteria()
	{
		$criteria = new Criteria(CampusPeer::DATABASE_NAME);

		if ($this->isColumnModified(CampusPeer::SHALLOW_SPIDERED_AT)) $criteria->add(CampusPeer::SHALLOW_SPIDERED_AT, $this->shallow_spidered_at);
		if ($this->isColumnModified(CampusPeer::NAME)) $criteria->add(CampusPeer::NAME, $this->name);
		if ($this->isColumnModified(CampusPeer::SLUG)) $criteria->add(CampusPeer::SLUG, $this->slug);
		if ($this->isColumnModified(CampusPeer::SCHOOL_ID)) $criteria->add(CampusPeer::SCHOOL_ID, $this->school_id);
		if ($this->isColumnModified(CampusPeer::SPIDERED_AT)) $criteria->add(CampusPeer::SPIDERED_AT, $this->spidered_at);
		if ($this->isColumnModified(CampusPeer::TOUCHED)) $criteria->add(CampusPeer::TOUCHED, $this->touched);
		if ($this->isColumnModified(CampusPeer::B_ID)) $criteria->add(CampusPeer::B_ID, $this->b_id);
		if ($this->isColumnModified(CampusPeer::BOOKSTORE_TYPE)) $criteria->add(CampusPeer::BOOKSTORE_TYPE, $this->bookstore_type);
		if ($this->isColumnModified(CampusPeer::ID)) $criteria->add(CampusPeer::ID, $this->id);
		if ($this->isColumnModified(CampusPeer::CREATED_AT)) $criteria->add(CampusPeer::CREATED_AT, $this->created_at);
		if ($this->isColumnModified(CampusPeer::UPDATED_AT)) $criteria->add(CampusPeer::UPDATED_AT, $this->updated_at);

		return $criteria;
	}

	/**
	 * Builds a Criteria object containing the primary key for this object.
	 *
	 * Unlike buildCriteria() this method includes the primary key values regardless
	 * of whether or not they have been modified.
	 *
	 * @return     Criteria The Criteria object containing value(s) for primary key(s).
	 */
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(CampusPeer::DATABASE_NAME);
		$criteria->add(CampusPeer::ID, $this->id);

		return $criteria;
	}

	/**
	 * Returns the primary key for this object (row).
	 * @return     int
	 */
	public function getPrimaryKey()
	{
		return $this->getId();
	}

	/**
	 * Generic method to set the primary key (id column).
	 *
	 * @param      int $key Primary key.
	 * @return     void
	 */
	public function setPrimaryKey($key)
	{
		$this->setId($key);
	}

	/**
	 * Returns true if the primary key for this object is null.
	 * @return     boolean
	 */
	public function isPrimaryKeyNull()
	{
		return null === $this->getId();
	}

	/**
	 * Sets contents of passed object to values from current object.
	 *
	 * If desired, this method can also make copies of all associated (fkey referrers)
	 * objects.
	 *
	 * @param      object $copyObj An object of Campus (or compatible) type.
	 * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
	 * @param      boolean $makeNew Whether to reset autoincrement PKs and make the object new.
	 * @throws     PropelException
	 */
	public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
	{
		$copyObj->setShallowSpideredAt($this->getShallowSpideredAt());
		$copyObj->setName($this->getName());
		$copyObj->setSlug($this->getSlug());
		$copyObj->setSchoolId($this->getSchoolId());
		$copyObj->setSpideredAt($this->getSpideredAt());
		$copyObj->setTouched($this->getTouched());
		$copyObj->setBId($this->getBId());
		$copyObj->setBookstoreType($this->getBookstoreType());
		$copyObj->setCreatedAt($this->getCreatedAt());
		$copyObj->setUpdatedAt($this->getUpdatedAt());

		if ($deepCopy && !$this->startCopy) {
			// important: temporarily setNew(false) because this affects the behavior of
			// the getter/setter methods for fkey referrer objects.
			$copyObj->setNew(false);
			// store object hash to prevent cycle
			$this->startCopy = true;

			foreach ($this->getTerms() as $relObj) {
				if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
					$copyObj->addTerm($relObj->copy($deepCopy));
				}
			}

			//unflag object copy
			$this->startCopy = false;
		} // if ($deepCopy)

		if ($makeNew) {
			$copyObj->setNew(true);
			$copyObj->setId(NULL); // this is a auto-increment column, so set to default value
		}
	}

	/**
	 * Makes a copy of this object that will be inserted as a new row in table when saved.
	 * It creates a new object filling in the simple attributes, but skipping any primary
	 * keys that are defined for the table.
	 *
	 * If desired, this method can also make copies of all associated (fkey referrers)
	 * objects.
	 *
	 * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
	 * @return     Campus Clone of current object.
	 * @throws     PropelException
	 */
	public function copy($deepCopy = false)
	{
		// we use get_class(), because this might be a subclass
		$clazz = get_class($this);
		$copyObj = new $clazz();
		$this->copyInto($copyObj, $deepCopy);
		return $copyObj;
	}

	/**
	 * Returns a peer instance associated with this om.
	 *
	 * Since Peer classes are not to have any instance attributes, this method returns the
	 * same instance for all member of this class. The method could therefore
	 * be static, but this would prevent one from overriding the behavior.
	 *
	 * @return     CampusPeer
	 */
	public function getPeer()
	{
		if (self::$peer === null) {
			self::$peer = new CampusPeer();
		}
		return self::$peer;
	}

	/**
	 * Declares an association between this object and a School object.
	 *
	 * @param      School $v
	 * @return     Campus The current object (for fluent API support)
	 * @throws     PropelException
	 */
	public function setSchool(School $v = null)
	{
		// aggregate_column_relation behavior
		if (null !== $this->aSchool && $v !== $this->aSchool) {
			$this->oldSchool = $this->aSchool;
		}
		if ($v === null) {
			$this->setSchoolId(NULL);
		} else {
			$this->setSchoolId($v->getId());
		}

		$this->aSchool = $v;

		// Add binding for other direction of this n:n relationship.
		// If this object has already been added to the School object, it will not be re-added.
		if ($v !== null) {
			$v->addCampus($this);
		}

		return $this;
	}


	/**
	 * Get the associated School object
	 *
	 * @param      PropelPDO Optional Connection object.
	 * @return     School The associated School object.
	 * @throws     PropelException
	 */
	public function getSchool(PropelPDO $con = null)
	{
		if ($this->aSchool === null && ($this->school_id !== null)) {
			$this->aSchool = SchoolQuery::create()->findPk($this->school_id, $con);
			/* The following can be used additionally to
				guarantee the related object contains a reference
				to this object.  This level of coupling may, however, be
				undesirable since it could result in an only partially populated collection
				in the referenced object.
				$this->aSchool->addCampuss($this);
			 */
		}
		return $this->aSchool;
	}


	/**
	 * Initializes a collection based on the name of a relation.
	 * Avoids crafting an 'init[$relationName]s' method name
	 * that wouldn't work when StandardEnglishPluralizer is used.
	 *
	 * @param      string $relationName The name of the relation to initialize
	 * @return     void
	 */
	public function initRelation($relationName)
	{
		if ('Term' == $relationName) {
			return $this->initTerms();
		}
	}

	/**
	 * Clears out the collTerms collection
	 *
	 * This does not modify the database; however, it will remove any associated objects, causing
	 * them to be refetched by subsequent calls to accessor method.
	 *
	 * @return     void
	 * @see        addTerms()
	 */
	public function clearTerms()
	{
		$this->collTerms = null; // important to set this to NULL since that means it is uninitialized
	}

	/**
	 * Initializes the collTerms collection.
	 *
	 * By default this just sets the collTerms collection to an empty array (like clearcollTerms());
	 * however, you may wish to override this method in your stub class to provide setting appropriate
	 * to your application -- for example, setting the initial array to the values stored in database.
	 *
	 * @param      boolean $overrideExisting If set to true, the method call initializes
	 *                                        the collection even if it is not empty
	 *
	 * @return     void
	 */
	public function initTerms($overrideExisting = true)
	{
		if (null !== $this->collTerms && !$overrideExisting) {
			return;
		}
		$this->collTerms = new PropelObjectCollection();
		$this->collTerms->setModel('Term');
	}

	/**
	 * Gets an array of Term objects which contain a foreign key that references this object.
	 *
	 * If the $criteria is not null, it is used to always fetch the results from the database.
	 * Otherwise the results are fetched from the database the first time, then cached.
	 * Next time the same method is called without $criteria, the cached collection is returned.
	 * If this Campus is new, it will return
	 * an empty collection or the current collection; the criteria is ignored on a new object.
	 *
	 * @param      Criteria $criteria optional Criteria object to narrow the query
	 * @param      PropelPDO $con optional connection object
	 * @return     PropelCollection|array Term[] List of Term objects
	 * @throws     PropelException
	 */
	public function getTerms($criteria = null, PropelPDO $con = null)
	{
		if(null === $this->collTerms || null !== $criteria) {
			if ($this->isNew() && null === $this->collTerms) {
				// return empty collection
				$this->initTerms();
			} else {
				$collTerms = TermQuery::create(null, $criteria)
					->filterByCampus($this)
					->find($con);
				if (null !== $criteria) {
					return $collTerms;
				}
				$this->collTerms = $collTerms;
			}
		}
		return $this->collTerms;
	}

	/**
	 * Sets a collection of Term objects related by a one-to-many relationship
	 * to the current object.
	 * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
	 * and new objects from the given Propel collection.
	 *
	 * @param      PropelCollection $terms A Propel collection.
	 * @param      PropelPDO $con Optional connection object
	 */
	public function setTerms(PropelCollection $terms, PropelPDO $con = null)
	{
		$this->termsScheduledForDeletion = $this->getTerms(new Criteria(), $con)->diff($terms);

		foreach ($terms as $term) {
			// Fix issue with collection modified by reference
			if ($term->isNew()) {
				$term->setCampus($this);
			}
			$this->addTerm($term);
		}

		$this->collTerms = $terms;
	}

	/**
	 * Returns the number of related Term objects.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      PropelPDO $con
	 * @return     int Count of related Term objects.
	 * @throws     PropelException
	 */
	public function countTerms(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if(null === $this->collTerms || null !== $criteria) {
			if ($this->isNew() && null === $this->collTerms) {
				return 0;
			} else {
				$query = TermQuery::create(null, $criteria);
				if($distinct) {
					$query->distinct();
				}
				return $query
					->filterByCampus($this)
					->count($con);
			}
		} else {
			return count($this->collTerms);
		}
	}

	/**
	 * Method called to associate a Term object to this object
	 * through the Term foreign key attribute.
	 *
	 * @param      Term $l Term
	 * @return     Campus The current object (for fluent API support)
	 */
	public function addTerm(Term $l)
	{
		if ($this->collTerms === null) {
			$this->initTerms();
		}
		if (!$this->collTerms->contains($l)) { // only add it if the **same** object is not already associated
			$this->doAddTerm($l);
		}

		return $this;
	}

	/**
	 * @param	Term $term The term object to add.
	 */
	protected function doAddTerm($term)
	{
		$this->collTerms[]= $term;
		$term->setCampus($this);
	}

	/**
	 * Clears the current object and sets all attributes to their default values
	 */
	public function clear()
	{
		$this->shallow_spidered_at = null;
		$this->name = null;
		$this->slug = null;
		$this->school_id = null;
		$this->spidered_at = null;
		$this->touched = null;
		$this->b_id = null;
		$this->bookstore_type = null;
		$this->id = null;
		$this->created_at = null;
		$this->updated_at = null;
		$this->alreadyInSave = false;
		$this->alreadyInValidation = false;
		$this->clearAllReferences();
		$this->resetModified();
		$this->setNew(true);
		$this->setDeleted(false);
	}

	/**
	 * Resets all references to other model objects or collections of model objects.
	 *
	 * This method is a user-space workaround for PHP's inability to garbage collect
	 * objects with circular references (even in PHP 5.3). This is currently necessary
	 * when using Propel in certain daemon or large-volumne/high-memory operations.
	 *
	 * @param      boolean $deep Whether to also clear the references on all referrer objects.
	 */
	public function clearAllReferences($deep = false)
	{
		if ($deep) {
			if ($this->collTerms) {
				foreach ($this->collTerms as $o) {
					$o->clearAllReferences($deep);
				}
			}
		} // if ($deep)

		if ($this->collTerms instanceof PropelCollection) {
			$this->collTerms->clearIterator();
		}
		$this->collTerms = null;
		$this->aSchool = null;
	}

	/**
	 * Return the string representation of this object
	 *
	 * @return string
	 */
	public function __toString()
	{
		return (string) $this->exportTo(CampusPeer::DEFAULT_STRING_FORMAT);
	}

	// spiderable behavior
	
	  
	    /**
	     * Set the spidered time to the current time
	     *
	     * @return     Campus The current object (for fluent API support)
	     */
	    public function setSpidered()
	    {
	        $this->setSpideredAt(time());
	        return $this;
	    }
	    
	// timestampable behavior
	
	/**
	 * Mark the current object so that the update date doesn't get updated during next save
	 *
	 * @return     Campus The current object (for fluent API support)
	 */
	public function keepUpdateDateUnchanged()
	{
		$this->modifiedColumns[] = CampusPeer::UPDATED_AT;
		return $this;
	}

	// aggregate_column_relation behavior
	
	/**
	 * Update the aggregate column in the related School object
	 *
	 * @param PropelPDO $con A connection object
	 */
	protected function updateRelatedSchool(PropelPDO $con)
	{
		if ($school = $this->getSchool()) {
			$school->updateNbCampuses($con);
		}
		if ($this->oldSchool) {
			$this->oldSchool->updateNbCampuses($con);
			$this->oldSchool = null;
		}
	}

} // BaseCampus
