<?php namespace SchemaInfo;

use Illuminate\Container\Container;
use SchemaInfo\Builders\BuilderInterface;
use SchemaInfo\Builders\MySql\MySqlBuilder;
use Illuminate\Database\Connection;
use Illuminate\Database\MySqlConnection;

class SchemaInfoBuilderFactory
{
	/**
	 * @var Container
	 */
	protected $app;
	
	/**
	 * SchemaInfoFactory constructor.
	 * @param Container $app
	 */
	function __construct(Container $app)
	{
		$this->app = $app;
	}
	
	/**
	 * @param Connection $connection
	 * @return BuilderInterface
	 * @throws \Exception
	 */
	function make(Connection $connection)
	{
		//for later customization via injection
		$class = (new \ReflectionClass($connection))->getShortName();
		
		if ($this->app->bound($key = "schema-info.builder.$class"))
		{
			return $this->app->make($key);
		}
		
		if ($connection instanceof MySqlConnection)
		{
			return new MySqlBuilder($connection);
		}
		
		throw new \Exception(
			'Could not map connection of type [' . get_class($connection) . '] to a valid Schema Builder Connection.'
		);
	}
	
}
