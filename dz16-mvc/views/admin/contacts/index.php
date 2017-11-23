<?php
/**
 * Created by PhpStorm.
 * User: gendos
 * Date: 11/6/17
 * Time: 20:10
 */

$router = \App\Core\App::getRouter();


?>
<div class="col-lg-12">
    <h1>Messages management</h1>
</div>

<div class="col-lg-12">
    <ul class="list-group">
        <li class="list-group-item active">Messages List</li>
        <?php  foreach ($data as $message):?>
            <li class="list-group-item">
                <p class="font-weight-normal">Name - <?= $message['name'] ?> </p>
                <p class="font-italic">Email - <?= $message['email'] ?></p>

                <a class="btn btn-sm btn-success"
                   href="<?=$router->buildUri('edit', [$message['id']])?>">Edit</a>

                <a class="btn btn-sm btn-warning" onclick="return confirmDelete();"
                   href="<?=$router->buildUri('delete', [$message['id']])?>">Delete</a>

            </li>
        <?php endforeach;?>
    </ul>
</div>
