<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="/views/news/style.css" type="text/css" media="screen" />

    <title><?= $items->news_name ?></title>
</head>
<body>

<div id="page">
    <div id="header">
        <div class="logo"><a href="/"></a>
        </div></div>
    <div id="posts">

        <h1><?= $items->news_name ?></h1>
        <p><b>Дата публикации: <?=  date("d-m-Y H:i:s",strtotime($items->news_date)); ?></b></p>
        <div><?= $items->news_content ?></div>



    </div>
    <div id="sidebar" >
        <div class="widget">
            <div class="widgettitle">Меню</div>
            <div class="widgetcont">

                <p><a href="/index.php">Главная</a></p>
                <p><a href="/Admin/Add">Добавить новость</a></p>

            </div>
        </div>
    </div>
</div>

</body>
</html>
