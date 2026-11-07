<?php
require_once __DIR__."/../../../sessionConfig.php";
if($_SERVER["REQUEST_METHOD"]!='POST'){
   header("location:../../../views/admin/ImagePage.php");
   exit();
}
require_once __DIR__."/../../../dbConnection.php";
require_once __DIR__."/../../../model/Image.php";
require_once __DIR__."/../../../helpers/imageMange.php";
$conn=PdoConnect::get_instanse()->get_connection();
$images=$_FILES["images"];

if( empty($images) || empty($_POST['id']) ){
    $_SESSION['inserImageError'] = "يجب التاكد انك قمت باختيار صور للمنج ورقم المنتج";
    header("location:../../../views/admin/ImagePage.php?action=add");
exit();

}

$formattedImages = [];
for ($i = 0; $i < count($images["name"]); $i++) {
    $formattedImages[] = [
        "name"     => $images['name'][$i],
        "tmp_name" => $images['tmp_name'][$i],
        "size"     => $images['size'][$i],
        "error"    => $images['error'][$i]
    ];
}
$allowed_extention=["jpg" ,"webp"];
$valid_images=imageMange($formattedImages,$allowed_extention);

if(empty($valid_images)){
    $_SESSION['inserImageError']="يجب اختيار صوره حقيقيه والتاكد من الامتداد";
    header("location:../../../views/admin/ImagePage.php?action=add");
    exit();
}

$inst=new Image();
$conn->beginTransaction();
foreach($valid_images as  $image){
   try {
       $res=$inst->insert_image($_POST["id"],$image["name"]);
         if(!$res){
            $_SESSION['inserImageError'] = "حدث خطا غير متوقع اثناء ادخال البيانات";
            header("location:../../../views/admin/ImagePage.php?action=add");
            exit();
         }
           
            if(move_uploaded_file($image["tmp"],"../../../uploads/".$image["name"])){

             
                }
                else{
                    $conn->rollBack();
                $_SESSION['inserImageError'] = "حدث خطا غير متوقع اثناء ادخال البيانات";
                header("location:../../../views/admin/ImagePage.php?action=add");
                exit();
                
                }


   } catch (\Throwable $th) {
      $conn->rollBack();
        $_SESSION['inserImageError'] = "حدث خطا غير متوقع اثناء ادخال البيانات";
        header("location:../../../views/admin/ImagePage.php?action=add");
        exit();
   }
}

$conn->commit();
$_SESSION['inserImageError'] = "تم ادخال البيانات بنجاح";
header("location:../../../views/admin/ImagePage.php?action=add");
exit();
