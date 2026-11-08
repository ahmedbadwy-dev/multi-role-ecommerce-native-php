<?php
require_once __DIR__."/../../sessionConfig.php";
require_once __DIR__ . "/../../model/User.php";

$instanse= new User();

if($_SERVER["REQUEST_METHOD"] == "POST"){

if(strlen(trim($_POST["username"]))<3){
     $_SESSION["usersError"]["username"]="يجب التاكد من اسم المستخدم";
        header("location:../../views/Auth.php?action=register");
        exit();

}
$username=$_POST["username"];
$email=filter_input(INPUT_POST,"email",FILTER_VALIDATE_EMAIL);
$telephone=filter_input(INPUT_POST,"telephone",FILTER_VALIDATE_INT);
$birth_date= filter_input(INPUT_POST, 'birth_date', FILTER_VALIDATE_REGEXP, [
        "options" => ["regexp" => "/^\d{4}-\d{2}-\d{2}$/"]
    ]); 
  if (strlen(trim($_POST["password"])) <8) {
       $_SESSION["usersError"]["password"]="يجب الا يقل كلمه السر عن 8 حروف";
        header("location:../../views/Auth.php?action=register");
        
        exit();
  }     
$password_hashed= password_hash(trim($_POST['password']), PASSWORD_DEFAULT);

if(!$email){

        $_SESSION["usersError"]["email"] = "يجب التاكد من صيغه الايميل";
        header("location:../../views/Auth.php?action=register");
        exit();
}
if($instanse->check_email($email)){

        $_SESSION["usersError"]["email"] = "هذا الايميل مكرر";
        header("location:../../views/Auth.php?action=register");
        exit();


}


if(!$telephone){
    $_SESSION["usersError"]["telephone"]="يجب التاكد من رقم التيلفون";
        header("location:../../views/Auth.php?action=register");
        exit();
}

if(!$birth_date){
        $_SESSION["usersError"]["birth_date"] = "يجب التاكد من تاريخ ميلاد المستخدم";
        header("location:../../../views/Auth.php?action=register");
        exit();
        }


    $clean_data = [
        'username'        => $username,
        'email'           => $email,
        'password'        => $password_hashed,
        'birth_date'      => $birth_date,
        'telephone'        => $telephone,
       
    ];



$res=$instanse->register_user($clean_data);
if ($res) {
    $_SESSION["insertUserStatus"]="تم التسجيل بنجاح";
        header("location:../../views/Auth.php?action=register?action=login");
        exit();
    
}
else {
        $_SESSION["insertUserُError"] = "حدث خطا غير متوقع اثناء ادخال المستخدم";
        header("location:../../views/Auth.php?action=register");
        exit();
}


}
else{
    header("location:../../views/Auth.php?action=register");
    exit();


}





