<?php
require_once __DIR__ . "/../../../model/Product.php";
$productClass = new Product();

$action = $_GET["action"] ?? null;
$productId = $_GET["productId"] ?? null;
if ($productId != null) {
    $product = $productClass->get_product($productId);
}

$categories=$productClass->get_all_categories();

?>


<div class="card">
    <div class="card-header">
        <h3><?= $action == "add" ? "Create New product" : " Update Product" ?></h3>
    </div>
    <div class="card-body">
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" name="title" value="<?= $action == 'edit' && isset($productId) ? htmlspecialchars($product['title']) : '' ?>" class="form-controller">
        </div>
        <div class="form-group">
            <label for="price">Price</label>
            <input type="number" name="password" id="price" class="form-controller" <?= $action == 'edit' && isset($productId) ? htmlspecialchars($product['price']) : '' ?>>
        </div>
        <div class="form-group">
            <label for="email">Description</label>
            <textarea name="description" id="description" value="<?= $action=='edit' && isset($productId) ?$product['description'] :'' ?>"></textarea>
        </div>
        <div class="form-group">
            <label for="number">Number</label>
            <input type="number" name="number" value="<?= $action == 'edit' && isset($productId) ? htmlspecialchars($product['rate']) : '' ?>" id="number" class="form-controller">
        </div>

        <div class="form-group">
            <label for="category">Category</label>
            <select name="category" id="category">
                <?php 
                 foreach($categories as $category){
                ?>
               <option value="<?= $category['id'] ?>" <?= $action=='edit' && isset($productId) ?'selected':'' ?> ><?=  $category['category']?></option>
<?php  } ?>
            </select>
          

    </div>