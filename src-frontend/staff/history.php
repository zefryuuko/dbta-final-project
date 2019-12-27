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
    <div class="container">
        <?php include("../components/navbar/navbar_staff.php"); ?>

        <p style="font-size:25px; padding: 10px; font-weight: bold; margin-left: 45px; margin-top:20px;">
            Transaction History
        </p>
        <div class="table-responsive">
            <table class="table" style="width: 1000px; float: left; margin-left: 55px; margin-top: 10px;">
                <thead class="thead-dark" style="font-size: 20px">
                    <tr>
                        <th scope="col" style="width: 200px">Transaction ID</th>
                        <th scope="col" style="width: 150px">Cashier</th>
                        <th scope="col" style="width: 200px">Price</th>
                        <th scope="col" style="width: 250px">Date</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody style="font-size: 18px">
                    <?php include("../components/modular/history_staff.php"); ?>
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>