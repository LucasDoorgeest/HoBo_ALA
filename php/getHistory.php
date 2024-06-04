<?php

include_once '../php/sqlConnect.php';
include_once '../php/sqlUtils.php';

function getHistory($klantID) {
    $query = "
    SELECT * from stream
    inner join aflevering on stream.aflID = aflevering.AfleveringID
    inner join seizoen on aflevering.SeizID = seizoen.SeizoenID
    inner join serie on seizoen.SerieID = serie.SerieID
    where klantID = ?
    order by StreamID desc
    ;";

    $result = fetchSqlAll($query, [$klantID]);

    return $result;
}