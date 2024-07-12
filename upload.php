<?php
// Database connection parameters
$host = 'localhost'; // Database host
$db = 'csv'; // Database name
$user = 'root'; // Database user
$pass = ''; // Database password

// Create connection
$conn = new mysqli($host, $user, $pass, $db);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if a file was uploaded
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['file'])) {
    $file = $_FILES['file']['tmp_name'];

    // Open the file
    if (($handle = fopen($file, "r")) !== FALSE) {
        while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
            $name = $data[0];
            $about = $data[1];

            // Validate that 'about' is numeric
            if (is_numeric($about)) {
                // Prepare and bind
                $stmt = $conn->prepare("INSERT INTO your_table (name, about) VALUES (?, ?)");
                $stmt->bind_param("si", $name, $about);
                
                // Execute the statement
                if ($stmt->execute()) {
                    echo "Record added successfully: $name, $about<br>";
                } else {
                    echo "Error: " . $stmt->error . "<br>";
                }
            } else {
                echo "Invalid 'about' value for $name: must be numeric.<br>";
            }
        }
        fclose($handle);
    } else {
        echo "Error opening the file.";
    }
} else {
    echo "No file uploaded.";
}

// Close connection
$conn->close();
?>
