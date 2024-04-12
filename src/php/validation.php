<?php

// Content of validation.php

include 'functions.php';

// Definition of dates to validate
$dates = [
    'wednesday' => '2024-02-21T07:45:00.000',
    'thursday' => '2024-02-22T12:22:11.824',
    'saturday' => '2024-02-24T09:15:00.000',
    'sunday' => '2024-02-25T09:15:00.000',
    'friday_morning' => '2024-02-23T08:00:00.000',
    'monday_morning' => '2024-02-26T08:00:00.000',
    'thursday_afternoon' => '2024-02-2  2T14:00:00.000',
];

// Assertions to validate the functions
assert(IsOpenOn($dates['wednesday'], $openingHours) === false);
assert(IsOpenOn($dates['thursday'], $openingHours) === false);
assert(IsOpenOn($dates['sunday'], $openingHours) === false);

assert(NextOpeningDate($dates['thursday_afternoon'], $openingHours) === '2024-02-23 08:00');
assert(NextOpeningDate($dates['saturday'], $openingHours) === '2024-02-26 08:00');
assert(NextOpeningDate($dates['thursday'], $openingHours) === '2024-02-23 08:00');

echo "Toutes les assertions ont été vérifiées avec succès.";

?>
