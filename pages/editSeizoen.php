<?php
include_once "../php/basicIncludes.php";
include_once "../php/seizoenEdit.php";
include_once "../php/adminOnly.php";

$head = new HeadComponent(
    "Edit seizoen",
    ["/styles/global.css"],
    ["/script/removeAfl.js"]
);

if (isset($_GET["submit"])) {
    handleSeizoenEditRequest($_GET);
} else if (!isset($_GET["id"])) {
    header("Location: /pages/beheer.php");
}

$seizoen = fetchSql("SELECT * FROM seizoen WHERE SeizoenID = ?", [$_GET["id"]]);
$serie = fetchSql("SELECT * FROM serie WHERE SerieID = ?", [$seizoen["SerieID"]]);
$afleveringen = fetchSqlAll("SELECT * FROM aflevering WHERE SeizID = ?", [$_GET["id"]]);

?>

<!DOCTYPE html>
<html lang="nl">
<?php $head->render(); ?>
<body>
    <?php HeaderComponent::render(); ?>
    <main>
        <h1>Edit Seizoen</h1>
        <p><a href="./editSerie.php?id=<?php echo $seizoen["SerieID"] ?>" class="button">Terug naar serie</a></p>
        <h2><?php echo $serie["SerieTitel"] ?> - Seizoen <?php echo $seizoen["Rang"] ?></h2>

        <form action="">
            <input type="hidden" name="id" value="<?php echo $seizoen["SeizoenID"] ?>">
            <table class="maxWidth">
                <tr>
                    <td><label for="IMDBRating">IMDBRating</label></td>
                    <td><input type="number" name="IMDBRating" value="<?php echo $seizoen["IMDBRating"] ?>"></td>
                </tr>
            </table>
            <section class="afleveringenEdit">
                <h2>Afleveringen editen</h2>
                <?php
                foreach ($afleveringen as $aflevering) {
                    ?>
                    <section class="afleveringEdit">
                        <input type="hidden" name="afleveringID[]" value="<?php echo $aflevering["AfleveringID"] ?>">
                        <input class="d-none removeCheckbox" type="hiden" name="delete[]" id="delete-<?php echo $aflevering["AfleveringID"] ?>" value="0">
                        <table class="maxWidth">
                            <tr>
                                <td><label for="AflTitel">AflTitel</label></td>
                                <td><input type="text" name="AflTitel[]" value="<?php echo $aflevering["AflTitel"] ?>"></td>
                            </tr>
                            <tr>
                                <td><label for="Duur">Duur</label></td>
                                <td>
                                    <input type="number" name="Duur[]" value="<?php echo $aflevering["Duur"] ?>">
                                    <label for="delete-<?php echo $aflevering["AfleveringID"] ?>">Verwijderen</label>
                                </td>
                            </tr>
                        </table>
                    </section>
                    <?php
                }
                ?>
            </section>
            <input name="submit" class="button" type="submit" value="Opslaan">
            <input name="submit" class="button" type="submit" value="Seizoen verwijderen">
        </form>
        <form action="../php/addAfl.php">
            <input type="hidden" name="SeizoenID" value="<?php echo $seizoen["SeizoenID"] ?>">
            <input type="hidden" name="Rang" value="<?php echo count($afleveringen) + 1 ?>">
            <section>
                <h2>Aflevering toevoegen</h2>
                <table class="maxWidth">
                    <tr>
                        <td><label for="AflTitel">AflTitel</label></td>
                        <td><input type="text" name="AflTitel"></td>
                    </tr>
                    <tr>
                        <td><label for="Duur">Duur</label></td>
                        <td><input type="number" name="Duur"></td>
                    </tr>
                </table>
                <input name="submit" class="button" type="submit" value="Toevoegen">
            </section>
        </form>
    </main>
    <?php FooterComponent::render(); ?>
</body>

