<?php

if (!isset($_SESSION["user"])) {
    header("Location: /pages/login.php");
    exit();
}