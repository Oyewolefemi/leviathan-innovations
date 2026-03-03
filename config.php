<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
// 1. Start session
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// 2. Load .env file
require_once __DIR__ . '/EnvLoader.php';
try {
    loadEnv(__DIR__ . '/.env');
} catch (\RuntimeException $e) {
    die("Error: Environment configuration file (.env) not found. " . $e->getMessage());
}

// 3. Database Connection
$dsn = sprintf(
    "mysql:host=%s;dbname=%s;charset=%s",
    $_ENV['DB_HOST'],
    $_ENV['DB_NAME'],
    $_ENV['DB_CHARSET']
);

$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    $pdo = new PDO($dsn, $_ENV['DB_USER'], $_ENV['DB_PASS'], $options);
} catch (\PDOException $e) {
    throw new \PDOException($e->getMessage(), (int)$e->getCode());
}

// 4. Helper Functions

/**
 * Redirects to login page if user is not authenticated.
 */
function require_admin() {
    if (!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] !== true) {
        header('Location: login.php');
        exit;
    }
}

/**
 * Creates a URL-friendly slug from a headline.
 */
function createSlug($text) {
    $text = preg_replace('~[^\pL\d]+~u', '-', $text);
    $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
    $text = preg_replace('~[^-\w]+~', '', $text);
    $text = trim($text, '-');
    $text = preg_replace('~-+~', '-', $text);
    return strtolower(empty($text) ? 'n-a' : $text);
}

/**
 * Logs a unique post view for the day.
 */
function logPostView(PDO $pdo, int $postId, string $ipAddress) {
    $date = date('Y-m-d');
    
    // Check if this IP has viewed this post today
    $stmt = $pdo->prepare("SELECT id FROM blog_views WHERE post_id = ? AND ip_address = ? AND view_date = ?");
    $stmt->execute([$postId, $ipAddress, $date]);
    
    if (!$stmt->fetch()) {
        // Log the view
        $stmt = $pdo->prepare("INSERT INTO blog_views (post_id, ip_address, view_date) VALUES (?, ?, ?)");
        $stmt->execute([$postId, $ipAddress, $date]);
    }
}

/**
 * Calculates analytics (daily, weekly, monthly readers).
 * FIXED: Changed 'view_time' to 'view_date' to match table structure.
 */
function getBlogAnalytics(PDO $pdo): array {
    // 1. Daily Readers (Last 7 days)
    $daily = $pdo->query("SELECT view_date, COUNT(DISTINCT ip_address) as readers 
                          FROM blog_views 
                          WHERE view_date >= DATE_SUB(CURDATE(), INTERVAL 7 DAY) 
                          GROUP BY view_date ORDER BY view_date DESC")->fetchAll();

    // 2. Weekly Readers (Last 4 weeks)
    $weekly = $pdo->query("SELECT YEARWEEK(view_date) as week_num, COUNT(DISTINCT ip_address) as readers 
                           FROM blog_views 
                           WHERE view_date >= DATE_SUB(CURDATE(), INTERVAL 4 WEEK) 
                           GROUP BY week_num ORDER BY week_num DESC")->fetchAll();

    // 3. Monthly Readers (Last 12 months)
    $monthly = $pdo->query("SELECT DATE_FORMAT(view_date, '%Y-%m') as month_str, COUNT(DISTINCT ip_address) as readers 
                            FROM blog_views 
                            WHERE view_date >= DATE_SUB(CURDATE(), INTERVAL 12 MONTH) 
                            GROUP BY month_str ORDER BY month_str DESC")->fetchAll();

    return ['daily' => $daily, 'weekly' => $weekly, 'monthly' => $monthly];
}

/**
 * Fetches all posts for the admin panel.
 */
function getAllPosts(PDO $pdo): array {
    // UPDATED to fetch new columns
    return $pdo->query("SELECT id, headline, slug, publish_date, is_active, author_name, category_name FROM blog_posts ORDER BY publish_date DESC")->fetchAll();
}