<?php
include_once "../php/tools.php";

function serieCard($id) {
    $serie = fetchSql("select * from serie where serie.SerieID = ?;", [$id]);
    $genre = fetchSql("select GenreNaam from serie_genre 
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
        $genre = $genre["GenreNaam"];
    }
  

    $serieInfo = [
        "id" => $id,
        "title" => $serie["SerieTitel"],
        "description" => "No description available.",
        "years" => [
            "begin" => $beginYear,
            "end" => $endYear
        ],
        "duration" => $totalDuration . "min",
        "seasons" => count($seasons),
        "episodes" => $totalEpisodes,
        "genre" => $genre,
        "rating" => $rating,
        "image" => getImgPathBySerieId($id)
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
    ?>
    <article class="serieCard">
        <section class="cardHeading">
            <section class="titleWrap">
                <section class="title">
                    <h2 class="serieInfoTitle"><?php echo $serieInfo["title"]; ?></h2>
                    <section class="undertitleinfoWrap">
                        <span class="years"><?php echo $serieInfo["years"]["begin"] . " - " . $serieInfo["years"]["end"]?$serieInfo["years"]["end"]:"nu"; ?></span>
                        <span class="dividor"> | </span>
                        <span class="duration"><?php echo $serieInfo["duration"]; ?></span>
                    </section>
                </section>
                <button class="likeButton">    
                    <img class="likeIcon" src="/img/heart-icon.svg" alt="Like icon" >
                </button>
            </section>

            <section class="rating">
                <p>IMDb Rating:</p>
                <p class="rating-score"><?php echo $serieInfo["rating"]; ?></p>
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
        </table>
            



        <img class="serieInfoImg" src="<?php echo $serieInfo["image"]; ?>" alt="<?php echo $serieInfo["title"]; ?>">
    </article>
    <?php
}