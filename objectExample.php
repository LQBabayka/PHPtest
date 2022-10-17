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
echo "<br>"  . "<br>";

$object2->surname = 'Задал свойство 1';
$object2->track = 'Задал свойство 2';
print_r($object2); // Теперь наполнено
echo "<br>"  . "<br>";
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
//В результате свойство будет равно 'Скопировал и заменил'. Оба свойства ссылаются на один и тот же объект (так себе практика).

////////////////////////////////////////////////
//Клонирование объекта - не работает в таком виде
////////////////////////////////////////////////
class CloneExample {
    public $options2;
    public function __clone() {
        echo 'Это сообщение выйдет при клонировании объекта' . "<br>";
    }
}

$object5 = new CloneExample;
$object5->$options2 = 'Задал значение';

$object6 = clone $object5;
$object6->$options2 = 'Склонировал, а потом задал значение';

echo '$object5->$options2 is: ' . $object5->$options2 . "<br>";
echo '$object6->$options2 is: ' . $object6->$options2 . "<br>" . "<br>";

////////////////////////////////////////////////
//Работа конструктора и деструктора
////////////////////////////////////////////////
class Example3 {
    public $name, $age;

    public function __construct($name, $age) { //Выполняется для передачи классу аргументов
        $this->name = $name;
        $this->age = $age;
    }

    public function __destruct() {
        echo 'Подключение к бд разорвано' . "<br>"; //Выполняется например при завершении сценария
    }

    public function print() {
        return 'Имя получилось ' . $this->name . ', а возраст ' .  $this->age . "<br>";
    }
}

$firstName = 'Первенький';
$someAge = 33;
$objExmpl3 = new Example3($firstName, $someAge);
$objExmpl4 = new Example3('Вторенький', 23);
echo $objExmpl3->print(); //Имя получилось Первенький, а возраст 33
echo $objExmpl4->print();//Имя получилось Вторенький, а возраст 23
$objExmpl4->__destruct();
echo "<br>" . "<br>";

////////////////////////////////////////////////
//Наследование классов
////////////////////////////////////////////////

//Родительский класс, принимает имя и возраст
class Person1 {
    public $name, $age;

    public function __construct($name, $age) {
        $this->name = $name;
        $this->age = $age;
    }

    public function getPersonInfo() {
        return 'Age is ' . $this->age . ' and name is ' . $this->name;
    }
}

$Person11 = new Person1('Tim', 31);
echo $Person11->getPersonInfo();
echo "<br>";

//Создаю наследника, указываю на родителя
class Job1 extends Person1 {
    public $job;
    //Тут передаю не только $job, но и родительские аргументы
    public  function __construct($name, $age, $job) {
        $this->job = $job;
        //Поэтому указываю на родительский конструктор
        parent::__construct($name, $age);
    }

    public function getJob() {
        return 'the job is ' . $this->job;
    }
}
//При создании объекта, в качестве аргумента передаю параметры от родительского класса и от наследуемого
$job11 = new Job1('Vasiliy', 44, 'zolotar');
echo $job11->getJob(); //the job is zolotar - метод класса Job1
echo "<br>";
echo $job11->getPersonInfo();//Age is 44 and name is Vasiliy - метод класса Person1
echo "<br>";
echo 'Его зовут ' . $job11->name . ', профессия - ' . $job11->job . ', а возраст - ' . $job11->age . 'года(лет)'; 
echo "<br>" . "<br>";

//Чтобы запретить изменение (в плане наследования) необходимо добавить слово final,
//Например final class LastOne {} или метод: final protected function functionName(){}

////////////////////////////////////////////////
//Область видимости (public, protected, private)
////////////////////////////////////////////////
class Person2 {
    protected $name;
    public $age;

    public function __construct($name, $age) {
        $this->name = $name;
        $this->age = $age;
    }
}

class Job2 extends Person2 {
    private $job;

    public  function __construct($name, $age, $job) {
        $this->job = $job;

        parent::__construct($name, $age);
    }

    public function getJob() {
        return $this->job;
    }
    
    public function setPersonName($name) {
        $this->name = $name;
    }

    public function getPersonName() {
        return $this->name;
    }
}

$testObject33 = new Job2('Sanya', 31, 'Nalogovic ept');
$testObject33->age = 32; //Переписать возможно, так как public переменная. protected и private невозможно
//$testObject33->job = 'it'; //- ошибка так как private - Cannot access private property Job2::$job
//echo $testObject33->job; //- ошибка так как private - Cannot access private property Job2::$job
//Для обращения к приватной переменной написан метод getJob
echo $testObject33->getJob();
echo "<br>";
//Но если класс Job2 будет наследоваться далее, и необходимо будет её переписывать, то переменную стоит объвить protected

//Про конструкции __get и  __set
class SomePerson {
    private $name, $surname, $age, $gender, $job;

    const COMPANY = 'Vector';

    public function __construct($name, $surname, $age, $gender, $job) {
        $this->name = $name;
        $this->surname = $surname;
        $this->age = $age;
        $this->gender = $gender;
        $this->job = $job;
    }

    //Все приватные, и чтобы к ним обращаться и не писать getтер и setтер для каждого, существуют такие конструции:
    public function __set($name, $value) {
        $this->$name = $value;
    }

    public function __get($name) {
        return $this->$name;
    }
    //Пример как обратиться к константе внутри класса
    public function showMyConst() {
        echo self::COMPANY . "<br>";
    }
    //Если необходимо в дочернем классе обратитьс к константе из родителя:
    //parent::НАЗВАНИЕКОНСТАНТЫ
    
}

$oldPerson = new SomePerson('Alex', 'Tim', 31, 'Male', 'developer');
echo $oldPerson->name . "<br>";
$oldPerson->name = 'Max';//Хоть переменная private, но конструкция __set даёт возможность редактирования
echo $oldPerson->name . "<br>";//а конструкция __get даёт возможность просмотра
//SomePerson::COMPANY = 'opttorg'; такое написане выдет ошибку, так как константа не перезаписывается
echo SomePerson::COMPANY . "<br>"; //будет Vector
$oldPerson->showMyConst();//будет Vector