<?php

// Check if all required fields are provided
if (empty($_POST["name"])) {
    die("Name is required");
}

if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
    die("Valid email is required");
}

if (empty($_POST["phone"])) {
    die("Phone number is required");
}

if (empty($_POST["message"])) {
    die("Message is required");
}

// Include the database connection file
$mysqli = require __DIR__ . "/database.php";

// Prepare the SQL statement
$sql = "INSERT INTO user (name, email, phone, message) VALUES (?, ?, ?, ?)";
$stmt = $mysqli->prepare($sql);

// Check if the SQL statement preparation was successful
if (!$stmt) {
    die("SQL error: " . $mysqli->error);
}

// Bind parameters to the prepared statement
$stmt->bind_param("ssss", $_POST["name"], $_POST["email"], $_POST["phone"], $_POST["message"]);

// Execute the prepared statement
if ($stmt->execute()) {
    echo "Data inserted successfully.";
} else {
    echo "Error inserting data: " . $stmt->error;
}

// Close the statement and database connection
$stmt->close();
$mysqli->close();
?>
