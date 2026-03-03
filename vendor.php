<?php
// Page-specific variables
$root_path = '';
$page_title = 'Digital Platforms';
$page_description = 'View the network of vendors powered by Leviathan Innovations\' closed-loop management systems.';

include 'templates/header.php';
?>

    <main class="py-section-py bg-light-bg">
        <div class="container mx-auto px-section-px">
            <h1 class="text-4xl font-bold text-center text-text-main tracking-tight mb-5">Vendors Powered by ASIKO Systems</h1>
            <p class="text-lg text-text-body text-center max-w-3xl mx-auto leading-relaxed mb-16">
                Our technology ensures real-time inventory synchronization and reliable customer service for these growing businesses.
            </p>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                <div class="bg-white p-6 rounded-xl shadow-lg border-t-4 border-brand-cyan flex flex-col items-center text-center">
                    <img src="niffy.png" alt="ASIKO Store Logo Placeholder" class="w-24 h-24 rounded-full object-contain mb-4 border-2 border-gray-100">
                    <h3 class="font-bold text-xl text-text-main mb-6">HandMade by Niffy</h3>
                    <a href="https://bit.ly/HandmadeByNiffy" class="w-full mt-auto bg-brand-cyan text-brand-blue font-bold py-2 px-4 rounded-full hover:bg-opacity-80 transition-colors shadow-md">
                        Visit Store 
                    </a>
                </div>

                <div class="bg-white p-6 rounded-xl shadow-lg border-t-4 border-brand-yellow flex flex-col items-center text-center">
                    <img src="marve.jpg" alt="ASIKO Store Logo Placeholder" class="w-24 h-24 rounded-full object-contain mb-4 border-2 border-gray-100">
                    <h3 class="font-bold text-xl text-text-main mb-6">MarvE Tech</h3>
                    <a href="https://bit.ly/MarvETech" class="w-full mt-auto bg-brand-yellow text-brand-blue font-bold py-2 px-4 rounded-full hover:bg-opacity-80 transition-colors shadow-md">
                        Visit Store 
                    </a>
                </div>

               
                <div class="bg-white p-6 rounded-xl shadow-lg border-t-4 border-brand-blue flex flex-col items-center text-center">
                    <img src="damellar.png" alt="ASIKO Store Logo Placeholder" class="w-24 h-24 rounded-full object-contain mb-4 border-2 border-gray-100">
                    <h3 class="font-bold text-xl text-text-main mb-6">Damellar Natural Skincare</h3>
                    <a href="https://bit.ly/damellarnaturals" class="w-full mt-auto bg-brand-blue text-white font-bold py-2 px-4 rounded-full hover:bg-opacity-80 transition-colors shadow-md">
                        Visit Store 
                    </a>
                </div>

                <div class="bg-white p-6 rounded-xl shadow-lg border-t-4 border-gray-400 flex flex-col items-center text-center">
                    <img src="mide.png" alt="ASIKO Store Logo Placeholder" class="w-24 h-24 rounded-full object-contain mb-4 border-2 border-gray-100">
                    <h3 class="font-bold text-xl text-text-main mb-6">Mide's Gems & Accessories</h3>
                    <a href="https://bit.ly/MideGems" class="w-full mt-auto bg-gray-400 text-white font-bold py-2 px-4 rounded-full hover:bg-opacity-80 transition-colors shadow-md">
                        Visit Store 
                    </a>
                </div>

                <div class="bg-white p-6 rounded-xl shadow-lg border-t-4 border-brand-cyan flex flex-col items-center text-center">
                    <img src="dejoke.png" alt="ASIKO Store Logo Placeholder" class="w-24 h-24 rounded-full object-contain mb-4 border-2 border-gray-100">
                    <h3 class="font-bold text-xl text-text-main mb-6">Dejoke Store</h3>
                    <a href="https://bit.ly/DejokeStore" class="w-full mt-auto bg-brand-cyan text-brand-blue font-bold py-2 px-4 rounded-full hover:bg-opacity-80 transition-colors shadow-md">
                        Visit Store 
                    </a>
                </div>
                 <div class="bg-white p-6 rounded-xl shadow-lg border-t-4 border-brand-yellow flex flex-col items-center text-center">
                    <img src="beth.jpeg" alt="ASIKO Store Logo Placeholder" class="w-24 h-24 rounded-full object-contain mb-4 border-2 border-gray-100">
                    <h3 class="font-bold text-xl text-text-main mb-6">Beth's Closet</h3>
                    <a href="#" class="w-full mt-auto bg-brand-yellow text-brand-blue font-bold py-2 px-4 rounded-full hover:bg-opacity-80 transition-colors shadow-md">
                        Visit Store 
                    </a>
                </div>
            </div>
        </div>
    </main>

<?php
include 'templates/footer.php';
?>