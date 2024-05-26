<?php
    require("LandingPage/Functions/connectionDB.php");
    include("LandingPage/Functions/SessionManagement.php");

    $database = new Database();
    $mysqli = $database->getConnection();
    $affiliation = "";

    $query = "SELECT affiliation FROM users WHERE email = ?";

    $stmt = $mysqli->stmt_init();
    if (!$stmt->prepare($query)) {
        die("SQL Error: " . $mysqli->error);
    }
    $stmt->bind_param("s", $_SESSION['email']);
    $stmt->execute();
    $result = $stmt->get_result();
    $data = $result->fetch_assoc();

    if (is_array($data)) {
        $affiliation = implode($data);
    } else {
        $affiliation = $data;
    }

    if (isset($_POST['submit'])) {
        $fileName = $_FILES['image']['name'];
        $ext = pathinfo($fileName, PATHINFO_EXTENSION);
        $allowedTypes = array("jpg", "jpeg", "png");

        $tempName = $_FILES['image']['tmp_name'];
        $defaultName = $affiliation. "." . $ext;
        $targetPath = "Images/AssosiationsPfp/" . $defaultName;

        if (in_array($ext, $allowedTypes)) {
            if (move_uploaded_file($tempName, $targetPath)) {
                $query = "INSERT INTO associationimages (name, fileName) VALUES (?, ?)";
                $stmt = $mysqli->stmt_init();
                if (!$stmt->prepare($query)) {
                    die("SQL Error: " . $mysqli->error);
                }
                $stmt->bind_param("ss", $affiliation, $fileName);
                $stmt->execute();
            } else {
                echo 'File not uploaded';
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form name="file" action="insertImage.php" method="POST" enctype="multipart/form-data">
        <input type="file" name="image" />
        <input type="submit" name="submit" value="Upload">
    </form>
</body>
</html>