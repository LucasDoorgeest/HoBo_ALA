<?php
include_once "sqlUtils.php";
include_once "sqlConnect.php";


$json = file_get_contents('php://input');
$data = json_decode($json);

$serieID = $data->serieID;
$klantID = $data->klantID;

$query = "SELECT * from stream
"