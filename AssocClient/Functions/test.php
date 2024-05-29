<?php
    require ('../../LandingPage/Functions/SessionManagement.php');
    require ('../../LandingPage/Functions/connectionDB.php');

getUserAssociation();

function getUserAssociation(){
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
        getAssociation($affiliation);
    } else {
        // Handle error
        echo "Error preparing statement: " . $mysqli->error;
        return null;
    }
    $mysqli->close();
}
   
function getAssociation($association){
    $database = new Database();
    $mysqli = $database->getConnection();

    $query = "SELECT * FROM associations WHERE association = .$association.";
        
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
        print_r($data);
    } else {
        $stmt->close();
        $mysqli->close();
        return null;
    }

    
}

?>
