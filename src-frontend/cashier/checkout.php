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
                                Sub Total:
                            </th>
                            <th scope="col" style=" font-size: 22px; font-weight: bold;">
                                Rp xxx.xxx.xxx
                            </th>
                            <th scope="col"></th>
                        </tr>
                        <tr>
                            <th scope="col" style="width: 150px; font-size: 22px; font-weight: bold;">
                                Tax
                            </th>
                            <th scope="col" style=" font-size: 22px; font-weight: bold;">
                                Rp xxx.xxx.xxx
                            </th>
                            <th scope="col"></th>
                        </tr>
                        <tr>
                            <th scope="col" style="width: 150px; font-size: 22px; font-weight: bold;">
                                Total:
                            </th>
                            <th scope="col" style=" font-size: 22px; font-weight: bold;">
                                Rp xxx.xxx.xxx
                            </th>
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
              <form action="/staff/menu.php" method="POST">
                <div class="form-group">
                  <label for="branch-name" class="col-form-label">Sub Total</label>
                  <input type="text" class="form-control" name="sub_total" value="120000" disabled/>
                </div>
                <div class="form-group">
                <label for="message-text" class="col-form-label">Payment Method</label>
                <select  class="form-control" name="item_size" value="".$item["item_size"]."">
                    <option value="1">Cash</option>
                    <option value="2">Starbucks Card</option>
                    <option value="3">Debit Card</option>
                    <option value="4">Credit Card</option>
                </select>
              </div>
              <div class="form-group" id="paymentMethodDetails">
                <label for="message-text" class="col-form-label">Cash Amount</label>
                <input type="text" class="form-control" name="sub_total" value="120000">
              </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-primary">Checkout</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
</body>
</html>