<?php namespace SchemaInfo\Builders;

use SchemaInfo\Schema;

abstract class Table implements TableInterface
{
	
	/**
	 * Serves to shorten the amount of calls to $this->getSchema()->getBuilder()
	 * @var \Illuminate\Database\Schema\Builder
	 */
	protected $builder = null;
	
	/**
	 * @var Schema
	 */
	protected $schema = null;
	
	protected $name = null;
	
	public function __construct(Schema $schema, $name)
	{
		$this->schema  = $schema;
		$this->name    = $name;
		$this->builder = $this->schema->getBuilder();
	}
	
	/**
	 * @return Schema
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
		return $this->builder->makeColumn($this, $column);
	}
	
	function columns()
	{
		$columns = [];
		
		$columnNames = $this->builder->columnNamesForTable($this->getName());
		
		foreach ($columnNames as $columnName)
		{
			$columns[] = $this->builder->makeColumn($this, $columnName);
		}
		
		return $columns;
	}
	
	public function info()
	{
		$info = $this->builder->tableInfo($this->name);
		
		if (count($info) == false)
		{
			$name         = $this->name;
			$databaseName = $this->builder->getConnection()->getDatabaseName();
			throw new \Exception("No table [$name] exists in database [" . $databaseName . "]");
		}
		
		return reset($info);
	}
	
	function __get($propertyName)
	{
		$info = $this->info();
		
		if (property_exists($info, $propertyName) == false)
		{
			throw new \Exception("No property [$propertyName] exists for table [" . $this->name . "]");
		}
		
		return $info->$propertyName;
	}
	
}
