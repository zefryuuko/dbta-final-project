<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <?php include("../components/bootstrap.php"); ?>
</head>

<body>
    <?php include("../components/navbar_staff.php"); ?>

    <div class="card-deck" style="width:1455px; margin-left: 40px; margin-top: 50px">
        <div class="card border-dark mb-3">
            <img src="/resources/history.jpg" class="card-img-top" style="width:80%;
        margin-left:25px;
        margin-top:10px;" />
            <div class="card-body">
                <p class="card-text" style="margin-top: 3px; text-align: center;">
                    Click here to view transaction history.
                </p>
                <a href="#" class="btn btn-primary" style="width: 100%; background-color: #006335; border-color: #006335 ; font-weight: bold;">Transaction History</a>
            </div>
        </div>
        <div class="card border-dark mb-3">
            <img src="/resources/order.png" class="card-img-top" style="width:87%; margin-left: 25px; margin-top:10px;" />
            <div class="card-body">
                <p class="card-text" style="text-align: center;">
                    Click here to make a new order.
                </p>
                <a href="#" class="btn btn-primary" style="width: 100%; background-color: #006335; border-color: #006335 ; font-weight: bold;">New Order</a>
            </div>
        </div>
        <div class="card border-dark mb-3">
            <img src="/resources/staff.png" class="card-img-top" style="width:90%; margin-left:25px;" />
            <div class="card-body">
                <p class="card-text" style="margin-top: -2px; text-align: center;">
                    Click here to see staff details.
                </p>
                <a href="#" class="btn btn-primary" style="width: 100%; background-color: #006335; border-color: #006335 ; font-weight: bold;">Staff Details</a>
            </div>
        </div>
        <div class="card border-dark mb-3">
            <img src="/resources/menu.jpg" class="card-img-top" style="width:80%; margin-left:25px;" />
            <div class="card-body">
                <p class="card-text" style="margin-top: 32px; text-align: center;">
                    Click here to see & add item to menu.
                </p>
                <a href="#" class="btn btn-primary" style="width: 100%; background-color: #006335; border-color: #006335 ; font-weight: bold;">Menu</a>
            </div>
        </div>
    </div>
</body>

</html>