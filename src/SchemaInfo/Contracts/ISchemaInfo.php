<?php namespace SchemaInfo\Contracts;

use SchemaInfo\Builders\BuilderInterface;

interface ISchemaInfo
{
    function __construct(BuilderInterface $builder);
    
    /**
     * @return BuilderInterface
     */
    public function getBuilder();
    
    public function table($table);
    
    public function tables($tables = []);
    
    public function tablesLike($str);
    
}
