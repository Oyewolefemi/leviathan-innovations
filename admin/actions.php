<?php
session_start();
require_once '../config.php';
require_admin(); // Auth guard applied to prevent unauthorized inserts

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';

    // Handle Adding a New Digital Platform
    if ($action === 'add_platform') {
        $name = $_POST['name'] ?? '';
        $tagline = $_POST['tagline'] ?? '';
        $description = $_POST['description'] ?? '';
        $url = $_POST['url'] ?? '';
        $status = $_POST['status'] ?? 'Live';
        $launch_date = date('Y-m-d'); // Defaulting to today's date
        
        $logo_path = '';

        // Safely Handle Logo Upload
        if (isset($_FILES['logo']) && $_FILES['logo']['error'] === UPLOAD_ERR_OK) {
            
            // Ensure the directory exists (fixes the missing folder issue)
            $upload_dir = 'uploads/platforms/';
            if (!is_dir($upload_dir)) {
                mkdir($upload_dir, 0777, true);
            }

            // Sanitize filename and create unique path
            $file_extension = strtolower(pathinfo($_FILES['logo']['name'], PATHINFO_EXTENSION));
            $allowed_extensions = ['jpg', 'jpeg', 'png', 'svg', 'webp'];
            
            if (in_array($file_extension, $allowed_extensions)) {
                $clean_name = preg_replace('/[^a-zA-Z0-9_-]/', '_', strtolower($name));
                $new_filename = $clean_name . '_' . time() . '.' . $file_extension;
                $target_file = $upload_dir . $new_filename;
                
                if (move_uploaded_file($_FILES['logo']['tmp_name'], $target_file)) {
                    // Path to save in DB (from perspective of public root folder)
                    $logo_path = 'admin/' . $target_file; 
                }
            }
        }

        // Insert into database
        $stmt = $pdo->prepare("INSERT INTO platforms (name, tagline, description, url, logo_path, status, launch_date) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->execute([$name, $tagline, $description, $url, $logo_path, $status, $launch_date]);

        // Redirect back to dashboard with success message
        header("Location: index.php?success=platform_added");
        exit;
    }
    
    // Fallback redirect if action doesn't match
    header("Location: index.php");
    exit;
} else {
    // If someone tries to access actions.php directly without a POST request
    header("Location: index.php");
    exit;
}