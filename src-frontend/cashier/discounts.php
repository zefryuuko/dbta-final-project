<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <link href="/resources/logo.png" rel="shortcut icon" />
    <title>Discount - Dashboard</title>
    <?php include ("../components/bootstrap.php");?>
    <?php 
      $pageLevel = 1;
      include("auth.php");
      include("../backend/staff.php");
      $staffName = getStaffByID($_COOKIE["id"])[0]["staff_name"];
    ?>
    </head>

    <body onload="try{auth()}catch(e){}">
    <div class="container">
      <!-- Button trigger modal -->
      <button
        type="button"
        class="btn btn-primary"
        data-toggle="modal"
        data-target="#exampleModal"
      >
        Launch demo modal
      </button>

      <!-- Modal -->
      <div class="modal fade" id="exampleModal" abindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <h3
                class="modal-title"
                id="exampleModalLabel"
                style="text-align: center;"
              >
                Add Discount
              </h3>
              <br>
              <div class="table-responsive">
                <table
                  class="table"
                style="width: 400px; float: left; margin-left: 40px;"
                >
                  <thead class="thead-dark" style="font-size: 20px">
                    <tr>
                      <th scope="col" style="width: 80px">ID</th>
                      <th scope="col" style="width: 100px">Name</th>
                      <th scope="col" style="width: 150px">Percentage</th>
                      <th scope="col"></th>
                    </tr>
                  </thead>
                  <tbody style="font-size: 18px">
                    <?php include("../components/modular/discounts.php"); ?>
                  </tbody>
                </table>
              </div>
            </div>
            <div class="modal-footer" style="margin: auto;">
              <button
                type="button"
                class="btn btn-secondary"
                data-dismiss="modal"
                style="width: 150px;"
              >
                Cancel
              </button>
              <button
                type="button"
                class="btn btn-danger"
                style="width: 150px;"
              >
                Done
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>
