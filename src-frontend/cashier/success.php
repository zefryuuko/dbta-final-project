<!-- 
include("../backend/config.php");
incrementCheckNumber();
print_r($_POST); -->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <link href="/resources/logo.png" rel="shortcut icon" />
    <title>Success - Dashboard</title>
    <?php include("../components/bootstrap.php"); ?>
    <?php 
      $pageLevel = 1;
      include("auth.php");
      include("../backend/staff.php");
      include("../backend/config.php");
      $staffName = getStaffByID($_COOKIE["id"])[0]["staff_name"];
    ?>
    <script>
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                
            }
        }
        xhttp.open("POST", "http://localhost:8081/bill");
        xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        var details = JSON.parse(`<?php echo json_encode($_POST)?>`);
        details.task = "add";
        console.log(JSON.stringify(details));
        xhttp.send("data=" + JSON.stringify(details));
    </script>
    </head>

    <body onload="try{auth()}catch(e){}">
        <?php include("../components/navbar/navbar_cashier.php"); ?>
    <div class="container">

        <div class="bodyLeft" style="">
            <p style="font-size:25px;font-weight: bold;margin-top:20px;">
                Transaction Success
            </p>
            <h4>The transaction has been made successfully.</h4>
            <!--Order Table-->
        </div>
        <!--End of Left Body-->

            <!--Subtotal table-->

            <!-- <button type="button" class="btn btn-light btn-primary btn-lg btn-outline-dark" style="width: 42.8%; margin-top: -135px;">
                Pay Bill
            </button> -->
            
            <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#exampleModal" style="width: 49%;">
                Print Bill
            </button>
            
            <button type="button" class="btn btn-secondary btn-primary btn-lg" style="width: 50%;" onclick="window.location.href = '/cashier'">
                Close
            </button>
        </div>
    </div>
</html>