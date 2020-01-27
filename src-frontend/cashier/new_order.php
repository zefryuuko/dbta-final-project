<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <link href="/resources/logo.png" rel="shortcut icon" />
    <title>New Order - Dashboard</title>

    <?php include("../components/bootstrap.php"); ?>
    <?php 
      $pageLevel = 1;
      include("auth.php");
      include("../backend/staff.php");
      $staffName = getStaffByID($_COOKIE["id"])[0]["staff_name"];
    ?>
    <script type="application/javascript">
    function generateID(length) {
        var result           = '';
        var characters       = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
        var charactersLength = characters.length;
        for ( var i = 0; i < length; i++ ) {
            result += characters.charAt(Math.floor(Math.random() * charactersLength));
        }
        return result;
        // https://stackoverflow.com/questions/1349404/generate-random-string-characters-in-javascript
    }
    function populateItems() {
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                var items = JSON.parse(this.responseText);
                var tableBody = "";
                items.forEach(element => {
                    tableBody = tableBody + `<tr><td>${element["item_name"]}</td><td>${element["item_size"]}</td><td>Rp. ${element["item_price"]}</td><td><a onclick="addItem(${element["item_id"]})"><img src="/resources/plus.svg" style="width: 33%"/></a></td></tr>`
                });
                document.getElementById("itemsTable").innerHTML = tableBody;
            }
        }
        xhttp.open("GET", "http://localhost:8081/item");
        xhttp.send();
    }

    function populateItemsByName() {
        if (document.getElementById("itemSearchBox").value == "") {
            populateItems();
            return;
        }

        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                var items = JSON.parse(this.responseText);
                var tableBody = "";
                items.forEach(element => {
                    tableBody = tableBody + `<tr><td>${element["item_name"]}</td><td>${element["item_size"]}</td><td>Rp. ${element["item_price"]}</td><td><a onclick="addItem(${element["item_id"]})"><img src="/resources/plus.svg" style="width: 33%"/></a></td></tr>`
                });
                document.getElementById("itemsTable").innerHTML = tableBody;
            }
        }
        xhttp.open("GET", `http://localhost:8081/item?name=${document.getElementById("itemSearchBox").value}`);
        xhttp.send();
    }

    function addItem(id){
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                var element = JSON.parse(this.responseText)[0];
                var uid = generateID(8);
                var tableRow = `<tr id="table-${uid}"><td>${element["item_name"]}</td><td>${element["item_size"]}</td><td id="price-${uid}">Rp. ${element["item_price"]}</td><td><a onclick="removeItem('${uid}')"><img src="/resources/cross.svg" style="width: 45%" /></a></td><td><a href="#"><img src="/resources/discount.svg" id="discountbtn-${uid}" data-toggle="modal" data-target="#discountModal-${uid}" style="width: 45%"></a></td></tr>`
                var formData = `<input type="hidden" name="items[]" id="item-${uid}" value="${element["item_id"]}"/>`;
                var formDiscountData = `<input type="hidden" name="discounts[]" id="discount-${uid}" value=""/>`;
                var discountSelectionModal = `<div class="modal fade" id="discountModal-${uid}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Discount</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form>
                <div class="form-group">
                  <label for="branch-name" class="col-form-label">Selected Item</label>
                  <input type="text" class="form-control" name="sub_total" value="Caramel Macchiato" disabled/>
                </div>
                <div class="form-group">
                <label for="message-text" class="col-form-label">Select Discount</label>
                <select  class="form-control" id="selectedDiscount-${uid}" value="">
                    <option value="">No Discount</option>
                    <option value="1">Disc 1</option>
                    <option value="2">Disc 2</option>
                </select>
              </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                  <button type="button" class="btn btn-primary" data-dismiss="modal" onclick="var e = document.getElementById('selectedDiscount-${uid}'); setDiscount('${uid}', e.options[e.selectedIndex].value)">Set Discount</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>`
                document.getElementById("transactionTable").innerHTML += tableRow;
                document.getElementById("orderDetails").innerHTML += formData;
                document.getElementById("orderDetails").innerHTML += formDiscountData;
                document.body.innerHTML += discountSelectionModal;

                // Update subtotal
                var newSubtotal = parseInt(document.getElementById("subTotal").innerHTML.slice(4)) + element["item_price"];
                document.getElementById("subTotal").innerHTML = "Rp. " + newSubtotal.toString();
            }
        }
        xhttp.open("GET", `http://localhost:8081/item?id=${id}`);
        xhttp.send();
    }

    function removeItem(uid) {
        // Update subtotal
        var newSubtotal = parseInt(document.getElementById("subTotal").innerHTML.slice(4)) - parseInt(document.getElementById("price-" + uid).innerHTML.slice(4));
        document.getElementById("subTotal").innerHTML = "Rp. " + newSubtotal.toString();

        document.getElementById("table-" + uid).remove();  // Delete table entry
        document.getElementById("item-" + uid).remove();  // Delete item form entry
        document.getElementById("discount-" + uid).remove();  // Delete discount form entry
        document.getElementById("discountModal-" + uid).remove();  // Delete discount selection modal
    }

    function setDiscount(uid, discountId) {
        if (discountId != "") {
            document.getElementById("discount-" + uid).value = discountId;
            document.getElementById("price-" + uid).style = "color:orange";
            document.getElementById("discountbtn-" + uid).dataset.target = "";
            document.getElementById("discountbtn-" + uid).style = "width: 45%; opacity:.5;";
        }
    }

    function closeOrder() {
        if (document.orderDetails.childElementCount == 2) {
            alert("A minimum of one item is required to close an order.");
            return false;
        }
        document.orderDetails.submit();
    }
    </script>
    </head>

    <body onload="try{auth()}catch(e){} populateItems()">
        <?php include("../components/navbar/navbar_cashier.php"); ?>
    <div class="container">
        <div id="test"></div>
        <div class="bodyLeft" style="float:left; ">
        <p style="font-size:25px; margin-top:13px; font-weight: bold;">
                Current Transaction
            </p>
            <div class="table-responsive">
                <table class="table" style="width: 550px; float: left;">
                    <thead class="thead-dark" style="font-size: 20px">
                        <tr>
                            <th scope="col" style="width: 200px">Item</th>
                            <th scope="col" style="width: 100px">Size</th>
                            <th scope="col" style="width: 120px">Price</th>
                            <th scope="col"></th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody id="transactionTable" style="font-size: 18px">

                    </tbody>
                </table>
            </div>
            <!--Order Table-->

            <br /><br />

            <div class="table-responsive">
            <table class="table" style="width: 550px; float: left;">
                    <tbody class="thead-dark">
                        <tr>
                            <th scope="col" style="width: 240px; font-size: 20px; font-weight: bold;">
                                Total <br>(before discount):
                            </th>
                            <th scope="col" id="subTotal" style=" font-size: 25px; font-weight: bold;">Rp. 0</th>
                            <th scope="col"></th>
                        </tr>
                    </tbody>
                </table>
            </div>
            <!--Subtotal table-->
            <form name="orderDetails" id="orderDetails" action="/cashier/checkout.php" method="POST">
                <button type="button" onclick="return closeOrder()" class="btn btn-light btn-primary btn-lg btn-outline-dark" style="width: 60%">
                    Close Order
                </button>

                <button type="button" onclick="window.location.replace('/cashier/index.php')" class="btn btn-danger btn-lg" style="margin-left:22px; width: 35%">
                    Cancel Order
                </button>
            </form>
        </div>
        <!--End of Left Body-->

        <div class="bodyRight" style="float:right;">
        <nav class="navbar navbar-light" style="font-size:25px; padding: 10px; font-weight: bold; ">
                <a class="navbar-brand">Items</a>
                <div class="form-inline" style="">
                    <input class="form-control mr-sm-2" id="itemSearchBox" type="search" placeholder="Search" aria-label="Search" />
                    <button class="btn btn-light btn-outline-dark my-2 my-sm-0" onclick="populateItemsByName()">
                        Search
                    </button>
                </div>
            </nav>

            <div class="table-responsive">
            <table class="table" style="width: 550px; float: left; margin-top: 5px;">
                    <thead class="thead-dark" style="font-size: 20px">
                        <tr>
                            <th scope="col" style="width: 200px">Item Name</th>
                            <th scope="col" style="width: 150px">Size</th>
                            <th scope="col" style="width: 120px">Price</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody id="itemsTable" style="font-size: 18px">
                    </tbody>
                </table>
            </div>
        </div>
        <!--End of Right Body-->
    </div>
</body>

</html>