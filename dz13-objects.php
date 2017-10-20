<?php
/**
 * Created by PhpStorm.
 * User: max
 * Date: 20.10.17
 * Time: 8:32
 */
ini_set("display_errors",1);
error_reporting(E_ALL);
/*-------------------------Задание 1----------------------*/
echo "<b> Задание 1</b> <br />";

class Task1{
    public $name;
    public $age;
    public $salary;
}
$man1 = new Task1();
$man2 = new Task1();

$man1 -> name ='Иван';
$man1 -> age = 25;
$man1 -> salary = 1000;

$man2 -> name ='Вася';
$man2 -> age = 26;
$man2 -> salary = 2000;

echo "Сумма зарплат Ивана и Васи: ".(($man1 -> salary) + ($man2 -> salary))."<br />";
echo "Сумма возрастов Ивана и Васи: ".(($man1 -> age) + ($man2 -> age))."<br />";


/*-------------------------Задание 2----------------------*/
echo "<br /><b> Задание 2 </b><br />";

class Task2{
    private $name;
    private $age;
    private $salary;

    public function setName($name){
        $this->name = $name;
    }
    public function setAge($age){
        $this->age = $age;
    }
    public function setSalary($salary){
        $this->salary = $salary;
    }
    public function getName(){
        return $this->name;
    }
    public function getAge(){
        return $this->age;
    }
    public function getSalary(){
        return $this->salary;
    }
}
$man3 = new Task2();
$man4 = new Task2();

$man3 -> setName('Иван');
$man3 -> setAge(25);
$man3 -> setSalary(1000);
$man4 -> setName('Вася');
$man4 -> setAge(26);
$man4 -> setSalary(2000);

echo "Сумма зарплат Ивана и Васи: ".($man3 -> getSalary() + $man4 -> getSalary() )."<br />";
echo "Сумма возрастов Ивана и Васи: ".($man3 -> getAge() + $man4 -> getAge())."<br />";


/*-------------------------Задание 3----------------------*/
echo "<br /> <b>Задание 3 </b><br />";

class Task3{
    private $name;
    private $age;
    private $salary;

    /**
     * @param $name
     */
    public function setName($name){
        $this->name = $name;
    }

    /**
     * @param $age
     */
    public function setAge($age){
        if($age > 1 && $age < 100){
            $this->age = $age;
        }
    }

    /**
     * @param $salary
     */
    public function setSalary($salary){
        $this->salary = $salary;
    }

    /**
     * @return mixed
     */
    public function getName(){
        return $this->name;
    }

    /**
     * @return mixed
     */
    public function getAge(){
        return $this->age;
    }

    /**
     * @return mixed
     */
    public function getSalary(){
        return $this->salary;
    }
}
$man5 = new Task3();
$man5 -> setName('Иван');
$man5 -> setAge(99);
$man5 -> setAge(102);

echo "Возраст ".($man5 -> getName()). " равен ". ($man5 -> getAge())."<br />";


/*-------------------------Задание 4----------------------*/
echo "<br /> <b>Задание 4 </b><br />";

class Task4{
    private $name;
    private $age;
    private $salary;

    /**
     * Task4 constructor.
     * @param $name
     * @param $age
     * @param $salary
     */
    function __construct($name, $age, $salary) {
        $this->name = $name;
        $this->age = $age;
        $this->salary = $salary;
    }

    /**
     * @return mixed
     */
    public function getName(){
        return $this->name;
    }

    /**
     * @return mixed
     */
    public function getAge(){
        return $this->age;
    }

    /**
     * @return mixed
     */
    public function getSalary(){
        return $this->salary;
    }
}
$man6 = new Task4('Дима', 25, 1000);

echo "Имя: ".           ($man6 -> getName()) .
     ", возраст: " .    ($man6 -> getAge()).
     ", зарплата: " .   ($man6 -> getSalary()) . "<br />";

/*-------------------------<>Задание 5----------------------*/
echo "<br /> <b>Задание 5 </b><br />";

class User{
    private $name;
    private $age;

    /**
     * @param $name
     */
    public function setName($name){
        $this->name = $name;
    }

    /**
     * @param $age
     */
    public function setAge($age){
        $this->age = $age;
    }

