<?php namespace SchemaInfo\Builders;

use SchemaInfo\SchemaInfo;

abstract class Table implements TableInterface
{
	/**
	 * @var \Illuminate\Database\Schema\Builder
	 */
	protected $builder = null;
	
	/**
	 * @var SchemaInfo
	 */
	protected $schema = null;
	
	/**
	 * @var string
	 */
	protected $name = null;
	
	/**
	 * @var array
	 */
	protected $info = null;
	
	protected $columns          = [];
	protected $allColumnsCached = false;
	
	public function __construct(SchemaInfo $schema, $name)
	{
		$this->schema  = $schema;
		$this->name    = $name;
		$this->builder = $this->schema->getBuilder();
	}
	
	/**
	 * @return SchemaInfo
	 */
	public function getSchema()
	{
		return $this->schema;
	}
	
	/**
	 * @return null
	 */
	public function getName()
	{
		return $this->name;
	}
	
	function column($column)
	{
		if (isset($this->columns[$column]) == false)
		{
			$this->columns[$column] = $this->builder->makeColumn($this, $column);
		}
		
		return $this->columns[$column];
	}
	
	function columns($columns = [])
	{
		if ($this->allColumnsCached)
		{
			return $this->columns;
		}
		
		if (count($columns))
		{
			$columnObjects = [];
			
			foreach ($columns as $column)
			{
				$columnObjects[] = $this->builder->makeColumn($this, $column);
			}
			
			return $columnObjects;
		}
		
		return $this->allColumns();
	}
	
	private function allColumns()
	{
		$columnNames = $this->builder->columnNamesForTable($this->getName());
		
		foreach ($columnNames as $columnName)
		{
			$this->column($columnName);
		}
		
		$this->allColumnsCached = true;
		
		return $this->columns;
	}
	
	public function info()
	{
		if ($this->info == null)
		{
			$info = $this->builder->tableInfo($this->name);
			
			if (count($info) == false)
			{
				$name         = $this->name;
				$databaseName = $this->builder->getConnection()->getDatabaseName();
				throw new \Exception("No table [$name] exists in database [" . $databaseName . "]");
			}
			$this->info = reset($info);
		}
		
		return $this->info;
	}
	
	function __get($propertyName)
	{
		return $this->column($propertyName);
	}
	
}
