<?php
include_once("../backend/staff.php");

function generateTableBody($currentPage = 1)
{
    $staffs = getStaffs($currentPage);
    foreach ($staffs as $staff)
    {
        echo "<tr><td>".$staff["staff_id"]."</td><td>".$staff["staff_name"]."</td><td>".($staff["staff_level"] == 0 ? "Admin" : "Cashier")."</td><td><a data-target=\"#deleteModal".$staff["staff_id"]."\" data-toggle=\"modal\" href=\"#deleteModal".$staff["staff_id"]."\"><img src=\"/resources/cross.svg\" style=\"width: 45%\"></a></td><td><a data-target=\"#editModal".$staff["staff_id"]."\" data-toggle=\"modal\" href=\"#editModal".$staff["staff_id"]."\"><img src=\"/resources/edit.svg\" style=\"width: 45%\"></a></td>";
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
        echo "<li class='page-item'><a class='page-link' href='"."/staff/staffs.php?page=".($currentPage - 1)."' tabindex='-1'>Back</a></li>";
    }
    echo "<li class=\"page-item active\"><span class=\"page-link\">Page ".$currentPage."</span></li>";
    if (count(getStaffs($currentPage + 1)) == 0)
    {
        echo "<li class='page-item disabled'><a class='page-link' href='#' tabindex='-1'>Next</a></li>";
    }
    else
    {
        echo "<li class='page-item'><a class='page-link' href='"."/staff/staffs.php?page=".($currentPage + 1)."' tabindex='-1'>Next</a></li>";
    }
}

function generateTableBodyByName($name, $currentPage = 1)
{
    $staffs = getStaffsByName($name);
    foreach ($staffs as $staff)
    {
        echo "<tr><td>".$staff["staff_id"]."</td><td>".$staff["staff_name"]."</td><td>".($staff["staff_level"] == 0 ? "Admin" : "Cashier")."</td><td><a data-target=\"#deleteModal".$staff["staff_id"]."\" data-toggle=\"modal\" href=\"#deleteModal".$staff["staff_id"]."\"><img src=\"/resources/cross.svg\" style=\"width: 45%\"></a></td><td><a data-target=\"#editModal".$staff["staff_id"]."\" data-toggle=\"modal\" href=\"#editModal".$staff["staff_id"]."\"><img src=\"/resources/edit.svg\" style=\"width: 45%\"></a></td>";
    }
}


