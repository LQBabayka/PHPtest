<?php
// Однострочный комменатрий

/*
    Многострочный комменатрий
    Пример
    */
    //оффтоп пример парсинга SSL сертификатов
    $url = "https://demodostup.hserm.ru/home";

    $orignal_parse = parse_url($url, PHP_URL_HOST);
    $get = stream_context_create(array("ssl" => array("capture_peer_cert" => TRUE)));
    $read = stream_socket_client("ssl://".$orignal_parse.":443", $errno, $errstr, 
    30, STREAM_CLIENT_CONNECT, $get);
    $cert = stream_context_get_params($read);
    $certinfo = openssl_x509_parse($cert['options']['ssl']['peer_certificate']);
    
    echo '<pre>';
    print_r($certinfo['validTo_time_t']);
    echo '</pre>';
    $valid_from = date(DATE_RFC2822,$certinfo['validFrom_time_t']);
$valid_to = date(DATE_RFC2822,$certinfo['validTo_time_t']);
echo '</pre>';
echo "Valid From: ".$valid_from."<br>";
echo "Valid To:".$valid_to."<br>";
////////////////////////////////////////////////////////////////////////////////////////////////////////
//Переменныые
////////////////////////////////////////////////////////////////////////////////////////////////////////
echo "Переменныые: <br>";
$firstVAR = "Первая переменная"; //Строка
$numberVAR = 46582; //Целое число
$anotherFloat_number = 234.5; //Число с плавающей точкой
$array_simple = array('Саня', 'Стас', 'Пашок'); //Массив
$multidimensional_arr = array( //Двумерный массив
  array('Д', 'Б', 'Ц'),
  array('Г', 'Д', 'Ж'),
  array('Ъ', 'Ы', 'Ф'),
);

////////////////////////////////////////////////////////////////////////////////////////////////////////
//Конкатенация тут через точки
////////////////////////////////////////////////////////////////////////////////////////////////////////
echo "Конкатенация: <br>";
// echo "Возрат" . " " . $array_simple[0] . " Составил " . ($numberVAR-46552) . " лет";
echo $firstVAR .= $anotherFloat_number; //Первая переменная234.5(соединила 2 переменные)
$example = 'определённая строка';
echo 'хочу отсекать ненужные переменные, такие как $example';
echo "а тут хочу увидеть значение $example";
echo "блаблабла" . "<br>";
//Как к переменной присоеденить другое значение
$someV = 'Маши ';
$someV .= " 10 яблок";//Прибавляет новое значение к имеющейся переменной
echo "У " . $someV; 
?>

<html>

<body>
  <h1>блаблабла</h1> <br>
  <a href="html.php">PHP файл </a>
</body>

</html>

<?php
$num3 = 3;
$anotherNum = 2;
$testNum = 3;


$manyS = "Проба ввода нескольких строк";
echo "Тут первая строка <br>
Тут вторая строка<br>
<br>
$manyS <br>";

$numb = 12345 * 67890;
echo "Выражение числа \$numb равно $numb<br>";
echo substr($numb, 2, 2);
echo "<br>";

////////////////////////////////////////////////////////////////////////////////////////////////////////
//Константа
////////////////////////////////////////////////////////////////////////////////////////////////////////
echo "Константа: <br>";
define("KONSTANTA", "Значение константы");//Принято записывать заглавными буквами
//Прямое обращение к константе
echo KONSTANTA . " from line " . __LINE__; //Без доллара
echo "<br>";
//Заведение переменной, равной константе
$konst_test = KONSTANTA;
echo $konst_test;
echo "<br>";

//Использование констант внутри класса:
class ConstClass {
  const NAMEZ = "str"; //В этом случае нельзя использовать -> (ConstClass->NAMEZ) будет ошибка
  public static $simple = "dimple" . "<br>";
}
if (defined('ConstClass::NAMEZ')) { //defined проверяет наличие переменной
  echo "Переменная определена и равна " . ConstClass::NAMEZ . "<br>";
  echo  ConstClass::$simple;
} else {
  echo "Переменная не определена";
}

