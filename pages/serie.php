<?php

if (!isset($_GET["id"])) {
    header("Location: /pages/home.php");
    exit();
}

require_once "../blocks/head.php";
require_once "../blocks/header.php";
require_once "../blocks/footer.php";
require_once "../blocks/seriesCard.php";


require_once "../php/sqlConnect.php";
require_once "../php/sqlUtils.php";



$serie = [
    "id" => 1,
    "title" => "The Shawshank Redemption",
    "description" => "After crash-landing on an alien planet, the Robinson family fight against all odds to survive and escape, but they're surrounded by hidden dangers.",
    "image" => "/img/bg/00006.jpg",
    "years" => [
        "begin" => 1994,
        "end" => 1994
    ],
    "duration" => "2h 22min",
    "age" => "16+",
    "seasons" => 1,
    "episodes" => 1,
    "genre" => "Drama",
    "creators" => "Frank Darabont",
    "rating" => 9.3
];


$head = [
    "title" => "serie",
    "styles" => ["/styles/global.css"],
    "scripts" => ["/script/slides.js"]
];

$serie = fetchSql("
select * from serie 
where SerieID = ?
limit 1;", [$_GET["id"]]);



// $serie = fetchSql("
// select * from aflevering 
// inner join seizoen 
// on aflevering.SeizID = seizoen.SeizoenID 
// inner join serie 
// on seizoen.SerieID = serie.SerieID 
// inner join serie_genre
// on seizoen.SerieID = serie_genre.SerieID
// inner join genre
// on serie_genre.GenreID = genre.GenreID
// where AfleveringID = ?
// limit 1;", [$_GET["id"]]);


//TODO: parse image

$serieCard = [
    "id" => $serie["SerieID"],
    "title" => $serie["SerieTitel"],
    "description" => "No description available.",
    "years" => [
        "begin" => $serie["Jaar"],
        "end" => $serie["Jaar"] //TODO: add end year
    ],
    "duration" => $serie["Duur"] . "min",
    "seasons" => 1, //TODO: add seasons
    "episodes" => 1,//TODO: add episodes
    "genre" => $serie["GenreNaam"],
    "creators" => "Frank Darabont", //TODO: add creators
    "rating" => $serie["Rang"]
];
//convert Id to string 00001.jpg

$len = strlen((string)$serieCard["id"]);
$imgpath = str_repeat("0", 5 - $len) . $serieCard["id"] . ".jpg";
//Check if image exists on server
if (!file_exists("../img/serie/images/" . $imgpath)) {
    $imgpath = "error.png";
}


$serieCard["image"] = "/img/serie/images/" . $imgpath;


?>

<!DOCTYPE html>
<html lang="nl">
<?php head($head); ?>
<?php headerBlock(); ?>
<main>
    <div id="blurBg"></div>
    <?php echo seriesCard($serieCard); ?>
</main>
<?php footer(); ?>
</body>