<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/db/db.php');

// Function to sanitize form data
function clean_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

// If the search form has not been submitted, display all available rides
$sql = "SELECT rides.*, users.username 
            FROM rides 
            JOIN users ON rides.user_id = users.id";

    $result = $conn->query($sql);
