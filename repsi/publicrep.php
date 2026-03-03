<?php
// PATH CONFIGURATION
$root_path = '../'; 
$page_title = '2025 Retrospective: Nano-Business Cycles';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($page_title) ?> | Leviathan Innovations</title>
    <meta name="description" content="Annual Report & Retrospective">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&family=Space+Grotesk:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                        heading: ['Space Grotesk', 'sans-serif'],
                    },
                    colors: {
                        'brand-blue': '#0A2540',
                        'brand-cyan': '#00D4FF',
                        'brand-yellow': '#FFC82F',
                        'light-bg': '#F6F9FC',
                        'text-main': '#1A202C',
                        'text-body': '#4A5568',
                    },
                }
            }
        }
    </script>

    <script src="https://unpkg.com/lucide@latest"></script>

    <style>
        body { font-family: 'Inter', sans-serif; background-color: #FAFAFA; color: #1e293b; }
        h1, h2, h3, .heading-font { font-family: 'Space Grotesk', sans-serif; }
        .chapter-line {
            position: absolute; left: 24px; top: 0; bottom: 0; width: 2px; background: #e2e8f0; z-index: 0;
        }
        @media (min-width: 640px) {
            .chapter-line { left: 50%; transform: translateX(-50%); }
        }
    </style>
</head>
<body class="min-h-screen flex flex-col">

    <header class="bg-white sticky top-0 z-50 shadow-md">
        <nav class="container mx-auto px-6 py-4 flex justify-between items-center">
            <a href="<?= $root_path ?>index.php" class="text-3xl font-bold tracking-tighter text-brand-blue hover:opacity-90 transition-opacity">
                Leviathan<span class="text-brand-cyan">.</span>
            </a>
            
            <div class="hidden md:flex items-center space-x-6">
                <a href="<?= $root_path ?>#" class="text-gray-600 hover:text-brand-blue transition-colors">Digital Platforms</a>
                <a href="<?= $root_path ?>solutions.php" class="bg-brand-yellow text-brand-blue px-4 py-2 rounded-full font-bold shadow-md hover:bg-opacity-80 transition-colors">
                    Explore Solutions
                </a>
                <a href="#" class="text-brand-blue font-semibold transition-colors">2025</a>
                <a href="<?= $root_path ?>urban.php" class="text-gray-600 hover:text-brand-blue transition-colors">Leviathan Urban</a>
            </div>

            <button id="mobile-menu-button" class="md:hidden focus:outline-none">
                <i data-lucide="menu" class="w-6 h-6 text-brand-blue"></i>
            </button>
        </nav>
        
        <div id="mobile-menu" class="hidden md:hidden px-6 pt-2 pb-4 space-y-2 border-t bg-white">
             <a href="<?= $root_path ?>vendor.php" class="block py-2 text-gray-600">Digital Platforms</a>
             <a href="#" class="block py-2 text-brand-blue font-bold">2025 Report</a>
             <a href="<?= $root_path ?>solutions.php" class="block mt-4 bg-brand-yellow text-brand-blue px-4 py-2 rounded-full font-bold text-center">Explore Solutions</a>
        </div>
    </header>

    <div class="max-w-4xl mx-auto pt-12 pb-8 px-4 sm:px-6">
        <div class="text-center space-y-4">
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-slate-100 border border-slate-200 text-xs font-semibold text-slate-500 uppercase tracking-wide">
                <span>Operational Retrospective</span>
                <span class="w-1 h-1 bg-slate-400 rounded-full"></span>
                <span>2025</span>
            </div>
            <h1 class="text-4xl sm:text-6xl font-bold text-slate-900 heading-font tracking-tight">The "Nano-Business" Strategy.</h1>
            <p class="text-lg sm:text-xl text-slate-500 max-w-xl mx-auto font-light leading-relaxed">
                We deployed agile, short-term operational cycles to test market viability. The goal: Prove the concept, stress-test the logistics, and pivot.
            </p>
        </div>
    </div>

    <div class="w-full bg-slate-900 text-white py-8 mb-16 shadow-inner">
        <div class="max-w-4xl mx-auto px-4 sm:px-6">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-6 text-center">
                <div>
                    <div class="text-2xl font-bold font-heading text-emerald-400">2 Cycles</div>
                    <div class="text-xs uppercase tracking-widest text-slate-400 mt-1">Poultry Operations</div>
                </div>
                <div>
                    <div class="text-2xl font-bold font-heading text-cyan-400">5 Months</div>
                    <div class="text-xs uppercase tracking-widest text-slate-400 mt-1">Hospitality Run</div>
                </div>
                <div>
                    <div class="text-2xl font-bold font-heading text-white">100%</div>
                    <div class="text-xs uppercase tracking-widest text-slate-400 mt-1">Akure Survival Rate</div>
                </div>
                <div>
                    <div class="text-2xl font-bold font-heading text-indigo-400">Zero-to-Five</div>
                    <div class="text-xs uppercase tracking-widest text-slate-400 mt-1">Customer Growth</div>
                </div>
            </div>
        </div>
    </div>

    <div class="max-w-4xl mx-auto px-4 sm:px-6 pb-24">
        
        <div class="relative space-y-16 sm:space-y-24 mb-32">
            <div class="chapter-line"></div>

            <div class="relative grid grid-cols-1 sm:grid-cols-2 gap-8 items-center">
                <div class="absolute left-6 sm:left-1/2 -translate-x-1/2 w-12 h-12 bg-emerald-100 border-4 border-white rounded-full flex items-center justify-center z-10 shadow-sm">
                    <i data-lucide="wheat" class="w-5 h-5 text-emerald-600"></i>
                </div>
                <div class="pl-16 sm:pl-0 sm:pr-12 sm:text-right">
                    <h2 class="text-2xl font-bold text-emerald-900 heading-font mb-2">Agro-Allied Nano-Cycles</h2>
                    <p class="text-emerald-800/70 font-medium text-sm uppercase tracking-wide mb-4">
                        <span class="bg-emerald-100 px-2 py-1 rounded">Feb – April</span> &bull; 
                        <span class="bg-emerald-100 px-2 py-1 rounded">May – July</span>
                    </p>
                    <p class="text-slate-600 leading-relaxed">
                        We ran two distinct "nano" production batches. The objective wasn't indefinite farming, but to prove we could master bio-security and logistics in high-risk zones.
                    </p>
                </div>
                <div class="pl-16 sm:pl-12">
                    <div class="bg-white p-6 rounded-2xl shadow-lg border border-emerald-100 space-y-4 relative overflow-hidden">
                        <div class="relative z-10">
                            <div class="flex items-center gap-3 mb-2">
                                <div class="p-2 bg-emerald-100 rounded-lg">
                                    <i data-lucide="check-circle-2" class="w-5 h-5 text-emerald-600"></i>
                                </div>
                                <span class="font-bold text-slate-800">Proof of Competence</span>
                            </div>
                            <p class="text-sm text-slate-500 mb-4">
                                The Akure Pilot (Phase 1) was a definitive success, achieving a <span class="font-bold text-emerald-600">100% Survival Rate</span>. We proved that our management protocols work perfectly, even at a micro-scale.
                            </p>
                            <div class="border-t border-emerald-100 pt-4">
                                <h4 class="text-xs font-bold text-emerald-900 uppercase mb-2">The Learning Pivot</h4>
                                <p class="text-xs text-slate-500">
                                    Phase 2 revealed that while we can keep birds alive perfectly, feed inflation (consuming 172% of revenue) requires a scale-up strategy before the next cycle.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="relative grid grid-cols-1 sm:grid-cols-2 gap-8 items-center">
                <div class="absolute left-6 sm:left-1/2 -translate-x-1/2 w-12 h-12 bg-cyan-100 border-4 border-white rounded-full flex items-center justify-center z-10 shadow-sm">
                    <i data-lucide="wine" class="w-5 h-5 text-cyan-600"></i>
                </div>
                <div class="pl-16 sm:pl-12 sm:order-2">
                    <h2 class="text-2xl font-bold text-cyan-900 heading-font mb-2">Service Micro-Ops</h2>
                    <p class="text-cyan-800/70 font-medium text-sm uppercase tracking-wide mb-4">
                         <span class="bg-cyan-100 px-2 py-1 rounded">April – August</span>
                    </p>
                    <p class="text-slate-600 leading-relaxed text-sm">
                        A 5-month turnaround of a distressed asset. We didn't just manage; we pivoted the model from "Facility Management" to <span class="font-semibold text-cyan-700">"Product Injection."</span> We invested stock (meat/chicken) instead of cash to drive growth.
                    </p>
                    <ul class="mt-4 space-y-2 text-sm text-slate-500">
                        <li class="flex gap-2">
                            <span class="w-1.5 h-1.5 bg-cyan-400 rounded-full mt-2 shrink-0"></span>
                            <span><strong>The Price War:</strong> Owner insisted on ₦300/cut. We enforced a strategic drop to <strong>₦200/cut</strong> (April-May). Result: Customer volume spiked immediately.</span>
                        </li>
                        <li class="flex gap-2">
                            <span class="w-1.5 h-1.5 bg-cyan-400 rounded-full mt-2 shrink-0"></span>
                            <span><strong>Supply Chain Engineering:</strong> We secured a hunter in the <strong>Igusin/Ala axis (Ondo State)</strong> for consistent Bushmeat supply (2 games every 3 days).</span>
                        </li>
                    </ul>
                </div>
                <div class="pl-16 sm:pl-0 sm:pr-12 sm:order-1">
                    <div class="bg-white p-6 rounded-2xl shadow-lg border border-cyan-100 space-y-4 relative overflow-hidden">
                        <div class="relative z-10">
                            <div class="flex items-center gap-3 mb-2">
                                <div class="p-2 bg-cyan-100 rounded-lg">
                                    <i data-lucide="trending-up" class="w-5 h-5 text-cyan-600"></i>
                                </div>
                                <span class="font-bold text-slate-800">The "Zero-to-Five" Victory</span>
                            </div>
                            <p class="text-sm text-slate-500 mb-4">
                                By July, the facility stabilized enough to introduce drinks (Beer/Soda). However, the partnership revealed a critical risk: <span class="font-semibold text-rose-500">Blind Investment.</span>
                            </p>
                            <div class="border-t border-cyan-100 pt-4">
                                <h4 class="text-xs font-bold text-cyan-900 uppercase mb-2">Strategic Exit (August)</h4>
                                <p class="text-xs text-slate-500">
                                    Despite the growth we engineered, accountability for funds was compromised. We closed the partnership to protect our capital, proving we can revive dead assets but require transparent partners.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="relative grid grid-cols-1 sm:grid-cols-2 gap-8 items-center">
                <div class="absolute left-6 sm:left-1/2 -translate-x-1/2 w-12 h-12 bg-indigo-100 border-4 border-white rounded-full flex items-center justify-center z-10 shadow-sm">
                    <i data-lucide="server" class="w-5 h-5 text-indigo-600"></i>
                </div>
                <div class="pl-16 sm:pl-0 sm:pr-12 sm:text-right">
                    <h2 class="text-2xl font-bold text-indigo-900 heading-font mb-2">Digital Courage</h2>
                    <p class="text-indigo-800/70 font-medium text-sm uppercase tracking-wide mb-4">
                        <span class="bg-indigo-100 px-2 py-1 rounded">Continuous</span>
                    </p>
                    <p class="text-slate-600 leading-relaxed">
                        The volatility of the physical nano-businesses reinforced our commitment to digital stability. We are building the infrastructure that makes our future operations immune to weather and inflation.
                    </p>
                </div>
                <div class="pl-16 sm:pl-12">
                    <div class="bg-white p-6 rounded-2xl shadow-lg border border-indigo-100 space-y-4 relative overflow-hidden">
                        <div class="relative z-10">
                            <div class="flex items-center gap-3 mb-2">
                                <div class="p-2 bg-indigo-100 rounded-lg">
                                    <i data-lucide="cpu" class="w-5 h-5 text-indigo-600"></i>
                                </div>
                                <span class="font-bold text-slate-800">Building the Safe Harbor</span>
                            </div>
                            <div class="flex flex-wrap gap-2 mb-4">
                                <span class="text-xs font-medium px-2 py-1 bg-indigo-50 text-indigo-600 rounded">AI Integration</span>
                                <span class="text-xs font-medium px-2 py-1 bg-indigo-50 text-indigo-600 rounded">Cloud Hosting</span>
                                <span class="text-xs font-medium px-2 py-1 bg-indigo-50 text-indigo-600 rounded">R Language</span>
                            </div>
                            <div class="border-t border-indigo-100 pt-4">
                                <h4 class="text-xs font-bold text-indigo-900 uppercase mb-2">Strategic Insight</h4>
                                <p class="text-xs text-slate-500">
                                    Every lesson learned in the physical "nano" labs is now being codified into our digital platforms (ASIKO).
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="border-t border-slate-200 pt-16">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-slate-900 heading-font">Visual Logs</h2>
                <p class="text-slate-500 mt-2">Documenting the process.</p>
            </div>

            <div class="space-y-12">
                
                <div class="space-y-4">
                    <div class="flex items-center gap-3">
                        <div class="h-8 w-1 bg-emerald-500 rounded-full"></div>
                        <h3 class="text-lg font-bold text-slate-800 heading-font">Agro-Allied Logs</h3>
                    </div>
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                        <div class="bg-slate-100 rounded-lg aspect-square overflow-hidden"><img src="IMG_4703.JPG" class="w-full h-full object-cover hover:scale-105 transition"></div>
                        <div class="bg-slate-100 rounded-lg aspect-square overflow-hidden"><img src="IMG_7631.JPG" class="w-full h-full object-cover hover:scale-105 transition"></div>
                        <div class="bg-slate-100 rounded-lg aspect-square overflow-hidden"><img src="IMG_5576.JPG" class="w-full h-full object-cover hover:scale-105 transition"></div>
                        <div class="bg-slate-100 rounded-lg aspect-square overflow-hidden relative group cursor-pointer">
                            <img src="IMG_7795.JPG" class="w-full h-full object-cover hover:scale-105 transition opacity-80">
                            <div class="absolute inset-0 flex items-center justify-center"><i data-lucide="play-circle" class="w-10 h-10 text-white drop-shadow-md"></i></div>
                        </div>
                    </div>
                </div>

               

            </div>
        </div>

        <div class="mt-24 pt-12 border-t border-slate-200 text-center">
             <p class="text-xl sm:text-2xl font-light text-slate-800 italic max-w-2xl mx-auto heading-font">
                "We pivot from the volatility of physical ownership to the stability of digital capacity."
            </p>
        </div>

    </div>

    <script>
        lucide.createIcons();
        
        const btn = document.getElementById('mobile-menu-button');
        const menu = document.getElementById('mobile-menu');
        if(btn && menu) {
            btn.addEventListener('click', () => {
                menu.classList.toggle('hidden');
            });
        }
    </script>
</body>
</html>