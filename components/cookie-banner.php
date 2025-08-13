<?php
require_once '../config/cookies.php';

// Verificar si ya se ha aceptado las cookies
$cookiesAccepted = areCookiesAccepted();
$current_lang = getCurrentLanguage();
?>

<?php if (!$cookiesAccepted): ?>
<!-- Cookie Banner - Optimizado -->
<div id="cookieBanner" class="fixed bottom-0 left-0 right-0 z-50 transform translate-y-full transition-transform duration-500 ease-in-out">
    <div class="bg-white/95 backdrop-blur-md border-t border-neutral-200 shadow-2xl">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
            <div class="flex flex-col lg:flex-row items-start lg:items-center justify-between gap-6">
                
                <!-- Contenido del banner -->
                <div class="flex-1">
                    <div class="flex items-start gap-4">
                        <!-- Icono de cookies -->
                        <div class="flex-shrink-0">
                            <div class="w-12 h-12 bg-primary-100 rounded-xl flex items-center justify-center">
                                <svg class="w-6 h-6 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                                </svg>
                            </div>
                        </div>
                        
                        <!-- Texto del banner -->
                        <div class="flex-1">
                            <h3 class="text-lg font-semibold text-neutral-800 mb-2">
                                <?php echo t('title', 'cookies'); ?>
                            </h3>
                            <p class="text-neutral-600 leading-relaxed">
                                <?php 
                                $description = t('description', 'cookies');
                                $policy_link = t('policy_link', 'cookies');
                                $policy_url = $current_lang === 'es' ? '/politica-privacidad' : '/privacy-policy';
                                echo str_replace('política de cookies', '<a href="' . $policy_url . '" class="text-primary-600 hover:text-primary-700 underline font-medium">' . $policy_link . '</a>', $description);
                                ?>
                            </p>
                        </div>
                    </div>
                </div>
                
                <!-- Botones de acción -->
                <div class="flex flex-col sm:flex-row gap-3 flex-shrink-0">
                    <!-- Botón Rechazar -->
                    <button 
                        id="rejectCookies"
                        class="px-6 py-3 text-neutral-700 bg-neutral-100 hover:bg-neutral-200 rounded-xl font-medium transition-all duration-300 transform hover:scale-105"
                    >
                        <?php echo t('reject_button', 'cookies'); ?>
                    </button>
                    
                    <!-- Botón Aceptar -->
                    <button 
                        id="acceptCookies"
                        class="px-6 py-3 bg-gradient-to-r from-primary-600 to-primary-700 text-white rounded-xl font-medium hover:from-primary-700 hover:to-primary-800 transition-all duration-300 transform hover:scale-105 shadow-lg hover:shadow-xl"
                    >
                        <?php echo t('accept_button', 'cookies'); ?>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- JavaScript para el banner de cookies -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const cookieBanner = document.getElementById('cookieBanner');
    const acceptBtn = document.getElementById('acceptCookies');
    const rejectBtn = document.getElementById('rejectCookies');
    
    // Mostrar el banner con animación
    setTimeout(() => {
        cookieBanner.classList.remove('translate-y-full');
    }, 1000);
    
    // Función para aceptar cookies
    function acceptCookies() {
        // Establecer cookie por 1 año
        const expiryDate = new Date();
        expiryDate.setFullYear(expiryDate.getFullYear() + 1);
        document.cookie = `rochas_cookies_accepted=true; expires=${expiryDate.toUTCString()}; path=/; SameSite=Lax`;
        
        // Ocultar banner con animación
        cookieBanner.classList.add('translate-y-full');
        
        // Eliminar banner del DOM después de la animación
        setTimeout(() => {
            cookieBanner.remove();
        }, 500);
        
        // Mostrar mensaje de confirmación
        showCookieMessage('<?php echo t('accepted_message', 'cookies'); ?>', true);
    }
    
    // Función para rechazar cookies
    function rejectCookies() {
        // Establecer cookie de rechazo por 1 año
        const expiryDate = new Date();
        expiryDate.setFullYear(expiryDate.getFullYear() + 1);
        document.cookie = `rochas_cookies_accepted=false; expires=${expiryDate.toUTCString()}; path=/; SameSite=Lax`;
        
        // Ocultar banner con animación
        cookieBanner.classList.add('translate-y-full');
        
        // Eliminar banner del DOM después de la animación
        setTimeout(() => {
            cookieBanner.remove();
        }, 500);
        
        // Mostrar mensaje de confirmación
        showCookieMessage('<?php echo t('rejected_message', 'cookies'); ?>', false);
    }
    
    // Función para mostrar mensaje de confirmación
    function showCookieMessage(message, isAccepted) {
        // Crear elemento de mensaje
        const messageElement = document.createElement('div');
        messageElement.className = `fixed top-4 right-4 z-50 px-6 py-4 rounded-xl shadow-lg transform translate-x-full transition-transform duration-300 ${
            isAccepted ? 'bg-green-100 text-green-800 border border-green-200' : 'bg-yellow-100 text-yellow-800 border border-yellow-200'
        }`;
        messageElement.innerHTML = `
            <div class="flex items-center gap-3">
                <svg class="w-5 h-5 ${isAccepted ? 'text-green-600' : 'text-yellow-600'}" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
                </svg>
                <span class="font-medium">${message}</span>
            </div>
        `;
        
        document.body.appendChild(messageElement);
        
        // Mostrar mensaje
        setTimeout(() => {
            messageElement.classList.remove('translate-x-full');
        }, 100);
        
        // Ocultar mensaje después de 3 segundos
        setTimeout(() => {
            messageElement.classList.add('translate-x-full');
            setTimeout(() => {
                messageElement.remove();
            }, 300);
        }, 3000);
    }
    
    // Event listeners
    acceptBtn.addEventListener('click', acceptCookies);
    rejectBtn.addEventListener('click', rejectCookies);
    
    // Cerrar con Escape
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && cookieBanner && !cookieBanner.classList.contains('translate-y-full')) {
            rejectCookies();
        }
    });
});
</script>
<?php endif; ?>