    /**
     * @return mixed
     */
    public function getName(){
        return $this->name;
    }

    /**
     * @return mixed
     */
    public function getAge(){
        return $this->age;
    }
}

class Worker extends User{
    private $salary;

    /**
     * @param $salary
     */
    public function setSalary($salary){
        $this->salary = $salary;
    }

    /**
     * @return mixed
     */
    public function getSalary(){
        return $this->salary;
    }
}

$worker1 = new Worker();
$worker2 = new Worker();

$worker1 -> setName('Иван');
$worker1 -> setAge(25);
$worker1 -> setSalary(1000);
$worker2 -> setName('Вася');
$worker2 -> setAge(26);
$worker2 -> setSalary(2000);

echo "Сумма зарплат Ивана и Васи: ".($worker1 -> getSalary() + $worker2 -> getSalary() )."<br />";

class  Student extends User{
    private $grants;
    private $course;

    /**
     * @param $grants
     */
    public function setGrants($grants){
        $this->grants = $grants;
    }

    /**
     * @param $course
     */
    public function setCourse($course){
        $this->course = $course;
    }

    /**
     * @return mixed
     */
    public function getGrants(){
        return $this->grants;
    }

    /**
     * @return mixed
     */
    public function getCourse(){
        return $this->course;
    }
}

$student1 = new Student();
$student1 -> setName('Петр');
$student1 -> setAge(17);
$student1 -> setCourse(1);
$student1 -> setGrants(500);

echo "Имя студента: ".  ($student1 -> getName()) .
    ", возраст: " .     ($student1 -> getAge()).
    ", курс: " .        ($student1 -> getCourse()).
    ", стипендия: " .   ($student1 -> getGrants()) . "<br />";

/*-------------------------<>Задание 6----------------------*/
echo "<br /> <b>Задание 6 </b><br />";

class  Driver extends Worker{
    private $DrvExperience;
    /**
     * @param $DrvExperience
     */
    public function setDrvExperience($DrvExperience){
        if (($this -> getAge()) > 18) {
            if ($DrvExperience > 1 && $DrvExperience < 60) {
                $this->DrvExperience = $DrvExperience;
            }
        }
    }

    /**
     * @param $DrvСategory
     */
    public function setDrvСategory($DrvСategory){
        if($DrvСategory == "A" || $DrvСategory == "B" || $DrvСategory == "C") {
            $this->DrvСategory = $DrvСategory;
        }
    }

    /**
     * @return mixed
     */
    public function getDrvExperience(){
        return $this->DrvExperience;
    }

    /**
     * @return mixed
     */
    public function getDrvСategory(){
        return $this->DrvСategory;
    }
}


$drv1 = new Driver();
$drv1 -> setName('Петр');
$drv1 -> setAge(29);
$drv1 -> setDrvExperience(5);
$drv1 -> setDrvСategory("C");

echo "Имя водителя: ".          ($drv1 -> getName()) .
    ", возраст: " .             ($drv1 -> getAge()).
    ", водительский стаж: " .   ($drv1 -> getDrvExperience()).
    ", категория вождения: " .   ($drv1 -> getDrvСategory()) . "<br />";

/*-------------------------<>Задание 7----------------------*/

echo "<br /> <b>Задание 7 </b><br />";
class Form{
    /**
     * @param $arr
     */
    function open($arr){
        echo "<form action='{$arr['action']}' method='{$arr['method']}'><br />";
    }

    /**
     * @param $arr
     */
    function input($arr){
        echo "<input type='{$arr['type']}' value='{$arr['value']}'><br />";
    }

    /**
     * @param $arr
     */
    function password($arr){
        echo "<input type='password' value='{$arr['value']}'><br />";
    }

    /**
     * @param $arr
     */
    function submit($arr){
        echo "<input type='submit' value='{$arr['value']}'><br />";
    }

    /**
     * @param $arr
     */
    function textarea($arr){
        echo "<textarea placeholder='{$arr['placeholder']}'>{$arr['value']}</textarea><br />";
    }

    function close(){
        echo "</form>";
    }
}

$form = new Form();

echo $form->open(['action'=>'index.php', 'method'=>'POST']);
//Код выше выведет <form action="index.php" method="POST">

