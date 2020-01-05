<?php
include_once("curl.php");

$showCount = 5;

function getBills($page = 1)
{
    global $showCount;
    $raw_data = callAPI("GET", "http://localhost:8081/bill?count=".$showCount."&page=".$page);
    return json_decode($raw_data, true);
}

function getBillByID($id)
{
    $raw_data = callAPI("GET", "http://localhost:8081/bill?id=".$id);
    return json_decode($raw_data, true);
}

function getBillsByStaffID($id, $page)
{
    global $showCount;
    $raw_data = callAPI("GET", "http://localhost:8081/bill?staff=".$id."&count=".$showCount."&page=".$page);
    return json_decode($raw_data, true);
}