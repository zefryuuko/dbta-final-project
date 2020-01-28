<?php
$branchId = 1;
$checkNumber = 1;

function incrementCheckNumber() {
    global $checkNumber;
    $checkNumber = $checkNumber + 1;
}