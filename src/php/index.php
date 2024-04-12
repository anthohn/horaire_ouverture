<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Statut du magasin</title>
</head>
<body>
    <h1>Statut du magasin</h1>

    <?php
    // Inclure les fonctions
    include 'functions.php';

    // Date actuelle
    $currentDate = date('Y-m-d H:i:s');

    // Vérifier si le magasin est ouvert maintenant
    $isOpen = isOpenOn($currentDate, $openingHours);
    if ($isOpen) {
        echo '<p>Le magasin est actuellement ouvert.</p>';
    } else {
        echo '<p>Le magasin est actuellement fermé.</p>';
    }

    // Trouver la prochaine date d'ouverture
    $nextOpeningDate = nextOpeningDate($currentDate, $openingHours);
    // echo $nextOpeningDate;
    if ($nextOpeningDate) {
        echo '<p>La prochaine ouverture du magasin aura lieu le ' . date('d/m/Y à H:i', strtotime($nextOpeningDate)) . '</p>';
    } else {
        echo '<p>Il n\'y a pas de date d\'ouverture planifiée pour le moment.</p>';
    }
    ?>

</body>
</html>
