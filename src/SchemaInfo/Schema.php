<?php namespace SchemaInfo;

use SchemaInfo\Builders\BuilderInterface;
use Illuminate\Database\Connection;
use Illuminate\Database\Schema\Builder;

class Schema
{
	/**
	 * @var BuilderInterface|Builder
	 */
	protected $builder = null;
	protected $factory = null;
	
	public function __construct(Connection $connection = null, SchemaInfoFactory $factory = null)
	{
		if ($connection === null)
		{
			$connection = \DB::connection();
		}
		
		if ($factory === null)
		{
			$factory = new SchemaInfoFactory();
		}
		
		$this->factory = $factory;
		
		$this->builder = $this->factory->makeBuilder($connection);
	}
	
	/**
	 * @return BuilderInterface|Builder
	 */
	public function getBuilder()
	{
		return $this->builder;
	}
	
	/**
	 * @param $builder
	 */
	public function setBuilder($builder)
	{
		$this->builder = $builder;
	}
	
	/**
	 * @param $table
	 * @return Builders\TableInterface
	 */
	public function table($table)
	{
		return $this->builder->makeTable($this, $table);
	}
	
	function __get($name)
	{
		return $this->table($name);
	}
	
}
