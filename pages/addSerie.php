<?php
include_once "../php/basicIncludes.php";
include_once "../php/adminOnly.php";
$head = new HeadComponent(
    "Serie toevoegen",
    ["/styles/global.css"],
    []
);

$genres = fetchSqlAll("SELECT * FROM genre", []);

if (isset($_GET["submit"])) {
    $SerieTitel = $_GET["SerieTitel"];
    $IMDBLink = $_GET["IMDBLink"];

    if (!isset($_GET["genre"])) {
        $_GET["genre"] = [];
    }
    $genres = $_GET["genre"];

    $query = "INSERT INTO serie (SerieTitel, IMDBLink) VALUES (?, ?)";
    $serieID = runSql($query, [$SerieTitel, $IMDBLink], true);

    foreach ($genres as $genre) {
        $query = "INSERT INTO serie_genre (SerieID, GenreID) VALUES (?, ?)";
        runSql($query, [$serieID, $genre]);
    }

    header("Location: ./editSerie.php?id=$serieID");
}

?>

<!DOCTYPE html>
<html lang="nl">
<?php $head->render(); ?>
<body>
    <?php HeaderComponent::render(); ?>
    <main>
        <h1>Serie toevoegen</h1>
        <p><a href="./beheer.php" class="button">Terug naar overzich</a></p>

        <form class="form">
            <table class="maxWidth">

                <tr>
                    <td><label for="SerieTitel">SerieTitel</label></td>
                    <td><input type="text" name="SerieTitel"></td>
                </tr>
                <tr>
                    <td><label for="IMDBLink">IMDBLink</label></td>
                    <td><input type="text" name="IMDBLink"></td>
                </tr>
                <tr>
                    <td><label for="Genres">Genre/s</label></td>
                    <td>
                    <section class="genresSelect">
                            <?php
                            foreach ($genres as $genre) {
                                ?>
                                <input id="genre-<?php echo $genre["GenreID"] ?>" type="checkbox" name="genre[]" value="<?php echo $genre["GenreID"] ?>">
                                <label class="button" for="genre-<?php echo $genre["GenreID"] ?>"><?php echo $genre["GenreNaam"] ?></label>              
                                <?php
                            }
                            ?>
                        </section>
                    </td>
                    
                </tr>
            </table>
            <input name="submit" class="button" type="submit" value="Opslaan">
        </form>
    </main>
    <?php FooterComponent::render(); ?>
</body>

