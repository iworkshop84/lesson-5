<?php

namespace App\Controllers;

use App\Models\ExceptionM;
use App\Models\News as NewsModel;
use App\Classes\View;

class News
{

    public function actionAll()
    {

        $items = NewsModel::findNewsByDate();

        $view = new View();
        $view->items = $items;
        $view->display('news/all.php');
    }

    public function actionOne($id=null)
    {

        $item = NewsModel::findOneInColumn('news_id', $id);
        if(empty($item))
        {
            throw new ExceptionM ('Запись не найдена', 1);
        }

        $view = new View();
        $view->items = $item;
        $view->display('news/one.php');

    }
}