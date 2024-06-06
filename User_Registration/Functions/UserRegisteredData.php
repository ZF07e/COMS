<?php
    require ('../../LandingPage/Functions/connectionDB.php');
    require 'vendor/autoload.php';

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    //fullname.js
    $associationID = $_POST['associationID'];
    $association = $_POST['association'];
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
    $Password = md5($_POST['password']);

    $database = new Database();
    $mysqli = $database->getConnection();

    $activationToken = bin2hex(random_bytes(16));
    $activationTokenHash = hash("sha256", $activationToken);

    
    $query = "INSERT INTO users (firstName, lastName, gender, birthday, email, mobileNumber, 
    courseStrand, description, password, affiliation, associationCode, activation) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $mysqli->stmt_init();
    if (!$stmt->prepare($query)) {
        die("MySQL Error: " . $mysqli->error);
    }

    $stmt->bind_param("sssssissssss", $FirstName, $LastName, $Gender, $BirthDay, $Email, $MobileNum, 
    $courseStrand, $description, $Password, $association, $associationID, $activationTokenHash);

    if($stmt->execute()){
        $mail = new PHPMailer(true);
        try {
            // Server settings
            $mail->SMTPDebug = 0; // Enable verbose debug output (0 = off, 2 = on)
            $mail->isSMTP(); // Set mailer to use SMTP
            $mail->Host = 'smtp.gmail.com'; // Specify main and backup SMTP servers
            $mail->SMTPAuth = true; // Enable SMTP authentication
            $mail->Username = 'sti.college.coms@gmail.com'; // SMTP username
            $mail->Password = 'vbvp hefu avlr fizn'; // SMTP password - use an app-specific password if 2FA is enabled
            $mail->SMTPSecure = 'tls'; // Enable TLS encryption, `ssl` also accepted
            $mail->Port = 587; // TCP port to connect to

            // Recipients
            $mail->setFrom('sti.college.coms@gmail.com', 'noreply');
            $mail->addAddress($Email);

            // Content
            $mail->isHTML(true); // Set email format to HTML
            $mail->Subject = "Account Activation";
            $mail->Body    = "Click <a href='http://localhost/COMS/User_Registration/Functions/activateAccount.php?token=$activationToken'>here</a> to activate your account.";
            $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

            $mail->send();
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            exit;
        }

        header ("Location: http://localhost/COMS/User_Registration/SetupAccount/message.php");
        exit;
    }
?>