<?php
  require("./functions.php");

  if ($_SERVER['REQUEST_METHOD'] == "POST") {
    //adding a new warehouse
    if (!empty($_GET['address']) && !empty($_GET['city']) && !empty($_GET['country'])){
      addWarehouse($_GET['address'],$_GET['city'],$_GET['country']);
      echo "Warehouse successfully added.";
    }
    else echo "Not all fields filled. Warehouse not added.";
  }
  else if ($_SERVER['REQUEST_METHOD'] == "GET") {
    echo json_encode(getWarehouseList());
  }


?>