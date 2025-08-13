<?php require_once 'config/utilities.php'; ?>
<footer class="bg-neutral-900 text-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
            <!-- Logo y descripción -->
            <div class="col-span-1 md:col-span-2 text-center md:text-left">
                <div class="flex items-center justify-center md:justify-start mb-4">
                    <img src="src/img/logo_rochas_rosa.png" alt="Rochas Logo" class="h-10 w-auto">
                    <span class="ml-3 text-xl font-bold"><?php echo t('company_name', 'common'); ?></span>
                </div>
                <p class="text-neutral-400 mb-4 max-w-md mx-auto md:mx-0">
                    <?php echo t('description', 'footer'); ?>
                </p>
                <div class="flex space-x-4 justify-center md:justify-start">
                    <!-- Twitter/X -->
                    <a href="https://twitter.com/rochasenergy" target="_blank" rel="noopener noreferrer" class="social-link hover:text-blue-400 transition-colors duration-300" aria-label="Síguenos en Twitter/X">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/>
                        </svg>
                    </a>
                    
                    <!-- Instagram -->
                    <a href="https://instagram.com/rochasenergy" target="_blank" rel="noopener noreferrer" class="social-link hover:text-pink-400 transition-colors duration-300" aria-label="Síguenos en Instagram">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12.017 0C5.396 0 .029 5.367.029 11.987c0 6.62 5.367 11.987 11.988 11.987 6.62 0 11.987-5.367 11.987-11.987C24.014 5.367 18.637.001 12.017.001zM8.449 16.988c-1.297 0-2.448-.49-3.323-1.297C4.198 14.895 3.708 13.744 3.708 12.447s.49-2.448 1.297-3.323c.875-.807 2.026-1.297 3.323-1.297s2.448.49 3.323 1.297c.807.875 1.297 2.026 1.297 3.323s-.49 2.448-1.297 3.323c-.875.807-2.026 1.297-3.323 1.297zm7.718-1.297c-.875.807-2.026 1.297-3.323 1.297s-2.448-.49-3.323-1.297c-.807-.875-1.297-2.026-1.297-3.323s.49-2.448 1.297-3.323c.875-.807 2.026-1.297 3.323-1.297s2.448.49 3.323 1.297c.807.875 1.297 2.026 1.297 3.323s-.49 2.448-1.297 3.323z"/>
                        </svg>
                    </a>
                    
                    <!-- LinkedIn -->
                    <a href="https://linkedin.com/company/rochasenergy" target="_blank" rel="noopener noreferrer" class="social-link hover:text-blue-600 transition-colors duration-300" aria-label="Síguenos en LinkedIn">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/>
                        </svg>
                    </a>
                </div>
            </div>

            <!-- Enlaces rápidos -->
            <div class="text-center md:text-left">
                <h3 class="text-lg font-semibold mb-4"><?php echo t('quick_links', 'footer'); ?></h3>
                <ul class="space-y-2">
                    <li><a href="/" class="footer-link"><?php echo t('home', 'nav'); ?></a></li>
                    <li><a href="/servicios" class="footer-link"><?php echo t('services', 'nav'); ?></a></li>
                    <li><a href="/contacto" class="footer-link"><?php echo t('contact', 'nav'); ?></a></li>
                </ul>
            </div>

            <!-- Contacto -->
            <div class="text-center md:text-left">
                <h3 class="text-lg font-semibold mb-4"><?php echo t('contact_info', 'footer'); ?></h3>
                <div class="space-y-2 text-neutral-400">
                    <p><?php echo t('email', 'footer'); ?></p>
                    <p><?php echo t('location', 'footer'); ?></p>
                </div>
            </div>
        </div>

        <!-- Línea divisoria -->
        <div class="border-t border-neutral-800 mt-8 pt-8">
            <div class="flex flex-col md:flex-row justify-between items-center">
                <p class="text-neutral-400 text-sm text-center md:text-left">
                    <?php echo getDynamicCopyright(getCurrentLanguage()); ?>
                </p>
                <div class="flex space-x-6 mt-4 md:mt-0 justify-center md:justify-start">
                    <a href="/politica-privacidad" class="footer-link text-sm">
                        <?php echo t('privacy', 'footer'); ?>
                    </a>
                    <a href="/terminos-condiciones" class="footer-link text-sm">
                        <?php echo t('terms', 'footer'); ?>
                    </a>
                    <a href="/admin/login.php" class="text-neutral-500 hover:text-neutral-400 text-xs transition-colors duration-200" title="Panel de Administración" id="admin-link" style="opacity: 0.3;">
                        ⚙️
                    </a>
                </div>
            </div>
        </div>
    </div>
</footer>

<script>
// Enlace oculto al panel de administración
// Presiona Ctrl + Alt + A para hacer visible el enlace
document.addEventListener('keydown', function(e) {
    if (e.ctrlKey && e.altKey && e.key === 'a') {
        e.preventDefault();
        const adminLink = document.getElementById('admin-link');
        if (adminLink) {
            adminLink.style.opacity = '1';
            adminLink.style.color = '#3b82f6';
            setTimeout(() => {
                adminLink.style.opacity = '0.3';
                adminLink.style.color = '';
            }, 3000);
        }
    }
});
</script>
