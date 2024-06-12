<?php

function getFilteredHistory($klantID) {
    $query = "
    SELECT * from stream
    inner join aflevering on stream.aflID = aflevering.AfleveringID
    inner join seizoen on aflevering.SeizID = seizoen.SeizoenID
    inner join serie on seizoen.SerieID = serie.SerieID
    where klantID = ?
    order by StreamID desc
    ;";

    $result = fetchSqlAll($query, [$klantID]);

    $filtered = [];
    for ($i = 1; $i < count($result); $i++) {
        if ($result[$i]["SerieID"] != $result[$i - 1]["SerieID"]) {
            $filtered[] = $result[$i - 1];
        }
    }

    return $filtered;
}


function renderHistoryItems($heading, $items) {
    if (count($items) == 0) {
        return;
    }
    ?>

    <section>
        <h2><?php echo $heading ?></h2>
        <section class="searchResults">
                <?php
                foreach ($items as $item) {
                    ?>
                    <a href="/pages/aflevering.php?id=<?php echo $item["AflID"] ?>">
                    <section class="serieCardWrap">
                        <img class="bgsupport lazy" data-src="<?php echo getImgPathBySerieId($item["SerieID"]) ?>" alt="Serie image">
                        <p class="mini"><?php echo $item["AflTitel"] ?></p>
                    </section>
                </a>
                    <?php
                }

                ?>
        </section>
    </section>
    <?php
}