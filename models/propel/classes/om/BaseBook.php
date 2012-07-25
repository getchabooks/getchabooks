<?php


/**
 * Base class that represents a row from the 'book' table.
 *
 * 
 *
 * @package    propel.generator..om
 */
abstract class BaseBook extends BaseObject  implements Persistent
{

	/**
	 * Peer class name
	 */
	const PEER = 'BookPeer';

	/**
	 * The Peer class.
	 * Instance provides a convenient way of calling static methods on a class
	 * that calling code may not be able to identify.
	 * @var        BookPeer
	 */
	protected static $peer;

	/**
	 * The flag var to prevent infinit loop in deep copy
	 * @var       boolean
	 */
	protected $startCopy = false;

	/**
	 * The value for the isbn field.
	 * @var        string
	 */
	protected $isbn;

	/**
	 * The value for the title field.
	 * Note: this column has a database default value of: ''
	 * @var        string
	 */
	protected $title;

	/**
	 * The value for the author field.
	 * @var        string
	 */
	protected $author;

	/**
	 * The value for the publisher field.
	 * @var        string
	 */
	protected $publisher;

	/**
	 * The value for the edition field.
	 * @var        string
	 */
	protected $edition;

	/**
	 * The value for the edition_num field.
	 * @var        string
	 */
	protected $edition_num;

	/**
	 * The value for the pubdate field.
	 * @var        string
	 */
	protected $pubdate;

	/**
	 * The value for the is_paperback field.
	 * Note: this column has a database default value of: false
	 * @var        boolean
	 */
	protected $is_paperback;

	/**
	 * The value for the image_url field.
	 * @var        string
	 */
	protected $image_url;

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
	 * @var        array Item[] Collection to store aggregation of Item objects.
	 */
	protected $collItems;

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
	protected $itemsScheduledForDeletion = null;

	/**
	 * Applies default values to this object.
	 * This method should be called from the object's constructor (or
	 * equivalent initialization method).
	 * @see        __construct()
	 */
	public function applyDefaultValues()
	{
		$this->title = '';
		$this->is_paperback = false;
	}

	/**
	 * Initializes internal state of BaseBook object.
	 * @see        applyDefaults()
	 */
	public function __construct()
	{
		parent::__construct();
		$this->applyDefaultValues();
	}

	/**
	 * Get the [isbn] column value.
	 * 
	 * @return     string
	 */
	public function getIsbn()
	{
		return $this->isbn;
	}

	/**
	 * Get the [title] column value.
	 * 
	 * @return     string
	 */
	public function getTitle()
	{
		return $this->title;
	}

	/**
	 * Get the [author] column value.
	 * 
	 * @return     string
	 */
	public function getAuthor()
	{
		return $this->author;
	}

	/**
	 * Get the [publisher] column value.
	 * 
	 * @return     string
	 */
	public function getPublisher()
	{
		return $this->publisher;
	}

	/**
	 * Get the [edition] column value.
	 * 
	 * @return     string
	 */
	public function getEdition()
	{
		return $this->edition;
	}

	/**
	 * Get the [edition_num] column value.
	 * 
	 * @return     string
	 */
	public function getEditionNum()
	{
		return $this->edition_num;
	}

	/**
	 * Get the [pubdate] column value.
	 * 
	 * @return     string
	 */
	public function getPubdate()
	{
		return $this->pubdate;
	}

	/**
	 * Get the [is_paperback] column value.
	 * 
	 * @return     boolean
	 */
	public function getIsPaperback()
	{
		return $this->is_paperback;
	}

	/**
	 * Get the [image_url] column value.
	 * 
	 * @return     string
	 */
	public function getImageUrl()
	{
		return $this->image_url;
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
	 * Set the value of [isbn] column.
	 * 
	 * @param      string $v new value
	 * @return     Book The current object (for fluent API support)
	 */
	public function setIsbn($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->isbn !== $v) {
			$this->isbn = $v;
			$this->modifiedColumns[] = BookPeer::ISBN;
		}

		return $this;
	} // setIsbn()

