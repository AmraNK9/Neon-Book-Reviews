<?php
if(isset($_POST['download_pdf'])) {
    $file_path = isset($_POST['file_path']) ? $_POST['file_path'] : '';
    $file_name = isset($_POST['file_name']) ? $_POST['file_name'] : '';

    if (!empty($file_path) && !empty($file_name)) {
        downloadPDF($file_path, $file_name);
    } else {
        echo 'Please provide both a file path and a file name.';
    }
}

// Your downloadPDF function goes here (as described in the previous response)

// Function to download a PDF file
function downloadPDF($file_path, $file_name) {
    // Check if the file exists
    if (file_exists($file_path)) {
        // Set headers for PDF download
        header('Content-Description: File Transfer');
        header('Content-Type: application/pdf');
        header('Content-Disposition: attachment; filename="' . $file_name . '"');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($file_path));
        
        // Output the PDF file content
        readfile($file_path);
        exit;
    } else {
        // File not found
        echo 'File not found';
    }
}
?>
