<?php
require_once __DIR__ . "/../../../../model/Image.php";
$instanseImages = new Image();
$products = $instanseImages->get_images();

?>
<table class="table table-white table-hover  ">
    <thead>
        <tr>
            <th>id</th>
            <th>product</th>
            <th>Images</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($products as $product) { ?>
            <tr>
                <td><?= $product["id"] ?></td>
                <td><?= $product["title"] ?></td>
                <td>
                    <?php
                    foreach ($product["images"] as $image) { ?>
               

                           <img width="30%" src="../../uploads/<?= $image ?>" alt="">
                
                    <?php } ?>
                </td>
            </tr>
        <?php }  ?>
    </tbody>
</table>
