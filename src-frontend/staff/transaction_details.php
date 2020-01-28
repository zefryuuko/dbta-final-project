<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <link href="../Images/starbucks favicon.png" rel="shortcut icon" />
    <title>Dashboard</title>

    <?php include("../components/bootstrap.php"); ?>
    <?php 
      $pageLevel = 0;
      include("auth.php");
    ?>
    <?php
        include("../backend/bill.php");
        if (!isset($_GET["id"])) echo "<script>function redirect(){window.location.replace('/staff/history.php');}</script>";
        else $transactionDetails = getBillByID($_GET["id"])
    ?>
</head>

<body onload="try {auth()} catch(e) {}; redirect();">
        <?php include("../components/navbar/navbar_staff.php"); ?>
    <div class="container">

        <div class="bodyLeft">
            <p style="font-size:20px; padding-left:10px; margin-left: 45px; margin-top:5px;">
                <b>Transaction ID</b>: <?php echo $transactionDetails["bill_id"] ?> <br />
                <b>Branch</b>: <?php echo $transactionDetails["branch_name"] ?> <br />
                <b>Check Number</b>: <?php echo $transactionDetails["check_number"] ?> <br />
                <b>Cashier</b>: <?php echo $transactionDetails["staff_name"] ?> <br />
                <b>Dine Type</b>: <?php echo $transactionDetails["dine_type"] ?> <br />
                <b>Date</b>: <?php echo $transactionDetails["date_time"] ?>
            </p>

            <div class="table-responsive">
            <table class="table" style="margin-top:20px;">
                    <thead class="thead-dark" style="font-size: 20px">
                        <tr>
                            <th scope="col" style="width: 90px">Item</th>
                            <th scope="col" style="width: 50px">Size</th>
                            <th scope="col" style="width: 80px">Discount</th>
                            <th scope="col" style="width: 100px">Price</th>
                        </tr>
                    </thead>
                    <tbody style="font-size: 18px">
                        <?php
                            foreach($transactionDetails["items"] as $item)
                            {
                                $discountDetails = sizeof($item["discount"]) != 0 ? $item["discount"]["discount_name"]." - ".$item["discount"]["discount_percentage"]."%" : "";
                                echo "<tr>
                                <th scope=\"row\">".$item["item_name"]."</th>
                                <td>".$item["item_size"]."</td>
                                <td>".$discountDetails."</td>
                                <td>Rp. ".$item["item_price"]."</td>
                            </tr>";
                            }
                        ?>
                    </tbody>
                </table>
            </div>
            <div style="font-size:20px;  margin-top:5px;">
                <div class="table-responsive">
                    <table class="table" style="width: 700px; margin-right: 70px; margin-top: 20px;">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col" style="width: 150px; font-size: 22px; font-weight: bold;">
                                    Total:
                                </th>
                                <th scope="col" style=" font-size: 22px; font-weight: bold;">
                                    Rp. <?php echo $transactionDetails["amount_total"] ?>
                                </th>
                                <th scope="col"></th>
                            </tr>
                            <tr>
                                <th scope="col" style="width: 150px; font-size: 22px; font-weight: bold;">
                                    Amount Paid:
                                </th>
                                <th scope="col" style=" font-size: 22px; font-weight: bold;">
                                    Rp. <?php echo $transactionDetails["amount_paid"] ?>
                                </th>
                                <th scope="col"></th>
                            </tr>
                            <tr>
                                <th scope="col" style="width: 150px; font-size: 22px; font-weight: bold;">
                                    Amount Change:
                                </th>
                                <th scope="col" style=" font-size: 22px; font-weight: bold;">
                                    Rp. <?php echo $transactionDetails["amount_change"] ?>
                                </th>
                                <th scope="col"></th>
                            </tr>
                            <tr>
                                <th scope="col" style="width: 350px; font-size: 22px; font-weight: bold;">
                                    Payment Method:
                                </th>
                                <th scope="col" style=" font-size: 22px; font-weight: bold;">
                                    <?php echo $transactionDetails["payment_method"] ?>
                                </th>
                                <th scope="col"></th>
                            </tr>
                            <?php if ($transactionDetails["payment_method"] == "Starbucks Card") {
                                echo "<tr>
                                <th scope=\"col\" style=\"width: 250px; font-size: 22px; font-weight: bold;\">
                                    Card No:
                                </th>
                                <th scope=\"col\" style=\" font-size: 22px; font-weight: bold;\">
                                    ".$transactionDetails["card_no"]."
                                </th>
                                <th scope=\"col\"></th>
                            </tr>
                            <tr>
                                <th scope=\"col\" style=\"width: 250px; font-size: 22px; font-weight: bold;\">
                                    Cardholder Name:
                                </th>
                                <th scope=\"col\" style=\" font-size: 22px; font-weight: bold;\">
                                    ".$transactionDetails["cardholder_name"]."
                                </th>
                                <th scope=\"col\"></th>
                            </tr>";
                            } ?>
                        </thead>
                    </table>
                </div>
            </div>
            <!--Order Table-->
            <a type="button" href="/staff/history.php" class=" btn btn-light btn-primary btn-lg btn-outline-dark" style="margin-top:20px; width: 750px">
                Back
            </a>
        </div>
        <!--End of Left Body-->

        <div class="bodyRight">
            
            <!--Subtotal table-->
        </div>
        <!--End of Right Body-->
    </div>
</body>

</html>