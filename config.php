<?php

// Database configuration
$host = "mysql.pauloferreirajr.com";
$username = "gope";
$password = "gopapedrinho22";
$database = "workgope";
$port = "3306";

// Create a connection
$conn = mysqli_connect($host, $username, $password, $database);

// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

// Set the character set
mysqli_set_charset($conn, "utf8");

// Other configurations or settings can be added here