<?php
include("../../../config.php");

// Retrieve the request payload
$requestPayload = json_decode(file_get_contents('php://input'), true);

// Extract the userId and countryId from the payload
$userId = $requestPayload['userId'];
$countryId = $requestPayload['countryId'];

// Perform the necessary operations to delete the user-country relation
// ...
$sql = "DELETE FROM user_country_relations WHERE id_user = '$userId' AND id_country = '$countryId'";
$result = mysqli_query($conn, $sql);

// Return the result
if ($result) {
  echo "Success" . $sql . "<br>" . mysqli_affected_rows($conn);
} else {
  echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}
