<?php
include_once("../backend/item.php");

function generateTableBody($currentPage = 1)
{
    $items = getItems($currentPage);
    foreach ($items as $item)
    {
        echo "<tr><td>".$item["item_id"]."</td><td>".$item["item_name"]."</td><td>".$item["item_size"]."</td><td>".$item["item_price"]."</td><td><a data-target=\"#deleteModal".$item["item_id"]."\" data-toggle=\"modal\" href=\"#deleteModal".$item["item_id"]."\"><img src=\"/resources/cross.svg\" style=\"width: 45%\"></a></td><td><a data-target=\"#editModal".$item["item_id"]."\" data-toggle=\"modal\" href=\"#editModal".$item["item_id"]."\"><img src=\"/resources/edit.svg\" style=\"width: 45%\"></a></td>";
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
        echo "<li class='page-item'><a class='page-link' href='"."/staff/menu.php?page=".($currentPage - 1)."' tabindex='-1'>Back</a></li>";
    }
    echo "<li class=\"page-item active\"><span class=\"page-link\">Page ".$currentPage."</span></li>";
    if (count(getItems($currentPage + 1)) == 0)
    {
        echo "<li class='page-item disabled'><a class='page-link' href='#' tabindex='-1'>Next</a></li>";
    }
    else
    {
        echo "<li class='page-item'><a class='page-link' href='"."/staff/menu.php?page=".($currentPage + 1)."' tabindex='-1'>Next</a></li>";
    }
}

function generateTableBodyByName($name, $currentPage = 1)
{
    $items = getItemsByName($name);
    foreach ($items as $item)
    {
        echo "<tr><td>".$item["item_id"]."</td><td>".$item["item_name"]."</td><td>".$item["item_size"]."</td><td>".$item["item_price"]."</td><td><a data-target=\"#deleteModal".$item["item_id"]."\" data-toggle=\"modal\" href=\"#deleteModal".$item["item_id"]."\"><img src=\"/resources/cross.svg\" style=\"width: 45%\"></a></td><td><a data-target=\"#editModal".$item["item_id"]."\" data-toggle=\"modal\" href=\"#editModal".$item["item_id"]."\"><img src=\"/resources/edit.svg\" style=\"width: 45%\"></a></td>";
    }
}


function generateModals($currentPage = 1)
{
    $items = getItems($currentPage);
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