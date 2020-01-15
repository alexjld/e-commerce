<?php

include ('databaseAdapter.php');
$mode = $_GET['mode'];
if ($mode == "signIn") {
    $userName = $_GET['userName'];
    $password = $_GET['password'];

    $theDBA = new DatabaseAdaptor();
    $result = $theDBA->askQuery($userName, $password);
    echo json_encode($result);
}
if ($mode == "createAcc") {
    $userName = $_GET['userName'];
    $password = $_GET['password'];

    $theDBA = new DatabaseAdaptor();
    $result = $theDBA->createAccount($userName, $password);
    echo json_encode($result);
}
if ($mode == "search") {
    $category = $_GET['category'];
    $location = $_GET['location'];
    $price = $_GET['price'];

    $theDBA = new DatabaseAdaptor();
    $result = $theDBA->search($location, $price, $category);
    echo json_encode($result);
}

if($mode == "getPrice"){
    $stores = $_GET['storeId'];
    
    $theDBA = new DatabaseAdaptor();
    $result = $theDBA->getPrice($stores);
    echo json_encode($result);
}

?>