<?php
/**
 * Schema
 */
class Schema
{
    public static function create($callback){
        $builder = new Builder();
        $callback($builder);

        return new static;
    }

    public static function alter($callback){
        $builder = new Builder();
        $callback($builder);

        return new static;
    }

    public static function add_key($key, $primary = true)
	{
        if($primary == true){
            $builder = new Builder();
            $builder->add_key($key, true);

            return new static;
        }
        
	}

    public static function dropIfExists($table){
        $builder = new Builder();
        $builder->dropIfExists($table);

        return new static;
    }

    public static function drop($table){
        $builder = new Builder();
        $builder->drop($table);

        return new static;
    }
}
