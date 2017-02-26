<?php namespace SchemaInfo\Facades;

use Illuminate\Support\Facades\Facade;
use SchemaInfo\Schema;

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
	
	/**
	 * Intellisense helper!
	 * @return Schema
	 */
	public static function make(){}
}
