<?php
include_once "basicIncludes.php";
include_once "klantOnly.php";

if ($_SESSION["user"]["AboID"] != 4) {
    header("Location: /");
    exit();
}