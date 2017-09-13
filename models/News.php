<?php
namespace App\Models;


use App\Models\AbstractM;
use App\Classes\DB;
/**
 * Class News
 * @property $news_id
 * @property $news_name
 * @property $news_content
 * @property $news_date
 */

class News
    extends AbstractM
{
    protected static $table = 'news';

/*
    public $news_id;
    public $news_name;
    public $news_content;
    public $news_date;
*/
    public static function findNewsByDate()
    {
        $class = get_called_class();
        $sql = 'SELECT * FROM '. static::$table .' ORDER BY news_date DESC';
        $db = new DB;
        $db->setClassName($class);
        return $db->query($sql);
    }

}