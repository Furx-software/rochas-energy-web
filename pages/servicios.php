<?php
// Incluir componentes optimizados
require_once '../components/home/button.php';
require_once '../config/performance.php';

// Configurar metadatos para SEO
$page_title = t('services_title', 'meta');
$page_description = t('services_description', 'meta');
$page_keywords = 'servicios energéticos, asesoría energética, ahorro luz, factura eléctrica, optimización energética';
$page_author = t('author', 'meta');
$page_canonical = 'https://rochasenergy.com/servicios';

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
        <?php for ($i = 0; $i < 15; $i++): ?>
        <div class="energy-particle absolute w-1 h-1 bg-pink-400 rounded-full opacity-60 animate-pulse" 
             style="top: <?php echo rand(5, 95); ?>%; left: <?php echo rand(5, 95); ?>%; animation-delay: <?php echo $i * 0.2; ?>s;"></div>
        <?php endfor; ?>
        
        <!-- Rayos de luz optimizados -->
        <div class="energy-particle absolute top-0 left-1/4 w-px h-32 bg-gradient-to-b from-transparent via-pink-400 to-transparent opacity-40"></div>
        <div class="energy-particle absolute top-0 right-1/4 w-px h-28 bg-gradient-to-b from-transparent via-pink-400 to-transparent opacity-35" style="animation-delay: 0.7s;"></div>
        
        <!-- Efectos de energía -->
        <div class="energy-particle absolute bottom-20 right-20 w-16 h-16 bg-gradient-to-r from-pink-400 to-pink-600 rounded-full opacity-25 blur-sm animate-pulse"></div>
        <div class="energy-particle absolute top-20 left-20 w-12 h-12 bg-gradient-to-r from-pink-400 to-pink-600 rounded-full opacity-20 blur-sm animate-pulse" style="animation-delay: 1.3s;"></div>
    </div>
    
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <!-- Badge optimizado -->
        <div class="inline-flex items-center px-4 py-2 bg-white/60 backdrop-blur-sm rounded-full text-neutral-700 text-sm font-medium mb-8 shadow-sm">
            <svg class="w-4 h-4 mr-2 text-primary-500" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
            </svg>
            <?php echo t('hero_badge', 'services'); ?>
        </div>
        
        <h1 id="hero-title" class="text-4xl sm:text-5xl md:text-6xl font-bold text-neutral-800 mb-8 leading-tight">
            <?php echo t('hero_title', 'services'); ?>
        </h1>
        
        <p class="text-xl sm:text-2xl text-neutral-700 max-w-4xl mx-auto leading-relaxed mb-8">
            <?php echo t('hero_subtitle', 'services'); ?>
        </p>
        
        <p class="text-lg sm:text-xl text-neutral-600 max-w-3xl mx-auto leading-relaxed">
            <?php echo t('hero_description', 'services'); ?>
        </p>
    </div>
</section>

