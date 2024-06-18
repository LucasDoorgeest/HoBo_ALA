<?php
function afleveringCard($id) {
    $query = "select * from aflevering where AfleveringID = ?;";
    $aflevering = fetchSql($query, [$id]);
    $serieID = getSerieIdByAflId($id);

    $query = "
        select SeizoenID from serie
        inner join seizoen on seizoen.SerieID = serie.SerieID
        where serie.SerieID = ?;
    ";

    $seasons = fetchSqlAll($query, [$serieID]);

    foreach($seasons as $key => $season) {
        $seasons[$key] = fetchSqlAll("select * from aflevering where SeizID = ?", [$season["SeizoenID"]]);
    }

    $selectedSeason = null;

    foreach($seasons as $key =>$season) {
        foreach($season as $aflevering1) {
            if ($aflevering1["AfleveringID"] == $id) {
                $selectedSeason = $key;
                break;
            }
        }
    }
    ?>
    <section class="flexWrap">
        <section>
            <h2><?php echo $aflevering["AflTitel"]; ?></h2>
            <p>Duur: <?php echo $aflevering["Duur"] ?> m</p>
        </section>
    </section>
    <section class="fakePlayer">
        <video controls>
            <source src="/videos/aflevering.mp4" type="video/mp4">
            Your browser does not support the video tag.
        </video>
        <section class="afleveringen">
            <select name="seizoen" id="seizoen">
                <?php
                foreach($seasons as $key => $season) {
                    echo "<option value='" . $season["SeizoenID"] . "' " . ($key == $selectedSeason ? "selected" : "") . ">Seizoen " . $key + 1 . "</option>";
                }
                ?>
            </select>
            <?php 
                foreach($seasons as $key => $season) {
                    ?>
                    <section class="afleveringenWrap <?php echo $key == $selectedSeason ? "" : "d-none"; ?>">
                    <?php
                        foreach($season as $aflevering) {
                            echo "<a href='/pages/aflevering.php?id=" . $aflevering["AfleveringID"] . "'>Aflevering " . $aflevering["AflTitel"] . "</a>";
                        }
                    ?>
                    </section>
                    <?php
                    }
                    ?>
            </section>
        </section>
    </section>
<?php
}
?>