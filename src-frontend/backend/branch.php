<?php
include_once("curl.php");

$showCount = 5;

function addBranch($branch_name, $branch_phone)
{
    $data = "task=add&name=".$branch_name."&phone=".$branch_phone;
    $raw_data = callAPI("POST", "http://localhost:8081/branch", $data);
    return json_decode($raw_data, true);
}

function updateBranch($branch_id, $branch_name, $branch_phone)
{
    $data = "task=update&id=".$branch_id."&name=".$branch_name."&phone=".$branch_phone;
    $raw_data = callAPI("POST", "http://localhost:8081/branch", $data);
    return json_decode($raw_data, true);
}

function removeBranch($branch_id)
{
    $data = "id=".$branch_id;
    $raw_data = callAPI("DELETE", "http://localhost:8081/branch", $data);
    return json_decode($raw_data, true);
}

function getBranches($page = 1)
{
    global $showCount;
    $raw_data = callAPI("GET", "http://localhost:8081/branch?count=".$showCount."&page=".$page);
    return json_decode($raw_data, true);
}

function getBranchByID($branch_id)
{
    $raw_data = callAPI("GET", "http://localhost:8081/branch?id=".$branch_id);
    return json_decode($raw_data, true);
}

function getBranchesByName($name, $page = 1)
{
    $name = str_replace(" ", "+", $name);
    $raw_data = callAPI("GET", "http://localhost:8081/branch?name=".$name);
    return json_decode($raw_data, true);
}
