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
// $result->close();
// $connection->close();
//MYSQLI_ASSOC - ассоциативный массив
}
goodApartQuery($connection);


//////////////////////////////////////////////////////////////////
//Формы, запросы и апдейты
//////////////////////////////////////////////////////////////////

  echo 'Проба форм и запросов';
  if (isset($_POST['delete']) && isset($_POST['isbn']))
  {
    $isbn   = get_post($connection, 'isbn');
    $query  = "DELETE FROM classics WHERE isbn='$isbn'";
    $result = $connection->query($query);
    if (!$result) echo "DELETE failed<br><br>";
  }

  if (isset($_POST['author'])   &&
      isset($_POST['title'])    &&
      isset($_POST['category']) &&
      isset($_POST['year'])     &&
      isset($_POST['isbn']))
  {
    $author   = get_post($connection, 'author');
    $title    = get_post($connection, 'title');
    $category = get_post($connection, 'category');
    $year     = get_post($connection, 'year');
    $isbn     = get_post($connection, 'isbn');
    $query    = "INSERT INTO classics VALUES" .
      "('$author', '$title', '$category', '$year', '$isbn')";
    $result   = $connection->query($query);
    if (!$result) echo "INSERT failed<br><br>";
  }

  echo <<<_END
  <form action="testSQL.php" method="post"><pre>
    Author <input type="text" name="author">
     Title <input type="text" name="title">
  Category <input type="text" name="category">
      Year <input type="text" name="year">
      ISBN <input type="text" name="isbn">
           <input type="submit" value="ADD RECORD">
  </pre></form>
_END;

  $query  = "SELECT * FROM classics";
  $result = $connection->query($query);
  if (!$result) die ("Database access failed");

  $rows = $result->num_rows;

  for ($j = 0 ; $j < $rows ; ++$j)
  {
    $row = $result->fetch_array(MYSQLI_NUM);

    $r0 = htmlspecialchars($row[0]);
    $r1 = htmlspecialchars($row[1]);
    $r2 = htmlspecialchars($row[2]);
    $r3 = htmlspecialchars($row[3]);
    $r4 = htmlspecialchars($row[4]);
    
    echo <<<_END
  <pre>
    Author $r0
     Title $r1
  Category $r2
      Year $r3
      ISBN $r4
  </pre>
  <form action='testSQL.php' method='post'>
  <input type='hidden' name='delete' value='yes'>
  <input type='hidden' name='isbn' value='$r4'>
  <input type='submit' value='DELETE RECORD'></form>
_END;
  }

  $result->close();
  $connection->close();

  function get_post($connection, $var)
  {
    return $connection->real_escape_string($_POST[$var]);
  }


?>