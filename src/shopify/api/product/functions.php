<?php
  require(__DIR__ ."/../database.php");

  function getProductsList() {
    global $pdo;

    $query = $pdo->prepare("SELECT * FROM products");
    $query->execute();

    $results = $query->fetchAll(PDO::FETCH_ASSOC);

    if (empty($results)) return array();
    return $results;
  }

  function getProductName($product_id) {
    global $pdo;

    $query = $pdo->prepare("SELECT product_name FROM products WHERE product_id = :product_id");
    $query->bindParam(":product_id",$product_id);
    $query->execute();

    $results = $query->fetchAll(PDO::FETCH_ASSOC);

    if (empty($results)) return null;
    return $results[0]['product_name'];
  }

  function addProduct($name) {
    global $pdo;
    //check if product name already exists
    $query = $pdo->prepare("SELECT * FROM products WHERE product_name = :product_name");
    $query->bindParam(":product_name",$name);
    $query->execute();

    $results = $query->fetchAll(PDO::FETCH_ASSOC);
    //insert product in table if it doesnt already exist
    if (empty($results)) {
      $query = $pdo->prepare("INSERT INTO products (product_name)
      VALUES (:product_name)");
      $query->bindParam(":product_name",$name);
      $query->execute();
    }
  }

  function findProductId($name) {
    global $pdo;

    $query = $pdo->prepare("SELECT product_id FROM products WHERE product_name = :prod_name");
    $query->bindParam(":prod_name",$name);
    $query->execute();

    $results = $query->fetchAll(PDO::FETCH_ASSOC);

    if (empty($results)) return null;
    return $results[0]['product_id'];
  }


?>