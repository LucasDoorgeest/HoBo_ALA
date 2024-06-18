<?php
if (!isset($_SESSION["user"])) {
    header("Location: /pages/register.php");
    exit();
}
?>