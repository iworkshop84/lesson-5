<?php


class AdminController
{
    public function actionAdd()
    {
        if(isset($_POST['addnews'])){

            $post = new News();

            if(!empty($_POST['name'])){
                $post->news_name = $_POST['name'];
            }

            if(!empty($_POST['content'])){
                $post->news_content = $_POST['content'];
            }

            if(isset($post->news_name) && isset($post->news_content)){
                $post->newsAdd();
                header('Location: /index.php');
                exit;
            }
        }

        $view = new View();
        $view->display('news/add.php');
    }
}