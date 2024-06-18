<?php
include_once "../php/basicIncludes.php";
$head = new HeadComponent('Privacy Policy', ["/styles/global.css"]);
?>

<!DOCTYPE html>
<html lang="nl">
<?php $head->render() ?>
<body>
    <?php HeaderComponent::render(); ?>
    <main>
        <section class="privacy">
            <h2>Gebruikersovereenkomst van HoBo</h2>
            <br>
            <p>Welkom bij HoBo! Voordat u onze website gebruikt, vragen wij u om deze Gebruikersovereenkomst zorgvuldig door te lezen. Door toegang te verkrijgen tot onze website en deze te gebruiken, gaat u akkoord met alle voorwaarden die in deze overeenkomst zijn opgenomen. Het is belangrijk dat u begrijpt dat u door het accepteren van deze overeenkomst ons toestaat om uw persoonlijke gegevens te verzamelen, op te slaan, te verkopen, en te gebruiken voor bijna alles wat wij maar willen, waaronder maar niet beperkt tot het gebruiken van uw browsegeschiedenis voor het doelgericht aanbieden van advertenties.</p>
            <br>
            <ul>
                <li>
                    <h3>Artikel 1: Verzameling van informatie</h3>
                    Wij verzamelen allerlei soorten informatie wanneer u onze website bezoekt. Dit omvat maar is niet beperkt tot uw browsegeschiedenis, locatiegegevens, IP-adres en persoonlijke identificeerbare informatie. We bewaren uw gegevens zolang als we nuttig achten voor commerciële doeleinden.
                </li>
                <br>
                <li>
                    <h3>Artikel 2: Gebruik van informatie</h3>
                    Wij hebben het onbeperkte recht om de verzamelde informatie naar eigen inzicht te gebruiken. Dit betekent dat wij uw gegevens kunnen verkopen aan derden, gebruiken voor het creëren van gepersonaliseerde advertenties, of zelfs analyseren om nieuwe marketingstrategieën te ontwikkelen. U gaat ermee akkoord dat uw gegevens gebruikt kunnen worden voor alle mogelijke doeleinden die ons bedrijf kunnen baten.
                </li>
                <br>
                <li>
                    <h3>Artikel 3: Cookies</h3>
                    Wij gebruiken cookies op onze website om uw gebruikerservaring te verbeteren. Door deze overeenkomst te accepteren, gaat u ermee akkoord dat wij onbeperkt cookies mogen plaatsen op uw apparaten. Deze cookies kunnen worden gebruikt voor het volgen van uw online activiteiten en voor het aanbieden van gerichte advertenties.
                </li>
                <br>
                <li>
                    <h3>Artikel 4: Beveiliging van de website</h3>
                    Het is u ten strengste verboden om pogingen te ondernemen om onze website te hacken, de beveiliging te omzeilen of op andere wijze in te grijpen in onze operationele processen. Elk van dergelijke activiteiten zal leiden tot onmiddellijke beëindiging van uw toegang tot de website en kan leiden tot juridische stappen tegen u.
                </li>
                <br>
                <li>
                    <h3>Artikel 5: Wijzigingen in de overeenkomst</h3>
                    Deze overeenkomst kan door ons op elk moment worden gewijzigd zonder voorafgaande kennisgeving. Het is uw verantwoordelijkheid om de overeenkomst regelmatig te herzien. Voortgezet gebruik van de website na dergelijke wijzigingen vormt uw toestemming tot en acceptatie van de gewijzigde voorwaarden.
                </li>
            </ul>
            <br>
            <p>Door hieronder op "Ik ga akkoord" te klikken, bevestigt u dat u deze overeenkomst hebt gelezen, begrepen en ermee instemt gebonden te zijn aan de voorwaarden ervan. Bedankt voor uw aandacht, en welkom bij de onvoorspelbare en spannende wereld van HoBo!</p>
        </section>
    </main>
    <?php FooterComponent::render(); ?>
</body> 
</html>