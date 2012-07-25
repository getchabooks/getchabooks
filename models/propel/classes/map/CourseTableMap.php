<?php



/**
 * This class defines the structure of the 'course' table.
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
class CourseTableMap extends TableMap
{

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = '.map.CourseTableMap';

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
		$this->setName('course');
		$this->setPhpName('Course');
		$this->setClassname('Course');
		$this->setPackage('');
		$this->setUseIdGenerator(true);
		// columns
		$this->addColumn('NUM', 'Num', 'VARCHAR', true, 255, null);
		$this->addColumn('NB_SECTIONS', 'NbSections', 'INTEGER', false, null, null);
		$this->addColumn('NAME', 'Name', 'VARCHAR', false, 255, null);
		$this->addForeignKey('DEPT_ID', 'DeptId', 'INTEGER', 'dept', 'ID', false, null, null);
		$this->addColumn('SPIDERED_AT', 'SpideredAt', 'TIMESTAMP', false, null, null);
		$this->addColumn('SHALLOW_SPIDERED_AT', 'ShallowSpideredAt', 'TIMESTAMP', false, null, null);
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
		$this->addRelation('Dept', 'Dept', RelationMap::MANY_TO_ONE, array('dept_id' => 'id', ), 'CASCADE', null);
		$this->addRelation('Section', 'Section', RelationMap::ONE_TO_MANY, array('id' => 'course_id', ), 'CASCADE', null, 'Sections');
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
			'spiderable' => array('parent' => 'dept', 'bookstore_type_column' => 'bookstore_type', 'spidered_column' => 'spidered_at', 'shallow_spidered_column' => 'shallow_spidered_at', 'touched_column' => 'touched', 'id_column' => 'b_id', 'id_size' => '255', ),
			'aggregate_column' => array('name' => 'nb_sections', 'expression' => 'COUNT(id)', 'foreign_table' => 'section', 'foreign_schema' => '', ),
			'auto_add_pk' => array('name' => 'id', 'autoIncrement' => 'true', 'type' => 'INTEGER', ),
			'timestampable' => array('create_column' => 'created_at', 'update_column' => 'updated_at', ),
			'custom_db' => array('original_name' => 'gbpropel', 'db_name_constant' => 'GB_DATABASE', ),
		);
	} // getBehaviors()

} // CourseTableMap
