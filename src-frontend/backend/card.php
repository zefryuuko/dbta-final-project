<?php
include_once("curl.php");

$showCount = 5;

function addCard($json)
{
    $raw_data = callAPI("POST", "http://localhost:8081/card", $json);
    return json_decode($raw_data, true);
}

function updateCard($card_number, $cardholder_name, $balance)
{
    $data = "task=update&no=".$card_number."&name=".$cardholder_name."&balance=".$balance;
    $raw_data = callAPI("POST", "http://localhost:8081/card", $data);
    return json_decode($raw_data, true);
}

function removeCard($card_number)
{
    $data = "no=".$card_number;
    $raw_data = callAPI("DELETE", "http://localhost:8081/card", $data);
    return json_decode($raw_data, true);
}

function getCards($page = 1)
{
    global $showCount;
    $raw_data = callAPI("GET", "http://localhost:8081/card?count=".$showCount."&page=".$page);
    return json_decode($raw_data, true);
}

function getCardByNo($no)
{
    $raw_data = callAPI("GET", "http://localhost:8081/card?no=".$no);
    return json_decode($raw_data, true);
}

function getCardsByName($name, $page = 1)
{
    $name = str_replace(" ", "+", $name);
    $raw_data = callAPI("GET", "http://localhost:8081/card?name=".$name);
    return json_decode($raw_data, true);
}
