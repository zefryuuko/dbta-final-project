<?php
include("../backend/card.php");

function generateTableBody($currentPage = 1)
{
    $cards = getCards($currentPage);
    foreach ($cards as $card)
    {
        echo "<tr><td>".$card["card_number"]."</td><td>".$card["cardholder_name"]."</td><td>".$card["card_balance"]."</td><td><a href=\"#\"><img src=\"/resources/cross.svg\" style=\"width: 45%\"></a></td><td><a href=\"#\"><img src=\"/resources/edit.svg\" style=\"width: 45%\"></a></td>";
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

?>