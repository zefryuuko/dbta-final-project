<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <link href="../Images/starbucks favicon.png" rel="shortcut icon" />
    <title>Dashboard</title>

    <?php include("../components/bootstrap.php"); ?>
</head>

<body>
    <?php include("../components/navbar/navbar_cashier.php"); ?>

    <div class="bodyLeft" style="float:left;">
        <p style="font-size:20px; padding-left:10px; margin-left: 45px; margin-top:5px;">
            <b>Transaction ID</b>: xxxxxxxxxx <br />
            <b>Date</b>: DD/MM/YYYY <br />
            <b>Cashier</b>: Zef
        </p>

        <div class="table-responsive">
            <table class="table" style="width: 650px; float: left; margin-left: 55px; margin-top:20px;">
                <thead class="thead-dark" style="font-size: 20px">
                    <tr>
                        <th scope="col" style="width: 200px">Transaction ID</th>
                        <th scope="col" style="width: 100px">Item</th>
                        <th scope="col" style="width: 150px">Quantity</th>
                        <th scope="col">Price</th>
                    </tr>
                </thead>
                <tbody style="font-size: 18px">
                    <tr>
                        <th scope="row">1</th>
                        <td>Mark</td>
                        <td>xx</td>
                        <td>Rp xxx.xxx.xxx</td>
                    </tr>
                    <tr>
                        <th scope="row">2</th>
                        <td>Jacob</td>
                        <td>xx</td>
                        <td>Rp xxx.xxx.xxx</td>
                    </tr>
                    <tr>
                        <th scope="row">3</th>
                        <td>Larry</td>
                        <td>xx</td>
                        <td>Rp xxx.xxx.xxx</td>
                    </tr>
                    <tr>
                        <th scope="row">4</th>
                        <td>Mark</td>
                        <td>xx</td>
                        <td>Rp xxx.xxx.xxx</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <!--Order Table-->
        <button type="button" class="btn btn-light btn-primary btn-lg btn-outline-dark" style="margin-left: 55px; margin-top:110px; width: 60%">
            Back
        </button>
    </div>
    <!--End of Left Body-->

    <div class="bodyRight" style="float:right;">
        <?php include("../components/modular/total_purchase.php"); ?>
        <!--Subtotal table-->
    </div>
    <!--End of Right Body-->
</body>

</html>