<?php


class DB{

    private $dbh;
    private $className='stdClass';

    public function __construct()
    {
       try{
       $this->dbh = new PDO('mysql:dbname=mysite;host=localhost', 'root', '');
       $this->dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
       } catch (DOException $exc){
           throw new PDOException ();
       }
    }

    public function setClassName($className)
    {
        $this->className = $className;
    }

    public function query($sql, $params=[]){

        $sth = $this->dbh->prepare($sql);
        $sth->execute($params);
        return $sth->fetchAll(PDO::FETCH_CLASS, $this->className);
    }

    public function execute($sql, $params=[]){

        $sth = $this->dbh->prepare($sql);
        return $sth->execute($params);

    }

    public function lastInsId()
    {
        return $this->dbh->lastInsertId();
    }

}