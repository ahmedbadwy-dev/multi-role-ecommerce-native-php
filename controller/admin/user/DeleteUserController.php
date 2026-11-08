<?php
require_once __DIR__."/../../../sessionConfig.php";
if (!$_SESSION["dataUser"]["permissions"] || !in_array("delete_users", $_SESSION["dataUser"]["permissions"])) {
    header("location:../../../views/Auth.php");
    exit();
}
$userId=filter_input(INPUT_GET,"userId",FILTER_VALIDATE_INT);
if (isset($userId)) {
require_once __DIR__."/../../../model/User.php";

    $instanse=new User();
    $res=$instanse->delete_user($userId);
    if($res){
      $_SESSION["deleteUserStatus"]="تم حذف المستخدم بنجاح";  
    header("location:../../../views/admin/UserPage.php");
    }
    else{
        $_SESSION["deleteUserError"] = "حدث خطا غير متوقع اثناء حذف المستخدم ";
        header("location:../../../views/admin/UserPage.php");
    }
}

else {
    header("location:../../../views/admin/UserPage.php");
    exit();
}