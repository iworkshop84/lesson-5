<?php


class NewsController
{

    public function actionAll()
    {
        $items = News::getAll();

        $view = new View();
        $view->items = $items;
        $view->display('news/all.php');


    }

    public function actionOne()
    {
        $id = $_GET['id'];
        $item = News::getOne($id);

        $view = new View();
        $view->items = $item;
        $view->display('news/one.php');

    }
}