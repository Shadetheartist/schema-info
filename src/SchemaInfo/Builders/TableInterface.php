<?php namespace SchemaInfo\Builders;

use SchemaInfo\SchemaInfo;

interface TableInterface
{
	function __construct(SchemaInfo $schema, $name);
	
	function info();
	
	/**
	 * @param $column
	 * @return ColumnInterface
	 */
	function column($column);
	
	/**
	 * @return ColumnInterface[]
	 */
	function columns();
	
	/**
	 * @return SchemaInfo
	 */
	function getSchema();
    
    function getName();
    
    function getIdentifier();
}