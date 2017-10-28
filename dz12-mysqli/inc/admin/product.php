<?php
if (isset($_POST['save'])) {
    $id = $_POST['id'];
    $title = $_POST['title'];
    $price = $_POST['price'];
    $description = $_POST['description'];
    $category_id = $_POST['category_id'];
    $data = [];
    if (strlen($title)) {
        $data['title'] = $title;
        $data['description'] = $description;
        $data['price'] = $price;
        $data['price'] = $price;
        $data['category_id'] = $category_id;
    }
    if (!empty($data)) {
        if ($id > 0) {
            $result = updateProduct($id, $data);
        } else {
            $result = createProduct($data);
        }
    }
}
if (isset($_GET['del'])) {
    $del_id = $_GET['del'];
    $result = deleteProduct($del_id);
}

$id = $_GET['id'];
$productResult = productList();
$categoryResult = categoryList();

?>

<div class="list">
    <h2>Список имеющихся товаров</h2>
    <ul>
        <?php
        while ($product = mysqli_fetch_assoc($productResult)) {
            ?>
            <li>
                <a href="?page=product&id=<?=$product['id']?>" title="Описание: <?=substr($product['description'], 0, 35); ?>...">
                    <?=$product['title']?>
                </a>
                <a href="?page=product&del=<?=$product['id']?>">
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
            <h2>Редактирование товаров</h2>
            <?php
            $product = mysqli_fetch_assoc(productList($id));
            $title = $product['title'];
            $description = $product['description'];
            $category_id = $product['category_id'];
        }
        if ($id == 0) {?>
            <h2>Добавление товаров</h2>
            <?php
        }

        ?>
        <form action="?page=product" method="post">
            <input type="hidden" name="id" value="<?=$id?>">
            <p>Название:</p>
            <input type="text" value="<?=$title?>" placeholder="Название продукции" name="title">
            <p>Цена:</p>
            <input type="text" value="<?=$title?>" placeholder="Цена продукции" name="price">
            <p>Категория продукции:</p>
            <select name="category_id">
                <?php while ($category = mysqli_fetch_assoc($categoryResult)) {
                        if ($category_id != $category['id']) { ?>
                            <option value="<?=$category['id'] ?>"><?=$category['title'] ?></option>
                        <?php }
                        else{?>
                            <option value="<?=$category['id'] ?>" selected><?=$category['title'] ?></option>
                        <?php  }
                } ?>
            </select>
            <p>Описание:</p>
            <textarea name="description" placeholder="Описание продукции"><?=$description?></textarea>
            <input type="submit" name="save" value="Сохранить">
        </form>
    <?php }
    else{?>
        <h2>Добавление продукции</h2>
        <div class="link">
            <a href="?page=product&id=0">Добавить продукцию</a>
        </div>
    <?php } ?>
</div>

