<?php
require 'db.php';
require 'blog_functions.php';

$postId = intval($_GET['id'] ?? 0);
$ipAddress = $_SERVER['REMOTE_ADDR'] ?? '0.0.0.0';

if ($postId > 0) {
    
    // 1. LOG THE UNIQUE VIEW
    logPostView($pdo, $postId, $ipAddress);
    
    // 2. FETCH THE POST & PDF URL
    $stmt = $pdo->prepare("SELECT headline, pdf_file_url FROM blog_posts WHERE id = ? AND is_active = TRUE");
    $stmt->execute([$postId]);
    $post = $stmt->fetch();

    if ($post) {
        $pdfUrl = htmlspecialchars($post['pdf_file_url']);
        $headline = htmlspecialchars($post['headline']);
        
        // 3. DISPLAY THE PDF
        ?>
        <!DOCTYPE html>
        <html>
        <head><title><?= $headline ?> - Research Insight</title></head>
        <body style="margin: 0; padding: 0; background-color: #f0f0f0;">
            <div style="padding: 10px; background-color: #0A2540; color: white; text-align: center;">
                <a href="research_blog.php" style="color: #FFC82F; text-decoration: none; font-weight: bold;">← Back to Insights</a>
                <h1 style="font-size: 1.5em; margin: 5px 0;"><?= $headline ?></h1>
            </div>
            <iframe src="<?= $pdfUrl ?>" style="width:100%; height:92vh; display: block;" frameborder="0"></iframe>
        </body>
        </html>
        <?php
        exit;
    }
}

// Fallback if post not found or ID is invalid
header("Location: research_blog.php");
exit;
?>