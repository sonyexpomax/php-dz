<?php
/**
 * Created by PhpStorm.
 * User: gendos
 * Date: 9/27/17
 * Time: 19:50
 */
if (isset($_GET['stat']) && $_GET['stat']=='out'){
    session_unset();
    header( 'Location:./index.php');
}
?>
    <nav>
            <ul>
                <?php foreach ($config['menu'] as $item): ?>
                    <li>
                        <a href="index.php?page=<?= $item['id'] ?>">
                            <?= $item['title'] ?>
                        </a>
                    </li>
                <?php endforeach; ?>
                <li>
                    <p>Привет, {{login}} !</p> <a href="./index.php?stat=out">Выйти</a>
                </li>
            </ul>

    </nav>
    

