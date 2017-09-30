<?php
/**
 * Created by PhpStorm.
 * User: gendos
 * Date: 9/18/17
 * Time: 18:52
 */
//ini_set('display_errors', 1);
$filename = __DIR__.'/data.txt';
$censoredFilename = __DIR__.'/censored.txt';
// Массив содержит все комментарии
$comments = unserialize(file_get_contents($filename));

// Слова которые мы должны фильтровать
$censored = explode(
    PHP_EOL,
    file_get_contents($censoredFilename)
);
// Строка с сообщением об ошибка
$errors = [];
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Логика оработки запроса
    $author = htmlspecialchars($_POST['author']);
    $comment = htmlspecialchars($_POST['comment']);
    $email = htmlspecialchars($_POST['email']);
    //var_dump(search_email($email,$comments));
    if (search_email($email,$comments)==false) {
        if (strlen($author) && strlen($comment) && strlen($email)) {
            $comments[] = [
                'date' => date('H:i:s d.m.Y'),
                'timestamp' => time(),
                'author' => $author,
                'comment' => $comment,
                'email' => $email,
            ];
            file_put_contents($filename, serialize($comments));
        } else {
            $errors[] = "Форма заполнена некорректно";
        }
     }
    else{
        $errors[] = "Человек с такиим e-mail уже заполнял форму!";
    }
}
usort($comments, function ($a, $b) {
    return (isset($a['timestamp']) && $a['timestamp'] > $b['timestamp']) ? -1 : 1;
});

function search_email($email, $comments) {
    foreach ($comments as $key => $val) {
        if ($val['email'] == $email) {
            return true;
            break;
        }
    }
   return false;
}

?>
<DOCTYPE html>
    <html>
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <title>Comments</title>
    </head>
    <body>

    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <h2>Поделитесь вашим мнением</h2>
                <?if (!empty($errors)):?>
                    <div class="alert alert-danger">
                        <?=implode('<br>', $errors)?>
                    </div>
                <?endif;?>
                <form method="post">
                    <div class="form-group">
                        <label for="author">Ваше имя:</label>
                        <input type="text" class="form-control"
                               name="author" id="author" required
                               placeholder="Имя пишите здесь">
                    </div>
                    <div class="form-group">
                        <label for="email">Ваш email :</label>
                        <input type="email" class="form-control"
                               name="email" id="email" required
                               placeholder="Ваш email здесь">
                    </div>
                    <div class="form-group">
                        <label for="comment">Ваше мнение:</label>
                    <textarea name="comment" class="form-control"
                              id="comment" ></textarea>
                    </div>

                    <button type="submit" class="btn btn-primary">
                        Отправить
                    </button>
                </form>
            </div>
            <div class="col-md-6 col-md-offset-3">
                <?php
                //---------------------------------------------- Вывод комметариев-----------------------------
                $comments_count=count($comments);
                $str_count= ceil($comments_count/5);
                if (isset($_GET['p']) && ($_GET['p'] < 1 || $_GET['p'] > $str_count) ) {
                    header( 'Location:?p=1');
                }
                else {
                    //var_dump($comments);
                    if (isset($_GET['p']) && $_GET['p'] > 0) {
                        $page = (int)$_GET['p'];
                        $j_start = $page * 5 - 5;
                        $j_end = $page * 5 - 1;
                    } else {
                        $j_start = 0;
                        $j_end = 4;
                    }
                    for ($j = $j_start; $j <= $j_end; $j++) {
                        // Убираем нежелательные слова из полей
                        $comments[$j]['author'] = str_ireplace($censored,'[censored]',$comments[$j]['author']);
                        $comments[$j]['comment'] = str_ireplace($censored,'[censored]',$comments[$j]['comment']);
                        echo "
                        <div class=\"panel panel-success\">
                                <div class=\"panel-heading\">
                                    {$comments[$j]['author']}
                                    <span>{$comments[$j]['date']}</span>
                                </div>
                                <div class=\"panel-heading\">
                                    <b>email:</b> {$comments[$j]['email']}
                                </div>
                                <div class=\"panel-body\">
                                    {$comments[$j]['comment']}
                                </div>
                            </div>
                            <hr>
                        ";
                    }

                    // Вывод ссылок постраничной навигации
                    echo "<div class=\"pagination\">";
                    for ($i = 1; $i <= $str_count; $i++) {
                        if ($page == $i) {
                            echo "<strong style='margin: 5px; text-decoration: none; color: red;font-weight: 600; font-size: larger'>{$i}</strong>";
                        } else {
                            echo "<a style='margin: 5px;' href=\"?p={$i}\">{$i}</a>";
                        }
                    }
                }



                ?>
            </div>
            </div>
        </div>
    </div>
    </body>
    </html>