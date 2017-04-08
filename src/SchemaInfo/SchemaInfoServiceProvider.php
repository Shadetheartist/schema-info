<?php namespace SchemaInfo;

use Grav\Foundation\Application;
use Illuminate\Support\ServiceProvider;
use SchemaInfo\Builders\BuilderInterface;
use SchemaInfo\Builders\MySql\MySqlBuilder;
use SchemaInfo\Contracts\ISchemaInfo;

class SchemaInfoServiceProvider extends ServiceProvider
{
    protected $defer = true;
    
    function register()
    {
        $this->app->bind('schema-info.builder.MySqlConnection', MySqlBuilder::class);
        
        $this->app->bind(
            BuilderInterface::class,
            function (Application $app, $params) {
                
                if (isset($params['connection'])) {
                    $connection = $params['connection'];
                } else {
                    $connection = $app->make('db.connection');
                }
                
                $connectionClassName = class_basename($connection);
                
                $class = $this->app->make("schema-info.builder.$connectionClassName", [$connection]);
                
                return $class;
            }
        );
    
        $this->app->singleton(ISchemaInfo::class, SchemaInfo::class);
    }
    
    public function provides()
    {
        return [ISchemaInfo::class, BuilderInterface::class, MySqlBuilder::class];
    }
}
