<?php


/**
 * Base class that represents a row from the 'term' table.
 *
 * 
 *
 * @package    propel.generator..om
 */
abstract class BaseTerm extends Spiderable  implements Persistent
{

	/**
	 * Peer class name
	 */
	const PEER = 'TermPeer';

	/**
	 * The Peer class.
	 * Instance provides a convenient way of calling static methods on a class
	 * that calling code may not be able to identify.
	 * @var        TermPeer
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
	 * The value for the status field.
	 * Note: this column has a database default value of: -1
	 * @var        int
	 */
	protected $status;

	/**
	 * The value for the has_course_info field.
	 * Note: this column has a database default value of: false
	 * @var        boolean
	 */
	protected $has_course_info;

	/**
	 * The value for the campus_id field.
	 * @var        int
	 */
	protected $campus_id;

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
	 * @var        Campus
	 */
	protected $aCampus;

	/**
	 * @var        array Dept[] Collection to store aggregation of Dept objects.
	 */
	protected $collDepts;

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
	protected $deptsScheduledForDeletion = null;

	/**
	 * Applies default values to this object.
	 * This method should be called from the object's constructor (or
	 * equivalent initialization method).
	 * @see        __construct()
	 */
	public function applyDefaultValues()
	{
		$this->status = -1;
		$this->has_course_info = false;
	}

	/**
	 * Initializes internal state of BaseTerm object.
	 * @see        applyDefaults()
	 */
	public function __construct()
	{
		parent::__construct();
		$this->applyDefaultValues();
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
	 * Get the [status] column value.
	 * Guess as to the timeframe. -1 = past, 0 = current (only one),   1 = future
	 * @return     int
	 */
	public function getStatus()
	{
		return $this->status;
	}

	/**
	 * Get the [has_course_info] column value.
	 * Whether we have extra metadata for depts, courses, and   sections in this term.
	 * @return     boolean
	 */
	public function getHasCourseInfo()
	{
		return $this->has_course_info;
	}

	/**
	 * Get the [campus_id] column value.
	 * 
	 * @return     int
	 */
	public function getCampusId()
	{
		return $this->campus_id;
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
	 * @return     Term The current object (for fluent API support)
	 */
	public function setShallowSpideredAt($v)
	{
		$dt = PropelDateTime::newInstance($v, null, 'DateTime');
		if ($this->shallow_spidered_at !== null || $dt !== null) {
			$currentDateAsString = ($this->shallow_spidered_at !== null && $tmpDt = new DateTime($this->shallow_spidered_at)) ? $tmpDt->format('Y-m-d H:i:s') : null;
			$newDateAsString = $dt ? $dt->format('Y-m-d H:i:s') : null;
			if ($currentDateAsString !== $newDateAsString) {
				$this->shallow_spidered_at = $newDateAsString;
				$this->modifiedColumns[] = TermPeer::SHALLOW_SPIDERED_AT;
			}
		} // if either are not null

		return $this;
	} // setShallowSpideredAt()

	/**
	 * Set the value of [name] column.
	 * 
	 * @param      string $v new value
	 * @return     Term The current object (for fluent API support)
	 */
	public function setName($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->name !== $v) {
			$this->name = $v;
			$this->modifiedColumns[] = TermPeer::NAME;
		}

		return $this;
	} // setName()

	/**
	 * Set the value of [slug] column.
	 * 
	 * @param      string $v new value
	 * @return     Term The current object (for fluent API support)
	 */
	public function setSlug($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->slug !== $v) {
			$this->slug = $v;
			$this->modifiedColumns[] = TermPeer::SLUG;
		}

		return $this;
	} // setSlug()

	/**
	 * Set the value of [status] column.
	 * Guess as to the timeframe. -1 = past, 0 = current (only one),   1 = future
	 * @param      int $v new value
	 * @return     Term The current object (for fluent API support)
	 */
	public function setStatus($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->status !== $v) {
			$this->status = $v;
			$this->modifiedColumns[] = TermPeer::STATUS;
		}

