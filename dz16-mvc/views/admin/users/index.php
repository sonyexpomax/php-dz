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
    <h1>Users management</h1>
</div>

<div class="col-lg-12">
    <form method="post" action="">
    <table class="table table-condensed">
        <thead>
        <tr>
            <th>Login</th>
            <th>Role</th>
            <th>Email</th>
            <th>Active</th>
        </tr>
        </thead>
        <tbody>

        <?php
                foreach ($data as $user):?>
                <tr>
                    <td><?=$user['login']?></td>
                    <td><?=$user['role']?></td>
                    <td><?=$user['email']?></td>
                    <td><input name = "active[<?=$user['id']?>][]" data-reverse type="checkbox" <?php if($user['active']=='1') { ?> checked <?php } ?>></td>
                </tr>
        <?php endforeach;?>
            <tr>
               <td>
                   <input name="submit" type="submit" class="btn btn-lg btn-success" value="Save state(s) of user(s)">
               </td>
            </tr>

        </tbody>
    </table>
    </form>
</div>

