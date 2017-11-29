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
    <h1>Pages management</h1>
</div>

<div class="col-lg-12">
    <div class="row">
        <div class="col-lg-12 mb-15">
            <a class="btn btn-success"
               href="<?=$router->buildUri('edit')?>">Create page</a>
        </div>
    </div>

   <table class="table table-condensed">
        <thead>
        <tr>
            <th>Id</th>
            <th>Title</th>
            <th>Published</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>

        <?php
        foreach ($data as $page):?>
            <tr>
                <td><?=$page['id']?></td>
                <td><?=$page['title']?></td>
                <td><?php if($page['active'] == 1){ ?>
                        <h3>
                            <span class="badge badge-primary">
                                YES
                            </span>
                        </h3>
                    <?php } else { ?>
                       <h3>
                           <span class="badge badge-danger">NO</span>
                        </h3>
                    <?php } ?></td>
                <td>
                    <a class="btn btn-md btn-success"
                       href="<?=$router->buildUri('edit', [$page['id']])?>">Edit</a>

                    <a class="btn btn-md btn-warning" onclick="return confirmDelete();"
                       href="<?=$router->buildUri('delete', [$page['id']])?>">Delete</a>
                </td>
            </tr>
        <?php endforeach;?>
        </tbody>
    </table>






</div>
