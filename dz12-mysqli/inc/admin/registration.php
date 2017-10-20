<?php
/**
 * Created by PhpStorm.
 * User: max
 * Date: 01.10.17
 * Time: 20:01
 */
//var_dump($_SERVER);

if ($_SERVER['REQUEST_METHOD']=='POST'){
    $file = $config['files'][0][1];
    $login=htmlspecialchars($_POST['login']);
    $passwd=htmlspecialchars($_POST['password']);
    $passwd_cfrm=htmlspecialchars($_POST['password_confirm']);
    if ($passwd==$passwd_cfrm){
        if(strlen($passwd) >= 4) {
              if (search_login($login,$config['users'])==false) {
                $passwd = sha1($passwd . $salt);
                $config['users'][] = [
                    'login' => $login,
                    'passwd' => $passwd,
                ];
                file_put_contents($file, serialize($config['users']));

                echo "<div class='ok'>Вы успешно зарегестрированны!</div>";
            }
            else{
                $error = "Ошибка регистрации! Логин \"$login\" уже зарегестирован!";
            }
        }
        else{
            $error = "Ошибка регистрации! Пароль должен содержать не менее 4 символов!!!";
        }
    }
    else{
        $error = "Ошибка регистрации! Пароли должны совпадать!!!";
    }

}
function search_login($find, $str_massiv) {
    foreach ($str_massiv as $key => $val) {
        if ($val['login'] == $find) {
            return true;
            break;
        }
    }
    return false;
}
echo "
<!DOCTYPE html>
<html lang=\"en\">
<head>
    <meta charset=\"UTF-8\">
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
        .ok{
            width: 90%;
            text-align: center;
            color: #008800;
            font-size: 12px;
            margin:5px 0 5px 4%;
        }
    </style>
</head>
<body>
    <div class=\"reg_form\">
        <h1>Форма регистрации</h1>
        <form action=\"./index.php?page=registration\" method=\"post\" name=\"registration\">
            <input type=\"text\" name=\"login\" placeholder=\"Введите ваш логин\" required><br />
            <input type=\"password\" name=\"password\" placeholder=\"Введите пароль\" required><br />
            <input type=\"password\" name=\"password_confirm\" placeholder=\"Подтверждение пароля\" required><br />
            <input type=\"submit\" value=\"Зарегестрироваться\" name=\"submit\">
        </form>
        <a href='./index.php?page=auth'>Войти</a>";
        if(isset($error))  echo "<div class='error'>$error</div>";
echo "
</div>
</body>
</html>
";
?>