<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <link href="/resources/logo.png" rel="shortcut icon" />
    <title>History - Dashboard</title>
    <?php include("../components/bootstrap.php"); ?>
    <?php 
      $pageLevel = 1;
      include("auth.php");
    ?>
</head>

<body onload="auth()">
        <?php include("../components/navbar/navbar_cashier.php"); ?>
    <div class="container">
        <nav class="navbar navbar-light" style=" ">
                <a class="navbar-brand" style="font-size:25px; font-weight: bold;">Transactions</a>
                <form class="form-inline" style="" action="/staff/staffs.php">
                    <input class="form-control mr-sm-2" type="search" name="name" placeholder="Search" aria-label="Search" />
                    <button class="btn btn-light btn-outline-dark my-2 my-sm-0" type="submit">
                        Search
                    </button>
                </form>
            </nav>
        <div class="table-responsive">
            <table class="table" style="">
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
                    <?php include("../components/modular/history_cashier.php"); ?>
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