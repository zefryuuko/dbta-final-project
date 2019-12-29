<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <link href="/resources/logo.png" rel="shortcut icon" />
    <title>Dashboard</title>
    <?php include ("../components/bootstrap.php");?>
  </head>

  <body>
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
      <div
        class="modal fade"
        id="exampleModal"
        tabindex="-1"
        role="dialog"
        aria-labelledby="exampleModalLabel"
        aria-hidden="true"
      >
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <button
                type="button"
                class="close"
                data-dismiss="modal"
                aria-label="Close"
              >
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <h3
                class="modal-title"
                id="exampleModalLabel"
                style="text-align: center; color: #ff0000"
              >
                Are you sure?
              </h3>
              <img
                src="../resources/cross.svg"
                style="width: 20%;
              padding: 5px;
              margin: auto 0 auto 185px;
              display: block"
              />
              <p style="width: 80%; text-align: center; margin: auto;">
                Are you sure you want to delete this record? This process can
                not be undone.
              </p>
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
                Delete
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>
