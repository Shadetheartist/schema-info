<?php namespace SchemaInfo;

use Illuminate\Support\ServiceProvider;

class SchemaInfoServiceProvider extends ServiceProvider
{
	function register(){
		
		$this->app->singleton('schema-info.builder.factory', function ($app) {
			return new SchemaInfoBuilderFactory($app);
		});
		
		$this->app->singleton('schema-info', function ($app) {
			return new SchemaInfoFactory($app, $app['schema-info.builder.factory']);
		});
	}
}
