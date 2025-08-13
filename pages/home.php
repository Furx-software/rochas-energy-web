<?php
// Incluir componentes
require_once '../components/home/hero-section.php';
require_once '../components/home/content-section.php';
require_once '../components/home/button.php';
require_once '../components/home/testimonial-card.php';
require_once '../components/home/skeleton-loader.php';
require_once '../config/testimonials.php';
?>

<!-- Hero Section -->
<?php 
renderHeroSection(
    t('hero_title', 'home'),
    t('hero_subtitle', 'home'),
    t('hero_button', 'home')
);
?>

<!-- Features Section -->
<?php
$featuresContent = '
<div class="grid grid-cols-1 md:grid-cols-3 gap-6 sm:gap-8">
    <!-- Feature 1 -->
    <div class="text-center p-4 sm:p-6 rounded-lg hover:shadow-lg transition-shadow duration-300">
        <div class="w-12 h-12 sm:w-16 sm:h-16 bg-primary-100 rounded-full flex items-center justify-center mx-auto mb-4">
            <svg class="w-6 h-6 sm:w-8 sm:h-8 text-primary-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path>
            </svg>
        </div>
        <h3 class="text-lg sm:text-xl font-semibold text-neutral-800 mb-2">' . t('feature1_title', 'home') . '</h3>
        <p class="text-sm sm:text-base text-neutral-600">' . t('feature1_desc', 'home') . '</p>
    </div>

    <!-- Feature 2 -->
    <div class="text-center p-4 sm:p-6 rounded-lg hover:shadow-lg transition-shadow duration-300">
        <div class="w-12 h-12 sm:w-16 sm:h-16 bg-primary-100 rounded-full flex items-center justify-center mx-auto mb-4">
            <svg class="w-6 h-6 sm:w-8 sm:h-8 text-primary-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
            </svg>
        </div>
        <h3 class="text-lg sm:text-xl font-semibold text-neutral-800 mb-2">' . t('feature2_title', 'home') . '</h3>
        <p class="text-sm sm:text-base text-neutral-600">' . t('feature2_desc', 'home') . '</p>
    </div>

    <!-- Feature 3 -->
    <div class="text-center p-4 sm:p-6 rounded-lg hover:shadow-lg transition-shadow duration-300">
        <div class="w-12 h-12 sm:w-16 sm:h-16 bg-primary-100 rounded-full flex items-center justify-center mx-auto mb-4">
            <svg class="w-6 h-6 sm:w-8 sm:h-8 text-primary-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192L5.636 18.364M12 2.25a9.75 9.75 0 100 19.5 9.75 9.75 0 000-19.5z"></path>
            </svg>
        </div>
        <h3 class="text-lg sm:text-xl font-semibold text-neutral-800 mb-2">' . t('feature3_title', 'home') . '</h3>
        <p class="text-sm sm:text-base text-neutral-600">' . t('feature3_desc', 'home') . '</p>
    </div>
</div>';

renderContentSection(
    t('why_choose_title', 'home'),
    t('why_choose_subtitle', 'home'),
    $featuresContent,
    'bg-white'
);
?>

