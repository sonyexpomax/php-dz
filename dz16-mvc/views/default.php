<?php
/**
 * Created by PhpStorm.
 * User: gendos
 * Date: 11/6/17
 * Time: 20:25
 */

/** @var array $data */

$router = \App\Core\App::getRouter();
$session = \App\Core\App::getSession();

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title><?=\App\Core\Config::get('siteName')?></title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
    <link rel="stylesheet" href="/css/default.css" >
</head>
<body>
    <nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
        <a class="navbar-brand" href="/"><?=__('header.homepage')?></a>

        <div class="collapse navbar-collapse" id="navbarsExampleDefault">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="<?=$router->buildUri('pages.index')?>"><?=__('header.pages')?></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?=$router->buildUri('contacts.index')?>"><?=__('header.contact_us')?></a>
                </li>
            </ul>

            <?php if(\App\Core\Session::get('login')){ ?>
                <a href="/users/logout/" type="button" class="btn second-button btn-default navbar-btn">
                    <span class="glyphicon glyphicon-shopping-cart"></span><?=\App\Core\Session::get('login')?>, exit?
                </a>
            <?php }else { ?>
                <a href="/users/login/" type="button" class="btn second-button btn-default navbar-btn">
                    <span class="glyphicon glyphicon-shopping-cart"></span>Enter
                </a>
            <?php }?>
        </div>
    </nav>
    <main class="container main">
        <div class="row">
            <?php if(\App\Core\Session::hasFlash()){ ?>
                <div class="alert alert-info" role="alert">
                    <?php foreach (\App\Core\Session::flash() as $message){
                        echo $message;
                    }?>
                </div>
            <?php }?>
            <?=$data['content']?>
        </div>
    </main>
</body>
</html>
