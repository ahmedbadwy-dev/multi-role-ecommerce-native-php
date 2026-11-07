<?php
require_once __DIR__."/../dbConnection.php";

class Image{

private $conn;
function __construct()
{
   $this->conn= PdoConnect::get_instanse()->get_connection();
}
function insert_image($product_id,$image){

$insertImage= "INSERT INTO poduct_images(product_id,image ) VALUES(?,?)";

$stm=$this->conn->prepare($insertImage);
 $stm->execute([$product_id,$image]);
  $res=$stm->rowCount();
  return $res;
}

function get_images_by_id(array $id){
 $placeholder=implode(',',array_fill(0,count($id),'?'));
$sele= "SELECT poduct_images.image,poduct_images.id,poduct_images.product_id,products.image AS main_image FROM poduct_images INNER JOIN products ON products.id=poduct_images.product_id WHERE poduct_images.product_id IN ($placeholder)";
$images=$this->conn->prepare($sele);
$images->execute(array_values($id));
$images_product=$images->fetchAll();
return $images_product;





}

function update_image( int $id, string $image){

$update="UPDATE poduct_images SET image=? WHERE id=?";

$updateImage=$this->conn->prepare($update);

$updateImage->execute([$image,$id]);

$updateSuccess=$updateImage->rowCount();

return $updateSuccess;

}
   function get_images()
   {

      $sele = "SELECT GROUP_CONCAT( poduct_images.image)AS images ,poduct_images.id,pro.title FROM poduct_images INNER JOIN products AS pro  ON poduct_images.product_id=pro.id group BY poduct_images.product_id";
      $images = $this->conn->prepare($sele);
      $images->execute();
      $products = $images->fetchAll();
         foreach($products as &$product){
               $product["images"]=explode(',',$product["images"]);
          
         }

      return $products;
   }

}