<h1>Объекты PHP</h1>

<?php
////////////////////////////////////////////////
//Объявление класса, создание методов и свойств
////////////////////////////////////////////////
class Example1 {
    public $name, $property;
}

$object1 = new Example1;
echo "Создан объект с пустыми свойствами:" . "<br>";
print_r($object1);
echo "<br>";

class Example2 {
    public $surname, $track;

    function method1() {
        echo "Произошёл вызов метода из класса" . "<br>";
    }
}

$object2 = new Example2;
print_r($object2); // Сначала покажет пустые свойства 
echo "<br>";

$object2->surname = 'Задал свойство 1';
$object2->track = 'Задал свойство 2';
print_r($object2); // Теперь наполнено
echo "<br>";
//Вызов метода класса, который является функцией
$object2->method1();


////////////////////////////////////////////////
//Копирование объекта
////////////////////////////////////////////////
class CopyExample {
    public $options1;
}

$object3 = new CopyExample;
$object3->options1 = 'Только что задал';

$object4 = $object3;
$object4->options1 = 'Скопировал и заменил';

echo '$object3 options1 is ' . $object3->options1 . "<br>";
echo '$object4 options1 is ' . $object4->options1 . "<br>";
//В результате свойство будет равно 'Скопировал и заменил'. Оба свойства ссылаются на один и тот же объект.

////////////////////////////////////////////////
//Клонирование объекта
////////////////////////////////////////////////
class CloneExample {
    public $options2;
}

$object5 = new CloneExample;
$object5->$options2 = 'Задал значение';

$object6 = clone $object5;
$object6->$options2 = 'Склонировал, а потом задал значение';
