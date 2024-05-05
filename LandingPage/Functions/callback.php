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
            $_SESSION['id'] = $rez["id"];

            $database = new Database();
            $mysqli = $database->getConnection();

            // Check if user ID is set in the session
            if (isset($_SESSION['id'])) {
                $id = trim($_SESSION['id']);
                $sql = "SELECT role FROM userroles WHERE id = '$id'";
                $result = $mysqli->query($sql);

                if ($result) {
                    if ($result->num_rows > 0) {
                        // User found in the database
                        $userData = $result->fetch_assoc();
                        $role = $userData['role'];
                        if ($role == "admin") {
                            header("Location: http://localhost/COMS-main/AdminPage/index.php");
                            exit();
                        } else {
                            // User not authorized (role not match)
                            echo "You do not have permission to access this page.";
                            exit();
                        }
                    } else {
                        // User not found in the database
                        echo "User not found in the database. <br>";
                        exit();
                    }
                } else {
                    // Error executing the SQL query
                    echo "Error: " . $mysqli->error;
                    exit();
                }
            }
        }
    }

    // Check if the user is logged in
    if (isset($_SESSION['msatg']) && $_SESSION['msatg'] == 1) {
        echo "Session ID: " . $_SESSION['uname'];
    } else {
        echo "You are not logged in.";
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <p><a href="?action=logout">Log Out</a></p> <!-- logout testing -->
</body>
</html>

<?php
    //logout
    if (isset($_GET['action']) && $_GET['action'] == 'logout') {
        $redirect_uri = urlencode("http://localhost/COMS-main/LandingPage/Index.php"); // Replace with your actual logout confirmation page
        $logout_url = "https://login.microsoftonline.com/common/oauth2/v2.0/logout?post_logout_redirect_uri=$redirect_uri";
        header("Location: $logout_url");
        exit();
    }
?>
