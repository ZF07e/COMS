<?php
    require ('../../LandingPage/Functions/SessionManagement.php');
    require ('../../LandingPage/Functions/connectionDB.php');
    require 'vendor/autoload.php';

    use Dompdf\Dompdf;

    function getDocuments() {
        $database = new Database();
        $mysqli = $database->getConnection();

        $query = 'SELECT id, sender, status, subject, filename, htmlContent, DATE(timestamp) as date_only FROM documents';
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

    // function selectEndorsers($id){
    //     $database = new Database();
    //     $mysqli = $database->getConnection();

    //     $query = "SELECT name FROM recipients WHERE documentID = '$id' AND role = 'Endorser'";
    //     $stmt = $mysqli->stmt_init();
    //     if(!$stmt->prepare($query)){
    //         die("SQL Error". $mysqli->error);
    //     }
    //     $stmt->execute();
    //     $result = $stmt->get_result();
    //     $endorser = [];
    //     while ($row = $result->fetch_assoc()) {
    //         $endorser[] = $row;
    //     }
    //     return $endorser;
    // }

    // function selectNoters($id){
    //     $database = new Database();
    //     $mysqli = $database->getConnection();

    //     $query = "SELECT name FROM recipients WHERE documentID = '$id' AND role = 'Noter'";
    //     $stmt = $mysqli->stmt_init();
    //     if(!$stmt->prepare($query)){
    //         die("SQL Error". $mysqli->error);
    //     }
    //     $stmt->execute();
    //     $result = $stmt->get_result();
    //     $noter = [];
    //     while ($row = $result->fetch_assoc()) {
    //         $noter[] = $row;
    //     }
    //     return $noter;
    // }

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

    function updateStatus($name, $selectedID){
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

    if (isset($_GET['action']) && $_GET['action'] == 'getDocumentDetails') {
        getDocuments();
        exit();
    }
    elseif(isset($_POST['selectedID'])) {
        $selectedID = $_POST['selectedID'];
        getRecipient($selectedID);
    }
    elseif(isset($_POST['signature'])){
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
        echo $selectedID;

        $dompdf = new Dompdf();
        $dompdf->loadHtml($newhtmlcontents);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        $pdfData = $dompdf->output();
        $folderPath = '../../PDF-FILES/';
        $filePath = '../../PDF-FILES/'.$selectedID.'.pdf';
        
        file_put_contents($filePath, $pdfData);
        updateData($newhtmlcontents, $selectedID);
        updateStatus($fullName, $selectedID);
    }
?>