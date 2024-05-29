<?php
    require ('../../LandingPage/Functions/SessionManagement.php');
    require ('../../LandingPage/Functions/connectionDB.php');

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

    if (isset($_GET['id'])) {
        $requestedId = $_GET['id'];

        if ($requestedId) {
            $document = getDocumentFromDatabaseById($requestedId);

            if ($document) {
                // Serve the document as a download
                header('Content-Type: application/vnd.openxmlformats-officedocument.wordprocessingml.document');
                header('Content-Disposition: attachment; filename="' . $document['fileName'] . '"');
                header('Content-Length: ' . strlen($document['data']));
                echo $document['data'];
                exit;
            } else {
                echo "Document not found.";
            }
        } else {
            echo "No ID provided.";
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Download Document</title>
</head>
<body>
    <h1>Download Document</h1>
    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="GET">
        <label for="id">Enter Document ID:</label>
        <input type="text" id="id" name="id" placeholder="Enter document ID...">
        <button type="submit">Download</button>
    </form>
</body>
</html>