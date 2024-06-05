<?php
    require ('../../LandingPage/Functions/SessionManagement.php');
    require ('../../LandingPage/Functions/connectionDB.php');
    require 'vendor/autoload.php';

    use Dompdf\Dompdf;
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    function getDocuments() {
        $database = new Database();
        $mysqli = $database->getConnection();
        $email = $_SESSION['email'];

        $query = "SELECT d.id, d.sender, d.status, d.subject, d.filename, d.htmlContent, DATE(d.timestamp) as date_only
        FROM documents d
        JOIN recipients r ON d.id = r.documentID
        WHERE r.email = '$email' AND r.isVisible = 1";
        $result = $mysqli->query($query);

        if (!$result) {
            die("SQL Error (query): " . $mysqli->error);
        }

        $documents = [];
        while ($row = $result->fetch_assoc()) {
            $documents[] = $row;
        }

        $jsonArray = json_encode($documents);
        header('Content-Type: application/json');
        echo $jsonArray;
        $mysqli->close();
    }
    
    function getRecipient($id) {
        $database = new Database();
        $mysqli = $database->getConnection();

        $query = "SELECT * FROM recipients WHERE documentID = '$id'";

        $data = array();
    
        if ($stmt = $mysqli->prepare($query)) {
            $stmt->execute();
            $result = $stmt->get_result();
            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            }
            $stmt->close();
        } else {
            $data = array('error' => 'Failed to prepare the SQL statement');
        }

        if (empty($data)) {
            $data = array('error' => 'No recipients found for the provided documentID');
        }
    
        $jsonArray = json_encode($data);
        header('Content-Type: application/json');
        echo $jsonArray;
        $mysqli->close();
    }

    function getHTMLcontents($id){
        $database = new Database();
        $mysqli = $database->getConnection();
        $htmlcontents;

        $query = "SELECT htmlContent FROM documents WHERE id = '$id'";
        $stmt = $mysqli->stmt_init();
        if(!$stmt->prepare($query)){
            die("SQL Error". $mysqli->error);
        }
        $stmt->execute();
        $result = $stmt->get_result();
        $data = $result->fetch_assoc();
        $htmlcontents = implode($data);
        return $htmlcontents;
    }

    function updateData($html, $selectedID){
        $database = new Database();
        $mysqli = $database->getConnection();

        $query = "UPDATE documents SET htmlContent = ? WHERE id = '$selectedID'";
        $stmt = $mysqli->stmt_init();
        if(!$stmt->prepare($query)){
            die("SQL Error". $mysqli->error);
        }
        $stmt->bind_param('s', $html);
        $stmt->execute();
    }

    function updateStatusSigned($name, $selectedID){
        $database = new Database();
        $mysqli = $database->getConnection();

        $query = "UPDATE recipients SET status = 'Signed' WHERE name = '$name' AND documentID = '$selectedID'";

        $stmt = $mysqli->stmt_init();
        if(!$stmt->prepare($query)){
            die("SQL Error". $mysqli->error);
        }
        $stmt->execute();
        $stmt->close();
        $mysqli->close();
    }

    function updateDocumentStatusApproved(){
        $selectedID = $_POST['id'];
        $database = new Database();
        $mysqli = $database->getConnection();

        $query = "UPDATE documents SET status = 'Approved' WHERE id = '$selectedID'";

        $stmt = $mysqli->stmt_init();
        if(!$stmt->prepare($query)){
            die("SQL Error". $mysqli->error);
        }
        $stmt->execute();
        $stmt->close();
        $mysqli->close();
        echo "Success";
    }

    function updateDocumentStatusRejected(){
        $selectedID = $_POST['id'];
        $database = new Database();
        $mysqli = $database->getConnection();

        $query = "UPDATE documents SET status = 'Rejected' WHERE id = '$selectedID'";

        $stmt = $mysqli->stmt_init();
        if(!$stmt->prepare($query)){
            die("SQL Error". $mysqli->error);
        }
        $stmt->execute();
        $stmt->close();
        $mysqli->close();
        echo "Success";
    }

    function updateStatusReject($name, $selectedID){
        $database = new Database();
        $mysqli = $database->getConnection();

        $query = "UPDATE recipients SET status = 'Rejected' WHERE name = '$name' AND documentID = '$selectedID'";

        $stmt = $mysqli->stmt_init();
        if(!$stmt->prepare($query)){
            die("SQL Error". $mysqli->error);
        }
        $stmt->execute();
        $stmt->close();
        $mysqli->close();
    }

    function approved(){
        $signature = $_POST['signature'];
        $selectedID = $_POST['id'];
        $email = $_SESSION['email'];

        $database = new Database();
        $mysqli = $database->getConnection();

        $query = "SELECT firstName, lastName FROM users WHERE email = '$email'";
        $stmt = $mysqli->stmt_init();
        if(!$stmt->prepare($query)){
            die("Error query: ". $mysqli->error);
        }
        $stmt->execute();
        $result = $stmt->get_result();
        $name = $result->fetch_assoc();

        $fullName = $name['firstName'].' '.$name['lastName'];
        
        ini_set('memory_limit', '512M'); 
        $htmlcontents = getHTMLcontents($selectedID);
        $newhtmlcontents = str_replace($fullName.'signature', $signature, $htmlcontents);
        //echo $selectedID;
        //echo $signature;

        $dompdf = new Dompdf();
        $dompdf->loadHtml($newhtmlcontents);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        $pdfData = $dompdf->output();
        $folderPath = '../../PDF-FILES/';
        $filePath = '../../PDF-FILES/'.$selectedID.'.pdf';
        
        file_put_contents($filePath, $pdfData);
        updateData($newhtmlcontents, $selectedID);
        updateStatusSigned($fullName, $selectedID);
        //echo "approved";
        $stmt->close();
        $mysqli->close();

        updateNoter($selectedID);
        notifyRecipient($selectedID);
    }

    function rejected(){
        $signature = $_POST['signature'];
        $selectedID = $_POST['id'];
        $email = $_SESSION['email'];

        $database = new Database();
        $mysqli = $database->getConnection();

        $query = "SELECT firstName, lastName FROM users WHERE email = '$email'";
        $stmt = $mysqli->stmt_init();
        if(!$stmt->prepare($query)){
            die("Error query: ". $mysqli->error);
        }
        $stmt->execute();
        $result = $stmt->get_result();
        $name = $result->fetch_assoc();
        $stmt->close();
        $mysqli->close();

        $fullName = $name['firstName'].' '.$name['lastName'];
        
        ini_set('memory_limit', '512M'); 
        $htmlcontents = getHTMLcontents($selectedID);
        $newhtmlcontents = str_replace($fullName.'signature', $signature, $htmlcontents);
        //echo $selectedID;
        // echo $signature;

        $dompdf = new Dompdf();
        $dompdf->loadHtml($newhtmlcontents);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        $pdfData = $dompdf->output();
        $folderPath = '../../PDF-FILES/';
        $filePath = '../../PDF-FILES/'.$selectedID.'.pdf';
        
        file_put_contents($filePath, $pdfData);
        updateData($newhtmlcontents, $selectedID);
        updateStatusReject($fullName, $selectedID);
        echo "REJECTED";
    }

    function updateNoter($selectedID){
        $database = new Database();
        $mysqli = $database->getConnection();

        $query = "SELECT status FROM recipients WHERE role = 'Endorser' AND documentID = '$selectedID'";
        $result = $mysqli->query($query);

        if (!$result) {
            die("SQL Error (query): " . $mysqli->error);
        }

        $endroserStatus = [];
        while ($row = $result->fetch_assoc()) {
            $endroserStatus[] = $row;
        }

        $endorserCount = 0;
        for($x = 0; $x < count($endroserStatus); $x++){
            $status = $endroserStatus[$x]['status'];
            if($status == "Signed"){
                $endorserCount++;
            }
        }

        if($endorserCount == count($endroserStatus)){
            $query = "UPDATE recipients SET isVisible = 1 WHERE role = 'Noter' AND documentID = ?";
            $stmt = $mysqli->stmt_init();
            if(!$stmt->prepare($query)){
                die("SQL Error". $mysqli->error);
            }
            $stmt->bind_param('s', $selectedID);
            $stmt->execute();

            $query = "SELECT name, email FROM recipients WHERE role = 'Noter' AND  documentID = '$selectedID' AND emailSent = 0";
            $result = $mysqli->query($query);

            if (!$result) {
                die("SQL Error (query): " . $mysqli->error);
            }
    
            $emailNoters = [];
            while ($row = $result->fetch_assoc()) {
                $emailNoters[] = $row;
            }

            $mail = new PHPMailer(true);
            try {
                $query = "SELECT subject FROM documents WHERE id = ?";
                $stmt = $mysqli->prepare($query);
                $stmt->bind_param('i', $selectedID);
                $stmt->execute();
                $result = $stmt->get_result();
            
                if (!$result) {
                    die("SQL Error (query): " . $mysqli->error);
                }
            
                $subjectRow = $result->fetch_assoc();
                $subject = $subjectRow['subject'];

                // Server settings
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

                for($x = 0; $x < count($emailNoters); $x++){
                    $mail->addAddress($emailNoters[$x]['email'], $emailNoters[$x]['name']);
                }
                $mail->isHTML(true);
                $mail->Subject = $subject;
                $mail->Body    = 'A document letter is sent to you for approval. <br> Click the link to view here: <a href="http://localhost/COMS/AdminPage/Request.php">View Document</a>';
                $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

                $mail->send();

                $query = "UPDATE recipients SET emailSent = 1 WHERE role = 'Noter' AND documentID = ?";
                $stmt = $mysqli->stmt_init();
                if(!$stmt->prepare($query)){
                    die("SQL Error". $mysqli->error);
                }
                $stmt->bind_param('s', $selectedID);
                $stmt->execute();
            } catch (Exception $e) {
                echo 'Error: '. $e;
            }
            $stmt->close();            
        }
        $mysqli->close();
    }

    function notifyRecipient($selectedID){
        $database = new Database();
        $mysqli = $database->getConnection();

        $query = "SELECT status FROM recipients WHERE role = 'Endorser' AND documentID = '$selectedID'";
        $result = $mysqli->query($query);

        if (!$result) {
            die("SQL Error (query): " . $mysqli->error);
        }

        $endroserStatus = [];
        while ($row = $result->fetch_assoc()) {
            $endroserStatus[] = $row;
        }

        $endorserCount = 0;
        for($x = 0; $x < count($endroserStatus); $x++){
            $status = $endroserStatus[$x]['status'];
            if($status == "Signed"){
                $endorserCount++;
            }
        }

        if($endorserCount == count($endroserStatus)){
            $query = "UPDATE recipients SET isVisible = 1 WHERE role = 'Recipient' AND documentID = ?";
            $stmt = $mysqli->stmt_init();
            if(!$stmt->prepare($query)){
                die("SQL Error". $mysqli->error);
            }
            $stmt->bind_param('s', $selectedID);
            $stmt->execute();

            $query = "SELECT name, email FROM recipients WHERE role = 'Recipient' AND  documentID = '$selectedID' AND emailSent = 0";
            $result = $mysqli->query($query);

            if (!$result) {
                die("SQL Error (query): " . $mysqli->error);
            }
    
            $recipient = [];
            while ($row = $result->fetch_assoc()) {
                $recipient[] = $row;
            }

            $mail = new PHPMailer(true);
            try {
                $query = "SELECT subject FROM documents WHERE id = ?";
                $stmt = $mysqli->prepare($query);
                $stmt->bind_param('i', $selectedID);
                $stmt->execute();
                $result = $stmt->get_result();
            
                if (!$result) {
                    die("SQL Error (query): " . $mysqli->error);
                }
            
                $subjectRow = $result->fetch_assoc();
                $subject = $subjectRow['subject'];

                // Server settings
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

                for($x = 0; $x < count($recipient); $x++){
                    $mail->addAddress($recipient[$x]['email'], $recipient[$x]['name']);
                }
                $mail->isHTML(true);
                $mail->Subject = $subject;
                $mail->Body    = 'A document letter is sent to you for approval. <br> Click the link to view here: <a href="http://localhost/COMS/AdminPage/Request.php">View Document</a>';
                $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

                $mail->send();

                $query = "UPDATE recipients SET emailSent = 1 WHERE role = 'Recipient' AND documentID = ?";
                $stmt = $mysqli->stmt_init();
                if(!$stmt->prepare($query)){
                    die("SQL Error". $mysqli->error);
                }
                $stmt->bind_param('s', $selectedID);
                $stmt->execute();
            } catch (Exception $e) {
                echo 'Error: '. $e;
            }
            $stmt->close();            
        }
        $mysqli->close();
    }

    if (isset($_GET['action']) && $_GET['action'] == 'getDocumentDetails') {
        getDocuments();
    }
    elseif(isset($_POST['selectedID'])) {
        $selectedID = $_POST['selectedID'];
        getRecipient($selectedID);
    }
    elseif(isset($_GET['action']) && $_GET['action'] == 'rejected'){
        rejected();
    }
    elseif(isset($_GET['action']) && $_GET['action'] == 'approved'){
        approved();
    }
    elseif(isset($_GET['action']) && $_GET['action'] == 'updateDocumentStatusApproved'){
        updateDocumentStatusApproved();
    }
    elseif(isset($_GET['action']) && $_GET['action'] == 'updateDocumentStatusRejected'){
        updateDocumentStatusRejected();
    } 
?>