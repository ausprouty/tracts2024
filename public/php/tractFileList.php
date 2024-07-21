<?php
// Allow from any origin
header("Access-Control-Allow-Origin: *");
// Allow specific methods
header("Access-Control-Allow-Methods: GET");
// Allow specific headers
header("Access-Control-Allow-Headers: Content-Type");

// Function to get the MIME type based on file extension
function getMimeType($filename) {
    $mimeType = mime_content_type($filename);
    if ($mimeType) {
        return $mimeType;
    }
    // Default to application/octet-stream if mime_content_type fails
    return 'application/octet-stream';
}

// Function to get directory contents recursively
function getDirContents($dir, $baseDir, &$results = array()) {
    $files = scandir($dir);  // Get all files and directories in the current directory

    foreach ($files as $key => $value) {
        $path = realpath($dir . DIRECTORY_SEPARATOR . $value);  // Construct the full path
        if (!is_dir($path)) {
            $relativePath = str_replace($baseDir . DIRECTORY_SEPARATOR, '', $path);
            $results[] = $relativePath;
        } else if ($value != "." && $value != "..") {
            getDirContents($path, $baseDir, $results);  // Recursively get contents of subdirectories
        }
    }

    return $results;
}

// Set the directory to scan
$directory = realpath('../tracts');  // Adjust this path as necessary
$adjusted_directory = realpath('../');

if ($directory === false || !is_readable($directory)) {
    http_response_code(500);
    echo json_encode(["error" => "Directory not found or not readable"]);
    exit;
}

$files = getDirContents($directory, $adjusted_directory);  // Get all files and directories

// Determine the appropriate content type for the response
if (!empty($files)) {
    $fileExtension = pathinfo($files[0], PATHINFO_EXTENSION);
    switch (strtolower($fileExtension)) {
        case 'json':
            header('Content-Type: application/json');
            break;
        case 'html':
            header('Content-Type: text/html');
            break;
        case 'jpg':
        case 'jpeg':
            header('Content-Type: image/jpeg');
            break;
        case 'png':
            header('Content-Type: image/png');
            break;
        default:
            header('Content-Type: ' . getMimeType($files[0]));
            break;
    }
} else {
    header('Content-Type: application/json');
}

// Output the results as JSON for now; you can modify this to handle other content types if needed
echo json_encode($files);
?>
