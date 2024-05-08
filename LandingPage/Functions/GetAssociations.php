<?php
    require ("connectionDB.php");

    $database = new Database();
    $mysqli = $database->getConnection();

    $query = "SELECT * FROM associations";
    $result = $mysqli->query($query);

    $data = array();
    while ($row = $result->fetch_assoc()) {
        
        $data[] = $row;
    }

    $jsonArray = json_encode($data);
    header('Content-Type: application/json');

    echo $jsonArray;
?>