//Использование стоковых (волшебных) констант
echo "Это строка" . __LINE__ . "в файле " . __FILE__ . " в директории " . __DIR__ . "<br>";
$b ? print "TRUE" : print "FAULSE";


////////////////////////////////////////////////////////////////////////////////////////////////////////
//Функции
////////////////////////////////////////////////////////////////////////////////////////////////////////
echo "Функции: <br>";
//Объявление функции:
function someF($someP)
{
  $testW = "Возвращено " . "$someP" . "<br>";
  echo $testW;
  return $testW;
}

//Вызов функции:
echo someF(4234234);

/*
//Пример из книжки, вывод даты
function longdate($timestamp)
  {
    return date("l F jS Y", $timestamp);
  }
//Текущая:
echo "Текущая дата:";
echo longdate(time());
echo "<br>";

//Дата семнадцатидневной давности:
echo "Дата семнадцатидневной давности:";
echo longdate(time() - 17 * 24 * 60 * 60);
echo "<br>";
*/

$temp = "The date is ";
echo longdate($temp, time());

function longdate($temp, $timestamp)
{
  return $temp . date("l F jS Y", $timestamp);
}

////////////////////////////////////////////////////////////////////////////////////////////////////////
//Глобальные переменные
////////////////////////////////////////////////////////////////////////////////////////////////////////
/*
echo "Статические переменные: <br>";
$temp = "The date is "; //объявление
echo longdate(time()); //The date is Sunday December 12th 2021

function longdate($timestamp) 
{
    global $temp; //Говорим об использовании этой переменной извне
    //без этой конструкции внутренность функции не узнает о переменной $temp
    return $temp . date("l F jS Y", $timestamp);
}
*/

echo "<br>";

////////////////////////////////////////////////////////////////////////////////////////////////////////
//Статические переменные
////////////////////////////////////////////////////////////////////////////////////////////////////////
echo "Статические переменные: <br>";
//переменная внутри функции, к которой нет доступа извне, но считается для подсчета вызова
function test()
{
  static $count = 0;
  echo "Вызов счётчика " . $count;
  echo "<br>";
  $count++;
}
test();
test();
test();
test();
test(); //Вызов счётчика 4

// $came_from = $_SERVER['HTTP_REFERRER'];
$came_from = htmlentities($_SERVER['HTTP_REFERRER']);

////////////////////////////////////////////////////////////////////////////////////////////////////////
//Булевы значения
////////////////////////////////////////////////////////////////////////////////////////////////////////
echo "Демонстрация булевых значений: <br>";
echo "a: [" . TRUE  . "]<br>"; //1
echo "a: [" . (20 > 9) . "]<br>"; //1
echo "a: [" . (2 > 9) . "]<br>"; //пустота в квадратных ковычках

////////////////////////////////////////////////////////////////////////////////////////////////////////
//Литералы
////////////////////////////////////////////////////////////////////////////////////////////////////////
$myname = "Brian";
$myage  = 37;
echo "a: " . 73      . "<br>"; // Numeric literal (73)
echo "b: " . "Hello" . "<br>"; // String literal (Hello)
echo "c: " . FALSE   . "<br>"; // Constant literal ()
echo "d: " . $myname . "<br>"; // String variable (Brian)
echo "e: " . $myage  . "<br>"; // Numeric variable (37)
$tyag = 13 * 20;
echo "$tyag"; //260
echo "<br>";

////////////////////////////////////////////////////////////////////////////////////////////////////////
//if and switch
////////////////////////////////////////////////////////////////////////////////////////////////////////
echo "if and switch: <br>";
$page = "test";
//Вариант с if, elseif and else
if ($page == "Home")  echo "You selected Home";
elseif ($page == "About") echo "You selected About";
elseif ($page == "News")  echo "You selected News";
elseif ($page == "Login") echo "You selected Login";
elseif ($page == "Links") echo "You selected Links";
else                      echo "Unrecognized selection";
echo "<br>";

//Вариант с switch
switch ($page) {
  case "Home":
    echo "You selected Home";
    break;
  case "About":
    echo "You selected About";
    break;
  case "News":
    echo "You selected News";
    break;

  default:
    echo "Unrecognized selection";
    break;
}
echo "<br>";

