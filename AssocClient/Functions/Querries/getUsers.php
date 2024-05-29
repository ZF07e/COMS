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
        getUserPositions($affiliation);

    } else {
        // Handle error
        echo "Error preparing statement: " . $mysqli->error;
        return null;
    }
    $mysqli->close();
    }
}

function getUserPositions($assoc){
    $database = new Database();
    $mysqli = $database->getConnection();

    $query = "SELECT * FROM users WHERE affiliation = '$assoc'";
    $result = $mysqli->query($query);

    $data = array();
    while ($row = $result->fetch_assoc()) {
        
        $data[] = $row;
    }

    $jsonArray = json_encode($data);
    header('Content-Type: application/json');

    print_r($jsonArray);
    $mysqli->close();
}

?>