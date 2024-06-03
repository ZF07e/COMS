<?php
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


    echo $FirstName. $LastName. $Gender. $BirthDay. $Email. $MobileNum. $Password;
?>