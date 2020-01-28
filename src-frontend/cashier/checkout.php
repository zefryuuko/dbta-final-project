<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <link href="/resources/logo.png" rel="shortcut icon" />
    <title>Checkout - Dashboard</title>
    <?php include("../components/bootstrap.php"); ?>
    <?php 
      $pageLevel = 1;
      include("auth.php");
      include("../backend/staff.php");
      include("../backend/config.php");
      $staffName = getStaffByID($_COOKIE["id"])[0]["staff_name"];
    ?>
    </head>

    <body onload="try{auth()}catch(e){}">
        <?php include("../components/navbar/navbar_cashier.php"); ?>
    <div class="container">

        <div class="bodyLeft" style="">
            <p style="font-size:25px;font-weight: bold;margin-top:20px;">
                Transaction Summary
            </p>
            <div class="table-responsive">
                <table class="table" style="">
                    <thead class="thead-dark" style="font-size: 20px">
                        <tr>
                            <th scope="col" style="width: 200px">Item</th>
                            <th scope="col" style="width: 100px">Size</th>
                            <th scope="col" style="width: 200px">Discount</th>
                            <th scope="col" style="width: 200px">Price</th>
                        </tr>
                    </thead>
                    <tbody style="font-size: 18px">
                        <?php
                            include("../components/modular/order_checkout.php"); 
                            generateTableBody($_POST);
                        ?>
                    </tbody>
                </table>
            </div>
            <!--Order Table-->
        </div>
        <!--End of Left Body-->

        <div class="bodyRight" style="">
            <div class="table-responsive">
                <table class="table" style="width: 400px; ">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col" style="width: 150px; font-size: 22px; font-weight: bold;">
                                Total:
                            </th>
                            <?php
                                $sum = 0;
                                calculateSum($_POST);
                            ?>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                </table>
            </div>
            <!--Subtotal table-->

            <!-- <button type="button" class="btn btn-light btn-primary btn-lg btn-outline-dark" style="width: 42.8%; margin-top: -135px;">
                Pay Bill
            </button> -->
            
            <button type="button" class="btn btn-light btn-primary btn-lg btn-outline-dark" data-toggle="modal" data-target="#exampleModal" style="width: 49%;">
                Done
            </button>
            
            <button type="button" class="btn btn-danger btn-primary btn-lg" style="width: 50%;">
                Cancel Order
            </button>
        </div>
    </div>

    <!-- Modal -->
    <div
        class="modal fade"
        id="exampleModal"
        tabindex="-1"
        role="dialog"
        aria-labelledby="exampleModalLabel"
        aria-hidden="true"
      >
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Checkout</h5>
              <button
                type="button"
                class="close"
                data-dismiss="modal"
                aria-label="Close"
              >
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form action="/cashier/success.php" method="POST">
                <div class="form-group">
                  <label for="branch-name" class="col-form-label">Sub Total</label>
                  <input type="text" class="form-control" name="sub_total" value="<?php echo $sum?>" disabled/>
                </div>
                <div class="form-group">
                <?php
                  foreach($_POST["items"] as $item) {
                    echo "<input type=\"hidden\" name=\"items[]\" value=\"".$item."\"></input>";
                  }
                  foreach($_POST["discounts"] as $discount) {
                    echo "<input type=\"hidden\" name=\"discounts[]\" value=\"".$discount."\"></input>";
                  }
                ?>
                <label for="message-text" class="col-form-label">Payment Method</label>
                <select  class="form-control" name="paymentMethod" id="paymentMethod" onchange="switchPaymentMethod()">
                    <option value="1">Cash</option>
                    <option value="2">Starbucks Card</option>
                    <option value="3">Debit Card</option>
                    <option value="4">Credit Card</option>
                </select>
              </div>
              <div class="form-group">
              <label for="message-text" class="col-form-label">Dine type</label>
                <select  class="form-control" name="dineType" id="dineType">
                    <option value="0">Dine in</option>
                    <option value="1">Takeaway</option>
                </select>
              </div>
              <input type="hidden" name="staffId" value="<?php echo $_COOKIE["id"]?>"/>
              <input type="hidden" name="branchId" value="<?php echo $branchId?>"/>
              <input type="hidden" name="checkNumber" value="<?php echo $checkNumber?>"/>
              <div class="form-group" id="paymentMethodDetails">
                <label for="message-text" class="col-form-label">Cash Amount</label>
                <input type="number" class="form-control" name="amountPaid" min="<?php echo $sum?>" value="<?php echo $sum?>">
              </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  <button type="submit" id="btnCheckout" class="btn btn-primary">Checkout</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
