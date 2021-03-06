<?php namespace SchemaInfo\Builders\MySql;

use SchemaInfo\Builders\BuilderInterface;
use SchemaInfo\Builders\TableInterface;
use SchemaInfo\SchemaInfo;
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
	 * @param SchemaInfo $schema
	 * @param $table
	 * @return MySqlTable
	 */
	public function makeTable(SchemaInfo $schema, $table)
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
    
    public function tableNames()
    {
        $sql = $this->grammar->compileTableNamesForSchema();
    
        $database = $this->connection->getDatabaseName();
    
        $result = $this->connection->select($sql, [$database]);
    
        $tableNames = array_map(
            function ($table)
            {
                return $table->table_name;
            },
            $result
        );
    
        return $tableNames;
    }
    
    public function tableNamesLike($str)
    {
        $sql = $this->grammar->compileTableNamesLikeForSchema();
        
        $database = $this->connection->getDatabaseName();
        
        $result = $this->connection->select($sql, [$database, $str . '%']);
        
        $tableNames = array_map(
            function ($table)
            {
                return $table->table_name;
            },
            $result
        );
    
        return $tableNames;
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
		
		$columnNames = array_map(
			function ($column)
			{
				return $column->column_name;
			},
			$result
		);
		
		return $columnNames;
	}
	
	public function columnInfo($table, $column)
	{
		$sql = $this->grammar->compileColumnInfo();
		
		$database = $this->connection->getDatabaseName();
		
		$table = $this->connection->getTablePrefix() . $table;
		
		return $this->connection->select($sql, [$database, $table, $column]);
	}
	
}
