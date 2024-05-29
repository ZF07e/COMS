<?php
    require ('../../../LandingPage/Functions/connectionDB.php');
    require ('../../../LandingPage/Functions/SessionManagement.php');

    getUserAssociation();

    function getUserAssociation(){
        if(!isset($_POST["submit"])){
        $database = new Database();
        $mysqli = $database->getConnection();
    
        $email = $_SESSION['email'];
    
        $sql = "SELECT affiliation FROM users WHERE email = ?";
        $stmt = $mysqli->prepare($sql);
        if ($stmt) {
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $stmt->bind_result($affiliation);
            $stmt->fetch();
            $stmt->close();
            updateAssociation($affiliation);
        } else {
            // Handle error
            echo "Error preparing statement: " . $mysqli->error;
            return null;
        }
        $mysqli->close();
        }
    }

    function updateAssociation($assoc){
        $database = new Database();
        $mysqli = $database->getConnection();
    
        $updateQuery = "SELECT * FROM `users` WHERE affiliation = ?";
        $stmt = $mysqli->prepare($updateQuery);
        if (!$stmt) {
            die("SQL Error: " . $mysqli->error);
        }
        $stmt->bind_param("s", $assoc);
        $stmt->execute();
        $result = $stmt->get_result();
    
        $row_count = $result->num_rows;
        echo $row_count;
    
        $stmt->close();
        $mysqli->close();
        exit; 
    }
?>