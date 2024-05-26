<?php
    require ('../../LandingPage/Functions/SessionManagement.php');
    require ('../../LandingPage/Functions/connectionDB.php');
    require 'vendor/autoload.php';

    use PhpOffice\PhpWord\PhpWord;
    use PhpOffice\PhpWord\IOFactory;
    use PhpOffice\PhpWord\SimpleType\Jc;
    use PhpOffice\PhpWord\TemplateProcessor;
    use PhpOffice\PhpWord\Shared\Html;

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
            echo "Recipients for $type:<br>";
            foreach ($recipients as $recipient) {
                echo "Name: " . htmlspecialchars($recipient['firstname'])." ".htmlspecialchars($recipient['lastname']). "<br>";
                echo "Email: " . htmlspecialchars($recipient['email']) . "<br>";
                echo "Position: " . htmlspecialchars($recipient['position']) . "<br>";
            }
        }
        // Process the text content
        echo "Text Content:<br>" . htmlspecialchars($text) . "<br><br>";
    
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
        return $imageURL;
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

    function addHeaderWithLogosAndText($section, $logoLeft, $logoRight, $headerText) {
        $header = $section->addHeader();
        $table = $header->addTable();
        $table->addRow();

        // Left logo
        $cell = $table->addCell(2500);
        $cell->addImage($logoLeft, array('width' => 80, 'height' => 80, 'alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER));

        // Center text
        $cell = $table->addCell(5000, array('valign' => 'center'));

        // Split header text into lines
        $lines = explode("\n", $headerText);
        foreach ($lines as $index => $line) {
            if ($index == 0) {
                $cell->addText($line, array('name' => 'Times New Roman', 'size' => 20, 'bold' => true), array('alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER, 'spaceAfter' => 0));
            }
            elseif ($index == 1) {
                $cell->addText($line, array('name' => 'Times New Roman', 'size' => 18), array('alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER, 'spaceAfter' => 0));
            } 
            else {
                $cell->addText($line, array('name' => 'Times New Roman', 'size' => 10), array('alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER, 'spaceAfter' => 0));
            }
        }

        // Right logo
        $cell = $table->addCell(2500);
        $cell->addImage($logoRight, array('width' => 100, 'height' => 80, 'alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER));
    }

    $templateFile = '../WordDocuments/SAMPLE_TEMPLATE.docx';
    $phpWord = IOFactory::load($templateFile);
    $section = $phpWord->getSections()[0];

    // Header section with placeholder
    $headerTextTemplate = "STI COLLEGE ALABANG\n[Club/Organization]\nRZB Building Interior Montillano St.\nAlabang, Muntinlupa City";
    $headerText = str_replace('[Club/Organization]', $association, $headerTextTemplate);
    addHeaderWithLogosAndText($section, $logoLeft, $logoRight, $headerText);

    //Reciever section
    $date = date('F j, Y');
    $recipientFullname = trim($recipientTo[0]['firstname']." ".$recipientTo[0]['lastname']);
    $section->addText("$date", null, array('spaceAfter' => 0));
    $section->addText($recipientFullname, array('bold' => true), array('spaceAfter' => 0));
    $section->addText(trim($recipientTo[0]['position']), array('italic' => true), array('spaceAfter' => 0));
    $section->addText("STI College Alabang", array('italic' => true));
    $section->addTextBreak(1);

    // Greetings section
    $textRun = $section->addTextRun();
    $textRun->addText("Greetings ");
    $textRun->addText($recipientTo[0]['lastname'], array('bold' => true, 'italic' => true, 'spaceAfter' => 0));
    $textRun->addText(",", null, array('spaceAfter' => 0));

    $htmlContentWithStyle = preg_replace_callback(
        '/<(ul|ol)[^>]*>(.*?)<\/\\1>/is',
        function ($matches) {
            $listType = $matches[1];
            $listItems = $matches[2];
            // Apply style to list items
            $listItemsWithStyle = preg_replace('/<li>/', '<li style="line-height: 1;">', $listItems);
            return "<$listType>$listItemsWithStyle</$listType>";
        },
        $text
    );

    $lineHeight = 'line-height: 1;';
    $htmlContent = preg_replace('/<p([^>]*)>/', '<p$1 style="' . $lineHeight . '">', $htmlContentWithStyle);

    echo $htmlContent;
    //Body letter
    $section->addTextBreak(0.5);
    Html::addHtml($section, $htmlContent);

    //Complimentary close
    $section->addTextBreak(1);
    $section->addText("Sincerely,");
    $section->addText('${Student signature}', null, array('spaceAfter' => 0));
    $section->addText($writer, array('bold' => true), array('spaceAfter' => 0));
    $section->addText($writerPosition, array('italic' => true), array('spaceAfter' => 0));
    $section->addTextBreak(1);

    $table = $section->addTable();
    $table->addRow();
    $leftCell = $table->addCell(4500);
    $centerCell = $table->addCell(4500);
    $rightCell = $table->addCell(4500);

    //Endorsed section
    $leftCell->addText("Endorsed by:");
    $leftCell->addTextBreak(1);
    $leftCell->addText('${Signature0}',  null, array('alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER, 'spaceAfter' => 0));
    $leftCell->addText('${Endorser0}', array('bold' => true), array('alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER, 'spaceAfter' => 0));
    $textRun = $leftCell->addTextRun(array('alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER));
    $textRun->addText('${Position0}', array('italic' => true), array( 'spaceAfter' => 0));
    $textRun->addText('${Association0}', array('italic' => true, 'bold' => true), array('spaceAfter' => 0));

    $centerCell->addTextBreak(2);
    $centerCell->addText('${Signature1}',  null, array('alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER, 'spaceAfter' => 0));
    $centerCell->addText('${Endorser1}', array('bold' => true, ), array('alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER, 'spaceAfter' => 0));
    $textRun = $centerCell->addTextRun(array('alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER));
    $textRun->addText('${Position1}', array('italic' => true), array( 'spaceAfter' => 0));
    $textRun->addText('${Association1}', array('italic' => true, 'bold' => true), array('spaceAfter' => 0));

    $rightCell->addTextBreak(2);
    $rightCell->addText('${Signature2}',  null, array('alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER, 'spaceAfter' => 0));
    $rightCell->addText('${Endorser2}', array('bold' => true), array('alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER, 'spaceAfter' => 0));
    $textRun = $rightCell->addTextRun(array('alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER));
    $textRun->addText('${Position2}', array('italic' => true), array( 'spaceAfter' => 0));
    $textRun->addText('${Association2}', array('italic' => true, 'bold' => true), array('spaceAfter' => 0));

    $table->addRow();
    $singleLeftCell = $table->addCell(4500, array('gridSpan' => 3));

    $singleLeftCell->addTextBreak(2);
    $singleLeftCell->addText('${Signature3}',  null, array('alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER, 'spaceAfter' => 0));
    $singleLeftCell->addText('${Endorser3}', array('bold' => true), array('alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER, 'spaceAfter' => 0));
    $textRun = $singleLeftCell->addTextRun(array('alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER));
    $textRun->addText('${Position3}', array('italic' => true), array( 'spaceAfter' => 0));
    $textRun->addText('${Association3}', array('italic' => true, 'bold' => true), array('spaceAfter' => 0));

    //Noted section
    $table->addRow();
    $leftNewCell = $table->addCell(4500);
    $centerNewCell = $table->addCell(4500);
    $rightNewCell = $table->addCell(4500);

    $leftNewCell->addText("Noted by:");
    $leftNewCell->addTextBreak(1);
    $leftNewCell->addText('${Note signature0}',  null, array('alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER, 'spaceAfter' => 0));
    $leftNewCell->addText('${Noted0}', array('bold' => true), array('alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER, 'spaceAfter' => 0));
    $leftNewCell->addText('${Note position0}', array('italic' => true), array('bold' => true, 'alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER, 'spaceAfter' => 0));

    $rightNewCell->addTextBreak(2);
    $rightNewCell->addText('${Note signature1}',  null, array('alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER, 'spaceAfter' => 0));
    $rightNewCell->addText('${Noted1}', array('bold' => true), array('alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER, 'spaceAfter' => 0));
    $rightNewCell->addText('${Note position1}', array('italic' => true), array('bold' => true, 'alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER, 'spaceAfter' => 0));

    $docuDate = date('F-j-Y');
    $phpWord->save('../WordDocuments/'.$association.'-'.$docuDate.'.docx');

    $templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor('../WordDocuments/'.$association.'-'.$docuDate.'.docx');
    $placeholders = $templateProcessor->getVariables();
    echo 'Placeholders found in template: <pre>' . print_r($placeholders, true) . '</pre>';

    //Endorse values
    for ($x = 0; $x < 4; $x++){
        if($x < count($endorsed)){
            $fullName = $endorsed[$x]['firstname']." ".$endorsed[$x]['lastname'];
            if(trim($endorsed[$x]['position']) == 'Adviser'){
                $templateProcessor->setValue('Endorser'.$x, $fullName);
                $templateProcessor->setValue('Position'.$x, $endorsed[$x]['position']);
                $templateProcessor->setValue('Association'.$x, ", ".$association);
            }
            else{
                $templateProcessor->setValue('Endorser'.$x, $fullName);
                $templateProcessor->setValue('Position'.$x, $endorsed[$x]['position']);
                $templateProcessor->setValue('Association'.$x, null);
            }
        }
        else{
            $templateProcessor->setValue('Signature'.$x, null);
            $templateProcessor->setValue('Endorser'.$x, null);
            $templateProcessor->setValue('Position'.$x, null);
            $templateProcessor->setValue('Association'.$x, null);
        }
    }

    //Noted value
    for ($x = 0; $x < 2; $x++){
        if($x < count($noted)){
            $fullName = $noted[$x]['firstname']." ".$noted[$x]['lastname'];
            echo $fullName." <br>";
            $templateProcessor->setValue('Noted'.$x, $fullName);
            $templateProcessor->setValue('Note position'.$x, $noted[$x]['position']);
        }
        else{
            $templateProcessor->setValue('Note signature'.$x, null);
            $templateProcessor->setValue('Noted'.$x, null);
            $templateProcessor->setValue('Note position'.$x, null);
        }
    }

    $fileName = 'Finalized-'.$association.'-'.$docuDate.'.docx';
    $templateProcessor->saveAs($fileName);

    $finalizedDocumentContent = file_get_contents($fileName);
    //$finalizedDocumentBinaryData = base64_encode($finalizedDocumentContent);

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

    function saveToDatabase($id, $fileName, $data) {
        $database = new Database();
        $mysqli = $database->getConnection();
    
        $query = 'INSERT INTO documents (id, fileName, data, timestamp) VALUES (?, ?, ?, NOW())';
        
        $stmt = $mysqli->prepare($query);
        if (!$stmt) {
            die("SQL Error: " . $mysqli->error);
        }
    
        $null = NULL; // For use with send_long_data
        $stmt->bind_param("ssb", $id, $fileName, $null);
    
        // Send binary data
        $stmt->send_long_data(2, $data);
    
        if (!$stmt->execute()) {
            die("Execute Error: " . $stmt->error);
        }
    
        $stmt->close();
        $mysqli->close();
    }

    saveToDatabase(generateUniqueID(), $fileName, $finalizedDocumentContent);

    echo "<a href='$fileName'>Download the letter</a>";
    unlink($fileName);
?>