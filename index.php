<?php
// Page-specific variables
$root_path = '';
$page_title = 'Leviathan Innovations | Venture Lab';
$page_description = 'A diversified venture lab applying digital engineering to stabilize physical value chains in Agriculture and Hospitality.';

include 'templates/header.php';
?>

    <main>
        <section class="relative h-[70vh] md:h-[85vh] bg-cover bg-center text-white" style="background-image: url('der.jpg');">
            <div class="absolute inset-0 bg-brand-blue bg-opacity-80 mix-blend-multiply"></div>
            
            <div class="relative container mx-auto px-section-px h-full flex flex-col justify-center">
                <span class="text-brand-yellow font-bold tracking-widest uppercase text-sm mb-4">Operational Research & Venture Lab</span>
                <h1 class="text-4xl md:text-6xl font-bold max-w-4xl tracking-tight heading-font leading-tight">
                    Building Resilience.<br>
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-brand-cyan to-white">From Soil to Cloud.</span>
                </h1>
                <p class="mt-6 text-xl max-w-xl text-gray-200 leading-relaxed font-light">
                    We bridge the volatility of physical operations with the stability of digital infrastructure. A hybrid approach to business solutions.
                </p>
                <div class="mt-10 flex flex-wrap gap-4">
                    <a href="repsi/publicrep.php" class="bg-brand-yellow text-brand-blue px-8 py-4 rounded-full font-bold text-lg hover:bg-white transition-all shadow-xl">
                        View 2025 Report
                    </a>
                    <a href="#sectors" class="px-8 py-4 rounded-full font-bold text-lg border-2 border-white text-white hover:bg-white hover:text-brand-blue transition-all">
                        Our Sectors
                    </a>
                </div>
            </div>
        </section>

        <section id="sectors" class="py-section-py bg-light-bg">
            <div class="container mx-auto px-section-px grid grid-cols-1 lg:grid-cols-2 gap-12 items-stretch">
                
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 h-full">
                    
                    <div class="bg-white p-6 rounded-xl shadow-md hover:shadow-xl transition-shadow border-t-4 border-emerald-500 group">
                        <div class="w-12 h-12 bg-emerald-100 rounded-lg flex items-center justify-center mb-4 text-emerald-600 group-hover:scale-110 transition-transform shadow-inner">
                            <i data-lucide="wheat" class="w-6 h-6"></i>
                        </div>
                        <h3 class="font-bold text-xl text-text-main heading-font mb-2">Agro-Allied</h3>
                        <p class="text-sm text-text-body leading-relaxed">
                            Commercial poultry and crop systems. Validating bio-security protocols that achieved <span class="font-bold text-emerald-600">100% survival rates</span> in our Akure pilot.
                        </p>
                    </div>

                    <div class="bg-white p-6 rounded-xl shadow-md hover:shadow-xl transition-shadow border-t-4 border-cyan-500 group">
                        <div class="w-12 h-12 bg-cyan-100 rounded-lg flex items-center justify-center mb-4 text-cyan-600 group-hover:scale-110 transition-transform shadow-inner">
                            <i data-lucide="wine" class="w-6 h-6"></i>
                        </div>
                        <h3 class="font-bold text-xl text-text-main heading-font mb-2">Service Operations</h3>
                        <p class="text-sm text-text-body leading-relaxed">
                            Distressed asset turnaround (Epicurean Temple). We pivot dormant facilities using supply chain control, driving <span class="font-bold text-cyan-600">zero-to-five</span> daily growth.
                        </p>
                    </div>

                    <div class="bg-white p-6 rounded-xl shadow-md hover:shadow-xl transition-shadow border-t-4 border-brand-blue col-span-1 sm:col-span-2 group">
                        <div class="w-12 h-12 bg-indigo-100 rounded-lg flex items-center justify-center mb-4 text-brand-blue group-hover:scale-110 transition-transform shadow-inner">
                            <i data-lucide="server" class="w-6 h-6"></i>
                        </div>
                        <h3 class="font-bold text-xl text-text-main heading-font mb-2">Digital Infrastructure</h3>
                        <p class="text-sm text-text-body leading-relaxed">
                            <strong>"Digital Courage."</strong> Building asset classes immune to physical risk. We engineer modular software systems (R, PHP, AI) to stabilize value chains.
                        </p>
                    </div>
                </div>
                
                <div class="h-full">
                    <div class="bg-brand-blue p-8 sm:p-10 rounded-xl shadow-2xl h-full flex flex-col justify-center relative overflow-hidden text-white border border-brand-blue/50">
                        <div class="absolute top-0 right-0 -mr-16 -mt-16 w-64 h-64 bg-brand-yellow rounded-full opacity-10 blur-3xl"></div>
                        <div class="absolute bottom-0 left-0 -ml-16 -mb-16 w-64 h-64 bg-brand-cyan rounded-full opacity-10 blur-3xl"></div>
                        
                        <div class="flex items-center gap-2 mb-6 relative z-10">
                             <span class="px-3 py-1 bg-white/10 rounded-full text-xs font-bold text-brand-yellow border border-white/20 uppercase tracking-wider">
                                Annual Report
                             </span>
                             <span class="text-gray-400 text-xs font-mono">2025</span>
                        </div>

                        <h2 class="text-3xl md:text-4xl font-bold mb-6 text-white tracking-tight heading-font relative z-10">
                            Learning by Doing.
                        </h2>
                        
                        <div class="space-y-4 mb-8 relative z-10">
                            <div class="flex items-start gap-3">
                                <i data-lucide="check-circle-2" class="w-5 h-5 text-emerald-400 mt-1 shrink-0"></i>
                                <p class="text-gray-200 text-sm">
                                    <strong>Agro:</strong> Achieved operational excellence with 100% survival despite inflation.
                                </p>
                            </div>
                            <div class="flex items-start gap-3">
                                <i data-lucide="trending-up" class="w-5 h-5 text-cyan-400 mt-1 shrink-0"></i>
                                <p class="text-gray-200 text-sm">
                                    <strong>Hospitality:</strong> Revived dead assets via supply chain control (Zero-to-Five).
                                </p>
                            </div>
                            <div class="flex items-start gap-3">
                                <i data-lucide="shield-check" class="w-5 h-5 text-indigo-400 mt-1 shrink-0"></i>
                                <p class="text-gray-200 text-sm">
                                    <strong>Strategy:</strong> Pivoting from physical volatility to digital stability.
                                </p>
                            </div>
                        </div>

                        <div class="mt-auto relative z-10">
                            <a href="repsi/publicrep.php" class="inline-flex items-center font-bold text-white bg-white/10 px-6 py-3 rounded-lg hover:bg-brand-yellow hover:text-brand-blue transition-all group w-full justify-between">
                                <span>Read Full Retrospective</span>
                                <i data-lucide="arrow-right" class="w-5 h-5 group-hover:translate-x-1 transition-transform"></i>
                            </a>
                        </div>
                    </div>
                </div>

            </div>
        </section>
        
        <section id="platforms" class="py-section-py bg-white border-t border-gray-100">
    <div class="container mx-auto px-section-px text-center">
        <span class="text-brand-blue font-bold tracking-widest uppercase text-xs mb-2 block">Output of Research</span>
        <h2 class="text-3xl md:text-4xl font-bold text-text-main tracking-tight mb-5 heading-font">Engineered for Reality</h2>
        <p class="max-w-3xl mx-auto text-text-body leading-relaxed mb-16">
            We don't just write code; we codify our operational experience into software.
        </p>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-10 max-w-4xl mx-auto">
            
            <a href="store/dns/kiosk/index.php" class="block text-left p-8 border border-gray-100 rounded-2xl shadow-lg hover:shadow-2xl transition-all group bg-light-bg/50 hover:bg-white h-full relative">
                <div class="flex justify-between items-start mb-6">
                     <span class="text-xs font-bold text-brand-blue bg-white border border-gray-200 px-3 py-1 rounded-full shadow-sm">B2B Platform</span>
                     <i data-lucide="package" class="w-6 h-6 text-brand-cyan"></i>
                </div>
                <h4 class="font-bold text-2xl text-text-main tracking-tight group-hover:text-brand-blue transition-colors">ASIKO Inventory & SCM</h4>
                <p class="text-text-body mt-3 leading-relaxed text-sm">
                    A horizontal platform for Agribusiness & Retail. Built to manage the complex inventory flows.
                </p>
                <span class="mt-6 inline-flex items-center text-sm font-bold text-brand-blue group-hover:underline">
                    Learn more <i data-lucide="arrow-right" class="w-4 h-4 ml-1"></i>
                </span>
            </a>

            <div class="text-left p-8 border border-gray-100 rounded-2xl shadow-lg hover:shadow-2xl transition-all group bg-light-bg/50 flex flex-col justify-between">
                <div>
                    <div class="flex justify-between items-start mb-6">
                         <span class="text-xs font-bold text-brand-blue bg-white border border-gray-200 px-3 py-1 rounded-full shadow-sm">Environmental Solutions</span>
                    </div>
                    <h4 class="font-bold text-2xl text-text-main tracking-tight group-hover:text-brand-blue transition-colors">EcoVibes</h4>
                    <p class="text-text-body mt-3 leading-relaxed text-sm">
EcoVibe is a movement dedicated to advancing environmental sustainability and fostering resilient communities. Our mission is to promote ecological balance through education, advocacy, and practical interventions that address pressing global challenges, including climate change, biodiversity loss, and resource depletion. Guided by our motto, Act Local, Impact Global, we believe that meaningful change begins at the grassroots level.                    </p>
                    <a href="https://www.ecovibes.world/index.php" class="mt-6 inline-flex items-center text-sm font-bold text-brand-blue hover:underline">
                        See>>> <i data-lucide="external-link" class="w-4 h-4 ml-1"></i>
                    </a>
                </div>
                
                <div class="mt-8 pt-6 border-t border-gray-100/50">
                    <img src="logo.jpg" alt="Asiko Kiosk Interface" class="w-full h-auto rounded-lg shadow-sm border border-gray-100 transform group-hover:scale-[1.02] transition-transform duration-300">
                </div>
            </div>

        </div>
    </div>
</section>
    </main>

    <script src="https://unpkg.com/lucide@latest/dist/umd/lucide.js"></script>
    <script>
        // Ensure DOM is ready before creating icons
        document.addEventListener("DOMContentLoaded", function() {
            lucide.createIcons();
        });
    </script>

<?php
include 'templates/footer.php';
?>