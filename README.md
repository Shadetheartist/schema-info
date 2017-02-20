# shadetheartist/schema-info
A utility class intended to help interface with a databases' schema information in an efficient manner.

## Examples

### General Usage

#### Creating a New Schema Instance

```php
<?php namespace App;

use SchemaInfo\Schema;

class Example
{
    public function example()
    {
        $schema = new Schema();
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

``