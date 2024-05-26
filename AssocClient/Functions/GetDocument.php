<?php
    require ('../../LandingPage/Functions/SessionManagement.php');
    require ('../../LandingPage/Functions/connectionDB.php');

    function getDocumentFromDatabaseByFilename($fileName) {
        $database = new Database();
        $mysqli = $database->getConnection();

        $query = 'SELECT fileName, data FROM documents WHERE fileName = ?';
        
        $stmt = $mysqli->prepare($query);
        if (!$stmt) {
            die("SQL Error: " . $mysqli->error);
        }
        $stmt->bind_param("s", $fileName);
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

    //$requestedFileName = 'Finalized-Coders Club-May-25-2024.docx';

    if(isset($_GET['fileName'])) {
        $requestedFileName = $_GET['fileName'];

        if ($requestedFileName) {
            $document = getDocumentFromDatabaseByFilename($requestedFileName);

            if ($document) {
                // Serve the document as a download
                header('Content-Type: application/octet-stream');
                header('Content-Disposition: attachment; filename="' . $document['fileName'] . '"');
                echo $document['data'];
                exit;
            } else {
                echo "Document not found.";
            }
        } else {
            echo "No filename provided.";
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
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="GET">
        <label for="fileName">Enter Filename:</label>
        <input type="text" id="fileName" name="fileName" placeholder="Enter filename...">
        <button type="submit">Download</button>
    </form>
</body>
</html>