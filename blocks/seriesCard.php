<?php
include_once '../php/sqlConnect.php';
include_once '../php/sqlUtils.php';


function seriesCard($id) {


    $serie = fetchSql("select * from serie where serie.SerieID = ?;", [$id]);
    $genre = fetchSql("select * from serie_genre
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

    $rating = $rating / count($seasons);
    if ($rating == 0) {
        $rating = "N/A";
    }
    if ($totalDuration == 0) {
        $totalDuration = "N/A";
    }
    if ($totalEpisodes == 0) {
        $totalEpisodes = "N/A";
    }
    if (count($seasons) == 0) {
        $beginYear = "N/A";
        $endYear = "N/A";
    } else {
        $beginYear = $seasons[0]["Jaar"];
        $endYear = $seasons[count($seasons) - 1]["Jaar"];
    }
    if ($beginYear == $endYear) {
        $endYear = "nu";
    }
    if ($genre == null) {
        $genre = "N/A";
    } else {
        $genre = $genre["GenreNaam"];
    }
    if (count($seasons) == 0) {
        $beginYear = "N/A";
        $endYear = "N/A";
    } else {
        $beginYear = $seasons[0]["Jaar"];
        $endYear = $seasons[count($seasons) - 1]["Jaar"];
    }


    

    $series = [
        "id" => $serie["SerieID"],
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
        "rating" => $rating
    ];


    $len = strlen((string)$series["id"]);
    $imgpath = str_repeat("0", 5 - $len) . $series["id"] . ".jpg";
    if (!file_exists("../img/series/images/" . $imgpath)) {
        $imgpath = "error.png";
    }


    $series["image"] = "/img/series/images/" . $imgpath;




    ?>
    <article class="seriesCard">
        <section class="cardHeading">
            <section class="titleWrap">
                <section class="title">
                    <h2 class="seriesTitle"><?php echo $series["title"]; ?></h2>
                    <section class="undertitleinfoWrap">
                        <span class="years"><?php echo $series["years"]["begin"] . " - " . $series["years"]["end"]?$series["years"]["end"]:"nu"; ?></span>
                        <span class="dividor"> | </span>
                        <span class="duration"><?php echo $series["duration"]; ?></span>
                    </section>
                </section>
                <button class="likeButton">    
                    <img class="likeIcon" src="/images/like.svg" alt="Like icon" >
                </button>
            </section>

            <section class="rating">
                <p>IMDb Rating:</p>
                <p class="rating-score"><?php echo $series["rating"]; ?></p>
            </section>

        </section>
        <table class="moreinfoWrap">
            <tr>
                <td>Seasons:</td>
                <td><?php echo $series["seasons"]; ?></td>
            </tr>
            <tr>
                <td>Episodes:</td>
                <td><?php echo $series["episodes"]; ?></td>
            </tr>
            <tr>
                <td>Genre:</td>
                <td><?php echo $series["genre"]; ?></td>
            </tr>
        </table>
            



        <img class="seriesImg" src="<?php echo $series["image"]; ?>" alt="<?php echo $series["title"]; ?>">


        <p class="seriesDescription"><?php echo $series["description"]; ?></p>


        <!-- <section class="imgs">
            <div class="scrolableWrap">
                <img class="scrolableImg" src="/img/Rectangle 19.png" alt="The Shawshank Redemption">
                <img class="scrolableImg" src="/img/Rectangle 20.png" alt="The Shawshank Redemption">
                <img class="scrolableImg" src="/img/Rectangle 21.png" alt="The Shawshank Redemption">
                <img class="scrolableImg" src="/img/Rectangle 19.png" alt="The Shawshank Redemption">
                <img class="scrolableImg" src="/img/Rectangle 20.png" alt="The Shawshank Redemption">
                <img class="scrolableImg" src="/img/Rectangle 21.png" alt="The Shawshank Redemption">
            </div>

            <button class="leftArrow">
                <p><</p>
            </button>
            <button class="rightArrow">
                <p>></p>
            </button>
        </section> -->


        
    </article>
    <?php
}