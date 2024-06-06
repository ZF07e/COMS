<?php

require ('../../../LandingPage/Functions/SessionManagement.php');
require ('../../../LandingPage/Functions/connectionDB.php');

$name;
if (!isset($_SESSION['uname']) || $_SESSION['uname'] === '') {
    $name = $_SESSION['name'] ?? '';  // Use the 'name' session variable or an empty string if 'name' is not set
} else {
    $name = $_SESSION['uname'];
}
$email = $_SESSION['email'];

$database = new Database();
$mysqli = $database->getConnection();

$query = "SELECT position FROM users WHERE email = '$email'";
$stmt = $mysqli->prepare($query);
if (!$stmt) {
    die("SQL Error: " . $mysqli->error);
}
$stmt->execute();
$stmt->bind_result($position);
$stmt->fetch();
$stmt->close();

$data = [$name, $position];

$jsonArray = json_encode($data);
header('Content-Type: application/json');

print_r($jsonArray);
?>