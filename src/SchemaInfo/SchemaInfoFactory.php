<?php namespace SchemaInfo;

use Illuminate\Container\Container;
use Illuminate\Database\Connection;

class SchemaInfoFactory
{
	/**
	 * @var SchemaInfoBuilderFactory
	 */
	protected $factory;
	
	/**
	 * @var \Illuminate\Container\Container
	 */
	protected $app;
	
	public function __construct(Container $app, SchemaInfoBuilderFactory $factory)
	{
		$this->app = $app;
		
		$this->factory = $factory;
	}
	
	/**
	 * @param \Illuminate\Database\Connection|null $connection
	 * @return \SchemaInfo\SchemaInfo
	 */
	public function make(Connection $connection = null)
	{
		if ($connection === null)
		{
			$connection = $this->app['db.connection'];
		}
		
		$builder = $this->factory->make($connection);
		
		return new SchemaInfo($builder);
	}
    
    /**
     * @param $table
     *
     * @return Builders\TableInterface
     */
    public function table($table)
    {
        return $this->make()->table($table);
    }
}
