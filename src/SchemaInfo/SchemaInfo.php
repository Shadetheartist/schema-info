<?php namespace SchemaInfo;

use Grav\Database\SchemaInfo\GravMySqlTable;
use Illuminate\Container\Container;
use Illuminate\Database\Schema\Builder;
use SchemaInfo\Builders\BuilderInterface;
use SchemaInfo\Builders\TableInterface;

class SchemaInfo
{
    /**
     * @var array
     */
    protected static $cache = [];
    
    /**
     * @var BuilderInterface|Builder
     */
    protected $builder;
    
    /**
     * @var string
     */
    protected $cacheKey;
    
    /**
     * @var Container
     */
    protected $app;
    
    /**
     * @var bool
     */
    protected $allTablesCached;
    
    public function __construct(BuilderInterface $builder)
    {
        $this->builder = $builder;
        
        $this->cacheKey = $this->getBuilder()->getConnection()->getDatabaseName();
        
        self::$cache[$this->cacheKey] = [];
    }
    
    /**
     * @return BuilderInterface|Builder
     */
    public function getBuilder()
    {
        return $this->builder;
    }
    
    /**
     * @param $builder
     */
    public function setBuilder($builder)
    {
        $this->builder = $builder;
    }
    
    public function getCache()
    {
        return self::$cache[$this->cacheKey];
    }
    
    /**
     * @param $table
     *
     * @return Builders\TableInterface
     */
    public function table($table)
    {
        if (isset(self::$cache[$this->cacheKey][$table]) == false) {
            self::$cache[$this->cacheKey][$table] = $this->builder->makeTable($this, $table);
        }
        
        return self::$cache[$this->cacheKey][$table];
    }
    
    /**
     * @param string[] $tables
     *
     * @return Builders\TableInterface[]
     */
    public function tables($tables = [])
    {
        if ($this->allTablesCached) {
            return $this->getCache();
        }
        
        if (count($tables) == 0) {
            $tables                = $this->getBuilder()->tableNames();
            $this->allTablesCached = true;
        }
        
        foreach ($tables as $tableName) {
            $this->table($tableName);
        }
        
        return $this->getCache();
    }
    
    public function tablesLike($str)
    {
        if ($this->allTablesCached)
        {
            return array_filter(
                $this->getCache(),
                function (TableInterface $table) use ($str)
                {
                    return starts_with($table->getName(), $str);
                }
            );
        }
        
        $tableNames = $this->getBuilder()->tableNamesLike($str);
        
        $tables = [];
        foreach ($tableNames as $tableName)
        {
            $tables[] = $this->table($tableName);
        }
        
        return $tables;
    }
    
    function __get($name)
    {
        return $this->table($name);
    }
    
}
