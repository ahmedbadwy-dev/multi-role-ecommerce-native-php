<?php
require_once __DIR__ . "/../../sessionConfig.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="../../asset/css/sb-admin-2.min.css" rel="stylesheet">
  <link rel="stylesheet" href="./style-admin-pages/admin.css">
</head>

<body>
    <main id="wrapper">
        <?php
        require_once __DIR__ . "/includes/sidebar.php";
        ?>
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <?php
                require_once __DIR__ . "/../admin/includes/Header.php";
                ?>

                <div class="container-fluid">
                    <?php

                    if (isset($_SESSION["insertProductStatus"])) { ?>

                        <div class="alert alert-success text-center w-50 mx-auto mt-2 rounded-2"><?= isset($_SESSION["insertProductStatus"]) ? $_SESSION["insertProductStatus"] : ''  ?></div>

                    <?php
                    }
                    if (isset($_SESSION["insertProductError"])) {
                    ?>
                        <div class="alert alert-danger text-center w-50 mx-auto mt-2 rounded-2"><?= isset($_SESSION["insertProductError"]) ? $_SESSION["insertProductError"] : ''  ?></div>
                    <?php
                    }
                    if (isset($_SESSION["updateproductStatus"])) { ?>


                        <div class="alert alert-success text-center w-50 mx-auto mt-2 rounded-2"><?= isset($_SESSION["updateproductStatus"]) ? $_SESSION["updateproductStatus"] : ''  ?></div>

                    <?php
                    }
                    if (isset($_SESSION["updateproductError"])) { ?>


                        <div class="alert alert-danger text-center w-50 mx-auto mt-2 rounded-2"><?= isset($_SESSION["updateproductError"]) ? $_SESSION["updateproductError"] : ''  ?></div>

                    <?php
                    }

                    if (isset($_SESSION["deleteproductError"])) { ?>


                        <div class="alert alert-danger text-center w-50 mx-auto mt-2 rounded-2"><?= isset($_SESSION["deleteproductError"]) ? $_SESSION["deleteproductError"] : ''  ?></div>

                    <?php
                    }
                    if (isset($_SESSION["deleteproductStatus"])) { ?>


                        <div class="alert alert-success text-center w-50 mx-auto mt-2 rounded-2"><?= isset($_SESSION["deleteproductStatus"]) ? $_SESSION["deleteproductStatus"] : ''  ?></div>

                    <?php
                    }

                    if (isset($_GET["action"])) {



                        if ($_GET["action"] == 'edit' && isset($_GET["productId"])) {

                            require_once __DIR__ . "/compenents/product/FormUpdate.php";
                        } elseif ($_GET["action"] == 'add') {
                            require_once __DIR__ . "/compenents/product/Form.php";
                        }
                    } else {

                        require_once __DIR__ . "/compenents/product/Table.php";
                    ?>
                       

                    <?php  }
                    if (isset($_SESSION["insertProductStatus"])) {

                        unset($_SESSION["insertProductStatus"]);
                    }
                    if (isset($_SESSION["updateProductStatus"])) {
                        # code...
                        unset($_SESSION["updateProductStatus"]);
                    }
                    if (isset($_SESSION["deleteProductStatus"])) {
                        # code...
                        unset($_SESSION["deleteProductStatus"]);
                    }
                    if (isset($_SESSION["inserProductError"])) {
                        unset($_SESSION["inserProductError"]);
                        
                    }
                    if (isset($_SESSION["updateProductError"])) {
                        # code...
                        unset($_SESSION["updateProductError"]);
                    }
                    if (isset($_SESSION["deleteProductError"])) {
                        # code...
                        unset($_SESSION["deleteProductError"]);
                    }


                    ?>
                </div>
            </div>
        </div>
    </main>
</body>

</html>