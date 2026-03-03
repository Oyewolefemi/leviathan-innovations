<?php
session_start();
require_once '../config.php';
require_admin(); // Auth guard applied

// Fetch Platforms from the database
$stmt_platforms = $pdo->query("SELECT * FROM platforms ORDER BY created_at DESC");
$platforms = $stmt_platforms->fetchAll(PDO::FETCH_ASSOC);

$live_platforms = 0;
foreach($platforms as $p) {
    if($p['status'] === 'Live') $live_platforms++;
}

// Fetch Blog Posts from the database
$stmt_posts = $pdo->query("SELECT * FROM blog_posts ORDER BY publish_date DESC");
$blog_posts = $stmt_posts->fetchAll(PDO::FETCH_ASSOC);
$total_posts = count($blog_posts);

// Fetch Analytics (using your existing config.php function)
$analytics = function_exists('getBlogAnalytics') ? getBlogAnalytics($pdo) : [];
$total_readers = $analytics['total_views'] ?? 0;
$today_readers = $analytics['today_views'] ?? 0;
$monthly_readers = $analytics['monthly_views'] ?? 0;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Leviathan Admin Panel</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'brand-blue': '#0A2540',
                        'brand-cyan': '#00D4FF',
                        'brand-yellow': '#FFC82F',
                        'light-bg': '#F6F9FC',
                    },
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                        heading: ['Space Grotesk', 'sans-serif'],
                    }
                }
            }
        }
    </script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&family=Space+Grotesk:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
        h1,h2,h3,h4,.heading { font-family: 'Space Grotesk', sans-serif; }
        .nav-link.active { background-color: rgba(0,212,255,0.12); color:#00D4FF; border-left:3px solid #00D4FF; }
        .nav-link { border-left:3px solid transparent; transition:all 0.2s ease; }
        .nav-link:hover { background-color:rgba(255,255,255,0.06); color:#fff; }
        .panel { display:none; }
        .panel.active { display:block; }
        .font-grotesk { font-family:'Space Grotesk',sans-serif; }
        .font-inter { font-family:'Inter',sans-serif; }
        .font-serif-stack { font-family:'Georgia',serif; }
        .font-mono-stack { font-family:'Courier New',monospace; }
        tbody tr:hover { background-color:#F6F9FC; }
        #wordmark-preview { background:repeating-linear-gradient(45deg,#f8fafc,#f8fafc 10px,#f1f5f9 10px,#f1f5f9 20px); }
        .stat-card-blue { background:linear-gradient(135deg,#0A2540 0%,#1a3a5c 100%); }
        .stat-card-cyan { background:linear-gradient(135deg,#006d83 0%,#00D4FF 100%); }
        .stat-card-yellow { background:linear-gradient(135deg,#b8860b 0%,#FFC82F 100%); }
        .stat-card-green { background:linear-gradient(135deg,#065f46 0%,#10b981 100%); }
        ::-webkit-scrollbar{width:5px;}::-webkit-scrollbar-track{background:#f1f1f1;}::-webkit-scrollbar-thumb{background:#c1c1c1;border-radius:10px;}
    </style>
</head>
<body class="bg-light-bg min-h-screen flex">

    <aside class="w-64 min-h-screen bg-brand-blue flex flex-col fixed top-0 left-0 z-30 shadow-2xl">
        <div class="px-6 py-5 border-b border-white/10">
            <a href="../index.php" class="flex items-center gap-2">
                <span class="text-2xl font-bold text-white heading">Leviathan<span class="text-brand-cyan">.</span></span>
            </a>
            <p class="text-xs text-white/40 mt-1 font-medium tracking-widest uppercase">Admin Console</p>
        </div>
        <nav class="flex-1 px-3 py-6 space-y-1 overflow-y-auto">
            <p class="text-white/30 text-xs font-bold uppercase tracking-widest px-3 mb-3">Overview</p>
            <a href="#" class="nav-link active flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium text-white/80" onclick="switchPanel('dashboard',this);return false;">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7h7v7H3zM3 17h7v4H3zM13 3h8v6h-8zM13 12h8v9h-8z"/></svg>
                Dashboard
            </a>
            <p class="text-white/30 text-xs font-bold uppercase tracking-widest px-3 mt-5 mb-3">Content</p>
            <a href="#" class="nav-link flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium text-white/60" onclick="switchPanel('blog',this);return false;">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                Blog Posts
            </a>
            <a href="#" class="nav-link flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium text-white/60" onclick="switchPanel('vendors',this);return false;">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                Digital Platforms
            </a>
            <p class="text-white/30 text-xs font-bold uppercase tracking-widest px-3 mt-5 mb-3">Tools</p>
            <a href="#" class="nav-link flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium text-white/60" onclick="switchPanel('wordmark',this);return false;">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"/></svg>
                Wordmark Studio
            </a>
            <a href="#" class="nav-link flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium text-white/60" onclick="switchPanel('analytics',this);return false;">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
                Analytics
            </a>
        </nav>
        <div class="px-4 py-4 border-t border-white/10">
            <div class="flex items-center gap-3">
                <div class="w-8 h-8 bg-brand-cyan/20 rounded-full flex items-center justify-center text-brand-cyan font-bold text-sm">S</div>
                <div><p class="text-white text-sm font-semibold">Sefunmi</p><p class="text-white/40 text-xs">Leviathan HQ</p></div>
                <a href="logout.php" class="ml-auto text-white/30 hover:text-white/70 transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                </a>
            </div>
        </div>
    </aside>

    <div class="ml-64 flex-1 flex flex-col min-h-screen">
        <header class="bg-white border-b border-gray-100 px-8 py-4 flex items-center justify-between sticky top-0 z-20 shadow-sm">
            <div>
                <h1 id="page-title" class="text-lg font-bold text-brand-blue heading">Dashboard</h1>
                <p id="page-subtitle" class="text-xs text-gray-400 mt-0.5">Welcome back. Here's what's happening.</p>
            </div>
            <div class="flex items-center gap-3">
                <span class="text-xs text-gray-400 bg-gray-50 border border-gray-200 px-3 py-1.5 rounded-full font-medium" id="current-date"></span>
                <a href="../index.php" class="text-xs bg-brand-blue text-white px-4 py-2 rounded-full font-semibold hover:bg-opacity-90 transition-all">← View Site</a>
            </div>
        </header>

        <main class="flex-1 p-8">

            <div id="panel-dashboard" class="panel active">
                <?php if(isset($_GET['success'])): ?>
                    <div class="bg-emerald-50 text-emerald-600 p-4 rounded-xl mb-6 text-sm font-medium border border-emerald-100 flex items-center gap-3">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                        Action completed successfully!
                    </div>
                <?php endif; ?>
                
                <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-5 mb-8">
                    <div class="stat-card-blue text-white p-5 rounded-2xl shadow-lg">
                        <p class="text-white/60 text-xs uppercase tracking-widest font-semibold mb-3">Total Posts</p>
                        <p class="text-4xl font-bold heading"><?= $total_posts ?></p>
                        <p class="text-white/50 text-xs mt-2">Active database rows</p>
                    </div>
                    <div class="stat-card-cyan text-white p-5 rounded-2xl shadow-lg">
                        <p class="text-white/80 text-xs uppercase tracking-widest font-semibold mb-3">Today's Readers</p>
                        <p class="text-4xl font-bold heading"><?= number_format($today_readers) ?></p>
                        <p class="text-white/70 text-xs mt-2">Unique views today</p>
                    </div>
                    <div class="stat-card-yellow text-white p-5 rounded-2xl shadow-lg">
                        <p class="text-white/80 text-xs uppercase tracking-widest font-semibold mb-3">Live Platforms</p>
                        <p class="text-4xl font-bold heading"><?= $live_platforms ?></p>
                        <p class="text-white/70 text-xs mt-2">Portfolio showcase</p>
                    </div>
                    <div class="stat-card-green text-white p-5 rounded-2xl shadow-lg">
                        <p class="text-white/80 text-xs uppercase tracking-widest font-semibold mb-3">Monthly Readers</p>
                        <p class="text-4xl font-bold heading"><?= number_format($monthly_readers) ?></p>
                        <p class="text-white/70 text-xs mt-2">Total views this month</p>
                    </div>
                </div>
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                    <div class="lg:col-span-2 bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                        <div class="flex items-center justify-between mb-6">
                            <h3 class="font-bold text-brand-blue heading">Total Cumulative Readers</h3>
                            <span class="text-xs text-gray-400 bg-gray-50 border border-gray-100 px-3 py-1 rounded-full">All Time</span>
                        </div>
                        <div class="flex items-center justify-center h-40 flex-col">
                            <p class="text-6xl font-bold text-brand-blue heading"><?= number_format($total_readers) ?></p>
                            <p class="text-sm text-gray-500 mt-2">Unique article interactions</p>
                        </div>
                    </div>
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                        <h3 class="font-bold text-brand-blue heading mb-5">Quick Actions</h3>
                        <div class="space-y-3">
                            <button onclick="switchPanel('blog',document.querySelectorAll('.nav-link')[1])" class="w-full text-left px-4 py-3 bg-light-bg hover:bg-brand-cyan/10 rounded-xl text-sm font-semibold text-brand-blue transition-all border border-transparent hover:border-brand-cyan/30 flex items-center gap-3">
                                <svg class="w-4 h-4 text-brand-cyan" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>New Blog Post
                            </button>
                            <button onclick="switchPanel('vendors',document.querySelectorAll('.nav-link')[2])" class="w-full text-left px-4 py-3 bg-light-bg hover:bg-brand-yellow/10 rounded-xl text-sm font-semibold text-brand-blue transition-all border border-transparent hover:border-brand-yellow/30 flex items-center gap-3">
                                <svg class="w-4 h-4 text-brand-yellow" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>Add Platform
                            </button>
                            <button onclick="switchPanel('wordmark',document.querySelectorAll('.nav-link')[3])" class="w-full text-left px-4 py-3 bg-light-bg hover:bg-indigo-50 rounded-xl text-sm font-semibold text-brand-blue transition-all border border-transparent hover:border-indigo-200 flex items-center gap-3">
                                <svg class="w-4 h-4 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"/></svg>Wordmark Studio
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <div id="panel-blog" class="panel">
                <div class="flex items-center justify-between mb-6">
                    <div><h2 class="text-xl font-bold text-brand-blue heading">Blog Posts</h2><p class="text-sm text-gray-400 mt-1">Manage research insights and articles.</p></div>
                    <button onclick="toggleModal('modal-new-post')" class="bg-brand-blue text-white px-5 py-2.5 rounded-full text-sm font-bold hover:bg-opacity-90 transition-all shadow-md flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>New Post
                    </button>
                </div>
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                    <table class="w-full text-sm">
                        <thead class="bg-light-bg"><tr>
                            <th class="text-left px-6 py-3 text-xs font-bold text-gray-400 uppercase tracking-wider">Headline</th>
                            <th class="text-left px-6 py-3 text-xs font-bold text-gray-400 uppercase tracking-wider">Author</th>
                            <th class="text-left px-6 py-3 text-xs font-bold text-gray-400 uppercase tracking-wider">Category</th>
                            <th class="text-left px-6 py-3 text-xs font-bold text-gray-400 uppercase tracking-wider">Published</th>
                            <th class="text-left px-6 py-3 text-xs font-bold text-gray-400 uppercase tracking-wider">Status</th>
                            <th class="text-left px-6 py-3 text-xs font-bold text-gray-400 uppercase tracking-wider">Actions</th>
                        </tr></thead>
                        <tbody class="divide-y divide-gray-50">
                            <?php foreach($blog_posts as $post): ?>
                            <tr>
                                <td class="px-6 py-4 font-medium text-brand-blue max-w-xs truncate"><?= htmlspecialchars($post['headline']) ?></td>
                                <td class="px-6 py-4 text-gray-500"><?= htmlspecialchars($post['author_name'] ?? 'Leviathan') ?></td>
                                <td class="px-6 py-4"><span class="px-2 py-1 bg-indigo-50 text-indigo-600 rounded-full text-xs font-semibold"><?= htmlspecialchars($post['category_name']) ?></span></td>
                                <td class="px-6 py-4 text-gray-400"><?= htmlspecialchars(date('Y-m-d', strtotime($post['publish_date']))) ?></td>
                                <td class="px-6 py-4">
                                    <?php if($post['status'] === 'Active'): ?>
                                        <span class="px-2 py-1 bg-emerald-100 text-emerald-700 rounded-full text-xs font-bold">Active</span>
                                    <?php else: ?>
                                        <span class="px-2 py-1 bg-gray-100 text-gray-500 rounded-full text-xs font-bold">Inactive</span>
                                    <?php endif; ?>
                                </td>
                                <td class="px-6 py-4"><div class="flex items-center gap-2">
                                    <button class="text-gray-400 hover:text-brand-yellow transition-colors p-1.5 rounded-lg hover:bg-light-bg" title="Toggle Status"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 9l4-4 4 4m0 6l-4 4-4-4"/></svg></button>
                                </div></td>
                            </tr>
                            <?php endforeach; ?>
                            
                            <?php if(empty($blog_posts)): ?>
                                <tr><td colspan="6" class="px-6 py-8 text-center text-gray-500">No blog posts found in the database.</td></tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <div id="panel-vendors" class="panel">
                <div class="flex items-center justify-between mb-6">
                    <div><h2 class="text-xl font-bold text-brand-blue heading">Digital Platforms</h2><p class="text-sm text-gray-400 mt-1">Manage portfolio systems powered by Leviathan.</p></div>
                    <button onclick="toggleModal('modal-new-platform')" class="bg-brand-blue text-white px-5 py-2.5 rounded-full text-sm font-bold hover:bg-opacity-90 transition-all shadow-md flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>Add Platform
                    </button>
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-5">
                    
                    <?php foreach($platforms as $platform): ?>
                    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm hover:shadow-md transition-all flex flex-col items-center text-center p-6">
                        <div class="w-20 h-20 rounded-full border-2 border-gray-100 p-1 mb-4 flex-shrink-0">
                            <img src="../<?= htmlspecialchars($platform['logo_path']) ?>" alt="<?= htmlspecialchars($platform['name']) ?>" class="w-full h-full object-cover rounded-full bg-light-bg">
                        </div>
                        <h3 class="font-bold text-brand-blue heading mb-1"><?= htmlspecialchars($platform['name']) ?></h3>
                        <span class="text-xs font-semibold px-2 py-0.5 rounded-full mb-3 <?= $platform['status'] === 'Live' ? 'bg-emerald-50 text-emerald-600' : 'bg-brand-yellow/10 text-brand-yellow' ?>"><?= htmlspecialchars($platform['status']) ?></span>
                        <p class="text-xs text-gray-500 mb-5 flex-grow"><?= htmlspecialchars($platform['tagline']) ?></p>
                        <div class="flex gap-2 w-full mt-auto">
                            <a href="<?= htmlspecialchars($platform['url']) ?>" target="_blank" class="flex-1 text-center text-xs font-bold text-brand-blue bg-light-bg hover:bg-brand-cyan/10 py-2 rounded-lg transition-colors border border-transparent hover:border-brand-cyan/30">View Live</a>
                        </div>
                    </div>
                    <?php endforeach; ?>

                    <button onclick="toggleModal('modal-new-platform')" class="bg-white rounded-2xl border-2 border-dashed border-gray-200 hover:border-brand-cyan shadow-sm hover:shadow-md transition-all p-5 flex flex-col items-center justify-center gap-3 text-gray-400 hover:text-brand-cyan min-h-[240px] group">
                        <div class="w-12 h-12 bg-gray-50 group-hover:bg-brand-cyan/10 rounded-xl flex items-center justify-center transition-colors"><svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg></div>
                        <span class="text-sm font-semibold">Add New Platform</span>
                    </button>
                    
                </div>
            </div>

            <div id="panel-wordmark" class="panel">
                <div class="mb-6"><h2 class="text-xl font-bold text-brand-blue heading">Wordmark Studio</h2><p class="text-sm text-gray-400 mt-1">Create clean text-based logos. Type, style, download.</p></div>
                <div class="grid grid-cols-1 lg:grid-cols-5 gap-6">
                    <div class="lg:col-span-2 space-y-5">
                        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-5">
                            <h4 class="font-bold text-brand-blue heading text-sm mb-4">Brand Name</h4>
                            <div class="space-y-3">
                                <div>
                                    <label class="text-xs text-gray-400 font-semibold uppercase tracking-wider block mb-1.5">Full Text</label>
                                    <input id="wm-text" type="text" value="Leviathan" class="w-full text-sm border border-gray-200 rounded-lg px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-brand-cyan/40 font-medium">
                                </div>
                                <div>
                                    <label class="text-xs text-gray-400 font-semibold uppercase tracking-wider block mb-1.5">Accent Characters</label>
                                    <input id="wm-accent" type="text" value="." placeholder="e.g. . or Lab" class="w-full text-sm border border-gray-200 rounded-lg px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-brand-cyan/40">
                                </div>
                                <div>
                                    <label class="text-xs text-gray-400 font-semibold uppercase tracking-wider block mb-1.5">Tagline <span class="font-normal text-gray-300">(optional)</span></label>
                                    <input id="wm-tagline" type="text" placeholder="Venture Lab · Est. 2025" class="w-full text-sm border border-gray-200 rounded-lg px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-brand-cyan/40">
                                </div>
                            </div>
                        </div>
                        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-5">
                            <h4 class="font-bold text-brand-blue heading text-sm mb-4">Colors</h4>
                            <div class="space-y-3">
                                <div class="flex items-center justify-between">
                                    <label class="text-xs text-gray-500 font-semibold uppercase tracking-wider">Main</label>
                                    <div class="flex items-center gap-2"><input id="wm-main-color" type="color" value="#0A2540" class="w-8 h-8 rounded-lg border border-gray-200 cursor-pointer"><span id="wm-main-hex" class="text-xs font-mono text-gray-500">#0A2540</span></div>
                                </div>
                                <div class="flex items-center justify-between">
                                    <label class="text-xs text-gray-500 font-semibold uppercase tracking-wider">Accent</label>
                                    <div class="flex items-center gap-2"><input id="wm-accent-color" type="color" value="#00D4FF" class="w-8 h-8 rounded-lg border border-gray-200 cursor-pointer"><span id="wm-accent-hex" class="text-xs font-mono text-gray-500">#00D4FF</span></div>
                                </div>
                                <div class="flex items-center justify-between">
                                    <label class="text-xs text-gray-500 font-semibold uppercase tracking-wider">Background</label>
                                    <div class="flex items-center gap-2"><input id="wm-bg-color" type="color" value="#ffffff" class="w-8 h-8 rounded-lg border border-gray-200 cursor-pointer"><span id="wm-bg-hex" class="text-xs font-mono text-gray-500">#ffffff</span></div>
                                </div>
                            </div>
                        </div>
                        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-5">
                            <h4 class="font-bold text-brand-blue heading text-sm mb-4">Typography</h4>
                            <div class="space-y-3">
                                <div>
                                    <label class="text-xs text-gray-400 font-semibold uppercase tracking-wider block mb-2">Font</label>
                                    <div class="grid grid-cols-2 gap-2">
                                        <button onclick="setFont('font-grotesk')" id="font-btn-grotesk" class="font-grotesk text-sm py-2 px-3 border-2 border-brand-cyan bg-brand-cyan/5 text-brand-blue rounded-lg font-bold">Space Grotesk</button>
                                        <button onclick="setFont('font-inter')" id="font-btn-inter" class="font-inter text-sm py-2 px-3 border border-gray-200 text-gray-500 rounded-lg">Inter</button>
                                        <button onclick="setFont('font-serif-stack')" id="font-btn-serif" class="font-serif-stack text-sm py-2 px-3 border border-gray-200 text-gray-500 rounded-lg">Georgia</button>
                                        <button onclick="setFont('font-mono-stack')" id="font-btn-mono" class="font-mono-stack text-sm py-2 px-3 border border-gray-200 text-gray-500 rounded-lg">Mono</button>
                                    </div>
                                </div>
                                <div>
                                    <label class="text-xs text-gray-400 font-semibold uppercase tracking-wider block mb-1.5">Weight</label>
                                    <select id="wm-weight" class="w-full text-sm border border-gray-200 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-brand-cyan/40">
                                        <option value="300">Light</option><option value="400">Regular</option><option value="500">Medium</option><option value="600">SemiBold</option><option value="700" selected>Bold</option>
                                    </select>
                                </div>
                                <div>
                                    <label class="text-xs text-gray-400 font-semibold uppercase tracking-wider block mb-1.5">Letter Spacing</label>
                                    <input id="wm-spacing" type="range" min="-2" max="10" value="0" step="0.5" class="w-full accent-brand-cyan">
                                </div>
                                <div>
                                    <label class="text-xs text-gray-400 font-semibold uppercase tracking-wider block mb-1.5">Font Size</label>
                                    <input id="wm-size" type="range" min="24" max="96" value="60" step="4" class="w-full accent-brand-cyan">
                                    <div class="flex justify-between text-xs text-gray-400 mt-1"><span>Small</span><span id="wm-size-val" class="font-mono">60px</span><span>Large</span></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="lg:col-span-3 space-y-5">
                        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-5">
                            <div class="flex items-center justify-between mb-4">
                                <h4 class="font-bold text-brand-blue heading text-sm">Live Preview</h4>
                                <div class="flex items-center gap-2">
                                    <button onclick="setPreviewBg('#ffffff')" class="w-6 h-6 rounded-full border-2 border-gray-300 bg-white hover:border-brand-cyan transition-colors" title="White"></button>
                                    <button onclick="setPreviewBg('#f1f5f9')" class="w-6 h-6 rounded-full border-2 border-transparent bg-gray-100 hover:border-brand-cyan transition-colors" title="Gray"></button>
                                    <button onclick="setPreviewBg('#0f172a')" class="w-6 h-6 rounded-full border-2 border-transparent bg-gray-900 hover:border-brand-cyan transition-colors" title="Dark"></button>
                                </div>
                            </div>
                            <div id="wordmark-preview" class="rounded-xl flex items-center justify-center min-h-48 p-10 transition-colors duration-300">
                                <div id="wm-render" class="text-center">
                                    <div id="wm-main-text" class="font-grotesk leading-none" style="color:#0A2540;font-weight:700;font-size:60px;letter-spacing:0px;">Leviathan<span id="wm-accent-span" style="color:#00D4FF;">.</span></div>
                                    <div id="wm-tagline-render" class="font-grotesk text-sm font-medium mt-3 tracking-widest uppercase hidden" style="color:#0A2540;opacity:0.5;"></div>
                                </div>
                            </div>
                        </div>
                        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-5">
                            <div class="flex items-center justify-between mb-3">
                                <h4 class="font-bold text-brand-blue heading text-sm">SVG Code</h4>
                                <button onclick="copySVG(this)" class="text-xs text-brand-cyan font-semibold hover:underline flex items-center gap-1">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"/></svg> Copy SVG
                                </button>
                            </div>
                            <pre id="wm-svg-code" class="bg-light-bg rounded-lg p-4 text-xs text-gray-500 overflow-x-auto whitespace-pre-wrap font-mono leading-relaxed max-h-40 overflow-y-auto"></pre>
                        </div>
                        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-5">
                            <h4 class="font-bold text-brand-blue heading text-sm mb-4">Export</h4>
                            <div class="flex flex-wrap gap-3">
                                <button onclick="downloadSVG()" class="flex items-center gap-2 bg-brand-blue text-white px-5 py-2.5 rounded-full text-sm font-bold hover:bg-opacity-90 transition-all shadow-md">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>Download SVG
                                </button>
                                <button onclick="downloadPNG(1)" class="flex items-center gap-2 bg-brand-cyan text-brand-blue px-5 py-2.5 rounded-full text-sm font-bold hover:bg-opacity-80 transition-all shadow-md">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>PNG @1x
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div id="panel-analytics" class="panel">
                <div class="mb-6"><h2 class="text-xl font-bold text-brand-blue heading">Analytics Overview</h2><p class="text-sm text-gray-400 mt-1">Reader insights pulled from the database.</p></div>
                
                <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden max-w-2xl">
                    <table class="w-full text-sm text-left">
                        <thead class="bg-light-bg">
                            <tr>
                                <th class="px-6 py-4 text-xs font-bold text-gray-500 uppercase tracking-wider">Metric</th>
                                <th class="px-6 py-4 text-xs font-bold text-gray-500 uppercase tracking-wider">Count</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50">
                            <tr>
                                <td class="px-6 py-4 font-medium text-brand-blue flex items-center gap-3">
                                    <div class="w-2 h-2 rounded-full bg-brand-cyan"></div> Today's Views
                                </td>
                                <td class="px-6 py-4 font-bold heading text-lg"><?= number_format($today_readers) ?></td>
                            </tr>
                            <tr>
                                <td class="px-6 py-4 font-medium text-brand-blue flex items-center gap-3">
                                    <div class="w-2 h-2 rounded-full bg-brand-yellow"></div> Monthly Views
                                </td>
                                <td class="px-6 py-4 font-bold heading text-lg"><?= number_format($monthly_readers) ?></td>
                            </tr>
                            <tr class="bg-gray-50">
                                <td class="px-6 py-4 font-medium text-brand-blue flex items-center gap-3">
                                    <div class="w-2 h-2 rounded-full bg-brand-blue"></div> All-Time Views
                                </td>
                                <td class="px-6 py-4 font-bold heading text-xl text-brand-blue"><?= number_format($total_readers) ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

        </main>
    </div>

    <div id="modal-new-post" class="hidden fixed inset-0 z-50 flex items-center justify-center p-4">
        <div class="absolute inset-0 bg-black/50 backdrop-blur-sm" onclick="toggleModal('modal-new-post')"></div>
        <div class="relative bg-white rounded-2xl shadow-2xl w-full max-w-2xl max-h-[90vh] overflow-y-auto">
            <div class="px-6 py-5 border-b border-gray-100 flex items-center justify-between">
                <h3 class="font-bold text-brand-blue heading text-lg">New Blog Post</h3>
                <button onclick="toggleModal('modal-new-post')" class="text-gray-400 hover:text-gray-600 transition-colors"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg></button>
            </div>
            <form class="p-6 space-y-4" action="create_post.php" method="POST">
                <div><label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-1.5">Headline *</label><input type="text" name="headline" required placeholder="Post headline…" class="w-full text-sm border border-gray-200 rounded-lg px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-brand-cyan/40"></div>
                <div class="grid grid-cols-2 gap-4">
                    <div><label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-1.5">Author</label><input type="text" name="author_name" value="Leviathan" class="w-full text-sm border border-gray-200 rounded-lg px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-brand-cyan/40"></div>
                    <div><label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-1.5">Category</label><select name="category_name" class="w-full text-sm border border-gray-200 rounded-lg px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-brand-cyan/40"><option>Strategy</option><option>Agro</option><option>Hospitality</option><option>Digital</option></select></div>
                </div>
                <div><label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-1.5">PDF File URL *</label><input type="url" name="pdf_file_url" required placeholder="https://…" class="w-full text-sm border border-gray-200 rounded-lg px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-brand-cyan/40"></div>
                <div><label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-1.5">Publish Date</label><input type="date" name="publish_date" class="w-full text-sm border border-gray-200 rounded-lg px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-brand-cyan/40"></div>
                <div class="flex items-center gap-3 pt-2"><input type="checkbox" name="is_active" id="is-active-check" checked class="accent-brand-cyan w-4 h-4"><label for="is-active-check" class="text-sm text-gray-600 font-medium">Publish immediately (Set to Active)</label></div>
                <div class="flex gap-3 pt-4 border-t border-gray-100">
                    <button type="submit" class="flex-1 bg-brand-blue text-white py-2.5 rounded-full font-bold text-sm hover:bg-opacity-90 transition-all shadow-md">Create Post</button>
                    <button type="button" onclick="toggleModal('modal-new-post')" class="px-6 py-2.5 rounded-full font-bold text-sm border border-gray-200 text-gray-500">Cancel</button>
                </div>
            </form>
        </div>
    </div>

    <div id="modal-new-platform" class="hidden fixed inset-0 z-50 flex items-center justify-center p-4">
        <div class="absolute inset-0 bg-black/50 backdrop-blur-sm" onclick="toggleModal('modal-new-platform')"></div>
        <div class="relative bg-white rounded-2xl shadow-2xl w-full max-w-2xl max-h-[90vh] overflow-y-auto">
            <div class="px-6 py-5 border-b border-gray-100 flex items-center justify-between">
                <h3 class="font-bold text-brand-blue heading text-lg">Add New Digital Platform</h3>
                <button onclick="toggleModal('modal-new-platform')" class="text-gray-400 hover:text-gray-600"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg></button>
            </div>
            <form action="actions.php" method="POST" enctype="multipart/form-data" class="p-6 space-y-4">
                <input type="hidden" name="action" value="add_platform">
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div><label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-1.5">Platform Name *</label><input type="text" name="name" required placeholder="e.g. ASIKO+" class="w-full text-sm border border-gray-200 rounded-lg px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-brand-cyan/40"></div>
                    <div><label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-1.5">URL (Live Link) *</label><input type="url" name="url" required placeholder="https://" class="w-full text-sm border border-gray-200 rounded-lg px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-brand-cyan/40"></div>
                </div>

                <div><label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-1.5">Tagline (Short Summary) *</label><input type="text" name="tagline" required placeholder="Multi-tenant business management..." class="w-full text-sm border border-gray-200 rounded-lg px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-brand-cyan/40"></div>

                <div><label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-1.5">Full Description *</label><textarea name="description" rows="4" required placeholder="Detail the system architecture, features..." class="w-full text-sm border border-gray-200 rounded-lg px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-brand-cyan/40"></textarea></div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div><label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-1.5">Status</label><select name="status" class="w-full text-sm border border-gray-200 rounded-lg px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-brand-cyan/40"><option value="Live">Live</option><option value="In Development">In Development</option></select></div>
                    <div><label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-1.5">Platform Logo *</label><input type="file" name="logo" accept="image/*" required class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-bold file:bg-light-bg file:text-brand-blue hover:file:bg-brand-cyan/10 pt-1"></div>
                </div>

                <div class="flex gap-3 pt-4 border-t border-gray-100">
                    <button type="submit" class="flex-1 bg-brand-blue text-white py-2.5 rounded-full font-bold text-sm hover:bg-opacity-90 transition-all shadow-md">Save Platform</button>
                    <button type="button" onclick="toggleModal('modal-new-platform')" class="px-6 py-2.5 rounded-full font-bold text-sm border border-gray-200 text-gray-500">Cancel</button>
                </div>
            </form>
        </div>
    </div>

    <script>
    // Date
    document.getElementById('current-date').textContent = new Date().toLocaleDateString('en-GB',{weekday:'short',day:'2-digit',month:'short',year:'numeric'});

    // Panel switching
    const panelMeta = {
        dashboard: ['Dashboard','Welcome back. Here\'s what\'s happening.'],
        blog:      ['Blog Posts','Manage research insights and articles.'],
        vendors:   ['Digital Platforms','Manage portfolio systems powered by Leviathan.'],
        wordmark:  ['Wordmark Studio','Create clean text-based logos.'],
        analytics: ['Analytics','Reader insights pulled from the database.'],
    };
    function switchPanel(id, el) {
        document.querySelectorAll('.panel').forEach(p => p.classList.remove('active'));
        document.getElementById('panel-'+id).classList.add('active');
        document.querySelectorAll('.nav-link').forEach(l => l.classList.remove('active'));
        if(el) el.classList.add('active');
        document.getElementById('page-title').textContent    = panelMeta[id][0];
        document.getElementById('page-subtitle').textContent = panelMeta[id][1];
    }
    function toggleModal(id) { document.getElementById(id).classList.toggle('hidden'); }

    // Wordmark Studio logic
    let currentFont = 'font-grotesk';
    const fontMap = {
        'font-grotesk':'Space Grotesk, sans-serif',
        'font-inter':'Inter, sans-serif',
        'font-serif-stack':'Georgia, serif',
        'font-mono-stack':'Courier New, monospace',
    };

    function updateWordmark() {
        const text      = document.getElementById('wm-text').value || 'Brand';
        const accent    = document.getElementById('wm-accent').value;
        const tagline   = document.getElementById('wm-tagline').value;
        const mainColor = document.getElementById('wm-main-color').value;
        const accentCol = document.getElementById('wm-accent-color').value;
        const bgCol     = document.getElementById('wm-bg-color').value;
        const weight    = document.getElementById('wm-weight').value;
        const spacing   = document.getElementById('wm-spacing').value;
        const fontSize  = document.getElementById('wm-size').value;

        document.getElementById('wm-main-hex').textContent   = mainColor;
        document.getElementById('wm-accent-hex').textContent = accentCol;
        document.getElementById('wm-bg-hex').textContent     = bgCol;
        document.getElementById('wm-size-val').textContent   = fontSize + 'px';

        let baseText = text, accentText = accent || '';
        if (accent && text.endsWith(accent)) {
            baseText   = text.slice(0, -accent.length);
            accentText = accent;
        } else if (accent && text.includes(accent)) {
            const idx  = text.lastIndexOf(accent);
            baseText   = text.substring(0, idx);
            accentText = accent;
        }

        const mainEl    = document.getElementById('wm-main-text');
        const taglineEl = document.getElementById('wm-tagline-render');

        mainEl.className        = currentFont + ' leading-none';
        mainEl.style.color      = mainColor;
        mainEl.style.fontWeight = weight;
        mainEl.style.fontSize   = fontSize + 'px';
        mainEl.style.letterSpacing = spacing + 'px';

        while (mainEl.firstChild) mainEl.removeChild(mainEl.firstChild);
        mainEl.appendChild(document.createTextNode(baseText));
        if (accentText) {
            const sp = document.createElement('span');
            sp.textContent  = accentText;
            sp.style.color  = accentCol;
            mainEl.appendChild(sp);
        }

        if (tagline) {
            taglineEl.textContent  = tagline;
            taglineEl.style.color  = mainColor;
            taglineEl.className    = currentFont + ' text-sm font-medium mt-3 tracking-widest uppercase';
            taglineEl.classList.remove('hidden');
        } else { taglineEl.classList.add('hidden'); }

        const ff  = fontMap[currentFont] || 'Space Grotesk, sans-serif';
        const y1  = tagline ? 140 : 165;
        const svgLines = [
            `<svg xmlns="http://www.w3.org/2000/svg" width="800" height="300" viewBox="0 0 800 300">`,
            `  <rect width="800" height="300" fill="${bgCol}"/>`,
            `  <text x="400" y="${y1}" text-anchor="middle" font-family="${ff}" font-size="${fontSize}" font-weight="${weight}" letter-spacing="${spacing}" fill="${mainColor}">${escHtml(baseText)}<tspan fill="${accentCol}">${escHtml(accentText)}</tspan></text>`,
            tagline ? `  <text x="400" y="${y1+50}" text-anchor="middle" font-family="${ff}" font-size="16" font-weight="500" letter-spacing="4" fill="${mainColor}" opacity="0.5">${escHtml(tagline.toUpperCase())}</text>` : '',
            `</svg>`
        ];
        document.getElementById('wm-svg-code').textContent = svgLines.filter(Boolean).join('\n');
    }

    function escHtml(s) { return (s||'').replace(/&/g,'&amp;').replace(/</g,'&lt;').replace(/>/g,'&gt;').replace(/"/g,'&quot;'); }

    function setFont(f) {
        currentFont = f;
        const keys = {'font-grotesk':'grotesk','font-inter':'inter','font-serif-stack':'serif','font-mono-stack':'mono'};
        Object.entries(keys).forEach(([cls,key])=>{
            const b = document.getElementById('font-btn-'+key);
            if(!b) return;
            b.className = b.className
                .replace(/border-2 border-brand-cyan bg-brand-cyan\/5 text-brand-blue/g,'border border-gray-200 text-gray-500')
                .replace(/border border-gray-200 text-gray-500/g, cls===f ? 'border-2 border-brand-cyan bg-brand-cyan/5 text-brand-blue' : 'border border-gray-200 text-gray-500');
            if(cls===f && !b.className.includes('border-brand-cyan'))
                b.className = b.className.replace('border border-gray-200 text-gray-500','border-2 border-brand-cyan bg-brand-cyan/5 text-brand-blue');
        });
        updateWordmark();
    }

    function setPreviewBg(hex) {
        document.getElementById('wordmark-preview').style.backgroundColor = hex;
        document.getElementById('wm-bg-color').value = hex;
        updateWordmark();
    }

    function copySVG(btn) {
        navigator.clipboard.writeText(document.getElementById('wm-svg-code').textContent).then(()=>{
            const orig = btn.textContent;
            btn.textContent = '✓ Copied!';
            setTimeout(()=>{ btn.textContent = orig; },2000);
        });
    }

    function downloadSVG() {
        const blob = new Blob([document.getElementById('wm-svg-code').textContent],{type:'image/svg+xml'});
        const a = Object.assign(document.createElement('a'),{href:URL.createObjectURL(blob),download:(document.getElementById('wm-text').value||'wordmark')+'.svg'});
        a.click(); URL.revokeObjectURL(a.href);
    }

    function downloadPNG(scale) {
        const svg  = document.getElementById('wm-svg-code').textContent;
        const blob = new Blob([svg],{type:'image/svg+xml;charset=utf-8'});
        const url  = URL.createObjectURL(blob);
        const img  = new Image();
        img.onload = () => {
            const c = document.createElement('canvas');
            c.width = 800*scale; c.height = 300*scale;
            c.getContext('2d').drawImage(img,0,0,c.width,c.height);
            URL.revokeObjectURL(url);
            const a = Object.assign(document.createElement('a'),{download:(document.getElementById('wm-text').value||'wordmark')+(scale>1?'@2x':'')+'.png',href:c.toDataURL('image/png')});
            a.click();
        };
        img.src = url;
    }

    ['wm-text','wm-accent','wm-tagline','wm-main-color','wm-accent-color','wm-bg-color','wm-weight','wm-spacing','wm-size']
        .forEach(id=>{ const el=document.getElementById(id); if(el) el.addEventListener('input',updateWordmark); });

    document.getElementById('wm-bg-color').addEventListener('input',e=>{
        document.getElementById('wordmark-preview').style.backgroundColor = e.target.value;
    });

    updateWordmark();
    </script>
</body>
</html>