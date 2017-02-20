<?php namespace SchemaInfo;

use SchemaInfo\Builders\BuilderInterface;
use Illuminate\Database\Connection;
use Illuminate\Database\Schema\Builder;

class Schema
{
	/**
	 * @var array
	 */
	protected static $cache = [];
	
	/**
	 * @var BuilderInterface|Builder
	 */
	protected $builder = null;
	
	/**
	 * @var SchemaInfoFactory
	 */
	protected $factory = null;
	
	/**
	 * @var string
	 */
	protected $cacheKey = null;
	
	public function __construct(Connection $connection = null, SchemaInfoFactory $factory = null)
	{
		if ($connection === null)
		{
			$connection = app('db')->connection();
		}
		
		if ($factory === null)
		{
			$factory = new SchemaInfoFactory();
		}
		
		$this->factory = $factory;
		
		$this->builder = $this->factory->makeBuilder($connection);
		
		$this->cacheKey = $this->getBuilder()->getConnection()->getDatabaseName();
		
		self::$cache[$this->cacheKey] = [];
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
	
	public function getCache()
	{
		return self::$cache[$this->cacheKey];
	}
	
	/**
	 * @param $table
	 * @return Builders\TableInterface
	 */
	public function table($table)
	{
		if (isset(self::$cache[$this->cacheKey][$table]) == false)
		{
			self::$cache[$this->cacheKey][$table] = $this->builder->makeTable($this, $table);
		}
		
		return self::$cache[$this->cacheKey][$table];
	}
	
	function __get($name)
	{
		return $this->table($name);
	}
	
}
