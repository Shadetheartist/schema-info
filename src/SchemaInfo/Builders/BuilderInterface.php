<?php namespace SchemaInfo\Builders;

use SchemaInfo\Schema;
use Illuminate\Database\Connection;

interface BuilderInterface
{
	function __construct(Connection $connection);
	
	/**
	 * @param Schema $schema
	 * @param $table
	 * @return TableInterface
	 */
	public function makeTable(Schema $schema, $table);
	
	/**
	 * @param TableInterface $table
	 * @param $column
	 * @return ColumnInterface
	 */
	public function makeColumn(TableInterface $table, $column);
	
	public function tableInfo($table);
	
	public function columnsForTable($table);
	
	public function columnNamesForTable($table);

	public function columnInfo($table, $column);
}