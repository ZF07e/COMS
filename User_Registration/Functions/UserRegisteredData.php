<?php
    require ('../../LandingPage/Functions/connectionDB.php');

    //fullname.js
    $FirstName = $_POST['firstName'];
    $LastName = $_POST['lastName'];
    $Gender = $_POST['gender'];

    //birthdate.js
    $BirthDay = $_POST['birthday'];

    //contact.js
    $Email = $_POST['email'];
    $MobileNum = $_POST['mobileNo'];

    //student_description.js
    $courseStrand = $_POST['courseStrand'];
    $description = $_POST['description']; 

    //password.js
    $Password = $_POST['password'];

    $database = new Database();
    $mysqli = $database->getConnection();
?>