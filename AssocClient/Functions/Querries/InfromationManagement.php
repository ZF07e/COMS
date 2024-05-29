<?php
    require ('../../../LandingPage/Functions/connectionDB.php');
    require ('../../../LandingPage/Functions/SessionManagement.php');

        
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

        if($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['assocChangeBTN'])){
            updateAssociation($affiliation);
        }
        elseif($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['addBTN'])){
            addUser($affiliation);
        }
        elseif($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['saveBTN'])){
            updateUserInfo($affiliation);
        }
        
    } else {
        // Handle error
        echo "Error preparing statement: " . $mysqli->error;
        return null;
    }
    $mysqli->close();
        
    

    function updateAssociation($assoc){
        if(!isset($_POST["submit"])){
            $associationName = $_POST["getAssocName"];
            $description = $_POST["description"];
            $mission = $_POST["mission"];
            $vision = $_POST["vision"];

            $databse = new Database();
            $mysqli = $databse->getConnection();

            $updateQuery = "UPDATE associations SET mission = ?, vision = ?, description = ? WHERE association = ?";

            $stmt = $mysqli->stmt_init();
            if(!$stmt->prepare($updateQuery)){
                die("SQL Error". $mysqli->error);
            }
            $stmt->bind_param("ssss", $mission, $vision, $description, $assoc);
            $stmt->execute();
            $mysqli->close();
            header("Location: ../../index.php");
        }
    }

    function addUser($assoc){;
        $firstName = $_POST["firstName"];
        $lastName = $_POST["lastName"];
        $email = $_POST["email"];
        $position = $_POST["position"];

        $database = new Database();
        $mysqli = $database->getConnection();


        $query = "SELECT id, association FROM `associations` WHERE association = ?";
        $stmt = $mysqli->prepare($query);
        $stmt->bind_param("s", $assoc);
        $stmt->execute();
        $stmt->bind_result($value1, $value2);

        $stmt->fetch();
        $stmt->close();

        $insertUser = "INSERT INTO users (firstName, lastName, email, position, affiliation, associationCode) VALUES (?, ?, ?, ?, ?, ?)";

        $stmt = $mysqli->stmt_init();
        if(!$stmt->prepare($insertUser)){
            die("SQL Error". $mysqli->error);
        }
        $stmt->bind_param("ssssss", $firstName, $lastName, $email, $position, $value2, $value1);
        $stmt->execute();
        $mysqli->close();
        header("Location: ../../userManagement.php");
    }

    function updateUserInfo($assoc){
        $firstName = $_POST["newFirstName"];
        $lastName = $_POST["newLastName"];
        $email = $_POST["newEmail"];
        $position = $_POST["newPosition"];
        $userID = $_POST["userID"];
        $associationCode;
        $adviser;

        $database = new Database();
        $mysqli = $database->getConnection();

        $updateQuery = "UPDATE users SET firstName = ? , lastName = ? , position = ? , affiliation = ? , email = ?  WHERE userID = ?";

        $stmt = $mysqli->stmt_init();
        if(!$stmt->prepare($updateQuery)){
            die("SQL Error". $mysqli->error);
        }
        $stmt->bind_param("ssssss", $firstName, $lastName, $position, $assoc, $email, $userID);
        $stmt->execute();

        $mysqli->close();
        header("Location: ../../userManagement.php");
    }
?>