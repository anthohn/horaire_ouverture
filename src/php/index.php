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

        date_default_timezone_set('Europe/Zurich');

        print_r($openingHours);

        // Date actuelle
        $currentDate = date('Y-m-d H:i:s');

        echo $currentDate;

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
        <form action="update_opening_hours.php" method="post">
            <label for="day">Jour de la semaine:</label>
            <select name="day" id="day">
                <option value="Mon">Lundi</option>
                <option value="Tue">Mardi</option>
                <option value="Wed">Mercredi</option>
                <option value="Thu">Jeudi</option>
                <option value="Fri">Vendredi</option>
                <option value="Sat">Samedi</option>
                <option value="Sun">Dimanche</option>
            </select><br><br>
            <label for="startTime">Heure d'ouverture:</label>
            <input type="time" id="startTime" name="startTime"><br><br>
            <label for="endTime">Heure de fermeture:</label>
            <input type="time" id="endTime" name="endTime"><br><br>
            <input type="submit" value="Mettre à jour">
        </form>
    </body>
</html>
