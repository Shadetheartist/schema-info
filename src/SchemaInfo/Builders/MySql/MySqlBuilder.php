<?php namespace SchemaInfo\Builders\MySql;

use SchemaInfo\Builders\BuilderInterface;
use SchemaInfo\Builders\TableInterface;
use SchemaInfo\Schema;
use Illuminate\Database\Connection;

class MySqlBuilder extends \Illuminate\Database\Schema\MySqlBuilder implements BuilderInterface
{
	//TODO: columns like / tables like
	
	/**
	 * @var MySqlGrammar
	 */
	protected $grammar;
	
	function __construct(Connection $connection)
	{
		$connection->setSchemaGrammar(new MySqlGrammar());
		
		parent::__construct($connection);
	}
	
	/**
	 * @param Schema $schema
	 * @param $table
	 * @return MySqlTable
	 */
	public function makeTable(Schema $schema, $table)
	{
		return new MySqlTable($schema, $table);
	}
	
	/**
	 * @param TableInterface $table
	 * @param $column
	 * @return MySqlColumn
	 */
	public function makeColumn(TableInterface $table, $column)
	{
		return new MySqlColumn($table, $column);
	}
	
	public function tableInfo($table)
	{
		$sql = $this->grammar->compileTableInfo();
		
		$database = $this->connection->getDatabaseName();
		
		$table = $this->connection->getTablePrefix() . $table;
		
		return $this->connection->select($sql, [$database, $table]);
	}
	
	public function columnsForTable($table)
	{
		$sql = $this->grammar->compileColumnsForTable();
		
		$database = $this->connection->getDatabaseName();
		
		$table = $this->connection->getTablePrefix() . $table;
		
		return $this->connection->select($sql, [$database, $table]);
	}
	
	public function columnNamesForTable($table)
	{
		$sql = $this->grammar->compileColumnNamesForTable();
		
		$database = $this->connection->getDatabaseName();
		
		$table = $this->connection->getTablePrefix() . $table;
		
		$result = $this->connection->select($sql, [$database, $table]);
		
		$array_map = array_map(
			function ($column)
			{
				return $column->column_name;
			},
			$result
		);
		
		return $array_map;
	}
	
	public function columnInfo($table, $column)
	{
		$sql = $this->grammar->compileColumnInfo();
		
		$database = $this->connection->getDatabaseName();
		
		$table = $this->connection->getTablePrefix() . $table;
		
		return $this->connection->select($sql, [$database, $table, $column]);
	}
	
}