////////////////////////////////////////////////////////////////////////////////////////////////////////
//Оператор ?
////////////////////////////////////////////////////////////////////////////////////////////////////////
echo "Оператор ?: <br>";

$fuel = 0;
//Вернётся первый вариант ("Требуется дозаправка"), так как проверка возвращает TRUE
echo $fuel <= 1 ? "Требуется дозаправка" : "Топлива еще достаточно";
echo "<br>";

// $enought =  $fuel <= 1 ? false : true;
$enought =  $fuel <= 1 ? true : false;
echo $enought; //1
echo "<br>";

////////////////////////////////////////////////////////////////////////////////////////////////////////
//Циклы
////////////////////////////////////////////////////////////////////////////////////////////////////////
//Есть циклы: while, do while и for (foreach для массивов будет отдельно)
echo "Цикл while: <br>";
$count_a = 1;
while ($count_a <= 5) { //Начинает считать с 1
  echo "Число $count_a, умноженное на 12, равно " . $count_a * 12 . "<br>"; // Если несколько строк то нужны {}
  ++$count_a;
}
//Можно укоротить цикл while так: while (++$count_a <= 5), но счёт начнется с инкремента, те с 2 (1 + ++)

echo "Цикл do while: <br>";
$count_b = 1;
do {
  echo "Число $count_b, умноженное на 12, равно " . $count_b * 12 . "<br>";
} while (++$count_b <= 4);
//Смысл цикла в том что он в любом случае выполнит первую строку кода, а условие будет проверяться потом

echo "Цикл for: <br>";
for ($count_c = 0; $count_c < 3; $count_c++) { //Начинает считать с 0
  echo "Число $count_c, умноженное на 12, равно " . $count_c * 12 . "<br>";
}
//Можно использовать несколько переменных и операций с ними: for ($i = 1, $j = 2; $i + $j < 10; $i++ , $j++)

echo "Прекращение работы циклов, команда break: <br>";
$x_1 = 0;
while ($x_1++ < 10) {
  if ($x_1 == 3) break; // Когда $x равен 3, цикл прерывается, выведется только итерация 1 и 2
  echo "<b>Итерация $x_1</b><br>";
}

echo "Прекращение работы циклов, команда continue: <br>";
//Используется для остановки не всего цикла, а итерации
$x_2 = 2;
while ($x_2 > -4) {
  $x_2--;
  if ($x_2 == 0) {
    echo "Попался нуль, пропущу его<br>";
    continue;
  }
  echo "Делю $x_2 на нуль " . (10 / $x_2) . "<br>";
}

////////////////////////////////////////////////////////////////////////////////////////////////////////
//Преобразование типов
////////////////////////////////////////////////////////////////////////////////////////////////////////
echo "Про преобразование типов <br>";
$aa1 = 56;
$bb1 = 12;
$cc1 = $aa1 / $bb1;
echo 'aa1 = 5, bb1 = 12; cc1 = $aa1 / $bb1; So cc1 = ' . $cc1 . "<br>"; // cc1=4,
//Явное преобразование
echo 'Для приведения в целое число можно использовать (int): cc1 = (int) ($aa1 / $bb1) и тогда получится ' . $cc1 = (int) ($aa1 / $bb1) . "<br>";

//ля того, чтобы узнать тип использую gettype(),(typeof() в JS):
$b = "10";
echo gettype($b) . "<br>";  // string

////////////////////////////////////////////////////////////////////////////////////////////////////////
//Объекты и классы(коротко)
////////////////////////////////////////////////////////////////////////////////////////////////////////

class Point {
  public $x;
  public static $num123 = 123;
}

//Подключение класса если он в другом файле:
//require 'point.php';

$point1 = new Point;
$point1->x = 13; //присвоение переменной из класса значение
echo $point1->x . "<br>";//13
echo Point::$num123 . "<br>"; //123. Можно обращаться к переменной класса



////////////////////////////////////////////////////////////////////////////////////////////////////////
//Функции (подробнее)
////////////////////////////////////////////////////////////////////////////////////////////////////////
$x = 11;
$y = 22;

function sumMe($x, $y)
{
  $sum = $x + $y;
  echo $sum . "<br>";
}

