<?php
include 'functions.php';

//check if the form submit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //retrieve form values
    $day = $_POST["day"];
    $startTime = $_POST["startTime"];
    $endTime = $_POST["endTime"];


    //Update the opening hours using the setOpeningHours function
    setOpeningHours($day, $startTime, $endTime, $openingHours);

    //save updated opening hours in JSON file
    file_put_contents('opening_hours.json', json_encode($openingHours));

    //redirect
    header("Location: index.php");
    exit();
}
?>
