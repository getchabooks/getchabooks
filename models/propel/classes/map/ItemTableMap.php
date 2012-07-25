<?php



/**
 * This class defines the structure of the 'item' table.
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
class ItemTableMap extends TableMap
{

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = '.map.ItemTableMap';

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
		$this->setName('item');
		$this->setPhpName('Item');
		$this->setClassname('Item');
		$this->setPackage('');
		$this->setUseIdGenerator(true);
		// columns
		$this->addPrimaryKey('ID', 'Id', 'INTEGER', true, null, null);
		$this->addForeignKey('ISBN', 'Isbn', 'VARCHAR', 'book', 'ISBN', false, 13, null);
		$this->addForeignKey('PACKAGE_ID', 'PackageId', 'INTEGER', 'item', 'ID', false, null, null);
		$this->addColumn('IS_PACKAGE', 'IsPackage', 'BOOLEAN', false, 1, false);
		$this->addColumn('TITLE', 'Title', 'VARCHAR', false, 255, null);
		$this->addColumn('AUTHOR', 'Author', 'VARCHAR', false, 255, null);
		$this->addColumn('EDITION', 'Edition', 'VARCHAR', false, 255, null);
		$this->addColumn('PUBLISHER', 'Publisher', 'VARCHAR', false, 255, null);
		$this->addColumn('B_NEW', 'BNew', 'DECIMAL', false, 6, null);
		$this->addColumn('B_USED', 'BUsed', 'DECIMAL', false, 6, null);
		$this->addColumn('B_EBOOK', 'BEbook', 'DECIMAL', false, 6, null);
		$this->addColumn('IMAGE_URL', 'ImageUrl', 'VARCHAR', false, 255, null);
		$this->addColumn('PRODUCT_ID', 'ProductId', 'VARCHAR', false, 255, null);
		$this->addColumn('PART_NUMBER', 'PartNumber', 'VARCHAR', false, 255, null);
		$this->addColumn('SPIDERED_AT', 'SpideredAt', 'TIMESTAMP', false, null, null);
		$this->addColumn('SHALLOW_SPIDERED_AT', 'ShallowSpideredAt', 'TIMESTAMP', false, null, null);
		$this->addColumn('TOUCHED', 'Touched', 'BOOLEAN', false, 1, null);
		$this->addColumn('B_ID', 'BId', 'VARCHAR', false, 255, null);
		$this->addColumn('BOOKSTORE_TYPE', 'BookstoreType', 'VARCHAR', false, 32, null);
		$this->addColumn('CREATED_AT', 'CreatedAt', 'TIMESTAMP', false, null, null);
		$this->addColumn('UPDATED_AT', 'UpdatedAt', 'TIMESTAMP', false, null, null);
		// validators
	} // initialize()

	/**
	 * Build the RelationMap objects for this table relationships
	 */
	public function buildRelations()
	{
		$this->addRelation('Book', 'Book', RelationMap::MANY_TO_ONE, array('isbn' => 'isbn', ), 'SET NULL', null);
		$this->addRelation('ItemRelatedByPackageId', 'Item', RelationMap::MANY_TO_ONE, array('package_id' => 'id', ), 'CASCADE', null);
		$this->addRelation('ItemRelatedById', 'Item', RelationMap::ONE_TO_MANY, array('id' => 'package_id', ), 'CASCADE', null, 'ItemsRelatedById');
		$this->addRelation('SectionHasItem', 'SectionHasItem', RelationMap::ONE_TO_MANY, array('id' => 'item_id', ), 'CASCADE', null, 'SectionHasItems');
		$this->addRelation('Section', 'Section', RelationMap::MANY_TO_MANY, array(), 'CASCADE', null, 'Sections');
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
			'spiderable' => array('parent' => '', 'bookstore_type_column' => 'bookstore_type', 'spidered_column' => 'spidered_at', 'shallow_spidered_column' => 'shallow_spidered_at', 'touched_column' => 'touched', 'id_column' => 'b_id', 'id_size' => '255', ),
			'timestampable' => array('create_column' => 'created_at', 'update_column' => 'updated_at', ),
			'custom_db' => array('original_name' => 'gbpropel', 'db_name_constant' => 'GB_DATABASE', ),
		);
	} // getBehaviors()

} // ItemTableMap
