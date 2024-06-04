<?php
    require ('../../LandingPage/Functions/connectionDB.php');

    //fullname.js
    $FirstName = $_POST['firstName'];
    $LastName = $_POST['lastName'];
    $Gender = $_POST['gender'];

    //birthdate.js
    $BirthDay = $_POST['birthday'];

    //Contact
    $Email = $_POST['email'];
    $MobileNum = $_POST['mobileNo'];

    //password
    $Password = $_POST['password'];

    $database = new Database();
    $mysqli = $database->getConnection();
?>