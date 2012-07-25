<?php



/**
 * This class defines the structure of the 'term' table.
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
class TermTableMap extends TableMap
{

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = '.map.TermTableMap';

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
		$this->setName('term');
		$this->setPhpName('Term');
		$this->setClassname('Term');
		$this->setPackage('');
		$this->setUseIdGenerator(true);
		// columns
		$this->addColumn('SHALLOW_SPIDERED_AT', 'ShallowSpideredAt', 'TIMESTAMP', false, null, null);
		$this->addColumn('NAME', 'Name', 'VARCHAR', true, 255, null);
		$this->addColumn('SLUG', 'Slug', 'VARCHAR', true, 255, null);
		$this->addColumn('STATUS', 'Status', 'INTEGER', false, null, -1);
		$this->addColumn('HAS_COURSE_INFO', 'HasCourseInfo', 'BOOLEAN', false, 1, false);
		$this->addForeignKey('CAMPUS_ID', 'CampusId', 'INTEGER', 'campus', 'ID', false, null, null);
		$this->addColumn('SPIDERED_AT', 'SpideredAt', 'TIMESTAMP', false, null, null);
		$this->addColumn('TOUCHED', 'Touched', 'BOOLEAN', false, 1, null);
		$this->addColumn('B_ID', 'BId', 'VARCHAR', false, 255, null);
		$this->addColumn('BOOKSTORE_TYPE', 'BookstoreType', 'VARCHAR', false, 32, null);
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
		$this->addRelation('Campus', 'Campus', RelationMap::MANY_TO_ONE, array('campus_id' => 'id', ), 'CASCADE', null);
		$this->addRelation('Dept', 'Dept', RelationMap::ONE_TO_MANY, array('id' => 'term_id', ), 'CASCADE', null, 'Depts');
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
			'spiderable' => array('parent' => 'campus', 'bookstore_type_column' => 'bookstore_type', 'spidered_column' => 'spidered_at', 'shallow_spidered_column' => 'shallow_spidered_at', 'touched_column' => 'touched', 'id_column' => 'b_id', 'id_size' => '255', ),
			'auto_add_pk' => array('name' => 'id', 'autoIncrement' => 'true', 'type' => 'INTEGER', ),
			'timestampable' => array('create_column' => 'created_at', 'update_column' => 'updated_at', ),
			'custom_db' => array('original_name' => 'gbpropel', 'db_name_constant' => 'GB_DATABASE', ),
		);
	} // getBehaviors()

} // TermTableMap
