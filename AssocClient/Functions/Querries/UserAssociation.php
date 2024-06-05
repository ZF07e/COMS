<?php
    require ('../../../LandingPage/Functions/SessionManagement.php');
    require ('../../../LandingPage/Functions/connectionDB.php');

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
    $query = "SELECT * FROM associations WHERE association =  ?";
    
    $stmt = $mysqli->prepare($query);
    if (!$stmt) {
        die("SQL Error: " . $mysqli->error);
    }
    $stmt->bind_param("s", $association);
    $stmt->execute();
    $result = $stmt->get_result();

    $data = array();
    while ($row = $result->fetch_assoc()) {
            
        $data[] = $row;
    }

    $jsonArray = json_encode($data);
    header('Content-Type: application/json');

    print_r($jsonArray);
    $stmt->close();
    $mysqli->close();
}

?>
