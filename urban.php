<?php
// Page-specific variables
$root_path = '';
$page_title = 'Community Hub';
$page_description = 'Connect with our specialized communities and initiatives.';

include 'templates/header.php';
?>

    <main class="py-section-py bg-light-bg min-h-screen">
        <div class="container mx-auto px-section-px">
            
            <div class="text-center mb-12">
                <span class="text-brand-blue font-bold tracking-widest uppercase text-xs mb-2 block">Our Network</span>
                <h1 class="text-3xl md:text-5xl font-bold text-text-main tracking-tight mb-4">
                    Community Hub
                </h1>
                <p class="text-lg text-text-body max-w-2xl mx-auto leading-relaxed">
                    Explore our specialized communities driving innovation and sustainability.
                </p>
            </div>

            <div class="max-w-4xl mx-auto">
                <div class="bg-white border border-gray-100 rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 overflow-hidden group">
                    <div class="flex flex-col md:flex-row">
                        
                        <div class="p-8 md:w-3/5 flex flex-col justify-between order-2 md:order-1">
                            <div>
                                <div class="flex justify-between items-start mb-4">
                                     <span class="text-xs font-bold text-brand-blue bg-light-bg border border-gray-200 px-3 py-1 rounded-full shadow-sm">
                                        Environmental Solutions
                                     </span>
                                     <svg class="w-6 h-6 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                         <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                                     </svg>
                                </div>
                                
                                <h2 class="font-bold text-3xl text-text-main tracking-tight mb-4 group-hover:text-brand-blue transition-colors">
                                    EcoVibes
                                </h2>
                                
                                <p class="text-text-body leading-relaxed text-sm mb-6">
                                    EcoVibe is a movement dedicated to advancing environmental sustainability and fostering resilient communities. Our mission is to promote ecological balance through education, advocacy, and practical interventions that address pressing global challenges, including climate change, biodiversity loss, and resource depletion. Guided by our motto, Act Local, Impact Global, we believe that meaningful change begins at the grassroots level.
                                </p>
                            </div>

                            <a href="https://www.ecovibes.world/index.php" target="_blank" class="inline-flex items-center text-sm font-bold text-brand-blue hover:text-brand-cyan transition-colors">
                                Visit Platform 
                                <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                                </svg>
                            </a>
                        </div>

                        <div class="md:w-2/5 order-1 md:order-2 bg-gray-50 flex items-center justify-center p-6 border-b md:border-b-0 md:border-l border-gray-100">
                             <img src="logo.jpg" alt="EcoVibes Community" class="max-w-full h-auto rounded shadow-sm transform group-hover:scale-105 transition-transform duration-300">
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </main>
    
<?php
include 'templates/footer.php';
?>