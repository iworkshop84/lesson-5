<?php


class NewsController
{

    public function actionAll()
    {

        $items = NewsModel::findNewsByDate();

        $view = new View();
        $view->items = $items;
        $view->display('news/all.php');
    }

    public function actionOne()
    {
        $id = $_GET['id'];
        $item = NewsModel::findOneInColumn('news_id', $id);
        if(empty($item))
        {
            throw new ModelException ('Запись не найдена', 1);
        }

        $view = new View();
        $view->items = $item;
        $view->display('news/one.php');

    }
}