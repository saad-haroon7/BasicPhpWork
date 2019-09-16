<?php
    $db_host = "localhost";
    $db_username = "root";
    $db_password = "maxwell7044";
    $db_name = "practice";
    $conn = new PDO("mysql:host=$db_host;dbname=$db_name", $db_username, $db_password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?>