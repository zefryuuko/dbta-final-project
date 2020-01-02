<?php
include("curl.php");

$showCount = 5;

function getCards($page = 1)
{
    global $showCount;
    $raw_data = callAPI("GET", "http://localhost:8081/bill?card=".$showCount."&page=".$page);
    return json_decode($raw_data, true);
}

function getCardByNo($no)
{
    $raw_data = callAPI("GET", "http://localhost:8081/card?no=".$no);
    return json_decode($raw_data, true);
}