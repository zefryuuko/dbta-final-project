<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <link href="/resources/logo.png" rel="shortcut icon" />
    <title>Dashboard</title>
    <?php include "../components/bootstrap.php";?>
    <?php 
      $pageLevel=0;
      include("auth.php");
      include("../backend/staff.php");
      $staffName = getStaffByID($_COOKIE["id"])[0]["staff_name"];
    ?>
  </head>

  <body onload="auth()">
      <?php include "../components/navbar/navbar_welcome.php";?>
    <div class="container">

      <div class="card-deck" style="width: 100%; margin: 50px auto auto auto;">
        <div class="card border-dark mb-3">
          <img
            src="/resources/history.svg"
            class="card-img-top"
            style="width:100%;
            margin: auto;
            padding:10px;"
          />
          <div class="footer">
            <div class="card-body">
              <p
                class="card-text"
                style="margin-top: 45px; text-align: center;"
              >
                Click here to view transaction history.
              </p>
              <a
                href="/staff/history.php"
                class="btn btn-primary"
                style="width: 100%; background-color: #006335; border-color: #006335 ; font-weight: bold;"
                >History</a
              >
            </div>
          </div>
        </div>
        
        <div class="card border-dark mb-3">
          <img
            src="/resources/staff.svg"
            class="card-img-top"
            style="width:100%; margin: auto; padding:10px;"
          />
          <div class="footer">
            <div class="card-body">
              <p
                class="card-text"
                style="margin-top: 22px; text-align: center;"
              >
                Click here to see staff details.
              </p>
              <a
                href="/staff/staffs.php"
                class="btn btn-primary"
                style="width: 100%; background-color: #006335; border-color: #006335 ; font-weight: bold;"
                >Staff</a
              >
            </div>
          </div>
        </div>
        <div class="card border-dark mb-3">
          <img
            src="/resources/menu.svg"
            class="card-img-top"
            style="width:100%; margin: auto; padding:10px;"
          />
          <div class="footer">
            <div class="card-body">
              <p
                class="card-text"
                style="margin-top: 32px; text-align: center;"
              >
                Click here to see & add item to menu.
              </p>
              <a
                href="/staff/menu.php"
                class="btn btn-primary"
                style="width: 100%; background-color: #006335; border-color: #006335 ; font-weight: bold;"
                >Menu</a
              >
            </div>
          </div>
        </div>
        <div class="card border-dark mb-3">
          <img
            src="/resources/discount.svg"
            class="card-img-top"
            style="width:100%; margin: auto; padding: 10px;"
          />
          <div class="footer">
            <div class="card-body">
              <p
                class="card-text"
                style="text-align: center; margin-top: 45px;"
              >
                Click here to see and edit discounts.
              </p>
              <a
                href="/staff/discounts.php"
                class="btn btn-primary"
                style="width: 100%; background-color: #006335; border-color: #006335 ; font-weight: bold;"
                >Discounts</a
              >
            </div>
          </div>
        </div>
        <div class="card border-dark mb-3">
          <img
            src="/resources/branch.svg"
            class="card-img-top"
            style="width:100%; padding:10px; margin: auto;"
          />
          <div class="footer">
            <div class="card-body">
              <p
                class="card-text"
                style="margin-top: 32px; text-align: center;"
              >
                Click here to see & edit the branch.
              </p>
              <a
                href="/staff/branch.php"
                class="btn btn-primary"
                style="width: 100%; background-color: #006335; border-color: #006335 ; font-weight: bold;"
                >Branch</a
              >
            </div>
          </div>
        </div>
        <div class="card border-dark mb-3">
          <img
            src="/resources/membership.svg"
            class="card-img-top"
            style="width:100%; padding: 10px; margin: auto;"
          />
          <div class="footer">
            <div class="card-body">
              <p
                class="card-text"
                style="margin-top: 32px; text-align: center;"
              >
                Click here to see the membership card holders.
              </p>
              <a
                href="/staff/membership.php"
                class="btn btn-primary"
                style="width: 100%; background-color: #006335; border-color: #006335 ; font-weight: bold;"
                >Members</a
              >
            </div>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>
