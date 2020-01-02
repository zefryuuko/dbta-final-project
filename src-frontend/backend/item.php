<?php
include("curl.php");

$showCount = 5;

function getItems($page = 1)
{
    global $showCount;
    $raw_data = callAPI("GET", "http://localhost:8081/bill?item=".$showCount."&page=".$page);
    return json_decode($raw_data, true);
}

function getItemByID($id)
{
    $raw_data = callAPI("GET", "http://localhost:8081/item?id=".$id);
    return json_decode($raw_data, true);
}