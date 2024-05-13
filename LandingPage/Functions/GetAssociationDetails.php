<?php
    require ("connectionDB.php");

    function getAssociation(){
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

        print_r($jsonArray);
        $mysqli->close();
    }

    function getUserPositions(){
        $database = new Database();
        $mysqli = $database->getConnection();

        $query = "SELECT * FROM users";
        $result = $mysqli->query($query);

        $data = array();
        while ($row = $result->fetch_assoc()) {
            
            $data[] = $row;
        }

        $jsonArray = json_encode($data);
        header('Content-Type: application/json');

        print_r($jsonArray);
        $mysqli->close();
    }

    function getMembers(){
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

        print_r($jsonArray);
        $mysqli->close();
    }

    if($_GET['action'] == 'getAssociationList'){
        getAssociation();
    }
    elseif($_GET['action'] == 'getUserPositions'){
        getUserPositions();
    }
?>