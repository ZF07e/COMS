<?php
    require ('../../LandingPage/Functions/SessionManagement.php');
    require ('../../LandingPage/Functions/connectionDB.php');
    require 'vendor/autoload.php';

    use PhpOffice\PhpWord\PhpWord;
    use PhpOffice\PhpWord\IOFactory;
    use PhpOffice\PhpWord\SimpleType\Jc;
    use PhpOffice\PhpWord\TemplateProcessor;

    //print_r($_POST);
    $text;

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Retrieve the text data
        $text = $_POST['text'] ?? '';

        // Retrieve and decode the JSON string to a PHP array
        $recipientJson = $_POST['recipient'] ?? '';
        $recipient = json_decode($recipientJson, true);

        // Check if decoding was successful
        if (json_last_error() === JSON_ERROR_NONE) {
            // Function to clean and extract email from each entry
            function extractEmails($entries) {
                return array_map(function($entry) {
                    // Remove brackets and any leading/trailing whitespace
                    return trim($entry, '[] ');
                }, $entries);
            }

            // Extract and clean emails from each category
            $toEmails = extractEmails($recipient['to'] ?? []);
            $endorsedEmails = extractEmails($recipient['endorsed'] ?? []);
            $notedEmails = extractEmails($recipient['noted'] ?? []);
            $approvedEmails = extractEmails($recipient['approved'] ?? []);

            // Example: Output the cleaned email addresses
            echo "Received text: " . $text . "<br>";
            echo "To Emails: " . implode(", ", $toEmails) . "<br>";
            echo "Endorsed Emails: " . implode(", ", $endorsedEmails) . "<br>";
            echo "Noted Emails: " . implode(", ", $notedEmails) . "<br>";
            echo "Approved Emails: " . implode(", ", $approvedEmails) . "<br>";

        } else {
            echo "Error decoding JSON: " . json_last_error_msg();
        }
    } else {
        echo "No data received.";
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
    }
    $logoRight = getImageFromDatabase('STICA');
    $logoLeft = getImageFromDatabase(getUserAffiliation());
    $association = getUserAffiliation();

    echo $logoRight. "<br>";
    echo $logoLeft;

    // Function to add images and text to the header
    function addHeaderWithLogosAndText($section, $logoLeft, $logoRight, $headerText) {
        $header = $section->addHeader();
        $table = $header->addTable();
        $table->addRow();

        // Left logo
        $cell = $table->addCell(2500);
        $cell->addImage($logoLeft, array('width' => 100, 'height' => 100, 'alignment' => \PhpOffice\PhpWord\SimpleType\Jc::LEFT));

        // Center text
        $cell = $table->addCell(5000, array('valign' => 'center'));

        // Split header text into lines
        $lines = explode("\n", $headerText);
        foreach ($lines as $index => $line) {
            if ($index == 0) {
                // First line: bold, size 17, centered
                $cell->addText($line, array('name' => 'Arial', 'size' => 17, 'bold' => true), array('alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER, 'spaceAfter' => 0));
            }
            elseif ($index == 1) {
                // First line: bold, size 17, centered
                $cell->addText($line, array('name' => 'Times New Roman', 'size' => 17), array('alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER, 'spaceAfter' => 0));
            } 
            else {
                // Other lines: normal, size 12, centered
                $cell->addText($line, array('name' => 'Arial', 'size' => 12), array('alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER, 'spaceAfter' => 0));
            }
        }

        // Right logo
        $cell = $table->addCell(2500);
        $cell->addImage($logoRight, array('width' => 100, 'height' => 100, 'alignment' => \PhpOffice\PhpWord\SimpleType\Jc::RIGHT));
    }

    $templateFile = 'SAMPLE_TEMPLATE.docx';
    $phpWord = IOFactory::load($templateFile);
    $section = $phpWord->getSections()[0];

    // Replace the placeholder with the actual club/organization name
    $headerTextTemplate = "STI COLLEGE ALABANG\n[Club/Organization]\nRZB Building Interior Montillano St.\nAlabang, Muntinlupa City";
    $headerText = str_replace('[Club/Organization]', $association, $headerTextTemplate);
    
    addHeaderWithLogosAndText($section, $logoLeft, $logoRight, $headerText);

    $phpWord->save('modified_template.docx');

    $templateProcessor = new TemplateProcessor('modified_template.docx');
    $placeholders = $templateProcessor->getVariables();
    echo 'Placeholders found in template: <pre>' . print_r($placeholders, true) . '</pre>';

    $section = $phpWord->addSection();
    //Replace placeholders in the document
    $templateProcessor->setValue('Date', date('m/d/y'));
    $templateProcessor->setValue('Recipient', 'WALA PA');
    $templateProcessor->setValue('Requester', "WALA PA");
    $templateProcessor->setValue('LetterContent', htmlspecialchars($text));

    // Saving the document as a Word file
    $fileName = 'GeneratedLetter.docx';
    $templateProcessor->saveAs($fileName);

    echo "<a href='$fileName'>Download the letter</a>";
?>