</body>
<script>
  function checkCard() {
    var cardNo = document.getElementById("cardNoInput").value;
    if (cardNo == "") {
      document.getElementById("sbuxCardDetails").innerHTML = "Please insert card number.";
    } else {
      document.getElementById("sbuxCardDetails").innerHTML = "Checking.. This shouldn't take long.";
      var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                var items = JSON.parse(this.responseText);
                if (items.length == 0) {
                    message = "Incorrect card number or card has been deactivated.";
                    document.getElementById("sbuxCardDetails").innerHTML = message;
                    return;
                }
                items.forEach(element => {
                    message = `Cardholder Name: ${element["cardholder_name"]} <br/>
                    Card Balance: ${element["card_balance"]} <br/>`;
                    message += parseInt(<?php echo $sum?>) <= parseInt(element["card_balance"]) ? `Balance is sufficient for checkout.` : "Insufficient balance."
                    if (parseInt(<?php echo $sum?>) <= parseInt(element["card_balance"])) {
                      document.getElementById("btnCheckout").disabled = false;
                      document.getElementById("btnCheckCard").disabled = true;
                      document.getElementById("cardNoInput").disabled = true;
                    }
                });
                document.getElementById("sbuxCardDetails").innerHTML = message;
                alert(document.getElementById("cardNoInput").value)
                document.getElementById("cardNo").value = document.getElementById("cardNoInput").value;
            }
        }
        xhttp.open("GET", "http://localhost:8081/card?no=" + cardNo);
        xhttp.send();
    }
  }    

  function switchPaymentMethod() {
      var e = document.getElementById("paymentMethod");
      if (e.options[e.selectedIndex].value == "1") {
        document.getElementById("paymentMethodDetails").innerHTML = `<label for="message-text" class="col-form-label">Cash Amount</label>
            <input type="number" class="form-control" name="amountPaid" min="<?php echo $sum?>" value="<?php echo $sum?>">`;
        document.getElementById("btnCheckout").disabled = false;
      } else if (e.options[e.selectedIndex].value == "2") {
        document.getElementById("paymentMethodDetails").innerHTML = `<label for="message-text" class="col-form-label">Starbucks Card Number</label>
            <input type="number" class="form-control" id="cardNoInput"/>
            <input type="hidden" value="" id="cardNo" name="cardNo"/>
            <label for="message-text" class="col-form-label" id="sbuxCardDetails"></label>
            <button type="button" style="margin-top:3px; width:100%;" id="btnCheckCard" onclick="checkCard()" class="btn btn-primary">Check Card</button>
            <input type="hidden" class="form-control" name="amountPaid" value="<?php echo $sum?>">`;
        document.getElementById("btnCheckout").disabled = "1";
      }
      else  {
        document.getElementById("paymentMethodDetails").innerHTML = `<label for="message-text" class="col-form-label">Pay Amount</label>
            <input type="hidden" class="form-control" name="amountPaid" min="<?php echo $sum?>" value="<?php echo $sum?>">
            <input type="number" class="form-control" name="" min="<?php echo $sum?>" value="<?php echo $sum?>" disabled>`;
        document.getElementById("btnCheckout").disabled = false;
      }
  }
</script>
</html>