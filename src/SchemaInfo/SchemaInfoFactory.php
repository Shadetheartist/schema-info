<?php namespace SchemaInfo;

use Illuminate\Container\Container;
use SchemaInfo\Builders\MySql\MySqlBuilder;
use Illuminate\Database\Connection;
use Illuminate\Database\MySqlConnection;

class SchemaInfoFactory
{
	public function makeBuilder(Container $app, Connection $connection)
	{
		//for later customization via injection
		$class = (new \ReflectionClass($connection))->getShortName();
		
		if ($app->bound($key = "schemaInfo.builder.$class"))
		{
			return $app->make($key);
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
