<?php
    require("./api/functions.php");
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <style>
        body{
            margin: 50px;
        }
        .inventory {
          width: calc(100% / 3);
          font-weight: bold;
          font-size: 20px;
        }
        .sub-inventory {
          margin-bottom: 0;
          width:fit-content;
        }
        .sub-inventory:hover {
          cursor:pointer;
          text-decoration: underline;
        }
    </style>
</head>

  <body>
  
    <!-- Modal Add Warehouse -->
    <div class="modal fade" id="addWarehouseModal" tabindex="-1" aria-labelledby="addWarehouseModalTitle" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="addWarehouseModalTitle">Add Warehouse</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <div class="input-group mb-3">
              <span class="input-group-text" id="basic-addon3">Address</span>
              <input type="text" class="form-control" id="warehouse_address" aria-describedby="basic-addon3">
            </div>
            <div class="input-group mb-3">
              <span class="input-group-text" id="basic-addon3">City</span>
              <input type="text" class="form-control" id="warehouse_city" aria-describedby="basic-addon3">
            </div>
            <div class="input-group mb-3">
              <span class="input-group-text" id="basic-addon3">Country</span>
              <input type="text" class="form-control" id="warehouse_country" aria-describedby="basic-addon3">
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="button" id="save" class="btn btn-primary">Save</button>
          </div>
        </div>
      </div>
    </div>

    <!-- Modal Add Product -->
    <div class="modal fade" id="addProductModal" tabindex="-1" aria-labelledby="addProductModalTitle" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="addProductModalTitle">Add Product</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <div class="input-group mb-3">
              <span class="input-group-text" id="basic-addon3">Product Name</span>
              <input type="text" class="form-control" id="product_name" aria-describedby="basic-addon3">
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="button" id="save" class="btn btn-primary">Save</button>
          </div>
        </div>
      </div>
    </div>
    
    <!-- Modal Add Inventory -->
    <div class="modal fade" id="addInventoryModal" tabindex="-1" aria-labelledby="addInventoryModalTitle" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="addInventoryModalTitle">Add Inventory</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <div class="input-group mb-3">
              <label class="input-group-text" for="product_list">Product</label>
              <select class="form-select" id="product_list">
                <!--ADD THE PRODUCTS HERE-->
              </select>
            </div><div class="input-group mb-3">
              <label class="input-group-text" for="warehouse_list">Warehouses</label>
              <select class="form-select" id="warehouse_list">
                <!--ADD THE WAREHOUSES HERE-->
              </select>
            </div><div class="input-group mb-3">
              <span class="input-group-text" id="basic-addon3">Price $</span>
              <input type="number" step="0.01" min="0" class="form-control" id="price" aria-describedby="basic-addon3">
            </div>
            <div class="input-group mb-3">
              <span class="input-group-text" id="basic-addon3">Quantity</span>
              <input type="number" step="1" min="0" class="form-control" id="quantity" aria-describedby="basic-addon3">
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="button" id="save" class="btn btn-primary">Save</button>
          </div>
        </div>
      </div>
    </div>

    <!-- Modal Invetory Edit-->
    <div class="modal fade" id="editInventoryModal" tabindex="-1" aria-labelledby="editInventoryModalTitle" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="editInventoryModalTitle">Modal title</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <div class="input-group mb-3">
              <label class="input-group-text" for="product_list">Product</label>
              <select class="form-select" id="product_list" disabled="">
                <!--ADD THE PRODUCT HERE-->
              </select>
            </div><div class="input-group mb-3">
              <label class="input-group-text" for="warehouse_list">Warehouses</label>
              <select class="form-select" id="warehouse_list">
                <!--ADD THE WAREHOUSES HERE-->
              </select>
            </div><div class="input-group mb-3">
              <span class="input-group-text" id="basic-addon3">Price $</span>
              <input type="number" step="0.01" min="0" class="form-control" id="price" aria-describedby="basic-addon3">
            </div>
            <div class="input-group mb-3">
              <span class="input-group-text" id="basic-addon3">Quantity</span>
              <input type="number" step="1" min="0" class="form-control" id="quantity" aria-describedby="basic-addon3">
            </div>
            <input type="hidden" id="inventory_id">
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="button" id="delete" class="btn btn-danger" data-bs-dismiss="modal">Delete</button>
            <button type="button" id="edit" class="btn btn-primary">Save changes</button>
          </div>
        </div>
      </div>
    </div>


    <div class="d-flex flex-row flex-wrap justify-content-start width-75">
    <?php
        $inventory = getInvetoryList();
        foreach ($inventory as $products) {
          $product_name = getProductName($products['inventory_product_id']);
          $location = getWarehouseAddress($products['inventory_warehouse_id']);
          echo "<div class='p-2 inventory'><p class='sub-inventory' data-bs-toggle='modal' data-bs-target='#editInventoryModal' id='".$products['inventory_id']."'>".$product_name." @ ".$location."</p></div>";
        }
    ?>
    </div>
    <hr>
    <div class="d-flex flex-row flex-wrap justify-content-center width-100">
      <button type="button" id="addwarehouse" class="btn btn-danger m-2 add" data-bs-toggle="modal" data-bs-target="#addWarehouseModal">Add Warehouse</button>
      <button type="button" id="addproduct" class="btn btn-primary m-2 add" data-bs-toggle="modal" data-bs-target="#addProductModal">Add Product</button>
      <button type="button" id="addinventory" class="btn btn-success m-2 add" data-bs-toggle="modal" data-bs-target="#addInventoryModal">Add Inventory</button>
    </div>
    
    <!-- Scripts -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
    <script src="js/index.js"></script>
  </body>

</html>