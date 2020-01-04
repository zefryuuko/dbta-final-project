<?php
include_once("curl.php");

$showCount = 5;

function addStaff($staff_name, $staff_level, $staff_password)
{
    $data = "task=add&name=".$staff_name."&level=".$staff_level."&password=".$staff_password;
    $raw_data = callAPI("POST", "http://localhost:8081/staff", $data);
    return json_decode($raw_data, true);
}

function updateStaff($staff_id, $staff_name, $staff_level, $staff_password)
{
    $data = "task=update&id=".$staff_id."&name=".$staff_name."&level=".$staff_level."&password=".$staff_password;
    $raw_data = callAPI("POST", "http://localhost:8081/staff", $data);
    return json_decode($raw_data, true);
}

function removeStaff($staff_id)
{
    $data = "id=".$staff_id;
    $raw_data = callAPI("DELETE", "http://localhost:8081/staff", $data);
    return json_decode($raw_data, true);
}

function getStaffs($page = 1)
{
    global $showCount;
    $raw_data = callAPI("GET", "http://localhost:8081/staff?count=".$showCount."&page=".$page);
    return json_decode($raw_data, true);
}

function getStaffByID($staff_id)
{
    $raw_data = callAPI("GET", "http://localhost:8081/staff?id=".$item_id);
    return json_decode($raw_data, true);
}

function getStaffsByName($name, $page = 1)
{
    $name = str_replace(" ", "+", $name);
    $raw_data = callAPI("GET", "http://localhost:8081/staff?name=".$name);
    return json_decode($raw_data, true);
}
