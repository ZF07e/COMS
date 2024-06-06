<?php
require ("connectionDB.php");

class UserLogin {
    public function login() {
        $appid = "0b984781-9abf-4b68-8553-b000b7cd9eef";
        $secret = "o7s8Q~ZYwRfPzdGSkDCsRvm9PPYqWPOqh16esaQ_";
        $login_url = "https://login.microsoftonline.com/common/oauth2/v2.0/authorize";
        $redirect_uri = 'http://localhost/COMS/LandingPage/Functions/callback.php';

        session_start();
        $_SESSION['state'] = session_id();

        $params = array ('client_id' =>$appid,
        'redirect_uri' =>$redirect_uri,
        'response_type' =>'token',
        'response_mode' =>'form_post',
        'scope' =>'https://graph.microsoft.com/User.Read',
        'state' => $_SESSION['state']);

        header ('Location: '.$login_url.'?'.http_build_query ($params));
    }

    function loginEmail(){
        session_start();
        $database = new Database();
        $mysqli = $database->getConnection();
        $email = $_POST['inputEmail'];
        $passowrd = md5($_POST['inputPassword']);

        $query = "SELECT password FROM users WHERE email = ? AND activation IS null";

        $stmt = $mysqli->stmt_init();
        if(!$stmt->prepare($query)){
            die('SQL error: '. $mysqli->error);
        }

        $stmt->bind_param('s', $email);
        $stmt->execute();
        $result = $stmt->get_result();
        $data = $result->fetch_assoc();

        if (is_array($data)) {
            $data = implode('', $data); // '' specifies no delimiter
        }

        $sql = "SELECT firstName, lastName, position FROM users WHERE email = '$email'";
        $result = $mysqli->query($sql);
        $userData = $result->fetch_assoc();
        $role = $userData['position'];
        $name = $userData['firstName'].' '.$userData['lastName'];

        if($data != null){
            if($data == $passowrd){                
                if ($role == "Student Affairs Officer") {
                    $_SESSION['authorized'] = true;
                    $_SESSION['email'] = $email;
                    $_SESSION['name'] = $name;
                    header("Location: http://localhost/COMS/AdminPage/index.php");
                    exit();
                }
                elseif ($role == "School Administrator") {
                    $_SESSION['authorized'] = true;
                    $_SESSION['email'] = $email;
                    $_SESSION['name'] = $name;
                    header("Location: http://localhost/COMS/AdminPage/index.php");
                    exit();
                }
                elseif ($role == "Academic Head") {
                    $_SESSION['authorized'] = true;
                    $_SESSION['email'] = $email;
                    $_SESSION['name'] = $name;
                    header("Location: http://localhost/COMS/AdminPage/index.php");
                    exit();
                }
                elseif ($role == "Program Head") {
                    $_SESSION['authorized'] = true;
                    $_SESSION['email'] = $email;
                    $_SESSION['name'] = $name;
                    header("Location: http://localhost/COMS/AdminPage/index.php");
                    exit();
                }
                elseif ($role == "Assistant Principal") {
                    $_SESSION['authorized'] = true;
                    $_SESSION['email'] = $email;
                    $_SESSION['name'] = $name;
                    header("Location: http://localhost/COMS/AdminPage/index.php");
                    exit();
                }
                elseif($role == "Adviser"){
                    $_SESSION['authorized'] = true;
                    $_SESSION['email'] = $email;
                    $_SESSION['name'] = $name;
                    header("Location: http://localhost/COMS/AssocClient/index.php");
                    exit();
                }
                elseif($role == "President"){
                    $_SESSION['authorized'] = true;
                    $_SESSION['email'] = $email;
                    $_SESSION['name'] = $name;
                    header("Location: http://localhost/COMS/AssocClient/index.php");
                    exit();
                }
                elseif($role == "Vice President"){
                    $_SESSION['authorized'] = true;
                    $_SESSION['email'] = $email;
                    $_SESSION['name'] = $name;
                    header("Location: http://localhost/COMS/AssocClient/index.php");
                    exit();
                }
                elseif($role == "Secretary"){
                    $_SESSION['authorized'] = true;
                    $_SESSION['email'] = $email;
                    $_SESSION['name'] = $name;
                    header("Location: http://localhost/COMS/AssocClient/index.php");
                    exit();
                }
                elseif($role == "Auditor"){
                    $_SESSION['authorized'] = true;
                    $_SESSION['email'] = $email;
                    $_SESSION['name'] = $name;
                    header("Location: http://localhost/COMS/AssocClient/index.php");
                    exit();
                }
                elseif($role == "Treasurer"){
                    $_SESSION['authorized'] = true;
                    $_SESSION['email'] = $email;
                    $_SESSION['name'] = $name;
                    header("Location: http://localhost/COMS/AssocClient/index.php");
                    exit();
                }
                elseif($role == "Head Officer"){
                    $_SESSION['authorized'] = true;
                    $_SESSION['email'] = $email;
                    $_SESSION['name'] = $name;
                    header("Location: http://localhost/COMS/AssocClient/index.php");
                    exit();
                }
                elseif($role == "Officer"){
                    $_SESSION['authorized'] = true;
                    $_SESSION['email'] = $email;
                    $_SESSION['name'] = $name;
                    header("Location: http://localhost/COMS/AssocClient/index.php");
                    exit();
                }
                else {
                    $_SESSION['error'] = 'Unauthorized Access';
                    header("Location: http://localhost/COMS/LandingPage/Index.php");
                    exit();
                }
            }
            else{
                $_SESSION['error'] = 'Incorrect username or password';
                header('Location: http://localhost/COMS/LandingPage/Index.php');
                exit();
            }
        }
        else{
            $_SESSION['error'] = $data;
            header('Location: http://localhost/COMS/LandingPage/Index.php');
            exit();
        }
        $mysqli->close();
    }
}
    if (isset($_POST["login"])) {
        $login = new UserLogin();
        $login->login();
    }
    else if($_SERVER["REQUEST_METHOD"] == "POST"){
        $login = new UserLogin();
        $login->loginEmail();
    }
?>