<?php namespace SchemaInfo\Builders;

use SchemaInfo\SchemaInfo;

interface BuilderInterface
{
    /**
     * @param SchemaInfo $schema
     * @param            $table
     *
     * @return TableInterface
     */
    public function makeTable(SchemaInfo $schema, $table);
    
    /**
     * @param TableInterface $table
     * @param                $column
     *
     * @return ColumnInterface
     */
    public function makeColumn(TableInterface $table, $column);
    
    public function tableInfo($table);
    
    public function tableNames();
    
    public function tableNamesLike($str);
    
    public function columnsForTable($table);
    
    public function columnNamesForTable($table);
    
    public function columnInfo($table, $column);
    
}
