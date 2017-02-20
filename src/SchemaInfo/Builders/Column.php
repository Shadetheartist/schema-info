<?php namespace SchemaInfo\Builders;

abstract class Column
{
	/**
	 * Serves to shorten the amount of calls to $this->table->getSchema()->getBuilder()
	 * @var BuilderInterface|\Illuminate\Database\Schema\Builder|null
	 */
	protected $builder = null;
	protected $table   = null;
	protected $name    = null;
	protected $info    = null;
	
	public function __construct(TableInterface $table, $name)
	{
		$this->table   = $table;
		$this->name    = $name;
		$this->builder = $table->getSchema()->getBuilder();
	}
	
	public function info()
	{
		if ($this->info == null)
		{
			$info = $this->builder->columnInfo($this->table->getName(), $this->name);
			
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
		$info = $this->info();
		
		if (property_exists($info, $propertyName) == false)
		{
			throw new \Exception("No property [$propertyName] exists for column [" . $this->name . "]");
		}
		
		return $info->$propertyName;
	}
}
