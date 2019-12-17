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
    <?php include("../components/navbar/navbar_staff.php"); ?>

    <div class="bodyLeft" style="float:left;">
        <p style="font-size:25px; padding: 10px; font-weight: bold; margin-left: 45px; margin-top:20px;">
            Current Transaction
        </p>
        <div class="table-responsive">
            <table class="table" style="width: 650px; float: left; margin-left: 55px;">
                <thead class="thead-dark" style="font-size: 20px">
                    <tr>
                        <th scope="col" style="width: 50px">#</th>
                        <th scope="col" style="width: 150px">Item</th>
                        <th scope="col" style="width: 50px">Quantity</th>
                        <th scope="col" style="width: 90px">Size</th>
                        <th scope="col" style="width: 150px">Price</th>
                        <th scope="col"></th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody style="font-size: 18px">
                    <tr>
                        <th scope="row">1</th>
                        <td>Mark</td>
                        <td>Mark</td>
                        <td>xx</td>
                        <td>Rp xxx.xxx.xxx</td>
                        <td>
                            <a href="#"><img src="/resources/cross.png" style="width: 33%" /></a>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">2</th>
                        <td>Jacob</td>
                        <td>Mark</td>
                        <td>xx</td>
                        <td>Rp xxx.xxx.xxx</td>
                        <td>
                            <a href="#"><img src="/resources/cross.png" style="width: 33%" /></a>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">3</th>
                        <td>Larry</td>
                        <td>Mark</td>
                        <td>xx</td>
                        <td>Rp xxx.xxx.xxx</td>
                        <td>
                            <a href="#"><img src="/resources/cross.png" style="width: 33%" /></a>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">4</th>
                        <td>Mark</td>
                        <td>Mark</td>
                        <td>xx</td>
                        <td>Rp xxx.xxx.xxx</td>
                        <td>
                            <a href="#"><img src="/resources/cross.png" style="width: 33%" /></a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <!--Order Table-->

        <br /><br />

        <div class="table-responsive">
            <table class="table" style="width: 650px; float: left; margin-left: 55px;">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col" style="width: 340px; font-size: 25px; font-weight: bold;">
                            Sub Total:
                        </th>
                        <th scope="col" style=" font-size: 25px; font-weight: bold;">
                            Rp xxx.xxx.xxx
                        </th>
                        <th scope="col"></th>
                    </tr>
                </thead>
            </table>
        </div>
        <!--Subtotal table-->

        <button type="button" class="btn btn-light btn-primary btn-lg btn-outline-dark" style="margin-left: 55px; width: 60%">
            Close Order
        </button>

        <button type="button" class="btn btn-danger btn-primary btn-lg" style="margin-left: 30px; width: 27.2%">
            Cancel Order
        </button>
    </div>
    <!--End of Left Body-->

    <div class="bodyRight" style="float:right;">
        <nav class="navbar navbar-light" style="font-size:25px; padding: 10px; font-weight: bold; margin-top:20px; margin-right: 400px;">
            <a class="navbar-brand">Items</a>
            <form class="form-inline" style="margin-top: 10px;">
                <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" />
                <button class="btn btn-light btn-outline-dark my-2 my-sm-0" type="submit">
                    Search
                </button>
            </form>
        </nav>

        <div class="table-responsive">
            <table class="table" style="width: 650px; float: left; margin-top: 5px;">
                <thead class="thead-dark" style="font-size: 20px">
                    <tr>
                        <th scope="col" style="width: 150px">Item ID</th>
                        <th scope="col" style="width: 150px">Item</th>
                        <th scope="col" style="width: 250px">Price</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody style="font-size: 18px">
                    <tr>
                        <th scope="row">1</th>
                        <td>Mark</td>
                        <td>Rp xxx.xxx.xxx</td>
                        <td>
                            <a href="#"><img src="/resources/plus.png" style="width: 33%" />
                                <img src="/resources/minus.png" style="width: 38.8%; padding-left: 4px;" /></a>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">2</th>
                        <td>Jacob</td>
                        <td>Rp xxx.xxx.xxx</td>
                        <td>
                            <a href="#"><img src="/resources/plus.png" style="width: 33%" />
                                <img src="/resources/minus.png" style="width: 38.8%; padding-left: 4px;" /></a>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">3</th>
                        <td>Larry</td>
                        <td>Rp xxx.xxx.xxx</td>
                        <td>
                            <a href="#"><img src="/resources/plus.png" style="width: 33%" />
                                <img src="/resources/minus.png" style="width: 38.8%; padding-left: 4px;" /></a>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">4</th>
                        <td>Mark</td>
                        <td>Rp xxx.xxx.xxx</td>
                        <td>
                            <a href="#"><img src="/resources/plus.png" style="width: 33%" />
                                <img src="/resources/minus.png" style="width: 38.8%; padding-left: 4px;" /></a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <!--End of Right Body-->
</body>

</html>