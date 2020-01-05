<?php
include("../backend/bill.php");

function generateTableBody($currentPage = 1)
{
    $bills = getBillsByStaffID($_COOKIE["id"], $currentPage);
    foreach ($bills as $bill)
    {
        echo "<tr><td>".$bill["bill_id"]."</td><td>".$bill["branch_name"]."</td><td>".(($bill["staff_name"]))."</td><td>".$bill["check_number"]."</td><td><a href=\"/staff/transaction_details.php?id=".$bill["bill_id"]."\"><img src=\"/resources/view.svg\" style=\"width: 22%\" /></a></td></tr>";
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
        echo "<li class='page-item'><a class='page-link' href='"."/staff/history.php?page=".($currentPage - 1)."' tabindex='-1'>Back</a></li>";
    }
    echo "<li class=\"page-item active\"><span class=\"page-link\">Page ".$currentPage."</span></li>";
    if (count(getBillsByStaffID($_COOKIE["id"], $currentPage + 1)) == 0)
    {
        echo "<li class='page-item disabled'><a class='page-link' href='#' tabindex='-1'>Next</a></li>";
    }
    else
    {
        echo "<li class='page-item'><a class='page-link' href='"."/staff/history.php?page=".($currentPage + 1)."' tabindex='-1'>Next</a></li>";
    }
}

?>