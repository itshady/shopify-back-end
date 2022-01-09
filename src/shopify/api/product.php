<?php
  require("./functions.php");

  if ($_SERVER['REQUEST_METHOD'] == "POST") {
    //adding a new product
    if (!empty($_GET['product_name'])){
      addProduct($_GET['product_name']);
      echo "Product successfully added";
    }
    else echo "Product Name was empty. Not Added to Database.";
  }
  else if ($_SERVER['REQUEST_METHOD'] == "GET") {
    echo json_encode(getProductsList());
  }



?>