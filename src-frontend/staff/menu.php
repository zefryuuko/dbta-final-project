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

    <div class="bodyLeft" style="float:left;">
        <nav class="navbar navbar-light" style="width: 650px; float: left; padding: 10px; margin-left: 45px; margin-top:20px; margin-bottom: 16px;">
            <a class="navbar-brand" style="font-size:25px; font-weight: bold;">Items</a>
            <form class="form-inline" style="margin-top: 10px;">
                <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" />
                <button class="btn btn-light btn-outline-dark my-2 my-sm-0" type="submit">
                    Search
                </button>
            </form>
        </nav>

        <div class="table-responsive">
            <table class="table" style="width: 800px; float: left; margin-left: 55px;">
                <thead class="thead-dark" style="font-size: 20px">
                    <tr>
                        <th scope="col" style="width: 150px">Item ID</th>
                        <th scope="col" style="width: 150px">Item</th>
                        <th scope="col" style="width: 150px">Size</th>
                        <th scope="col" style="width: 250px;">Price</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody style="font-size: 18px">
                    <tr>
                        <th scope="row">1</th>
                        <td>Mark</td>
                        <td>Mark</td>
                        <td>Rp xxx.xxx.xxx</td>
                        <td>
                            <a href="#"><img src="/resources/bin.png" style="width: 45%" />
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">2</th>
                        <td>Jacob</td>
                        <td>Mark</td>
                        <td>Rp xxx.xxx.xxx</td>
                        <td>
                            <a href="#"><img src="/resources/bin.png" style="width: 45%" />
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">3</th>
                        <td>Larry</td>
                        <td>Mark</td>
                        <td>Rp xxx.xxx.xxx</td>
                        <td>
                            <a href="#"><img src="/resources/bin.png" style="width: 45%" />
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row">4</th>
                        <td>Mark</td>
                        <td>Mark</td>
                        <td>Rp xxx.xxx.xxx</td>
                        <td>
                            <a href="#"><img src="/resources/bin.png" style="width: 45%" />
                            </a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <div class="bodyRight" style="float: right;">
        <div class="box" style="width: 400px;
            height: 450px;
            padding: 40px;
            margin: -380px 150px auto auto;
            border-radius: 5px;
            text-align: center;
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
            <p style="font-size:25px; padding: 10px; font-weight: bold; margin-top:10px;">
                Add Item
            </p>
            <input class="form-control" type="text" placeholder="Item Name" style="padding: 10px;" />
            <br />
            <input class="form-control" type="text" placeholder="Price" style="padding: 10px;" />
            <br />
            <select class="form-control">
                <option>Category</option>
            </select>

            <br /><br />
            <button type="submit" style="width: 100%; background-color: #242625; border-color:#242625; font-weight: bold; padding: 10px;" class="btn btn-primary">
                Add Item
            </button>
        </div>
    </div>
</body>

</html>