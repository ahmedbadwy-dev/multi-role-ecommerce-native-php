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
        <h1 class="text-center">Hello <?= $_SESSION["dataUser"]["username"] ?></h1>
    </div>
</body>

</html>