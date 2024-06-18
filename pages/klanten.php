<?php
include_once "../php/basicIncludes.php";
include_once "../php/adminOnly.php";

$head = new HeadComponent(
    "Klanten",
    ["/styles/global.css"],
    []
);

$klanten = fetchSqlAll("SELECT * FROM klant LEFT JOIN abonnement ON klant.AboID = abonnement.AboID", []);

?>

<!DOCTYPE html>
<html lang="nl">
<?php $head->render(); ?>
<body>
    <?php HeaderComponent::render(); ?>
    <main>
        <h1>Klanten</h1>
        <table class="klantenBeheer">
            <tr>
                <th>KlantNr</th>
                <th>Naam</th>
                <th>Abo</th>
                <th>Bewerken</th>
            </tr>
            <?php
                foreach ($klanten as $klant) { ?>
                    <tr>
                        <td><?php echo $klant["KlantNr"] ?></td>
                        <td><?php echo $klant["Voornaam"] . " " . $klant["Tussenvoegsel"] . " " . $klant["Achternaam"] ?></td>
                        <td><?php echo $klant["AboNaam"] ?></td>
                        <td><a class="button" href="/pages/klant.php?id=<?php echo $klant["KlantNr"] ?>">Edit</a></td>
                    </tr>
                    <?php
                }
            ?>
        </table>  
    </main>
    <?php FooterComponent::render(); ?>
</body>
</html>

