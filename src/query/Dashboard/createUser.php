<?php

// Assuming you have a database connection established
include('../../../config.php');

// Retrieve the request payload
$payload = json_decode(file_get_contents("php://input"));

// Extract the user data
$name = $payload->name;
$email = $payload->email;
$secondaryEmail = $payload->secondaryEmail;
$institution = $payload->institution;
$type = $payload->type;
$countries = $payload->countries;

// Insert the user into the database
$query = "INSERT INTO users (name, email, secondary_email, institution, type) VALUES ('$name', '$email', '$secondaryEmail', '$institution', '$type')";
$result = mysqli_query($conn, $query);

// Retrieve the user id
$userId = mysqli_insert_id($conn);

// Insert the user's country relations into the database
foreach ($countries as $country) {
  $countryId = $country->countryId;
  $mainUser = $country->mainUser;
  $mainUser = $mainUser === 'true' ? 1 : 0;
  $query = "INSERT INTO user_country_relations (user_id, country_id, main_user) VALUES ('$userId', '$countryId', '$mainUser')";
  $result = mysqli_query($conn, $query);
}

// Close the database connection
mysqli_close($conn);
