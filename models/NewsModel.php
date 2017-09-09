<?php

/**
 * Class NewsModel
 * @property $news_id
 * @property $news_name
 * @property $news_content
 * @property $news_date
 */
class NewsModel
    extends AbstractModel
{
    protected static $table = 'news';


    public $news_id;
    public $news_name;
    public $news_content;
    public $news_date;

    public static function findNewsByDate()
    {
        $class = get_called_class();
        $sql = 'SELECT * FROM '. static::$table .' ORDER BY news_date DESC';
        $db = new DB;
        $db->setClassName($class);
        return $db->query($sql);
    }

}