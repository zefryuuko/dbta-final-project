<?php
include("curl.php");

function getStaffs()
{
    $raw_data = callAPI("GET", "http://localhost:8081/staff");
    return json_decode($raw_data, true);
}

function getStaffByID($id)
{
    $raw_data = callAPI("GET", "http://localhost:8081/staff?id=".$id);
    return json_decode($raw_data, true);
}

function getStaffByName($name)
{
    $raw_data = callAPI("GET", "http://localhost:8081/staff?name=".$name);
    return json_decode($raw_data, true);
}

print_r(getStaffByName("Jotika")[0]);