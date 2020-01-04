<?php
include_once("../backend/branch.php");

function generateTableBody($currentPage = 1)
{
    $branches = getBranches($currentPage);
    foreach ($branches as $branch)
    {
        echo "<tr><td>".$branch["branch_id"]."</td><td>".$branch["branch_name"]."</td><td>".$branch["branch_phone"]."</td><td><a data-target=\"#deleteModal".$branch["branch_id"]."\" data-toggle=\"modal\" href=\"#deleteModal".$branch["branch_id"]."\"><img src=\"/resources/cross.svg\" style=\"width: 45%\"></a></td><td><a data-target=\"#editModal".$branch["branch_id"]."\" data-toggle=\"modal\" href=\"#editModal".$branch["branch_id"]."\"><img src=\"/resources/edit.svg\" style=\"width: 45%\"></a></td>";
    }
}

function generatePagination($currentPage = 1)
{
    global $showCount;
    if ($currentPage == 1)
    {
        echo "<li class='page-item disabled'><a class='page-link' href='#' tabindex='-1'>Back</a></li>";
    }
    else
    {
        echo "<li class='page-item'><a class='page-link' href='"."/staff/branch.php?page=".($currentPage - 1)."' tabindex='-1'>Back</a></li>";
    }
    echo "<li class=\"page-item active\"><span class=\"page-link\">Page ".$currentPage."</span></li>";
    if (count(getBranches($currentPage + 1)) == 0)
    {
        echo "<li class='page-item disabled'><a class='page-link' href='#' tabindex='-1'>Next</a></li>";
    }
    else
    {
        echo "<li class='page-item'><a class='page-link' href='"."/staff/branch.php?page=".($currentPage + 1)."' tabindex='-1'>Next</a></li>";
    }
}

function generateTableBodyByName($name, $currentPage = 1)
{
    $branches = getBranchesByName($name, $currentPage);
    foreach ($branches as $branch)
    {
        echo "<tr><td>".$branch["branch_id"]."</td><td>".$branch["branch_name"]."</td><td>".$branch["branch_phone"]."</td><td><a data-target=\"#deleteModal".$branch["branch_id"]."\" data-toggle=\"modal\" href=\"#deleteModal".$branch["branch_id"]."\"><img src=\"/resources/cross.svg\" style=\"width: 45%\"></a></td><td><a data-target=\"#editModal".$branch["branch_id"]."\" data-toggle=\"modal\" href=\"#editModal".$branch["branch_id"]."\"><img src=\"/resources/edit.svg\" style=\"width: 45%\"></a></td>";
    }
}


function generateModals($currentPage = 1)
{
    $branches = getBranches($currentPage);
    foreach ($branches as $branch)
    {
        // Edit Modal
        echo "<div
        class=\"modal fade\"
        id=\"editModal".$branch["branch_id"]."\"
        tabindex=\"-1\"
        role=\"dialog\"
        aria-labelledby=\"exampleModalLabel\"
        aria-hidden=\"true\"
      >
        <div class=\"modal-dialog\" role=\"document\">
          <div class=\"modal-content\">
            <div class=\"modal-header\">
              <h5 class=\"modal-title\" id=\"exampleModalLabel\">Edit Branch</h5>
              <button
                type=\"button\"
                class=\"close\"
                data-dismiss=\"modal\"
                aria-label=\"Close\"
              >
                <span aria-hidden=\"true\">&times;</span>
              </button>
            </div>
            <div class=\"modal-body\">
              <form action=\"/staff/branch.php\" method=\"POST\">
                <input type=\"hidden\" class=\"form-control\" name=\"branch_id\" value=\"".$branch["branch_id"]."\"/>
                <div class=\"form-group\">
                  <label for=\"branch-name\" class=\"col-form-label\"
                    >Branch Name</label
                  >
                  <input type=\"text\" class=\"form-control\" name=\"branch_name\" value=\"".$branch["branch_name"]."\"/>
                </div>
                <div class=\"form-group\">
                  <label for=\"message-text\" class=\"col-form-label\"
                    >Phone</label
                  >
                  <input type=\"text\" class=\"form-control\" name=\"branch_phone\" value=\"".$branch["branch_phone"]."\"/>
                </div>
                <div class=\"modal-footer\">
                  <button
                    type=\"button\"
                    class=\"btn btn-secondary\"
                    data-dismiss=\"modal\"
                  >
                    Close
                  </button>
                  <button type=\"submit\" class=\"btn btn-primary\">
                    Save changes
                  </button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>";
    
      // Delete Modal
      echo "<div
        class=\"modal fade\"
        id=\"deleteModal".$branch["branch_id"]."\"
        tabindex=\"-1\"
        role=\"dialog\"
        aria-labelledby=\"exampleModalLabel\"
        aria-hidden=\"true\"
      >
        <div class=\"modal-dialog\" role=\"document\">
          <div class=\"modal-content\">
            <div class=\"modal-header\">
              <h5 class=\"modal-title\" id=\"exampleModalLabel\">Delete Branch</h5>
              <button
                type=\"button\"
                class=\"close\"
                data-dismiss=\"modal\"
                aria-label=\"Close\"
              >
                <span aria-hidden=\"true\">&times;</span>
              </button>
            </div>
            <div class=\"modal-body\">
              <form action=\"/staff/branch.php\" method=\"GET\">
                <input type=\"hidden\" class=\"form-control\" name=\"delete\" value=\"yes\"/>
                <input type=\"hidden\" class=\"form-control\" name=\"branch_id\" value=\"".$branch["branch_id"]."\"/>
                <div class=\"form-group\">
                  <label for=\"branch-name\" class=\"col-form-label\"
                    >Are you sure you want to delete ".$branch["branch_name"]."</label
                  >
                </div>
                <div class=\"modal-footer\">
                  <button
                    type=\"button\"
                    class=\"btn btn-secondary\"
                    data-dismiss=\"modal\"
                  >
                    Cancel
                  </button>
                  <button type=\"submit\" class=\"btn btn-danger\">
                    Delete
                  </button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>";
    }
}


