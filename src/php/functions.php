<?php 

$openingHours = json_decode(file_get_contents('opening_hours.json'), true);

// Fonction pour vérifier si la boutique est ouverte à un moment donné
function isOpenOn($date, $openingHours)
{
    $dayOfWeek = date('D', strtotime($date));

    // Vérifier si le jour de la semaine est présent dans les heures d'ouverture
    if (array_key_exists($dayOfWeek, $openingHours)) {
        $hoursOfDay = $openingHours[$dayOfWeek];
        $currentTime = strtotime(date('H:i', strtotime($date)));

        // Vérifier si le temps actuel est compris dans les heures d'ouverture pour ce jour
        foreach ($hoursOfDay as $hours) {
            $startTime = strtotime($hours[0]);
            $endTime = strtotime($hours[1]);
            if ($currentTime >= $startTime && $currentTime <= $endTime) {
                return true;
            }
        }
    }
    return false;
}

function NextOpeningDate($date, $openingHours)
{
    $nextDate = strtotime($date); // Convertir la date en timestamp
    while (true) {
        $nextDate = strtotime('+1 day', $nextDate); // Avancer d'un jour
        $nextDayOfWeek = date('D', $nextDate);

        // Vérifier si le jour suivant est un jour d'ouverture
        if (array_key_exists($nextDayOfWeek, $openingHours) && count($openingHours[$nextDayOfWeek]) > 0) {
            // Retourner la prochaine date d'ouverture avec la première heure d'ouverture de ce jour
            return date('Y-m-d H:i', strtotime(date('Y-m-d', $nextDate) . ' ' . $openingHours[$nextDayOfWeek][0][0]));
        }
    }
}


// Fonction pour modifier les heures d'ouverture
function setOpeningHours($day, $startTime, $endTime, &$openingHours)
{
    if (!empty($startTime) && !empty($endTime)) {
        $openingHours[$day] = [[$startTime, $endTime]];
    } else {
        // Si les heures sont vides, cela signifie que le magasin est fermé ce jour-là
        $openingHours[$day] = [];
    }
}