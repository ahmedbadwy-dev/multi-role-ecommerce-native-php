<?php
require_once __DIR__ . "/../../../sessionConfig.php";
require_once __DIR__ . "/../../../dbConnection.php";
require_once __DIR__ . "/../../../model/Product.php";
require_once __DIR__ . "/../../../helpers/imageMange.php";
require_once __DIR__ . "/../../../model/Image.php";
$db = PdoConnect::get_instanse()->get_connection();
$instanse = new Product();
$instanseImage = new Image();

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (strlen(trim($_POST["productname"])) < 3) {
        $_SESSION["productsError"]["productname"] = "يجب التاكد من اسم المنتج";
        header("location:../../../views/admin/ProductPage.php?action=edit&&productId=".$_POST['id']);
        exit();
    }
    if (strlen(trim($_POST["description"])) < 10) {
        $_SESSION["productsError"]["category"] = "يجب الا يقل كلمه السر عن 10 حروف";
        header("location:../../../views/admin/ProductPage.php?action=edit&&productId=".$_POST['id']);

        exit();
    }
    $productname = $_POST["productname"];
    $description = $_POST['description'];
    $id = filter_input(INPUT_POST, "id", FILTER_VALIDATE_INT);
    $price = filter_input(INPUT_POST, "price", FILTER_VALIDATE_INT);
    $rate = filter_input(INPUT_POST, "rate", FILTER_VALIDATE_FLOAT);
    $category = filter_input(INPUT_POST, "category", FILTER_VALIDATE_INT);
if(!$id){
        header("location:../../../views/admin/ProductPage.php?action=edit&&productId=" . $_POST['id']);
}

    if (!$price) {

        $_SESSION["productsError"]["price"] = "يجب التاكد من السعر";
        header("location:../../../views/admin/ProductPage.php?action=edit&&productId=".$_POST['id']);
        exit();
    }
    if (!$rate) {
        $_SESSION["productsError"]["rate"] = "يجب التاكد من  التقييم";
        header("location:../../../views/admin/ProductPage.php?action=edit&&productId=".$_POST['id']);
        exit();
    }
    if (!$category) {
        $_SESSION["productsError"]["category"] = "يجب التاكد من دور المستخدم";
        header("location:../../../views/admin/ProductPage.php?action=edit&&productId=".$_POST['id']);
        exit();
    }
    $clean_data = [

        'title'        => $productname,
        'category'           => $category,
        'price'        => $price,
        'descripe'      => $description,
        'rate'        => $rate,
        'id'  => $id

    ];
    $image=$_FILES["image"];

    if($image["error"]==0){

$path=pathinfo($image["name"],PATHINFO_EXTENSION);
$tmp_name=$image["tmp_name"];
$image_size=$image["size"];
$allowedExtinsion=["jpeg","jpg","webp"];
if (!in_array($path,$allowedExtinsion)) {
            $_SESSION["productsError"]["image"] = "يجب التاكد من ان الصوره حقيقيه";
            header("location:../../../views/admin/ProductPage.php?action=edit&&productId=" . $_POST['id']);
            exit();
            }

if ($image_size>1024*1024*2) {
            $_SESSION["productsError"]["image"] = "يجب التاكد من ان الصوره حجمها لايذيد عن 2 ميجابايت";
            header("location:../../../views/admin/ProductPage.php?action=edit&&productId=" . $_POST['id']);
            exit();
}
$newName=uniqid("pre").".".$path;
$output=$instanse->update_product_with_image([...$clean_data,"image"=>$newName]);
if (!$output) {
            $_SESSION["productsError"]["updateProductStatus"] = "حدث خطا غير متوقع";
            header("location:../../../views/admin/ProductPage.php?action=edit&&productId=" . $_POST['id']);
            exit();
}
    if (move_uploaded_file($tmp_name,"../../../uploads/".$newName)) {
                $_SESSION["insertProductStatus"] = "تم ادخال بيانات المنتج بنجاح";
                header("location:../../../views/admin/ProductPage.php");
                exit();
    }



    }


   

else{


   

    try {
   
        $productId = $instanse->update_product($clean_data);
        if (!$productId) {
            $_SESSION["productsError"]["updateProductStatus"] = "حدث خطا غير متوقع";
            header("location:../../../views/admin/ProductPage.php?action=edit&&productId=".$_POST['id']);
            exit();
        }
            
      
  


            $_SESSION["insertProductStatus"] = "تم ادخال بيانات المنتج بنجاح";
            header("location:../../../views/admin/ProductPage.php");
               exit();
  
    } catch (\Throwable $th) {
     
        $_SESSION["insertProductError"] = "حدث خطا غير متوقع اثناء ادخال بيانات المنتج";
        header("location:../../../views/admin/ProductPage.php?action=edit&&productId=".$_POST['id']);
        exit();
       
        }
    }
    
}

 else {
    header("location:../../../views/admin/ProductPage.php");
    exit();
}
