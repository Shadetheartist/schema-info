<?php namespace SchemaInfo\Builders\MySql;

use SchemaInfo\Builders\Table;

class MySqlTable extends Table
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
	
	public function getTableType()
	{
		return $this->info()->TABLE_TYPE;
	}
	
	public function getEngine()
	{
		return $this->info()->ENGINE;
	}
	
	public function getVersion()
	{
		return $this->info()->VERSION;
	}
	
	public function getRowFormat()
	{
		return $this->info()->ROW_FORMAT;
	}
	
	public function getTableRows()
	{
		return $this->info()->TABLE_ROWS;
	}
	
	public function getAvgRowLength()
	{
		return $this->info()->AVG_ROW_LENGTH;
	}
	
	public function getDataLength()
	{
		return $this->info()->DATA_LENGTH;
	}
	
	public function getMaxDataLength()
	{
		return $this->info()->MAX_DATA_LENGTH;
	}
	
	public function getIndexLength()
	{
		return $this->info()->INDEX_LENGTH;
	}
	
	public function getDataFree()
	{
		return $this->info()->DATA_FREE;
	}
	
	public function getAutoIncrement()
	{
		return $this->info()->AUTO_INCREMENT;
	}
	
	public function getCreateTime()
	{
		return $this->info()->CREATE_TIME;
	}
	
	public function getUpdateTime()
	{
		return $this->info()->UPDATE_TIME;
	}
	
	public function getCheckTime()
	{
		return $this->info()->CHECK_TIME;
	}
	
	public function getTableCollation()
	{
		return $this->info()->TABLE_COLLATION;
	}
	
	public function getChecksum()
	{
		return $this->info()->CHECKSUM;
	}
	
	public function getCreateOptions()
	{
		return $this->info()->CREATE_OPTIONS;
	}
	
	public function getTableComment()
	{
		return $this->info()->TABLE_COMMENT;
	}
}
