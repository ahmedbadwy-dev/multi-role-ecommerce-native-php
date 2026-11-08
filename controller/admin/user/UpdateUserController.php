<?php
require_once __DIR__ . "/../../../sessionConfig.php";
if (!$_SESSION["dataUser"]["permissions"] || !in_array("update_users", $_SESSION["dataUser"]["permissions"])) {
    header("location:../../../views/Auth.php");
    exit();
}
require_once __DIR__ . "/../../../model/User.php";

$instanse = new User();

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (strlen(trim($_POST["username"])) < 3) {
        $_SESSION["usersError"]["username"] = "يجب التاكد من اسم المستخدم";
        header("location:../../../views/admin/UserPage.php?action=edit&userId=".$_POST['id']);
        exit();
    }

    $username = $_POST["username"];

    $email = filter_input(INPUT_POST, "email", FILTER_VALIDATE_EMAIL);
    $telphone = filter_input(INPUT_POST, "telephone", FILTER_VALIDATE_INT);
    $role_id = filter_input(INPUT_POST, "role", FILTER_VALIDATE_INT);
    $id = filter_input(INPUT_POST, "id", FILTER_VALIDATE_INT);
    $birth_date = filter_input(INPUT_POST, 'birth_date', FILTER_VALIDATE_REGEXP, [
        "options" => ["regexp" => "/^\d{4}-\d{2}-\d{2}$/"]
    ]);
   
    
    if (!$email) {

        $_SESSION["usersError"]["email"] = "يجب التاكد من صيغه الايميل";
        header("location:../../../views/admin/UserPage.php?action=edit&userId=".$_POST['id']);
        exit();
    }
    if (!$telphone) {
        $_SESSION["usersError"]["telephone"] = "يجب التاكد من رقم التيلفون";
        header("location:../../../views/admin/UserPage.php?action=edit&userId=" . $_POST['id']);
        exit();
        }
        if (!$role_id) {
        $_SESSION["usersError"]["role"] = "يجب التاكد من دور المستخدم";
        header("location:../../../views/admin/UserPage.php?action=edit&userId=".$_POST['id']);
        exit();
        }
        if (!$birth_date) {
            $_SESSION["usersError"]["birth_date"] = "يجب التاكد من تاريخ ميلاد المستخدم";
            header("location:../../../views/admin/UserPage.php?action=edit&userId=".$_POST['id']);
            exit();
            }
    if (!$id) {
        $_SESSION["usersError"]["id"] = "يجب التاكد من معرف المستخدم";
        header("location:../../../views/admin/UserPage.php?action=edit&userId=".$_POST['id']);
        exit();
    }
              $password_hashed="";
            if (strlen(trim($_POST["password"])) != 0) {
        if (strlen(trim($_POST["password"])) < 8) {
            $_SESSION["usersError"]["password"] = "يجب الا يقل كلمه السر عن 8 حروف";
            header("location:../../../views/admin/UserPage.php?action=edit&userId=".$_POST['id']);

            exit();
        }
        $password_hashed = password_hash($_POST['password'], PASSWORD_DEFAULT);

            }
 




    $res=$instanse->update_user($username,$email,$password_hashed,$birth_date,$telphone,$role_id,$id);
    if ($res) {
     
        $_SESSION["updateUserStatus"] = "تم التسجيل بنجاح";
        header("location:../../../views/admin/UserPage.php");
        exit();
    }
    else{

        $_SESSION["updateUserError"] = "حدث خطا غير متوقع اثناء تعديل  بيانات المستخدم";
        header("location:../../../views/admin/UserPage.php");
        exit();
    }
} else {
    header("location:../../../views/admin/UserPage.php?action=edit&userId=" . $_POST['id']);

    exit();
}
