<?php
    require ('../../LandingPage/Functions/SessionManagement.php');
    require ('../../LandingPage/Functions/connectionDB.php');

    function getDocuments() {
        $database = new Database();
        $mysqli = $database->getConnection();
        $email = $_SESSION['email'];
        $assocCode;

        $query = "SELECT associationCode FROM users WHERE email = ?";

        $stmt = $mysqli->stmt_init();
        if(!$stmt->prepare($query)){
            die("SQL Error". $mysqli->error);
        }
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        $data = $result->fetch_assoc();

        if(gettype($data) == "array"){
            $assocCode = implode($data);
        }else{
            $assocCode = $data;
        }

        $query = "SELECT id, sender, status, subject, filename, htmlContent, DATE(timestamp) as date_only 
                    FROM documents
                    WHERE id LIKE CONCAT('LTTR', '$assocCode', '%')";
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
    
    function getRecipient($id) {
        $database = new Database();
        $mysqli = $database->getConnection();

        $query = "SELECT * FROM recipients WHERE documentID = '$id'";

        $data = array();
    
        if ($stmt = $mysqli->prepare($query)) {
            $stmt->execute();
            $result = $stmt->get_result();
            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            }
            $stmt->close();
        } else {
            $data = array('error' => 'Failed to prepare the SQL statement');
        }

        if (empty($data)) {
            $data = array('error' => 'No recipients found for the provided documentID');
        }
    
        $jsonArray = json_encode($data);
        header('Content-Type: application/json');
        echo $jsonArray;
        $mysqli->close();
    }

    if (isset($_GET['action']) && $_GET['action'] == 'getDocumentDetails') {
        getDocuments();
        exit();
    }
    elseif (isset($_POST['selectedID'])) {
        $selectedID = $_POST['selectedID'];
        getRecipient($selectedID);
    }
?>