<?php

function getImgPathBySerieId($serieId) {
    $len = strlen((string)$serieId);
    $imgpath = str_repeat("0", 5 - $len) . $serieId . ".jpg";
    if (!file_exists("../img/series/images/" . $imgpath)) {
        $imgpath = "error.png";
    }

    return "/img/series/images/" . $imgpath;
}

function getSerieIdByAflId($aflId) {
    $query = "
        select * from aflevering
        inner join seizoen on aflevering.SeizID = seizoen.SeizoenID
        inner join serie on seizoen.SerieID = serie.SerieID
        where AfleveringID = ?
    ;
    ";
    return fetchSql($query, [$aflId])['SerieID'];
}