<?php
    require ('../../../LandingPage/Functions/connectionDB.php');
    require ('../../../LandingPage/Functions/SessionManagement.php');
    require ('vendor/autoload.php');

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    getUserAssociation();

    function getUserAssociation(){
        if(!isset($_POST["submit"])){
        $database = new Database();
        $mysqli = $database->getConnection();

        $email = $_SESSION['email'];

        $sql = "SELECT affiliation FROM users WHERE email = ?";
        $stmt = $mysqli->prepare($sql);
        if ($stmt) {
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $stmt->bind_result($affiliation);
            $stmt->fetch();
            $stmt->close();
            // getUserPositions($affiliation);
            return $affiliation;
        } else {
            // Handle error
            echo "Error preparing statement: " . $mysqli->error;
            return null;
        }
        $mysqli->close();
        }
    }

    function getUserPositions($assoc){
        $database = new Database();
        $mysqli = $database->getConnection();

        $query = "SELECT * FROM users WHERE affiliation = 'STICA- Computer Society' AND position != ''";
        $result = $mysqli->query($query);

        $data = array();
        while ($row = $result->fetch_assoc()) {
            
            $data[] = $row;
        }

        $jsonArray = json_encode($data);
        header('Content-Type: application/json');

        print_r($jsonArray);
        $mysqli->close();
    }

    function getApplicants($assoc){
        $database = new Database();
        $mysqli = $database->getConnection();

        $query = "SELECT * FROM users WHERE affiliation = '$assoc' AND position = '' AND activation IS NULL";
        $result = $mysqli->query($query);

        $data = array();
        while ($row = $result->fetch_assoc()) {
            
            $data[] = $row;
        }
        
        $jsonArray = json_encode($data);
        header('Content-Type: application/json');

        print_r($jsonArray);
        $mysqli->close();
    }

    function updatePosition($name, $position, $email, $association, $message){
        $database = new Database();
        $mysqli = $database->getConnection();

        $addPosition = "UPDATE users SET position = ?  WHERE email = ?";

        $stmt = $mysqli->stmt_init();
        if(!$stmt->prepare($addPosition)){
            die("SQL Error". $mysqli->error);
        }
        $stmt->bind_param("ss", $position, $email);
        $stmt->execute();
        $stmt->close();
        $mysqli->close();

        sendEmail($name, $position, $email, $association, $message);
    }

    function rejectApplicant($name, $position, $email, $association, $message){
        $database = new Database();
        $mysqli = $database->getConnection();

        $query = 'DELETE FROM users WHERE email = ?';
        $stmt = $mysqli->stmt_init();
        if(!$stmt->prepare($query)){
            die("SQL Error". $mysqli->error);
        }
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->close();
        $mysqli->close();

        sendEmail($name, $position, $email, $association, $message);
    }

    function sendEmail($name, $position, $email, $association, $message){
        $mail = new PHPMailer(true);
        try {
            $mail->SMTPDebug = 0; 
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'sti.college.coms@gmail.com';
            $mail->Password = 'vbvp hefu avlr fizn';
            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;
            // Recipients
            $mail->setFrom('sti.college.coms@gmail.com', 'COMS-Notifier');

            $mail->addAddress($email, $name);

            // Content
            $mail->isHTML(true); 
            $mail->Subject = 'Membership Application Update';
            $mail->Body    = $message;
            $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

            $mail->send();
            echo "success";
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }

    if(isset($_GET['action']) && $_GET['action'] == 'positions'){
        getUserPositions(getUserAssociation());
    }
    elseif(isset($_GET['action']) && $_GET['action'] == 'getApplicants'){
        getApplicants(getUserAssociation());
    }
    elseif(isset($_GET['action']) && $_GET['action'] == 'acceptApplication'){
        $name = $_POST['name'];
        $email = $_POST['email'];
        $position = $_POST['position'];
        $association = $_POST['association'];
        $message = "Congratulations! <br>
                    Your membership application was accepted.  <br>
                    You are assigned as ".$position." in ".$association;

        updatePosition($name, $position, $email, $association, $message);
    }
    elseif(isset($_GET['action']) && $_GET['action'] == 'rejectApplication'){
        $name = $_POST['name'];
        $email = $_POST['email'];
        $position = $_POST['position'];
        $association = $_POST['assoc'];
        $message = "Good day! <br>
                    Unfortunately your application has been rejected in ".$association."<br>
                    Maybe try again next time! Good luck!";

        rejectApplicant($name, $position, $email, $association, $message);
    }

?>