<?php
include("../backend/staff.php");

function generateTableBody($currentPage = 1)
{
    $staffs = getStaffs($currentPage);
    foreach ($staffs as $staff)
    {
        echo "<tr><td>".$staff["staff_id"]."</td><td>".$staff["staff_name"]."</td><td>".(($staff["staff_level"] == 0 ? "Admin" : "Cashier"))."</td><td><button type=\"button\" class=\"btn btn-secondary\" style=\"margin-right: 5px;\">E</button><button type=\"button\" class=\"btn btn-danger\">X</button></td>";
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
        echo "<li class='page-item'><a class='page-link' href='"."/staff/staff_details.php?page=".($currentPage - 1)."' tabindex='-1'>Back</a></li>";
    }
    echo "<li class=\"page-item active\"><span class=\"page-link\">Page ".$currentPage."</span></li>";
    if (count(getStaffs($currentPage + 1)) == 0)
    {
        echo "<li class='page-item disabled'><a class='page-link' href='#' tabindex='-1'>Next</a></li>";
    }
    else
    {
        echo "<li class='page-item'><a class='page-link' href='"."/staff/staff_details.php?page=".($currentPage + 1)."' tabindex='-1'>Next</a></li>";
    }
}

?>