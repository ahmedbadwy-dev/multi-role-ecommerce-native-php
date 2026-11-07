<?php
require_once  __DIR__ . "/../../../../model/Product.php";
require_once  __DIR__ . "/../../../../model/Image.php";
$instanse_image = new Image();



$instanse = new Product();
$products = $instanse->get_all_products();


?>
<div class="table-responsive">
    <table class="table table-striped table-borderless table-hover">
        <thead>
            <tr>

                <td scope="col"></td>
                <td scope="col">id</td>
                <td scope="col">title</td>
                <td scope="col">category</td>
                <td scope="col">price</td>
                <td scope="col">description</td>
                <td scope="col">rate</td>
                <td scope="col">Images</td>
                <td scope="col">modify</td>


            </tr>
        </thead>
        <tbody>
            <form action="../../controller/admin/product/DeleteproductController.php" method="post">
                
                
                <?php

$count=1;
foreach ($products as $product) {
            ?>
                <tr>
                    <td><input type="checkbox" name="product[]" value="<?= $product["id"] ?>"></input></td>
                    <td><?= $product["id"] ?></td>
                    <td><?= $product["title"] ?></td>
                    <td><?= $product["category"] ?></td>
                    <td><?= $product["price"] ?></td>
                    <td><?= $product["description"] ?></td>
                    <td><?= $product["rate"] ?></td>
                    <td>
                        <div class="img-container">

                            <img src="../../uploads/<?=$product["image"]?>" alt="" width="100%">
                        </div>
                   
                    </td>
                    <td><a href="ImagePage.php?action=add&productId=<?= $product["id"] ?>" class="btn btn-success">Upload</a></td>
                    <td>
                        <div class="d-flex flex-column flex-md-row">
                            <a href="../../controller/admin/product/DeleteproductController.php?productId=<?= htmlspecialchars($product['id']) ?> " class="btn btn-danger my-1 mx-1 py-2">Delete</a>

                            <a href="ProductPage.php?action=edit&productId=<?= htmlspecialchars($product['id']) ?> " class="btn btn-info ">Update</a>
                        </div>
                    </td>


                </tr>
            <?php } ?>
        </tbody>
        
        
        
        
        
    </table>
    <div class="d-flex justify-content-around w-100">


        <a href="ProductPage.php?action=add" class=" btn btn-success w-40 "style="width:40%">
            Create product
        </a>
        <button type="submit" class="btn btn-danger" style="width:40%">Drop All</button>
    </div>
</form>
</div>
<style>
    td {
        width: fit-content;

    }
</style>