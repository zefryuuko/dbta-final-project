<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="/resources/logo.png" rel="shortcut icon" />
    <title>Dashboard</title>
    <?php include("../components/bootstrap.php"); ?>
</head>

<body>
    <div class="container">
        <?php include("../components/navbar/navbar_welcome.php"); ?>

        <div class="card-deck" style="width:1455px; margin-left: 40px; margin-top: 50px">
            <div class="card border-dark mb-3">
                <img src="/resources/history.svg" class="card-img-top" style="width:80%;
            margin-left:25px;
            margin-top:30px;
            padding:10px;" />
                <div class="card-body">
                    <p class="card-text" style="margin-top: 45px; text-align: center;">
                        Click here to view transaction history.
                    </p>
                    <a href="/staff/history.php" class="btn btn-primary" style="width: 100%; background-color: #006335; border-color: #006335 ; font-weight: bold;">Transaction History</a>
                </div>
            </div>
            <div class="card border-dark mb-3">
                <img src="/resources/order.svg" class="card-img-top" style="width:87%; margin-left: 25px; margin-top: 10px; padding: 10px;" />
                <div class="card-body">
                    <p class="card-text" style="text-align: center; margin-top: 45px;">
                        Click here to make a new order.
                    </p>
                    <a href="/staff/new_order.php" class="btn btn-primary" style="width: 100%; background-color: #006335; border-color: #006335 ; font-weight: bold;">New Order</a>
                </div>
            </div>
            <div class="card border-dark mb-3">
                <img src="/resources/staff.svg" class="card-img-top" style="width:85%; margin-left:25px; padding:10px;" />
                <div class="card-body">
                    <p class="card-text" style="margin-top: 22px; text-align: center;">
                        Click here to see staff details.
                    </p>
                    <a href="/staff/staff_details.php" class="btn btn-primary" style="width: 100%; background-color: #006335; border-color: #006335 ; font-weight: bold;">Staff Details</a>
                </div>
            </div>
            <div class="card border-dark mb-3">
                <img src="/resources/menu.svg" class="card-img-top" style="width:75%; margin-left: 40px; padding:10px; margin-top: 30px;" />
                <div class="card-body">
                    <p class="card-text" style="margin-top: 32px; text-align: center;">
                        Click here to see & add item to menu.
                    </p>
                    <a href="/staff/menu.php" class="btn btn-primary" style="width: 100%; background-color: #006335; border-color: #006335 ; font-weight: bold;">Menu</a>
                </div>
            </div>
        </div>
    </div>
</body>

</html>