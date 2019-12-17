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
        Staff Details
    </p>
    <div class="table-responsive">
        <table class="table" style="width: 1200px; margin:  40px auto;">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">Staff ID</th>
                    <th scope="col">Name</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Mark</td>
                    <td>Otto</td>
                </tr>
                <tr>
                    <td>Jacob</td>
                    <td>Thornton</td>
                </tr>
                <tr>
                    <td>Larry</td>
                    <td>the Bird</td>
                </tr>
            </tbody>
        </table>
    </div>
</body>

</html>