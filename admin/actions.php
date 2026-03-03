<?php
session_start();
require_once '../config.php';

// Check if a form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';

    // Handle adding a new Digital Platform
    if ($action === 'add_platform') {
        $name = $_POST['name'] ?? '';
        $url = $_POST['url'] ?? '';
        $tagline = $_POST['tagline'] ?? '';
        $description = $_POST['description'] ?? '';
        $status = $_POST['status'] ?? 'Live';
        $launch_date = date('Y-m-d'); // Sets today's date automatically

        $logo_path = '';

        // Handle the logo file upload
        if (isset($_FILES['logo']) && $_FILES['logo']['error'] === UPLOAD_ERR_OK) {
            $upload_dir = 'uploads/platforms/';
            
            // Get the original file extension (e.g., jpg, png)
            $file_ext = strtolower(pathinfo($_FILES['logo']['name'], PATHINFO_EXTENSION));
            
            // Create a clean, unique file name based on the platform name to avoid overwriting
            $clean_name = preg_replace('/[^a-zA-Z0-9]/', '_', strtolower($name));
            $new_file_name = $clean_name . '_' . time() . '.' . $file_ext;
            
            $target_file = $upload_dir . $new_file_name;

            // Move the file from the temporary location to your actual folder
            if (move_uploaded_file($_FILES['logo']['tmp_name'], $target_file)) {
                // We prepend 'admin/' to the path saved in the DB. 
                // This ensures the public portfolio.php file (in the root directory) can find the image easily.
                $logo_path = 'admin/' . $target_file; 
            }
        }

        // Save the platform data to the database
        try {
            $stmt = $pdo->prepare("INSERT INTO platforms (name, tagline, description, url, logo_path, status, launch_date) VALUES (?, ?, ?, ?, ?, ?, ?)");
            $stmt->execute([$name, $tagline, $description, $url, $logo_path, $status, $launch_date]);

            // Redirect back to the admin command center after successful save
            header("Location: index.php?success=1");
            exit;
        } catch (PDOException $e) {
            // If something goes wrong with the database, show the error
            die("Database Error: " . $e->getMessage());
        }
    }
}
?>