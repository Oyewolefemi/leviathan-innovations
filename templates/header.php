<?php
/**
 * Main Site Header
 *
 * This template requires the following variables to be set on the calling page:
 *
 * @var string $root_path       - The relative path to the project root. E.g. '' or '../'
 * @var string $page_title      - The title for the <title> tag.
 * @var string $page_description - The content for the <meta name="description"> tag.
 */
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($page_title) ?> | Leviathan Innovations</title>
    <meta name="description" content="<?= htmlspecialchars($page_description) ?>">
    
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Poppins', 'sans-serif'],
                    },
                    colors: {
                        'brand-blue': '#0A2540',
                        'brand-cyan': '#00D4FF',
                        'brand-yellow': '#FFC82F',
                        'light-bg': '#F6F9FC',
                        'text-main': '#1A202C',
                        'text-body': '#4A5568',
                    },
                    lineHeight: {
                        'relaxed': '1.8',
                    },
                    letterSpacing: {
                        'tight': '-0.025em',
                    },
                    spacing: {
                        'section-py': '6rem',
                        'section-px': '1.5rem',
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-white text-brand-blue font-sans flex flex-col min-h-screen">

    <header class="bg-white sticky top-0 z-50 shadow-md">
        <nav class="container mx-auto px-6 py-4 flex justify-between items-center">
            
            <a href="<?= $root_path ?>index.php" class="text-3xl font-bold tracking-tighter text-brand-blue hover:opacity-90 transition-opacity">
                Leviathan<span class="text-brand-cyan">.</span>
            </a>
            
            <div class="hidden md:flex items-center space-x-6">
                <a href="<?= $root_path ?>#" class="text-gray-600 hover:text-brand-blue transition-colors font-medium">Digital Platforms</a>
                
                <a href="<?= $root_path ?>solutions.php" class="bg-brand-yellow text-brand-blue px-4 py-2 rounded-full font-bold shadow-md hover:bg-opacity-80 transition-colors">
                    Explore Solutions
                </a>
                
                <a href="<?= $root_path ?>/repsi/publicrep.php" class="text-gray-600 hover:text-brand-blue transition-colors font-medium">2025</a>

                <a href="<?= $root_path ?>urban.php" class="text-gray-600 hover:text-brand-blue transition-colors font-medium">Leviathan Urban</a>
            </div>

            <button id="mobile-menu-button" class="md:hidden focus:outline-none p-2 rounded-md hover:bg-gray-100">
                <svg class="w-6 h-6 text-brand-blue" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path>
                </svg>
            </button>
        </nav>
        
        <div id="mobile-menu" class="hidden md:hidden px-6 pt-2 pb-4 space-y-2 border-t border-gray-100 bg-white shadow-lg absolute w-full left-0 z-40">
             <a href="<?= $root_path ?>vendor.php" class="block py-2 text-gray-600 hover:text-brand-blue transition-colors font-medium">Digital Platforms</a>
             <a href="<?= $root_path ?>solutions.php" class="block py-2 mt-2 bg-brand-yellow text-brand-blue px-4 rounded-full font-bold text-center">Explore Solutions</a>
             <a href="<?= $root_path ?>/repsi/publicrep.php" class="block py-2 text-gray-600 hover:text-brand-blue transition-colors font-medium">2025</a>
             <a href="<?= $root_path ?>urban.php" class="block py-2 text-gray-600 hover:text-brand-blue transition-colors font-medium">Leviathan Urban</a>
        </div>
    </header>

    <script>
        // Wait for the HTML to load before running the script
        document.addEventListener('DOMContentLoaded', function() {
            const btn = document.getElementById('mobile-menu-button');
            const menu = document.getElementById('mobile-menu');

            if(btn && menu) {
                btn.addEventListener('click', (e) => {
                    e.preventDefault();
                    menu.classList.toggle('hidden');
                });
            }
        });
    </script>
    
    <main class="flex-grow">