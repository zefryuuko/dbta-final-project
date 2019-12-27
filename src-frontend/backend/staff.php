<?php
include("curl.php");

$showCount = 5;

function getStaffs($page = 1)
{
    global $showCount;
    $raw_data = callAPI("GET", "http://localhost:8081/staff?count=".$showCount."&page=".$page);
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

function addStaff($name)
{

}

function setStaffStatus($id, $status)
{
    
}