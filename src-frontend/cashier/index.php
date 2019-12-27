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
    <div class="container">
        <?php include("../components/navbar/navbar_welcome.php"); ?>
        <div class="card-deck" style="width:100%; margin: 50px auto auto auto;">
            <div class="card border-dark mb-3">
                <img src="/resources/history.svg" class="card-img-top" style="width:70%;
            margin-left:60px;
            margin-top:30px;" />
                <div class="card-body">
                    <p class="card-text" style="margin-top: 15px; text-align: center;">
                        Click here to view transaction history.
                    </p>
                    <a href="/cashier/history.php" class="btn btn-primary" style="width: 100%; background-color: #006335; border-color: #006335 ; font-weight: bold;">Transaction History</a>
                </div>
            </div>
            <div class="card border-dark mb-3">
                <img src="/resources/order.svg" class="card-img-top" style="width:80%; margin-left: 45px; margin-top:10px;" />
                <div class="card-body">
                    <p class="card-text" style="text-align: center;">
                        Click here to make a new order.
                    </p>
                    <a href="/cashier/new_order.php" class="btn btn-primary" style="width: 100%; background-color: #006335; border-color: #006335 ; font-weight: bold;">New Order</a>
                </div>
            </div>
        </div>
    </div>
</body>

</html>