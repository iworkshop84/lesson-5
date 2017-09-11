<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="/views/news/style.css" type="text/css" media="screen" />

    <title>Ошибка!</title>
</head>
<body>

<div id="page">
    <div id="header">
        <div class="logo"><a href="/"></a>
        </div></div>
    <div id="posts">

        <h1><?= 'Ошибка'; ?></h1>

        <div><b><?= $error; ?></b></div>




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
