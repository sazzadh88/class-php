<?php
$servername = 'localhost';
$db_name = 'gtp_demo';
$db_user = 'root';
$db_pass = 'root';

try {
    $conn = new PDO("mysql:host=$servername;dbname=$db_name", $db_user, $db_pass);
    }
catch(PDOException $e)
    {
    echo "Connection failed: " . $e->getMessage();
    }