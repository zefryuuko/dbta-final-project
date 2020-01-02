<?php include("../components/modular/staff_details.php"); ?>
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
    <div class="container">
    <?php include("../components/navbar/navbar_staff.php"); ?>
        <h2 style="margin:10pt 0 10pt 0;">Staff Details</h2>
        <div class="table-responsive">
            <table class="table">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Name</th>
                        <th scope="col">Role</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr><?php generateTableBody(!empty($_GET["page"]) ? $_GET["page"] : 1)?>
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