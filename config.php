<?php

// Database configuration
$host = "localhost";
$username = "root";
$password = "";
$database = "workgope";

// Create a connection
$conn = mysqli_connect($host, $username, $password, $database);

// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

// Set the character set
mysqli_set_charset($conn, "utf8");

// Other configurations or settings can be added here