		return $this;
	} // setStatus()

	/**
	 * Sets the value of the [has_course_info] column.
	 * Non-boolean arguments are converted using the following rules:
	 *   * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
	 *   * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
	 * Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
	 * Whether we have extra metadata for depts, courses, and   sections in this term.
	 * @param      boolean|integer|string $v The new value
	 * @return     Term The current object (for fluent API support)
	 */
	public function setHasCourseInfo($v)
	{
		if ($v !== null) {
			if (is_string($v)) {
				$v = in_array(strtolower($v), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
			} else {
				$v = (boolean) $v;
			}
		}

		if ($this->has_course_info !== $v) {
			$this->has_course_info = $v;
			$this->modifiedColumns[] = TermPeer::HAS_COURSE_INFO;
		}

		return $this;
	} // setHasCourseInfo()

	/**
	 * Set the value of [campus_id] column.
	 * 
	 * @param      int $v new value
	 * @return     Term The current object (for fluent API support)
	 */
	public function setCampusId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->campus_id !== $v) {
			$this->campus_id = $v;
			$this->modifiedColumns[] = TermPeer::CAMPUS_ID;
		}

		if ($this->aCampus !== null && $this->aCampus->getId() !== $v) {
			$this->aCampus = null;
		}

		return $this;
	} // setCampusId()

	/**
	 * Sets the value of [spidered_at] column to a normalized version of the date/time value specified.
	 * 
	 * @param      mixed $v string, integer (timestamp), or DateTime value.
	 *               Empty strings are treated as NULL.
	 * @return     Term The current object (for fluent API support)
	 */
	public function setSpideredAt($v)
	{
		$dt = PropelDateTime::newInstance($v, null, 'DateTime');
		if ($this->spidered_at !== null || $dt !== null) {
			$currentDateAsString = ($this->spidered_at !== null && $tmpDt = new DateTime($this->spidered_at)) ? $tmpDt->format('Y-m-d H:i:s') : null;
			$newDateAsString = $dt ? $dt->format('Y-m-d H:i:s') : null;
			if ($currentDateAsString !== $newDateAsString) {
				$this->spidered_at = $newDateAsString;
				$this->modifiedColumns[] = TermPeer::SPIDERED_AT;
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
	 * @return     Term The current object (for fluent API support)
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
			$this->modifiedColumns[] = TermPeer::TOUCHED;
		}

		return $this;
	} // setTouched()

	/**
	 * Set the value of [b_id] column.
	 * 
	 * @param      string $v new value
	 * @return     Term The current object (for fluent API support)
	 */
	public function setBId($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->b_id !== $v) {
			$this->b_id = $v;
			$this->modifiedColumns[] = TermPeer::B_ID;
		}

		return $this;
	} // setBId()

	/**
	 * Set the value of [bookstore_type] column.
	 * 
	 * @param      string $v new value
	 * @return     Term The current object (for fluent API support)
	 */
	public function setBookstoreType($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->bookstore_type !== $v) {
			$this->bookstore_type = $v;
			$this->modifiedColumns[] = TermPeer::BOOKSTORE_TYPE;
		}

		return $this;
	} // setBookstoreType()

	/**
	 * Set the value of [id] column.
	 * 
	 * @param      int $v new value
	 * @return     Term The current object (for fluent API support)
	 */
	public function setId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = TermPeer::ID;
		}

		return $this;
	} // setId()

	/**
	 * Sets the value of [created_at] column to a normalized version of the date/time value specified.
	 * 
	 * @param      mixed $v string, integer (timestamp), or DateTime value.
	 *               Empty strings are treated as NULL.
	 * @return     Term The current object (for fluent API support)
	 */
	public function setCreatedAt($v)
	{
		$dt = PropelDateTime::newInstance($v, null, 'DateTime');
		if ($this->created_at !== null || $dt !== null) {
			$currentDateAsString = ($this->created_at !== null && $tmpDt = new DateTime($this->created_at)) ? $tmpDt->format('Y-m-d H:i:s') : null;
			$newDateAsString = $dt ? $dt->format('Y-m-d H:i:s') : null;
			if ($currentDateAsString !== $newDateAsString) {
				$this->created_at = $newDateAsString;
				$this->modifiedColumns[] = TermPeer::CREATED_AT;
			}
		} // if either are not null

		return $this;
	} // setCreatedAt()

	/**
	 * Sets the value of [updated_at] column to a normalized version of the date/time value specified.
	 * 
	 * @param      mixed $v string, integer (timestamp), or DateTime value.
	 *               Empty strings are treated as NULL.
	 * @return     Term The current object (for fluent API support)
	 */
	public function setUpdatedAt($v)
	{
		$dt = PropelDateTime::newInstance($v, null, 'DateTime');
		if ($this->updated_at !== null || $dt !== null) {
			$currentDateAsString = ($this->updated_at !== null && $tmpDt = new DateTime($this->updated_at)) ? $tmpDt->format('Y-m-d H:i:s') : null;
			$newDateAsString = $dt ? $dt->format('Y-m-d H:i:s') : null;
			if ($currentDateAsString !== $newDateAsString) {
				$this->updated_at = $newDateAsString;
				$this->modifiedColumns[] = TermPeer::UPDATED_AT;
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
			if ($this->status !== -1) {
				return false;
			}

			if ($this->has_course_info !== false) {
				return false;
			}

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
			$this->status = ($row[$startcol + 3] !== null) ? (int) $row[$startcol + 3] : null;
			$this->has_course_info = ($row[$startcol + 4] !== null) ? (boolean) $row[$startcol + 4] : null;
			$this->campus_id = ($row[$startcol + 5] !== null) ? (int) $row[$startcol + 5] : null;
			$this->spidered_at = ($row[$startcol + 6] !== null) ? (string) $row[$startcol + 6] : null;
			$this->touched = ($row[$startcol + 7] !== null) ? (boolean) $row[$startcol + 7] : null;
			$this->b_id = ($row[$startcol + 8] !== null) ? (string) $row[$startcol + 8] : null;
			$this->bookstore_type = ($row[$startcol + 9] !== null) ? (string) $row[$startcol + 9] : null;
			$this->id = ($row[$startcol + 10] !== null) ? (int) $row[$startcol + 10] : null;
			$this->created_at = ($row[$startcol + 11] !== null) ? (string) $row[$startcol + 11] : null;
			$this->updated_at = ($row[$startcol + 12] !== null) ? (string) $row[$startcol + 12] : null;
			$this->resetModified();

			$this->setNew(false);

			if ($rehydrate) {
				$this->ensureConsistency();
			}

			return $startcol + 13; // 13 = TermPeer::NUM_HYDRATE_COLUMNS.

		} catch (Exception $e) {
			throw new PropelException("Error populating Term object", $e);
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

		if ($this->aCampus !== null && $this->campus_id !== $this->aCampus->getId()) {
			$this->aCampus = null;
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
			$con = Propel::getConnection(TermPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		// We don't need to alter the object instance pool; we're just modifying this instance
		// already in the pool.

		$stmt = TermPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
		$row = $stmt->fetch(PDO::FETCH_NUM);
		$stmt->closeCursor();
		if (!$row) {
			throw new PropelException('Cannot find matching row in the database to reload object values.');
		}
		$this->hydrate($row, 0, true); // rehydrate

		if ($deep) {  // also de-associate any related objects?

			$this->aCampus = null;
			$this->collDepts = null;

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
			$con = Propel::getConnection(TermPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		$con->beginTransaction();
		try {
			$deleteQuery = TermQuery::create()
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
			$con = Propel::getConnection(TermPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		$con->beginTransaction();
		$isInsert = $this->isNew();
		try {
			$ret = $this->preSave($con);
			if ($isInsert) {
				$ret = $ret && $this->preInsert($con);
				// spiderable behavior
				if (!$this->isColumnModified(TermPeer::SPIDERED_AT)) {
				            $this->setSpideredAt(NULL);
				    }
				// timestampable behavior
				if (!$this->isColumnModified(TermPeer::CREATED_AT)) {
					$this->setCreatedAt(time());
				}
				if (!$this->isColumnModified(TermPeer::UPDATED_AT)) {
					$this->setUpdatedAt(time());
				}
			} else {
				$ret = $ret && $this->preUpdate($con);
				// timestampable behavior
				if ($this->isModified() && !$this->isColumnModified(TermPeer::UPDATED_AT)) {
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
				TermPeer::addInstanceToPool($this);
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

			if ($this->aCampus !== null) {
				if ($this->aCampus->isModified() || $this->aCampus->isNew()) {
					$affectedRows += $this->aCampus->save($con);
				}
				$this->setCampus($this->aCampus);
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

			if ($this->deptsScheduledForDeletion !== null) {
				if (!$this->deptsScheduledForDeletion->isEmpty()) {
					DeptQuery::create()
						->filterByPrimaryKeys($this->deptsScheduledForDeletion->getPrimaryKeys(false))
						->delete($con);
					$this->deptsScheduledForDeletion = null;
				}
			}

			if ($this->collDepts !== null) {
				foreach ($this->collDepts as $referrerFK) {
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

		$this->modifiedColumns[] = TermPeer::ID;
		if (null !== $this->id) {
			throw new PropelException('Cannot insert a value for auto-increment primary key (' . TermPeer::ID . ')');
		}

		 // check the columns in natural order for more readable SQL queries
		if ($this->isColumnModified(TermPeer::SHALLOW_SPIDERED_AT)) {
			$modifiedColumns[':p' . $index++]  = '`SHALLOW_SPIDERED_AT`';
		}
		if ($this->isColumnModified(TermPeer::NAME)) {
			$modifiedColumns[':p' . $index++]  = '`NAME`';
		}
		if ($this->isColumnModified(TermPeer::SLUG)) {
			$modifiedColumns[':p' . $index++]  = '`SLUG`';
		}
		if ($this->isColumnModified(TermPeer::STATUS)) {
			$modifiedColumns[':p' . $index++]  = '`STATUS`';
		}
		if ($this->isColumnModified(TermPeer::HAS_COURSE_INFO)) {
			$modifiedColumns[':p' . $index++]  = '`HAS_COURSE_INFO`';
		}
		if ($this->isColumnModified(TermPeer::CAMPUS_ID)) {
			$modifiedColumns[':p' . $index++]  = '`CAMPUS_ID`';
		}
		if ($this->isColumnModified(TermPeer::SPIDERED_AT)) {
			$modifiedColumns[':p' . $index++]  = '`SPIDERED_AT`';
		}
		if ($this->isColumnModified(TermPeer::TOUCHED)) {
			$modifiedColumns[':p' . $index++]  = '`TOUCHED`';
		}
		if ($this->isColumnModified(TermPeer::B_ID)) {
			$modifiedColumns[':p' . $index++]  = '`B_ID`';
		}
		if ($this->isColumnModified(TermPeer::BOOKSTORE_TYPE)) {
			$modifiedColumns[':p' . $index++]  = '`BOOKSTORE_TYPE`';
		}
		if ($this->isColumnModified(TermPeer::ID)) {
			$modifiedColumns[':p' . $index++]  = '`ID`';
		}
		if ($this->isColumnModified(TermPeer::CREATED_AT)) {
			$modifiedColumns[':p' . $index++]  = '`CREATED_AT`';
		}
		if ($this->isColumnModified(TermPeer::UPDATED_AT)) {
			$modifiedColumns[':p' . $index++]  = '`UPDATED_AT`';
		}

		$sql = sprintf(
			'INSERT INTO `term` (%s) VALUES (%s)',
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
					case '`STATUS`':
						$stmt->bindValue($identifier, $this->status, PDO::PARAM_INT);
						break;
					case '`HAS_COURSE_INFO`':
						$stmt->bindValue($identifier, (int) $this->has_course_info, PDO::PARAM_INT);
						break;
					case '`CAMPUS_ID`':
						$stmt->bindValue($identifier, $this->campus_id, PDO::PARAM_INT);
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

			if ($this->aCampus !== null) {
				if (!$this->aCampus->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aCampus->getValidationFailures());
				}
			}


			if (($retval = TermPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collDepts !== null) {
					foreach ($this->collDepts as $referrerFK) {
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
		$pos = TermPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getStatus();
				break;
			case 4:
				return $this->getHasCourseInfo();
				break;
			case 5:
				return $this->getCampusId();
				break;
			case 6:
				return $this->getSpideredAt();
				break;
			case 7:
				return $this->getTouched();
				break;
			case 8:
				return $this->getBId();
				break;
			case 9:
				return $this->getBookstoreType();
				break;
			case 10:
				return $this->getId();
				break;
			case 11:
				return $this->getCreatedAt();
				break;
			case 12:
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
		if (isset($alreadyDumpedObjects['Term'][$this->getPrimaryKey()])) {
			return '*RECURSION*';
		}
		$alreadyDumpedObjects['Term'][$this->getPrimaryKey()] = true;
		$keys = TermPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getShallowSpideredAt(),
			$keys[1] => $this->getName(),
			$keys[2] => $this->getSlug(),
			$keys[3] => $this->getStatus(),
			$keys[4] => $this->getHasCourseInfo(),
			$keys[5] => $this->getCampusId(),
			$keys[6] => $this->getSpideredAt(),
			$keys[7] => $this->getTouched(),
			$keys[8] => $this->getBId(),
			$keys[9] => $this->getBookstoreType(),
			$keys[10] => $this->getId(),
			$keys[11] => $this->getCreatedAt(),
			$keys[12] => $this->getUpdatedAt(),
		);
		if ($includeForeignObjects) {
			if (null !== $this->aCampus) {
				$result['Campus'] = $this->aCampus->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
			}
			if (null !== $this->collDepts) {
				$result['Depts'] = $this->collDepts->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
		$pos = TermPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setStatus($value);
				break;
			case 4:
				$this->setHasCourseInfo($value);
				break;
			case 5:
				$this->setCampusId($value);
				break;
			case 6:
				$this->setSpideredAt($value);
				break;
			case 7:
				$this->setTouched($value);
				break;
			case 8:
				$this->setBId($value);
				break;
			case 9:
				$this->setBookstoreType($value);
				break;
			case 10:
				$this->setId($value);
				break;
			case 11:
				$this->setCreatedAt($value);
				break;
			case 12:
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
		$keys = TermPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setShallowSpideredAt($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setName($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setSlug($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setStatus($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setHasCourseInfo($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setCampusId($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setSpideredAt($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setTouched($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setBId($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setBookstoreType($arr[$keys[9]]);
		if (array_key_exists($keys[10], $arr)) $this->setId($arr[$keys[10]]);
		if (array_key_exists($keys[11], $arr)) $this->setCreatedAt($arr[$keys[11]]);
		if (array_key_exists($keys[12], $arr)) $this->setUpdatedAt($arr[$keys[12]]);
	}

	/**
	 * Build a Criteria object containing the values of all modified columns in this object.
	 *
	 * @return     Criteria The Criteria object containing all modified values.
	 */
	public function buildCriteria()
	{
		$criteria = new Criteria(TermPeer::DATABASE_NAME);

		if ($this->isColumnModified(TermPeer::SHALLOW_SPIDERED_AT)) $criteria->add(TermPeer::SHALLOW_SPIDERED_AT, $this->shallow_spidered_at);
		if ($this->isColumnModified(TermPeer::NAME)) $criteria->add(TermPeer::NAME, $this->name);
		if ($this->isColumnModified(TermPeer::SLUG)) $criteria->add(TermPeer::SLUG, $this->slug);
		if ($this->isColumnModified(TermPeer::STATUS)) $criteria->add(TermPeer::STATUS, $this->status);
		if ($this->isColumnModified(TermPeer::HAS_COURSE_INFO)) $criteria->add(TermPeer::HAS_COURSE_INFO, $this->has_course_info);
		if ($this->isColumnModified(TermPeer::CAMPUS_ID)) $criteria->add(TermPeer::CAMPUS_ID, $this->campus_id);
		if ($this->isColumnModified(TermPeer::SPIDERED_AT)) $criteria->add(TermPeer::SPIDERED_AT, $this->spidered_at);
		if ($this->isColumnModified(TermPeer::TOUCHED)) $criteria->add(TermPeer::TOUCHED, $this->touched);
		if ($this->isColumnModified(TermPeer::B_ID)) $criteria->add(TermPeer::B_ID, $this->b_id);
		if ($this->isColumnModified(TermPeer::BOOKSTORE_TYPE)) $criteria->add(TermPeer::BOOKSTORE_TYPE, $this->bookstore_type);
		if ($this->isColumnModified(TermPeer::ID)) $criteria->add(TermPeer::ID, $this->id);
		if ($this->isColumnModified(TermPeer::CREATED_AT)) $criteria->add(TermPeer::CREATED_AT, $this->created_at);
		if ($this->isColumnModified(TermPeer::UPDATED_AT)) $criteria->add(TermPeer::UPDATED_AT, $this->updated_at);

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
		$criteria = new Criteria(TermPeer::DATABASE_NAME);
		$criteria->add(TermPeer::ID, $this->id);

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
	 * @param      object $copyObj An object of Term (or compatible) type.
	 * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
	 * @param      boolean $makeNew Whether to reset autoincrement PKs and make the object new.
	 * @throws     PropelException
	 */
	public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
	{
		$copyObj->setShallowSpideredAt($this->getShallowSpideredAt());
		$copyObj->setName($this->getName());
		$copyObj->setSlug($this->getSlug());
		$copyObj->setStatus($this->getStatus());
		$copyObj->setHasCourseInfo($this->getHasCourseInfo());
		$copyObj->setCampusId($this->getCampusId());
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

			foreach ($this->getDepts() as $relObj) {
				if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
					$copyObj->addDept($relObj->copy($deepCopy));
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
	 * @return     Term Clone of current object.
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
	 * @return     TermPeer
	 */
	public function getPeer()
	{
		if (self::$peer === null) {
			self::$peer = new TermPeer();
		}
		return self::$peer;
	}

	/**
	 * Declares an association between this object and a Campus object.
	 *
	 * @param      Campus $v
	 * @return     Term The current object (for fluent API support)
	 * @throws     PropelException
	 */
	public function setCampus(Campus $v = null)
	{
		if ($v === null) {
			$this->setCampusId(NULL);
		} else {
			$this->setCampusId($v->getId());
		}

		$this->aCampus = $v;

		// Add binding for other direction of this n:n relationship.
		// If this object has already been added to the Campus object, it will not be re-added.
		if ($v !== null) {
			$v->addTerm($this);
		}

		return $this;
	}


	/**
	 * Get the associated Campus object
	 *
	 * @param      PropelPDO Optional Connection object.
	 * @return     Campus The associated Campus object.
	 * @throws     PropelException
	 */
	public function getCampus(PropelPDO $con = null)
	{
		if ($this->aCampus === null && ($this->campus_id !== null)) {
			$this->aCampus = CampusQuery::create()->findPk($this->campus_id, $con);
			/* The following can be used additionally to
				guarantee the related object contains a reference
				to this object.  This level of coupling may, however, be
				undesirable since it could result in an only partially populated collection
				in the referenced object.
				$this->aCampus->addTerms($this);
			 */
		}
		return $this->aCampus;
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
		if ('Dept' == $relationName) {
			return $this->initDepts();
		}
	}

	/**
	 * Clears out the collDepts collection
	 *
	 * This does not modify the database; however, it will remove any associated objects, causing
	 * them to be refetched by subsequent calls to accessor method.
	 *
	 * @return     void
	 * @see        addDepts()
	 */
	public function clearDepts()
	{
		$this->collDepts = null; // important to set this to NULL since that means it is uninitialized
	}

	/**
	 * Initializes the collDepts collection.
	 *
	 * By default this just sets the collDepts collection to an empty array (like clearcollDepts());
	 * however, you may wish to override this method in your stub class to provide setting appropriate
	 * to your application -- for example, setting the initial array to the values stored in database.
	 *
	 * @param      boolean $overrideExisting If set to true, the method call initializes
	 *                                        the collection even if it is not empty
	 *
	 * @return     void
	 */
	public function initDepts($overrideExisting = true)
	{
		if (null !== $this->collDepts && !$overrideExisting) {
			return;
		}
		$this->collDepts = new PropelObjectCollection();
		$this->collDepts->setModel('Dept');
	}

	/**
	 * Gets an array of Dept objects which contain a foreign key that references this object.
	 *
	 * If the $criteria is not null, it is used to always fetch the results from the database.
	 * Otherwise the results are fetched from the database the first time, then cached.
	 * Next time the same method is called without $criteria, the cached collection is returned.
	 * If this Term is new, it will return
	 * an empty collection or the current collection; the criteria is ignored on a new object.
	 *
	 * @param      Criteria $criteria optional Criteria object to narrow the query
	 * @param      PropelPDO $con optional connection object
	 * @return     PropelCollection|array Dept[] List of Dept objects
	 * @throws     PropelException
	 */
	public function getDepts($criteria = null, PropelPDO $con = null)
	{
		if(null === $this->collDepts || null !== $criteria) {
			if ($this->isNew() && null === $this->collDepts) {
				// return empty collection
				$this->initDepts();
			} else {
				$collDepts = DeptQuery::create(null, $criteria)
					->filterByTerm($this)
					->find($con);
				if (null !== $criteria) {
					return $collDepts;
				}
				$this->collDepts = $collDepts;
			}
		}
		return $this->collDepts;
	}

	/**
	 * Sets a collection of Dept objects related by a one-to-many relationship
	 * to the current object.
	 * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
	 * and new objects from the given Propel collection.
	 *
	 * @param      PropelCollection $depts A Propel collection.
	 * @param      PropelPDO $con Optional connection object
	 */
	public function setDepts(PropelCollection $depts, PropelPDO $con = null)
	{
		$this->deptsScheduledForDeletion = $this->getDepts(new Criteria(), $con)->diff($depts);

		foreach ($depts as $dept) {
			// Fix issue with collection modified by reference
			if ($dept->isNew()) {
				$dept->setTerm($this);
			}
			$this->addDept($dept);
		}

		$this->collDepts = $depts;
	}

	/**
	 * Returns the number of related Dept objects.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      PropelPDO $con
	 * @return     int Count of related Dept objects.
	 * @throws     PropelException
	 */
	public function countDepts(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if(null === $this->collDepts || null !== $criteria) {
			if ($this->isNew() && null === $this->collDepts) {
				return 0;
			} else {
				$query = DeptQuery::create(null, $criteria);
				if($distinct) {
					$query->distinct();
				}
				return $query
					->filterByTerm($this)
					->count($con);
			}
		} else {
			return count($this->collDepts);
		}
	}

	/**
	 * Method called to associate a Dept object to this object
	 * through the Dept foreign key attribute.
	 *
	 * @param      Dept $l Dept
	 * @return     Term The current object (for fluent API support)
	 */
	public function addDept(Dept $l)
	{
		if ($this->collDepts === null) {
			$this->initDepts();
		}
		if (!$this->collDepts->contains($l)) { // only add it if the **same** object is not already associated
			$this->doAddDept($l);
		}

		return $this;
	}

	/**
	 * @param	Dept $dept The dept object to add.
	 */
	protected function doAddDept($dept)
	{
		$this->collDepts[]= $dept;
		$dept->setTerm($this);
	}

	/**
	 * Clears the current object and sets all attributes to their default values
	 */
	public function clear()
	{
		$this->shallow_spidered_at = null;
		$this->name = null;
		$this->slug = null;
		$this->status = null;
		$this->has_course_info = null;
		$this->campus_id = null;
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
		$this->applyDefaultValues();
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
			if ($this->collDepts) {
				foreach ($this->collDepts as $o) {
					$o->clearAllReferences($deep);
				}
			}
		} // if ($deep)

		if ($this->collDepts instanceof PropelCollection) {
			$this->collDepts->clearIterator();
		}
		$this->collDepts = null;
		$this->aCampus = null;
	}

	/**
	 * Return the string representation of this object
	 *
	 * @return string
	 */
	public function __toString()
	{
		return (string) $this->exportTo(TermPeer::DEFAULT_STRING_FORMAT);
	}

	// spiderable behavior
	
	  
	    /**
	     * Set the spidered time to the current time
	     *
	     * @return     Term The current object (for fluent API support)
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
	 * @return     Term The current object (for fluent API support)
	 */
	public function keepUpdateDateUnchanged()
	{
		$this->modifiedColumns[] = TermPeer::UPDATED_AT;
		return $this;
	}

} // BaseTerm
