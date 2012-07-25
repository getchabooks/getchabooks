<?php


/**
 * Base class that represents a row from the 'course' table.
 *
 * 
 *
 * @package    propel.generator..om
 */
abstract class BaseCourse extends Spiderable  implements Persistent
{

	/**
	 * Peer class name
	 */
	const PEER = 'CoursePeer';

	/**
	 * The Peer class.
	 * Instance provides a convenient way of calling static methods on a class
	 * that calling code may not be able to identify.
	 * @var        CoursePeer
	 */
	protected static $peer;

	/**
	 * The flag var to prevent infinit loop in deep copy
	 * @var       boolean
	 */
	protected $startCopy = false;

	/**
	 * The value for the num field.
	 * @var        string
	 */
	protected $num;

	/**
	 * The value for the nb_sections field.
	 * @var        int
	 */
	protected $nb_sections;

	/**
	 * The value for the name field.
	 * @var        string
	 */
	protected $name;

	/**
	 * The value for the dept_id field.
	 * @var        int
	 */
	protected $dept_id;

	/**
	 * The value for the spidered_at field.
	 * @var        string
	 */
	protected $spidered_at;

	/**
	 * The value for the shallow_spidered_at field.
	 * @var        string
	 */
	protected $shallow_spidered_at;

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
	 * @var        Dept
	 */
	protected $aDept;

	/**
	 * @var        array Section[] Collection to store aggregation of Section objects.
	 */
	protected $collSections;

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

	/**
	 * An array of objects scheduled for deletion.
	 * @var		array
	 */
	protected $sectionsScheduledForDeletion = null;

	/**
	 * Get the [num] column value.
	 * 
	 * @return     string
	 */
	public function getNum()
	{
		return $this->num;
	}

	/**
	 * Get the [nb_sections] column value.
	 * 
	 * @return     int
	 */
	public function getNbSections()
	{
		return $this->nb_sections;
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
	 * Get the [dept_id] column value.
	 * 
	 * @return     int
	 */
	public function getDeptId()
	{
		return $this->dept_id;
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
	 * Set the value of [num] column.
	 * 
	 * @param      string $v new value
	 * @return     Course The current object (for fluent API support)
	 */
	public function setNum($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->num !== $v) {
			$this->num = $v;
			$this->modifiedColumns[] = CoursePeer::NUM;
		}

		return $this;
	} // setNum()

	/**
	 * Set the value of [nb_sections] column.
	 * 
	 * @param      int $v new value
	 * @return     Course The current object (for fluent API support)
	 */
	public function setNbSections($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->nb_sections !== $v) {
			$this->nb_sections = $v;
			$this->modifiedColumns[] = CoursePeer::NB_SECTIONS;
		}

		return $this;
	} // setNbSections()

	/**
	 * Set the value of [name] column.
	 * 
	 * @param      string $v new value
	 * @return     Course The current object (for fluent API support)
	 */
	public function setName($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->name !== $v) {
			$this->name = $v;
			$this->modifiedColumns[] = CoursePeer::NAME;
		}

