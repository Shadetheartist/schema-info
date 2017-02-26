<?php namespace SchemaInfo\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \SchemaInfo\SchemaInfoFactory
 */
class SchemaInfo extends Facade
{
	/**
	 * Get the registered name of the component.
	 *
	 * @return string
	 */
	protected static function getFacadeAccessor()
	{
		return 'schema-info';
	}
	
}
