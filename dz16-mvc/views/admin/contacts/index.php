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

    <table class="table table-condensed">
        <thead>
        <tr>
            <th>Id</th>
            <th>Name</th>
            <th>Email</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>

        <?php
        foreach ($data as $message):?>
            <tr>
                <td><?=$message['id']?></td>
                <td><?=$message['name']?></td>
                <td><?=$message['email']?></td>
                <td>
                    <a class="btn btn-md btn-success"
                       href="<?=$router->buildUri('edit', [$message['id']])?>">Edit</a>

                    <a class="btn btn-md btn-warning" onclick="return confirmDelete();"
                       href="<?=$router->buildUri('delete', [$message['id']])?>"><span class="glyphicon glyphicon-remove"></span> Remove </a>
                    <span class=""></span>
                </td>
            </tr>
        <?php endforeach;?>
        </tbody>
    </table>


</div>
