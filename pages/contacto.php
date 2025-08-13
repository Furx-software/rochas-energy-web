<?php
// Incluir componentes optimizados
require_once 'components/home/button.php';
require_once 'config/performance.php';

// Configurar metadatos para SEO
$page_title = t('contact_title', 'meta');
$page_description = t('contact_description', 'meta');
$page_keywords = 'contacto, asesoría energética, consulta, ayuda, ahorro energía';
$page_author = t('author', 'meta');
$page_canonical = 'https://rochasenergy.com/contacto';

// Headers para SEO y rendimiento
header('X-Robots-Tag: index, follow');
header('Cache-Control: public, max-age=3600');

// Aplicar optimizaciones de rendimiento
applyPerformanceOptimizations();
applyMobileOptimizations();
?>

<!-- Hero Section Optimizado -->
<section class="relative py-20 sm:py-32 bg-gradient-to-br from-primary-50 to-primary-100 overflow-hidden" aria-labelledby="hero-title">
    <!-- Elementos decorativos optimizados -->
    <div class="absolute inset-0 overflow-hidden pointer-events-none" aria-hidden="true">
        <!-- Partículas de energía - Optimizadas para rendimiento -->
        <?php for ($i = 0; $i < 12; $i++): ?>
        <div class="energy-particle absolute w-1 h-1 bg-pink-400 rounded-full opacity-60 animate-pulse" 
             style="top: <?php echo rand(5, 95); ?>%; left: <?php echo rand(5, 95); ?>%; animation-delay: <?php echo $i * 0.3; ?>s;"></div>
        <?php endfor; ?>
        
        <!-- Rayos de luz optimizados -->
        <div class="energy-particle absolute top-0 left-1/3 w-px h-32 bg-gradient-to-b from-transparent via-pink-400 to-transparent opacity-40"></div>
        <div class="energy-particle absolute top-0 right-1/3 w-px h-28 bg-gradient-to-b from-transparent via-pink-400 to-transparent opacity-35" style="animation-delay: 0.8s;"></div>
        
        <!-- Efectos de energía -->
        <div class="energy-particle absolute bottom-20 right-20 w-16 h-16 bg-gradient-to-r from-pink-400 to-pink-600 rounded-full opacity-25 blur-sm animate-pulse"></div>
        <div class="energy-particle absolute top-20 left-20 w-12 h-12 bg-gradient-to-r from-pink-400 to-pink-600 rounded-full opacity-20 blur-sm animate-pulse" style="animation-delay: 1.2s;"></div>
    </div>
    
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <!-- Badge optimizado -->
        <div class="inline-flex items-center px-4 py-2 bg-white/60 backdrop-blur-sm rounded-full text-neutral-700 text-sm font-medium mb-8 shadow-sm">
            <svg class="w-4 h-4 mr-2 text-primary-500" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-2 0c0 .993-.241 1.929-.668 2.754l-1.524-1.525a3.997 3.997 0 00.078-2.183l1.562-1.562C15.802 8.249 16 9.1 16 10zm-5.165 3.913l1.58 1.58A5.98 5.98 0 0110 16a5.976 5.976 0 01-2.516-.552l1.562-1.562a4.006 4.006 0 001.789.027zm-4.677-2.796a4.002 4.002 0 01-.041-2.08l-.08.08-1.53-1.533A5.98 5.98 0 004 10c0 .954.223 1.856.619 2.657l1.54-1.54zm1.088-6.45A5.974 5.974 0 0110 4c.954 0 1.856.223 2.657.619l-1.54 1.54a4.002 4.002 0 00-2.346.033L7.246 4.668zM12 10a2 2 0 11-4 0 2 2 0 014 0z" clip-rule="evenodd"></path>
            </svg>
            <?php echo t('hero_badge', 'contact'); ?>
        </div>
        
        <h1 id="hero-title" class="text-4xl sm:text-5xl md:text-6xl font-bold text-neutral-800 mb-8 leading-tight">
            <?php echo t('hero_title', 'contact'); ?>
        </h1>
        
        <p class="text-xl sm:text-2xl text-neutral-700 max-w-4xl mx-auto leading-relaxed mb-8">
            <?php echo t('hero_subtitle', 'contact'); ?>
        </p>
        
        <p class="text-lg sm:text-xl text-neutral-600 max-w-3xl mx-auto leading-relaxed">
            <?php echo t('hero_description', 'contact'); ?>
        </p>
    </div>
</section>

