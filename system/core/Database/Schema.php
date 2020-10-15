<?php
/**
 * Schema
 */
class Schema
{
    public static function create($callback){
        $builder = new Builder();
        $callback($builder);
    }

    public static function dropIfExists($table){
        $builder = new Builder();
        $builder->dropIfExists($table);
    }
}