function generateModalsByName($name)
{
    $branches = getBranchesByName($name, 1);
    foreach ($branches as $branch)
    {
        echo "<div
        class=\"modal fade\"
        id=\"editModal".$branch["branch_id"]."\"
        tabindex=\"-1\"
        role=\"dialog\"
        aria-labelledby=\"exampleModalLabel\"
        aria-hidden=\"true\"
      >
        <div class=\"modal-dialog\" role=\"document\">
          <div class=\"modal-content\">
            <div class=\"modal-header\">
              <h5 class=\"modal-title\" id=\"exampleModalLabel\">Edit Branch</h5>
              <button
                type=\"button\"
                class=\"close\"
                data-dismiss=\"modal\"
                aria-label=\"Close\"
              >
                <span aria-hidden=\"true\">&times;</span>
              </button>
            </div>
            <div class=\"modal-body\">
              <form action=\"/staff/branch.php\" method=\"POST\">
                <input type=\"hidden\" class=\"form-control\" name=\"branch_id\" value=\"".$branch["branch_id"]."\"/>
                <div class=\"form-group\">
                  <label for=\"branch-name\" class=\"col-form-label\"
                    >Branch Name</label
                  >
                  <input type=\"text\" class=\"form-control\" name=\"branch_name\" value=\"".$branch["branch_name"]."\"/>
                </div>
                <div class=\"form-group\">
                  <label for=\"message-text\" class=\"col-form-label\"
                    >Phone</label
                  >
                  <input type=\"text\" class=\"form-control\" name=\"card_balance\" value=\"".$branch["branch_phone"]."\"/>
                </div>
                <div class=\"modal-footer\">
                  <button
                    type=\"button\"
                    class=\"btn btn-secondary\"
                    data-dismiss=\"modal\"
                  >
                    Close
                  </button>
                  <button type=\"submit\" class=\"btn btn-primary\">
                    Save changes
                  </button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>";

      // Delete Modal
      echo "<div
        class=\"modal fade\"
        id=\"deleteModal".$branch["branch_id"]."\"
        tabindex=\"-1\"
        role=\"dialog\"
        aria-labelledby=\"exampleModalLabel\"
        aria-hidden=\"true\"
      >
        <div class=\"modal-dialog\" role=\"document\">
          <div class=\"modal-content\">
            <div class=\"modal-header\">
              <h5 class=\"modal-title\" id=\"exampleModalLabel\">Delete Branch</h5>
              <button
                type=\"button\"
                class=\"close\"
                data-dismiss=\"modal\"
                aria-label=\"Close\"
              >
                <span aria-hidden=\"true\">&times;</span>
              </button>
            </div>
            <div class=\"modal-body\">
              <form action=\"/staff/branch.php\" method=\"GET\">
                <input type=\"hidden\" class=\"form-control\" name=\"delete\" value=\"yes\"/>
                <input type=\"hidden\" class=\"form-control\" name=\"branch_id\" value=\"".$branch["branch_id"]."\"/>
                <div class=\"form-group\">
                  <label for=\"branch-name\" class=\"col-form-label\"
                    >Are you sure you want to delete ".$branch["branch_name"]."</label
                  >
                </div>
                <div class=\"modal-footer\">
                  <button
                    type=\"button\"
                    class=\"btn btn-secondary\"
                    data-dismiss=\"modal\"
                  >
                    Cancel
                  </button>
                  <button type=\"submit\" class=\"btn btn-danger\">
                    Delete
                  </button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>";
    }
}



?>