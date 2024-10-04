<?php

// Assuming you have a database connection established
include '../../../config.php';

// Retrieve the request payload
$payload = $_POST['payload'];

$name = $payload['name'];
$email = $payload['email'];
$secondaryEmail = $payload['secondaryEmail'];
$institution = $payload['institution'];
$type = $payload['type'];
if (isset($payload['countries'])) {
    $countries = $payload['countries'];
} else {
    $countries = [];
}

// Prepare and bind
$stmt = $conn->prepare("INSERT INTO users (name, email, secondary_email, institution, type) VALUES (?, ?, ?, ?, ?)");
$stmt->bind_param("sssss", $name, $email, $secondaryEmail, $institution, $type);

// Execute the statement
$stmt->execute();

// Retrieve the user id
$userId = $stmt->insert_id;

// Close the statement
$stmt->close();

// if countries length is 0, close the database connection and return
if ($countries !== []) {
    // Use prepared statements to insert new country relations
    $stmt = $conn->prepare("INSERT INTO user_country_relations (id_user, id_country, is_main) VALUES (?, ?, ?)");
    foreach ($countries as $country) {
        $countryId = $country['countryId'];
        $isMain = $country['mainUser'] === "true" ? 1 : 0;
        $stmt->bind_param("iii", $id, $countryId, $isMain);
        $stmt->execute();
    }
    $stmt->close();
}

echo "Success";

mysqli_close($conn);
?>