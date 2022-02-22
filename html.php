<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Одностраничный код можно указывать в таком виде: -->
    <title><?= $someV1='переменная'; ?> </title> 
</head>
<body>
    <?php
        echo $someV1;
        echo date(DATE_RSS);
    ?>
    <br>
     <!-- Далее пример совмещения php и html кода, 
     к сожалению нельза вставлять строки html внуть скрипта
     и поэтому приходится делать нечто подобное: -->
    <?php
    if (mt_rand(0,1)) {
        ?>
        <div style="color: blue">Blue text</div>
        <?php
    } else {
        ?>
        <div style="color: yellow">Yellow text</div>
        <?php
    }
    ?>

    <p>Подключение другого php файла внутрь этой страницы Через include и require</p>
    <!-- Выполнение правильного кода будет одинаковым,
    но в случае ошибки при использовании require ломается вся страница,
    а при include только вставляемое содержимое: -->
    <?php
        include 'foreinclude1.php';
        // require 'foreinclude.php';
    ?>
    <p>Продолжение первой страницы</p>
</body>
<!--https://www.youtube.com/playlist?list=PLuY6eeDuleIN_pFzp1vlu0PD3KXUrPTVS-->
</html>