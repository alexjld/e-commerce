<?php
class DatabaseAdaptor{
    private $DB;
    
  
    public function __construct(){
        $dataBase = 'mysql:dbname=csc337project;charset=utf8;host=127.0.0.1';
        $user = 'root';
        $password = ''; 
        try {
            $this->DB = new PDO($dataBase, $user, $password);
            $this->DB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo ('Error establishing Connection');
            exit();
        }
    }
    
    public function askQuery($user, $pass){
        $stmt = $this->DB->prepare("SELECT * FROM users;");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function createAccount($user, $pass){

        $stmt = $this->DB->prepare("INSERT INTO users (userName, password) VALUES('".$user."', '".$pass."');");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function search($location, $price, $category){
        if($location === "all"){
            $location = "";
        }
        if($category === "all"){
            $category = "";
        }
        $stmt = $this->DB->prepare("SELECT delivery_date, location, price, productName FROM stores JOIN products ON products.storeId = stores.storeId where category LIKE \"%".$category."%\" and location LIKE \"%".$location."%\" and price <= ".$price.";");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
} 
?>