<?php namespace SchemaInfo\Builders;

use SchemaInfo\Schema;

interface TableInterface
{
	function __construct(Schema $schema, $name);
	
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
	 * @return Schema
	 */
	function getSchema();
	
	function getName();
}