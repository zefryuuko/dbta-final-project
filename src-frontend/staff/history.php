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
    <?php include("../components/navbar_staff.php"); ?>

    <p style="font-size:25px; padding: 10px; font-weight: bold; margin-left: 45px; margin-top:20px;">
        Transaction History
    </p>
    <div class="table-responsive">
        <table class="table" style="width: 1425px; float: left; margin-left: 55px; margin-top: 10px;">
            <thead class="thead-dark" style="font-size: 20px">
                <tr>
                    <th scope="col" style="width: 200px">Transaction ID</th>
                    <th scope="col" style="width: 300px">Cashier</th>
                    <th scope="col" style="width: 400px">Price</th>
                    <th scope="col" style="width: 350px">Date</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody style="font-size: 18px">
                <tr>
                    <th scope="row">1</th>
                    <td>Mark</td>
                    <td>Rp xxx.xxx.xxx</td>
                    <td>DD/MM/YYYY</td>
                    <td>
                        <a href="#"><img src="/resources/view.png" style="width: 13%" /></a>
                    </td>
                </tr>
                <tr>
                    <th scope="row">2</th>
                    <td>Jacob</td>
                    <td>Rp xxx.xxx.xxx</td>
                    <td>DD/MM/YYYY</td>
                    <td>
                        <a href="#"><img src="/resources/view.png" style="width: 13%" /></a>
                    </td>
                </tr>
                <tr>
                    <th scope="row">3</th>
                    <td>Larry</td>
                    <td>Rp xxx.xxx.xxx</td>
                    <td>DD/MM/YYYY</td>
                    <td>
                        <a href="#"><img src="/resources/view.png" style="width: 13%" /></a>
                    </td>
                </tr>
                <tr>
                    <th scope="row">4</th>
                    <td>Mark</td>
                    <td>Rp xxx.xxx.xxx</td>
                    <td>DD/MM/YYYY</td>
                    <td>
                        <a href="#"><img src="/resources/view.png" style="width: 13%" /></a>
                    </td>
                </tr>
                <tr>
                    <th scope="row">5</th>
                    <td>Mark</td>
                    <td>Rp xxx.xxx.xxx</td>
                    <td>DD/MM/YYYY</td>
                    <td>
                        <a href="#"><img src="/resources/view.png" style="width: 13%" /></a>
                    </td>
                </tr>
                <tr>
                    <th scope="row">6</th>
                    <td>Mark</td>
                    <td>Rp xxx.xxx.xxx</td>
                    <td>DD/MM/YYYY</td>
                    <td>
                        <a href="#"><img src="/resources/view.png" style="width: 13%" /></a>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <!--Order Table-->
</body>

</html>