function generateModals($currentPage = 1)
{
    $staffs = getStaffs($currentPage);
    foreach ($staffs as $staff)
    {
        // Edit Modal
        echo "<div
        class=\"modal fade\"
        id=\"editModal".$staff["staff_id"]."\"
        tabindex=\"-1\"
        role=\"dialog\"
        aria-labelledby=\"exampleModalLabel\"
        aria-hidden=\"true\"
      >
        <div class=\"modal-dialog\" role=\"document\">
          <div class=\"modal-content\">
            <div class=\"modal-header\">
              <h5 class=\"modal-title\" id=\"exampleModalLabel\">Edit Staff</h5>
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
              <form action=\"/staff/staffs.php\" method=\"POST\">
                <input type=\"hidden\" class=\"form-control\" name=\"staff_id\" value=\"".$staff["staff_id"]."\"/>
                <div class=\"form-group\">
                  <label for=\"branch-name\" class=\"col-form-label\"
                    >Staff Name</label
                  >
                  <input type=\"text\" class=\"form-control\" name=\"staff_name\" value=\"".$staff["staff_name"]."\"/>
                </div>
                <label for=\"branch-name\" class=\"col-form-label\"
                    >Password</label
                  >
                  <input type=\"text\" class=\"form-control\" name=\"staff_password\" value=\"\" placeholder=\"Leave blank to leave it unchanged\"/>
                </div>
                <div class=\"form-group\">
                <label for=\"message-text\" class=\"col-form-label\"
                  >Staff Level</label
                >
                <select class=\"form-control\" name=\"staff_level\">
                    <option value=\"0\" ".($staff["staff_level"] == "0" ? "selected=\"\"" : "" ).">Admin</option>
                    <option value=\"1\" ".($staff["staff_level"] == "1" ? "selected=\"\"" : "" ).">Cashier</option>
                </select>
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
        id=\"deleteModal".$staff["staff_id"]."\"
        tabindex=\"-1\"
        role=\"dialog\"
        aria-labelledby=\"exampleModalLabel\"
        aria-hidden=\"true\"
      >
        <div class=\"modal-dialog\" role=\"document\">
          <div class=\"modal-content\">
            <div class=\"modal-header\">
              <h5 class=\"modal-title\" id=\"exampleModalLabel\">Delete Staff</h5>
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
              <form action=\"/staff/staffs.php\" method=\"GET\">
                <input type=\"hidden\" class=\"form-control\" name=\"delete\" value=\"yes\"/>
                <input type=\"hidden\" class=\"form-control\" name=\"item_id\" value=\"".$staff["staff_id"]."\"/>
                <div class=\"form-group\">
                  <label for=\"branch-name\" class=\"col-form-label\"
                    >Are you sure you want to delete ".$staff["staff_name"]." - ".($staff["staff_level"] == 0 ? "Admin" : "Cashier")."</label
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
    $items = getItemsByName($name);
    foreach ($items as $item)
    {
        // Edit Modal
        echo "<div
        class=\"modal fade\"
        id=\"editModal".$item["item_id"]."\"
        tabindex=\"-1\"
        role=\"dialog\"
        aria-labelledby=\"exampleModalLabel\"
        aria-hidden=\"true\"
      >
        <div class=\"modal-dialog\" role=\"document\">
          <div class=\"modal-content\">
            <div class=\"modal-header\">
              <h5 class=\"modal-title\" id=\"exampleModalLabel\">Edit Item</h5>
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
              <form action=\"/staff/menu.php\" method=\"POST\">
                <input type=\"hidden\" class=\"form-control\" name=\"item_id\" value=\"".$item["item_id"]."\"/>
                <div class=\"form-group\">
                  <label for=\"branch-name\" class=\"col-form-label\"
                    >Item Name</label
                  >
                  <input type=\"text\" class=\"form-control\" name=\"item_name\" value=\"".$item["item_name"]."\"/>
                </div>
                <div class=\"form-group\">
                  <label for=\"message-text\" class=\"col-form-label\"
                    >Item Price</label
                  >
                  <input type=\"number\" class=\"form-control\" name=\"item_price\" value=\"".$item["item_price"]."\"/>
                </div>
                <div class=\"form-group\">
                <label for=\"message-text\" class=\"col-form-label\"
                  >Item Size</label
                >
                <select  class=\"form-control\" name=\"item_size\" value=\"".$item["item_size"]."\">
                    <option ".($item["item_size"] == "Tall" ? "selected=\"\"" : "" ).">Tall</option>
                    <option ".($item["item_size"] == "Grande" ? "selected=\"\"" : "" ).">Grande</option>
                    <option ".($item["item_size"] == "Venti" ? "selected=\"\"" : "" ).">Venti</option>
                </select>
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
        id=\"deleteModal".$item["item_id"]."\"
        tabindex=\"-1\"
        role=\"dialog\"
        aria-labelledby=\"exampleModalLabel\"
        aria-hidden=\"true\"
      >
        <div class=\"modal-dialog\" role=\"document\">
          <div class=\"modal-content\">
            <div class=\"modal-header\">
              <h5 class=\"modal-title\" id=\"exampleModalLabel\">Delete Item</h5>
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
              <form action=\"/staff/menu.php\" method=\"GET\">
                <input type=\"hidden\" class=\"form-control\" name=\"delete\" value=\"yes\"/>
                <input type=\"hidden\" class=\"form-control\" name=\"item_id\" value=\"".$item["item_id"]."\"/>
                <div class=\"form-group\">
                  <label for=\"branch-name\" class=\"col-form-label\"
                    >Are you sure you want to delete ".$item["item_name"]." - ".$item["item_size"]."</label
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