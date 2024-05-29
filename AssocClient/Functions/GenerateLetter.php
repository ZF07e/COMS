<?php
    require ('../../LandingPage/Functions/SessionManagement.php');
    require ('../../LandingPage/Functions/connectionDB.php');
    require 'vendor/autoload.php';

    use Dompdf\Dompdf;

    $text;
    $recipientTo;
    $endorsed;
    $noted;
    $approved;

    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $text = $_POST['text'] ?? '';
    
        // Retrieve and decode the recipient arrays
        $recipientTo = json_decode($_POST['recipientTo'] ?? '[]', true);
        $endorsed = json_decode($_POST['endorsed'] ?? '[]', true);
        $noted = json_decode($_POST['noted'] ?? '[]', true);
        $approved = json_decode($_POST['approved'] ?? '[]', true);
    
        // Function to process recipients
        function processRecipients($recipients, $type) {
            //echo "Recipients for $type:<br>";
            foreach ($recipients as $recipient) {
                //echo "Name: " . htmlspecialchars($recipient['firstname'])." ".htmlspecialchars($recipient['lastname']). "<br>";
                // echo "Email: " . htmlspecialchars($recipient['email']) . "<br>";
                // echo "Position: " . htmlspecialchars($recipient['position']) . "<br>";
            }
        }
    
        // Process each recipient list
        processRecipients($recipientTo, 'TO');
        processRecipients($endorsed, 'Endorsed');
        processRecipients($noted, 'Noted');
        processRecipients($approved, 'Approved');
    }
    else {
        echo "Error: Only POST requests are allowed.";
    }

    function getImageFromDatabase($name) {
        $database = new Database();
        $mysqli = $database->getConnection();
        $fileName;

        $query = "SELECT fileName FROM associationimages WHERE name = ?";
        
        $stmt = $mysqli->stmt_init();
        if (!$stmt->prepare($query)) {
            die("SQL Error: " . $mysqli->error);
        }
        $stmt->bind_param("s", $name);
        $stmt->execute();
        $result = $stmt->get_result();
        $data = $result->fetch_assoc();

        if (is_array($data)) {
            $fileName = implode($data);
        } else {
            $fileName = $data;
        }
        $imageURL = "../../Images/AssosiationsPfp/".$fileName;
        $stmt->close();
        $mysqli->close();

        $imagePath = $imageURL;
        $type = pathinfo($imagePath, PATHINFO_EXTENSION);
        $data = file_get_contents($imagePath);
        $image = 'data:image/' . $type . ';base64,' . base64_encode($data);
        return strval($image);
    }

    function getUserAffiliation(){
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
            return $affiliation;
        } else {
            // Handle error
            echo "Error preparing statement: " . $mysqli->error;
            return null;
        }
        $mysqli->close();
    }

    function getUsername(){
        $database = new Database();
        $mysqli = $database->getConnection();

        $email = $_SESSION['email'];

        $sql = "SELECT firstName, lastName FROM users WHERE email = ?";
        $stmt = $mysqli->prepare($sql);
        if ($stmt) {
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $stmt->bind_result($firstname, $lastname);
            $stmt->fetch();
            $stmt->close();
            return $firstname." ". $lastname;
        } else {
            // Handle error
            echo "Error preparing statement: " . $mysqli->error;
            return null;
        }
        $mysqli->close();
    }

    function getUserPosition(){
        $database = new Database();
        $mysqli = $database->getConnection();

        $email = $_SESSION['email'];

        $sql = "SELECT position FROM users WHERE email = ?";
        $stmt = $mysqli->prepare($sql);
        if ($stmt) {
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $stmt->bind_result($position);
            $stmt->fetch();
            $stmt->close();
            return $position;
        } else {
            // Handle error
            echo "Error preparing statement: " . $mysqli->error;
            return null;
        }
        $mysqli->close();
    }

    $logoRight = getImageFromDatabase('STICA');
    $logoLeft = getImageFromDatabase(getUserAffiliation());
    $writer = getUsername();
    $writerPosition = getUserPosition();
    $association = getUserAffiliation();
    $date = date('F j, Y');
    $recipientFullname = trim($recipientTo[0]['firstname']." ".$recipientTo[0]['lastname']);


    function generateEndorsementSection($endorsedCount) {
        $endorsed = json_decode($_POST['endorsed'] ?? '[]', true);
        $html1 = '<div class="endorsed1">';
        $html2 = '<div class="endorsed2">';

        for ($i = 0; $i < $endorsedCount; $i++) {
            if ($i == 0) {
                $html1 .= '
                <div class="endorser1" style="float: left;"> 
                    <br>
                    <img src= "image" class="signatureStyle">        
                    <p>
                    <strong>'.$endorsed[$i]['firstname'].' '. $endorsed[$i]['lastname'].'</strong><br>
                    <i>'.$endorsed[$i]['position'].'</i></p>
                </div>';
            } elseif ($i == 1) {
                $html1 .= '
                <div class="endorser2" style="float: right;"> 
                    <br>
                    <img src= "image"class="signatureStyle">
                    <p> 
                    <strong>'.$endorsed[$i]['firstname'].' '. $endorsed[$i]['lastname'].'</strong><br>
                    <i>'.$endorsed[$i]['position'].'</i></p>
                </div>';
            } elseif ($i == 2) {
                $html2 .= '
                <div class="endorser3" style="float: left;">
                    <br> 
                    <img src= "image"class="signatureStyle"> 
                    <strong>'.$endorsed[$i]['firstname'].' '. $endorsed[$i]['lastname'].'</strong><br>
                    <i>'.$endorsed[$i]['position'].'</i></p>
                </div>';
            } elseif ($i == 3) {
                $html2 .= '
                <div class="endorser4" style="float: right;">
                    <br> 
                    <img src= "image"class="signatureStyle"> 
                    <strong>'.$endorsed[$i]['firstname'].' '. $endorsed[$i]['lastname'].'</strong><br>
                    <i>'.$endorsed[$i]['position'].'</i></p>
                </div>';
            }
        }
        $html1 .= '<div style="clear: both;"></div>';
        $html2 .= '<div style="clear: both;"></div>';
        $html1 .= '</div>';
        $html2 .= '</div>';

        $htmlFinal = $html1 . $html2;
        return $htmlFinal;
    }

    function gerateNotedSection($notedCount) {
        $noted = json_decode($_POST['noted'] ?? '[]', true);
        $html1 = '<div class="noted1">';
        $html2 = '<div class="noted2">';

        for ($i = 0; $i < $notedCount; $i++) {
            if ($i == 0) {
                $html1 .= '
                <div class="noted1" style="float: left;"> 
                    <br>
                    <img src= "image" class="signatureStyle">        
                    <p>
                    <strong>'.$noted[$i]['firstname'].' '. $noted[$i]['lastname'].'</strong><br>
                    <i>'.$noted[$i]['position'].'</i></p>
                </div>';
            } elseif ($i == 1) {
                $html1 .= '
                <div class="noted2" style="float: right;"> 
                    <br>
                    <img src= "image"class="signatureStyle">
                    <p> 
                    <strong>'.$noted[$i]['firstname'].' '. $noted[$i]['lastname'].'</strong><br>
                    <i>'.$noted[$i]['position'].'</i></p>
                </div>';
            } elseif ($i == 2) {
                $html2 .= '
                <div class="noted3" style="float: left;">
                    <br>
                    <img src= "image"class="signatureStyle">
                    <p> 
                    <strong>Fullname'.$noted[$i]['firstname'].' '. $noted[$i]['lastname'].'</strong><br>
                    <i>'.$noted[$i]['position'].'</i></p>
                </div>';
            } elseif ($i == 3) {
                $html2 .= '
                <div class="noted4" style="float: right;">
                    <br> 
                    <img src= "image"class="signatureStyle"> 
                    <p>
                    <strong>'.$noted[$i]['firstname'].' '. $noted[$i]['lastname'].'</strong><br>
                    <i>'.$noted[$i]['position'].'</i></p>
                </div>';
            }
        }
        $html1 .= '<div style="clear: both;"></div>';
        $html2 .= '<div style="clear: both;"></div>';
        $html1 .= '</div>';
        $html2 .= '</div>';

        $htmlFinal = $html1 . $html2;
        return $htmlFinal;
    }

    $htmlContent = '
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Request Letter</title>
            <style>
                
                body {
                    font-family: Arial, sans-serif;
                    margin: 0;
                    padding: 0;
                }

                .header {
                    padding: 0px 20px;
                    text-align: center; 
                    font-family: "Times New Roman";
                }

                .headerText {
                    margin: 0rem 3rem;
                    display: inline-block;
                    vertical-align: middle;
                    line-height: 0px;   
                }

                .header img {
                    max-width: 100px;
                }

                .letter {
                    padding: 0px 20px;
                    line-height: 1.6;
                }

                .letterInfo{
                    line-height: 1;
                }

                .endorsed{
                    display: grid;
                    grid-template-columns: 1fr 1fr;
                }

                .endorsed1, .endorsed2{
                    padding: 0rem 5rem;
                }

                .endorser1 p, .endorser2 p, .endorser3 p, .endorser4 p{
                    margin: 0;
                    text-align: center;
                }

                .endorsed1{
                    margin-botom: 10px;
                }

                .noted{
                    display: grid;
                    grid-template-columns: 1fr 1fr;
                }

                .noted1, .noted2{
                    padding: 0rem 5rem;
                }

                .noted1 p, .noted2 p, .noted3 p, .noted4 p{
                    margin: 0;
                    text-align: center;
                }

                .noted1{
                    margin-botom: 10px;
                }

                .textBody{
                    line-height: 1.3;
                }
            </style>
        </head>
        <body>
            <div class="header">
                <img src= '.$logoLeft.' class="logo-left">
                    <div class="headerText">
                        <h2>STI COLLEGE ALABANG</h2>
                        <p style = "font-size: 1.5rem;">'.$association.'</p>
                        <p>RZB Building Interior Montiliano St.</p>
                        <p>Alabang, Muntinlupa City</p>
                    </div>

                <img src='.$logoRight.' class="logo-right">
            </div>

            <div class="letter">
                <p class="letterInfo">
                    '.$date.'<br>
                    <strong>'.$recipientFullname.'</strong><br>
                    '.trim($recipientTo[0]['position']).'<br>
                    <i>STI College Alabang</i>
                </p>

                <p>
                    Warm Greetings!
                </p>
                
                <div class="textBody">
                '.$text.'
                </div>  
                
                <p>
                    Sincerely,<br>
                    <img src= "image" class="signatureStyle"> <br>
                    <strong>'.$writer.'</strong><br>
                    <i>'.$writerPosition.'<i>
                </p>
            </div>
            <div>
            Endorsed by:
            ' . generateEndorsementSection(count($endorsed)) . '
            </div>
            <div>
            Noted by:
            '.gerateNotedSection(count($noted)).'
            </div>
        </body>
        </html>
        ';

    ini_set('memory_limit', '512M'); 

    $dompdf = new Dompdf();
    $dompdf->loadHtml($htmlContent);
    $dompdf->setPaper('A4', 'portrait');
    $dompdf->render();

    function generateUniqueID(){
        $database = new Database();
        $mysqli = $database->getConnection();
        $query = 'SELECT associationCode FROM users WHERE email = ?';
        $email = $_SESSION['email'];
        $code;

        $stmt = $mysqli->stmt_init();
        if(!$stmt->prepare($query)){
            die("SQL Error". $mysqli->error);
        }
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $result = $stmt->get_result();
        $data = $result->fetch_assoc();

        if(gettype($data) == "array"){
            $code = implode($data);
        }
        else{
            $code = $data;
        }
        $randomNumber = mt_rand(10000, 99999);
        $stmt->close();
        $mysqli->close();  
        return 'LTTR'.$code.'-'.$randomNumber;
    }

    $uniqueID = generateUniqueID();
    $pdfData = $dompdf->output();
    $folderPath = '../../PDF-FILES/';
    $filePath = '../../PDF-FILES/'.$uniqueID.'.pdf';
    file_put_contents($filePath, $pdfData);

    $pdfName = $uniqueID.'.pdf';

    function savePdfToDatabase($id, $sender, $status, $subject, $filename, $htmlcontents) {
        $database = new Database();
        $mysqli = $database->getConnection();
    
        $query = 'INSERT INTO documents (id, sender, status, subject, fileName, htmlContent, timestamp) VALUES (?, ?, ?, ?, ?, ?, NOW())';

        $stmt = $mysqli->stmt_init();
        if(!$stmt->prepare($query)){
            die("SQL Error". $mysqli->error);
        }
        $stmt->bind_param("ssssss", $id, $sender, $status, $subject, $filename, $htmlcontents);
        $stmt->execute();
        $mysqli->close();
    }    

    savePdfToDatabase($uniqueID, $writer, "Inbox", "No Subject", $pdfName, $htmlContent);

    //$dompdf->stream("Coders_Club_Letter.pdf", array("Attachment" => 0));
    header("Location: ../Request.php");
?>