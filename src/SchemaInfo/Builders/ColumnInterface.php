<?php namespace SchemaInfo\Builders;

interface ColumnInterface
{
	function __construct(TableInterface $schema, $name);
	
	function info();
	
	/**
	 * @return TableInterface
	 */
	function getTable();
    
    /**
     * @return string
     */
    function getName();
    
    /**
     * @return string
     */
    function getIdentifier();
}