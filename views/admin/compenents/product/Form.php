<?php
require_once __DIR__ . "/../../../../model/product.php";

$productClass = new product();





$categories = $productClass->get_all_categories();

?>


<div class="card">
    <div class="card-header text-center">
        <h3> "Create New product" </h3>
    </div>
    <div class="card-body">
        <form action="../../controller/admin/product/AddProductController.php" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="productname">productname</label>
                <input type="text" name="productname" class="form-control">
                <p class="text-danger"><?= isset($_SESSION["productsError"]["productname"]) ? $_SESSION["productsError"]["productname"] : '' ?></p>
            </div>
            <div class="form-group">
                <label for="price">price</label>
                <input type="number" name="price" id="price" class="form-control">
                <p class="text-danger"><?= isset($_SESSION["productsError"]["price"]) ? $_SESSION["productsError"]["price"] : '' ?></p>

            </div>
            <div class="form-group">
                <label for="rate">Rate</label>
                <input type="number" name="rate" id="rate" class="form-control">
                <p class="text-danger"><?= isset($_SESSION["productsError"]["rate"]) ? $_SESSION["productsError"]["rate"] : '' ?></p>

            </div>
            <div class="form-group">
                <label for="Description">Description</label>
                <textarea name="description" id="Description">

                                   </textarea>
                <p class="text-danger"><?= isset($_SESSION["productsError"]["description"]) ? $_SESSION["productsError"]["description"] : '' ?></p>

            </div>
            <div class="form-group">
                <label for="category">category</label>
                <select name="category" id="category" class="form-control">
                    <?php
                    foreach ($categories as $category) {
                    ?>
                        <option value="<?= htmlspecialchars($category['id']) ?>"><?= htmlspecialchars($category["category"]) ?></option>
                    <?php } ?>
                </select>
                <p class="text-danger"><?= isset($_SESSION["productsError"]["category"]) ? $_SESSION["productsError"]["category"] : ''  ?></p>

            </div>
            <div class="form-group">
                <label for="image">Image</label>
                <input type="file" name="images" id="image" class="form-control" >
                <p class="text-danger"><?= isset($_SESSION["productsError"]["image"]) ? $_SESSION["productsError"]["image"] : '' ?></p>

            </div>
            <div class="form-group">
                <input type="submit" value="Create product" class="btn btn-success w-100 py-1 form-control" style="font-size: 20px; ">
            </div>
        </form>
    </div>



</div>
<?php

if (isset($_SESSION["productsError"])) {
    unset($_SESSION["productsError"]);
}
?>