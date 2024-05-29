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
        echo $jsonArray;
        $mysqli->close();
    }

    function getDocumentFromDatabaseById($id) {
        $database = new Database();
        $mysqli = $database->getConnection();

        $query = 'SELECT fileName, data FROM documents WHERE id = ?';

        $stmt = $mysqli->prepare($query);
        if (!$stmt) {
            error_log("SQL Error: " . $mysqli->error);
            return null;
        }
        $stmt->bind_param("s", $id);
        $stmt->execute();
        $stmt->bind_result($retrievedFileName, $data);
        if ($stmt->fetch()) {
            $stmt->close();
            $mysqli->close();
            return [
                'fileName' => $retrievedFileName,
                'data' => $data
            ];
        } else {
            $stmt->close();
            $mysqli->close();
            return null;
        }
    }

    function sendPDFtoJavascript(){
        $data = json_decode(file_get_contents('php://input'), true);
        $selectedRequest = $data['selectedRequest'];
        $pdfFile = getDocumentFromDatabaseById($selectedRequest);
        header('Content-Type: application/pdf');
        echo $pdfFile;
    }
    
    // if (isset($_GET['action']) && $_GET['action'] == 'getDocumentDetails') {
    //     getDocuments();
    //     exit;
    // }
    // elseif (isset($_GET['action']) && $_GET['action'] == 'sendPDFtoJavascript') {
    //     sendPDFtoJavascript();
    //     exit;
    // }
?>
