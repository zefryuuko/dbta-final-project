<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <link href="/resources/logo.png" rel="shortcut icon" />
    <title>Dashboard</title>
    <?php include "components/bootstrap.php";?>
  </head>

  <body>
    <div class="container">
      <?php include "components/navbar/navbar.php";?>
      <div class="card-deck" style="width:80%; margin: 50px auto auto auto;">
          <div class="card border-dark mb-3">
            <img
              src="/resources/staff.svg"
              class="card-img-top"
              style="width:100%; padding: 10px; margin: auto;"
            />
            <div class="footer">
              <div class="card-body">
                <p
                  class="card-text"
                  style="margin-top: 15px; text-align: center;"
                >
                Click here if you are a staff to access all the staff
                  features!
                </p>
                <a
                  href="/staff"
                  class="btn btn-primary"
                  style="width: 100%; background-color: #006335; border-color: #006335 ; font-weight: bold;"
                  >Staff</a
                >
              </div>
            </div>
          </div>
          <div class="card border-dark mb-3">
            <img
              src="/resources/cashier.svg"
              class="card-img-top"
              style="width:100%; padding: 10px; margin: auto;"
            />
            <div class="footer">
              <div class="card-body">
                <p class="card-text" style="text-align: center;">
                Click here if you are a cashier to access all the cashier
                  features!
                </p>
                <a
                  href="/cashier"
                  class="btn btn-primary"
                  style="width: 100%; background-color: #006335; border-color: #006335 ; font-weight: bold;"
                  >Cashier</a
                >
              </div>
            </div>
          </div>
        </div>
      <!--Card-->
    </div>
  </body>
</html>
