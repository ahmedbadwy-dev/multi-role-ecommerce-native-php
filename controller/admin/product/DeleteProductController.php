<?php
require_once __DIR__."/../../../sessionConfig.php";
if (
 
( !isset($_REQUEST["productId"])||empty($_REQUEST["productId"]) )
    
    &&

( !isset($_REQUEST["product"])||empty($_REQUEST["product"]) )

) {
     header("location:../../../views/admin/ProductPage.php");
     exit();
}

require_once __DIR__."/../../../model/Product.php";
require_once __DIR__ . "/../../../model/Image.php";
require_once __DIR__."/../../../helpers/deleteImage.php";
$insProduct=new Product();
$insImg=new Image();
$productIds=isset($_REQUEST["product"])?(array)$_REQUEST["product"]:(array)$_REQUEST["productId"];
print_r($productIds);
$res=$insImg->get_images_by_id($productIds);
print_r($res);

$flag=true;
if($res){
        $deletedImg=[];
        foreach($res as $img){
            $deletedImg[]=$img["image"];
            }
            
    

       if (!empty($img["main_image"]) && !in_array($img["main_image"], $deletedImg)) {
            $deletedImg[] = $img["main_image"];
        }
         $flag = deleteImage($deletedImg, "../../../uploads/");

            }
            
            $dele=$insProduct->delete_product(...$productIds);

            if (!$dele) {
                $_SESSION["deleteProductError"]="حدث خطا اثنا حذف المنتج";
                header("location:../../../views/admin/ProductPage.php");
                exit();
                }
if(isset($flag) && $flag){

    $_SESSION["deleteProductٍStatus"] = "تم حذف المنتج بنجاح";
    header("location:../../../views/admin/ProductPage.php");
    exit();
}
else{
    $_SESSION["deleteProductٍStatus"] = "لم يتم حذف كل صور المنتجات نظرا لبعض الاخطاء يرجي الذهاب الي صفحه صور المنتجات وحذفهم من هناك";
    header("location:../../../views/admin/ProductPage.php");
    exit();
}