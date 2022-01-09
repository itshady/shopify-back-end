<?php
  require("database.php");

  function getWarehouseList() {
    global $pdo;

    $query = $pdo->prepare("SELECT * FROM warehouses");
    $query->execute();

    $results = $query->fetchAll(PDO::FETCH_ASSOC);

    if (empty($results)) return array();
    return $results;
  }

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

  function getWarehouseAddress($warehouse_id) {
    global $pdo;

    $query = $pdo->prepare("SELECT `address` FROM warehouses WHERE warehouse_id = :warehouse_id");
    $query->bindParam(":warehouse_id",$warehouse_id);
    $query->execute();

    $results = $query->fetchAll(PDO::FETCH_ASSOC);

    if (empty($results)) return null;
    return $results[0]['address'];
  }

  function getInvetoryList() {
    global $pdo;

    $query = $pdo->prepare("SELECT * FROM inventory");
    $query->execute();

    $results = $query->fetchAll(PDO::FETCH_ASSOC);

    if (empty($results)) return array();
    return $results;
  }

  function addWarehouse($address,$city,$country) {
    global $pdo;

    $query = $pdo->prepare("INSERT INTO warehouses (`address`, city, country)
    VALUES (:laddress, :city, :country)");
    $query->bindParam(":laddress",$address);
    $query->bindParam(":city",$city);
    $query->bindParam(":country",$country);
    $query->execute();
    
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

  function addInvetory($prod_id,$warehouse_id,$quantity,$price) {
    global $pdo;

    $query = $pdo->prepare("INSERT INTO inventory (inventory_product_id,inventory_warehouse_id,quantity,price)
    VALUES (:prod_id,:warehouse_id,:quantity,:price)");
    $query->bindParam(":prod_id",$prod_id);
    $query->bindParam(":warehouse_id",$warehouse_id);
    $query->bindParam(":quantity",$quantity);
    $query->bindParam(":price",$price);
    $query->execute();
  }

  function getInventoryItem($inventory_id) {
    global $pdo;

    $query = $pdo->prepare("SELECT * FROM inventory WHERE inventory_id = :inventory_id");
    $query->bindParam(":inventory_id",$inventory_id);
    $query->execute();

    $results = $query->fetchAll(PDO::FETCH_ASSOC);

    if (empty($results)) return null;
    return $results[0];
  }

  function deleteInventoryItem($inventory_id) {
    global $pdo;

    $query = $pdo->prepare("DELETE FROM inventory WHERE inventory_id = :inventory_id");
    $query->bindParam(":inventory_id",$inventory_id);
    $query->execute();
  }

  function editInventoryItem($inventory_id,$product_id,$warehouse_id,$quantity,$price) {
    global $pdo;
    //echo $inventory_id." ".$product_id." ".$warehouse_id." ".$quantity." ".$price;
    $query = $pdo->prepare("UPDATE inventory
    SET inventory_product_id = :product_id, inventory_warehouse_id = :warehouse_id, quantity = :quantity, price = :price
    WHERE inventory_id = :inventory_id");
    $query->bindParam(":inventory_id",$inventory_id);
    $query->bindParam(":product_id",$product_id);
    $query->bindParam(":warehouse_id",$warehouse_id);
    $query->bindParam(":quantity",$quantity);
    $query->bindParam(":price",$price);
    $query->execute();
  }

?>