sumMe(44, 45); //89
sumMe($x, $y);

//Пример функции и её вызова
/*
// echo fix_names("WILLIAM", "henry", "gatES");
// function fix_names($n1, $n2, $n3) {
//     $n1 = ucfirst(strtolower($n1));
//     $n2 = ucfirst(strtolower($n2));
//     $n3 = ucfirst(strtolower($n3));
//     return $n1 . " " . $n2 . " " . $n3;
// }
*/

//Пример вызова функции и возврата нескольких переменных в массиве:
// $names = fix_names("WILLIAM", "henry", "gatES");
// // echo gettype($names);


// function fix_names($n1, $n2, $n3) {
//     $n1 = ucfirst(strtolower($n1));
//     $n2 = ucfirst(strtolower($n2));
//     $n3 = ucfirst(strtolower($n3));
//     return array($n1, $n2, $n3);
// }

// echo $names[0] . " " . $names[1] . " " . $names[2] . "<br>";

//Пример использования ссылки на переменную для функции:
$an1 = "WILLIAM";
$an2 = "henry";
$an3 = "gates";

echo $an1 . " " . $an2 . " " . $an3 . " //from line " . __LINE__ . "<br>";//так как в переменных
fix_names($an1, $an2, $an3);
echo $an1 . " " . $an2 . " " . $an3 . " //from line " . __LINE__ . "<br>";//после отработки функции переменные переписались без return'а

function fix_names(&$n1, &$n2, &$n3)
{
  $n1 = ucfirst(strtolower($n1));
  $n2 = ucfirst(strtolower($n2));
  $n3 = ucfirst(strtolower($n3));
}

echo "After that string an1 is " . $an1 . " //from line " . __LINE__ . "<br>";

//И еще премер попрощще:
$first1 = 5;
$second2 = &$first1;
$second2 = 3;
echo $first1 . " //пример ссылки на переменную " . __LINE__ . "br";//3, так как записали в переменную $first1 по ссылке

////////функции передача переменных по ссылке, пример с ютуба
function reName1($newName1, &$otherName = false){//без задания значения выходит ошибка
  echo $newName1 . " //from line " . __LINE__ . "<br>";
  $otherName = "Incredible";
}

reName1('Evstafya', $otherName);
echo $otherName . " //from line " . __LINE__ . "<br>";//Incredible
var_dump($otherName);
echo "<br>";

//Пример возвращения массива с переменными из вункции и создание новых в области видимости
function formatSize($bytes) {
  $kbytes = $bytes / 1024;
  $mbytes = $kbytes / 1024;
  $gbytes = $mbytes / 1024;
  return [$bytes, $kbytes, $mbytes, $gbytes];
}

list($bytesR, $kbytesR, $mbytesR, $gbytesR) = formatSize(65090888);
echo "bytesR = $bytesR" . "<br>" . "kbytesR = $kbytesR" . "<br>" . "mbytesR = $mbytesR" . "<br>" . "gbytesR = $gbytesR" . "<br>";


//Пример использования инклюда
include 'foreinclude.php';

//Пример использования require
require 'foreReqouire.php';
//Стоит использывать include_once и require_once чтобы не было проблем с несколькими объявлениями переменных

echo "Про массивы" . "<br>" . "<br>";
////////////////////////////////////////////////////////////////////////////////////////////////////////
//Массивы
////////////////////////////////////////////////////////////////////////////////////////////////////////
//Способы задать массив:
$paperA[] = 'Нулевой';
$paperA[] = 'Первый';
$paperA[] = 'Второй';
$paperA[] = 'Третий';
print_r($paperA); //Array ( [0] => Нулевой [1] => Первый [2] => Второй [3] => Третий )
echo "<br>";

$paperB[0] = 'Нулёвый';
$paperB[1] = 'Нульцевый';
$paperB[2] = 'Новенький';
print_r($paperB);//Array ( [0] => Нулёвый [1] => Нульцевый [2] => Новенький )
echo "<br>";

//Добавление элементов в массив и извлечение их из массива
$paperС[] = 'Нулевой';
$paperС[] = 'Первый';
$paperС[] = 'Второй';
$paperС[] = 'Третий';


