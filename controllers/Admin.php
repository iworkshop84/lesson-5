<?php
namespace App\Controllers;

use App\Models\News;
use App\Classes\ErrorLog;
use App\Classes\View;

class Admin
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
                $post->news_date = date("Y-m-d H:i:s");

                $res_id = $post->save();
                header('Location: /Admin/Edit/' . $res_id);
                exit;
            }
        }

        $errlog =  ErrorLog::read();

        $view = new View();
        $view->errors = $errlog;
        $view->display('news/add.php');
    }


    public function actionEdit($id=null)
    {
        $mypost = News::findOneInColumn('news_id', $id);

        if(isset($_POST['editnews']))
        {
            if(!empty($_POST['name'])){
                $mypost->news_name = $_POST['name'];
            }

            if(!empty($_POST['content'])){
                $mypost->news_content = $_POST['content'];
            }

            if(isset($mypost->news_name) && isset($mypost->news_content)&& isset($mypost->news_id))
            {
                $mypost->save();
                header('Location: /Admin/Edit/' . $mypost->news_id);
                exit;
            }
        }


        if(isset($_POST['dellnews']))
        {
            if(isset($id)){
                $post = new News();
                $post->news_id = $id;

                $post->delete();

                header('Location: /Admin/Edit/');
                exit;
            }
        }


        $items = News::findNewsByDate();
        $view = new View();
        $view->myitem = $mypost;
        $view->items = $items;
        $view->display('news/edit.php');

    }


}