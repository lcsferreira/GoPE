<?php
include '../../../config.php';

$id = $_GET['id'];

$payload = $_POST['payload'];
$docInc = $payload['docInc'];
$tableName = $payload['tableName'];
$input = $payload['inputName'];
$value = $payload['value'];

// Use prepared statements to update the record
$stmt = $conn->prepare("UPDATE $tableName SET $input = ? WHERE id_country = ? AND inc = ?");
$stmt->bind_param("sii", $value, $id, $docInc);

if ($stmt->execute()) {
    echo "Success";
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
mysqli_close($conn);