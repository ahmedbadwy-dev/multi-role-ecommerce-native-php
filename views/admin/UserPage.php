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

                    if (isset($_SESSION["insertUserStatus"])) { ?>

                        <div class="alert alert-success text-center w-50 mx-auto mt-2 rounded-2"><?= isset($_SESSION["insertUserStatus"]) ? $_SESSION["insertUserStatus"] : ''  ?></div>

                    <?php
                    }
                    if (isset($_SESSION["insertUserError"])) {
                    ?>
                        <div class="alert alert-danger text-center w-50 mx-auto mt-2 rounded-2"><?= isset($_SESSION["insertUserError"]) ? $_SESSION["insertUserError"] : ''  ?></div>
                    <?php
                    }
                    if (isset($_SESSION["updateUserStatus"])) { ?>


                        <div class="alert alert-success text-center w-50 mx-auto mt-2 rounded-2"><?= isset($_SESSION["updateUserStatus"]) ? $_SESSION["updateUserStatus"] : ''  ?></div>

                    <?php
                    }
                    if (isset($_SESSION["updateUserError"])) { ?>


                        <div class="alert alert-danger text-center w-50 mx-auto mt-2 rounded-2"><?= isset($_SESSION["updateUserError"]) ? $_SESSION["updateUserError"] : ''  ?></div>

                    <?php
                    }

                    if (isset($_SESSION["deleteUserError"])) { ?>


                        <div class="alert alert-danger text-center w-50 mx-auto mt-2 rounded-2"><?= isset($_SESSION["deleteUserError"]) ? $_SESSION["deleteUserError"] : ''  ?></div>

                    <?php
                    }
                    if (isset($_SESSION["deleteUserStatus"])) { ?>


                        <div class="alert alert-success text-center w-50 mx-auto mt-2 rounded-2"><?= isset($_SESSION["deleteUserStatus"]) ? $_SESSION["deleteUserStatus"] : ''  ?></div>

                    <?php
                    }

                    if (isset($_GET["action"])) {



                        if ($_GET["action"] == 'edit' && isset($_GET["userId"])) {

                            require_once __DIR__ . "/compenents/user/FormUpdate.php";
                        } elseif ($_GET["action"] == 'add') {
                            require_once __DIR__ . "/compenents/user/FormInsert.php";
                        }
                    } else {

                        require_once __DIR__ . "/compenents/user/Table.php";
                    ?>
                        <a href="UserPage.php?action=add" class=" btn btn-success w-100  ">
                            Create User
                        </a>

                    <?php  }
                    if (isset($_SESSION["insertUserStatus"])) {

                        unset($_SESSION["insertUserStatus"]);
                    }
                    if (isset($_SESSION["updateUserStatus"])) {
                        # code...
                        unset($_SESSION["updateUserStatus"]);
                    }
                    if (isset($_SESSION["deleteUserStatus"])) {
                        # code...
                        unset($_SESSION["deleteUserStatus"]);
                    }
                    if (isset($_SESSION["inserUserError"])) {
                        unset($_SESSION["inserUserError"]);
                        # code...
                    }
                    if (isset($_SESSION["updateUserError"])) {
                        # code...
                        unset($_SESSION["updateUserError"]);
                    }
                    if (isset($_SESSION["deleteUserError"])) {
                        # code...
                        unset($_SESSION["deleteUserError"]);
                    }


                    ?>
                </div>
            </div>
        </div>
    </main>
</body>

</html>