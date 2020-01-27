<?php
include_once("curl.php");

$showCount = 5;

function addDiscount($discount_name, $discount_percentage)
{
    $data = "task=add&name=".$discount_name."&percentage=".$discount_percentage;
    $raw_data = callAPI("POST", "http://localhost:8081/discount", $data);
    return json_decode($raw_data, true);
}

function updateDiscount($discount_id, $discount_name, $discount_percentage)
{
    $data = "task=update&id=".$discount_id."&name=".$discount_name."&percentage=".$discount_percentage;
    $raw_data = callAPI("POST", "http://localhost:8081/discount", $data);
    return json_decode($raw_data, true);
}

function removeDiscount($discount_id)
{
    $data = "id=".$discount_id;
    $raw_data = callAPI("DELETE", "http://localhost:8081/discount", $data);
    return json_decode($raw_data, true);
}

function getDiscounts($page = 1, $showCount = 5)
{
    $raw_data = callAPI("GET", "http://localhost:8081/discount?count=".$showCount."&page=".$page);
    return json_decode($raw_data, true);
}

function getDiscountByID($discount_id)
{
    $raw_data = callAPI("GET", "http://localhost:8081/discount?id=".$discount_id);
    return json_decode($raw_data, true);
}

function getDiscountsByName($name, $page = 1)
{
    $name = str_replace(" ", "+", $name);
    $raw_data = callAPI("GET", "http://localhost:8081/discount?name=".$name);
    return json_decode($raw_data, true);
}
