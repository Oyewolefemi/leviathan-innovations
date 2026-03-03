<?php
session_start();
require_once '../config.php';

// If already logged in, redirect straight to the dashboard
if (isset($_SESSION['is_admin']) && $_SESSION['is_admin'] === true) {
    header("Location: index.php");
    exit;
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    // Hardcoded credentials for access (change 'admin123' to your actual preferred password)
    if ($username === 'sefunmi' && $password === 'admin123') { 
        $_SESSION['is_admin'] = true;
        header("Location: index.php");
        exit;
    } else {
        $error = "Invalid credentials. Please try again.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login | Leviathan</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&family=Space+Grotesk:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
        .heading { font-family: 'Space Grotesk', sans-serif; }
    </style>
</head>
<body class="bg-[#F6F9FC] h-screen flex items-center justify-center">
    <div class="bg-white p-8 rounded-2xl shadow-lg w-full max-w-md border border-gray-100">
        <div class="text-center mb-8">
            <h2 class="text-3xl font-bold text-[#0A2540] heading">Leviathan<span class="text-[#00D4FF]">.</span></h2>
            <p class="text-sm text-gray-500 mt-2 font-medium tracking-wide uppercase">Admin Console</p>
        </div>
        
        <?php if($error): ?>
            <div class="bg-red-50 text-red-600 p-4 rounded-xl mb-6 text-sm font-medium border border-red-100 flex items-center gap-3">
                <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                <?= htmlspecialchars($error) ?>
            </div>
        <?php endif; ?>

        <form method="POST" class="space-y-5">
            <div>
                <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">Username</label>
                <input type="text" name="username" class="w-full border border-gray-200 rounded-xl p-3 text-sm focus:ring-2 focus:ring-[#00D4FF] focus:border-[#00D4FF] focus:outline-none transition-all" required autofocus>
            </div>
            <div>
                <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">Password</label>
                <input type="password" name="password" class="w-full border border-gray-200 rounded-xl p-3 text-sm focus:ring-2 focus:ring-[#00D4FF] focus:border-[#00D4FF] focus:outline-none transition-all" required>
            </div>
            <button type="submit" class="w-full bg-[#0A2540] text-white rounded-xl py-3.5 font-bold hover:bg-opacity-90 transition-all shadow-md mt-2 flex items-center justify-center gap-2">
                Access Console
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
            </button>
        </form>
    </div>
</body>
</html>