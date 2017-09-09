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
        $arr = get_object_vars($this);

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
        return $db->execute($sql, $ins);
    }


    public function update()
    {

        // чистим всё лишнее из массива
        $arr = get_object_vars($this);

        function clean($data){
            return (($data != null) && (!is_array($data)));
        }
        $arr = (array_filter($arr, "clean"));

        // делаем массив для подготовленного выражения
        $ins =[];
        foreach ($arr as $key=>$val){
            $ins[':' . $key] = $val;
        }
        //var_dump($arr);
        //var_dump($ins);

        $ins1 =[];
        foreach ($arr as $key=>$val){
            $ins1[$key] = $key .' = :' . $key;
        }

        //var_dump($ins1);
        $where = array_shift($ins1);

        $sql = 'UPDATE '. static::$table .' 
        SET
        '. implode(', ', ($ins1)) .'
        WHERE 
        ('. $where .')';

        //var_dump($sql);
       // die;
        $db = new DB();
        return $db->execute($sql, $ins);
    }

}
