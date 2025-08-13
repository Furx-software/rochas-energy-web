<?php
require_once 'config/languages.php';
require_once 'config/routes.php';

$current_lang = getCurrentLanguage();

// Configuración de idiomas con flags y nombres
$language_config = [
    'es' => [
        'name' => 'Español',
        'flag' => '🇪🇸'
    ],
    'en' => [
        'name' => 'English',
        'flag' => '🇺🇸'
    ],
    'ca' => [
        'name' => 'Català',
        'flag' => '🇪🇸'
    ],
    'pt' => [
        'name' => 'Português',
        'flag' => '🇵🇹'
    ],
    'fr' => [
        'name' => 'Français',
        'flag' => '🇫🇷'
    ]
];
?>

<nav class="bg-white shadow-lg fixed w-full top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">
            <!-- Logo -->
            <div class="flex-shrink-0">
                <a href="/" class="flex items-center">
                    <img src="src/img/logo_rochas_rosa.png" alt="Rochas Logo" class="h-10 w-auto">
                    <span class="ml-3 text-xl font-bold text-neutral-800"><?php echo t('company_name', 'common'); ?></span>
                </a>
            </div>

            <!-- Desktop Navigation -->
            <div class="hidden md:block">
                <div class="ml-10 flex items-baseline space-x-4">
                    <a href="/" class="nav-link">
                        <?php echo t('home'); ?>
                    </a>
                    <a href="/servicios" class="nav-link">
                        <?php echo t('services'); ?>
                    </a>
                    <a href="/contacto" class="nav-link">
                        <?php echo t('contact'); ?>
                    </a>
                </div>
            </div>

            <!-- Language Selector and Mobile Menu Button -->
            <div class="flex items-center space-x-4">
                <!-- Language Selector -->
                <div class="relative">
                    <button id="languageBtn" class="flex items-center space-x-2 text-neutral-600 hover:text-primary-500 transition-colors duration-200">
                        <span class="text-lg"><?php echo $language_config[$current_lang]['flag']; ?></span>
                        <span class="hidden sm:inline text-sm font-medium"><?php echo $language_config[$current_lang]['name']; ?></span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>
                    
                    <!-- Language Dropdown -->
                    <div id="languageDropdown" class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 z-50 hidden">
                        <?php foreach ($language_config as $code => $lang): ?>
                            <a href="?lang=<?php echo $code; ?>" class="flex items-center px-4 py-2 text-sm text-neutral-700 hover:bg-primary-50 transition-colors duration-200">
                                <span class="text-lg mr-3"><?php echo $lang['flag']; ?></span>
                                <?php echo $lang['name']; ?>
                            </a>
                        <?php endforeach; ?>
                    </div>
                </div>

                <!-- Mobile menu button -->
                <div class="md:hidden">
                    <button id="mobileMenuBtn" class="text-neutral-600 hover:text-primary-500 focus:outline-none focus:text-primary-500">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Mobile Navigation -->
    <div id="mobileMenu" class="md:hidden hidden">
        <div class="px-2 pt-2 pb-3 space-y-1 sm:px-3 bg-white border-t">
            <a href="/" class="nav-link-mobile">
                <?php echo t('home'); ?>
            </a>
            <a href="/servicios" class="nav-link-mobile">
                <?php echo t('services'); ?>
            </a>
            <a href="/contacto" class="nav-link-mobile">
                <?php echo t('contact'); ?>
            </a>
        </div>
    </div>
</nav>

<!-- Spacer para el contenido debajo del navbar fijo -->
<div class="h-16"></div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Language dropdown toggle
    const languageBtn = document.getElementById('languageBtn');
    const languageDropdown = document.getElementById('languageDropdown');
    
    languageBtn.addEventListener('click', function() {
        languageDropdown.classList.toggle('hidden');
    });
    
    // Close language dropdown when clicking outside
    document.addEventListener('click', function(event) {
        if (!languageBtn.contains(event.target) && !languageDropdown.contains(event.target)) {
            languageDropdown.classList.add('hidden');
        }
    });
    
    // Mobile menu toggle
    const mobileMenuBtn = document.getElementById('mobileMenuBtn');
    const mobileMenu = document.getElementById('mobileMenu');
    
    mobileMenuBtn.addEventListener('click', function() {
        mobileMenu.classList.toggle('hidden');
        
        // Change icon based on menu state
        const svg = mobileMenuBtn.querySelector('svg');
        if (mobileMenu.classList.contains('hidden')) {
            svg.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>';
        } else {
            svg.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>';
        }
    });
});
</script>