<!-- Formulario de Contacto - Optimizado -->
<section class="py-20 sm:py-32 bg-white" aria-labelledby="contact-form">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-20">
            
            <!-- Formulario -->
            <div class="order-2 lg:order-1">
                <div class="bg-white rounded-2xl shadow-xl p-8 sm:p-12 border border-neutral-100">
                    <div class="text-center mb-8">
                        <h2 id="contact-form" class="text-3xl sm:text-4xl font-bold text-neutral-800 mb-4">
                            <?php echo t('form_title', 'contact'); ?>
                        </h2>
                        <p class="text-lg text-neutral-600">
                            <?php echo t('form_subtitle', 'contact'); ?>
                        </p>
                    </div>
                    
                    <form id="contactForm" class="space-y-6" novalidate>
                        <!-- Campo Nombre -->
                        <div class="form-group">
                            <label for="name" class="block text-sm font-semibold text-neutral-700 mb-2">
                                <?php echo t('name_label', 'contact'); ?> *
                            </label>
                            <input 
                                type="text" 
                                id="name" 
                                name="name" 
                                required
                                class="w-full px-4 py-3 border border-neutral-300 rounded-xl focus:ring-2 focus:ring-primary-500 focus:border-transparent transition-all duration-300 text-lg"
                                placeholder="<?php echo t('name_placeholder', 'contact'); ?>"
                                aria-describedby="name-error"
                            >
                            <div id="name-error" class="error-message hidden text-red-600 text-sm mt-1"></div>
                        </div>
                        
                        <!-- Campo Email -->
                        <div class="form-group">
                            <label for="email" class="block text-sm font-semibold text-neutral-700 mb-2">
                                <?php echo t('email_label', 'contact'); ?> *
                            </label>
                            <input 
                                type="email" 
                                id="email" 
                                name="email" 
                                required
                                class="w-full px-4 py-3 border border-neutral-300 rounded-xl focus:ring-2 focus:ring-primary-500 focus:border-transparent transition-all duration-300 text-lg"
                                placeholder="<?php echo t('email_placeholder', 'contact'); ?>"
                                aria-describedby="email-error"
                            >
                            <div id="email-error" class="error-message hidden text-red-600 text-sm mt-1"></div>
                        </div>
                        
                        <!-- Campo Mensaje -->
                        <div class="form-group">
                            <label for="message" class="block text-sm font-semibold text-neutral-700 mb-2">
                                <?php echo t('message_label', 'contact'); ?> *
                            </label>
                            <textarea 
                                id="message" 
                                name="message" 
                                required
                                rows="6"
                                class="w-full px-4 py-3 border border-neutral-300 rounded-xl focus:ring-2 focus:ring-primary-500 focus:border-transparent transition-all duration-300 text-lg resize-none"
                                placeholder="<?php echo t('message_placeholder', 'contact'); ?>"
                                aria-describedby="message-error"
                            ></textarea>
                            <div id="message-error" class="error-message hidden text-red-600 text-sm mt-1"></div>
                        </div>
                        
                        <!-- Botón de envío -->
                        <div class="pt-4">
                            <button 
                                type="submit" 
                                id="submitBtn"
                                class="w-full bg-gradient-to-r from-primary-600 to-primary-700 text-white font-semibold py-4 px-8 rounded-xl hover:from-primary-700 hover:to-primary-800 transform hover:scale-105 transition-all duration-300 text-lg shadow-lg hover:shadow-xl"
                            >
                                <span class="submit-text"><?php echo t('submit_button', 'contact'); ?></span>
                                <span class="sending-text hidden"><?php echo t('sending_button', 'contact'); ?></span>
                                <svg class="sending-icon hidden w-5 h-5 ml-2 animate-spin" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                                </svg>
                            </button>
                        </div>
                        
                        <!-- Mensajes de respuesta -->
                        <div id="formMessage" class="hidden mt-4 p-4 rounded-xl text-center"></div>
                    </form>
                </div>
            </div>
            
            <!-- Información de Contacto -->
            <div class="order-1 lg:order-2">
                <div class="text-center lg:text-left">
                    <h3 class="text-2xl sm:text-3xl font-bold text-neutral-800 mb-6">
                        <?php echo t('contact_info_title', 'contact'); ?>
                    </h3>
                    <p class="text-lg text-neutral-600 mb-12">
                        <?php echo t('contact_info_subtitle', 'contact'); ?>
                    </p>
                    
                    <div class="space-y-8">
                        <!-- Teléfono -->
                        <div class="flex flex-col items-center lg:flex-row lg:items-center lg:justify-start group">
                            <div class="w-12 h-12 bg-primary-100 rounded-xl flex items-center justify-center mb-3 lg:mb-0 lg:mr-4 group-hover:scale-110 transition-transform duration-300">
                                <svg class="w-6 h-6 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                </svg>
                            </div>
                            <div class="text-center lg:text-left">
                                <div class="text-sm font-semibold text-neutral-600"><?php echo t('phone_label', 'contact'); ?></div>
                                <a href="tel:<?php echo t('phone_value', 'contact'); ?>" class="text-lg font-semibold text-neutral-800 hover:text-primary-600 transition-colors duration-300">
                                    <?php echo t('phone_value', 'contact'); ?>
                                </a>
                            </div>
                        </div>
                        
                        <!-- Email -->
                        <div class="flex flex-col items-center lg:flex-row lg:items-center lg:justify-start group">
                            <div class="w-12 h-12 bg-accent-100 rounded-xl flex items-center justify-center mb-3 lg:mb-0 lg:mr-4 group-hover:scale-110 transition-transform duration-300">
                                <svg class="w-6 h-6 text-accent-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                            <div class="text-center lg:text-left">
                                <div class="text-sm font-semibold text-neutral-600"><?php echo t('email_label_info', 'contact'); ?></div>
                                <a href="mailto:<?php echo t('email_value', 'contact'); ?>" class="text-lg font-semibold text-neutral-800 hover:text-accent-600 transition-colors duration-300">
                                    <?php echo t('email_value', 'contact'); ?>
                                </a>
                            </div>
                        </div>
                        
                        <!-- Dirección -->
                        <div class="flex flex-col items-center lg:flex-row lg:items-center lg:justify-start group">
                            <div class="w-12 h-12 bg-primary-100 rounded-xl flex items-center justify-center mb-3 lg:mb-0 lg:mr-4 group-hover:scale-110 transition-transform duration-300">
                                <svg class="w-6 h-6 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                            </div>
                            <div class="text-center lg:text-left">
                                <div class="text-sm font-semibold text-neutral-600"><?php echo t('address_label', 'contact'); ?></div>
                                <div class="text-lg font-semibold text-neutral-800">
                                    <?php echo t('address_value', 'contact'); ?>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Horario -->
                        <div class="flex flex-col items-center lg:flex-row lg:items-center lg:justify-start group">
                            <div class="w-12 h-12 bg-accent-100 rounded-xl flex items-center justify-center mb-3 lg:mb-0 lg:mr-4 group-hover:scale-110 transition-transform duration-300">
                                <svg class="w-6 h-6 text-accent-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <div class="text-center lg:text-left">
                                <div class="text-sm font-semibold text-neutral-600"><?php echo t('schedule_label', 'contact'); ?></div>
                                <div class="text-lg font-semibold text-neutral-800">
                                    <?php echo t('schedule_value', 'contact'); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTA Final Optimizado -->
