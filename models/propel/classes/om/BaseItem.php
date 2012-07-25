<?php


/**
 * Base class that represents a row from the 'item' table.
 *
 * 
 *
 * @package    propel.generator..om
 */
abstract class BaseItem extends Spiderable  implements Persistent
{

	/**
	 * Peer class name
	 */
	const PEER = 'ItemPeer';

	/**
	 * The Peer class.
	 * Instance provides a convenient way of calling static methods on a class
	 * that calling code may not be able to identify.
	 * @var        ItemPeer
	 */
	protected static $peer;

	/**
	 * The flag var to prevent infinit loop in deep copy
	 * @var       boolean
	 */
	protected $startCopy = false;

	/**
	 * The value for the id field.
	 * @var        int
	 */
	protected $id;

	/**
	 * The value for the isbn field.
	 * @var        string
	 */
	protected $isbn;

	/**
	 * The value for the package_id field.
	 * @var        int
	 */
	protected $package_id;

	/**
	 * The value for the is_package field.
	 * Note: this column has a database default value of: false
	 * @var        boolean
	 */
	protected $is_package;

	/**
	 * The value for the title field.
	 * @var        string
	 */
	protected $title;

	/**
	 * The value for the author field.
	 * @var        string
	 */
	protected $author;

	/**
	 * The value for the edition field.
	 * @var        string
	 */
	protected $edition;

	/**
	 * The value for the publisher field.
	 * @var        string
	 */
	protected $publisher;

	/**
	 * The value for the b_new field.
	 * @var        string
	 */
	protected $b_new;

	/**
	 * The value for the b_used field.
	 * @var        string
	 */
	protected $b_used;

	/**
	 * The value for the b_ebook field.
	 * @var        string
	 */
	protected $b_ebook;

	/**
	 * The value for the image_url field.
	 * @var        string
	 */
	protected $image_url;

	/**
	 * The value for the product_id field.
	 * @var        string
	 */
	protected $product_id;

	/**
	 * The value for the part_number field.
	 * @var        string
	 */
	protected $part_number;

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
	 * @var        Book
	 */
	protected $aBook;

	/**
	 * @var        Item
	 */
	protected $aItemRelatedByPackageId;

	/**
	 * @var        array Item[] Collection to store aggregation of Item objects.
	 */
	protected $collItemsRelatedById;

	/**
	 * @var        array SectionHasItem[] Collection to store aggregation of SectionHasItem objects.
	 */
	protected $collSectionHasItems;

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
	 * An array of objects scheduled for deletion.
	 * @var		array
	 */
	protected $itemsRelatedByIdScheduledForDeletion = null;

	/**
	 * An array of objects scheduled for deletion.
	 * @var		array
	 */
	protected $sectionHasItemsScheduledForDeletion = null;

	/**
	 * Applies default values to this object.
	 * This method should be called from the object's constructor (or
	 * equivalent initialization method).
	 * @see        __construct()
	 */
	public function applyDefaultValues()
	{
		$this->is_package = false;
	}

	/**
	 * Initializes internal state of BaseItem object.
	 * @see        applyDefaults()
	 */
	public function __construct()
	{
		parent::__construct();
		$this->applyDefaultValues();
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
	 * Get the [isbn] column value.
	 * 
	 * @return     string
	 */
	public function getIsbn()
	{
		return $this->isbn;
	}

	/**
	 * Get the [package_id] column value.
	 * 
	 * @return     int
	 */
	public function getPackageId()
	{
		return $this->package_id;
	}

	/**
	 * Get the [is_package] column value.
	 * 
	 * @return     boolean
	 */
	public function getIsPackage()
	{
		return $this->is_package;
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
	 * Get the [edition] column value.
	 * 
	 * @return     string
	 */
	public function getEdition()
	{
		return $this->edition;
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
	 * Get the [b_new] column value.
	 * 
	 * @return     string
	 */
	public function getBNew()
	{
		return $this->b_new;
	}

	/**
	 * Get the [b_used] column value.
	 * 
	 * @return     string
	 */
	public function getBUsed()
	{
		return $this->b_used;
	}

	/**
	 * Get the [b_ebook] column value.
	 * 
	 * @return     string
	 */
	public function getBEbook()
	{
		return $this->b_ebook;
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
	 * Get the [product_id] column value.
	 * 
	 * @return     string
	 */
	public function getProductId()
	{
		return $this->product_id;
	}

	/**
	 * Get the [part_number] column value.
	 * 
	 * @return     string
	 */
	public function getPartNumber()
	{
		return $this->part_number;
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
	 * Set the value of [id] column.
	 * 
	 * @param      int $v new value
	 * @return     Item The current object (for fluent API support)
	 */
	public function setId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = ItemPeer::ID;
		}

		return $this;
	} // setId()

	/**
	 * Set the value of [isbn] column.
	 * 
	 * @param      string $v new value
	 * @return     Item The current object (for fluent API support)
	 */
	public function setIsbn($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->isbn !== $v) {
			$this->isbn = $v;
			$this->modifiedColumns[] = ItemPeer::ISBN;
		}

		if ($this->aBook !== null && $this->aBook->getIsbn() !== $v) {
			$this->aBook = null;
		}

		return $this;
	} // setIsbn()

	/**
	 * Set the value of [package_id] column.
	 * 
	 * @param      int $v new value
	 * @return     Item The current object (for fluent API support)
	 */
	public function setPackageId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->package_id !== $v) {
			$this->package_id = $v;
			$this->modifiedColumns[] = ItemPeer::PACKAGE_ID;
		}

		if ($this->aItemRelatedByPackageId !== null && $this->aItemRelatedByPackageId->getId() !== $v) {
			$this->aItemRelatedByPackageId = null;
		}

		return $this;
	} // setPackageId()

	/**
	 * Sets the value of the [is_package] column.
	 * Non-boolean arguments are converted using the following rules:
	 *   * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
	 *   * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
	 * Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
	 * 
	 * @param      boolean|integer|string $v The new value
	 * @return     Item The current object (for fluent API support)
	 */
	public function setIsPackage($v)
	{
		if ($v !== null) {
			if (is_string($v)) {
				$v = in_array(strtolower($v), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
			} else {
				$v = (boolean) $v;
			}
		}

		if ($this->is_package !== $v) {
			$this->is_package = $v;
			$this->modifiedColumns[] = ItemPeer::IS_PACKAGE;
		}

		return $this;
	} // setIsPackage()

	/**
	 * Set the value of [title] column.
	 * 
	 * @param      string $v new value
	 * @return     Item The current object (for fluent API support)
	 */
	public function setTitle($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->title !== $v) {
			$this->title = $v;
			$this->modifiedColumns[] = ItemPeer::TITLE;
		}

		return $this;
	} // setTitle()

	/**
	 * Set the value of [author] column.
	 * 
	 * @param      string $v new value
	 * @return     Item The current object (for fluent API support)
	 */
	public function setAuthor($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->author !== $v) {
			$this->author = $v;
			$this->modifiedColumns[] = ItemPeer::AUTHOR;
		}

