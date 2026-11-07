<?php
require_once __DIR__ . "/../../../sessionConfig.php";
require_once __DIR__ . "/../../../dbConnection.php";
require_once __DIR__ . "/../../../model/Product.php";
require_once __DIR__."/../../../helpers/imageMange.php";
require_once __DIR__."/../../../model/Image.php";
$db=PdoConnect::get_instanse()->get_connection();
$instanse = new Product();
$instanseImage=new Image();

if ($_SERVER["REQUEST_METHOD"] == "POST" && in_array("create_post", $_SESSION["dataUser"]["permission"])) {

    if (strlen(trim($_POST["productname"])) < 3) {
        $_SESSION["productsError"]["productname"] = "يجب التاكد من اسم المنتج";
        header("location:../../../views/admin/ProductPage.php?action=add");
        exit();
    }
    $productname = $_POST["productname"];
    $price = filter_input(INPUT_POST, "price", FILTER_VALIDATE_INT);
    $rate = filter_input(INPUT_POST, "rate", FILTER_VALIDATE_FLOAT);
    $category = filter_input(INPUT_POST, "category", FILTER_VALIDATE_INT);

    if (strlen(trim($_POST["description"])) < 10) {
        $_SESSION["productsError"]["category"] = "يجب الا يقل كلمه السر عن 10 حروف";
        header("location:../../../views/admin/ProductPage.php?action=add");

        exit();
    }
    $description = $_POST['description'];

    if (!$price) {

        $_SESSION["productsError"]["price"] = "يجب التاكد من السعر";
        header("location:../../../views/admin/ProductPage.php?action=add");
        exit();
    }
    if (!$rate) {
        $_SESSION["productsError"]["rate"] = "يجب التاكد من  التقييم";
        header("location:../../../views/admin/ProductPage.php?action=add");
        exit();
    }
    if (!$category) {
        $_SESSION["productsError"]["category"] = "يجب التاكد من دور المستخدم";
        header("location:../../../views/admin/ProductPage.php?action=add");
        exit();
    }
   
    $image=$_FILES["images"];
    
    if(empty($image))
        
        {
            $_SESSION["productsError"]["image"] = "يجب ان تختار  صوره";
            header("location:../../../views/admin/ProductPage.php?action=add");
            exit();
            }
            
$allowed_extention=["jpg","webp","jpeg"];
$name=$image["name"];
$file_size=$image["size"];
$tmp_name=$image["tmp_name"];
$path=pathinfo($name,PATHINFO_EXTENSION);
if(! in_array($path,$allowed_extention)){
        $_SESSION["productsError"]["image"] = " يجب ان تختار  صوره حقيقيه";
        header("location:../../../views/admin/ProductPage.php?action=add");
        exit();
}
if($file_size>1024*1024*2){
        $_SESSION["productsError"]["image"] = " يجب ان تختار  صوره  لايزيد حجها عن 2 ميجا بايت";
        header("location:../../../views/admin/ProductPage.php?action=add");
        exit();
}



    $validImage = uniqid('prod_', true) . "." . $path;


    $clean_data = [
        'title'        => $productname,
        'category'           => $category,
        'price'        => $price,
        'descripe'      => $description,
        'rate'        => $rate,
         "image"        =>$validImage
    ];

    try {
       $db->beginTransaction();
    
       $productId = $instanse->insert_product($clean_data);
            
            if (move_uploaded_file($tmp_name,"../../../uploads/" .$validImage)) {
                
                  
                
                           $db->commit();
                
                            $_SESSION["insertProductStatus"] = "تم ادخال بيانات المنتج بنجاح";
                            header("location:../../../views/admin/ProductPage.php");
                            exit();
                            
                            
                            }
    
            else {
             $db->rollBack();
            $_SESSION["insertProductError"] = "حدث خطا غير متوقع اثناء ادخال بيانات المنتج";
            header("location:../../../views/admin/ProductPage.php?action=add");
            exit();
        }
        
    } catch (\Throwable $th) {

        $db->rollBack();

        if(file_exists("../../../uploads/". $validImage)){
                unlink("../../../uploads/" . $validImage);
              }
       
        $_SESSION["insertProductError"] = "حدث خطا غير متوقع اثناء ادخال بيانات المنتج";
        header("location:../../../views/admin/ProductPage.php");
        exit();




}




 

}
 else {
    header("location:../../../views/admin/ProductPage.php");
    exit();
}


