<?php
    require("connectionDB.php");

    class userLogin{
        
        public function login(){
            //print_r($_POST);
            session_start();
            $username = $_POST["username"];
            $password = $_POST["password"];
        
            $database = new Database();
            $mysqli = $database->getConnection();
            
            // Prepare SQL statement
            $stmt = $mysqli->prepare("SELECT * FROM userLogin WHERE username = ?");
            if(!$stmt) {
                die("Error: " . $mysqli->error);
            }
            if($_POST["username"] == "" || $_POST["password"] == ""){
                exit("Please fill the required information"); //needs to be displayed in the login page
            }

            $stmt->bind_param("s", $username);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                // output data of each row
                while($row = $result->fetch_assoc()) {
                    //if(password_verify($password, $row["password"])) For encrypted passwords (ignore this comment)
                    if($password == $row["password"]){
                        session_regenerate_id();
                        $_SESSION['login'] = TRUE;
                        $_SESSION["name"] = $username;
                        $_SESSION["id"] = $row["userID"];
                        echo "<p> Login Success! </p>";
                        echo "<p> Session ID: ".$_SESSION["id"]."</p>";
                        echo "<p> Session Name: ".$_SESSION["name"]."</p>";
                    }
                    else{
                        echo "Incorrect password";
                    }
                }
            } else {
                echo "User not found.";
            }

            $stmt->close();
            $mysqli->close();
        }
    }

    if(isset($_POST["login"])){
        $userLogin = new userLogin();
        $userLogin->login(); 
    }
?>