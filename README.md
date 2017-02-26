# shadetheartist/schema-info
A utility class intended to help interface with a databases' schema information in an efficient manner.

## Setting Up

Firstly add the schema-info dependency to your projects composer file

*composer.json*
```json
"require": {
    ...,
    "shadetheartist/schema-info": "1.0.0"
}
```

In your terminal run `composer dump-autoload`.

___

Secondly add the SchemaInfo service provider and facade to your projects' bootstrapping procedure via

*config/app.php*

```php
'providers' => [
    ...,
    SchemaInfo\SchemaInfoServiceProvider::class,
]

...

'aliases' => [
    ...,
    'SchemaInfo' => SchemaInfo\Facades\SchemaInfo::class,
]
```

**And you're set!**

## Examples

### General Usage

#### Creating a New Schema Instance

```php
<?php namespace App;

use SchemaInfo\Facades\SchemaInfo;

class Example
{
    public function example()
    {
        $schema = SchemaInfo::make();
    }
   
    public function exampleAltConnection()
    {
    	//connect to a different database. note: only mysql databases are currently supported.
        $schema = SchemaInfo::make(\DB::connection('my-alternative-connection'));
    }
}
```


#### Table Usage

```php
$table = $schema->table('my_table_name');

//returns a stdClass instance refecting a record from the schema info of your database.
$info = $table->info();
```


#### Retrieving a Column

```php
$table = $schema->table('my_table_name');

$column = $table->column('my_column_name');

$allColumns = $table->columns();
```


#### Column Usage

```php
$column = $table->column('my_column_name');

//returns a stdClass instance refecting a record from the schema info of your database.
$column->info();

//get the table the column belongs to.
$parentTable = $column->table();
```
