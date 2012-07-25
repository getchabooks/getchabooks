<?php



/**
 * This class defines the structure of the 'section_metadata' table.
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
class SectionMetadataTableMap extends TableMap
{

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = '.map.SectionMetadataTableMap';

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
		$this->setName('section_metadata');
		$this->setPhpName('SectionMetadata');
		$this->setClassname('SectionMetadata');
		$this->setPackage('');
		$this->setUseIdGenerator(true);
		// columns
		$this->addForeignKey('SECTION_B_ID', 'SectionBId', 'VARCHAR', 'section', 'B_ID', true, 255, null);
		$this->addColumn('PROFESSOR', 'Professor', 'VARCHAR', false, 255, null);
		$this->addColumn('PROFESSOR_EMAIL', 'ProfessorEmail', 'VARCHAR', false, 255, null);
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
		$this->addRelation('Section', 'Section', RelationMap::MANY_TO_ONE, array('section_b_id' => 'b_id', ), null, null);
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

} // SectionMetadataTableMap