		return $this;
	} // setName()

	/**
	 * Set the value of [dept_id] column.
	 * 
	 * @param      int $v new value
	 * @return     Course The current object (for fluent API support)
	 */
	public function setDeptId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->dept_id !== $v) {
			$this->dept_id = $v;
			$this->modifiedColumns[] = CoursePeer::DEPT_ID;
		}

		if ($this->aDept !== null && $this->aDept->getId() !== $v) {
			$this->aDept = null;
		}

		return $this;
	} // setDeptId()

	/**
	 * Sets the value of [spidered_at] column to a normalized version of the date/time value specified.
	 * 
	 * @param      mixed $v string, integer (timestamp), or DateTime value.
	 *               Empty strings are treated as NULL.
	 * @return     Course The current object (for fluent API support)
	 */
	public function setSpideredAt($v)
	{
		$dt = PropelDateTime::newInstance($v, null, 'DateTime');
		if ($this->spidered_at !== null || $dt !== null) {
			$currentDateAsString = ($this->spidered_at !== null && $tmpDt = new DateTime($this->spidered_at)) ? $tmpDt->format('Y-m-d H:i:s') : null;
			$newDateAsString = $dt ? $dt->format('Y-m-d H:i:s') : null;
			if ($currentDateAsString !== $newDateAsString) {
				$this->spidered_at = $newDateAsString;
				$this->modifiedColumns[] = CoursePeer::SPIDERED_AT;
			}
		} // if either are not null

		return $this;
	} // setSpideredAt()

	/**
	 * Sets the value of [shallow_spidered_at] column to a normalized version of the date/time value specified.
	 * 
	 * @param      mixed $v string, integer (timestamp), or DateTime value.
	 *               Empty strings are treated as NULL.
	 * @return     Course The current object (for fluent API support)
	 */
	public function setShallowSpideredAt($v)
	{
		$dt = PropelDateTime::newInstance($v, null, 'DateTime');
		if ($this->shallow_spidered_at !== null || $dt !== null) {
			$currentDateAsString = ($this->shallow_spidered_at !== null && $tmpDt = new DateTime($this->shallow_spidered_at)) ? $tmpDt->format('Y-m-d H:i:s') : null;
			$newDateAsString = $dt ? $dt->format('Y-m-d H:i:s') : null;
			if ($currentDateAsString !== $newDateAsString) {
				$this->shallow_spidered_at = $newDateAsString;
				$this->modifiedColumns[] = CoursePeer::SHALLOW_SPIDERED_AT;
			}
		} // if either are not null

		return $this;
	} // setShallowSpideredAt()

	/**
	 * Sets the value of the [touched] column.
	 * Non-boolean arguments are converted using the following rules:
	 *   * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
	 *   * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
	 * Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
	 * 
	 * @param      boolean|integer|string $v The new value
	 * @return     Course The current object (for fluent API support)
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
			$this->modifiedColumns[] = CoursePeer::TOUCHED;
		}

		return $this;
	} // setTouched()

	/**
	 * Set the value of [b_id] column.
	 * 
	 * @param      string $v new value
	 * @return     Course The current object (for fluent API support)
	 */
	public function setBId($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->b_id !== $v) {
			$this->b_id = $v;
			$this->modifiedColumns[] = CoursePeer::B_ID;
		}

		return $this;
	} // setBId()

	/**
	 * Set the value of [bookstore_type] column.
	 * 
	 * @param      string $v new value
	 * @return     Course The current object (for fluent API support)
	 */
	public function setBookstoreType($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->bookstore_type !== $v) {
			$this->bookstore_type = $v;
			$this->modifiedColumns[] = CoursePeer::BOOKSTORE_TYPE;
		}

		return $this;
	} // setBookstoreType()

	/**
	 * Set the value of [id] column.
	 * 
	 * @param      int $v new value
	 * @return     Course The current object (for fluent API support)
	 */
	public function setId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = CoursePeer::ID;
		}

		return $this;
	} // setId()

	/**
	 * Sets the value of [created_at] column to a normalized version of the date/time value specified.
	 * 
	 * @param      mixed $v string, integer (timestamp), or DateTime value.
	 *               Empty strings are treated as NULL.
	 * @return     Course The current object (for fluent API support)
	 */
	public function setCreatedAt($v)
	{
		$dt = PropelDateTime::newInstance($v, null, 'DateTime');
		if ($this->created_at !== null || $dt !== null) {
			$currentDateAsString = ($this->created_at !== null && $tmpDt = new DateTime($this->created_at)) ? $tmpDt->format('Y-m-d H:i:s') : null;
			$newDateAsString = $dt ? $dt->format('Y-m-d H:i:s') : null;
			if ($currentDateAsString !== $newDateAsString) {
				$this->created_at = $newDateAsString;
				$this->modifiedColumns[] = CoursePeer::CREATED_AT;
			}
		} // if either are not null

		return $this;
	} // setCreatedAt()

	/**
	 * Sets the value of [updated_at] column to a normalized version of the date/time value specified.
	 * 
	 * @param      mixed $v string, integer (timestamp), or DateTime value.
	 *               Empty strings are treated as NULL.
	 * @return     Course The current object (for fluent API support)
	 */
	public function setUpdatedAt($v)
	{
		$dt = PropelDateTime::newInstance($v, null, 'DateTime');
		if ($this->updated_at !== null || $dt !== null) {
			$currentDateAsString = ($this->updated_at !== null && $tmpDt = new DateTime($this->updated_at)) ? $tmpDt->format('Y-m-d H:i:s') : null;
			$newDateAsString = $dt ? $dt->format('Y-m-d H:i:s') : null;
			if ($currentDateAsString !== $newDateAsString) {
				$this->updated_at = $newDateAsString;
				$this->modifiedColumns[] = CoursePeer::UPDATED_AT;
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

			$this->num = ($row[$startcol + 0] !== null) ? (string) $row[$startcol + 0] : null;
			$this->nb_sections = ($row[$startcol + 1] !== null) ? (int) $row[$startcol + 1] : null;
			$this->name = ($row[$startcol + 2] !== null) ? (string) $row[$startcol + 2] : null;
			$this->dept_id = ($row[$startcol + 3] !== null) ? (int) $row[$startcol + 3] : null;
			$this->spidered_at = ($row[$startcol + 4] !== null) ? (string) $row[$startcol + 4] : null;
			$this->shallow_spidered_at = ($row[$startcol + 5] !== null) ? (string) $row[$startcol + 5] : null;
			$this->touched = ($row[$startcol + 6] !== null) ? (boolean) $row[$startcol + 6] : null;
			$this->b_id = ($row[$startcol + 7] !== null) ? (string) $row[$startcol + 7] : null;
			$this->bookstore_type = ($row[$startcol + 8] !== null) ? (string) $row[$startcol + 8] : null;
			$this->id = ($row[$startcol + 9] !== null) ? (int) $row[$startcol + 9] : null;
			$this->created_at = ($row[$startcol + 10] !== null) ? (string) $row[$startcol + 10] : null;
			$this->updated_at = ($row[$startcol + 11] !== null) ? (string) $row[$startcol + 11] : null;
			$this->resetModified();

			$this->setNew(false);

			if ($rehydrate) {
				$this->ensureConsistency();
			}

			return $startcol + 12; // 12 = CoursePeer::NUM_HYDRATE_COLUMNS.

		} catch (Exception $e) {
			throw new PropelException("Error populating Course object", $e);
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

		if ($this->aDept !== null && $this->dept_id !== $this->aDept->getId()) {
			$this->aDept = null;
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
			$con = Propel::getConnection(CoursePeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		// We don't need to alter the object instance pool; we're just modifying this instance
		// already in the pool.

		$stmt = CoursePeer::doSelectStmt($this->buildPkeyCriteria(), $con);
		$row = $stmt->fetch(PDO::FETCH_NUM);
		$stmt->closeCursor();
		if (!$row) {
			throw new PropelException('Cannot find matching row in the database to reload object values.');
		}
		$this->hydrate($row, 0, true); // rehydrate

		if ($deep) {  // also de-associate any related objects?

			$this->aDept = null;
			$this->collSections = null;

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
			$con = Propel::getConnection(CoursePeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		$con->beginTransaction();
		try {
			$deleteQuery = CourseQuery::create()
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
			$con = Propel::getConnection(CoursePeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		$con->beginTransaction();
		$isInsert = $this->isNew();
		try {
			$ret = $this->preSave($con);
			if ($isInsert) {
				$ret = $ret && $this->preInsert($con);
				// spiderable behavior
				if (!$this->isColumnModified(CoursePeer::SPIDERED_AT)) {
				            $this->setSpideredAt(NULL);
				    }
				// timestampable behavior
				if (!$this->isColumnModified(CoursePeer::CREATED_AT)) {
					$this->setCreatedAt(time());
				}
				if (!$this->isColumnModified(CoursePeer::UPDATED_AT)) {
					$this->setUpdatedAt(time());
				}
			} else {
				$ret = $ret && $this->preUpdate($con);
				// timestampable behavior
				if ($this->isModified() && !$this->isColumnModified(CoursePeer::UPDATED_AT)) {
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
				CoursePeer::addInstanceToPool($this);
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

			if ($this->aDept !== null) {
				if ($this->aDept->isModified() || $this->aDept->isNew()) {
					$affectedRows += $this->aDept->save($con);
				}
				$this->setDept($this->aDept);
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

			if ($this->sectionsScheduledForDeletion !== null) {
				if (!$this->sectionsScheduledForDeletion->isEmpty()) {
					SectionQuery::create()
						->filterByPrimaryKeys($this->sectionsScheduledForDeletion->getPrimaryKeys(false))
						->delete($con);
					$this->sectionsScheduledForDeletion = null;
				}
			}

			if ($this->collSections !== null) {
				foreach ($this->collSections as $referrerFK) {
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

		$this->modifiedColumns[] = CoursePeer::ID;
		if (null !== $this->id) {
			throw new PropelException('Cannot insert a value for auto-increment primary key (' . CoursePeer::ID . ')');
		}

		 // check the columns in natural order for more readable SQL queries
		if ($this->isColumnModified(CoursePeer::NUM)) {
			$modifiedColumns[':p' . $index++]  = '`NUM`';
		}
		if ($this->isColumnModified(CoursePeer::NB_SECTIONS)) {
			$modifiedColumns[':p' . $index++]  = '`NB_SECTIONS`';
		}
		if ($this->isColumnModified(CoursePeer::NAME)) {
			$modifiedColumns[':p' . $index++]  = '`NAME`';
		}
		if ($this->isColumnModified(CoursePeer::DEPT_ID)) {
			$modifiedColumns[':p' . $index++]  = '`DEPT_ID`';
		}
		if ($this->isColumnModified(CoursePeer::SPIDERED_AT)) {
			$modifiedColumns[':p' . $index++]  = '`SPIDERED_AT`';
		}
		if ($this->isColumnModified(CoursePeer::SHALLOW_SPIDERED_AT)) {
			$modifiedColumns[':p' . $index++]  = '`SHALLOW_SPIDERED_AT`';
		}
		if ($this->isColumnModified(CoursePeer::TOUCHED)) {
			$modifiedColumns[':p' . $index++]  = '`TOUCHED`';
		}
		if ($this->isColumnModified(CoursePeer::B_ID)) {
			$modifiedColumns[':p' . $index++]  = '`B_ID`';
		}
		if ($this->isColumnModified(CoursePeer::BOOKSTORE_TYPE)) {
			$modifiedColumns[':p' . $index++]  = '`BOOKSTORE_TYPE`';
		}
		if ($this->isColumnModified(CoursePeer::ID)) {
			$modifiedColumns[':p' . $index++]  = '`ID`';
		}
		if ($this->isColumnModified(CoursePeer::CREATED_AT)) {
			$modifiedColumns[':p' . $index++]  = '`CREATED_AT`';
		}
		if ($this->isColumnModified(CoursePeer::UPDATED_AT)) {
			$modifiedColumns[':p' . $index++]  = '`UPDATED_AT`';
		}

		$sql = sprintf(
			'INSERT INTO `course` (%s) VALUES (%s)',
			implode(', ', $modifiedColumns),
			implode(', ', array_keys($modifiedColumns))
		);

		try {
			$stmt = $con->prepare($sql);
			foreach ($modifiedColumns as $identifier => $columnName) {
				switch ($columnName) {
					case '`NUM`':
						$stmt->bindValue($identifier, $this->num, PDO::PARAM_STR);
						break;
					case '`NB_SECTIONS`':
						$stmt->bindValue($identifier, $this->nb_sections, PDO::PARAM_INT);
						break;
					case '`NAME`':
						$stmt->bindValue($identifier, $this->name, PDO::PARAM_STR);
						break;
					case '`DEPT_ID`':
						$stmt->bindValue($identifier, $this->dept_id, PDO::PARAM_INT);
						break;
					case '`SPIDERED_AT`':
						$stmt->bindValue($identifier, $this->spidered_at, PDO::PARAM_STR);
						break;
					case '`SHALLOW_SPIDERED_AT`':
						$stmt->bindValue($identifier, $this->shallow_spidered_at, PDO::PARAM_STR);
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

			if ($this->aDept !== null) {
				if (!$this->aDept->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aDept->getValidationFailures());
				}
			}


			if (($retval = CoursePeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collSections !== null) {
					foreach ($this->collSections as $referrerFK) {
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
		$pos = CoursePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getNum();
				break;
			case 1:
				return $this->getNbSections();
				break;
			case 2:
				return $this->getName();
				break;
			case 3:
				return $this->getDeptId();
				break;
			case 4:
				return $this->getSpideredAt();
				break;
			case 5:
				return $this->getShallowSpideredAt();
				break;
			case 6:
				return $this->getTouched();
				break;
			case 7:
				return $this->getBId();
				break;
			case 8:
				return $this->getBookstoreType();
				break;
			case 9:
				return $this->getId();
				break;
			case 10:
				return $this->getCreatedAt();
				break;
			case 11:
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
		if (isset($alreadyDumpedObjects['Course'][$this->getPrimaryKey()])) {
			return '*RECURSION*';
		}
		$alreadyDumpedObjects['Course'][$this->getPrimaryKey()] = true;
		$keys = CoursePeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getNum(),
			$keys[1] => $this->getNbSections(),
			$keys[2] => $this->getName(),
			$keys[3] => $this->getDeptId(),
			$keys[4] => $this->getSpideredAt(),
			$keys[5] => $this->getShallowSpideredAt(),
			$keys[6] => $this->getTouched(),
			$keys[7] => $this->getBId(),
			$keys[8] => $this->getBookstoreType(),
			$keys[9] => $this->getId(),
			$keys[10] => $this->getCreatedAt(),
			$keys[11] => $this->getUpdatedAt(),
		);
		if ($includeForeignObjects) {
			if (null !== $this->aDept) {
				$result['Dept'] = $this->aDept->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
			}
			if (null !== $this->collSections) {
				$result['Sections'] = $this->collSections->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
		$pos = CoursePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setNum($value);
				break;
			case 1:
				$this->setNbSections($value);
				break;
			case 2:
				$this->setName($value);
				break;
			case 3:
				$this->setDeptId($value);
				break;
			case 4:
				$this->setSpideredAt($value);
				break;
			case 5:
				$this->setShallowSpideredAt($value);
				break;
			case 6:
				$this->setTouched($value);
				break;
			case 7:
				$this->setBId($value);
				break;
			case 8:
				$this->setBookstoreType($value);
				break;
			case 9:
				$this->setId($value);
				break;
			case 10:
				$this->setCreatedAt($value);
				break;
			case 11:
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
		$keys = CoursePeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setNum($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setNbSections($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setName($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setDeptId($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setSpideredAt($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setShallowSpideredAt($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setTouched($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setBId($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setBookstoreType($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setId($arr[$keys[9]]);
		if (array_key_exists($keys[10], $arr)) $this->setCreatedAt($arr[$keys[10]]);
		if (array_key_exists($keys[11], $arr)) $this->setUpdatedAt($arr[$keys[11]]);
	}

	/**
	 * Build a Criteria object containing the values of all modified columns in this object.
	 *
	 * @return     Criteria The Criteria object containing all modified values.
	 */
	public function buildCriteria()
	{
		$criteria = new Criteria(CoursePeer::DATABASE_NAME);

		if ($this->isColumnModified(CoursePeer::NUM)) $criteria->add(CoursePeer::NUM, $this->num);
		if ($this->isColumnModified(CoursePeer::NB_SECTIONS)) $criteria->add(CoursePeer::NB_SECTIONS, $this->nb_sections);
		if ($this->isColumnModified(CoursePeer::NAME)) $criteria->add(CoursePeer::NAME, $this->name);
		if ($this->isColumnModified(CoursePeer::DEPT_ID)) $criteria->add(CoursePeer::DEPT_ID, $this->dept_id);
		if ($this->isColumnModified(CoursePeer::SPIDERED_AT)) $criteria->add(CoursePeer::SPIDERED_AT, $this->spidered_at);
		if ($this->isColumnModified(CoursePeer::SHALLOW_SPIDERED_AT)) $criteria->add(CoursePeer::SHALLOW_SPIDERED_AT, $this->shallow_spidered_at);
		if ($this->isColumnModified(CoursePeer::TOUCHED)) $criteria->add(CoursePeer::TOUCHED, $this->touched);
		if ($this->isColumnModified(CoursePeer::B_ID)) $criteria->add(CoursePeer::B_ID, $this->b_id);
		if ($this->isColumnModified(CoursePeer::BOOKSTORE_TYPE)) $criteria->add(CoursePeer::BOOKSTORE_TYPE, $this->bookstore_type);
		if ($this->isColumnModified(CoursePeer::ID)) $criteria->add(CoursePeer::ID, $this->id);
		if ($this->isColumnModified(CoursePeer::CREATED_AT)) $criteria->add(CoursePeer::CREATED_AT, $this->created_at);
		if ($this->isColumnModified(CoursePeer::UPDATED_AT)) $criteria->add(CoursePeer::UPDATED_AT, $this->updated_at);

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
		$criteria = new Criteria(CoursePeer::DATABASE_NAME);
		$criteria->add(CoursePeer::ID, $this->id);

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
	 * @param      object $copyObj An object of Course (or compatible) type.
	 * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
	 * @param      boolean $makeNew Whether to reset autoincrement PKs and make the object new.
	 * @throws     PropelException
	 */
	public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
	{
		$copyObj->setNum($this->getNum());
		$copyObj->setNbSections($this->getNbSections());
		$copyObj->setName($this->getName());
		$copyObj->setDeptId($this->getDeptId());
		$copyObj->setSpideredAt($this->getSpideredAt());
		$copyObj->setShallowSpideredAt($this->getShallowSpideredAt());
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

			foreach ($this->getSections() as $relObj) {
				if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
					$copyObj->addSection($relObj->copy($deepCopy));
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
	 * @return     Course Clone of current object.
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
	 * @return     CoursePeer
	 */
	public function getPeer()
	{
		if (self::$peer === null) {
			self::$peer = new CoursePeer();
		}
		return self::$peer;
	}

	/**
	 * Declares an association between this object and a Dept object.
	 *
	 * @param      Dept $v
	 * @return     Course The current object (for fluent API support)
	 * @throws     PropelException
	 */
	public function setDept(Dept $v = null)
	{
		if ($v === null) {
			$this->setDeptId(NULL);
		} else {
			$this->setDeptId($v->getId());
		}

		$this->aDept = $v;

		// Add binding for other direction of this n:n relationship.
		// If this object has already been added to the Dept object, it will not be re-added.
		if ($v !== null) {
			$v->addCourse($this);
		}

		return $this;
	}


	/**
	 * Get the associated Dept object
	 *
	 * @param      PropelPDO Optional Connection object.
	 * @return     Dept The associated Dept object.
	 * @throws     PropelException
	 */
	public function getDept(PropelPDO $con = null)
	{
		if ($this->aDept === null && ($this->dept_id !== null)) {
			$this->aDept = DeptQuery::create()->findPk($this->dept_id, $con);
			/* The following can be used additionally to
				guarantee the related object contains a reference
				to this object.  This level of coupling may, however, be
				undesirable since it could result in an only partially populated collection
				in the referenced object.
				$this->aDept->addCourses($this);
			 */
		}
		return $this->aDept;
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
		if ('Section' == $relationName) {
			return $this->initSections();
		}
	}

	/**
	 * Clears out the collSections collection
	 *
	 * This does not modify the database; however, it will remove any associated objects, causing
	 * them to be refetched by subsequent calls to accessor method.
	 *
	 * @return     void
	 * @see        addSections()
	 */
	public function clearSections()
	{
		$this->collSections = null; // important to set this to NULL since that means it is uninitialized
	}

	/**
	 * Initializes the collSections collection.
	 *
	 * By default this just sets the collSections collection to an empty array (like clearcollSections());
	 * however, you may wish to override this method in your stub class to provide setting appropriate
	 * to your application -- for example, setting the initial array to the values stored in database.
	 *
	 * @param      boolean $overrideExisting If set to true, the method call initializes
	 *                                        the collection even if it is not empty
	 *
	 * @return     void
	 */
	public function initSections($overrideExisting = true)
	{
		if (null !== $this->collSections && !$overrideExisting) {
			return;
		}
		$this->collSections = new PropelObjectCollection();
		$this->collSections->setModel('Section');
	}

	/**
	 * Gets an array of Section objects which contain a foreign key that references this object.
	 *
	 * If the $criteria is not null, it is used to always fetch the results from the database.
	 * Otherwise the results are fetched from the database the first time, then cached.
	 * Next time the same method is called without $criteria, the cached collection is returned.
	 * If this Course is new, it will return
	 * an empty collection or the current collection; the criteria is ignored on a new object.
	 *
	 * @param      Criteria $criteria optional Criteria object to narrow the query
	 * @param      PropelPDO $con optional connection object
	 * @return     PropelCollection|array Section[] List of Section objects
	 * @throws     PropelException
	 */
	public function getSections($criteria = null, PropelPDO $con = null)
	{
		if(null === $this->collSections || null !== $criteria) {
			if ($this->isNew() && null === $this->collSections) {
				// return empty collection
				$this->initSections();
			} else {
				$collSections = SectionQuery::create(null, $criteria)
					->filterByCourse($this)
					->find($con);
				if (null !== $criteria) {
					return $collSections;
				}
				$this->collSections = $collSections;
			}
		}
		return $this->collSections;
	}

	/**
	 * Sets a collection of Section objects related by a one-to-many relationship
	 * to the current object.
	 * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
	 * and new objects from the given Propel collection.
	 *
	 * @param      PropelCollection $sections A Propel collection.
	 * @param      PropelPDO $con Optional connection object
	 */
	public function setSections(PropelCollection $sections, PropelPDO $con = null)
	{
		$this->sectionsScheduledForDeletion = $this->getSections(new Criteria(), $con)->diff($sections);

		foreach ($sections as $section) {
			// Fix issue with collection modified by reference
			if ($section->isNew()) {
				$section->setCourse($this);
			}
			$this->addSection($section);
		}

		$this->collSections = $sections;
	}

	/**
	 * Returns the number of related Section objects.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      PropelPDO $con
	 * @return     int Count of related Section objects.
	 * @throws     PropelException
	 */
	public function countSections(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if(null === $this->collSections || null !== $criteria) {
			if ($this->isNew() && null === $this->collSections) {
				return 0;
			} else {
				$query = SectionQuery::create(null, $criteria);
				if($distinct) {
					$query->distinct();
				}
				return $query
					->filterByCourse($this)
					->count($con);
			}
		} else {
			return count($this->collSections);
		}
	}

	/**
	 * Method called to associate a Section object to this object
	 * through the Section foreign key attribute.
	 *
	 * @param      Section $l Section
	 * @return     Course The current object (for fluent API support)
	 */
	public function addSection(Section $l)
	{
		if ($this->collSections === null) {
			$this->initSections();
		}
		if (!$this->collSections->contains($l)) { // only add it if the **same** object is not already associated
			$this->doAddSection($l);
		}

		return $this;
	}

	/**
	 * @param	Section $section The section object to add.
	 */
	protected function doAddSection($section)
	{
		$this->collSections[]= $section;
		$section->setCourse($this);
	}

	/**
	 * Clears the current object and sets all attributes to their default values
	 */
	public function clear()
	{
		$this->num = null;
		$this->nb_sections = null;
		$this->name = null;
		$this->dept_id = null;
		$this->spidered_at = null;
		$this->shallow_spidered_at = null;
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
			if ($this->collSections) {
				foreach ($this->collSections as $o) {
					$o->clearAllReferences($deep);
				}
			}
		} // if ($deep)

		if ($this->collSections instanceof PropelCollection) {
			$this->collSections->clearIterator();
		}
		$this->collSections = null;
		$this->aDept = null;
	}

	/**
	 * Return the string representation of this object
	 *
	 * @return string
	 */
	public function __toString()
	{
		return (string) $this->exportTo(CoursePeer::DEFAULT_STRING_FORMAT);
	}

	// spiderable behavior
	
	  
	    /**
	     * Set the spidered time to the current time
	     *
	     * @return     Course The current object (for fluent API support)
	     */
	    public function setSpidered()
	    {
	        $this->setSpideredAt(time());
	        return $this;
	    }
	    
	// aggregate_column behavior
	
	/**
	 * Computes the value of the aggregate column nb_sections *
	 * @param PropelPDO $con A connection object
	 *
	 * @return mixed The scalar result from the aggregate query
	 */
	public function computeNbSections(PropelPDO $con)
	{
		$stmt = $con->prepare('SELECT COUNT(id) FROM `section` WHERE section.COURSE_ID = :p1');
	  $stmt->bindValue(':p1', $this->getId());
		$stmt->execute();
		return $stmt->fetchColumn();
	}
	
	/**
	 * Updates the aggregate column nb_sections *
	 * @param PropelPDO $con A connection object
	 */
	public function updateNbSections(PropelPDO $con)
	{
		$this->setNbSections($this->computeNbSections($con));
		$this->save($con);
	}

	// timestampable behavior
	
	/**
	 * Mark the current object so that the update date doesn't get updated during next save
	 *
	 * @return     Course The current object (for fluent API support)
	 */
	public function keepUpdateDateUnchanged()
	{
		$this->modifiedColumns[] = CoursePeer::UPDATED_AT;
		return $this;
	}

} // BaseCourse
