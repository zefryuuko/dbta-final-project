<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <link href="/resources/logo.png" rel="shortcut icon" />
    <title>Dashboard</title>
    <?php include ("../components/bootstrap.php");?></script>
  </head>

  <body>
    <div class="container">
      <?php include ("../components/navbar/navbar_cashier.php");?>
      <div class="bodyLeft" style="float:left;">
        <nav
          class="navbar navbar-light"
          style="width: 650px; float: left; padding: 10px; margin-left: 45px; margin-top:20px; margin-bottom: 16px;"
        >
          <a class="navbar-brand" style="font-size:25px; font-weight: bold;"
            >Membership</a
          >
          <form
            class="form-inline"
            style="margin-top: 10px; margin-right: 80px;"
          >
            <input
              class="form-control mr-sm-2"
              type="search"
              placeholder="Search"
              aria-label="Search"
            />
            <button
              class="btn btn-light btn-outline-dark my-2 my-sm-0"
              type="submit"
            >
              Search
            </button>
          </form>
        </nav>

        <div class="table-responsive">
          <table
            class="table"
            style="width: 550px; float: left; margin-left: 55px;"
          >
            <thead class="thead-dark" style="font-size: 20px">
              <tr>
                <th scope="col" style="width: 70px">Number</th>
                <th scope="col" style="width: 200px">Name</th>
                <th scope="col" style="width: 120px">Balance</th>
                <th scope="col"></th>
                <th scope="col"></th>
              </tr>
            </thead>
            <tbody style="font-size: 18px">
            <?php include ("../components/modular/membership_cashier.php");?>
            <?php include ("../components/modular/membership_cashier.php");?>
            <?php include ("../components/modular/membership_cashier.php");?>
          </tbody>
          </table>
        </div>
      </div>
    </div>
  </body>
</html>
