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


    public static function findAllInColumn($column, $value)
    {
        $class = get_called_class();
        $sql = 'SELECT * FROM '. static::$table . ' WHERE '. $column .'=:val';
        $db = new DB;

        $db->setClassName($class);
        return $db->query($sql, [':val' => $value]);
    }


    public static function findOneInColumn($column, $value)
    {
        $class = get_called_class();
        $sql = 'SELECT * FROM '. static::$table . ' WHERE '. $column .'=:val';
        $db = new DB;

        $db->setClassName($class);
        return $db->query($sql, [':val' => $value])[0];
    }


    public function insert()
    {
        // получаю все свойства объекта в виде массива с ключами\значениями
        $arr = get_object_vars($this);

        // вычистил массив от пустых значений используя проверку по null
        function clean($data){
            return (($data != null) && (!is_array($data)));
        }
        $arr = (array_filter($arr, "clean"));

        $ins =[];
        foreach ($arr as $key=>$val){
            $ins[':' . $key] = $val;
        }

        $sql = 'INSERT INTO '. static::$table .' ('. implode(', ', array_keys($arr)) .') 
        VALUES 
        ('. implode(', ', array_keys($ins)) .')';

        $db = new DB();
        $db->execute($sql, $ins);


    }

}