		return $this;
	} // setAuthor()

	/**
	 * Set the value of [edition] column.
	 * 
	 * @param      string $v new value
	 * @return     Item The current object (for fluent API support)
	 */
	public function setEdition($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->edition !== $v) {
			$this->edition = $v;
			$this->modifiedColumns[] = ItemPeer::EDITION;
		}

		return $this;
	} // setEdition()

	/**
	 * Set the value of [publisher] column.
	 * 
	 * @param      string $v new value
	 * @return     Item The current object (for fluent API support)
	 */
	public function setPublisher($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->publisher !== $v) {
			$this->publisher = $v;
			$this->modifiedColumns[] = ItemPeer::PUBLISHER;
		}

		return $this;
	} // setPublisher()

	/**
	 * Set the value of [b_new] column.
	 * 
	 * @param      string $v new value
	 * @return     Item The current object (for fluent API support)
	 */
	public function setBNew($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->b_new !== $v) {
			$this->b_new = $v;
			$this->modifiedColumns[] = ItemPeer::B_NEW;
		}

		return $this;
	} // setBNew()

	/**
	 * Set the value of [b_used] column.
	 * 
	 * @param      string $v new value
	 * @return     Item The current object (for fluent API support)
	 */
	public function setBUsed($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->b_used !== $v) {
			$this->b_used = $v;
			$this->modifiedColumns[] = ItemPeer::B_USED;
		}

		return $this;
	} // setBUsed()

	/**
	 * Set the value of [b_ebook] column.
	 * 
	 * @param      string $v new value
	 * @return     Item The current object (for fluent API support)
	 */
	public function setBEbook($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->b_ebook !== $v) {
			$this->b_ebook = $v;
			$this->modifiedColumns[] = ItemPeer::B_EBOOK;
		}

		return $this;
	} // setBEbook()

	/**
	 * Set the value of [image_url] column.
	 * 
	 * @param      string $v new value
	 * @return     Item The current object (for fluent API support)
	 */
	public function setImageUrl($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->image_url !== $v) {
			$this->image_url = $v;
			$this->modifiedColumns[] = ItemPeer::IMAGE_URL;
		}

		return $this;
	} // setImageUrl()

	/**
	 * Set the value of [product_id] column.
	 * 
	 * @param      string $v new value
	 * @return     Item The current object (for fluent API support)
	 */
	public function setProductId($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->product_id !== $v) {
			$this->product_id = $v;
			$this->modifiedColumns[] = ItemPeer::PRODUCT_ID;
		}

		return $this;
	} // setProductId()

	/**
	 * Set the value of [part_number] column.
	 * 
	 * @param      string $v new value
	 * @return     Item The current object (for fluent API support)
	 */
	public function setPartNumber($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->part_number !== $v) {
			$this->part_number = $v;
			$this->modifiedColumns[] = ItemPeer::PART_NUMBER;
		}

		return $this;
	} // setPartNumber()

	/**
	 * Sets the value of [spidered_at] column to a normalized version of the date/time value specified.
	 * 
	 * @param      mixed $v string, integer (timestamp), or DateTime value.
	 *               Empty strings are treated as NULL.
	 * @return     Item The current object (for fluent API support)
	 */
	public function setSpideredAt($v)
	{
		$dt = PropelDateTime::newInstance($v, null, 'DateTime');
		if ($this->spidered_at !== null || $dt !== null) {
			$currentDateAsString = ($this->spidered_at !== null && $tmpDt = new DateTime($this->spidered_at)) ? $tmpDt->format('Y-m-d H:i:s') : null;
			$newDateAsString = $dt ? $dt->format('Y-m-d H:i:s') : null;
			if ($currentDateAsString !== $newDateAsString) {
				$this->spidered_at = $newDateAsString;
				$this->modifiedColumns[] = ItemPeer::SPIDERED_AT;
			}
		} // if either are not null

		return $this;
	} // setSpideredAt()

	/**
	 * Sets the value of [shallow_spidered_at] column to a normalized version of the date/time value specified.
	 * 
	 * @param      mixed $v string, integer (timestamp), or DateTime value.
	 *               Empty strings are treated as NULL.
	 * @return     Item The current object (for fluent API support)
	 */
	public function setShallowSpideredAt($v)
	{
		$dt = PropelDateTime::newInstance($v, null, 'DateTime');
		if ($this->shallow_spidered_at !== null || $dt !== null) {
			$currentDateAsString = ($this->shallow_spidered_at !== null && $tmpDt = new DateTime($this->shallow_spidered_at)) ? $tmpDt->format('Y-m-d H:i:s') : null;
			$newDateAsString = $dt ? $dt->format('Y-m-d H:i:s') : null;
			if ($currentDateAsString !== $newDateAsString) {
				$this->shallow_spidered_at = $newDateAsString;
				$this->modifiedColumns[] = ItemPeer::SHALLOW_SPIDERED_AT;
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
	 * @return     Item The current object (for fluent API support)
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
			$this->modifiedColumns[] = ItemPeer::TOUCHED;
		}

		return $this;
	} // setTouched()

	/**
	 * Set the value of [b_id] column.
	 * 
	 * @param      string $v new value
	 * @return     Item The current object (for fluent API support)
	 */
	public function setBId($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->b_id !== $v) {
			$this->b_id = $v;
			$this->modifiedColumns[] = ItemPeer::B_ID;
		}

		return $this;
	} // setBId()

	/**
	 * Set the value of [bookstore_type] column.
	 * 
	 * @param      string $v new value
	 * @return     Item The current object (for fluent API support)
	 */
	public function setBookstoreType($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->bookstore_type !== $v) {
			$this->bookstore_type = $v;
			$this->modifiedColumns[] = ItemPeer::BOOKSTORE_TYPE;
		}

		return $this;
	} // setBookstoreType()

	/**
	 * Sets the value of [created_at] column to a normalized version of the date/time value specified.
	 * 
	 * @param      mixed $v string, integer (timestamp), or DateTime value.
	 *               Empty strings are treated as NULL.
	 * @return     Item The current object (for fluent API support)
	 */
	public function setCreatedAt($v)
	{
		$dt = PropelDateTime::newInstance($v, null, 'DateTime');
		if ($this->created_at !== null || $dt !== null) {
			$currentDateAsString = ($this->created_at !== null && $tmpDt = new DateTime($this->created_at)) ? $tmpDt->format('Y-m-d H:i:s') : null;
			$newDateAsString = $dt ? $dt->format('Y-m-d H:i:s') : null;
			if ($currentDateAsString !== $newDateAsString) {
				$this->created_at = $newDateAsString;
				$this->modifiedColumns[] = ItemPeer::CREATED_AT;
			}
		} // if either are not null

		return $this;
	} // setCreatedAt()

	/**
	 * Sets the value of [updated_at] column to a normalized version of the date/time value specified.
	 * 
	 * @param      mixed $v string, integer (timestamp), or DateTime value.
	 *               Empty strings are treated as NULL.
	 * @return     Item The current object (for fluent API support)
	 */
	public function setUpdatedAt($v)
	{
		$dt = PropelDateTime::newInstance($v, null, 'DateTime');
		if ($this->updated_at !== null || $dt !== null) {
			$currentDateAsString = ($this->updated_at !== null && $tmpDt = new DateTime($this->updated_at)) ? $tmpDt->format('Y-m-d H:i:s') : null;
			$newDateAsString = $dt ? $dt->format('Y-m-d H:i:s') : null;
			if ($currentDateAsString !== $newDateAsString) {
				$this->updated_at = $newDateAsString;
				$this->modifiedColumns[] = ItemPeer::UPDATED_AT;
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
			if ($this->is_package !== false) {
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

			$this->id = ($row[$startcol + 0] !== null) ? (int) $row[$startcol + 0] : null;
			$this->isbn = ($row[$startcol + 1] !== null) ? (string) $row[$startcol + 1] : null;
			$this->package_id = ($row[$startcol + 2] !== null) ? (int) $row[$startcol + 2] : null;
			$this->is_package = ($row[$startcol + 3] !== null) ? (boolean) $row[$startcol + 3] : null;
			$this->title = ($row[$startcol + 4] !== null) ? (string) $row[$startcol + 4] : null;
			$this->author = ($row[$startcol + 5] !== null) ? (string) $row[$startcol + 5] : null;
			$this->edition = ($row[$startcol + 6] !== null) ? (string) $row[$startcol + 6] : null;
			$this->publisher = ($row[$startcol + 7] !== null) ? (string) $row[$startcol + 7] : null;
			$this->b_new = ($row[$startcol + 8] !== null) ? (string) $row[$startcol + 8] : null;
			$this->b_used = ($row[$startcol + 9] !== null) ? (string) $row[$startcol + 9] : null;
			$this->b_ebook = ($row[$startcol + 10] !== null) ? (string) $row[$startcol + 10] : null;
			$this->image_url = ($row[$startcol + 11] !== null) ? (string) $row[$startcol + 11] : null;
			$this->product_id = ($row[$startcol + 12] !== null) ? (string) $row[$startcol + 12] : null;
			$this->part_number = ($row[$startcol + 13] !== null) ? (string) $row[$startcol + 13] : null;
			$this->spidered_at = ($row[$startcol + 14] !== null) ? (string) $row[$startcol + 14] : null;
			$this->shallow_spidered_at = ($row[$startcol + 15] !== null) ? (string) $row[$startcol + 15] : null;
			$this->touched = ($row[$startcol + 16] !== null) ? (boolean) $row[$startcol + 16] : null;
			$this->b_id = ($row[$startcol + 17] !== null) ? (string) $row[$startcol + 17] : null;
			$this->bookstore_type = ($row[$startcol + 18] !== null) ? (string) $row[$startcol + 18] : null;
			$this->created_at = ($row[$startcol + 19] !== null) ? (string) $row[$startcol + 19] : null;
			$this->updated_at = ($row[$startcol + 20] !== null) ? (string) $row[$startcol + 20] : null;
			$this->resetModified();

			$this->setNew(false);

			if ($rehydrate) {
				$this->ensureConsistency();
			}

			return $startcol + 21; // 21 = ItemPeer::NUM_HYDRATE_COLUMNS.

		} catch (Exception $e) {
			throw new PropelException("Error populating Item object", $e);
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

		if ($this->aBook !== null && $this->isbn !== $this->aBook->getIsbn()) {
			$this->aBook = null;
		}
		if ($this->aItemRelatedByPackageId !== null && $this->package_id !== $this->aItemRelatedByPackageId->getId()) {
			$this->aItemRelatedByPackageId = null;
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
			$con = Propel::getConnection(ItemPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		// We don't need to alter the object instance pool; we're just modifying this instance
		// already in the pool.

		$stmt = ItemPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
		$row = $stmt->fetch(PDO::FETCH_NUM);
		$stmt->closeCursor();
		if (!$row) {
			throw new PropelException('Cannot find matching row in the database to reload object values.');
		}
		$this->hydrate($row, 0, true); // rehydrate

		if ($deep) {  // also de-associate any related objects?

			$this->aBook = null;
			$this->aItemRelatedByPackageId = null;
			$this->collItemsRelatedById = null;

			$this->collSectionHasItems = null;

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
			$con = Propel::getConnection(ItemPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		$con->beginTransaction();
		try {
			$deleteQuery = ItemQuery::create()
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
			$con = Propel::getConnection(ItemPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		$con->beginTransaction();
		$isInsert = $this->isNew();
		try {
			$ret = $this->preSave($con);
			if ($isInsert) {
				$ret = $ret && $this->preInsert($con);
				// spiderable behavior
				if (!$this->isColumnModified(ItemPeer::SPIDERED_AT)) {
				            $this->setSpideredAt(NULL);
				    }
				// timestampable behavior
				if (!$this->isColumnModified(ItemPeer::CREATED_AT)) {
					$this->setCreatedAt(time());
				}
				if (!$this->isColumnModified(ItemPeer::UPDATED_AT)) {
					$this->setUpdatedAt(time());
				}
			} else {
				$ret = $ret && $this->preUpdate($con);
				// timestampable behavior
				if ($this->isModified() && !$this->isColumnModified(ItemPeer::UPDATED_AT)) {
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
				ItemPeer::addInstanceToPool($this);
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

			if ($this->aBook !== null) {
				if ($this->aBook->isModified() || $this->aBook->isNew()) {
					$affectedRows += $this->aBook->save($con);
				}
				$this->setBook($this->aBook);
			}

			if ($this->aItemRelatedByPackageId !== null) {
				if ($this->aItemRelatedByPackageId->isModified() || $this->aItemRelatedByPackageId->isNew()) {
					$affectedRows += $this->aItemRelatedByPackageId->save($con);
				}
				$this->setItemRelatedByPackageId($this->aItemRelatedByPackageId);
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
					SectionHasItemQuery::create()
						->filterByPrimaryKeys($this->sectionsScheduledForDeletion->getPrimaryKeys(false))
						->delete($con);
					$this->sectionsScheduledForDeletion = null;
				}

				foreach ($this->getSections() as $section) {
					if ($section->isModified()) {
						$section->save($con);
					}
				}
			}

			if ($this->itemsRelatedByIdScheduledForDeletion !== null) {
				if (!$this->itemsRelatedByIdScheduledForDeletion->isEmpty()) {
					ItemQuery::create()
						->filterByPrimaryKeys($this->itemsRelatedByIdScheduledForDeletion->getPrimaryKeys(false))
						->delete($con);
					$this->itemsRelatedByIdScheduledForDeletion = null;
				}
			}

			if ($this->collItemsRelatedById !== null) {
				foreach ($this->collItemsRelatedById as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->sectionHasItemsScheduledForDeletion !== null) {
				if (!$this->sectionHasItemsScheduledForDeletion->isEmpty()) {
					SectionHasItemQuery::create()
						->filterByPrimaryKeys($this->sectionHasItemsScheduledForDeletion->getPrimaryKeys(false))
						->delete($con);
					$this->sectionHasItemsScheduledForDeletion = null;
				}
			}

			if ($this->collSectionHasItems !== null) {
				foreach ($this->collSectionHasItems as $referrerFK) {
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

		$this->modifiedColumns[] = ItemPeer::ID;
		if (null !== $this->id) {
			throw new PropelException('Cannot insert a value for auto-increment primary key (' . ItemPeer::ID . ')');
		}

		 // check the columns in natural order for more readable SQL queries
		if ($this->isColumnModified(ItemPeer::ID)) {
			$modifiedColumns[':p' . $index++]  = '`ID`';
		}
		if ($this->isColumnModified(ItemPeer::ISBN)) {
			$modifiedColumns[':p' . $index++]  = '`ISBN`';
		}
		if ($this->isColumnModified(ItemPeer::PACKAGE_ID)) {
			$modifiedColumns[':p' . $index++]  = '`PACKAGE_ID`';
		}
		if ($this->isColumnModified(ItemPeer::IS_PACKAGE)) {
			$modifiedColumns[':p' . $index++]  = '`IS_PACKAGE`';
		}
		if ($this->isColumnModified(ItemPeer::TITLE)) {
			$modifiedColumns[':p' . $index++]  = '`TITLE`';
		}
		if ($this->isColumnModified(ItemPeer::AUTHOR)) {
			$modifiedColumns[':p' . $index++]  = '`AUTHOR`';
		}
		if ($this->isColumnModified(ItemPeer::EDITION)) {
			$modifiedColumns[':p' . $index++]  = '`EDITION`';
		}
		if ($this->isColumnModified(ItemPeer::PUBLISHER)) {
			$modifiedColumns[':p' . $index++]  = '`PUBLISHER`';
		}
		if ($this->isColumnModified(ItemPeer::B_NEW)) {
			$modifiedColumns[':p' . $index++]  = '`B_NEW`';
		}
		if ($this->isColumnModified(ItemPeer::B_USED)) {
			$modifiedColumns[':p' . $index++]  = '`B_USED`';
		}
		if ($this->isColumnModified(ItemPeer::B_EBOOK)) {
			$modifiedColumns[':p' . $index++]  = '`B_EBOOK`';
		}
		if ($this->isColumnModified(ItemPeer::IMAGE_URL)) {
			$modifiedColumns[':p' . $index++]  = '`IMAGE_URL`';
		}
		if ($this->isColumnModified(ItemPeer::PRODUCT_ID)) {
			$modifiedColumns[':p' . $index++]  = '`PRODUCT_ID`';
		}
		if ($this->isColumnModified(ItemPeer::PART_NUMBER)) {
			$modifiedColumns[':p' . $index++]  = '`PART_NUMBER`';
		}
		if ($this->isColumnModified(ItemPeer::SPIDERED_AT)) {
			$modifiedColumns[':p' . $index++]  = '`SPIDERED_AT`';
		}
		if ($this->isColumnModified(ItemPeer::SHALLOW_SPIDERED_AT)) {
			$modifiedColumns[':p' . $index++]  = '`SHALLOW_SPIDERED_AT`';
		}
		if ($this->isColumnModified(ItemPeer::TOUCHED)) {
			$modifiedColumns[':p' . $index++]  = '`TOUCHED`';
		}
		if ($this->isColumnModified(ItemPeer::B_ID)) {
			$modifiedColumns[':p' . $index++]  = '`B_ID`';
		}
		if ($this->isColumnModified(ItemPeer::BOOKSTORE_TYPE)) {
			$modifiedColumns[':p' . $index++]  = '`BOOKSTORE_TYPE`';
		}
		if ($this->isColumnModified(ItemPeer::CREATED_AT)) {
			$modifiedColumns[':p' . $index++]  = '`CREATED_AT`';
		}
		if ($this->isColumnModified(ItemPeer::UPDATED_AT)) {
			$modifiedColumns[':p' . $index++]  = '`UPDATED_AT`';
		}

		$sql = sprintf(
			'INSERT INTO `item` (%s) VALUES (%s)',
			implode(', ', $modifiedColumns),
			implode(', ', array_keys($modifiedColumns))
		);

		try {
			$stmt = $con->prepare($sql);
			foreach ($modifiedColumns as $identifier => $columnName) {
				switch ($columnName) {
					case '`ID`':
						$stmt->bindValue($identifier, $this->id, PDO::PARAM_INT);
						break;
					case '`ISBN`':
						$stmt->bindValue($identifier, $this->isbn, PDO::PARAM_STR);
						break;
					case '`PACKAGE_ID`':
						$stmt->bindValue($identifier, $this->package_id, PDO::PARAM_INT);
						break;
					case '`IS_PACKAGE`':
						$stmt->bindValue($identifier, (int) $this->is_package, PDO::PARAM_INT);
						break;
					case '`TITLE`':
						$stmt->bindValue($identifier, $this->title, PDO::PARAM_STR);
						break;
					case '`AUTHOR`':
						$stmt->bindValue($identifier, $this->author, PDO::PARAM_STR);
						break;
					case '`EDITION`':
						$stmt->bindValue($identifier, $this->edition, PDO::PARAM_STR);
						break;
					case '`PUBLISHER`':
						$stmt->bindValue($identifier, $this->publisher, PDO::PARAM_STR);
						break;
					case '`B_NEW`':
						$stmt->bindValue($identifier, $this->b_new, PDO::PARAM_STR);
						break;
					case '`B_USED`':
						$stmt->bindValue($identifier, $this->b_used, PDO::PARAM_STR);
						break;
					case '`B_EBOOK`':
						$stmt->bindValue($identifier, $this->b_ebook, PDO::PARAM_STR);
						break;
					case '`IMAGE_URL`':
						$stmt->bindValue($identifier, $this->image_url, PDO::PARAM_STR);
						break;
					case '`PRODUCT_ID`':
						$stmt->bindValue($identifier, $this->product_id, PDO::PARAM_STR);
						break;
					case '`PART_NUMBER`':
						$stmt->bindValue($identifier, $this->part_number, PDO::PARAM_STR);
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

			if ($this->aBook !== null) {
				if (!$this->aBook->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aBook->getValidationFailures());
				}
			}

			if ($this->aItemRelatedByPackageId !== null) {
				if (!$this->aItemRelatedByPackageId->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aItemRelatedByPackageId->getValidationFailures());
				}
			}


			if (($retval = ItemPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collItemsRelatedById !== null) {
					foreach ($this->collItemsRelatedById as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collSectionHasItems !== null) {
					foreach ($this->collSectionHasItems as $referrerFK) {
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
		$pos = ItemPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				return $this->getId();
				break;
			case 1:
				return $this->getIsbn();
				break;
			case 2:
				return $this->getPackageId();
				break;
			case 3:
				return $this->getIsPackage();
				break;
			case 4:
				return $this->getTitle();
				break;
			case 5:
				return $this->getAuthor();
				break;
			case 6:
				return $this->getEdition();
				break;
			case 7:
				return $this->getPublisher();
				break;
			case 8:
				return $this->getBNew();
				break;
			case 9:
				return $this->getBUsed();
				break;
			case 10:
				return $this->getBEbook();
				break;
			case 11:
				return $this->getImageUrl();
				break;
			case 12:
				return $this->getProductId();
				break;
			case 13:
				return $this->getPartNumber();
				break;
			case 14:
				return $this->getSpideredAt();
				break;
			case 15:
				return $this->getShallowSpideredAt();
				break;
			case 16:
				return $this->getTouched();
				break;
			case 17:
				return $this->getBId();
				break;
			case 18:
				return $this->getBookstoreType();
				break;
			case 19:
				return $this->getCreatedAt();
				break;
			case 20:
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
		if (isset($alreadyDumpedObjects['Item'][$this->getPrimaryKey()])) {
			return '*RECURSION*';
		}
		$alreadyDumpedObjects['Item'][$this->getPrimaryKey()] = true;
		$keys = ItemPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getIsbn(),
			$keys[2] => $this->getPackageId(),
			$keys[3] => $this->getIsPackage(),
			$keys[4] => $this->getTitle(),
			$keys[5] => $this->getAuthor(),
			$keys[6] => $this->getEdition(),
			$keys[7] => $this->getPublisher(),
			$keys[8] => $this->getBNew(),
			$keys[9] => $this->getBUsed(),
			$keys[10] => $this->getBEbook(),
			$keys[11] => $this->getImageUrl(),
			$keys[12] => $this->getProductId(),
			$keys[13] => $this->getPartNumber(),
			$keys[14] => $this->getSpideredAt(),
			$keys[15] => $this->getShallowSpideredAt(),
			$keys[16] => $this->getTouched(),
			$keys[17] => $this->getBId(),
			$keys[18] => $this->getBookstoreType(),
			$keys[19] => $this->getCreatedAt(),
			$keys[20] => $this->getUpdatedAt(),
		);
		if ($includeForeignObjects) {
			if (null !== $this->aBook) {
				$result['Book'] = $this->aBook->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
			}
			if (null !== $this->aItemRelatedByPackageId) {
				$result['ItemRelatedByPackageId'] = $this->aItemRelatedByPackageId->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
			}
			if (null !== $this->collItemsRelatedById) {
				$result['ItemsRelatedById'] = $this->collItemsRelatedById->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
			}
			if (null !== $this->collSectionHasItems) {
				$result['SectionHasItems'] = $this->collSectionHasItems->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
		$pos = ItemPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
				$this->setId($value);
				break;
			case 1:
				$this->setIsbn($value);
				break;
			case 2:
				$this->setPackageId($value);
				break;
			case 3:
				$this->setIsPackage($value);
				break;
			case 4:
				$this->setTitle($value);
				break;
			case 5:
				$this->setAuthor($value);
				break;
			case 6:
				$this->setEdition($value);
				break;
			case 7:
				$this->setPublisher($value);
				break;
			case 8:
				$this->setBNew($value);
				break;
			case 9:
				$this->setBUsed($value);
				break;
			case 10:
				$this->setBEbook($value);
				break;
			case 11:
				$this->setImageUrl($value);
				break;
			case 12:
				$this->setProductId($value);
				break;
			case 13:
				$this->setPartNumber($value);
				break;
			case 14:
				$this->setSpideredAt($value);
				break;
			case 15:
				$this->setShallowSpideredAt($value);
				break;
			case 16:
				$this->setTouched($value);
				break;
			case 17:
				$this->setBId($value);
				break;
			case 18:
				$this->setBookstoreType($value);
				break;
			case 19:
				$this->setCreatedAt($value);
				break;
			case 20:
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
		$keys = ItemPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setIsbn($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setPackageId($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setIsPackage($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setTitle($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setAuthor($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setEdition($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setPublisher($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setBNew($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setBUsed($arr[$keys[9]]);
		if (array_key_exists($keys[10], $arr)) $this->setBEbook($arr[$keys[10]]);
		if (array_key_exists($keys[11], $arr)) $this->setImageUrl($arr[$keys[11]]);
		if (array_key_exists($keys[12], $arr)) $this->setProductId($arr[$keys[12]]);
		if (array_key_exists($keys[13], $arr)) $this->setPartNumber($arr[$keys[13]]);
		if (array_key_exists($keys[14], $arr)) $this->setSpideredAt($arr[$keys[14]]);
		if (array_key_exists($keys[15], $arr)) $this->setShallowSpideredAt($arr[$keys[15]]);
		if (array_key_exists($keys[16], $arr)) $this->setTouched($arr[$keys[16]]);
		if (array_key_exists($keys[17], $arr)) $this->setBId($arr[$keys[17]]);
		if (array_key_exists($keys[18], $arr)) $this->setBookstoreType($arr[$keys[18]]);
		if (array_key_exists($keys[19], $arr)) $this->setCreatedAt($arr[$keys[19]]);
		if (array_key_exists($keys[20], $arr)) $this->setUpdatedAt($arr[$keys[20]]);
	}

	/**
	 * Build a Criteria object containing the values of all modified columns in this object.
	 *
	 * @return     Criteria The Criteria object containing all modified values.
	 */
	public function buildCriteria()
	{
		$criteria = new Criteria(ItemPeer::DATABASE_NAME);

		if ($this->isColumnModified(ItemPeer::ID)) $criteria->add(ItemPeer::ID, $this->id);
		if ($this->isColumnModified(ItemPeer::ISBN)) $criteria->add(ItemPeer::ISBN, $this->isbn);
		if ($this->isColumnModified(ItemPeer::PACKAGE_ID)) $criteria->add(ItemPeer::PACKAGE_ID, $this->package_id);
		if ($this->isColumnModified(ItemPeer::IS_PACKAGE)) $criteria->add(ItemPeer::IS_PACKAGE, $this->is_package);
		if ($this->isColumnModified(ItemPeer::TITLE)) $criteria->add(ItemPeer::TITLE, $this->title);
		if ($this->isColumnModified(ItemPeer::AUTHOR)) $criteria->add(ItemPeer::AUTHOR, $this->author);
		if ($this->isColumnModified(ItemPeer::EDITION)) $criteria->add(ItemPeer::EDITION, $this->edition);
		if ($this->isColumnModified(ItemPeer::PUBLISHER)) $criteria->add(ItemPeer::PUBLISHER, $this->publisher);
		if ($this->isColumnModified(ItemPeer::B_NEW)) $criteria->add(ItemPeer::B_NEW, $this->b_new);
		if ($this->isColumnModified(ItemPeer::B_USED)) $criteria->add(ItemPeer::B_USED, $this->b_used);
		if ($this->isColumnModified(ItemPeer::B_EBOOK)) $criteria->add(ItemPeer::B_EBOOK, $this->b_ebook);
		if ($this->isColumnModified(ItemPeer::IMAGE_URL)) $criteria->add(ItemPeer::IMAGE_URL, $this->image_url);
		if ($this->isColumnModified(ItemPeer::PRODUCT_ID)) $criteria->add(ItemPeer::PRODUCT_ID, $this->product_id);
		if ($this->isColumnModified(ItemPeer::PART_NUMBER)) $criteria->add(ItemPeer::PART_NUMBER, $this->part_number);
		if ($this->isColumnModified(ItemPeer::SPIDERED_AT)) $criteria->add(ItemPeer::SPIDERED_AT, $this->spidered_at);
		if ($this->isColumnModified(ItemPeer::SHALLOW_SPIDERED_AT)) $criteria->add(ItemPeer::SHALLOW_SPIDERED_AT, $this->shallow_spidered_at);
		if ($this->isColumnModified(ItemPeer::TOUCHED)) $criteria->add(ItemPeer::TOUCHED, $this->touched);
		if ($this->isColumnModified(ItemPeer::B_ID)) $criteria->add(ItemPeer::B_ID, $this->b_id);
		if ($this->isColumnModified(ItemPeer::BOOKSTORE_TYPE)) $criteria->add(ItemPeer::BOOKSTORE_TYPE, $this->bookstore_type);
		if ($this->isColumnModified(ItemPeer::CREATED_AT)) $criteria->add(ItemPeer::CREATED_AT, $this->created_at);
		if ($this->isColumnModified(ItemPeer::UPDATED_AT)) $criteria->add(ItemPeer::UPDATED_AT, $this->updated_at);

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
		$criteria = new Criteria(ItemPeer::DATABASE_NAME);
		$criteria->add(ItemPeer::ID, $this->id);

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
	 * @param      object $copyObj An object of Item (or compatible) type.
	 * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
	 * @param      boolean $makeNew Whether to reset autoincrement PKs and make the object new.
	 * @throws     PropelException
	 */
	public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
	{
		$copyObj->setIsbn($this->getIsbn());
		$copyObj->setPackageId($this->getPackageId());
		$copyObj->setIsPackage($this->getIsPackage());
		$copyObj->setTitle($this->getTitle());
		$copyObj->setAuthor($this->getAuthor());
		$copyObj->setEdition($this->getEdition());
		$copyObj->setPublisher($this->getPublisher());
		$copyObj->setBNew($this->getBNew());
		$copyObj->setBUsed($this->getBUsed());
		$copyObj->setBEbook($this->getBEbook());
		$copyObj->setImageUrl($this->getImageUrl());
		$copyObj->setProductId($this->getProductId());
		$copyObj->setPartNumber($this->getPartNumber());
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

			foreach ($this->getItemsRelatedById() as $relObj) {
				if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
					$copyObj->addItemRelatedById($relObj->copy($deepCopy));
				}
			}

			foreach ($this->getSectionHasItems() as $relObj) {
				if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
					$copyObj->addSectionHasItem($relObj->copy($deepCopy));
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
	 * @return     Item Clone of current object.
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
	 * @return     ItemPeer
	 */
	public function getPeer()
	{
		if (self::$peer === null) {
			self::$peer = new ItemPeer();
		}
		return self::$peer;
	}

	/**
	 * Declares an association between this object and a Book object.
	 *
	 * @param      Book $v
	 * @return     Item The current object (for fluent API support)
	 * @throws     PropelException
	 */
	public function setBook(Book $v = null)
	{
		if ($v === null) {
			$this->setIsbn(NULL);
		} else {
			$this->setIsbn($v->getIsbn());
		}

		$this->aBook = $v;

		// Add binding for other direction of this n:n relationship.
		// If this object has already been added to the Book object, it will not be re-added.
		if ($v !== null) {
			$v->addItem($this);
		}

		return $this;
	}


	/**
	 * Get the associated Book object
	 *
	 * @param      PropelPDO Optional Connection object.
	 * @return     Book The associated Book object.
	 * @throws     PropelException
	 */
	public function getBook(PropelPDO $con = null)
	{
		if ($this->aBook === null && (($this->isbn !== "" && $this->isbn !== null))) {
			$this->aBook = BookQuery::create()
				->filterByItem($this) // here
				->findOne($con);
			/* The following can be used additionally to
				guarantee the related object contains a reference
				to this object.  This level of coupling may, however, be
				undesirable since it could result in an only partially populated collection
				in the referenced object.
				$this->aBook->addItems($this);
			 */
		}
		return $this->aBook;
	}

	/**
	 * Declares an association between this object and a Item object.
	 *
	 * @param      Item $v
	 * @return     Item The current object (for fluent API support)
	 * @throws     PropelException
	 */
	public function setItemRelatedByPackageId(Item $v = null)
	{
		if ($v === null) {
			$this->setPackageId(NULL);
		} else {
			$this->setPackageId($v->getId());
		}

		$this->aItemRelatedByPackageId = $v;

		// Add binding for other direction of this n:n relationship.
		// If this object has already been added to the Item object, it will not be re-added.
		if ($v !== null) {
			$v->addItemRelatedById($this);
		}

		return $this;
	}


	/**
	 * Get the associated Item object
	 *
	 * @param      PropelPDO Optional Connection object.
	 * @return     Item The associated Item object.
	 * @throws     PropelException
	 */
	public function getItemRelatedByPackageId(PropelPDO $con = null)
	{
		if ($this->aItemRelatedByPackageId === null && ($this->package_id !== null)) {
			$this->aItemRelatedByPackageId = ItemQuery::create()->findPk($this->package_id, $con);
			/* The following can be used additionally to
				guarantee the related object contains a reference
				to this object.  This level of coupling may, however, be
				undesirable since it could result in an only partially populated collection
				in the referenced object.
				$this->aItemRelatedByPackageId->addItemsRelatedById($this);
			 */
		}
		return $this->aItemRelatedByPackageId;
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
		if ('ItemRelatedById' == $relationName) {
			return $this->initItemsRelatedById();
		}
		if ('SectionHasItem' == $relationName) {
			return $this->initSectionHasItems();
		}
	}

	/**
	 * Clears out the collItemsRelatedById collection
	 *
	 * This does not modify the database; however, it will remove any associated objects, causing
	 * them to be refetched by subsequent calls to accessor method.
	 *
	 * @return     void
	 * @see        addItemsRelatedById()
	 */
	public function clearItemsRelatedById()
	{
		$this->collItemsRelatedById = null; // important to set this to NULL since that means it is uninitialized
	}

	/**
	 * Initializes the collItemsRelatedById collection.
	 *
	 * By default this just sets the collItemsRelatedById collection to an empty array (like clearcollItemsRelatedById());
	 * however, you may wish to override this method in your stub class to provide setting appropriate
	 * to your application -- for example, setting the initial array to the values stored in database.
	 *
	 * @param      boolean $overrideExisting If set to true, the method call initializes
	 *                                        the collection even if it is not empty
	 *
	 * @return     void
	 */
	public function initItemsRelatedById($overrideExisting = true)
	{
		if (null !== $this->collItemsRelatedById && !$overrideExisting) {
			return;
		}
		$this->collItemsRelatedById = new PropelObjectCollection();
		$this->collItemsRelatedById->setModel('Item');
	}

	/**
	 * Gets an array of Item objects which contain a foreign key that references this object.
	 *
	 * If the $criteria is not null, it is used to always fetch the results from the database.
	 * Otherwise the results are fetched from the database the first time, then cached.
	 * Next time the same method is called without $criteria, the cached collection is returned.
	 * If this Item is new, it will return
	 * an empty collection or the current collection; the criteria is ignored on a new object.
	 *
	 * @param      Criteria $criteria optional Criteria object to narrow the query
	 * @param      PropelPDO $con optional connection object
	 * @return     PropelCollection|array Item[] List of Item objects
	 * @throws     PropelException
	 */
	public function getItemsRelatedById($criteria = null, PropelPDO $con = null)
	{
		if(null === $this->collItemsRelatedById || null !== $criteria) {
			if ($this->isNew() && null === $this->collItemsRelatedById) {
				// return empty collection
				$this->initItemsRelatedById();
			} else {
				$collItemsRelatedById = ItemQuery::create(null, $criteria)
					->filterByItemRelatedByPackageId($this)
					->find($con);
				if (null !== $criteria) {
					return $collItemsRelatedById;
				}
				$this->collItemsRelatedById = $collItemsRelatedById;
			}
		}
		return $this->collItemsRelatedById;
	}

	/**
	 * Sets a collection of ItemRelatedById objects related by a one-to-many relationship
	 * to the current object.
	 * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
	 * and new objects from the given Propel collection.
	 *
	 * @param      PropelCollection $itemsRelatedById A Propel collection.
	 * @param      PropelPDO $con Optional connection object
	 */
	public function setItemsRelatedById(PropelCollection $itemsRelatedById, PropelPDO $con = null)
	{
		$this->itemsRelatedByIdScheduledForDeletion = $this->getItemsRelatedById(new Criteria(), $con)->diff($itemsRelatedById);

		foreach ($itemsRelatedById as $itemRelatedById) {
			// Fix issue with collection modified by reference
			if ($itemRelatedById->isNew()) {
				$itemRelatedById->setItemRelatedByPackageId($this);
			}
			$this->addItemRelatedById($itemRelatedById);
		}

		$this->collItemsRelatedById = $itemsRelatedById;
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
	public function countItemsRelatedById(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if(null === $this->collItemsRelatedById || null !== $criteria) {
			if ($this->isNew() && null === $this->collItemsRelatedById) {
				return 0;
			} else {
				$query = ItemQuery::create(null, $criteria);
				if($distinct) {
					$query->distinct();
				}
				return $query
					->filterByItemRelatedByPackageId($this)
					->count($con);
			}
		} else {
			return count($this->collItemsRelatedById);
		}
	}

	/**
	 * Method called to associate a Item object to this object
	 * through the Item foreign key attribute.
	 *
	 * @param      Item $l Item
	 * @return     Item The current object (for fluent API support)
	 */
	public function addItemRelatedById(Item $l)
	{
		if ($this->collItemsRelatedById === null) {
			$this->initItemsRelatedById();
		}
		if (!$this->collItemsRelatedById->contains($l)) { // only add it if the **same** object is not already associated
			$this->doAddItemRelatedById($l);
		}

		return $this;
	}

	/**
	 * @param	ItemRelatedById $itemRelatedById The itemRelatedById object to add.
	 */
	protected function doAddItemRelatedById($itemRelatedById)
	{
		$this->collItemsRelatedById[]= $itemRelatedById;
		$itemRelatedById->setItemRelatedByPackageId($this);
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Item is new, it will return
	 * an empty collection; or if this Item has previously
	 * been saved, it will retrieve related ItemsRelatedById from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Item.
	 *
	 * @param      Criteria $criteria optional Criteria object to narrow the query
	 * @param      PropelPDO $con optional connection object
	 * @param      string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
	 * @return     PropelCollection|array Item[] List of Item objects
	 */
	public function getItemsRelatedByIdJoinBook($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		$query = ItemQuery::create(null, $criteria);
		$query->joinWith('Book', $join_behavior);

		return $this->getItemsRelatedById($query, $con);
	}

	/**
	 * Clears out the collSectionHasItems collection
	 *
	 * This does not modify the database; however, it will remove any associated objects, causing
	 * them to be refetched by subsequent calls to accessor method.
	 *
	 * @return     void
	 * @see        addSectionHasItems()
	 */
	public function clearSectionHasItems()
	{
		$this->collSectionHasItems = null; // important to set this to NULL since that means it is uninitialized
	}

	/**
	 * Initializes the collSectionHasItems collection.
	 *
	 * By default this just sets the collSectionHasItems collection to an empty array (like clearcollSectionHasItems());
	 * however, you may wish to override this method in your stub class to provide setting appropriate
	 * to your application -- for example, setting the initial array to the values stored in database.
	 *
	 * @param      boolean $overrideExisting If set to true, the method call initializes
	 *                                        the collection even if it is not empty
	 *
	 * @return     void
	 */
	public function initSectionHasItems($overrideExisting = true)
	{
		if (null !== $this->collSectionHasItems && !$overrideExisting) {
			return;
		}
		$this->collSectionHasItems = new PropelObjectCollection();
		$this->collSectionHasItems->setModel('SectionHasItem');
	}

	/**
	 * Gets an array of SectionHasItem objects which contain a foreign key that references this object.
	 *
	 * If the $criteria is not null, it is used to always fetch the results from the database.
	 * Otherwise the results are fetched from the database the first time, then cached.
	 * Next time the same method is called without $criteria, the cached collection is returned.
	 * If this Item is new, it will return
	 * an empty collection or the current collection; the criteria is ignored on a new object.
	 *
	 * @param      Criteria $criteria optional Criteria object to narrow the query
	 * @param      PropelPDO $con optional connection object
	 * @return     PropelCollection|array SectionHasItem[] List of SectionHasItem objects
	 * @throws     PropelException
	 */
	public function getSectionHasItems($criteria = null, PropelPDO $con = null)
	{
		if(null === $this->collSectionHasItems || null !== $criteria) {
			if ($this->isNew() && null === $this->collSectionHasItems) {
				// return empty collection
				$this->initSectionHasItems();
			} else {
				$collSectionHasItems = SectionHasItemQuery::create(null, $criteria)
					->filterByItem($this)
					->find($con);
				if (null !== $criteria) {
					return $collSectionHasItems;
				}
				$this->collSectionHasItems = $collSectionHasItems;
			}
		}
		return $this->collSectionHasItems;
	}

	/**
	 * Sets a collection of SectionHasItem objects related by a one-to-many relationship
	 * to the current object.
	 * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
	 * and new objects from the given Propel collection.
	 *
	 * @param      PropelCollection $sectionHasItems A Propel collection.
	 * @param      PropelPDO $con Optional connection object
	 */
	public function setSectionHasItems(PropelCollection $sectionHasItems, PropelPDO $con = null)
	{
		$this->sectionHasItemsScheduledForDeletion = $this->getSectionHasItems(new Criteria(), $con)->diff($sectionHasItems);

		foreach ($sectionHasItems as $sectionHasItem) {
			// Fix issue with collection modified by reference
			if ($sectionHasItem->isNew()) {
				$sectionHasItem->setItem($this);
			}
			$this->addSectionHasItem($sectionHasItem);
		}

		$this->collSectionHasItems = $sectionHasItems;
	}

	/**
	 * Returns the number of related SectionHasItem objects.
	 *
	 * @param      Criteria $criteria
	 * @param      boolean $distinct
	 * @param      PropelPDO $con
	 * @return     int Count of related SectionHasItem objects.
	 * @throws     PropelException
	 */
	public function countSectionHasItems(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
	{
		if(null === $this->collSectionHasItems || null !== $criteria) {
			if ($this->isNew() && null === $this->collSectionHasItems) {
				return 0;
			} else {
				$query = SectionHasItemQuery::create(null, $criteria);
				if($distinct) {
					$query->distinct();
				}
				return $query
					->filterByItem($this)
					->count($con);
			}
		} else {
			return count($this->collSectionHasItems);
		}
	}

	/**
	 * Method called to associate a SectionHasItem object to this object
	 * through the SectionHasItem foreign key attribute.
	 *
	 * @param      SectionHasItem $l SectionHasItem
	 * @return     Item The current object (for fluent API support)
	 */
	public function addSectionHasItem(SectionHasItem $l)
	{
		if ($this->collSectionHasItems === null) {
			$this->initSectionHasItems();
		}
		if (!$this->collSectionHasItems->contains($l)) { // only add it if the **same** object is not already associated
			$this->doAddSectionHasItem($l);
		}

		return $this;
	}

	/**
	 * @param	SectionHasItem $sectionHasItem The sectionHasItem object to add.
	 */
	protected function doAddSectionHasItem($sectionHasItem)
	{
		$this->collSectionHasItems[]= $sectionHasItem;
		$sectionHasItem->setItem($this);
	}


	/**
	 * If this collection has already been initialized with
	 * an identical criteria, it returns the collection.
	 * Otherwise if this Item is new, it will return
	 * an empty collection; or if this Item has previously
	 * been saved, it will retrieve related SectionHasItems from storage.
	 *
	 * This method is protected by default in order to keep the public
	 * api reasonable.  You can provide public methods for those you
	 * actually need in Item.
	 *
	 * @param      Criteria $criteria optional Criteria object to narrow the query
	 * @param      PropelPDO $con optional connection object
	 * @param      string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
	 * @return     PropelCollection|array SectionHasItem[] List of SectionHasItem objects
	 */
	public function getSectionHasItemsJoinSection($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
	{
		$query = SectionHasItemQuery::create(null, $criteria);
		$query->joinWith('Section', $join_behavior);

		return $this->getSectionHasItems($query, $con);
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
	 * By default this just sets the collSections collection to an empty collection (like clearSections());
	 * however, you may wish to override this method in your stub class to provide setting appropriate
	 * to your application -- for example, setting the initial array to the values stored in database.
	 *
	 * @return     void
	 */
	public function initSections()
	{
		$this->collSections = new PropelObjectCollection();
		$this->collSections->setModel('Section');
	}

	/**
	 * Gets a collection of Section objects related by a many-to-many relationship
	 * to the current object by way of the section_has_item cross-reference table.
	 *
	 * If the $criteria is not null, it is used to always fetch the results from the database.
	 * Otherwise the results are fetched from the database the first time, then cached.
	 * Next time the same method is called without $criteria, the cached collection is returned.
	 * If this Item is new, it will return
	 * an empty collection or the current collection; the criteria is ignored on a new object.
	 *
	 * @param      Criteria $criteria Optional query object to filter the query
	 * @param      PropelPDO $con Optional connection object
	 *
	 * @return     PropelCollection|array Section[] List of Section objects
	 */
	public function getSections($criteria = null, PropelPDO $con = null)
	{
		if(null === $this->collSections || null !== $criteria) {
			if ($this->isNew() && null === $this->collSections) {
				// return empty collection
				$this->initSections();
			} else {
				$collSections = SectionQuery::create(null, $criteria)
					->filterByItem($this)
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
	 * Sets a collection of Section objects related by a many-to-many relationship
	 * to the current object by way of the section_has_item cross-reference table.
	 * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
	 * and new objects from the given Propel collection.
	 *
	 * @param      PropelCollection $sections A Propel collection.
	 * @param      PropelPDO $con Optional connection object
	 */
	public function setSections(PropelCollection $sections, PropelPDO $con = null)
	{
		$sectionHasItems = SectionHasItemQuery::create()
			->filterBySection($sections)
			->filterByItem($this)
			->find($con);

		$this->sectionsScheduledForDeletion = $this->getSectionHasItems()->diff($sectionHasItems);
		$this->collSectionHasItems = $sectionHasItems;

		foreach ($sections as $section) {
			// Fix issue with collection modified by reference
			if ($section->isNew()) {
				$this->doAddSection($section);
			} else {
				$this->addSection($section);
			}
		}

		$this->collSections = $sections;
	}

	/**
	 * Gets the number of Section objects related by a many-to-many relationship
	 * to the current object by way of the section_has_item cross-reference table.
	 *
	 * @param      Criteria $criteria Optional query object to filter the query
	 * @param      boolean $distinct Set to true to force count distinct
	 * @param      PropelPDO $con Optional connection object
	 *
	 * @return     int the number of related Section objects
	 */
	public function countSections($criteria = null, $distinct = false, PropelPDO $con = null)
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
					->filterByItem($this)
					->count($con);
			}
		} else {
			return count($this->collSections);
		}
	}

	/**
	 * Associate a Section object to this object
	 * through the section_has_item cross reference table.
	 *
	 * @param      Section $section The SectionHasItem object to relate
	 * @return     void
	 */
	public function addSection(Section $section)
	{
		if ($this->collSections === null) {
			$this->initSections();
		}
		if (!$this->collSections->contains($section)) { // only add it if the **same** object is not already associated
			$this->doAddSection($section);

			$this->collSections[]= $section;
		}
	}

	/**
	 * @param	Section $section The section object to add.
	 */
	protected function doAddSection($section)
	{
		$sectionHasItem = new SectionHasItem();
		$sectionHasItem->setSection($section);
		$this->addSectionHasItem($sectionHasItem);
	}

	/**
	 * Clears the current object and sets all attributes to their default values
	 */
	public function clear()
	{
		$this->id = null;
		$this->isbn = null;
		$this->package_id = null;
		$this->is_package = null;
		$this->title = null;
		$this->author = null;
		$this->edition = null;
		$this->publisher = null;
		$this->b_new = null;
		$this->b_used = null;
		$this->b_ebook = null;
		$this->image_url = null;
		$this->product_id = null;
		$this->part_number = null;
		$this->spidered_at = null;
		$this->shallow_spidered_at = null;
		$this->touched = null;
		$this->b_id = null;
		$this->bookstore_type = null;
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
			if ($this->collItemsRelatedById) {
				foreach ($this->collItemsRelatedById as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collSectionHasItems) {
				foreach ($this->collSectionHasItems as $o) {
					$o->clearAllReferences($deep);
				}
			}
			if ($this->collSections) {
				foreach ($this->collSections as $o) {
					$o->clearAllReferences($deep);
				}
			}
		} // if ($deep)

		if ($this->collItemsRelatedById instanceof PropelCollection) {
			$this->collItemsRelatedById->clearIterator();
		}
		$this->collItemsRelatedById = null;
		if ($this->collSectionHasItems instanceof PropelCollection) {
			$this->collSectionHasItems->clearIterator();
		}
		$this->collSectionHasItems = null;
		if ($this->collSections instanceof PropelCollection) {
			$this->collSections->clearIterator();
		}
		$this->collSections = null;
		$this->aBook = null;
		$this->aItemRelatedByPackageId = null;
	}

	/**
	 * Return the string representation of this object
	 *
	 * @return string
	 */
	public function __toString()
	{
		return (string) $this->exportTo(ItemPeer::DEFAULT_STRING_FORMAT);
	}

	// spiderable behavior
	
	  
	    /**
	     * Set the spidered time to the current time
	     *
	     * @return     Item The current object (for fluent API support)
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
	 * @return     Item The current object (for fluent API support)
	 */
	public function keepUpdateDateUnchanged()
	{
		$this->modifiedColumns[] = ItemPeer::UPDATED_AT;
		return $this;
	}

} // BaseItem
