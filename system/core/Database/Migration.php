<?php
/**
 * Migration
 */

abstract class Migration
{
    protected $connection;

    public function getConnection()
    {
        return $this->connection;
    }
}

