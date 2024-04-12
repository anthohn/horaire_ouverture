<!DOCTYPE html>
<html>
<head>
    <title>Horaires d'ouverture de la boutique</title>
</head>
<body>
<?php

// Inclure les fonctions
include 'function.php';


// Exemple d'utilisation
$openingHours = "Mon, Wed, Fri 08:00 - 12:00\nTue, Thu, Sat 08:00 - 12:00\nTue, Thu 14:00 - 18:00";
$parsedHours = parseOpeningHours($openingHours);


// Date actuelle
$currentDate = date('Y-m-d H:i:s');

// Vérifier si la boutique est ouverte actuellement
$isShopOpen = IsOpenOn($currentDate, $parsedHours);

// Trouver la prochaine date d'ouverture
$nextOpeningDate = NextOpeningDate($currentDate, $parsedHours);

echo "<h1>Statut de la boutique</h1>";
echo $currentDate;
echo "<p>La boutique est actuellement ";
echo $isShopOpen ? "ouverte." : "fermée.";
echo "</p>";

if (!$isShopOpen && $nextOpeningDate) {
    echo "<p>Prochaine ouverture : $nextOpeningDate</p>";
}
?>
</body>
</html>