<!-- Servicios Principales - Optimizado para SEO -->
<section class="py-20 sm:py-32 bg-white" aria-labelledby="services-title">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header optimizado -->
        <div class="text-center mb-16 sm:mb-20">
            <h2 id="services-title" class="text-3xl sm:text-4xl md:text-5xl font-bold text-neutral-800 mb-6">
                <?php echo t('services_header_title', 'services'); ?>
            </h2>
        </div>
        
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 sm:gap-12">
            <!-- Servicio 01 - Optimizado -->
            <article class="service-card group">
                <div class="relative bg-white rounded-2xl p-8 shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2 border border-neutral-100">
                    <!-- Número de servicio -->
                    <div class="absolute top-4 right-4">
                        <div class="w-8 h-8 bg-primary-100 rounded-lg flex items-center justify-center">
                            <span class="text-primary-600 font-bold text-sm" aria-label="Servicio número 1">01</span>
                        </div>
                    </div>
                    
                    <!-- Icono optimizado -->
                    <div class="mb-6">
                        <div class="w-16 h-16 bg-gradient-to-br from-primary-100 to-primary-200 rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                            <svg class="w-8 h-8 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                            </svg>
                        </div>
                    </div>
                    
                    <h3 class="text-2xl font-bold text-neutral-800 mb-4 group-hover:text-primary-600 transition-colors duration-300">
                        <?php echo t('service1_title', 'services'); ?>
                    </h3>
                    
                    <p class="text-neutral-600 leading-relaxed text-lg">
                        <?php echo t('service1_desc', 'services'); ?>
                    </p>
                </div>
            </article>

            <!-- Servicio 02 - Optimizado -->
            <article class="service-card group">
                <div class="relative bg-white rounded-2xl p-8 shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2 border border-neutral-100">
                    <!-- Número de servicio -->
                    <div class="absolute top-4 right-4">
                        <div class="w-8 h-8 bg-accent-100 rounded-lg flex items-center justify-center">
                            <span class="text-accent-600 font-bold text-sm" aria-label="Servicio número 2">02</span>
                        </div>
                    </div>
                    
                    <!-- Icono optimizado -->
                    <div class="mb-6">
                        <div class="w-16 h-16 bg-gradient-to-br from-accent-100 to-accent-200 rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                            <svg class="w-8 h-8 text-accent-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 100 4m0-4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 100 4m0-4v2m0-6V4"></path>
                            </svg>
                        </div>
                    </div>
                    
                    <h3 class="text-2xl font-bold text-neutral-800 mb-4 group-hover:text-accent-600 transition-colors duration-300">
                        <?php echo t('service2_title', 'services'); ?>
                    </h3>
                    
                    <p class="text-neutral-600 leading-relaxed text-lg">
                        <?php echo t('service2_desc', 'services'); ?>
                    </p>
                </div>
            </article>

            <!-- Servicio 03 - Optimizado -->
            <article class="service-card group">
                <div class="relative bg-white rounded-2xl p-8 shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2 border border-neutral-100">
                    <!-- Número de servicio -->
                    <div class="absolute top-4 right-4">
                        <div class="w-8 h-8 bg-primary-100 rounded-lg flex items-center justify-center">
                            <span class="text-primary-600 font-bold text-sm" aria-label="Servicio número 3">03</span>
                        </div>
                    </div>
                    
                    <!-- Icono optimizado -->
                    <div class="mb-6">
                        <div class="w-16 h-16 bg-gradient-to-br from-primary-100 to-primary-200 rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                            <svg class="w-8 h-8 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path>
                            </svg>
                        </div>
                    </div>
                    
                    <h3 class="text-2xl font-bold text-neutral-800 mb-4 group-hover:text-primary-600 transition-colors duration-300">
                        <?php echo t('service3_title', 'services'); ?>
                    </h3>
                    
                    <p class="text-neutral-600 leading-relaxed text-lg">
                        <?php echo t('service3_desc', 'services'); ?>
                    </p>
                </div>
            </article>
        </div>
    </div>
</section>

<!-- CTA Final Optimizado -->
<section class="py-20 sm:py-32 bg-gradient-to-br from-neutral-900 via-neutral-800 to-primary-900 relative overflow-hidden" aria-labelledby="cta-title">
    <!-- Elementos decorativos optimizados -->
    <div class="absolute inset-0 pointer-events-none" aria-hidden="true">
        <!-- Partículas de energía optimizadas -->
        <?php for ($i = 0; $i < 12; $i++): ?>
        <div class="energy-particle absolute w-1 h-1 bg-pink-400 rounded-full opacity-50 animate-pulse" 
             style="top: <?php echo rand(5, 95); ?>%; left: <?php echo rand(5, 95); ?>%; animation-delay: <?php echo $i * 0.3; ?>s;"></div>
        <?php endfor; ?>
        
        <!-- Efectos de energía optimizados -->
        <div class="energy-particle absolute bottom-10 right-10 w-12 h-12 bg-gradient-to-r from-pink-400 to-pink-600 rounded-full opacity-20 blur-sm animate-pulse"></div>
        <div class="energy-particle absolute top-10 right-10 w-8 h-8 bg-gradient-to-r from-pink-300 to-pink-500 rounded-full opacity-15 blur-sm animate-pulse" style="animation-delay: 0.7s;"></div>
    </div>
    
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- CTA optimizado -->
        <div class="text-center mb-20">
            <!-- Badge optimizado -->
            <div class="inline-flex items-center px-4 py-2 bg-white/10 backdrop-blur-sm rounded-full text-white text-sm font-medium mb-8">
                <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
                    <path fill-rule="evenodd" d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                </svg>
                <?php echo t('cta_badge', 'services'); ?>
            </div>
            
            <h2 id="cta-title" class="text-3xl sm:text-4xl md:text-5xl font-bold text-white mb-8 leading-tight">
                <?php echo t('cta_title', 'services'); ?>
            </h2>
            
            <p class="text-xl text-white/90 max-w-3xl mx-auto leading-relaxed mb-6">
                <?php echo t('cta_subtitle', 'services'); ?>
            </p>
            
            <p class="text-lg text-white/80 max-w-2xl mx-auto leading-relaxed mb-12">
                <?php echo t('cta_description', 'services'); ?>
            </p>
            
            <div class="flex flex-col sm:flex-row gap-6 justify-center items-center">
                <?php echo renderButton(t('cta_button', 'services'), '/contacto'); ?>
                
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



