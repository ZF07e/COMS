<?php
    require ('connectionDB.php');
    require ('SessionManagement.php');

// getUserAssociation();

// function getUserAssociation(){
//     if(!isset($_POST["submit"])){
$database = new Database();
$mysqli = $database->getConnection();

$email = $_SESSION['email'];

$sql = "SELECT position FROM users WHERE email = ?";
$stmt = $mysqli->prepare($sql);
if ($stmt) {
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->bind_result($position);
    $stmt->fetch();
    $stmt->close();

    $jsonArray = json_encode($position);
    header('Content-Type: application/json');
    echo $jsonArray;

} else {
    // Handle error
    echo "Error preparing statement: " . $mysqli->error;
    return null;
}
$mysqli->close();
    // }
// }

?>