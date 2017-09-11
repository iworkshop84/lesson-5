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


    public function __isset($name)
    {
       return isset($this->data[$name]);
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
        $res = $db->query($sql, [':val' => $value])[0];
        if(empty($res))
        {
            throw new ModelException ('Извините, такой статьи на сайте нет');
        }
        return $res;
    }


    public function insert()
    {
        $arr = $this->data;

        $ins =[];
        foreach ($arr as $key=>$val){
            $ins[':' . $key] = $val;
        }

        $sql = 'INSERT INTO '. static::$table .' ('. implode(', ', array_keys($arr)) .') 
        VALUES 
        ('. implode(', ', array_keys($ins)) .')';

        $db = new DB();
        $db->execute($sql, $ins);
        return $db->lastInsId();
    }


    public function update()
    {
        $arr = $this->data;

        // делаем массив для подготовленного выражения
        $ins =[];
        $rools =[];
        foreach ($arr as $key=>$val){
            $ins[':' . $key] = $val;
            $rools[$key] = $key .' = :' . $key;
        }

        // Удаляем из массива условий ключ id(он у нас всегда будет идти в свойствах первый)
        $where = array_shift($rools);


        $sql = 'UPDATE '. static::$table .' 
        SET
        '. implode(', ', ($rools)) .'
        WHERE 
        ('. $where .')';


        $db = new DB();
        return $db->execute($sql, $ins);

    }


    public function delete()
    {
        $arr = $this->data;

        $ins =[];
        $where =[];
        foreach ($arr as $key=>$val){
            $ins[':' . $key] = $val;
            $where[$key] = $key .' = :' . $key;
        }

        $sql = 'DELETE FROM '. static::$table .' 
        WHERE 
        ('. implode(', ', ($where)) .')';

        $db = new DB();
        $db->execute($sql, $ins);
    }

    public function save(){
        if(isset($this->news_id)){
           return $this->update();
        }else{
          return  $this->insert();
        }
    }












/* Оставил код для работы с именованными свойствами класса - на случай если пригодится.
    public function insert()
    {
        var_dump($this->data);
        die;

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
        // Делаем массив для условий
        $ins1 =[];
        foreach ($arr as $key=>$val){
            $ins1[$key] = $key .' = :' . $key;
        }
        // Удаляем из массива условий ключ id(он у нас всегда будет идти в свойствах первый)
        $where = array_shift($ins1);

        $sql = 'UPDATE '. static::$table .'
        SET
        '. implode(', ', ($ins1)) .'
        WHERE
        ('. $where .')';

        $db = new DB();
        return $db->execute($sql, $ins);
    }



    public function delete()
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

        $ins1 =[];
        foreach ($arr as $key=>$val){
            $ins1[$key] = $key .' = :' . $key;
        }

        $sql = 'DELETE FROM '. static::$table .'
        WHERE
        ('. implode(', ', ($ins1)) .')';

        $db = new DB();
        $db->execute($sql, $ins);
    }
*/












}
