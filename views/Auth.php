<?php 
require_once __DIR__."/../sessionConfig.php";

  
    //    if($_SESSION["dataUser"]&&!empty($_SESSION["dataUser"])){
    //             if(strtolower($_SESSION["dataUser"]["role"]) =="user"){
    //                 header("location:index.php");
    //                 exit();
    //             } else  if (in_array("read_reports", $_SESSION["permissions"])) {
    //         header("location:admin/ProductPage.php");
    //         exit();
    //     } else  if (in_array("read_post",$_SESSION["permissions"])) {
    //         header("location:admin/ProductPage.php");
    //         exit();

    //     } else  if (in_array("read_user", $_SESSION["permissions"])) {
    //         header("location:admin/ProductPage.php");
    //         exit();
    //     }
    // }
   

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="../asset/css/sb-admin-2.min.css" rel="stylesheet">
</head>

<body>
    <div class="container">

        <?php
        if (isset($_GET["action"]) && $_GET["action"] == "register") {
            require_once __DIR__ . "/compenents/auth/FormRegister.php";
        } else {

            require_once __DIR__ . "/compenents/auth/FormLogin.php";
        }
        ?>

    </div>



</body>

</html>