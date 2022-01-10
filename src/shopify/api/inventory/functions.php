<?php
  require(__DIR__ ."/../database.php");
  //include_once __DIR__ ."/../product/functions.php";
  //include_once __DIR__ ."/../warehouse/functions.php";

  function getInvetoryList() {
    global $pdo;

    $query = $pdo->prepare("SELECT * FROM inventory");
    $query->execute();

    $results = $query->fetchAll(PDO::FETCH_ASSOC);

    if (empty($results)) return array();
    return $results;
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