<?php
require_once('login.php');
$connection = new mysqli($hn, $un, $pw, $db);
if($connection->connect_error) die('Connection bug');


//////////////////////////////////////////////////////////////////
//Создание таблицы
//////////////////////////////////////////////////////////////////
/*
$query = "
CREATE TABLE cats (
    id SMALLINT NOT NULL AUTO_INCREMENT,
    family VARCHAR(32) NOT NULL,
    name VARCHAR(32) NOT NULL,
    age TINYINT NOT NULL,
    PRIMARY KEY (id)
    )";

$result = $connection->query($query);
if(!$result) die('Чёт таблица не создалась');
*/

//////////////////////////////////////////////////////////////////
//Демонстрация таблицы
//////////////////////////////////////////////////////////////////
$query = "DESCRIBE cats";
$result = $connection->query($query);
if(!$result) die('Чёт беда с дискрайбом');

$rows = $result->num_rows;
echo "<table><tr><th>Column</th><th>Type</th><th>Null</th> <th>Key</th></tr>";

for ($i= 0; $i < $rows; ++$i) 
{
    $row = $result->fetch_array(MYSQLI_NUM);

    echo "<tr>";
    for($k = 0; $k < 4; ++$k) {
        echo "<td>" . htmlspecialchars($row[$k]) . "</td>";
    }
    echo "</tr>";
    
}
echo "</table>";

//////////////////////////////////////////////////////////////////
//Добавление данных
//////////////////////////////////////////////////////////////////

/*
$queryInsert = "INSERT INTO cats VALUES(NULL, 'Lions', 'Simbas', 4)";//NULL передаётся так как айдишник auto increment

$resultInsert = $connection->query($queryInsert);
if(!$resultInsert) die('Чёт беда с инсертом');
*/

//////////////////////////////////////////////////////////////////
//Извлечение данных
//////////////////////////////////////////////////////////////////
$querySelectCats = "SELECT * FROM cats";
$resultSelectCats = $connection->query($querySelectCats);

$rowsCats = $resultSelectCats->num_rows;
echo "<table><tr><th>id</th><th>Family</th><th>Name</th> <th>Age</th></tr>";
for ($i= 0; $i < $rows; ++$i)  {
    $rowCats = $resultSelectCats->fetch_array(MYSQLI_NUM);

    echo "<tr>";
    for($k = 0; $k < 4; ++$k) {
        echo "<td>" . htmlspecialchars($rowCats[$k]) . "</td>";
    }
    echo "</tr>";
}
echo "</table>";

//////////////////////////////////////////////////////////////////
//Идентификаторы вставленных строк
//////////////////////////////////////////////////////////////////
function catInsert($connection) {
$queryInsert2 = "INSERT INTO cats VALUES(NULL, 'Opposum', 'Phonk', 5)";//NULL передаётся так как айдишник auto increment

$resultInsert2 = $connection->query($queryInsert2);
$insertID = $connection->insert_id;
if(!$resultInsert2) die('Чёт беда с инсертом');

$query = "INSERT INTO owners VALUES($insertID, 'Jack', 'Black')";
$result = $connection->query($query);
}
//catInsert($connection);

//Но такой метод вставки данных не безопасен, а использовать каждый раз htmlspecialchars() такое себе

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//Использование указателей мест заполнения
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

//Как это выглядит в SQL:
// PREPARE statement FROM "INSERT INTO classics VALUES(?,?,?,?,?)";

// SET @author = "Emily B",
//     @title = "Some title",
//     @category = "Non fiction",
//     @year = "1877",
//     @isbn = "3459873495837";

// EXECUTE statement USING @author, @title, @category, @year, @isbn;
// DEALLOCATE PREPARE statement;

//Но расширение mysqli урпощает обработку:
$someStatement = $connection->prepare('INSERT INTO classics VALUES(?,?,?,?,?)');
//Объект $someStatement используется для отправки данных, замещающих знаки вопроса, и исп-ся для привязки РНР переменных:
$someStatement->bind_param('sssss', $author, $title, $category, $year, $isbn);
//Первым аргументом 'sssss' это строка из череды типов аргументов:
//i - целые числа
//s - строки
//другие 

//После привязки переменных к определённым запросам, необходимо присвоить им значения:
$author = "Emily B";
$title = "Some title";
$category = "Non fiction";
$year = "1877";
$isbn = "3459873495837";
//После выполняем: $someStatement->execute();, 
//Проверяем выполнение команды: printf("%d Row inserted. \n, $someStatement->affected_rows);,
//После успеха закрываем: $someStatement->close(); Ну и при необходимости закрыть подключение: $connection->close();

// Итого, получился результат:
$someStatement = $connection->prepare('INSERT INTO classics VALUES(?,?,?,?,?)');
$someStatement->bind_param('sssss', $author, $title, $category, $year, $isbn);

$author = "Emily B";
$title = "Some title";
$category = "Non fiction";
$year = "1877";
$isbn = "3459873495837";

$someStatement->execute();
printf("%d Row inserted. \n", $someStatement->affected_rows); //1 Row inserted.
$someStatement->close();
//Произошёл инсёрт, такой метод закрывает брешь в системе безопасности


//////////////////////////////////////////////////////////////////
//Предотвращение внедрения HTML кода (XSS атаки)
//////////////////////////////////////////////////////////////////

//Описан пример использования htmlentities(), пример использования:
function demoXSSinput($connection) {
    function mysql_entities_fix_string($connection, $string) {
        return  htmlentities(mysql_entities_fix_string($connection, $string));
    }

    $user = mysql_entities_fix_string($connection, $_POST['user']);
    $password = mysql_entities_fix_string($connection, $_POST['password']);
}



