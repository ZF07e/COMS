<?php
require ("connectionDB.php");

class UserLogin {
    public function login() {
        $appid = "0b984781-9abf-4b68-8553-b000b7cd9eef";
        $secret = "o7s8Q~ZYwRfPzdGSkDCsRvm9PPYqWPOqh16esaQ_";
        $login_url = "https://login.microsoftonline.com/common/oauth2/v2.0/authorize";
        $redirect_uri = 'http://localhost/COMS-main/LandingPage/Functions/callback.php';

        session_start();
        $_SESSION['state']=session_id();

        $params = array ('client_id' =>$appid,
        'redirect_uri' =>$redirect_uri,
        'response_type' =>'token',
        'response_mode' =>'form_post',
        'scope' =>'https://graph.microsoft.com/User.Read',
        'state' =>$_SESSION['state']);

        header ('Location: '.$login_url.'?'.http_build_query ($params));
    }
}

if (isset($_POST["login"])) {
    $login = new UserLogin();
    $login->login();
}
?>
