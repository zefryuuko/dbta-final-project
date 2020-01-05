<?php
include_once("../backend/card.php");

function generateTableBody($currentPage = 1)
{
    echo "<tr><td colspan=\"4\" style=\"text-align:center;\">Enter card number above to search for member.</td></tr>";
}

function generateTableBodyByNo($name, $currentPage = 1)
{
    $cards = getCardByNo($name);
    foreach ($cards as $card)
    {
        echo "<tr><td>".$card["card_number"]."</td><td>".$card["cardholder_name"]."</td><td>".$card["card_balance"]."</td><td><a data-target=\"#editModal".$card["card_number"]."\" data-toggle=\"modal\" href=\"#editModal".$card["card_number"]."\"><img src=\"/resources/edit.svg\" style=\"width: 45%\"></a></td>";
    }
}

function generateModalsByNo($no)
{
    $cards = getCardByNo($no);
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
              <form action=\"/cashier/membership.php?no=".$card["card_number"]."\" method=\"POST\">
                <input type=\"hidden\" class=\"form-control\" name=\"card_number\" value=\"".$card["card_number"]."\"/>
                <div class=\"form-group\">
                  <label for=\"branch-name\" class=\"col-form-label\"
                    >Card Holder Name</label
                  >
                  <input type=\"text\" class=\"form-control\" name=\"cardholder_name\" value=\"".$card["cardholder_name"]."\" disabled/>
                </div>
                <div class=\"form-group\">
                  <label for=\"message-text\" class=\"col-form-label\"
                    >Top Up Balance</label
                  >
                  <input type=\"number\" class=\"form-control\" name=\"topup_balance\" value=\"\"/>
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