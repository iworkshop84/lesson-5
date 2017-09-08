<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="/views/news/style.css" type="text/css" media="screen" />

    <title>Главная страница</title>
</head>
<body>

<div id="page">
    <div id="header">
        <div class="logo"><a href="/"></a>
        </div></div>
    <div id="posts">
        <h2>Главная страница</h2>


        <?php foreach ($items as $item): ?>
            <h3><a href="<?= '/News/One/' . $item->news_id?>"><?= $item->news_name ?></a></h3>
            <b>Дата публикации: <?=  date("d-m-Y H:i:s",strtotime($item->news_date)); ?></b>
            <p><?= $item->news_content ?></p>
        <?php endforeach; ?>



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
