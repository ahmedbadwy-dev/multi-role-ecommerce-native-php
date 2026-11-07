<?php

function imageMange(array $images,array $allowed_extension):array {
$images_valid=[];
foreach($images as $image){

$path=pathinfo($image["name"],PATHINFO_EXTENSION);
if (in_array($path,$allowed_extension)) {
    if ($image["size"]<=2024*2024) {
        $newName= uniqid('prod_', true) .".".$path;
        $tmp=$image["tmp_name"];
        $count=0;
        $id = (isset($image["id"])) ? $image["id"] : $count++ ;
        $id=$id;
        $images_valid[]=["name"=>$newName,"tmp"=>$tmp,"id"=>$id];
    }
}


}
return $images_valid;
}
