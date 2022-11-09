<?php

////////////////////////////////////////////////////////////////////////////////////////////////////////
//Про работу с файлами
////////////////////////////////////////////////////////////////////////////////////////////////////////

//Запись (в данном случае перезапись файла)
$fh = fopen('testfile.txt', 'w') or die('Вместо этого сообщения выводить на 404 страницу');

$text = <<<_END
Парампампам
Нихчиго себе
Парампампам2
_END;

fwrite($fh, $text) or die('Сбой записи файла');
fclose($fh);
echo "Файл 'testfile.txt' успешно записан" . "<br>";

//Чтение файла
$fh1 = fopen('testfile.txt', 'r') or die('Нет такого файла');
echo gettype($fh1) . "<br>"; //resource - не покажет текст
//Проще всего прочитать текстовый файл, извлекая из него всю строку целиком. Используется функция fgets() (s в названии функции означает string)
$line1 = fgets($fh1);
echo gettype($line1) . "<br>"; //string
echo $line1 . "<br>"; //Парампампам - содержание первой строки файла выше
//Прочитать первые 999 символов
echo fread($fh1, 999) . "<br>" . "<br>";

//////////Копирование файлов
// функция copy(from, to)
if(!copy('testfile.txt', 'testfile-copy.txt')){
    echo 'Ошибка';
} else {
    echo 'Копирование произведено' . "<br>";
}

//Проверка на существование файла
$myFileName = 'C:/Users/user/Downloads/Telegram Desktop/OpenServer/domains/PHPtest/testfile.txt';
if(file_exists($myFileName)) {
    echo 'Файл существует'  . "<br>";
}

//Переименовывание файла - rename('current', 'newname')

//Удаление файла
if (!unlink('testfile-copy.txt')) echo 'Удаление невозможно';
    else echo 'Файл testfile-copy.txt удалён' . "<br>" . "<br>";

//////////////////////////////////////////////////////////////////
//Обновление файла
//////////////////////////////////////////////////////////////////

//Открыть в режиме записи
$fh = fopen('testfile.txt', 'r+') or die('error');
$text = fgets($fh);
$myText = 'Новая строка';
//Перенос указателя в самый конец файла
fseek($fh, 0, SEEK_END);
//Сама запись
fwrite($fh, $myText) or die('error');
//Закрыть файл
fclose($fh);

echo 'Файл testfile.txt успешно обновлён' . "<br>";
echo "<br>" . "<br>";

//Чтение всего файла целиком
echo '<pre>';//тэг, позволяющий отображать переводы строк
echo file_get_contents("testfile.txt");
echo '</pre>';
echo "<br>";

//echo file_get_contents("https://wiki.brealit.com/start");// Захват сайта

//////////////////////////////////////////////////////////////////
//Загрузка файла на веб-сервер
//////////////////////////////////////////////////////////////////
echo 'Пример загрузки файла на веб-сервер:';
echo <<<_END
<html><head><title>PHP Form Upload</title></head><body>
<form method='post' action='file-system.php' enctype='multipart/form-data'>
Выберите файл: <input type='file' name='filename' size='10'>
<input type='submit' value='Загрузить'>
</form>
_END;
//Все загружаемые на сервер файлы помещаются в ассоц-ый массив $_FILES

if ($_FILES)//Есть содержимое?
{
  $name = $_FILES['filename']['name'];//Чтение имени файла

  switch($_FILES['filename']['type'])
  {//Проверка типа файла на изображение
    case 'image/jpeg': $ext = 'jpg'; break;
    case 'image/gif':  $ext = 'gif'; break;
    case 'image/png':  $ext = 'png'; break;
    case 'image/tiff': $ext = 'tif'; break;
    default:           $ext = '';    break;
  }
  if ($ext)//Если допустимое изображение, то:
  {
    $n = "image.$ext";
    move_uploaded_file($_FILES['filename']['tmp_name'], $n);//Загрузка на сервер с выбранным именем
    echo "Uploaded image '$name' as '$n':<br>";
    echo "<img src='$n'>";
  }
  else echo "'$name' is not an accepted image file";
}
else echo "No image has been uploaded";

echo "</body></html>";//После загрузки файл появится в корне проекта

