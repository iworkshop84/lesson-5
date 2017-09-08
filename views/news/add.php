<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="/views/news/style.css" type="text/css" media="screen" />

    <title>Добавить новость</title>
</head>
<body>

<div id="page">
    <div id="header">
        <div class="logo"><a href="/"></a>
        </div></div>
    <div id="posts">
        <h2>Добавить новость</h2>



        <form action="/index.php?ctrl=Admin&act=Add" method="post" enctype="multipart/form-data">
            <p> <label for="name"> Имя новости: </label>
                <input type="text" id="name" name="name"></p>
            <p> <label for="content"> Текст новости: </label></p>
            <p><textarea name="content" id="content" style="width: 700px; height: 400px;"></textarea></p>
            <p> <button type="submit" name="addnews">Отправить</button></p>
        </form>


    </div>
    <div id="sidebar" >
        <div class="widget">
            <div class="widgettitle">Меню</div>
            <div class="widgetcont">

                <p><a href="/index.php">Главная</a></p>
                <p><a href="/index.php?ctrl=Admin&act=Add">Добавить новость</a></p>

            </div>
        </div>
    </div>
</div>

</body>
</html>
