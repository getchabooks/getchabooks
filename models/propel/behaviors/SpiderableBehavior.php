<?php

class SpiderableBehavior extends Behavior
{
    // default parameters value
    protected $parameters = array(
        'parent'    => null,
        'bookstore_type_column' => 'bookstore_type',
        'spidered_column' => 'spidered_at',
        'shallow_spidered_column' => 'shallow_spidered_at',
        'touched_column'  => 'touched',
        'id_column'       => 'b_id',
        'id_size'         => 255
    );

    /**
     * Add the create_column and update_columns to the current table
     */
    public function modifyTable()
    {
        $this->getTable()->setBaseClass('Spiderable');

        if ($this->getParameter('parent') !== null) {
            $parent = $this->getParameter('parent');
            $this->getTable()->addColumn(array(
                'name' => "{$parent}_id",
                'required' => true,
                'type' => 'INTEGER',
            ));
    
            $fk = new ForeignKey();
            $fk->setForeignTableCommonName($parent);
            $fk->setOnDelete('CASCADE');
            $fk->setOnUpdate(null);
            $fk->addReference(array(
                'local' => "{$parent}_id",
                'foreign' => 'id' 
            ));
            $this->getTable()->addForeignKey($fk);
        }

        if (!$this->getTable()->containsColumn($this->getParameter('spidered_column'))) {
            $this->getTable()->addColumn(array(
                'name' => $this->getParameter('spidered_column'),
                'type' => 'TIMESTAMP',
            ));
        }

        if (!$this->getTable()->containsColumn($this->getParameter('shallow_spidered_column'))) {
            $this->getTable()->addColumn(array(
                'name' => $this->getParameter('shallow_spidered_column'),
                'type' => 'TIMESTAMP'
            ));
        }

        if (!$this->getTable()->containsColumn($this->getParameter('touched_column'))) {
            $this->getTable()->addColumn(array(
                'name' => $this->getParameter('touched_column'),
                'type' => 'BOOLEAN',
            ));
        }

        if (!$this->getTable()->containsColumn($this->getParameter('id_column'))) {
            $this->getTable()->addColumn(array(
                'name' => $this->getParameter('id_column'),
                'type' => 'VARCHAR',
                'size' => $this->getParameter('id_size')
            ));
        }

        if (!$this->getTable()->containsColumn($this->getParameter('bookstore_type_column'))) {
            $this->getTable()->addColumn(array(
                'name' => $this->getParameter('bookstore_type_column'),
                'type' => 'VARCHAR',
                'size' => 32
            ));
        }
    }

    /**
     * Get the setter of one of the columns of the behavior
     * 
     * @param     string $column One of the behavior colums, 'create_column' or 'update_column'
     * @return    string The related setter, 'setCreatedOn' or 'setUpdatedOn'
     */
    protected function getColumnSetter($column)
    {
        return 'set' . $this->getColumnForParameter($column)->getPhpName();
    }

    protected function getColumnConstant($columnName, $builder)
    {
        return $builder->getColumnConstant($this->getColumnForParameter($columnName));
    }

    /**
     * Add code in ObjectBuilder::preInsert
     *
     * @return    string The code to put at the hook
     */
    public function preInsert($builder)
    {
        return "if (!\$this->isColumnModified(" . $this->getColumnConstant('spidered_column', $builder) . ")) {
            \$this->" . $this->getColumnSetter('spidered_column') . "(NULL);
    }";
    }

    public function objectMethods($builder)
    {
        return "
  
    /**
     * Set the spidered time to the current time
     *
     * @return     " . $builder->getStubObjectBuilder()->getClassname() . " The current object (for fluent API support)
     */
    public function setSpidered()
    {
        \$this->" .$this->getColumnSetter('spidered_column') . "(time());
        return \$this;
    }
    ";
    }

    public function queryMethods($builder)
    {
    }
}
