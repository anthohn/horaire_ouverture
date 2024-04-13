<?php 

// Function to check if the store is open at a given time
function isOpenOn($date)
{
    $openingHours = json_decode(file_get_contents('opening_hours.json'), true);

    $dayOfWeek = date('D', strtotime($date));

    // Check if the day of the week is present in the opening hours
    if (array_key_exists($dayOfWeek, $openingHours)) {
        $hoursOfDay = $openingHours[$dayOfWeek];
        $currentTime = strtotime(date('H:i', strtotime($date)));

        // Check if the current time is within the opening hours for this day
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

// Function to get the next opening date
function NextOpeningDate($date)
{
    $openingHours = json_decode(file_get_contents('opening_hours.json'), true);

    $nextDate = strtotime($date); // Convert the date to a timestamp
    while (true) {
        $nextDate = strtotime('+1 day', $nextDate); // Move to the next day
        $nextDayOfWeek = date('D', $nextDate);

        // Check if the next day is an opening day
        if (array_key_exists($nextDayOfWeek, $openingHours) && count($openingHours[$nextDayOfWeek]) > 0) {
            // Return the next opening date with the first opening hour of that day
            return date('Y-m-d H:i', strtotime(date('Y-m-d', $nextDate) . ' ' . $openingHours[$nextDayOfWeek][0][0]));
        }
    }
}

// Function to set the opening hours
function setOpeningHours($day, $startTime, $endTime)
{
    $openingHours = json_decode(file_get_contents('opening_hours.json'), true);

    if (!empty($startTime) && !empty($endTime)) {
        $openingHours[$day] = [[$startTime, $endTime]];
    } else {
        // If the hours are empty, it means the store is closed on that day
        $openingHours[$day] = [];
    }
    file_put_contents('opening_hours.json', json_encode($openingHours));

}
