<?php
  require("./functions.php");

  if ($_SERVER['REQUEST_METHOD'] == "POST") {
    //adding a new warehouse
    if (!empty($_GET['product_id']) && !empty($_GET['warehouse_id']) && !empty($_GET['quantity']) && !empty($_GET['price'])){
      addInvetory($_GET['product_id'],$_GET['warehouse_id'],$_GET['quantity'],$_GET['price']);
      echo "Inventory successfully added.";
    }
    else echo "Not all fields filled. Inventory not added.";
  }
  else if ($_SERVER['REQUEST_METHOD'] == "GET") {
    if (empty($_GET['inventory_id'])){
      echo json_encode(getInvetoryList());
    }
    else {
      $result = getInventoryItem($_GET['inventory_id']);
      if ($result == null) {
        echo "null";
      }
      else echo json_encode($result);
    } 
  }
  else if ($_SERVER['REQUEST_METHOD'] == "DELETE") {
    if (getInventoryItem($_GET['inventory_id']) != null) {
      deleteInventoryItem($_GET['inventory_id']);
      echo "Inventory successfully deleted";
    }
    else {
      echo "Inventory could not be deleted. It doesn't exist in the database.";
    }
  }
  else if ($_SERVER['REQUEST_METHOD'] == "PUT") {
    $inventory_id = $_GET['inventory_id'];
    $product_id = getInventoryItem($inventory_id)['inventory_product_id'];
    $warehouse_id = $_GET['warehouse_id'];
    $quantity = $_GET['quantity'];
    $price = $_GET['price'];
    
    editInventoryItem($inventory_id,$product_id,$warehouse_id,$quantity,$price);
    echo getWarehouseAddress($warehouse_id);
  }

?>