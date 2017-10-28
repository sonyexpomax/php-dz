<?php
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
            $result = updateCategory($id, $data);
        } else {
            $result = createCategory($data);
        }
    }
}
if (isset($_GET['del'])) {
    $del_id = $_GET['del'];
    $result = deleteCategory($del_id);
}
$id = $_GET['id'];
$categoryResult = categoryList();


?>

<div class="list">
    <h2>Список имеющихся категорий</h2>
    <ul>
        <?php
        while ($category = mysqli_fetch_assoc($categoryResult)) {
            ?>
            <li>
                <a href="?page=category&id=<?=$category['id']?>" title="Описание: <?=substr($category['description'], 0, 35); ?>...">
                    <?=$category['title']?>
                </a>
                <a href="?page=category&del=<?=$category['id']?>">
                    <img src="http://s1.iconbird.com/ico/2013/10/464/w512h5121380984637delete1.png" alt="Удалить" title="Удалить"></a>
            </li>
            <?php
        }
        ?>
    </ul>
</div>
<div class="add_form">
         <?php
           if (isset($id)) {
            $title = '';
            if ($id > 0) { ?>
                <h2>Редактирование категории</h2>
                <?php
                $category = mysqli_fetch_assoc(categoryList($id));
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

