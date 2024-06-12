<?php

$servername = "localhost:3306";
$databasename = "hobo";
$username = "root";
$password = '8=2TM5/MB<8MmKd5+"g[\\nB:Rg`]jim7';


try {
    $conn = new PDO("mysql:host=$servername;dbname=$databasename", $username, $password);
    
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage() . "\n";
    exit();
}