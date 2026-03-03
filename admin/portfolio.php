<?php
require_once 'config.php'; // Connect to your database

// Fetch platforms from the database
$stmt = $pdo->query("SELECT * FROM platforms ORDER BY created_at DESC");
$platforms = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Page-specific variables for the header
$root_path = '';
$page_title = 'Digital Platforms';
$page_description = 'Explore the portfolio of systems and digital platforms powered by Leviathan Innovations.';

include 'templates/header.php';
?>

    <main class="py-section-py bg-light-bg min-h-screen relative">
        <div class="container mx-auto px-section-px">
            <h1 class="text-4xl font-bold text-center text-text-main tracking-tight mb-5">Systems Powered by Leviathan</h1>
            <p class="text-lg text-text-body text-center max-w-3xl mx-auto leading-relaxed mb-16">
                Explore our portfolio of managed digital platforms. Click to learn more about the architecture and purpose behind each system.
            </p>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                <?php foreach($platforms as $platform): ?>
                <div class="bg-white p-8 rounded-2xl shadow-lg border-t-4 <?= $platform['status'] === 'Live' ? 'border-brand-cyan' : 'border-brand-yellow' ?> flex flex-col h-full relative overflow-hidden group hover:-translate-y-1 transition-transform duration-300">
                    <div class="flex items-center gap-4 mb-4">
                        <div class="w-16 h-16 bg-gray-50 rounded-xl border border-gray-100 flex-shrink-0 p-1">
                            <img src="<?= htmlspecialchars($platform['logo_path']) ?>" alt="<?= htmlspecialchars($platform['name']) ?> Logo" class="w-full h-full object-contain rounded-lg">
                        </div>
                        <div>
                            <h3 class="font-bold text-xl text-text-main leading-tight"><?= htmlspecialchars($platform['name']) ?></h3>
                            <span class="inline-block mt-1 text-[10px] font-bold uppercase tracking-wider px-2 py-0.5 rounded-full <?= $platform['status'] === 'Live' ? 'bg-green-100 text-green-700' : 'bg-yellow-100 text-yellow-700' ?>">
                                <?= htmlspecialchars($platform['status']) ?>
                            </span>
                        </div>
                    </div>
                    
                    <p class="text-sm text-text-body mb-6 flex-grow"><?= htmlspecialchars($platform['tagline']) ?></p>
                    
                    <button 
                        onclick="openPlatformModal(
                            '<?= htmlspecialchars(addslashes($platform['name'])) ?>', 
                            '<?= htmlspecialchars(addslashes($platform['logo_path'])) ?>', 
                            '<?= htmlspecialchars(addslashes($platform['description'])) ?>', 
                            '<?= htmlspecialchars(addslashes($platform['url'])) ?>',
                            '<?= htmlspecialchars(addslashes($platform['status'])) ?>'
                        )" 
                        class="w-full bg-light-bg text-brand-blue font-bold py-3 px-4 rounded-xl hover:bg-brand-cyan hover:text-brand-blue transition-colors border border-gray-100">
                        Learn More
                    </button>
                </div>
                <?php endforeach; ?>

                <?php if(empty($platforms)): ?>
                <div class="col-span-full text-center py-12 text-gray-500 bg-white rounded-2xl border border-dashed border-gray-300">
                    <p class="text-lg font-medium">No platforms have been added to the portfolio yet.</p>
                </div>
                <?php endif; ?>
            </div>
        </div>

        <div id="platformModal" class="fixed inset-0 z-[100] hidden items-center justify-center p-4 sm:p-6">
            <div class="absolute inset-0 bg-brand-blue/80 backdrop-blur-sm transition-opacity" onclick="closePlatformModal()"></div>
            
            <div class="relative bg-white rounded-3xl shadow-2xl w-full max-w-2xl max-h-[90vh] overflow-hidden flex flex-col transform transition-all">
                <div class="px-6 py-5 border-b border-gray-100 flex items-center justify-between bg-light-bg">
                    <div class="flex items-center gap-3">
                        <img id="modalLogo" src="" alt="Logo" class="w-10 h-10 object-contain rounded-lg border border-gray-200 bg-white p-1">
                        <h3 id="modalTitle" class="font-bold text-2xl text-brand-blue">Platform Name</h3>
                    </div>
                    <button onclick="closePlatformModal()" class="text-gray-400 hover:text-gray-800 bg-white p-2 rounded-full shadow-sm hover:shadow transition-all">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                    </button>
                </div>
                
                <div class="p-6 overflow-y-auto flex-grow">
                    <span id="modalStatus" class="inline-block mb-4 text-xs font-bold uppercase tracking-wider px-3 py-1 rounded-full bg-gray-100 text-gray-600">Status</span>
                    <h4 class="text-sm font-bold text-gray-400 uppercase tracking-widest mb-2">About the System</h4>
                    <div id="modalDescription" class="text-text-body text-base leading-relaxed whitespace-pre-wrap">
                        </div>
                </div>
                
                <div class="px-6 py-5 border-t border-gray-100 bg-gray-50 flex justify-end gap-3">
                    <button onclick="closePlatformModal()" class="px-5 py-2.5 rounded-xl font-bold text-sm text-gray-500 hover:bg-gray-200 transition-colors">Close</button>
                    <a id="modalLink" href="#" target="_blank" class="bg-brand-blue text-white px-6 py-2.5 rounded-xl font-bold text-sm hover:bg-opacity-90 transition-all shadow-md flex items-center gap-2">
                        Visit Live System
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                    </a>
                </div>
            </div>
        </div>
    </main>

    <script>
        // Modal JavaScript Logic
        function openPlatformModal(name, logoPath, description, url, status) {
            document.getElementById('modalTitle').textContent = name;
            document.getElementById('modalLogo').src = logoPath;
            document.getElementById('modalDescription').textContent = description;
            
            const linkBtn = document.getElementById('modalLink');
            if (url) {
                linkBtn.href = url;
                linkBtn.style.display = 'flex';
            } else {
                linkBtn.style.display = 'none'; // Hide button if no URL is provided
            }

            const statusBadge = document.getElementById('modalStatus');
            statusBadge.textContent = status;
            if(status === 'Live') {
                statusBadge.className = 'inline-block mb-4 text-xs font-bold uppercase tracking-wider px-3 py-1 rounded-full bg-green-100 text-green-700';
            } else {
                statusBadge.className = 'inline-block mb-4 text-xs font-bold uppercase tracking-wider px-3 py-1 rounded-full bg-yellow-100 text-yellow-700';
            }

            // Show modal and lock background scroll
            const modal = document.getElementById('platformModal');
            modal.classList.remove('hidden');
            modal.classList.add('flex');
            document.body.style.overflow = 'hidden'; 
        }

        function closePlatformModal() {
            // Hide modal and restore background scroll
            const modal = document.getElementById('platformModal');
            modal.classList.add('hidden');
            modal.classList.remove('flex');
            document.body.style.overflow = ''; 
        }
    </script>

<?php
include 'templates/footer.php';
?>