	/**
	 * Set the value of [title] column.
	 * 
	 * @param      string $v new value
	 * @return     Book The current object (for fluent API support)
	 */
	public function setTitle($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->title !== $v) {
			$this->title = $v;
			$this->modifiedColumns[] = BookPeer::TITLE;
		}

		return $this;
	} // setTitle()

	/**
	 * Set the value of [author] column.
	 * 
	 * @param      string $v new value
	 * @return     Book The current object (for fluent API support)
	 */
	public function setAuthor($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->author !== $v) {
			$this->author = $v;
			$this->modifiedColumns[] = BookPeer::AUTHOR;
		}

		return $this;
	} // setAuthor()

	/**
	 * Set the value of [publisher] column.
	 * 
	 * @param      string $v new value
	 * @return     Book The current object (for fluent API support)
	 */
	public function setPublisher($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->publisher !== $v) {
			$this->publisher = $v;
			$this->modifiedColumns[] = BookPeer::PUBLISHER;
		}

		return $this;
	} // setPublisher()

	/**
	 * Set the value of [edition] column.
	 * 
	 * @param      string $v new value
	 * @return     Book The current object (for fluent API support)
	 */
	public function setEdition($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->edition !== $v) {
			$this->edition = $v;
			$this->modifiedColumns[] = BookPeer::EDITION;
		}

		return $this;
	} // setEdition()

	/**
	 * Set the value of [edition_num] column.
	 * 
	 * @param      string $v new value
	 * @return     Book The current object (for fluent API support)
	 */
	public function setEditionNum($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->edition_num !== $v) {
			$this->edition_num = $v;
			$this->modifiedColumns[] = BookPeer::EDITION_NUM;
		}

		return $this;
	} // setEditionNum()

	/**
	 * Set the value of [pubdate] column.
	 * 
	 * @param      string $v new value
	 * @return     Book The current object (for fluent API support)
	 */
	public function setPubdate($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->pubdate !== $v) {
			$this->pubdate = $v;
			$this->modifiedColumns[] = BookPeer::PUBDATE;
		}

		return $this;
	} // setPubdate()

	/**
	 * Sets the value of the [is_paperback] column.
	 * Non-boolean arguments are converted using the following rules:
	 *   * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
	 *   * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
	 * Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
	 * 
	 * @param      boolean|integer|string $v The new value
	 * @return     Book The current object (for fluent API support)
	 */
	public function setIsPaperback($v)
	{
		if ($v !== null) {
			if (is_string($v)) {
				$v = in_array(strtolower($v), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
			} else {
				$v = (boolean) $v;
			}
		}

		if ($this->is_paperback !== $v) {
			$this->is_paperback = $v;
			$this->modifiedColumns[] = BookPeer::IS_PAPERBACK;
		}

		return $this;
	} // setIsPaperback()

	/**
	 * Set the value of [image_url] column.
	 * 
	 * @param      string $v new value
	 * @return     Book The current object (for fluent API support)
	 */
	public function setImageUrl($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->image_url !== $v) {
			$this->image_url = $v;
			$this->modifiedColumns[] = BookPeer::IMAGE_URL;
		}

		return $this;
	} // setImageUrl()

	/**
	 * Set the value of [id] column.
	 * 
	 * @param      int $v new value
	 * @return     Book The current object (for fluent API support)
	 */
	public function setId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = BookPeer::ID;
		}

		return $this;
	} // setId()

	/**
	 * Sets the value of [created_at] column to a normalized version of the date/time value specified.
	 * 
	 * @param      mixed $v string, integer (timestamp), or DateTime value.
	 *               Empty strings are treated as NULL.
	 * @return     Book The current object (for fluent API support)
	 */
	public function setCreatedAt($v)
	{
		$dt = PropelDateTime::newInstance($v, null, 'DateTime');
		if ($this->created_at !== null || $dt !== null) {
			$currentDateAsString = ($this->created_at !== null && $tmpDt = new DateTime($this->created_at)) ? $tmpDt->format('Y-m-d H:i:s') : null;
			$newDateAsString = $dt ? $dt->format('Y-m-d H:i:s') : null;
			if ($currentDateAsString !== $newDateAsString) {
				$this->created_at = $newDateAsString;
				$this->modifiedColumns[] = BookPeer::CREATED_AT;
			}
		} // if either are not null

		return $this;
	} // setCreatedAt()

	/**
	 * Sets the value of [updated_at] column to a normalized version of the date/time value specified.
	 * 
	 * @param      mixed $v string, integer (timestamp), or DateTime value.
	 *               Empty strings are treated as NULL.
	 * @return     Book The current object (for fluent API support)
	 */
	public function setUpdatedAt($v)
	{
		$dt = PropelDateTime::newInstance($v, null, 'DateTime');
		if ($this->updated_at !== null || $dt !== null) {
			$currentDateAsString = ($this->updated_at !== null && $tmpDt = new DateTime($this->updated_at)) ? $tmpDt->format('Y-m-d H:i:s') : null;
			$newDateAsString = $dt ? $dt->format('Y-m-d H:i:s') : null;
			if ($currentDateAsString !== $newDateAsString) {
				$this->updated_at = $newDateAsString;
				$this->modifiedColumns[] = BookPeer::UPDATED_AT;
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
			if ($this->title !== '') {
				return false;
			}

			if ($this->is_paperback !== false) {
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

			$this->isbn = ($row[$startcol + 0] !== null) ? (string) $row[$startcol + 0] : null;
			$this->title = ($row[$startcol + 1] !== null) ? (string) $row[$startcol + 1] : null;
			$this->author = ($row[$startcol + 2] !== null) ? (string) $row[$startcol + 2] : null;
			$this->publisher = ($row[$startcol + 3] !== null) ? (string) $row[$startcol + 3] : null;
			$this->edition = ($row[$startcol + 4] !== null) ? (string) $row[$startcol + 4] : null;
			$this->edition_num = ($row[$startcol + 5] !== null) ? (string) $row[$startcol + 5] : null;
			$this->pubdate = ($row[$startcol + 6] !== null) ? (string) $row[$startcol + 6] : null;
			$this->is_paperback = ($row[$startcol + 7] !== null) ? (boolean) $row[$startcol + 7] : null;
			$this->image_url = ($row[$startcol + 8] !== null) ? (string) $row[$startcol + 8] : null;
			$this->id = ($row[$startcol + 9] !== null) ? (int) $row[$startcol + 9] : null;
			$this->created_at = ($row[$startcol + 10] !== null) ? (string) $row[$startcol + 10] : null;
			$this->updated_at = ($row[$startcol + 11] !== null) ? (string) $row[$startcol + 11] : null;
			$this->resetModified();

			$this->setNew(false);

			if ($rehydrate) {
				$this->ensureConsistency();
			}

			return $startcol + 12; // 12 = BookPeer::NUM_HYDRATE_COLUMNS.

		} catch (Exception $e) {
			throw new PropelException("Error populating Book object", $e);
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
			$con = Propel::getConnection(BookPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		// We don't need to alter the object instance pool; we're just modifying this instance
		// already in the pool.

		$stmt = BookPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
		$row = $stmt->fetch(PDO::FETCH_NUM);
		$stmt->closeCursor();
		if (!$row) {
			throw new PropelException('Cannot find matching row in the database to reload object values.');
		}
		$this->hydrate($row, 0, true); // rehydrate

		if ($deep) {  // also de-associate any related objects?

			$this->collItems = null;

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
			$con = Propel::getConnection(BookPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		$con->beginTransaction();
		try {
			$deleteQuery = BookQuery::create()
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
			$con = Propel::getConnection(BookPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		$con->beginTransaction();
		$isInsert = $this->isNew();
		try {
			$ret = $this->preSave($con);
			if ($isInsert) {
				$ret = $ret && $this->preInsert($con);
				// timestampable behavior
				if (!$this->isColumnModified(BookPeer::CREATED_AT)) {
					$this->setCreatedAt(time());
				}
				if (!$this->isColumnModified(BookPeer::UPDATED_AT)) {
					$this->setUpdatedAt(time());
				}
			} else {
				$ret = $ret && $this->preUpdate($con);
				// timestampable behavior
				if ($this->isModified() && !$this->isColumnModified(BookPeer::UPDATED_AT)) {
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
				BookPeer::addInstanceToPool($this);
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

			if ($this->itemsScheduledForDeletion !== null) {
				if (!$this->itemsScheduledForDeletion->isEmpty()) {
					ItemQuery::create()
						->filterByPrimaryKeys($this->itemsScheduledForDeletion->getPrimaryKeys(false))
						->delete($con);
					$this->itemsScheduledForDeletion = null;
				}
			}

			if ($this->collItems !== null) {
				foreach ($this->collItems as $referrerFK) {
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

		$this->modifiedColumns[] = BookPeer::ID;
		if (null !== $this->id) {
			throw new PropelException('Cannot insert a value for auto-increment primary key (' . BookPeer::ID . ')');
		}

		 // check the columns in natural order for more readable SQL queries
		if ($this->isColumnModified(BookPeer::ISBN)) {
			$modifiedColumns[':p' . $index++]  = '`ISBN`';
		}
		if ($this->isColumnModified(BookPeer::TITLE)) {
			$modifiedColumns[':p' . $index++]  = '`TITLE`';
		}
		if ($this->isColumnModified(BookPeer::AUTHOR)) {
			$modifiedColumns[':p' . $index++]  = '`AUTHOR`';
		}
		if ($this->isColumnModified(BookPeer::PUBLISHER)) {
			$modifiedColumns[':p' . $index++]  = '`PUBLISHER`';
		}
		if ($this->isColumnModified(BookPeer::EDITION)) {
			$modifiedColumns[':p' . $index++]  = '`EDITION`';
		}
		if ($this->isColumnModified(BookPeer::EDITION_NUM)) {
			$modifiedColumns[':p' . $index++]  = '`EDITION_NUM`';
		}
		if ($this->isColumnModified(BookPeer::PUBDATE)) {
			$modifiedColumns[':p' . $index++]  = '`PUBDATE`';
		}
		if ($this->isColumnModified(BookPeer::IS_PAPERBACK)) {
			$modifiedColumns[':p' . $index++]  = '`IS_PAPERBACK`';
		}
		if ($this->isColumnModified(BookPeer::IMAGE_URL)) {
			$modifiedColumns[':p' . $index++]  = '`IMAGE_URL`';
		}
		if ($this->isColumnModified(BookPeer::ID)) {
			$modifiedColumns[':p' . $index++]  = '`ID`';
		}
		if ($this->isColumnModified(BookPeer::CREATED_AT)) {
			$modifiedColumns[':p' . $index++]  = '`CREATED_AT`';
		}
		if ($this->isColumnModified(BookPeer::UPDATED_AT)) {
			$modifiedColumns[':p' . $index++]  = '`UPDATED_AT`';
		}

		$sql = sprintf(
			'INSERT INTO `book` (%s) VALUES (%s)',
			implode(', ', $modifiedColumns),
			implode(', ', array_keys($modifiedColumns))
		);

		try {
			$stmt = $con->prepare($sql);
			foreach ($modifiedColumns as $identifier => $columnName) {
				switch ($columnName) {
					case '`ISBN`':
						$stmt->bindValue($identifier, $this->isbn, PDO::PARAM_STR);
						break;
					case '`TITLE`':
						$stmt->bindValue($identifier, $this->title, PDO::PARAM_STR);
						break;
					case '`AUTHOR`':
						$stmt->bindValue($identifier, $this->author, PDO::PARAM_STR);
						break;
					case '`PUBLISHER`':
						$stmt->bindValue($identifier, $this->publisher, PDO::PARAM_STR);
						break;
					case '`EDITION`':
						$stmt->bindValue($identifier, $this->edition, PDO::PARAM_STR);
						break;
					case '`EDITION_NUM`':
						$stmt->bindValue($identifier, $this->edition_num, PDO::PARAM_STR);
						break;
					case '`PUBDATE`':
						$stmt->bindValue($identifier, $this->pubdate, PDO::PARAM_STR);
						break;
					case '`IS_PAPERBACK`':
						$stmt->bindValue($identifier, (int) $this->is_paperback, PDO::PARAM_INT);
						break;
					case '`IMAGE_URL`':
						$stmt->bindValue($identifier, $this->image_url, PDO::PARAM_STR);
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


			if (($retval = BookPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collItems !== null) {
					foreach ($this->collItems as $referrerFK) {
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
		$pos = BookPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getIsbn();
				break;
			case 1:
				return $this->getTitle();
				break;
			case 2:
				return $this->getAuthor();
				break;
			case 3:
				return $this->getPublisher();
				break;
			case 4:
				return $this->getEdition();
				break;
			case 5:
				return $this->getEditionNum();
				break;
			case 6:
				return $this->getPubdate();
				break;
			case 7:
				return $this->getIsPaperback();
				break;
			case 8:
				return $this->getImageUrl();
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
		if (isset($alreadyDumpedObjects['Book'][$this->getPrimaryKey()])) {
			return '*RECURSION*';
		}
		$alreadyDumpedObjects['Book'][$this->getPrimaryKey()] = true;
		$keys = BookPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getIsbn(),
			$keys[1] => $this->getTitle(),
			$keys[2] => $this->getAuthor(),
			$keys[3] => $this->getPublisher(),
			$keys[4] => $this->getEdition(),
			$keys[5] => $this->getEditionNum(),
			$keys[6] => $this->getPubdate(),
			$keys[7] => $this->getIsPaperback(),
			$keys[8] => $this->getImageUrl(),
			$keys[9] => $this->getId(),
			$keys[10] => $this->getCreatedAt(),
			$keys[11] => $this->getUpdatedAt(),
		);
		if ($includeForeignObjects) {
			if (null !== $this->collItems) {
				$result['Items'] = $this->collItems->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
		$pos = BookPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setIsbn($value);
				break;
			case 1:
				$this->setTitle($value);
				break;
			case 2:
				$this->setAuthor($value);
				break;
			case 3:
				$this->setPublisher($value);
				break;
			case 4:
				$this->setEdition($value);
				break;
			case 5:
				$this->setEditionNum($value);
				break;
			case 6:
				$this->setPubdate($value);
				break;
			case 7:
				$this->setIsPaperback($value);
				break;
			case 8:
				$this->setImageUrl($value);
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
		$keys = BookPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setIsbn($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setTitle($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setAuthor($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setPublisher($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setEdition($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setEditionNum($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setPubdate($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setIsPaperback($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setImageUrl($arr[$keys[8]]);
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
		$criteria = new Criteria(BookPeer::DATABASE_NAME);

		if ($this->isColumnModified(BookPeer::ISBN)) $criteria->add(BookPeer::ISBN, $this->isbn);
		if ($this->isColumnModified(BookPeer::TITLE)) $criteria->add(BookPeer::TITLE, $this->title);
		if ($this->isColumnModified(BookPeer::AUTHOR)) $criteria->add(BookPeer::AUTHOR, $this->author);
		if ($this->isColumnModified(BookPeer::PUBLISHER)) $criteria->add(BookPeer::PUBLISHER, $this->publisher);
		if ($this->isColumnModified(BookPeer::EDITION)) $criteria->add(BookPeer::EDITION, $this->edition);
		if ($this->isColumnModified(BookPeer::EDITION_NUM)) $criteria->add(BookPeer::EDITION_NUM, $this->edition_num);
		if ($this->isColumnModified(BookPeer::PUBDATE)) $criteria->add(BookPeer::PUBDATE, $this->pubdate);
		if ($this->isColumnModified(BookPeer::IS_PAPERBACK)) $criteria->add(BookPeer::IS_PAPERBACK, $this->is_paperback);
		if ($this->isColumnModified(BookPeer::IMAGE_URL)) $criteria->add(BookPeer::IMAGE_URL, $this->image_url);
		if ($this->isColumnModified(BookPeer::ID)) $criteria->add(BookPeer::ID, $this->id);
		if ($this->isColumnModified(BookPeer::CREATED_AT)) $criteria->add(BookPeer::CREATED_AT, $this->created_at);
		if ($this->isColumnModified(BookPeer::UPDATED_AT)) $criteria->add(BookPeer::UPDATED_AT, $this->updated_at);

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
		$criteria = new Criteria(BookPeer::DATABASE_NAME);
		$criteria->add(BookPeer::ID, $this->id);

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
	 * @param      object $copyObj An object of Book (or compatible) type.
	 * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
	 * @param      boolean $makeNew Whether to reset autoincrement PKs and make the object new.
	 * @throws     PropelException
	 */
	public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
	{
		$copyObj->setIsbn($this->getIsbn());
		$copyObj->setTitle($this->getTitle());
		$copyObj->setAuthor($this->getAuthor());
		$copyObj->setPublisher($this->getPublisher());
		$copyObj->setEdition($this->getEdition());
		$copyObj->setEditionNum($this->getEditionNum());
		$copyObj->setPubdate($this->getPubdate());
		$copyObj->setIsPaperback($this->getIsPaperback());
		$copyObj->setImageUrl($this->getImageUrl());
		$copyObj->setCreatedAt($this->getCreatedAt());
		$copyObj->setUpdatedAt($this->getUpdatedAt());

		if ($deepCopy && !$this->startCopy) {
			// important: temporarily setNew(false) because this affects the behavior of
			// the getter/setter methods for fkey referrer objects.
			$copyObj->setNew(false);
			// store object hash to prevent cycle
			$this->startCopy = true;

			foreach ($this->getItems() as $relObj) {
				if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
					$copyObj->addItem($relObj->copy($deepCopy));
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
	 * @return     Book Clone of current object.
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
	 * @return     BookPeer
	 */
	public function getPeer()
	{
		if (self::$peer === null) {
			self::$peer = new BookPeer();
		}
		return self::$peer;
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
		if ('Item' == $relationName) {
			return $this->initItems();
		}
	}

	/**
	 * Clears out the collItems collection
	 *
	 * This does not modify the database; however, it will remove any associated objects, causing
	 * them to be refetched by subsequent calls to accessor method.
	 *
	 * @return     void
	 * @see        addItems()
	 */
	public function clearItems()
	{
		$this->collItems = null; // important to set this to NULL since that means it is uninitialized
	}

	/**
	 * Initializes the collItems collection.
	 *
	 * By default this just sets the collItems collection to an empty array (like clearcollItems());
	 * however, you may wish to override this method in your stub class to provide setting appropriate
	 * to your application -- for example, setting the initial array to the values stored in database.
	 *
	 * @param      boolean $overrideExisting If set to true, the method call initializes
	 *                                        the collection even if it is not empty
	 *
	 * @return     void
	 */
	public function initItems($overrideExisting = true)
	{
		if (null !== $this->collItems && !$overrideExisting) {
			return;
		}
		$this->collItems = new PropelObjectCollection();
		$this->collItems->setModel('Item');
	}

	/**
	 * Gets an array of Item objects which contain a foreign key that references this object.
	 *
	 * If the $criteria is not null, it is used to always fetch the results from the database.
	 * Otherwise the results are fetched from the database the first time, then cached.
	 * Next time the same method is called without $criteria, the cached collection is returned.
	 * If this Book is new, it will return
	 * an empty collection or the current collection; the criteria is ignored on a new object.
	 *
	 * @param      Criteria $criteria optional Criteria object to narrow the query
	 * @param      PropelPDO $con optional connection object
	 * @return     PropelCollection|array Item[] List of Item objects
	 * @throws     PropelException
	 */
	public function getItems($criteria = null, PropelPDO $con = null)
	{
		if(null === $this->collItems || null !== $criteria) {
			if ($this->isNew() && null === $this->collItems) {
				// return empty collection
				$this->initItems();
			} else {
				$collItems = ItemQuery::create(null, $criteria)
					->filterByBook($this)
					->find($con);
				if (null !== $criteria) {
					return $collItems;
				}
				$this->collItems = $collItems;
			}
		}
		return $this->collItems;
	}

	/**
	 * Sets a collection of Item objects related by a one-to-many relationship
	 * to the current object.
	 * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
	 * and new objects from the given Propel collection.
	 *
	 * @param      PropelCollection $items A Propel collection.
	 * @param      PropelPDO $con Optional connection object
	 */
	public function setItems(PropelCollection $items, PropelPDO $con = null)
	{
		$this->itemsScheduledForDeletion = $this->getItems(new Criteria(), $con)->diff($items);

		foreach ($items as $item) {
			// Fix issue with collection modified by reference
			if ($item->isNew()) {
				$item->setBook($this);
			}
			$this->addItem($item);
		}

		$this->collItems = $items;
	}

	/**
	 * Returns the number of related Item objects.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      PropelPDO $con
	 * @return     int Count of related Item objects.
	 * @throws     PropelException
	 */
	public function countItems(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if(null === $this->collItems || null !== $criteria) {
			if ($this->isNew() && null === $this->collItems) {
				return 0;
			} else {
				$query = ItemQuery::create(null, $criteria);
				if($distinct) {
					$query->distinct();
				}
				return $query
					->filterByBook($this)
					->count($con);
			}
		} else {
			return count($this->collItems);
		}
	}

	/**
	 * Method called to associate a Item object to this object
	 * through the Item foreign key attribute.
	 *
	 * @param      Item $l Item
	 * @return     Book The current object (for fluent API support)
	 */
	public function addItem(Item $l)
	{
		if ($this->collItems === null) {
			$this->initItems();
		}
		if (!$this->collItems->contains($l)) { // only add it if the **same** object is not already associated
			$this->doAddItem($l);
		}

		return $this;
	}

	/**
	 * @param	Item $item The item object to add.
	 */
	protected function doAddItem($item)
	{
		$this->collItems[]= $item;
		$item->setBook($this);
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Book is new, it will return
	 * an empty collection; or if this Book has previously
	 * been saved, it will retrieve related Items from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Book.
	 *
	 * @param      Criteria $criteria optional Criteria object to narrow the query
	 * @param      PropelPDO $con optional connection object
	 * @param      string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
	 * @return     PropelCollection|array Item[] List of Item objects
	 */
	public function getItemsJoinItemRelatedByPackageId($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		$query = ItemQuery::create(null, $criteria);
		$query->joinWith('ItemRelatedByPackageId', $join_behavior);

		return $this->getItems($query, $con);
	}

	/**
	 * Clears the current object and sets all attributes to their default values
	 */
	public function clear()
	{
		$this->isbn = null;
		$this->title = null;
		$this->author = null;
		$this->publisher = null;
		$this->edition = null;
		$this->edition_num = null;
		$this->pubdate = null;
		$this->is_paperback = null;
		$this->image_url = null;
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
			if ($this->collItems) {
				foreach ($this->collItems as $o) {
					$o->clearAllReferences($deep);
				}
			}
		} // if ($deep)

		if ($this->collItems instanceof PropelCollection) {
			$this->collItems->clearIterator();
		}
		$this->collItems = null;
	}

	/**
	 * Return the string representation of this object
	 *
	 * @return string
	 */
	public function __toString()
	{
		return (string) $this->exportTo(BookPeer::DEFAULT_STRING_FORMAT);
	}

	// timestampable behavior
	
	/**
	 * Mark the current object so that the update date doesn't get updated during next save
	 *
	 * @return     Book The current object (for fluent API support)
	 */
	public function keepUpdateDateUnchanged()
	{
		$this->modifiedColumns[] = BookPeer::UPDATED_AT;
		return $this;
	}

} // BaseBook
