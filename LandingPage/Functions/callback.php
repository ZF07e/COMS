<?php
    require("connectionDB.php");

    session_start();

    if (array_key_exists('access_token', $_POST)) {
        $_SESSION['t'] = $_POST['access_token'];
        $t = $_SESSION['t'];
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: Bearer ' . $t, 'Content-type: application/json'));
        curl_setopt($ch, CURLOPT_URL, "https://graph.microsoft.com/v1.0/me/");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $rez = json_decode(curl_exec($ch), true);

        if (array_key_exists('error', $rez)) {
            var_dump($rez['error']);
            die();
        } else {
            $_SESSION['msatg'] = 1;  //auth and verified
            $_SESSION['uname'] = $rez["displayName"];
            $_SESSION['email'] = $rez["mail"];
            $_SESSION['position'] = $rez["jobTitle"];
            $database = new Database();
            $mysqli = $database->getConnection();

            // Check if user email is set in the session
            if (isset($_SESSION['email'])) {
                $email = trim($_SESSION['email']);

                if(!str_contains($email, "@alabang.sti.edu.ph")){
                    $redirect_uri = urlencode("http://localhost/COMS/LandingPage/Index.php");
                    $logout_url = "https://login.microsoftonline.com/common/oauth2/v2.0/logout?post_logout_redirect_uri=$redirect_uri";
                    if ($t) {
                        $logout_url .= "&id_token_hint=" . urlencode($id_token);
                    }

                    $_SESSION = array();
                    session_unset();
                    session_destroy();
                    header("Location: $logout_url");
                    exit();
                }

                $sql = "SELECT position FROM users WHERE email = '$email'";
                $result = $mysqli->query($sql);

                if ($result) {
                    if ($result->num_rows > 0) {
                        // User found in the database
                        $userData = $result->fetch_assoc();
                        $role = $userData['position'];
                        
                        if ($role == "Student Affairs Officer") {
                            header("Location: http://localhost/COMS/AdminPage/index.php");
                            exit();
                        }
                        else if($role == "IT Professional"){
                            header("Location: http://localhost/COMS/AdminPage/index.php");
                            exit();
                        }
                        else if($role == "School Administrator"){
                            header("Location: http://localhost/COMS/AdminPage/index.php");
                            exit();
                        }
                        else if($role == "Academic Head"){
                            header("Location: http://localhost/COMS/AdminPage/index.php");
                            exit();
                        }
                        else if($role == "Program Head"){
                            header("Location: http://localhost/COMS/AdminPage/index.php");
                            exit();
                        }
                        else if($role == "Assistant Principal"){
                            header("Location: http://localhost/COMS/AdminPage/index.php");
                            exit();
                        }
                        elseif($role == "Adviser"){
                            header("Location: http://localhost/COMS/AssocClient/index.php");
                            exit();
                        }
                        elseif($role == "President"){
                            header("Location: http://localhost/COMS/AssocClient/index.php");
                            exit();
                        }
                        elseif($role == "Secretary"){
                            header("Location: http://localhost/COMS/AssocClient/index.php");
                            exit();
                        }
                        elseif($role == "Auditor"){
                            header("Location: http://localhost/COMS/AssocClient/index.php");
                            exit();
                        }
                        elseif($role == "Treasurer"){
                            header("Location: http://localhost/COMS/AssocClient/index.php");
                            exit();
                        }
                        elseif($role == "Head Officer"){
                            header("Location: http://localhost/COMS/AssocClient/index.php");
                            exit();
                        }
                        elseif($role == "Officer"){
                            header("Location: http://localhost/COMS/AssocClient/index.php");
                            exit();
                        }
                        else {
                            // User not authorized (role not match)
                            //echo "You do not have permission to access this page.";
                            header("Location: http://localhost/COMS/LandingPage/Index.php");
                            exit();
                        }
                    } else {
                        // User not found in the database
                        //echo "User not found in the database. <br>";
                        header("Location: http://localhost/COMS/LandingPage/Index.php");
                        exit();
                    }
                } else {
                    echo "Error: " . $mysqli->error;
                    header("Location: http://localhost/COMS/LandingPage/Index.php");
                    exit();
                }
            }
        }
    }
?>