<?php
include_once("../backend/card.php");

function generateTableBody($currentPage = 1)
{
    $cards = getCards($currentPage);
    foreach ($cards as $card)
    {
        echo "<tr><td>".$card["card_number"]."</td><td>".$card["cardholder_name"]."</td><td>".$card["card_balance"]."</td><td><a data-target=\"#deleteModal".$card["card_number"]."\" data-toggle=\"modal\" href=\"#deleteModal".$card["card_number"]."\"><img src=\"/resources/cross.svg\" style=\"width: 45%\"></a></td><td><a data-target=\"#editModal".$card["card_number"]."\" data-toggle=\"modal\" href=\"#editModal".$card["card_number"]."\"><img src=\"/resources/edit.svg\" style=\"width: 45%\"></a></td>";
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
        echo "<li class='page-item'><a class='page-link' href='"."/staff/membership.php?page=".($currentPage - 1)."' tabindex='-1'>Back</a></li>";
    }
    echo "<li class=\"page-item active\"><span class=\"page-link\">Page ".$currentPage."</span></li>";
    if (count(getCards($currentPage + 1)) == 0)
    {
        echo "<li class='page-item disabled'><a class='page-link' href='#' tabindex='-1'>Next</a></li>";
    }
    else
    {
        echo "<li class='page-item'><a class='page-link' href='"."/staff/membership.php?page=".($currentPage + 1)."' tabindex='-1'>Next</a></li>";
    }
}

function generateTableBodyByName($name, $currentPage = 1)
{
    $cards = getCardsByName($name, $currentPage);
    foreach ($cards as $card)
    {
        echo "<tr><td>".$card["card_number"]."</td><td>".$card["cardholder_name"]."</td><td>".$card["card_balance"]."</td><td><a href=\"#\"><img src=\"/resources/cross.svg\" style=\"width: 45%\"></a></td><td><a data-target=\"#editModal".$card["card_number"]."\" data-toggle=\"modal\" href=\"#editModal".$card["card_number"]."\"><img src=\"/resources/edit.svg\" style=\"width: 45%\"></a></td>";
    }
}


function generateModals($currentPage = 1)
{
    $cards = getCards($currentPage);
    foreach ($cards as $card)
    {
        // Edit Modal
        echo "<div
        class=\"modal fade\"
        id=\"editModal".$card["card_number"]."\"
        tabindex=\"-1\"
        role=\"dialog\"
        aria-labelledby=\"exampleModalLabel\"
        aria-hidden=\"true\"
      >
        <div class=\"modal-dialog\" role=\"document\">
          <div class=\"modal-content\">
            <div class=\"modal-header\">
              <h5 class=\"modal-title\" id=\"exampleModalLabel\">Edit Membership</h5>
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
              <form action=\"/staff/membership.php\" method=\"POST\">
                <input type=\"hidden\" class=\"form-control\" name=\"card_number\" value=\"".$card["card_number"]."\"/>
                <div class=\"form-group\">
                  <label for=\"branch-name\" class=\"col-form-label\"
                    >Card Holder Name</label
                  >
                  <input type=\"text\" class=\"form-control\" name=\"cardholder_name\" value=\"".$card["cardholder_name"]."\"/>
                </div>
                <div class=\"form-group\">
                  <label for=\"message-text\" class=\"col-form-label\"
                    >Balance</label
                  >
                  <input type=\"number\" class=\"form-control\" name=\"card_balance\" value=\"".$card["card_balance"]."\"/>
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
        id=\"deleteModal".$card["card_number"]."\"
        tabindex=\"-1\"
        role=\"dialog\"
        aria-labelledby=\"exampleModalLabel\"
        aria-hidden=\"true\"
      >
        <div class=\"modal-dialog\" role=\"document\">
          <div class=\"modal-content\">
            <div class=\"modal-header\">
              <h5 class=\"modal-title\" id=\"exampleModalLabel\">Delete Member</h5>
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
              <form action=\"/staff/membership.php\" method=\"GET\">
                <input type=\"hidden\" class=\"form-control\" name=\"delete\" value=\"yes\"/>
                <input type=\"hidden\" class=\"form-control\" name=\"card_number\" value=\"".$card["card_number"]."\"/>
                <div class=\"form-group\">
                  <label for=\"branch-name\" class=\"col-form-label\"
                    >Are you sure you want to delete ".$card["card_number"]." - ".$card["cardholder_name"]."</label
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
    $cards = getCardsByName($name, 1);
    foreach ($cards as $card)
    {
        echo "<div
        class=\"modal fade\"
        id=\"editModal".$card["card_number"]."\"
        tabindex=\"-1\"
        role=\"dialog\"
        aria-labelledby=\"exampleModalLabel\"
        aria-hidden=\"true\"
      >
        <div class=\"modal-dialog\" role=\"document\">
          <div class=\"modal-content\">
            <div class=\"modal-header\">
              <h5 class=\"modal-title\" id=\"exampleModalLabel\">Edit Membership</h5>
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
              <form action=\"/staff/membership.php\" method=\"POST\">
                <input type=\"hidden\" class=\"form-control\" name=\"card_number\" value=\"".$card["card_number"]."\"/>
                <div class=\"form-group\">
                  <label for=\"branch-name\" class=\"col-form-label\"
                    >Card Holder Name</label
                  >
                  <input type=\"number\" class=\"form-control\" name=\"cardholder_name\" value=\"".$card["cardholder_name"]."\"/>
                </div>
                <div class=\"form-group\">
                  <label for=\"message-text\" class=\"col-form-label\"
                    >Balance</label
                  >
                  <input type=\"text\" class=\"form-control\" name=\"card_balance\" value=\"".$card["card_balance"]."\"/>
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
    }
}

?>