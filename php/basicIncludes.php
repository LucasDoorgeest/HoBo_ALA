<?php
include_once 'sqlConnect.php';
include_once 'sqlUtils.php';

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

include_once "../php/tools.php";

include_once '../blocks/headComponent.php';
include_once '../blocks/headerComponent.php';
include_once '../blocks/footerComponent.php';

include_once '../blocks/serieCard.php';
include_once '../blocks/scrollableList.php';
include_once '../blocks/afleveringCard.php';

include_once 'getHistory.php';






