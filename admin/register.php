<?php
session_start();
require_once '../config.php';

$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    if (!empty($username) && !empty($password)) {
        // Securely hash the password
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        try {
            $stmt = $pdo->prepare("INSERT INTO admins (username, password_hash) VALUES (?, ?)");
            $stmt->execute([$username, $hashed_password]);
            $message = "<div class='bg-green-100 text-green-700 p-3 rounded mb-4 text-sm'>Admin account created successfully! You can now delete this file and login.</div>";
        } catch (PDOException $e) {
            $message = "<div class='bg-red-100 text-red-700 p-3 rounded mb-4 text-sm'>Error: Username might already exist.</div>";
        }
    } else {
        $message = "<div class='bg-yellow-100 text-yellow-700 p-3 rounded mb-4 text-sm'>Please fill in all fields.</div>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Initial Admin Setup</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-[#F6F9FC] h-screen flex items-center justify-center">
    <div class="bg-white p-8 rounded-2xl shadow-lg w-96 border border-gray-100">
        <h2 class="text-2xl font-bold text-[#0A2540] mb-2 text-center">Admin Registration</h2>
        <p class="text-xs text-red-500 text-center mb-6 font-bold uppercase tracking-wide">⚠️ Delete this file after use</p>
        
        <?= $message ?>

        <form method="POST" class="space-y-4">
            <div>
                <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-1.5">Username</label>
                <input type="text" name="username" class="w-full border border-gray-200 rounded-xl p-2.5" required>
            </div>
            <div>
                <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-1.5">Password</label>
                <input type="password" name="password" class="w-full border border-gray-200 rounded-xl p-2.5" required>
            </div>
            <button type="submit" class="w-full bg-[#00D4FF] text-[#0A2540] rounded-xl py-3 font-bold hover:bg-opacity-90 transition shadow-md">Create Admin</button>
        </form>
    </div>
</body>
</html>