for ($i=0; $i < 4; $i++) { 
  echo "$i: $paperС[$i]<br>"; //0: Нулевой 1: Первый 2: Второй 3: Третий
}

//Про ассоциативные массивы:
$paperD['name'] = 'John';
$paperD['secondname'] = 'Smith';
$paperD['status'] = 'friend';
$paperD['male'] = 'male';

echo $paperD['secondname'] . "<br>";

//Присваивание с использованием ключевого слова array (best practise)
$paperE = array('Совы ', 'не ', 'те ', 'кем ', 'кажутся!');
$paperF = array(
  'name' => 'John',
  'secondname' => 'Smith',
  'status' => 'friend',
  'male' => 'male'
);

echo $paperE[4] . "<br>"; //кажутся!
echo $paperF['name'] . "<br>";

var_dump(count($paperF));// Пример подсчёта элементов массива

//Форыч
foreach ($paperF as $key => $value) {
  echo 'Форыч. ' . 'Индекс - ' . $key . ', а значение - ' . $value . '<br>';
}

////Функция list
//Принимает массив и прасваивает строки массива переменным, которые указаны в качестве аргументов.

list($aaaaa, $bbbbb) = array('aVar', 'bVar');
echo "aaaaa = $aaaaa, bbbbb = $bbbbb" . "<br>";//aaaaa = aVar, bbbbb = bVar

//Многомерные массивы
$products1 = array(
  'paper' => array(
    'copier' => 'Copier & Multi',
    'inkjet' => 'Inkjet printer',
    'laser'  => 'Laser printer',
    'photo'  => 'Photographic Paper'
  ),
  'pens' => array(
    'ball'   => 'Ball point',
    'marker' => 'Markers'
  )
  );

echo "<pre>";
foreach($products1  as $section => $items)
  foreach($items  as $key => $value)
    echo "$section:\t$key\t($value)<br>";
echo "</pre>";

//Использование функций для работы с массивами
echo is_array($products1); //вернёт 1, тк это массив

echo count($products1);//вернёт 2, тк там 2 значения верхнего уровня. Второй параметр стоково равен нулю, типо 0 уровень подсчёта
echo count($products1, 1); //вернёт 8, тк в общей сложности 8 элементов массива

$sortableArrayN = array(6,4,7,2,9,1,0,3,5);
print_r($sortableArrayN);//[0] => 6 [1] => 4 [2] => 7 [3] => 2 [4] => 9 [5] => 1 [6] => 0 [7] => 3 [8] => 5
echo "<br>";
echo sort($sortableArrayN); //Произошла сортировка указанного массива, при успехе возвращает 1 (или 0 при ошибке)
print_r($sortableArrayN);//[0] => 0 [1] => 1 [2] => 2 [3] => 3 [4] => 4 [5] => 5 [6] => 6 [7] => 7 [8] => 9
echo "<br>";
//Для сортировки в обратном порядке необходимо использовать функцию rsort()
//Для расположения в рандомном порядке используется shuffle()

//explode() - берёт строку, содержащую несколько элементов, отделенных одиночным символом и помещает каждый элемент в массив
//первым аргументом указывается разделитель, вторым то что нужно разделять
$explodeExample1 = explode(' ', 'Пожалуйста раздели меня полностью');
print_r($explodeExample1);//[0] => Пожалуйста [1] => раздели [2] => меня [3] => полностью
echo "<br>";

//compact - создаёт массив из переменных и их значений
$sCourse = 'ОТ(и)';
$sPid = 67843;
$sTheme = 'port';

$allVars = compact('sCourse','sPid', 'sTheme');
print_r($allVars);//[sCourse] => ОТ(и) [sPid] => 67843 [sTheme] => port
echo "<br>" . "<br>";








echo "<br>" . "<br>";
//в книге остановился на обработке форм (еще можно посмотреть повторно апдейт и удаление записей), ст 299
//полезная ссылка https://www.youtube.com/watch?v=0CDDQTaGDhg&ab_channel=ITDoctor

//в видосах на https://www.youtube.com/watch?v=nWjvvM608yw&ab_channel=ITDoctor

?>