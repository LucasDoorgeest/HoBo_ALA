<?php
include_once "../php/basicIncludes.php";
include_once "../php/serieEdit.php";
include_once "../php/adminOnly.php";

$head = new HeadComponent(
    "Edit Serie",
    ["/styles/global.css"],
    []
);

if (isset($_GET["submit"])) {
    handleSerieEditRequest($_GET);
} else if (!isset($_GET["id"])) {
    header("Location: /pages/beheer.php");
}  

$serie = fetchSql("SELECT * FROM serie WHERE SerieID = ?", [$_GET["id"]]);
$genres = fetchSqlAll("SELECT * FROM genre", []);
$seizoenen = fetchSqlAll("SELECT * FROM seizoen WHERE SerieID = ?", [$_GET["id"]]);

$serieGenres = fetchSqlAll("SELECT * FROM serie inner join serie_genre on serie.SerieID = serie_genre.SerieID where serie.SerieID = ?", [$_GET["id"]]);
$serieGenres = array_map(function ($serieGenres) {
    return $serieGenres["GenreID"];
}, $serieGenres);
?>


<!DOCTYPE html>
<html lang="nl">
<?php $head->render(); ?>
<body>
    <?php HeaderComponent::render(); ?>
    <main>
        <h1>Edit Serie</h1>

        <form action="">
            <input type="hidden" name="id" value="<?php echo $serie["SerieID"] ?>">
            <table class="maxWidth">

                <tr>
                    <td><label for="SerieTitel">SerieTitel</label></td>
                    <td><input type="text" name="SerieTitel" value="<?php echo $serie["SerieTitel"] ?>"></td>
                </tr>
                <tr>
                    <td><label for="IMDBLink">IMDBLink</label></td>
                    <td><input type="text" name="IMDBLink" value="<?php echo $serie["IMDBLink"] ?>"></td>
                </tr>
                <tr>
                    <td><label for="Genres">Genre/s</label></td>
                    <td>
                    <section class="genresSelect">
                            <?php
                            foreach ($genres as $genre) {
                                ?>
                                <input id="genre-<?php echo $genre["GenreID"] ?>" type="checkbox" name="genre[]" value="<?php echo $genre["GenreID"] ?>" <?php echo in_array($genre["GenreID"], $serieGenres) ? "checked" : "" ?>>
                                <label class="button" for="genre-<?php echo $genre["GenreID"] ?>"><?php echo $genre["GenreNaam"] ?></label>              
                                <?php
                            }
                            ?>
                        </section>
                    </td>
                    
                </tr>
            </table>
            <input name="submit" class="button" type="submit" value="Opslaan">
            <input name="submit" class="button" type="submit" value="Verwijderen">


            <section class="seizoenenSelect">
                <h2>Seizoenen editen</h2>
                <?php
                foreach ($seizoenen as $seizoen) {
                    ?>
                    <a class="button" href="/pages/editSeizoen.php?id=<?php echo $seizoen["SeizoenID"] ?>">
                        Edit seizoen <?php echo $seizoen["Rang"] ?>
                    </a>          
                    <?php
                }
                ?>
        </section>
        </form>

        <section>
            <h2>Seizoen toevoegen</h2>

            <form action="../php/addSeizoen.php">
                <input type="hidden" name="SerieID" value="<?php echo $serie["SerieID"] ?>">
                <input type="hidden" name="Rang" value="<?php echo count($seizoenen) + 1 ?>">
                <table class="maxWidth">
                    <tr>
                        <td><label for="IMDBRating">IMDBRating</label></td>
                        <td><input type="number" name="IMDBRating"></td>
                    </tr>
                    <tr>
                        <td><label for="Rang">SeizoenNummer</label></td>
                        <td><input type="number" name="Rang"></td>
                    </tr>
                </table>
                <input name="submit" class="button" type="submit" value="Opslaan">
            
        </section>
    </main>
    <?php FooterComponent::render(); ?>
</body>