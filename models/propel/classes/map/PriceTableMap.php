<?php



/**
 * This class defines the structure of the 'price' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 * @package    propel.generator..map
 */
class PriceTableMap extends TableMap {

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = '.map.PriceTableMap';

	/**
	 * Initialize the table attributes, columns and validators
	 * Relations are not initialized by this method since they are lazy loaded
	 *
	 * @return     void
	 * @throws     PropelException
	 */
	public function initialize()
	{
	  // attributes
		$this->setName('price');
		$this->setPhpName('Price');
		$this->setClassname('Price');
		$this->setPackage('');
		$this->setUseIdGenerator(true);
		// columns
		$this->addForeignKey('ISBN', 'Isbn', 'VARCHAR', 'book', 'ISBN', false, 255, null);
		$this->addForeignKey('ITEM_ID', 'ItemId', 'INTEGER', 'item', 'ID', false, null, null);
		$this->addForeignKey('VENDOR_ID', 'VendorId', 'INTEGER', 'vendor', 'V_ID', true, null, null);
		$this->addColumn('SUBTOTAL', 'Subtotal', 'DECIMAL', false, 6, null);
		$this->addColumn('SHIPPING', 'Shipping', 'DECIMAL', false, 4, null);
		$this->addColumn('OFFER_ID', 'OfferId', 'VARCHAR', false, 255, null);
		$this->addColumn('SELLER_ID', 'SellerId', 'VARCHAR', false, 255, null);
		$this->addColumn('SELLER_RATING', 'SellerRating', 'TINYINT', false, null, null);
		$this->addColumn('CONDITION', 'Condition', 'TINYINT', false, null, null);
		$this->addColumn('IS_RENTAL', 'IsRental', 'BOOLEAN', false, null, false);
		$this->addColumn('IS_EBOOK', 'IsEbook', 'BOOLEAN', false, null, false);
		$this->addColumn('HAS_EXPEDITED', 'HasExpedited', 'BOOLEAN', false, null, false);
		$this->addColumn('HAS_TWODAY', 'HasTwoday', 'BOOLEAN', false, null, false);
		$this->addColumn('HAS_ONEDAY', 'HasOneday', 'BOOLEAN', false, null, false);
		$this->addColumn('HAS_PRIME', 'HasPrime', 'BOOLEAN', false, null, false);
		$this->addPrimaryKey('ID', 'Id', 'INTEGER', true, null, null);
		$this->addColumn('CREATED_AT', 'CreatedAt', 'TIMESTAMP', false, null, null);
		$this->addColumn('UPDATED_AT', 'UpdatedAt', 'TIMESTAMP', false, null, null);
		// validators
	} // initialize()

	/**
	 * Build the RelationMap objects for this table relationships
	 */
	public function buildRelations()
	{
    $this->addRelation('Book', 'Book', RelationMap::MANY_TO_ONE, array('isbn' => 'isbn', ), 'CASCADE', null);
    $this->addRelation('Item', 'Item', RelationMap::MANY_TO_ONE, array('item_id' => 'id', ), 'CASCADE', null);
    $this->addRelation('Vendor', 'Vendor', RelationMap::MANY_TO_ONE, array('vendor_id' => 'v_id', ), 'CASCADE', null);
	} // buildRelations()

	/**
	 * 
	 * Gets the list of behaviors registered for this table
	 * 
	 * @return array Associative array (name => parameters) of behaviors
	 */
	public function getBehaviors()
	{
		return array(
			'auto_add_pk' => array('name' => 'id', 'autoIncrement' => 'true', 'type' => 'INTEGER', ),
			'timestampable' => array('create_column' => 'created_at', 'update_column' => 'updated_at', ),
			'custom_db' => array('original_name' => 'gbpropel', 'db_name_constant' => 'GB_DATABASE', ),
		);
	} // getBehaviors()

} // PriceTableMap
