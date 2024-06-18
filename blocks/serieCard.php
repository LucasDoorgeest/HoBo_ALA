<?php
include_once "../php/tools.php";

function serieCard($id) {
    $serie = fetchSql("select * from serie where serie.SerieID = ?;", [$id]);

    if ($serie == null) {
        header("Location: /pages/search.php");
    }
    $genre = fetchSqlAll("select GenreNaam from serie_genre 
                        join genre on serie_genre.GenreID = genre.GenreID 
                        where serie_genre.SerieID = ?;", [$id]);
    $seasons = fetchSqlAll("select * from seizoen where SerieID = ?", [$id]);

    $rating = 0;
    $totalDuration = 0;
    $totalEpisodes = 0;

    foreach ($seasons as $season) {
        $rating += $season["IMDBRating"];
        $episodes = fetchSqlAll("select * from aflevering where SeizID = ?", [$season["SeizoenID"]]);
        $totalEpisodes += count($episodes);      
        foreach ($episodes as $episode) {
            $totalDuration += $episode["Duur"];
        }
    }

    if (count($seasons) > 0) {
        $rating = $rating / count($seasons);
        $beginYear = $seasons[0]["Jaar"];
        $endYear = $seasons[count($seasons) - 1]["Jaar"];
    } else {
        $beginYear = "N/A";
        $endYear = "N/A";
    }
    if ($genre != null) {
        $genre = join(", ", array_column($genre, "GenreNaam"));
    }

    if ($totalDuration > 60) {
        $hours = floor($totalDuration / 60);
        $minutes = $totalDuration % 60;
        $totalDuration = $hours . "h " . $minutes . "m";
    } else {
        $totalDuration = $totalDuration . "m";
    }
  
    $serieInfo = [
        "id" => $id,
        "title" => $serie["SerieTitel"],
        "description" => "No description available.",
        "years" => [
            "begin" => $beginYear,
            "end" => $endYear
        ],
        "duration" => $totalDuration,
        "seasons" => count($seasons),
        "episodes" => $totalEpisodes,
        "genre" => $genre,
        "rating" => round($rating, 2),
        "image" => getImgPathBySerieId($id),
        "active" => $serie["Actief"]? "Yes" : "No",
        "IMDBLink" => $serie["IMDBLink"]
    ];

    foreach($serieInfo as $key => $value) {
        if ($value == null) {
            $serieInfo[$key] = "N/A";
        } else if (is_array($value)) {
            foreach($value as $key2 => $value2) {
                if ($value2 == null) {
                    $serieInfo[$key][$key2] = "N/A";
                }
            }
        }
    }

    $years = $serieInfo["years"]["begin"];
    if ($serieInfo["years"]["end"] != $serieInfo["years"]["begin"]) {
        $years .= " - " . $serieInfo["years"]["end"];
    }
    ?>
    <article class="serieCard">
    <img class="serieInfoImg" src="<?php echo $serieInfo["image"]; ?>" alt="<?php echo $serieInfo["title"]; ?>">
    <section class="cardHeading">
        <section class="titleWrap">
            <section class="title">
                <h2 class="serieInfoTitle"><?php echo $serieInfo["title"]; ?></h2>
                <section class="undertitleinfoWrap">
                    <span class="years"><?php echo $years ?></span>
                    <span class="dividor"> | </span>
                    <span class="duration"><?php echo $serieInfo["duration"]; ?></span>
                </section>
            </section>
        </section>
        <table class="moreinfoWrap">
            <tr>
                <td>Seasons:</td>
                <td><?php echo $serieInfo["seasons"]; ?></td>
            </tr>
            <tr>
                <td>Episodes:</td>
                <td><?php echo $serieInfo["episodes"]; ?></td>
            </tr>
            <tr>
                <td>Genre:</td>
                <td><?php echo $serieInfo["genre"]; ?></td>
            </tr>
            <tr>
                <td>Active:</td>
                <td><?php echo $serieInfo["active"]; ?></td>
            </tr>
        </table>
        <p>
        Deze serie volgt diverse personages die persoonlijke en professionele uitdagingen aangaan. Intrigerende plotwendingen en complexe relaties onthullen hun ontwikkelingen en keuzes. Geschikt voor een breed publiek.
        </p>
    </section>
    <section class="rating">
        <a href="<?php echo $serieInfo["IMDBLink"]; ?>">
            <p>IMDb Rating:</p>
            <p class="rating-score"><?php echo $serieInfo["rating"]; ?></p>
        </a>
    </section>

    </article>
    <?php
}