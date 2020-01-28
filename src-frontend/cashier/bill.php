<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <link href="../Images/starbucks favicon.png" rel="shortcut icon" />
    <title>Transaction Details</title>

    <?php include("../components/bootstrap.php"); ?>
    <?php 
      $pageLevel = 1;
      include("auth.php");
    ?>
    <?php
        include("../backend/bill.php");
        if (!isset($_GET["id"])) echo "<script>function redirect(){window.location.replace('/cashier/history.php');}</script>";
        else $transactionDetails = getBillByID($_GET["id"])
    ?>
    <style>
    p {
        padding: 0px;
        margin: 0px;
        font-family: Lucida Console monospace;
    }
    </style>
</head>

<body onload="try {auth()} catch(e) {}; redirect();">
    <div style="width:400px;">
    <p style="text-align:center; padding:1px;">STARBUCKS <br>
    <?php echo $transactionDetails["branch_name"] ?> <br>
    <?php echo $transactionDetails["branch_phone"] ?> <br>
    Feedback@starbucks.co.id <br>
    ===================================
    </p>
    <p style="margin-left:40px; margin-right:40px;">
        [Bill Number] [<?php echo $transactionDetails["bill_id"] ?>] <br>
        <?php echo $transactionDetails["staff_id"] ?> <?php echo $transactionDetails["staff_name"] ?> <br />
    </p>
    <p style="text-align:right; margin-right:40px;">WS#: 1</p>
    <p style="margin-left:30px; margin-right:30px; margin-top:5px; text-align:center">
    ----------------------------------------------------------- <br>
    CHK <?php echo $transactionDetails["check_number"] ?><br>
    ----------------------------------------------------------- <br>
    <?php echo $transactionDetails["dine_type"] ?>
    </p>
    <p style="margin-left:30px; margin-right:30px; margin-top:5px;">
    <?php
        foreach($transactionDetails["items"] as $item)
        {
            $discountDetails = sizeof($item["discount"]) != 0 ? $item["discount"]["discount_name"]." - ".$item["discount"]["discount_percentage"]."%" : "";
            echo "1 ".$item["item_name"]."<br>".$item["item_size"]."&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;".$item["item_price"]."<br>";
            echo $discountDetails;
        }
        if ($transactionDetails["payment_method"] == "Starbucks Card") {
            echo "STARBUCKS CARD&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;".$transactionDetails["amount_total"]."<br>".$transactionDetails["card_no"]."";
            echo "<br><br>";
            echo $transactionDetails["cardholder_name"]."<br>".$transactionDetails["card_no"]."<br>Balance: ".$transactionDetails["card_balance"];
        }
    ?>
    <br>
    <br>
    Subtotal: Rp<?php echo $transactionDetails["amount_total"] ?> <br>
    Total: Rp<?php echo $transactionDetails["amount_total"] ?> <br>
    Change Due: Rp<?php echo $transactionDetails["amount_change"] ?>
    </p>
    <p style="margin-left:30px; margin-right:30px; margin-top:5px; text-align:center">
        ---------------------- Check Closed ---------------------- <br>
        <?php echo $transactionDetails["date_time"] ?> <br> <br>
        All price are inclusive Tax 10% <br>
        PT. Sari Coffee Indonesia <br>
        NPWP : 02.107.429.9-073.000 <br>
        Gd. Sahid Sudirman Center Lt. 27 <br>
        Jl. Jend. Sudirman Kav.86 Karet Tengsin <br>
        Tanah Abang - Jakarta Pusat <br> <br>
        Can we buy you a drink? <br>
        JOIN STARBUCKS REWARDS NOW <br>
        Get bonus Stars and Rewards by <br>
        registering your Starbucks Card. <br>
        Download Starbucks ID mobile app <br>
        T&C apply. For more information, visit: <br>
        http://card.starbucks.co.id 
    </p>
    </div>
</body>

</html>