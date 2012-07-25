<?php



/**
 * This class defines the structure of the 'section' table.
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
class SectionTableMap extends TableMap
{

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = '.map.SectionTableMap';

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
		$this->setName('section');
		$this->setPhpName('Section');
		$this->setClassname('Section');
		$this->setPackage('');
		$this->setUseIdGenerator(true);
		// columns
		$this->addColumn('NUM', 'Num', 'VARCHAR', true, 255, null);
		$this->addColumn('REQUIRES_BOOKS', 'RequiresBooks', 'BOOLEAN', false, 1, true);
		$this->addColumn('NAME', 'Name', 'VARCHAR', false, 255, null);
		$this->addColumn('SLUG', 'Slug', 'VARCHAR', false, 255, null);
		$this->addColumn('SCHOOL_SLUG', 'SchoolSlug', 'VARCHAR', false, 255, null);
		$this->addColumn('CAMPUS_SLUG', 'CampusSlug', 'VARCHAR', false, 255, null);
		$this->addColumn('TERM_SLUG', 'TermSlug', 'VARCHAR', false, 255, null);
		$this->addColumn('F_ID', 'FId', 'VARCHAR', false, 255, null);
		$this->addColumn('NB_ITEMS', 'NbItems', 'INTEGER', false, null, 0);
		$this->addColumn('PROFESSOR', 'Professor', 'VARCHAR', false, 255, null);
		$this->addForeignKey('COURSE_ID', 'CourseId', 'INTEGER', 'course', 'ID', false, null, null);
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
		$this->addRelation('Course', 'Course', RelationMap::MANY_TO_ONE, array('course_id' => 'id', ), 'CASCADE', null);
		$this->addRelation('SectionHasItem', 'SectionHasItem', RelationMap::ONE_TO_MANY, array('id' => 'section_id', ), 'CASCADE', null, 'SectionHasItems');
		$this->addRelation('Item', 'Item', RelationMap::MANY_TO_MANY, array(), 'CASCADE', null, 'Items');
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
			'spiderable' => array('parent' => 'course', 'bookstore_type_column' => 'bookstore_type', 'spidered_column' => 'spidered_at', 'shallow_spidered_column' => 'shallow_spidered_at', 'touched_column' => 'touched', 'id_column' => 'b_id', 'id_size' => '255', ),
			'aggregate_column' => array('name' => 'nb_items', 'expression' => 'COUNT(id)', 'foreign_table' => 'section_has_item', 'foreign_schema' => '', ),
			'auto_add_pk' => array('name' => 'id', 'autoIncrement' => 'true', 'type' => 'INTEGER', ),
			'timestampable' => array('create_column' => 'created_at', 'update_column' => 'updated_at', ),
			'custom_db' => array('original_name' => 'gbpropel', 'db_name_constant' => 'GB_DATABASE', ),
			'aggregate_column_relation' => array('foreign_table' => 'course', 'update_method' => 'updateNbSections', ),
		);
	} // getBehaviors()

} // SectionTableMap
