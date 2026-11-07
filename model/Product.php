<?php
require_once __DIR__."/../dbConnection.php";
class Product{
  private $conn;
     function __construct()
     {
     $instanseConnection= PdoConnect::get_instanse();
     $this->conn=$instanseConnection->get_connection();
        
     }

     function get_all_products(){
         
       $query= "SELECT pro.id,  pro.title,pro.price,pro.rate,pro.description,categories.category ,pro.image  FROM products AS pro INNER JOIN categories ON pro.category_id= categories.id ";
       $allProducts=$this->conn->prepare($query);
       $allProducts->execute();
       $products=$allProducts->fetchAll();
       return $products;     

     }

    function get_product($id)
    {

        $query = "SELECT * FROM products WHERE id=?";
        $oneProduct = $this->conn->prepare($query);
        $oneProduct->execute([$id]);
        $product = $oneProduct->fetch();
        return $product;
    }
    function delete_product(...$id)
    {
        $placeholder=implode(',',array_fill(0,count($id),'?'));

        $query = "DELETE  FROM products WHERE id IN($placeholder)";
        $oneProduct = $this->conn->prepare($query);
        $oneProduct->execute($id);
        $product = $oneProduct->rowCount();
        return $product;
    }

    function update_product(array $updateProduct)
    {

        $query = "UPDATE products SET title = ?, category_id = ?,price=?,description=?,rate=? WHERE id = ?";
        $oneProduct = $this->conn->prepare($query);
        $oneProduct->execute(array_values($updateProduct));
        $products = $oneProduct->rowCount();
        return $products;
    }
    function update_product_with_image(array $updateProduct)
    {

        $query = "UPDATE products SET title = :title, category_id = :category,price=:price,description=:descripe,rate=:rate,image=:image WHERE id = :id";
        $oneProduct = $this->conn->prepare($query);
        $oneProduct->execute($updateProduct);
        $products = $oneProduct->rowCount();
        return $products;
    }
    function insert_product(array $insertProducts){
    

        $query = "INSERT INTO  products (title,category_id,price,description,rate,image) VALUES(?,?,?,?,?,?)";
        $oneProduct = $this->conn->prepare($query);
        $oneProduct->execute(array_values($insertProducts));
        $productId = $this->conn->lastInsertId();
        return $productId;
        
}
  function get_all_categories()
    {

        $query = "SELECT * FROM categories";
        $allCategories = $this->conn->prepare($query);
        $allCategories->execute();
        $categories = $allCategories->fetchAll();
        return $categories;
    }
}