<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <link href="/resources/logo.png" rel="shortcut icon" />
    <title>Dashboard</title>
    <?php include ("../components/bootstrap.php");?></script>
    <?php 
      $pageLevel = 0;
      include("auth.php");
    ?>
</head>

<body onload="auth()">
    <div class="container">
      <?php include ("../components/navbar/navbar_staff.php");?>
      <div class="bodyLeft" >
        <nav
          class="navbar navbar-light"
          style="width: 650px;padding: 10px; margin-left: 45px; margin-top:20px; margin-bottom: 16px;"
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
            style=""
          >
            <thead class="thead-dark" style="font-size: 20px">
              <tr>
                <th scope="col" style="width: 200px">Card Number</th>
                <th scope="col" style="width: 300px">Name</th>
                <th scope="col" style="width: 200px">Balance</th>
                <th scope="col" style="width: 10px"></th>
                <th scope="col" style="width: 10px"></th>
              </tr>
            </thead>
            <tbody style="font-size: 18px">
            <?php include ("../components/modular/membership_staff.php");?>
            <?php include ("../components/modular/membership_staff.php");?>
            <?php include ("../components/modular/membership_staff.php");?>
          </tbody>
          </table>
        </div>
      </div>

      <div
        class="bodyRight"
        style="margin-top: 30px;"
      >
        <div
          class="box"
          style="width: 400px;
                height: 450px;
                padding: 40px;
                margin-top: 20px;
                border-radius: 5px;
                text-align: center;
                box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);"
        >
          <p
            style="font-size:25px; padding: 10px; font-weight: bold; margin-top:10px;"
          >
            Add Member
          </p>
          <input
            class="form-control"
            type="text"
            placeholder="Card Holder Name"
            style="padding: 10px;"
          />
          <br />
          <input
            class="form-control"
            type="text"
            placeholder="Starting Balance"
            style="padding: 10px;"
          />
          <br />

          <br /><br /><br />
          <button
            type="submit"
            style="width: 100%; background-color: #242625; border-color:#242625; font-weight: bold; padding: 10px;"
            class="btn btn-primary"
          >
            Add Member
          </button>
        </div>
      </div>
    </div>
  </body>
</html>
