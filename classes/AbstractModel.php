<?php


abstract class AbstractModel{

    protected static $table;

    protected $data = [];

    public function __set($k, $v)
    {
        $this->data[$k] = $v;
    }

    public function __get($k)
    {
        return $this->data[$k];
    }

    public static function findAll()
    {
        $class = get_called_class();
        $sql = 'SELECT * FROM '. static::$table;
        $db = new DB;
        $db->setClassName($class);
        return $db->query($sql);
    }

    public static function findOneById($id)
    {
        $class = get_called_class();
        $sql = 'SELECT * FROM '. static::$table . ' WHERE news_id=:id';
        $db = new DB;
        $db->setClassName($class);
        return $db->query($sql, [':id' => $id])[0];
    }

    public function insert()
    {
        return $cols = array_keys($this->data);

       /* $sql = 'INSERT INTO ' . static::$table . '
        ('.implode(', ', $cols) .') 
        VALUES ()';
       */
    }

}
