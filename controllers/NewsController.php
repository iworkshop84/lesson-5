<?php


class NewsController
{

    public function actionAll()
    {

        $items = NewsModel::findAll();
       // var_dump($items);die;

        $view = new View();
        $view->items = $items;
        $view->display('news/all.php');
    }

    public function actionOne()
    {
        $id = $_GET['id'];
        $item = NewsModel::findOneInColumn('news_id', $id);

        $view = new View();
        $view->items = $item;
        $view->display('news/one.php');

    }
}