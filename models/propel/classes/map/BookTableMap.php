<?php



/**
 * This class defines the structure of the 'book' table.
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
class BookTableMap extends TableMap
{

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = '.map.BookTableMap';

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
		$this->setName('book');
		$this->setPhpName('Book');
		$this->setClassname('Book');
		$this->setPackage('');
		$this->setUseIdGenerator(true);
		// columns
		$this->addColumn('ISBN', 'Isbn', 'VARCHAR', false, 13, null);
		$this->addColumn('TITLE', 'Title', 'VARCHAR', false, 255, '');
		$this->addColumn('AUTHOR', 'Author', 'VARCHAR', false, 255, null);
		$this->addColumn('PUBLISHER', 'Publisher', 'VARCHAR', false, 255, null);
		$this->addColumn('EDITION', 'Edition', 'VARCHAR', false, 255, null);
		$this->addColumn('EDITION_NUM', 'EditionNum', 'VARCHAR', false, 255, null);
		$this->addColumn('PUBDATE', 'Pubdate', 'VARCHAR', false, 255, null);
		$this->addColumn('IS_PAPERBACK', 'IsPaperback', 'BOOLEAN', false, 1, false);
		$this->addColumn('IMAGE_URL', 'ImageUrl', 'VARCHAR', false, 255, null);
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
		$this->addRelation('Item', 'Item', RelationMap::ONE_TO_MANY, array('isbn' => 'isbn', ), 'SET NULL', null, 'Items');
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

} // BookTableMap
