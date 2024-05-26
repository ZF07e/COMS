<?php
    require("./LandingPage/Functions/connectionDB.php");
    include ("./LandingPage/Functions/SessionManagement.php");

    function getUserAssociation(){
        $database = new Database();
        $mysqli = $database->getConnection();

        $query = 'SELECT affiliation FROM users WHERE email = ?';
        $email = $_SESSION['email'];
        $affiliation;

        $stmt = $mysqli->stmt_init();
        if(!$stmt->prepare($query)){
            die("SQL Error". $mysqli->error);
        }
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $result = $stmt->get_result();
        $data = $result->fetch_assoc();

        if(gettype($data) == "array"){
            $affiliation = implode($data);
        }
        else{
            $affiliation = $data;
        }
        $stmt->close();
        $mysqli->close(); 

        return $affiliation;
    }

    $assocication = getUserAssociation();
    if (isset($_POST["upload"])) {
        $fileName = $_FILES["image"]["name"];
        $ext = pathinfo($fileName, PATHINFO_EXTENSION);
        $allowedTypes = array("jpg", "jpeg", "png", "gif");

        $defaultName = $assocication.".".$ext;
        $tempName = $_FILES["image"]["tmp_name"];
        $targetPath = "./Images/AssosiationsPfp/".$defaultName;

        $database = new Database();
        $mysqli = $database->getConnection();

        if (in_array($ext, $allowedTypes)) {
            if (move_uploaded_file($tempName, $targetPath)) {
                $query = "INSERT INTO associationImages (name, filename) VALUES (?, ?)";
                $stmt = $mysqli->stmt_init();
                if(!$stmt->prepare($query)){
                    die("SQL Error". $mysqli->error);
                }
                $stmt->bind_param("ss", $assocication, $defaultName);
                $stmt->execute();
                $stmt->close();
                $mysqli->close();
                echo "Insert success";
            } 
            else {
                echo "Something went wrong with the query preparation.";   
            }
        } 
        else {
            echo "Your file type is not allowed.";
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Image Upload</title>
</head>
<body>
    <form action="" method="POST" enctype="multipart/form-data">
        <label for="image">Choose an image:</label>
        <input type="file" name="image" id="image" accept="image/*" required>
        <button type="submit" name = 'upload'>Upload</button>
    </form>
</body>
</html>