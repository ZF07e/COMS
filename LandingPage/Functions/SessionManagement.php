<?php
    session_start();

    $session_timeout = 900; //15 minutes lang par

    // Check if last activity time is set
    if (isset($_SESSION['last_activity']) && time() - $_SESSION['last_activity'] > $session_timeout) {
        $_SESSION = array();
        session_destroy();

        // Expire the session cookie
        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000,
                $params["path"], $params["domain"],
                $params["secure"], $params["httponly"]
            );
        }
        header("Location: http://localhost/COMS-main/LandingPage/Index.php");
        exit();
    }

    // Update last activity time
    $_SESSION['last_activity'] = time();


    // Check if the user is logged in
    if (isset($_SESSION['msatg']) && $_SESSION['msatg'] == 1) {
        echo "Session ID: " . $_SESSION['uname'];
    } else {
        session_unset();
        session_destroy();
        header("Location: http://localhost/COMS-main/LandingPage/Index.php");
    }

    if (isset($_GET['action']) && $_GET['action'] == 'logout') {

        $_SESSION = array();
        // Expire the session cookie
        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000,
                $params["path"], $params["domain"],
                $params["secure"], $params["httponly"]
            );
        }
        session_unset();
        session_destroy();
        header("Location: http://localhost/COMS-main/LandingPage/Index.php");
        exit();
    }
?>
