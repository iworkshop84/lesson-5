<?php


class News
    extends AbstractModel
{
    public $news_id;
    public $news_name;
    public $news_content;
    public $news_date;

    protected static $table = 'news';
    protected static $class = 'News';

    public function newsAdd()
    {
        $db = new DB();
        $sql = "INSERT INTO ". static::$table ." (`news_name`, `news_content`, `news_date`)
        VALUES
         ('". $this->news_name ."', '". $this->news_content ."', NOW())";
        return $db->queryIns($sql);
    }



}
