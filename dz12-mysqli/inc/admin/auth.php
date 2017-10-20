<?php
/**
 * Created by PhpStorm.
 * User: gendos
 * Date: 9/27/17
 * Time: 21:01
 */
/**
 * Тут должна быть проверка логина и пароля
 * если они правильные, то нужно поставить $_SESSION['auth'] = true;
 * затем обновить страницу.
 */
if ($_SERVER['REQUEST_METHOD']=='POST'){
    $file = $config['files'][0][1];
    $login=htmlspecialchars($_POST['login']);
    $passwd=htmlspecialchars($_POST['password']);
    if(strlen($passwd) >= 4) {
        $passwd = sha1($passwd . $salt);
        if (search_login_passwd($login, $passwd, $config['users'])!=false) {
            $_SESSION['auth'] = true;
            $_SESSION['login'] = $login;
            require 'config'.DS.'global.php';
            header( 'Location:./index.php');
            die;
        }
        else{
            $error = "Ошибка входа! Логин или пароль не найдены!";
        }
    }
    else{
        $error = "Ошибка входа! Пароль должен содержать не менее 4 символов!!!";
    }

}
if (isset($error))  {echo "<div class='error'>$error</div>";}
function search_login_passwd($login,$passwd,$str_massiv) {
    foreach ($str_massiv as $key => $val) {
        if ($val['login'] == $login && $val['passwd'] == $passwd ) {
            return $key;
            break;
        }
    }
    return false;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Registration</title>
    <style>
        .reg_form{
            width: 500px;
            margin: 50px auto;
            padding: 20px;
            border: solid 1px #000000;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.5);
        }
        input{
            width: 90%;
            margin:5px 0 5px 4%;
        }
        h1{
            width: 100%;
            text-align: center;
            font-size: 24px;
        }
        .error{
            color: #ff0000;
            font-size: 12px;
            width: 90%;
            margin:5px 0 5px 4%;
            text-align: center;
        }
        a{
            margin: 4%;
            text-decoration: none;
            font-size: 14px;
        }
        a:hover{
            text-decoration: underline;
        }
    </style>
</head>
<body>
<div class="reg_form">
    <h1>Вход</h1>
    <form action="./index.php" method="post" name="auth">
        <input type="text" name="login" placeholder="Введите ваш логин" required><br />
        <input type="password" name="password" placeholder="Введите пароль" required><br />
        <input type="submit" value="Войти" name="submit">
    </form>
    <a href="./index.php?page=registration">Регистрация</a>
</div>
</body>
</html>

