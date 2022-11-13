<?php

use LDAP\Result;

echo 'test' . '<br>';
require_once 'login.php';


$connection = new mysqli($hn, $un, $pw, $db);
if ($connection->connect_error) die('Ошибка');

//////////////////////////////////////////////////////////////////
//Запрос и извлечение результатов
//////////////////////////////////////////////////////////////////

//Пример простого запроса
//итог = подключение->запрос(тело запроса); итог->извлечение()['название интересующей колонки']
function firstQuery($connection) {
    $query = "SELECT * FROM users WHERE id = 1";
    $result = $connection->query($query);
    echo $result->fetch_assoc()['fullname'] . '<br>' . '<br>'; 
    if (!$result) die ("Ошибка запроса");
}
firstQuery($connection); //Тимашев Александр Алексеевич

//////////////////////////////////////////////////////////////////
//Поэлементное извлечение результатов
//////////////////////////////////////////////////////////////////

//Громоздкая версия(точно не best practise):
function badApartQuery($connection){
    $query = "SELECT * FROM users";
    $result = $connection->query($query);
    if (!$result) die ("Ошибка запроса");

    $rows = $result->num_rows; //подсчёт количества строк
    echo 'Громоздкий способ извлечения данных функцией badApartQuery()' . '<br>';

    for ($i=0; $i < $rows; $i++) { 
        $result->data_seek($i);
        echo 'id: ' . htmlspecialchars($result->fetch_assoc()['id']) . '<br>';

        $result->data_seek($i);
        echo 'Имя: ' . htmlspecialchars($result->fetch_assoc()['fullname']) . '<br>';

        $result->data_seek($i);
        echo 'Логин: ' . htmlspecialchars($result->fetch_assoc()['login']) . '<br>';

        $result->data_seek($i);
        echo 'Пароль: ' . htmlspecialchars($result->fetch_assoc()['password']) . '<br>' . '<br>';

        //htmlspecialchars() используется для обезвреживания XSS атак, в случае, если в значениях используются html теги
        //Функция mysqli_data_seek() перемещает указатель в результате на строку, указанную в параметре
    }
    
}
badApartQuery($connection);

//Лаконичная версия:
function goodApartQuery($connection) {
    $query = "SELECT * FROM users";
    $result = $connection->query($query);
    if (!$result) die ("Ошибка запроса");

    $rows = $result->num_rows; //подсчёт количества строк
    echo 'Лаконичный способ извлечения данных функцией goodApartQuery()' . '<br>';

    for ($i=0; $i < $rows; $i++) {
        $row = $result->fetch_array(MYSQLI_ASSOC);
        echo 'id: ' . htmlspecialchars($row['id']) . '<br>';
        echo 'Имя: ' . htmlspecialchars($row['fullname']) . '<br>';
        echo 'Логин: ' . htmlspecialchars($row['login']) . '<br>';
        echo 'Пароль: ' . htmlspecialchars($row['password']) . '<br>' . '<br>';
    }
$result->close();
$connection->close();
//MYSQLI_ASSOC - ассоциативный массив
}
goodApartQuery($connection);

?>