<?php
include_once "basicIncludes.php";
include_once "adminOnly.php";

$SerieID = $_GET["SerieID"];
$Rang = $_GET["Rang"];
$IMDBRating = $_GET["IMDBRating"];

$query = "INSERT INTO seizoen (SerieID, Rang, IMDBRating) VALUES (?, ?, ?)";
runSql($query, [$SerieID, $Rang, $IMDBRating]);

header("Location: ../pages/editSerie.php?id=$SerieID");