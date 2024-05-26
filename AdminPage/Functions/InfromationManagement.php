<?php
    require ('../../LandingPage/Functions/connectionDB.php');

    function updateUserInfo(){
        $firstName = $_POST["newFirstName"];
        $lastName = $_POST["newLastName"];
        $email = $_POST["newEmail"];
        $position = $_POST["newPosition"];
        $affiliation = $_POST["newAffiliation"];
        $userID = $_POST["userID"];
        $associationCode;
        $adviser;

        $database = new Database();
        $mysqli = $database->getConnection();

        //Kunin muna ID para ipasa sa kabilang lamesa
        $query = "SELECT id FROM associations WHERE association = ?";

        $stmt = $mysqli->stmt_init();
        if(!$stmt->prepare($query)){
            die("SQL Error". $mysqli->error);
        }
        $stmt->bind_param("s", $affiliation);
        $stmt->execute();
        $result = $stmt->get_result();
        $data = $result->fetch_assoc();

        if(gettype($data) == "array"){
            $associationCode = implode($data);
        }

        //Pag may nakuha na ID, update na data sa users lamesa
        $updateQuery = "UPDATE users SET firstName = ? , lastName = ? , role = ? , affiliation = ? , email = ?, associationCode = ? WHERE userID = ?";

        $stmt = $mysqli->stmt_init();
        if(!$stmt->prepare($updateQuery)){
            die("SQL Error". $mysqli->error);
        }
        $stmt->bind_param("sssssss", $firstName, $lastName, $position, $affiliation, $email, $associationCode, $userID);
        $stmt->execute();

        //Get Adviser if adviser changed
        $getAdviser = "SELECT adviser from associations WHERE association = ?;";
        $updateAdviser = $mysqli->stmt_init();
        if(!$updateAdviser->prepare($getAdviser)){
            die("SQL Error". $mysqli->error);
        }
        $updateAdviser->bind_param("s", $affiliation);
        $updateAdviser->execute();
        $adviserResult = $updateAdviser->get_result();
        $resultData = $adviserResult->fetch_assoc();

        if(gettype($resultData) == "array"){
            $adviser = implode($resultData);
        }
        else{
            $adviser = $resultData;
        }

        $fullname = $firstName." ".$lastName;

        if ($adviser == $fullname && $position != "adviser"){
            $removeAdviser = "UPDATE associations SET adviser = 'Unassigned'  WHERE association = ?";

            $stmt = $mysqli->stmt_init();
            if(!$stmt->prepare($removeAdviser)){
                die("SQL Error". $mysqli->error);
            }
            $stmt->bind_param("s", $affiliation);
            $stmt->execute();
            echo "Adviser has been removed from association table <br>";
        }
        else{
            $adviserQuery = "UPDATE associations SET adviser = ?  WHERE association = ?";

            $stmt = $mysqli->stmt_init();
            if(!$stmt->prepare($adviserQuery)){
                die("SQL Error". $mysqli->error);
            }
            $stmt->bind_param("ss", $fullname, $affiliation);
            $stmt->execute();
            echo "Adviser has been added to association table <br>";
        }
        echo "Account updated successfully!";
        $mysqli->close();
        header("Location: ../userManagement.php");
    }

    function addUser(){;
        $firstName = $_POST["firstName"];
        $lastName = $_POST["lastName"];
        $email = $_POST["email"];
        $position = $_POST["position"];

        $database = new Database();
        $mysqli = $database->getConnection();

        $insertUser = "INSERT INTO users (firstName, lastName, email, role) VALUES (?, ?, ?, ?)";

        $stmt = $mysqli->stmt_init();
        if(!$stmt->prepare($insertUser)){
            die("SQL Error". $mysqli->error);
        }
        $stmt->bind_param("ssss", $firstName, $lastName, $email, $position);
        $stmt->execute();
        $mysqli->close();  
        header("Location: ../userManagement.php");
    }

    function addAssociation(){
        $id;
        $name = $_POST["name"];
        $type = $_POST["type"];
        $adviser = $_POST["adviser"];

        $database = new Database();
        $mysqli = $database->getConnection();

        if($type == "Club"){
            $query = "SELECT id FROM associations WHERE id LIKE 'CLB%' ORDER BY CAST(SUBSTRING(id, 4) AS INTEGER) DESC LIMIT 1;";
            $result = $mysqli->query($query);
            $data = $result->fetch_assoc();
            
            if($data == ""){
                $num = 1;
                $id = "CLB".$num;
            }
            else{
                if (gettype($data) == "array"){
                    $getLastIdNum = (int)filter_var(implode($data), FILTER_SANITIZE_NUMBER_INT);
                }
                else{
                    $getLastIdNum = (int)filter_var($data, FILTER_SANITIZE_NUMBER_INT);
                }
                
                if((is_numeric($getLastIdNum) && $getLastIdNum == "")){
                    $num = 1;
                    $id = "CLB".$num;
                }
                else {
                    $id = "CLB".$getLastIdNum + 1;
                }
            }
            
            print_r($id."<br>");
        }
        elseif ($type == "Organization"){
            $id = "ORG";
            $query = "SELECT id FROM associations WHERE id LIKE 'ORG%' ORDER BY CAST(SUBSTRING(id, 4) AS INTEGER) DESC LIMIT 1;";
            $result = $mysqli->query($query);
            $data = $result->fetch_assoc();

            if($data == ""){
                $num = 1;
                $id = "ORG".$num;
            }
            else{
                if (gettype($data) == "array"){
                    $getLastIdNum = (int)filter_var(implode($data), FILTER_SANITIZE_NUMBER_INT);
                }
                else{
                    $getLastIdNum = (int)filter_var($data, FILTER_SANITIZE_NUMBER_INT);
                }
                
                if((is_numeric($getLastIdNum) && $getLastIdNum == "")){
                    $num = 1;
                    $id = "ORG".$num;
                }
                else {
                    $id = "ORG".$getLastIdNum + 1;
                }
            }
            
            print_r($id."<br>");
        }

        $insertAssociation = "INSERT INTO associations ( id, association, type, adviser) VALUES ( ?, ?, ?, ?)";

        $insertSTMT = $mysqli->stmt_init();
        if(!$insertSTMT->prepare($insertAssociation)){
            die("SQL Error". $mysqli->error);
        }
        $insertSTMT->bind_param("ssss", $id, $name, $type, $adviser);

        if(!$insertSTMT->execute()){
            echo "Error: " . $stmt->error;
            return;
        }
        
        $updateAffiliation = "UPDATE users SET affiliation = ?, associationCode = ? WHERE CONCAT(firstName, ' ', lastName) = ?";

        $stmt = $mysqli->stmt_init();
        if(!$stmt->prepare($updateAffiliation)){
            die("SQL Error". $mysqli->error);
        }
        $stmt->bind_param("sss", $name, $id, $adviser);

        if(!$stmt->execute()) {
            echo "Error: " . $stmt->error;
            return;
        }

        echo "Association added!";
        $mysqli->close();

        header("Location: ../associations.php");
    }

    function updateAssociation(){
        
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
            $stmt->bind_param("ssss", $mission, $vision, $description, $associationName);
            $stmt->execute();
            echo "Assocaition details updated successfully!";
            $mysqli->close();
            header("Location: ../associations.php");
        }
    }

    function removeUser(){
        $email = $_POST['email'];
        $name = $_POST['name'];
        $adviser;
          
        $database = new Database();
        $mysqli = $database->getConnection();

        $queryGetAdviser = "SELECT adviser FROM associations WHERE adviser = ?;";

        $stmt = $mysqli->stmt_init();
        if(!$stmt->prepare($queryGetAdviser)){
            die("SQL Error". $mysqli->error);
        }
        $stmt->bind_param("s", $name);
        $stmt->execute();
        $result = $stmt->get_result();
        $data = $result->fetch_assoc();

        if(gettype($data) == "array"){
            $adviser = implode($data);
        }

        if ($adviser == $name){
            $removeAdviser = "UPDATE associations SET adviser = 'Unassigned'  WHERE adviser = ?";

            $stmt = $mysqli->stmt_init();
            if(!$stmt->prepare($removeAdviser)){
                die("SQL Error". $mysqli->error);
            }
            $stmt->bind_param("s", $name);
            $stmt->execute();
            echo "Adviser has been removed from association table <br>";
        }

        $query = "DELETE FROM users WHERE email = ?";

        $stmt = $mysqli->stmt_init();
        if(!$stmt->prepare($query)){
            die("SQL Error". $mysqli->error);
        }
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $mysqli->close();
        header("Location: ../userManagement.php");
    }

    if($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['saveBTN'])){
        updateUserInfo();
    }
    elseif($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['addBTN'])){
        addUser();
    }
    elseif($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['removeUser'])){
        removeUser();
    }
    elseif($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['addAssocBTN'])){
        addAssociation();
    }
    elseif($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['assocChangeBTN'])){
        updateAssociation();
    }
?>