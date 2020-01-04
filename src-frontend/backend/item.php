<?php
include_once("curl.php");

$showCount = 5;

function addItem($item_name, $item_size, $item_price)
{
    $data = "task=add&name=".$item_name."&size=".$item_size."&price=".$item_price;
    $raw_data = callAPI("POST", "http://localhost:8081/item", $data);
    return json_decode($raw_data, true);
}

function updateItem($item_id, $item_name, $item_size, $item_price)
{
    $data = "task=update&id=".$item_id."&name=".$item_name."&size=".$item_size."&price=".$item_price;
    $raw_data = callAPI("POST", "http://localhost:8081/item", $data);
    return json_decode($raw_data, true);
}

function removeItem($item_id)
{
    $data = "id=".$item_id;
    $raw_data = callAPI("DELETE", "http://localhost:8081/item", $data);
    return json_decode($raw_data, true);
}

function getItems($page = 1)
{
    global $showCount;
    $raw_data = callAPI("GET", "http://localhost:8081/item?count=".$showCount."&page=".$page);
    return json_decode($raw_data, true);
}

function getItemByID($item_id)
{
    $raw_data = callAPI("GET", "http://localhost:8081/item?id=".$item_id);
    return json_decode($raw_data, true);
}

function getItemsByName($name, $page = 1)
{
    $name = str_replace(" ", "+", $name);
    $raw_data = callAPI("GET", "http://localhost:8081/item?name=".$name);
    return json_decode($raw_data, true);
}
