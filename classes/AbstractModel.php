<?php


abstract class AbstractModel
    implements IModel
{
    protected static $table;
    protected static $class;

    public static function getAll()
    {
        $db = new DB();
        return $db->queryAll('SELECT * FROM ' . static::$table . ' ORDER BY ' . static::$table . '_date DESC' , static::$class);
    }

    public static function getOne($id)
    {
        $db = new DB();
        $sql = 'SELECT * FROM '. static::$table .' WHERE ' . static::$table . '_id='. $id;
        return $db->queryOne($sql, static::$class);
    }

}