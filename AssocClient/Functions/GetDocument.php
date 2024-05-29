<?php
    require ('../../LandingPage/Functions/SessionManagement.php');
    require ('../../LandingPage/Functions/connectionDB.php');

    function getDocuments() {
        $database = new Database();
        $mysqli = $database->getConnection();

        $query = 'SELECT id, sender, status, subject, filename, htmlContent, DATE(timestamp) as date_only FROM documents';
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
        echo $jsonArray;
        $mysqli->close();
    }
    function getRecipient(){
        $database = new Database();
        $mysqli = $database->getConnection();
        $id = $_POST['selectedID'];

        // $query = 'SELECT htmlContent FROM documents WHERE id = ?';

        // $stmt = $mysqli->prepare($query);
        // if ($stmt) {
        //     $stmt->bind_param("s", $id);
        //     $stmt->execute();
        //     $stmt->bind_result($htmlcontent);
        //     $stmt->fetch();
        //     $stmt->close();
        //     return $htmlcontent;
        // } else {
        //     // Handle error
        //     echo "Error preparing statement: " . $mysqli->error;
        //     return null;
        // }
        // $mysqli->close();
        echo $id;
    }

    function selectAllUsers(){
        $database = new Database();
        $mysqli = $database->getConnection();
    }

    if (isset($_GET['action']) && $_GET['action'] == 'getDocumentDetails') {
        getDocuments();
        exit();
    }
?>