<?php
//ini_set("display_errors",1);
//error_reporting(E_ALL);
$NewCategory = new \App\Entity\Category(\App\DB\Connection::getInstance());
if (isset($_POST['save'])) {
    $id = $_POST['id'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    $data = [];
    if (strlen($title)) {
        $data['title'] = $title;
        $data['description'] = $description;
    }
    if (!empty($data)) {
        if ($id > 0) {
            $result = $NewCategory->update($id, $data);
        }
        else {
            $result = $NewCategory->create($data);
        }
    }
}
if (isset($_GET['del'])) {
    $del_id = $_GET['del'];
    $NewCategory->delete($del_id);
   // $result = deleteCategory($del_id);
}
$id = $_GET['id'];
$str_count = ceil($NewCategory->getCount()/5);
if (isset($_GET['p']) && ($_GET['p'] >= 1 || $_GET['p'] <= $str_count) ) {
    $p = $_GET['p'];
}
else{
    $p = 1;
}

$CategoryList = $NewCategory->get($p);
?>

<div class="list">
    <h2>Список имеющихся категорий</h2>
    <ol start = '<?=($p*5-4)?>'>
        <?php
        while ($category = mysqli_fetch_assoc($CategoryList)) {
            ?>
            <li>
                <a href="?page=category&id=<?=$category['id']?>" title="Описание: <?=substr($category['description'], 0, 35); ?>...">
                    <?=$category['title']?>
                </a>
                <a href="?page=category&del=<?=$category['id']?>">
                    <img src="http://www.pizzaboy.de/style/image/32/delete.png" alt="Удалить" title="Удалить"></a>
            </li>
            <?php
        }
        ?>
    </ol>
    <div class="pagination">
        <?php for ($i = 1; $i <= $str_count; $i++) {
            if ($p == $i) {
            ?>
                <strong style='margin: 5px; text-decoration: none; color: red;font-weight: 600; font-size: larger'><?=$i?></strong>
            <?php
            } else {
            ?>
                <a style='margin: 5px;' href='?page=category&p=<?=$i?>'><?=$i?></a>
            <?php
            }
        }
        ?>
    </div>
</div>
<div class="add_form">
         <?php
           if (isset($id)) {
            $title = '';
            if ($id > 0) { ?>
                <h2>Редактирование категории</h2>
                <?php
                $category = mysqli_fetch_assoc($NewCategory->get(0, $id));
                $title = $category['title'];
                $description = $category['description'];
            }
            if ($id == 0) {?>
                <h2>Добавление категорий</h2>
                <?php
            }
            ?>
            <form action="?page=category" method="post">
                <input type="hidden" name="id" value="<?=$id?>">
                <p>Название:</p>
                <input type="text" value="<?=$title?>"
                       placeholder="Название категории" name="title">
                <p>Описание:</p>
                <textarea name="description" placeholder="Описание категории"><?=$description?></textarea>
                <input type="submit" name="save" value="Сохранить">
            </form>
        <?php }
        else{?>
    <h2>Добавление категорий</h2>
    <div class="link">
        <a href="?page=category&id=0">Добавить категорию</a>
    </div>
        <?php } ?>
    </div>

