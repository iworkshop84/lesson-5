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

                $post->insert();


                header('Location: /index.php');
                exit;
            }
        }

        $view = new View();
        $view->display('news/add.php');
    }
}