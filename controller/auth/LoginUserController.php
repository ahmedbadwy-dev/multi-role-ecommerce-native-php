<?php
require_once __DIR__ . "/../../sessionConfig.php";


if ($_SERVER["REQUEST_METHOD"]!="POST") {

    header("location:../../views/Auth.php");
    exit();
}

require_once __DIR__."/../../model/User.php";

$ins=new User();


$email = filter_input(INPUT_POST, "email", FILTER_VALIDATE_EMAIL);

if (!$email) {
    $_SESSION["usersError"]["email"] = "يجب التاكد من صيغه الايميل";
    header("location:../../views/Auth.php?action=login");
    exit();
    
    }
    
    
if (strlen(trim($_POST["password"])) < 8) {
    $_SESSION["usersError"]["password"] = "يجب الا يقل كلمه السر عن 8 حروف";
    header("location:../../views/Auth.php?action=login");
    exit();
  
    }
    $user=$ins->login_user($email);

    
    if (!$user) {


        $_SESSION["loginUserStatus"] = "يجب التاكد من الايميل او الباسورد";
        header("location:../../views/Auth.php?action=login");
        exit();
}
  

            if (password_verify($_POST["password"],$user["password"])) {


        $dataUser=$ins->get_permmision_user($user["id"]);

    $permmision=explode(',',$dataUser["permissions"]);

    $dataUser["permissions"]= $permmision;


        $_SESSION["dataUser"]=$dataUser;
  if ( strtolower($dataUser["role"])=="user") {
        header("location:../../views/index.php");
  }

       else if ( in_array("read_reports", $dataUser["permissions"])  ) {
        header("location:../../views/admin/index.php");
            exit();
        } 
        else  if(in_array("read_post", $dataUser["permissions"])) {
        header("location:../../views/admin/ProductPage.php");
                exit();
        }
  

}
else{
    $_SESSION["loginUserStatus"] = "يجب التاكد من الايميل او الباسورد";
    header("location:../../views/Auth.php?action=login");
    exit();
}


