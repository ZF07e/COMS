<?php
    if (isset($_POST['data'])) {
        $data = json_decode($_POST['data'], true);
        if (json_last_error() === JSON_ERROR_NONE) {
            // Process the array of objects here (e.g., save to database, perform calculations, etc.)
            echo "Received array of objects: " . print_r($data, true);
        } else {
            echo "JSON decoding error";
        }
    } else {
        echo "No data received";
    }
?>