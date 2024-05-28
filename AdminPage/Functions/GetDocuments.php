<?php
    require ('../../LandingPage/Functions/connectionDB.php');
    
    function getDocuments() {
        $database = new Database();
        $mysqli = $database->getConnection();
    
        $query = 'SELECT id, sender, status, subject, filename, DATE(timestamp) as date_only FROM documents';
        $result = $mysqli->query($query);
    
        if (!$result) {
            die("SQL Error (query): " . $mysqli->error);
        }
    
        $documents = [];
        while ($row = $result->fetch_assoc()) {
            $documents[] = $row;
        }
        
        $jsonArray = json_encode($documents);
        header('Content-Type: application/json');
        print_r($jsonArray);
        $mysqli->close();
    }

    if($_GET['action'] == 'getDocumentDetails'){
        getDocuments();
    }
?>