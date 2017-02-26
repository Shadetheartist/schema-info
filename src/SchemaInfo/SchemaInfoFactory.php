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
	 * @var Container
	 */
	protected $app;
	
	public function __construct(Container $app, SchemaInfoBuilderFactory $factory)
	{
		$this->app = $app;
		
		$this->factory = $factory;
	}
	
	public function make(Connection $connection = null)
	{
		if ($connection === null)
		{
			$connection = $this->app['db.connection'];
		}
		
		$builder = $this->factory->make($connection);
		
		return new Schema($builder);
	}
}