<section class="py-20 sm:py-32 bg-gradient-to-br from-neutral-900 via-neutral-800 to-primary-900 relative overflow-hidden" aria-labelledby="cta-title">
    <!-- Elementos decorativos optimizados -->
    <div class="absolute inset-0 pointer-events-none" aria-hidden="true">
        <!-- Partículas de energía optimizadas -->
        <?php for ($i = 0; $i < 10; $i++): ?>
        <div class="energy-particle absolute w-1 h-1 bg-pink-400 rounded-full opacity-50 animate-pulse" 
             style="top: <?php echo rand(5, 95); ?>%; left: <?php echo rand(5, 95); ?>%; animation-delay: <?php echo $i * 0.4; ?>s;"></div>
        <?php endfor; ?>
        
        <!-- Efectos de energía optimizados -->
        <div class="energy-particle absolute bottom-10 right-10 w-12 h-12 bg-gradient-to-r from-pink-400 to-pink-600 rounded-full opacity-20 blur-sm animate-pulse"></div>
        <div class="energy-particle absolute top-10 right-10 w-8 h-8 bg-gradient-to-r from-pink-300 to-pink-500 rounded-full opacity-15 blur-sm animate-pulse" style="animation-delay: 0.6s;"></div>
    </div>
    
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center">
            <!-- Badge optimizado -->
            <div class="inline-flex items-center px-4 py-2 bg-white/10 backdrop-blur-sm rounded-full text-white text-sm font-medium mb-8">
                <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
                    <path fill-rule="evenodd" d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                </svg>
                <?php echo t('cta_badge', 'contact'); ?>
            </div>
            
            <h2 id="cta-title" class="text-3xl sm:text-4xl md:text-5xl font-bold text-white mb-8 leading-tight">
                <?php echo t('cta_title', 'contact'); ?>
            </h2>
            
            <p class="text-xl text-white/90 max-w-3xl mx-auto leading-relaxed mb-12">
                <?php echo t('cta_subtitle', 'contact'); ?>
            </p>
            
            <div class="flex flex-col sm:flex-row gap-6 justify-center items-center">
                <?php echo renderButton(t('cta_button', 'contact'), '/servicios'); ?>
                
                <!-- Botón de llamada optimizado -->
                <a href="tel:+34600000000" 
                   class="group inline-flex items-center justify-center px-4 sm:px-8 py-3 sm:py-4 text-base sm:text-lg font-semibold text-primary-600 bg-white rounded-xl shadow-lg hover:shadow-xl transform hover:scale-105 transition-all duration-300 min-w-[200px] sm:min-w-0"
                   aria-label="Llamar al teléfono de contacto">
                    <svg class="w-5 h-5 mr-3 group-hover:rotate-12 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                    </svg>
                    <?php echo t('call_button', 'services'); ?>
                </a>
            </div>
        </div>
    </div>
