<?php

$hostName = "localhost";
$dbUser = "root";
$dbPassword = "boniya@430";
$dbName = "cookie";
$conn = new mysqli($hostName, $dbUser, $dbPassword, $dbName);
if ($conn->connect_error) {
    die("Something went wrong;");
}

?>