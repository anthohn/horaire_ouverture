<?php

include 'functions.php';

// Definition of dates to validate
$dates = [
    'wednesday' => '2024-02-21T07:45:00.000',
    'thursday' => '2024-02-22T12:22:11.824',
    'saturday' => '2024-02-24T09:15:00.000',
    'sunday' => '2024-02-25T09:15:00.000',
    'friday_morning' => '2024-02-23T08:00:00.000',
    'monday_morning' => '2024-02-26T08:00:00.000',
    'thursday_afternoon' => '2024-02-22T14:00:00.000'
];

// Assertions to validate the functions
assert(IsOpenOn($dates['wednesday']) === false);
assert(IsOpenOn($dates['thursday']) === false);
assert(IsOpenOn($dates['sunday']) === false);

assert(NextOpeningDate($dates['thursday_afternoon']) === '2024-02-23 08:00');
assert(NextOpeningDate($dates['saturday']) === '2024-02-26 08:00');
assert(NextOpeningDate($dates['thursday']) === '2024-02-23 08:00');


// New set of operations to validate SetOpeningHours function
$dates2 = [
    'monday' => '2024-02-26T10:20:00.000',
    'wednesday' => '2024-02-21T07:45:00.000',
    'saturday' => '2024-02-24T19:50:00.000',
    'sunday' => '2024-02-25T09:15:00.000',
];

// Set the opening hours according to the instructions
SetOpeningHours("Mon", "", "");
SetOpeningHours("Wed", "07:30", "15:45");
SetOpeningHours("Sat", "07:30", "20:00");
SetOpeningHours("Sun", "09:00", "10:15");


// Check the validity of the set opening hours
assert(IsOpenOn($dates2['monday']) === false);
assert(IsOpenOn($dates2['wednesday']) === true);
assert(IsOpenOn($dates2['saturday']) === true);
assert(IsOpenOn($dates2['sunday']) === true);


echo "All assertions have been successfully validated.";

?>
