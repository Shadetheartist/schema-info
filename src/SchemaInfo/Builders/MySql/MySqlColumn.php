<?php namespace SchemaInfo\Builders\MySql;

use SchemaInfo\Builders\Column;

class MySqlColumn extends Column
{
	public function getTableCatalog()
	{
		return $this->info()->TABLE_CATALOG;
	}
	
	public function getTableSchema()
	{
		return $this->info()->TABLE_SCHEMA;
	}
	
	public function getTableName()
	{
		return $this->info()->TABLE_NAME;
	}
	
	public function getColumnName()
	{
		return $this->info()->COLUMN_NAME;
	}
	
	public function getOrdinalPosition()
	{
		return $this->info()->ORDINAL_POSITION;
	}
	
	public function getColumnDefault()
	{
		return $this->info()->COLUMN_DEFAULT;
	}
	
	public function getIsNullable()
	{
		return $this->info()->IS_NULLABLE;
	}
	
	public function getDataType()
	{
		return $this->info()->DATA_TYPE;
	}
	
	public function getCharacterMaximumLength()
	{
		return $this->info()->CHARACTER_MAXIMUM_LENGTH;
	}
	
	public function getCharacterOctetLength()
	{
		return $this->info()->CHARACTER_OCTET_LENGTH;
	}
	
	public function getNumericPrecision()
	{
		return $this->info()->NUMERIC_PRECISION;
	}
	
	public function getNumericScale()
	{
		return $this->info()->NUMERIC_SCALE;
	}
	
	public function getDatetimePrecision()
	{
		return $this->info()->DATETIME_PRECISION;
	}
	
	public function getCharacterSetName()
	{
		return $this->info()->CHARACTER_SET_NAME;
	}
	
	public function getCollationName()
	{
		return $this->info()->COLLATION_NAME;
	}
	
	public function getColumnType()
	{
		return $this->info()->COLUMN_TYPE;
	}
	
	public function getColumnKey()
	{
		return $this->info()->COLUMN_KEY;
	}
	
	public function getExtra()
	{
		return $this->info()->EXTRA;
	}
	
	public function getPrivileges()
	{
		return $this->info()->PRIVILEGES;
	}
	
	public function getColumnComment()
	{
		return $this->info()->COLUMN_COMMENT;
	}
}
