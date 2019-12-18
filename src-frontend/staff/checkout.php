<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <link href="/resources/logo.png" rel="shortcut icon" />
    <title>Dashboard</title>
    <?php include("../components/bootstrap.php"); ?>
</head>

<body>
    <?php include("../components/navbar/navbar_staff.php"); ?>

    <div class="bodyLeft" style="float: left;">
        <p style="font-size:25px; padding: 10px; font-weight: bold; margin-left: 45px; margin-top:20px;">
            Current Transaction
        </p>
        <div class="table-responsive">
            <table class="table" style="width: 650px; float: left; margin-left: 55px;">
                <thead class="thead-dark" style="font-size: 20px">
                    <tr>
                        <th scope="col" style="width: 50px">#</th>
                        <th scope="col" style="width: 150px">Item</th>
                        <th scope="col" style="width: 50px">Quantity</th>
                        <th scope="col" style="width: 90px">Size</th>
                        <th scope="col" style="width: 150px">Price</th>
                    </tr>
                </thead>
                <tbody style="font-size: 18px">
                    <?php include("../components/modular/order_checkout.php"); ?>
                    <?php include("../components/modular/order_checkout.php"); ?>
                    <?php include("../components/modular/order_checkout.php"); ?>
                    <?php include("../components/modular/order_checkout.php"); ?>
                </tbody>
            </table>
        </div>
        <!--Order Table-->

        <button type="button" class="btn btn-light btn-primary btn-lg btn-outline-dark" style="margin-left: 55px; width: 40%; margin-top: 135px;">
            Back
        </button>
    </div>
    <!--End of Left Body-->

    <div class="bodyRight" style="float: right;">
        <?php include("../components/modular/total_purchase.php"); ?>
        <!--Subtotal table-->

        <button type="button" class="btn btn-light btn-primary btn-lg btn-outline-dark" style="width: 42.8%; margin-top: 20px;">
            Discounts
        </button>

        <button type="button" class="btn btn-light btn-primary btn-lg btn-outline-dark" style="margin-left: 30px; width: 42.8%; margin-top: 20px;">
            Pay Bill
        </button>

        <button type="button" class="btn btn-danger btn-primary btn-lg" style="width: 42.8%; margin-top: 80px;">
            Cancel Order
        </button>

        <button type="button" class="btn btn-light btn-primary btn-lg btn-outline-dark" style="margin-left: 30px; width: 42.8%; margin-top: 80px;">
            Done
        </button>
    </div>
</body>

</html>