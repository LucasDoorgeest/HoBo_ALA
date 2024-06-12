<?php
include_once "../php/basicIncludes.php";
include_once "../php/klantOnly.php";
if (!isset($_GET["id"])) {
    header("Location: /pages/home.php");
    exit();
}

$klantID = $_SESSION["user"]["KlantNr"];
$aflID = $_GET['id'];
$serieID = getSerieIdByAflId($_GET['id']);


$afl = getAfleveringByID($aflID);
$serie = getSerieByID($serieID);
$head = new HeadComponent($serie["SerieTitel"] . " - " . $afl["AflTitel"],
                        ["/styles/global.css"], 
                        ["/script/slides.js", "/script/aflevering.js", "/script/custombg.js", "/script/lazyLoad.js"]);
echo "<script>const klantID = $klantID; const aflID = $aflID; const serieID = $serieID;</script>";
?>

<!DOCTYPE html>
<html lang="nl">
<?php $head->render(); ?>
<body>
    <?php HeaderComponent::render(); ?>
    <main>
        <div id="blurBg"></div>
        <?php 
            $serieID = getSerieIdByAflId($_GET['id']);
            echo serieCard($serieID);

            echo afleveringCard($_GET['id']); 
        ?>
    </main>
    <?php FooterComponent::render(); ?>
</body>
</html>