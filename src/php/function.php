<?php 

function parseOpeningHours($openingHours)
{
    $parsedHours = [];

    // Séparer chaque ligne de l'entrée
    $lines = explode("\n", $openingHours);

    // Parcourir chaque ligne
    foreach ($lines as $line) {
        // Supprimer les espaces en trop
        $line = trim($line);

        // Ignorer les lignes vides
        if (empty($line)) {
            continue;
        }

        // Séparer le jour de la semaine et les heures
        preg_match('/^([A-Za-z, ]+) ([0-9]{2}:[0-9]{2}) - ([0-9]{2}:[0-9]{2})$/', $line, $matches);

        if (count($matches) == 4) {
            $days = explode(",", $matches[1]);
            $startTime = $matches[2];
            $endTime = $matches[3];

            foreach ($days as $day) {
                $parsedHours[trim($day)] = [
                    'start' => $startTime,
                    'end' => $endTime
                ];
            }
        }
    }

    return $parsedHours;
}

// Fonction pour vérifier si la boutique est ouverte à un moment donné
function IsOpenOn($date, $parsedHours)
{
    // Convertir la date en jour de la semaine
    $dayOfWeek = date('D', strtotime($date));

    // Vérifier si la journée est dans les horaires d'ouverture
    if (array_key_exists($dayOfWeek, $parsedHours)) {
        $openingHours = $parsedHours[$dayOfWeek];
        $openingTime = strtotime($openingHours['start']);
        $closingTime = strtotime($openingHours['end']);
        $currentTime = strtotime(date('H:i', strtotime($date)));

        // Vérifier si l'heure actuelle est comprise entre les heures d'ouverture et de fermeture
        if ($currentTime >= $openingTime && $currentTime <= $closingTime) {
            return true;
        }
    }

    return false;
}

// Fonction pour trouver la prochaine date d'ouverture
function NextOpeningDate($date, $parsedHours)
{
    $nextOpeningDate = null;
    $currentDay = date('D', strtotime($date));
    $currentTime = strtotime(date('H:i', strtotime($date)));

    // Parcourir les jours suivants
    for ($i = 1; $i <= 7; $i++) {
        $nextDay = date('D', strtotime($date . " + $i days"));

        // Vérifier si le jour suivant est un jour d'ouverture
        if (array_key_exists($nextDay, $parsedHours)) {
            $nextOpeningHours = $parsedHours[$nextDay];
            $nextOpeningTime = strtotime($nextOpeningHours['start']);

            // Si l'heure actuelle est après l'heure d'ouverture, la prochaine date d'ouverture est le jour suivant
            if ($currentTime > $nextOpeningTime) {
                $nextOpeningDate = date('Y-m-d H:i:s', strtotime($date . " + $i days"));
                break;
            } else {
                $nextOpeningDate = date('Y-m-d', strtotime($date));
            }
        }
    }

    return $nextOpeningDate;
}