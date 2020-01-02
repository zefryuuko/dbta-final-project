<?php
include("/backend/auth.php");

setcookie("id", "", time() - 3600); 
setcookie("session", "", time() - 3600); 

echo "<body onload=\"auth()\"><script>function auth(){window.location.replace('/');}</script>";