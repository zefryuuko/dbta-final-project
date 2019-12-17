<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <link href="/resources/logo.png" rel="shortcut icon" />
    <title>Dashboard</title>
    <?php include("../components/bootstrap.php"); ?>

<body>
    <?php include("../components/navbar/navbar_welcome.php"); ?>
    <div class="card-deck" style="width:800px; margin-left: 350px; margin-top: 50px">
        <div class="card border-dark mb-3">
            <img src="/resources/history.avg" class="card-img-top" style="width:80%;
        margin-left:25px;
        margin-top:10px;" />
            <div class="card-body">
                <p class="card-text" style="margin-top: 12px; text-align: center;">
                    Click here to view transaction history.
                </p>
                <a href="/cashier/history.php" class="btn btn-primary" style="width: 100%; background-color: #006335; border-color: #006335 ; font-weight: bold;">Transaction History</a>
            </div>
        </div>
        <div class="card border-dark mb-3">
            <img src="/resources/order.avg" class="card-img-top" style="width:89%; margin-left: 25px; margin-top:10px;" />
            <div class="card-body">
                <p class="card-text" style="text-align: center;">
                    Click here to make a new order.
                </p>
                <a href="/cashier/new_order.php" class="btn btn-primary" style="width: 100%; background-color: #006335; border-color: #006335 ; font-weight: bold;">New Order</a>
            </div>
        </div>
    </div>
</body>

</html>