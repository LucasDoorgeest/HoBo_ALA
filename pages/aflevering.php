<?php
include_once "../php/basicIncludes.php";
include_once "../php/klantOnly.php";
if (!isset($_GET["id"])) {
    header("Location: /pages/home.php");
    exit();
}

$head = new HeadComponent("Aflevering", 
                        ["/styles/global.css"], 
                        ["/script/slides.js", "/script/aflevering.js"]);

$klantID = $_SESSION["user"]["KlantNr"];
$aflID = $_GET['id'];
$serieID = getSerieIdByAflId($_GET['id']);
echo "<script>const klantID = $klantID; const aflID = $aflID; const serieID = $serieID;</script>";
?>

<!DOCTYPE html>
<html lang="nl">
<?php $head->render(); ?>
<?php headerBlock(); ?>
<main>
    <div id="blurBg"></div>
    <?php 
        echo afleveringCard($_GET['id']); 
        $serieID = getSerieIdByAflId($_GET['id']);
        echo serieCard($serieID);
    
    
    
    ?>

</main>
<?php footer(); ?>
</body>