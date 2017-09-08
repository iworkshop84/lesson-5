<?php


class DB{

    public function __construct()
    {
        $this->mysqli = new mysqli("localhost", "root", "", "mysite");

    }

    public function queryAll($sql, $class_name = "stdClass")
    {
        $res = $this->mysqli->query($sql);
        if(false === $res)
        {
            return false;
        }
        $ret =[];
        while ($row = $res->fetch_object($class_name))
        {
            $ret[] = $row;
        }
        return $ret;
    }

    public function queryOne($sql, $class_name = "stdClass")
    {
        return $this->queryAll($sql, $class_name)[0];
    }


    public function queryIns($sql)
    {
        $res = $this->mysqli->query($sql);
        if(false === $res)
        {
            return false;
        }
        return $res;
    }

}