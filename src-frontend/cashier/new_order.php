<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <link href="/resources/logo.png" rel="shortcut icon" />
    <title>Dashboard</title>

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
                var tableRow = `<tr id="table-${uid}"><td>${element["item_name"]}</td><td>${element["item_size"]}</td><td>Rp. ${element["item_price"]}</td><td><a onclick="removeItem('${uid}')"><img src="/resources/cross.svg" style="width: 45%" /></a></td><td><a href="#"><img src="/resources/discount.svg" style="width: 45%"></a></td></tr>`
                var formData = `<input type="hidden" name="item" id="item-${uid}" value="${element["item_id"]}"/>`;
                var formDiscountData = `<input type="hidden" name="discount" id="discount-${uid}" value=""/>`;
                document.getElementById("transactionTable").innerHTML += tableRow;
                document.getElementById("orderDetails").innerHTML += formData;
                document.getElementById("orderDetails").innerHTML += formDiscountData;
            }
        }
        xhttp.open("GET", `http://localhost:8081/item?id=${id}`);
        xhttp.send();
    }

    function removeItem(uid) {
        document.getElementById("table-" + uid).remove();  // Delete table entry
        document.getElementById("item-" + uid).remove();  // Delete item form entry
        document.getElementById("discount-" + uid).remove();  // Delete discount form entry
    }
    </script>
    </head>

    <body onload="try{auth()}catch(e){} populateItems()">
    <div class="container">
        <?php include("../components/navbar/navbar_cashier.php"); ?>
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
                            <th scope="col" style="width: 240px; font-size: 25px; font-weight: bold;">
                                Sub Total:
                            </th>
                            <th scope="col" style=" font-size: 25px; font-weight: bold;">
                                Rp xxx.xxx.xxx
                            </th>
                            <th scope="col"></th>
                        </tr>
                    </tbody>
                </table>
            </div>
            <!--Subtotal table-->
            <form id="orderDetails">
                <button type="button" onclick="" class="btn btn-light btn-primary btn-lg btn-outline-dark" style="width: 60%">
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