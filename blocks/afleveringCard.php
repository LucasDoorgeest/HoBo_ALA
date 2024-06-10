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

    <h2><?php echo $aflevering["AflTitel"]; ?></h2>

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

    <style>
        .fakePlayer {
            display: flex;
            width: 100%;
            height: calc(1000px * 9 / 16);
            background-color: black;
            position: relative;

            margin-bottom: 300px;
            margin-top: 20px;
        }

        .fakePlayer video {
            height: 100%;
            width: calc(100% - 300px);
        }

        .fakePlayer .afleveringen {
            width: 300px;
            height: 100%;
        }

        select#seizoen {
            width: 100%;
            height: 35px;
        }

        .afleveringenWrap {
            display: flex;
            flex-direction: column;
            gap: 10px;
            margin-top: 10px;
        }

        .afleveringenWrap a {
            color: white;
            text-decoration: none;
            padding: 5px;
            background-color: #333;
            text-align: center;
        }

        .fakePlayer::before {
            content: "Aflevering";
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            color: white;
            font-size: 2em;
        }
    </style>
    <script>
        const seizoen = document.getElementById("seizoen");
        const afleveringen = document.querySelectorAll(".afleveringenWrap");

        seizoen.addEventListener("change", () => {
            afleveringen.forEach((aflevering) => {
                aflevering.classList.add("d-none");
            });

            afleveringen[seizoen.selectedIndex].classList.remove("d-none");
        });
    </script>
<?php
}