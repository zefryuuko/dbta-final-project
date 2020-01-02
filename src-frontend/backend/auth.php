<?php
include_once("curl.php");

function authenticate($level, $username, $password)
{
    return callAPI("GET", "http://localhost:8081/auth/login?id=".$username."&pass=".$password."&level=".$level);
}

function isAuthenticated($level, $username, $sessionID)
{
    return callAPI("GET", "http://localhost:8081/auth/?id=".$username."&session=".$sessionID."&level=".$level);
}

function logout($sessionID)
{

}