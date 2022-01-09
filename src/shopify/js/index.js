$(document).on("click", "#addWarehouseModal #save", function (e) {
  
  var address = $("#addWarehouseModal #warehouse_address").val()
  var city = $("#addWarehouseModal #warehouse_city").val()
  var country = $("#addWarehouseModal #warehouse_country").val()
  
  var xhttp = new XMLHttpRequest(); //Making a new request to another page
  xhttp.open("POST", "./api/warehouse.php?address="+address+"&city="+city+"&country="+country) //Declaring the method and the file name of which we want to go to
  xhttp.send(); //Sending to file

  $('#addWarehouseModal').modal('hide');

});

$(document).on("click", "#addProductModal #save", function (e) {
  
  var product_name = $("#addProductModal #product_name").val()
  
  var xhttp = new XMLHttpRequest(); //Making a new request to another page
  xhttp.open("POST", "./api/product.php?product_name="+product_name) //Declaring the method and the file name of which we want to go to
  xhttp.send(); //Sending to file

  $('#addProductModal').modal('hide');

});

$(document).on("click", "#addInventoryModal #save", function (e) {
  
  var product_id = $("#addInventoryModal #product_list").val()
  var warehouse_id = $("#addInventoryModal #warehouse_list").val()
  var quantity = $("#addInventoryModal #quantity").val()
  var price = $("#addInventoryModal #price").val()
  
  var xhttp = new XMLHttpRequest(); //Making a new request to another page
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) { //If state is correct and it doesn't error (404)
      location.reload()
    }
  }
  xhttp.open("POST", "./api/inventory.php?product_id="+product_id+"&warehouse_id="+warehouse_id+"&quantity="+quantity+"&price="+price) //Declaring the method and the file name of which we want to go to
  xhttp.send(); //Sending to file

  $('#addInventoryModal').modal('hide');

});

$(document).on("click", "#addinventory", function (e) {
    
  //APPEND WAREHOUSE LIST TO MODAL
  var xhttp = new XMLHttpRequest(); //Making a new request to another page
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) { //If state is correct and it doesn't error (404)
      $("#addInventoryModal #warehouse_list").empty()
      const response = JSON.parse(this.responseText)
      $(response).each(function(index) {
        $("#addInventoryModal #warehouse_list").append("<option value='"+this['warehouse_id']+"'>"+this['address']+" "+this['city']+" "+this['country']+"</option>")
      });
    }
  }
  xhttp.open("GET", "./api/warehouse.php") //Declaring the method and the file name of which we want to go to
  xhttp.send(); //Sending to file


  //APPEND PRODUCT LIST TO MODAL
  var xhttp = new XMLHttpRequest(); //Making a new request to another page
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) { //If state is correct and it doesn't error (404)
      $("#addInventoryModal #product_list").empty()
      const response = JSON.parse(this.responseText)
      $(response).each(function(index) {
        $("#addInventoryModal #product_list").append("<option value='"+this['product_id']+"'>"+this['product_name']+"</option>")
      });
    }
  }
  xhttp.open("GET", "./api/product.php") //Declaring the method and the file name of which we want to go to
  xhttp.send(); //Sending to file

});








$(document).on("click", ".sub-inventory", function (e) {
  const inventory_id = $(this).attr("id")
  const title = $(this).html()

  var xhttp = new XMLHttpRequest(); //Making a new request to another page
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) { //If state is correct and it doesn't error (404)
      $("#editInventoryModalTitle").html("Edit Info for "+title);
      const item = JSON.parse(this.responseText)
      //APPEND WAREHOUSE LIST TO MODAL
      var xhttp = new XMLHttpRequest(); //Making a new request to another page
      xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) { //If state is correct and it doesn't error (404)
          $("#editInventoryModal #warehouse_list").empty()
          const response = JSON.parse(this.responseText)

          $(response).each(function(index) {
            if (this['warehouse_id'] == item['inventory_warehouse_id']) $("#editInventoryModal #warehouse_list").append("<option selected value='"+this['warehouse_id']+"'>"+this['address']+" "+this['city']+" "+this['country']+"</option>")
            else $("#editInventoryModal #warehouse_list").append("<option value='"+this['warehouse_id']+"'>"+this['address']+" "+this['city']+" "+this['country']+"</option>")
          });
        }
      }
      xhttp.open("GET", "./api/warehouse.php") //Declaring the method and the file name of which we want to go to
      xhttp.send(); //Sending to file
    
    
      //APPEND PRODUCT LIST TO MODAL
      var xhttp = new XMLHttpRequest(); //Making a new request to another page
      xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) { //If state is correct and it doesn't error (404)
          $("#editInventoryModal #product_list").empty()
          const response = JSON.parse(this.responseText)
          $(response).each(function(index) {
            if (this['product_id'] == item['inventory_product_id']) $("#editInventoryModal #product_list").append("<option selected value='"+this['product_id']+"'>"+this['product_name']+"</option>")
            else $("#editInventoryModal #product_list").append("<option value='"+this['product_id']+"'>"+this['product_name']+"</option>")
          });
        }
      }
      xhttp.open("GET", "./api/product.php") //Declaring the method and the file name of which we want to go to
      xhttp.send(); //Sending to file

      $("#editInventoryModal #price").val(item['price'])
      $("#editInventoryModal #quantity").val(item['quantity'])
      $("#editInventoryModal #inventory_id").val(inventory_id)
    }
  }

  xhttp.open("GET", "./api/inventory.php?inventory_id="+inventory_id); //Declaring the method and the file name of which we want to go to
  xhttp.send(); //Sending to file


});

$(document).on("click", "#editInventoryModal #delete", function (e) {
  var inventory_id = $("#editInventoryModal #inventory_id").val()

  $("#"+inventory_id).parent().remove();

  var xhttp = new XMLHttpRequest(); //Making a new request to another page
  xhttp.open("DELETE", "./api/inventory.php?inventory_id="+inventory_id); //Declaring the method and the file name of which we want to go to
  xhttp.send(); //Sending to file
});

$(document).on("click", "#editInventoryModal #edit", function (e) {
  var inventory_id = $("#editInventoryModal #inventory_id").val()
  var warehouse_id = $("#editInventoryModal #warehouse_list").val()
  var price = $("#editInventoryModal #price").val()
  var quantity = $("#editInventoryModal #quantity").val()
  var product_name = $("#"+inventory_id).html().split("@")[0]

  var xhttp = new XMLHttpRequest(); //Making a new request to another page
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) { //If state is correct and it doesn't error (404)
      const location = this.responseText;
      $("#"+inventory_id).html(product_name+"@ "+location);
    }
  }
  
  xhttp.open("PUT", "./api/inventory.php?inventory_id="+inventory_id+"&warehouse_id="+warehouse_id+"&price="+price+"&quantity="+quantity); //Declaring the method and the file name of which we want to go to
  xhttp.send(); //Sending to file

  $('#editInventoryModal').modal('hide');
});