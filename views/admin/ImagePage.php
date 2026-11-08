<?php
require_once __DIR__ . "/../../sessionConfig.php";
      if(!$_SESSION["dataUser"]["permissions"] ||!in_array("read_post", $_SESSION["dataUser"]["permissions"]) ) {

    header("location:../Auth.php");
    exit();
  
      
      }?>



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

                    if (isset($_SESSION["insertImageStatus"])) { ?>

                        <div class="alert alert-success text-center w-50 mx-auto mt-2 rounded-2"><?= isset($_SESSION["insertImageStatus"]) ? $_SESSION["insertImageStatus"] : ''  ?></div>

                    <?php
                    }
                    if (isset($_SESSION["insertImageError"])) {
                    ?>
                        <div class="alert alert-danger text-center w-50 mx-auto mt-2 rounded-2"><?= isset($_SESSION["insertImageError"]) ? $_SESSION["insertImageError"] : ''  ?></div>
                    <?php
                    }
                    if (isset($_SESSION["updateImageStatus"])) { ?>


                        <div class="alert alert-success text-center w-50 mx-auto mt-2 rounded-2"><?= isset($_SESSION["updateImageStatus"]) ? $_SESSION["updateImageStatus"] : ''  ?></div>

                    <?php
                    }
                    if (isset($_SESSION["updateImageError"])) { ?>


                        <div class="alert alert-danger text-center w-50 mx-auto mt-2 rounded-2"><?= isset($_SESSION["updateImageError"]) ? $_SESSION["updateImageError"] : ''  ?></div>

                    <?php
                    }

                    if (isset($_SESSION["deleteImageError"])) { ?>


                        <div class="alert alert-danger text-center w-50 mx-auto mt-2 rounded-2"><?= isset($_SESSION["deleteImageError"]) ? $_SESSION["deleteImageError"] : ''  ?></div>

                    <?php
                    }
                    if (isset($_SESSION["deleteImageStatus"])) { ?>


                        <div class="alert alert-success text-center w-50 mx-auto mt-2 rounded-2"><?= isset($_SESSION["deleteImageStatus"]) ? $_SESSION["deleteImageStatus"] : ''  ?></div>

                    <?php
                    }

                    if (isset($_GET["action"])) {



                        if ($_GET["action"] == 'edit' && isset($_GET["ImageId"])) {

                            require_once __DIR__ . "/compenents/product_images/FormUpdate.php";
                        } elseif ($_GET["action"] == 'add') {
                            require_once __DIR__ . "/compenents/product_images/FormInsert.php";
                        }
                    } else {

                        require_once __DIR__ . "/compenents/product_images/Table.php";
                    ?>
                  

                    <?php  }
                    if (isset($_SESSION["insertImageStatus"])) {

                        unset($_SESSION["insertImageStatus"]);
                    }
                    if (isset($_SESSION["updateImageStatus"])) {
                        # code...
                        unset($_SESSION["updateImageStatus"]);
                    }
                    if (isset($_SESSION["deleteImageStatus"])) {
                        # code...
                        unset($_SESSION["deleteImageStatus"]);
                    }
                    if (isset($_SESSION["inserImageError"])) {
                        unset($_SESSION["inserImageError"]);
                        # code...
                    }
                    if (isset($_SESSION["updateImageError"])) {
                        # code...
                        unset($_SESSION["updateImageError"]);
                    }
                    if (isset($_SESSION["deleteImageError"])) {
                        # code...
                        unset($_SESSION["deleteImageError"]);
                    }


                    ?>
                </div>
            </div>
        </div>
    </main>
</body>

</html>

