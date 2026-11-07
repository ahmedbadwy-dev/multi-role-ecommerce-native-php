<?php 
require_once __DIR__."/../sessionConfig.php"
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
        if (isset($_GET["action"]) && $_GET["action"] == "login") {
            require_once __DIR__."/compenents/auth/FormLogin.php";
        } else {

            require_once __DIR__."/compenents/auth/FormRegister.php"  ;
        }
        ?>

    </div>



</body>

</html>