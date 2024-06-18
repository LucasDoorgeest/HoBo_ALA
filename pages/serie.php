<?php
include_once "../php/basicIncludes.php";
include_once "../php/klantOnly.php";

if (!isset($_GET["id"])) {
    header("Location: /pages/home.php");
    exit();
}

$userId = $_SESSION["user"]["KlantNr"];
$serieId = $_GET["id"];
echo "<script>const userId = $userId; const serieId = $serieId;</script>";

$head = new HeadComponent("Aflevering", 
                        ["/styles/global.css"], 
                        ["/script/slides.js", "/script/custombg.js", "/script/lazyLoad.js"]);
?>

<!DOCTYPE html>
<html lang="nl">
<?php $head->render(); ?>
<body>
<?php HeaderComponent::render(); ?>
<main>
    <div id="blurBg"></div>
    <?php echo serieCard($_GET['id']); ?>
    <h2>Seizoenen</h2>
    <?php
    $seasons = fetchSqlAll("select * from seizoen where SerieID = ?", [$_GET['id']]);
    foreach ($seasons as $key => $season) {
        $items = [];
        $episodes = fetchSqlAll("select * from aflevering where SeizID = ?", [$season["SeizoenID"]]);
        foreach ($episodes as $episode) {
            $items[] = [
                "id" => $episode["AfleveringID"],
                "title" => $episode["AflTitel"],
                "img" => getImgPathBySerieId($_GET['id']),
                "link" => "/pages/aflevering.php?id=" . $episode["AfleveringID"]
            ];
        }
        $seiz =  $key + 1;
        scrollableList("Seizoen $seiz", $items);   
    }
    ?>
</main>
<?php FooterComponent::render(); ?>
</body>
</html>