</section>

<!-- JavaScript para el formulario -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('contactForm');
    const submitBtn = document.getElementById('submitBtn');
    const submitText = submitBtn.querySelector('.submit-text');
    const sendingText = submitBtn.querySelector('.sending-text');
    const sendingIcon = submitBtn.querySelector('.sending-icon');
    const formMessage = document.getElementById('formMessage');
    
    // Función para mostrar errores
    function showError(fieldId, message) {
        const field = document.getElementById(fieldId);
        const errorDiv = document.getElementById(fieldId + '-error');
        
        field.classList.add('border-red-500', 'focus:ring-red-500');
        errorDiv.textContent = message;
        errorDiv.classList.remove('hidden');
    }
    
    // Función para limpiar errores
    function clearErrors() {
        const errorMessages = document.querySelectorAll('.error-message');
        const fields = document.querySelectorAll('input, textarea');
        
        errorMessages.forEach(error => error.classList.add('hidden'));
        fields.forEach(field => {
            field.classList.remove('border-red-500', 'focus:ring-red-500');
            field.classList.add('border-neutral-300', 'focus:ring-primary-500');
        });
    }
    
    // Función para mostrar mensaje
    function showMessage(message, isSuccess = true) {
        formMessage.textContent = message;
        formMessage.className = `mt-4 p-4 rounded-xl text-center ${isSuccess ? 'bg-green-100 text-green-800 border border-green-200' : 'bg-red-100 text-red-800 border border-red-200'}`;
        formMessage.classList.remove('hidden');
        
        // Ocultar mensaje después de 5 segundos
        setTimeout(() => {
            formMessage.classList.add('hidden');
        }, 5000);
    }
    
    // Función para cambiar estado del botón
    function setButtonState(isLoading) {
        if (isLoading) {
            submitBtn.disabled = true;
            submitText.classList.add('hidden');
            sendingText.classList.remove('hidden');
            sendingIcon.classList.remove('hidden');
        } else {
            submitBtn.disabled = false;
            submitText.classList.remove('hidden');
            sendingText.classList.add('hidden');
            sendingIcon.classList.add('hidden');
        }
    }
    
    // Manejar envío del formulario
    form.addEventListener('submit', async function(e) {
        e.preventDefault();
        
        // Limpiar errores previos
        clearErrors();
        formMessage.classList.add('hidden');
        
        // Obtener datos del formulario
        const formData = new FormData(form);
        const data = {
            name: formData.get('name'),
            email: formData.get('email'),
            message: formData.get('message')
        };
        
        // Cambiar estado del botón
        setButtonState(true);
        
        try {
            const response = await fetch('/process-contact.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify(data)
            });
            
            const result = await response.json();
            
            if (result.success) {
                showMessage(result.message, true);
                form.reset();
            } else {
                if (result.errors) {
                    // Mostrar errores específicos
                    Object.keys(result.errors).forEach(field => {
                        showError(field, result.errors[field]);
                    });
                } else {
                    showMessage(result.message, false);
                }
            }
        } catch (error) {
            console.error('Error:', error);
            showMessage('Error de conexión. Inténtalo de nuevo.', false);
        } finally {
            setButtonState(false);
        }
    });
    
    // Validación en tiempo real
    const fields = ['name', 'email', 'message'];
    fields.forEach(fieldId => {
        const field = document.getElementById(fieldId);
        field.addEventListener('blur', function() {
            const value = this.value.trim();
            const errorDiv = document.getElementById(fieldId + '-error');
            
            // Limpiar error previo
            this.classList.remove('border-red-500', 'focus:ring-red-500');
            this.classList.add('border-neutral-300', 'focus:ring-primary-500');
            errorDiv.classList.add('hidden');
            
            // Validar campo
            if (!value) {
                showError(fieldId, '<?php echo t('validation_required', 'contact'); ?>');
            } else if (fieldId === 'email' && !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(value)) {
                showError(fieldId, '<?php echo t('validation_email', 'contact'); ?>');
            } else if (fieldId === 'message' && value.length < 10) {
                showError(fieldId, '<?php echo t('validation_min_length', 'contact'); ?>');
            }
        });
    });
});
</script>
