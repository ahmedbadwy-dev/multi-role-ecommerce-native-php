<?php
require_once __DIR__ . "/../../../../model/Product.php";
require_once __DIR__ . "/../../../../model/Image.php";

$productClass = new Product();
$imageClass = new Image();

$action = $_GET["action"] ?? null;
$productId = $_GET["productId"] ?? null;
if ($productId != null) {
    $product = $productClass->get_product($productId);
    $images = $imageClass->get_images_by_id([$productId]);
}

$categories = $productClass->get_all_categories();
?>


<div class="card">
    <div class="card-header text-center">
        <h3> Update product<?= isset($productId) ? htmlspecialchars($product['title']) : '' ?></h3>
    </div>
    <div class="card-body">
        <form action="../../controller/admin/product/UpdateProductController.php" method="post" enctype="multipart/form-data">
            <input type="hidden" value="<?= $action == 'edit' && isset($productId) ? htmlspecialchars($product['id']) : '' ?>" name="id">
            <div class="form-group">
                <label for="productname">productname</label>
                <input type="text" name="productname" value="<?= $action == 'edit' && isset($productId) ? htmlspecialchars($product['title']) : '' ?>" class="form-control">
                <p class="text-danger"><?= isset($_SESSION["productsError"]["productname"]) ? $_SESSION["productsError"]["productname"] : '' ?></p>
            </div>
            <div class="form-group">
                <label for="price">price</label>
                <input type="price" name="price" id="price" class="form-control" value="<?= $action == 'edit' && isset($productId) ? htmlspecialchars($product['price']) : '' ?>">
                <p class="text-danger"><?= isset($_SESSION["productsError"]["price"]) ? $_SESSION["productsError"]["price"] : '' ?></p>
            </div>
            <div class="form-group">
                <label for="rate">rate</label>
                <input type="rate" name="rate" value="<?= $action == 'edit' && isset($productId) ? htmlspecialchars($product['rate']) : '' ?>" id="rate" class="form-control">
                <p class="text-danger"><?= isset($_SESSION["productsError"]["rate"]) ? $_SESSION["productsError"]["rate"] : '' ?></p>

            </div>

            <div class="form-group">
                <label for="description">Description</label>
                <textarea name="description" id="description" class="form-control">
                    <?= $action == 'edit' && isset($productId) ? htmlspecialchars($product['description']) : 'ytuytiut' ?>
                </textarea>
                <p class="text-danger"><?= isset($_SESSION["productsError"]["description"]) ? $_SESSION["productsError"]["description"] : '' ?></p>

            </div>
            <div class="form-group">
                <label for="category">category</label>
                <select name="category" id="category" class="form-control">
                    <?php
                    foreach ($categories as $category) {
                    ?>
                        <option value="<?= htmlspecialchars($category['id']) ?>" <?= isset($productId) && $action == 'edit' && $category["id"] == $product["category_id"] ? 'selected' : '' ?>><?= htmlspecialchars($category["category"]) ?></option>
                    <?php } ?>
                </select>
                <p class="text-danger"><?= isset($_SESSION["productsError"]["category"]) ? $_SESSION["productsError"]["category"] : ''  ?></p>

            </div>
           
                <div class="form-group">
                    <div>
                        <img src="<?= "../../uploads/" . $product['image'] ?>" alt="">
                    </div>
                    <label for="img">update Image Product</label>
                    <input style="font-size:20px; font-weight:500;" type='file' name="image" class="form-control" style=" font-size: 20px; ">
                </div>
           
            <div class=" form-group">
                <input style="font-size:20px; font-weight:500; " type="submit" value="Update :  <?= htmlspecialchars($product['title']) ?>  " class="btn btn-success w-100 py-1 form-control" style="font-size: 20px; ">
            </div>
        </form>
    </div>
    <?php
    if (isset($_SESSION["productsError"])) {
        unset($_SESSION["productsError"]);
    }
    ?>
</div>