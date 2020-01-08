<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <link href="/resources/logo.png" rel="shortcut icon" />
    <title>Dashboard</title>
    <?php include("../components/bootstrap.php"); ?>
    <?php 
      $pageLevel = 0;
      include("auth.php");
    ?>
</head>

<body onload="auth()">
        <?php include("../components/navbar/navbar_staff.php"); ?>
    <div class="container">

        <p style="font-size:25px; padding: 10px; font-weight: bold; margin-left: 45px; margin-top:20px;">
            Transaction History
        </p>
        <div class="table-responsive">
            <table class="table" style="width: 1000px; float: left; margin-left: 55px; margin-top: 10px;">
                <thead class="thead-dark" style="font-size: 20px">
                    <tr>
                        <th scope="col" style="width: 150px">ID</th>
                        <th scope="col" style="width: 250px">Branch</th>
                        <th scope="col" style="width: 300px">Cashier</th>
                        <th scope="col" style="width: 150px">Check No</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody style="font-size: 18px">
                    <?php include("../components/modular/history_staff.php"); ?>
                    <?php generateTableBody(!empty($_GET["page"]) ? $_GET["page"] : 1)?>
                </tbody>
            </table>
        </div>
        <nav aria-label="Page navigation">
            <ul class="pagination">
                <?php generatePagination(!empty($_GET["page"]) ? $_GET["page"] : 1) ?>
            </ul>
        </nav>
    </div>
</body>

</html>