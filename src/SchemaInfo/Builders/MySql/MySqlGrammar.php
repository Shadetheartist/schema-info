<?php namespace SchemaInfo\Builders\MySql;

class MySqlGrammar extends \Illuminate\Database\Schema\Grammars\MySqlGrammar
{
    function compileTableNamesForSchema()
    {
        return 'select table_name from information_schema.tables where table_schema = ?';
    }
    
    function compileTableNamesLikeForSchema()
    {
        return 'select table_name from information_schema.tables where table_schema = ? and table_name like ?';
    }
    
    function compileTableInfo()
    {
        return 'select * from information_schema.tables where table_schema = ?  and table_name = ?';
    }
    
    function compileColumnsForTable()
    {
        return 'select * from information_schema.columns where table_schema = ? and table_name = ?';
    }
    
    function compileColumnNamesForTable()
    {
        return 'select column_name from information_schema.columns where table_schema = ? and table_name = ?';
    }
    
    function compileColumnInfo()
    {
        return 'select * from information_schema.columns where table_schema = ? and table_name = ? and column_name = ?';
    }
}
