<?php namespace SchemaInfo\Builders;

interface ColumnInterface
{
	function __construct(TableInterface $schema, $name);
	function info();

	/**
	 * @return TableInterface
	 */
	function getTable();
	function getName();
}