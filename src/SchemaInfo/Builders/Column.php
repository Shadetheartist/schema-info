<?php namespace SchemaInfo\Builders;

abstract class Column implements ColumnInterface
{
	/**
	 * @var BuilderInterface|\Illuminate\Database\Schema\Builder|null $builder
	 */
	protected $builder = null;
	
	/**
	 * @var TableInterface
	 */
	protected $table = null;
	
	/**
	 * @var string
	 */
	protected $name = null;
	
	/**
	 * @var array
	 */
	protected $info = null;
	
	public function __construct(TableInterface $table, $name)
	{
		$this->table   = $table;
		$this->name    = $name;
		
		//caching this field for it is used extensively
		$this->builder = $table->getSchema()->getBuilder();
	}
	
	/**
	 * @return \Illuminate\Database\Schema\Builder|null|BuilderInterface
	 */
	public function getBuilder()
	{
		return $this->builder;
	}
	
	/**
	 * @return TableInterface
	 */
	public function getTable()
	{
		return $this->table;
	}
	
	/**
	 * @return string
	 */
	public function getName()
	{
		return $this->name;
	}
	
	/**
	 * @return null|\stdClass
	 * @throws \Exception
	 */
	public function info()
	{
		if ($this->info == null)
		{
			$info = $this->builder->columnInfo($this->table->getName(), $this->name);
			
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
            $info = $this->builder->columnInfo($this->table->getName(), $this->name);
            
            if (count($info) == false)
            {
                return false;
            }
            
            $this->info = reset($info);
        }
        
        return true;
    }
    
    function __toString()
    {
        return $this->getName();
    }
}
