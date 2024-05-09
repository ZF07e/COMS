<?php
    require("connectionDB.php");
    $outlook = $_POST["outlook"];
    $facebook = $_POST["facebook"];
    $association = $_POST["association"];

    $database = new Database();
    $mysqli = $database->getConnection();

    $insertStudent = "INSERT INTO userapplication (outlookEmail, facebookLink, associationCode) VALUES (?, ?, ?)";

    $stmt = $mysqli->stmt_init();
    if(!$stmt->prepare($insertStudent)){
        die("SQL Error". $mysqli->error);
    }
    $stmt->bind_param("sss", $outlook, $facebook, $association);
    $stmt->execute();
    echo "Account registered successfully!";
    $mysqli->close();
?>