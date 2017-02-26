<?php namespace SchemaInfo;

use SchemaInfo\Builders\BuilderInterface;

use Illuminate\Container\Container;
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
	protected $builder;
	
	/**
	 * @var SchemaInfoBuilderFactory
	 */
	protected $factory;
	
	/**
	 * @var string
	 */
	protected $cacheKey;
	
	/**
	 * @var Container
	 */
	protected $app;
	
	public function __construct(BuilderInterface $builder)
	{
		$this->builder = $builder;
		
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
