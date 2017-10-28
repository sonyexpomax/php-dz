<?php
/**
 * Created by PhpStorm.
 * User: gendos
 * Date: 10/16/17
 * Time: 19:45
 */
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Наш интернет магазин</title>
    <link rel="stylesheet" type="text/css" media="all"  href="style.css">
    <link href="https://fonts.googleapis.com/css?family=Permanent+Marker" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
<div class="title"><h3>Наш интернет магазин (АДМИН)</h3></div>
    <nav>
        <ul>
            <li>
                <a href="?page=main">Главная</a>
            </li>
            <li>
                <a href="?page=category">Категории</a>
            </li>
            <li>
                <a href="?page=product">Товары</a>
            </li>
        </ul>
        <div class="exit">
            <a href="?out">
                <?=$_SESSION['login']?>
                <i class="fa fa-sign-in" aria-hidden="true"></i>
                выйти
            </a>
        </div>
    </nav>

<main>