<!-- Sección Unificada: Testimonials + Asesoría Energética -->
<section class="py-16 sm:py-20 bg-gradient-to-br from-neutral-50 to-primary-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Testimonials Section -->
        <div class="text-center mb-12 sm:mb-16">
            <h2 class="text-2xl sm:text-3xl md:text-4xl font-bold text-neutral-800 mb-4">
                <?php echo t('testimonials_title', 'home'); ?>
            </h2>
            <p class="text-lg sm:text-xl text-neutral-600 max-w-2xl mx-auto">
                <?php echo t('testimonials_subtitle', 'home'); ?>
            </p>
        </div>
        
        <!-- Carrusel de Reseñas -->
        <div class="relative mb-12">
            <!-- Botón Anterior -->
            <button id="prevBtn" class="absolute left-0 top-1/2 transform -translate-y-1/2 z-10 bg-white rounded-full p-2 shadow-lg hover:shadow-xl transition-shadow duration-300">
                <svg class="w-6 h-6 text-neutral-400 hover:text-primary-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
            </button>
            
            <!-- Botón Siguiente -->
            <button id="nextBtn" class="absolute right-0 top-1/2 transform -translate-y-1/2 z-10 bg-white rounded-full p-2 shadow-lg hover:shadow-xl transition-shadow duration-300">
                <svg class="w-6 h-6 text-neutral-400 hover:text-primary-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
            </button>
            
            <!-- Contenedor del Carrusel -->
            <div class="overflow-hidden">
                <div id="testimonialsCarousel" class="flex transition-transform duration-500 ease-in-out">
                    <?php
                    $testimonials = getTestimonials();
                    foreach ($testimonials as $testimonial) {
                        renderTestimonialCard(
                            $testimonial['name'],
                            $testimonial['date'],
                            $testimonial['review'],
                            $testimonial['initial'],
                            $testimonial['color'],
                            $testimonial['stars'],
                            $testimonial['showReadMore']
                        );
                    }
                    ?>
                </div>
            </div>
        </div>
        
        <!-- Botón para ver más reseñas -->
        <div class="text-center mb-16 sm:mb-20">
            <?php
            $googleIcon = '<svg class="w-6 h-6 mr-2" viewBox="0 0 24 24" fill="currentColor">
                <path d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/>
                <path d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/>
                <path d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z"/>
                <path d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"/>
            </svg>';
            
            echo renderButton(
                t('view_reviews_button', 'home'),
                'https://www.google.com/search?sca_esv=2bfcaaea2384c7b9&tbm=lcl&q=Rochas+Energy+Rese%C3%B1as&rflfq=1&num=20&stick=H4sIAAAAAAAAAONgkxI2szS1MDcxNTYyNDczNzAxMTAy3cDI-IpRLCg_OSOxWME1L7UovVIhKLU49fDGxOJFrDgkANQ42FJMAAAA&rldimm=6958745321767044025&hl=es-ES&sa=X&ved=2ahUKEwjD77uChIWPAxX1TqQEHQnUD1kQ9fQKegQIMRAF&biw=2560&bih=945&dpr=1#lkt=LocalPoiReviews',
                $googleIcon,
                '_blank',
                'noopener noreferrer'
            );
            ?>
        </div>
        
        <!-- Separador visual -->
        <div class="w-24 h-1 bg-gradient-to-r from-primary-500 to-primary-600 mx-auto mb-16 sm:mb-20 rounded-full"></div>
        
        <!-- Asesoría Energética para Empresas -->
        <div class="text-center mb-12 sm:mb-16">
            <h2 class="text-2xl sm:text-3xl md:text-4xl font-bold text-neutral-800 mb-4">
                <?php echo t('consulting_title', 'home'); ?>
            </h2>
            <p class="text-lg sm:text-xl text-neutral-600 max-w-2xl mx-auto">
                <?php echo t('consulting_subtitle', 'home'); ?>
            </p>
        </div>
        
        <div class="text-center">
            <?php echo renderButton(t('consulting_button', 'home'), '/contacto'); ?>
        </div>
    </div>
</section>

<!-- Nuestra Historia Section - Nuevo Diseño -->
<section class="py-16 sm:py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12 sm:mb-16">
            <h2 class="text-2xl sm:text-3xl md:text-4xl font-bold text-neutral-800 mb-4">
                <?php echo t('our_story_title', 'home'); ?>
            </h2>
            <p class="text-lg sm:text-xl text-neutral-600 max-w-3xl mx-auto">
                <?php echo t('our_story_subtitle', 'home'); ?>
            </p>
        </div>
        
        <!-- Timeline Horizontal -->
        <div class="relative">
            <!-- Línea de tiempo -->
            <div class="absolute left-1/2 transform -translate-x-1/2 w-1 bg-gradient-to-b from-primary-500 to-accent-500 h-full hidden lg:block"></div>
            
            <div class="space-y-12 lg:space-y-0">
                <!-- Paso 1 -->
                <div class="relative lg:flex lg:items-center lg:justify-between">
                    <div class="lg:w-5/12 lg:pr-8 mb-8 lg:mb-0">
                        <div class="bg-gradient-to-r from-primary-50 to-primary-100 rounded-2xl p-6 sm:p-8 shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                            <div class="flex items-center mb-4">
                                <div class="w-12 h-12 bg-primary-500 rounded-full flex items-center justify-center mr-4 flex-shrink-0">
                                    <span class="text-white font-bold text-xl">1</span>
                                </div>
                                <h3 class="text-xl font-bold text-neutral-800"><?php echo t('story_step1_title', 'home'); ?></h3>
                            </div>
                            <p class="text-neutral-700 leading-relaxed">
                                <?php echo t('story_step1_desc', 'home'); ?>
                            </p>
                        </div>
                    </div>
                    
                    <!-- Punto central (desktop) -->
                    <div class="hidden lg:block absolute left-1/2 transform -translate-x-1/2 w-8 h-8 bg-primary-500 rounded-full border-4 border-white shadow-lg"></div>
                    
                    <div class="lg:w-5/12 lg:pl-8">
                        <!-- Espacio vacío para balance -->
                    </div>
                </div>
                
                <!-- Paso 2 -->
                <div class="relative lg:flex lg:items-center lg:justify-between">
                    <div class="lg:w-5/12 lg:pr-8">
                        <!-- Espacio vacío para balance -->
                    </div>
                    
                    <!-- Punto central (desktop) -->
                    <div class="hidden lg:block absolute left-1/2 transform -translate-x-1/2 w-8 h-8 bg-accent-500 rounded-full border-4 border-white shadow-lg"></div>
                    
                    <div class="lg:w-5/12 lg:pl-8 mb-8 lg:mb-0">
                        <div class="bg-gradient-to-r from-accent-50 to-accent-100 rounded-2xl p-6 sm:p-8 shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                            <div class="flex items-center mb-4">
                                <div class="w-12 h-12 bg-accent-500 rounded-full flex items-center justify-center mr-4 flex-shrink-0">
                                    <span class="text-white font-bold text-xl">2</span>
                                </div>
                                <h3 class="text-xl font-bold text-neutral-800"><?php echo t('story_step2_title', 'home'); ?></h3>
                            </div>
                            <p class="text-neutral-700 leading-relaxed">
                                <?php echo t('story_step2_desc', 'home'); ?>
                            </p>
                        </div>
                    </div>
                </div>
                
                <!-- Paso 3 -->
                <div class="relative lg:flex lg:items-center lg:justify-between">
                    <div class="lg:w-5/12 lg:pr-8 mb-8 lg:mb-0">
                        <div class="bg-gradient-to-r from-primary-50 to-primary-100 rounded-2xl p-6 sm:p-8 shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                            <div class="flex items-center mb-4">
                                <div class="w-12 h-12 bg-primary-500 rounded-full flex items-center justify-center mr-4 flex-shrink-0">
                                    <span class="text-white font-bold text-xl">3</span>
                                </div>
                                <h3 class="text-xl font-bold text-neutral-800"><?php echo t('story_step3_title', 'home'); ?></h3>
                            </div>
                            <p class="text-neutral-700 leading-relaxed">
                                <?php echo t('story_step3_desc', 'home'); ?>
                            </p>
                        </div>
                    </div>
                    
                    <!-- Punto central (desktop) -->
                    <div class="hidden lg:block absolute left-1/2 transform -translate-x-1/2 w-8 h-8 bg-accent-500 rounded-full border-4 border-white shadow-lg"></div>
                    
                    <div class="lg:w-5/12 lg:pl-8">
                        <!-- Espacio vacío para balance -->
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Estadísticas -->
        <div class="mt-16 sm:mt-20">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="text-center">
                    <div class="text-4xl sm:text-5xl font-bold text-primary-500 mb-2">4,000+</div>
                    <div class="text-lg text-neutral-600"><?php echo t('stats_clients', 'home'); ?></div>
                </div>
                <div class="text-center">
                    <div class="text-4xl sm:text-5xl font-bold text-accent-500 mb-2">30%</div>
                    <div class="text-lg text-neutral-600"><?php echo t('stats_savings', 'home'); ?></div>
                </div>
                <div class="text-center">
                    <div class="text-4xl sm:text-5xl font-bold text-primary-500 mb-2">100%</div>
                    <div class="text-lg text-neutral-600"><?php echo t('stats_commitment', 'home'); ?></div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Colaboración con Inmobiliarias -->