echo $form->input(['type'=>'text', 'value'=>'!!!']);
//Код выше выведет <input type="text" value="!!!">

echo $form->password(['value'=>'!!']);
//Код выше выведет <input type="password" value="!!!">

echo $form->submit(['value'=>'go']);
//Код выше выведет <input type="submit" value="go">

echo $form->textarea(['placeholder'=>'123', 'value'=>'!!!']);
//Код выше выведет <textarea placeholder="123">!!!</textarea>

echo $form->close();
//Код выше выведет </form>


/*-------------------------<>Задание 8----------------------*/

echo "<br /> <b>Задание 8 </b><br />";

class Cookie{

    /**
     * @var array
     */
    private $cookieArray = [];
    public function set($nameCookie, $valueCookie){
        $this->cookieArray[$nameCookie] = $valueCookie;
    }

    /**
     * @param $nameCookie
     * @return string
     */
    public function get($nameCookie){
        if (array_key_exists($nameCookie, $this->cookieArray)) {
            return "Значение куки ". $nameCookie . " равно " . $this->cookieArray[$nameCookie] . "<br />";
        }
        else{
            return "Куки со значением ". $nameCookie . " НЕТ<br />";
        }
    }

    /**
     * @param $nameCookie
     * @return string
     */
    public function del($nameCookie){
        if (array_key_exists($nameCookie, $this->cookieArray)) {
             unset($this->cookieArray[$nameCookie]);
        }
        else{
            return "Куки со значением ". $nameCookie . " НЕТ<br />";
        }
    }
}
$cookie1 = new Cookie();
$cookie1 ->set('first', '111');
$cookie1 ->set('second', '222');

echo $cookie1->get('second');
echo $cookie1->get('first');

echo $cookie1->get('fifth');

echo $cookie1->del('first');

echo $cookie1->get('first');




/*-------------------------<>Задание 9 ----------------------*/

echo "<br /> <b>Задание 9 </b><br />";

class Session{
    private $ArrayVariable = [];
    private $SessionStat = false;
    /**
     * @param $nameVariable
     * @param $valueVariable
     */
    public function setVariable($nameVariable, $valueVariable){
        if ($this->SessionStat) {
            $this->ArrayVariable[$nameVariable] = $valueVariable;
        }
        else
        {
            echo "Необходимо запустить сессию!<br />";
        }
    }

    /**
     * @param $nameVariable
     * @return string
     */
    public function getVariable($nameVariable){
        if ($this->SessionStat) {
            if (array_key_exists($nameVariable, $this->ArrayVariable)) {
                return $nameVariable . " = " . $this->ArrayVariable[$nameVariable] . "<br />";
            } else {
                return "Переменной сессии " . $nameVariable . " НЕТ<br />";
            }
        }
        else{
                echo "Необходимо запустить сессию!<br />";
            }
    }

    /**
     * @param $nameVariable
     * @return string
     */
    public function delVariable($nameVariable){
        if ($this->SessionStat) {
            if (array_key_exists($nameVariable, $this->ArrayVariable)) {
                unset($this->ArrayVariable[$nameVariable]);
            }
            else{
                return "Переменная сессии ". $nameVariable . " НЕ Существует <br />";
            }
        }
        else{
            echo "Необходимо запустить сессию!<br />";
        }
    }

    /**
     * @param $nameVariable
     * @return string
     */
    public function statusVariable($nameVariable){
        if ($this->SessionStat) {
            if (array_key_exists($nameVariable, $this->ArrayVariable)) {
                return "Переменная сессии ". $nameVariable . " Существует<br />";
            }
            else{
                return "Переменная сессии ". $nameVariable . " НЕ Существует <br />";
            }
        }
        else{
            echo 'Необходимо запустить сессию!<br />';
        }
    }

    /**
     * Session constructor.
     * @param $session_start
     */
     function __construct($session_start){
         if($session_start == "session_start") {
                 $this->SessionStat = true;
         }
     }
}

$session1 = new Session('session_start');
$session1 ->setVariable('first', '111');
$session1 ->setVariable('second', '222');

$session1 = new Session('session_start');
echo $session1->getVariable('second');
echo $session1->getVariable('first');

echo $session1->delVariable('first');

echo $session1->getVariable('first');






