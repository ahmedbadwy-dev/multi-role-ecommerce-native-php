<?php
require_once __DIR__."/../dbConnection.php";
class Product{
  private $conn;
     function __construct()
     {
     $instanseConnection=PdoConnect::get_instanse();
     $this->conn=$instanseConnection->get_connection();
        
     }

     function get_all_products(){
         
       $query="SELECT * FROM products";
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
    function delete_product($id)
    {

        $query = "DELETE  FROM products WHERE id=?";
        $oneProduct = $this->conn->prepare($query);
        $oneProduct->execute([$id]);
        $product = $oneProduct->rowCount();
        return $product;
    }

    function update_product(array $updateProduct)
    {

        $query = "UPDATE products SET tilte = ?, category_id = ?,price=?,description=?,rate=?,image=?, WHERE id = ?";
        $oneProduct = $this->conn->prepare($query);
        $oneProduct->execute($updateProduct);
        $products = $oneProduct->rowCount();
        return $products;
    }

    function insert_product(array $insertProducts){
    

        $query = "INSERT products INTO users(title,category_id,price,description,rate,image) VALUE(?,?,?,?,?,?) ";
        $oneProduct = $this->conn->prepare($query);
        $oneProduct->execute($insertProducts);
        $product = $oneProduct->rowCount();
        return $product;
        
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