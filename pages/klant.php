<?php
include_once "../php/basicIncludes.php";
include_once "../php/klantOnly.php";

$head = new HeadComponent(
    "Klant",
    ["/styles/global.css"],
    []
);

$klant = fetchSql("SELECT * FROM klant LEFT JOIN abonnement ON klant.AboID = abonnement.AboID WHERE KlantNr = ?", [$_GET["id"]]);

if (isset($_GET["submit"])) {
    $query = "UPDATE klant SET Voornaam = ?, Tussenvoegsel = ?, Achternaam = ?, Genre = ?, AboID = ? WHERE KlantNr = ?";
    $params = [$_GET["Voornaam"], $_GET["Tussenvoegsel"], $_GET["Achternaam"], $_GET["Genre"], $_GET["AboID"], $_GET["id"]];
    runSql($query, $params);

    header("Location: ./klant.php?id=" . $_GET["id"]);
}

$genres = fetchSqlAll("SELECT * FROM genre", []);

?>

<!DOCTYPE html>
<html lang="nl">
<?php $head->render(); ?>

<body>
    <?php HeaderComponent::render(); ?>
    <main>
        <h1>Klant</h1>
        <p><a href="./klanten.php" class="button">Terug naar klanten</a></p>
        <section class="formWrap">
        <form>
            <input type="hidden" name="id" value="<?php echo $klant["KlantNr"] ?>">
            <table class="maxWidth">

                <tr>
                    <td><label for="Voornaam">Voornaam</label></td>
                    <td><input type="text" name="Voornaam" value="<?php echo $klant["Voornaam"] ?>"></td>
                </tr>
                <tr>
                    <td><label for="Tussenvoegsel">Tussenvoegsel</label></td>
                    <td><input type="text" name="Tussenvoegsel" value="<?php echo $klant["Tussenvoegsel"] ?>"></td>
                </tr>
                <tr>
                    <td><label for="Achternaam">Achternaam</label></td>
                    <td><input type="text" name="Achternaam" value="<?php echo $klant["Achternaam"] ?>"></td>
                </tr>
                <tr>
                    <td><label for="Genre">Genre</label></td>
                    <td>
                        <select name="Genre" id="Genre">
                            <?php
                            foreach ($genres as $genre) {
                            ?>
                                <option value="<?php echo $genre["GenreID"] ?>" <?php echo $klant["Genre"] == $genre["GenreID"] ? "selected" : "" ?>><?php echo $genre["GenreNaam"] ?></option>
                            <?php
                            }
                            ?>
                        </select>

                    </td>
                </tr>
                <tr>
                    <td><label for="AboID">AboID</label></td>
                    <td><input type="number" name="AboID" value="<?php echo $klant["AboID"] ?>"></td>
                </tr>
            </table>
            <input class="button" type="submit" name="submit" value="Submit">
        </form>

        </section>
    </main>
    <?php FooterComponent::render(); ?>
</body>

</html>