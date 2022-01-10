<?php
  require(__DIR__ ."/../database.php");

  function getWarehouseList() {
    global $pdo;

    $query = $pdo->prepare("SELECT * FROM warehouses");
    $query->execute();

    $results = $query->fetchAll(PDO::FETCH_ASSOC);

    if (empty($results)) return array();
    return $results;
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

  function addWarehouse($address,$city,$country) {
    global $pdo;

    $query = $pdo->prepare("INSERT INTO warehouses (`address`, city, country)
    VALUES (:laddress, :city, :country)");
    $query->bindParam(":laddress",$address);
    $query->bindParam(":city",$city);
    $query->bindParam(":country",$country);
    $query->execute();
    
  }

?>