<?php
$partnershipContent = '<div class="text-center">';
$partnershipContent .= renderButton(t('partnership_button', 'home'), '/contacto');
$partnershipContent .= '</div>';

renderContentSection(
    t('partnership_title', 'home'),
    t('partnership_subtitle', 'home'),
    $partnershipContent,
    'bg-neutral-100'
);
?>


<!-- Espaciado antes del footer -->
<div class="py-8 sm:py-12 bg-neutral-100"></div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const carousel = document.getElementById('testimonialsCarousel');
    const prevBtn = document.getElementById('prevBtn');
    const nextBtn = document.getElementById('nextBtn');
    
    if (!carousel || !prevBtn || !nextBtn) {
        console.error('Elementos del carrusel no encontrados');
        return;
    }
    
    let currentIndex = 0;
    const totalSlides = <?php echo count($testimonials); ?>;
    const slideWidth = 100 / 3; // 3 slides visibles en desktop
    
    function updateCarousel() {
        const translateX = -currentIndex * slideWidth;
        carousel.style.transform = `translateX(${translateX}%)`;
        
        // Actualizar estado de botones
        prevBtn.style.opacity = currentIndex === 0 ? '0.5' : '1';
        prevBtn.style.pointerEvents = currentIndex === 0 ? 'none' : 'auto';
        
        nextBtn.style.opacity = currentIndex >= totalSlides - 3 ? '0.5' : '1';
        nextBtn.style.pointerEvents = currentIndex >= totalSlides - 3 ? 'none' : 'auto';
    }
    
    prevBtn.addEventListener('click', function() {
        if (currentIndex > 0) {
            currentIndex--;
            updateCarousel();
        }
    });
    
    nextBtn.addEventListener('click', function() {
        if (currentIndex < totalSlides - 3) {
            currentIndex++;
            updateCarousel();
        }
    });
    
    // Inicializar carrusel
    updateCarousel();
    
    // Auto-play (opcional)
    setInterval(function() {
        if (currentIndex < totalSlides - 3) {
            currentIndex++;
        } else {
            currentIndex = 0;
        }
        updateCarousel();
    }, 5000);
    
    // Responsive handling
    function handleResize() {
        const isMobile = window.innerWidth < 768;
        const slideWidth = isMobile ? 100 : 100 / 3;
        
        const translateX = -currentIndex * slideWidth;
        carousel.style.transform = `translateX(${translateX}%)`;
    }
    
    window.addEventListener('resize', handleResize);
    handleResize();
});
</script>
