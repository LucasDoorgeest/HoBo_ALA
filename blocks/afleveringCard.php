<?php
include_once '../php/sqlConnect.php';
include_once '../php/sqlUtils.php';

include_once '../blocks/seriesCard.php';


function afleveringCard($id) {
    $serie = fetchSql("select * from aflevering 
    inner join seizoen on aflevering.SeizID = seizoen.SeizoenID
    where AfleveringID = ?;", [$id]);

    if ($serie == null) {
        return "<h1 class='Error'>404 Not found!</h1>";
    }

    echo seriesCard($serie["SerieID"]);
}