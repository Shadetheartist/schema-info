<?php namespace SchemaInfo\Builders;

use SchemaInfo\SchemaInfo;

abstract class Table implements TableInterface
{
	/**
	 * @var \Illuminate\Database\Schema\Builder
	 */
	protected $builder = null;
	
	/**
	 * @var SchemaInfo
	 */
	protected $schema = null;
	
	/**
	 * @var string
	 */
	protected $name = null;
	
	/**
	 * @var array
	 */
	protected $info = null;
	
	protected $columns          = [];
	
	protected $allColumnsCached = false;
	
	public function __construct(SchemaInfo $schema, $name)
	{
		$this->schema  = $schema;
		$this->name    = $name;
		$this->builder = $this->schema->getBuilder();
	}
	
	/**
	 * @return SchemaInfo|mixed
	 */
	public function getSchema()
	{
		return $this->schema;
	}
	
	/**
	 * @return null|string
	 */
	public function getName()
	{
		return $this->name;
	}
    
    /**
     * @param $column
     *
     * @return ColumnInterface|mixed
     */
	function column($column)
	{
		if (isset($this->columns[$column]) == false)
		{
			$this->columns[$column] = $this->builder->makeColumn($this, $column);
		}
		
		return $this->columns[$column];
	}
    
    /**
     * @param array $columns
     *
     * @return ColumnInterface[]|array
     */
	function columns($columns = [])
	{
	    if($this->allColumnsCached)
	    {
            return $this->columns;
        }
        
        if (count($columns) == 0)
        {
            $columns = $this->builder->columnNamesForTable($this->getName());
            $this->allColumnsCached = true;
        }
        
        foreach ($columns as $columnName)
        {
            $this->column($columnName);
        }
        
        return $this->columns;
	}
    
    /**
     * @return \stdClass
     * @throws \Exception
     */
	public function info()
	{
		if ($this->info === null)
		{
			$info = $this->builder->tableInfo($this->name);
			
			if (count($info) == false)
			{
				$name         = $this->name;
				$databaseName = $this->builder->getConnection()->getDatabaseName();
				throw new \Exception("No table [$name] exists in database [" . $databaseName . "]");
			}
			
			$this->info = reset($info);
		}
		
		return $this->info;
	}
    
    function exists()
    {
        if ($this->info === null)
        {
            $info = $this->builder->tableInfo($this->name);
            
            if (count($info) == false)
            {
                return false;
            }
            
            $this->info = reset($info);
        }
        
        return true;
    }
	
	function __get($propertyName)
	{
		return $this->column($propertyName);
	}
    
    function __toString()
    {
        return $this->getName();
    }
}
