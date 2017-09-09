<?php


class AdminController
{
    public function actionAdd()
    {
        if(isset($_POST['addnews'])){

            $post = new NewsModel();

            if(!empty($_POST['name'])){
                $post->news_name = $_POST['name'];
            }

            if(!empty($_POST['content'])){
                $post->news_content = $_POST['content'];
            }

            if(isset($post->news_name) && isset($post->news_content)){
                $post->news_date = date("Y-m-d H:i:s");

                $res_id = $post->insert();
                $post->news_id = $res_id;


                header('Location: /Admin/Edit/' . $post->news_id);
                exit;
            }
        }


        $view = new View();
        $view->display('news/add.php');
    }


    public function actionEdit()
    {
        $id = $_GET['id'];
        $myitem = NewsModel::findOneInColumn('news_id', $id);


        if(isset($_POST['editnews']))
        {
            $post = new NewsModel();

            if(!empty($_POST['name'])){
                $post->news_name = $_POST['name'];
            }

            if(!empty($_POST['content'])){
                $post->news_content = $_POST['content'];
            }

            if(isset($_GET['id'])){
                $post->news_id = $_GET['id'];

            }

            if(isset($post->news_name) && isset($post->news_content)&& isset($post->news_id))
            {
                $post->update();
                header('Location: /Admin/Edit/' . $post->news_id);
                exit;
            }
        }


        if(isset($_POST['dellnews']))
        {
            if(isset($_GET['id'])){
                $post = new NewsModel();
                $post->news_id = $_GET['id'];
                $post->delete();
                header('Location: /Admin/Edit/');
                exit;
            }
        }


        $items = NewsModel::findNewsByDate();
        $view = new View();
        $view->myitem = $myitem;
        $view->items = $items;
        $view->display('news/edit.php');

    }


}