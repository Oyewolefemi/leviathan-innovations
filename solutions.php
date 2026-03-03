<?php
// Page-specific variables
$root_path = '';
$page_title = 'Our Applications';
$page_description = 'Detailed overview of ASIKO Inventory Manager (B2B SaaS) and ASIKO Kiosk (B2C sales channel).';

include 'templates/header.php';
?>

    <main class="py-section-py bg-light-bg">
        <div class="container mx-auto px-section-px">
            <h1 class="text-4xl font-bold text-center text-text-main tracking-tight mb-5">Our Flagship Digital Solutions</h1>
            <p class="text-lg text-text-body text-center max-w-4xl mx-auto leading-relaxed mb-20">
                Engineered from our core research, these platforms are deployed to solve specific pain points in supply chain management and retail efficiency.
            </p>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
                <div class="bg-white p-8 rounded-xl shadow-2xl border-t-8 border-brand-cyan">
                    <span class="text-lg font-extrabold text-brand-blue bg-brand-cyan/20 px-4 py-1 rounded-full">ASIKO Inventory Manager</span>
                    <h2 class="text-3xl font-bold mt-6 mb-4 text-text-main tracking-tight">Cross-Sector Management Platform</h2>
                    <p class="text-text-body leading-relaxed mb-8">
                        This is our horizontal B2B platform, designed to eliminate manual tracking for Agribusiness, Manufacturing, and Retail. It's the central engine for data integrity and financial compliance.
                    </p>
                    <ul class="space-y-4 text-text-body list-inside">
                        <li class="flex items-start">
                            <svg class="w-5 h-5 text-brand-cyan mr-3 mt-1 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            <span><strong class="text-text-main">Thematic UI:</strong> Instantly adapts to your industry's specific vocabulary (Crops, Parts, Assets).</span>
                        </li>
                        <li class="flex items-start">
                            <svg class="w-5 h-5 text-brand-cyan mr-3 mt-1 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            <span><strong class="text-text-main">Monetized Control:</strong> Uses per-user licensing to offer granular control over staff access and data visibility.</span>
                        </li>
                        <li class="flex items-start">
                            <svg class="w-5 h-5 text-brand-cyan mr-3 mt-1 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            <span><strong class="text-text-main">Audit Ready:</strong> Automated logging and export features ensure immediate compliance for external audits.</span>
                        </li>
                    </ul>
                    
                </div>

                <div class="bg-white p-8 rounded-xl shadow-2xl border-t-8 border-brand-yellow">
                    <span class="text-lg font-extrabold text-brand-blue bg-brand-yellow/20 px-4 py-1 rounded-full">ASIKO Kiosk (Innovation Proof)</span>
                    <h2 class="text-3xl font-bold mt-6 mb-4 text-text-main tracking-tight">Closed-Loop Sales Front-End</h2>
                    <p class="text-text-body leading-relaxed mb-8">
                        A proprietary e-commerce sales channel designed to run perfectly with the Inventory Manager. This platform demonstrates the power of true supply chain synchronization.
                    </p>
                    <ul class="space-y-4 text-text-body list-inside">
                        <li class="flex items-start">
                            <svg class="w-5 h-5 text-brand-yellow mr-3 mt-1 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            <span><strong class="text-text-main">Atomic Stock Sync:</strong> Guarantees zero overselling by checking and reserving stock via transaction.</span>
                        </li>
                        <li class="flex items-start">
                            <svg class="w-5 h-5 text-brand-yellow mr-3 mt-1 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            <span><strong class="text-text-main">Automated Support:</strong> Uses WhatsApp API integration for instant payment verification and order updates.</span>
                        </li>
                        <li class="flex items-start">
                            <svg class="w-5 h-5 text-brand-yellow mr-3 mt-1 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            <span><strong class="text-text-main">B2C Loyalty:</strong> Integrated rewards system to drive silent customer retention.</span>
                        </li>
                    </ul>
                    <a href="#" class="mt-10 inline-block bg-brand-blue text-white px-8 py-3 rounded-full font-bold text-lg w-fit hover:bg-opacity-90 transition-transform hover:scale-105 shadow-md">
                        ASIKO →
                    </a>
                </div>
            </div>
        </div>
    </main>

<?php
include 'templates/footer.php';
?>