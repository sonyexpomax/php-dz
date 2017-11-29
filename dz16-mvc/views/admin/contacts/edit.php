<?php
/**
 * Created by PhpStorm.
 * User: gendos
 * Date: 11/20/17
 * Time: 19:56
 */

$isNew = empty($data) || isset($data['new']);

?>

<div class="col-lg-12">
    <h1><?=($isNew ? 'Create' : 'Edit')?> Message</h1>
</div>
<div class="col-lg-12">
    <form method="post" action="">
        <div class="form-group">
            <input class="form-control" name="name" value="<?=(isset($data['name']) ? $data['name'] : '')?>">
        </div>
        <div class="form-group">
            <input class="form-control" name="email" value="<?=(isset($data['email']) ? $data['email'] : '')?>">
        </div>
        <div class="form-group">
            <textarea rows="15" class="form-control" name="messages"><?=(isset($data['messages']) ? $data['messages'] : '')?></textarea>
        </div>

        <button type="submit" class="btn btn-success">Save</button>
    </form>
</div>

