<?php
    require ('../../LandingPage/Functions/connectionDB.php');

    if(!isset($_POST['submit'])){
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
                
                $num = 1;
                if((is_numeric($getLastIdNum) && $getLastIdNum == "")){
                    $id = "CLB".$num;
                }
                else {
                    $id = "CLB".$num + 1;
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
                
                $num = 1;
                if((is_numeric($getLastIdNum) && $getLastIdNum == "")){
                    $id = "ORG".$num;
                }
                else {
                    $id = "ORG".$num + 1;
                }
            }
            
            print_r($id."<br>");
        }

        $insertAssociation = "INSERT INTO associations ( id, name, type, adviser) VALUES ( ?, ?, ?, ?)";

        $stmt = $mysqli->stmt_init();
        if(!$stmt->prepare($insertAssociation)){
            die("SQL Error". $mysqli->error);
        }
        $stmt->bind_param("ssss", $id, $name, $type, $adviser);
        $stmt->execute();
        echo "Association added!";
        $mysqli->close();
    }    
?>