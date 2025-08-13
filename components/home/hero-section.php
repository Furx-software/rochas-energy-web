<?php
/**
 * Componente Hero Section con animación de electricidad
 * @param string $title - Título principal
 * @param string $subtitle - Subtítulo
 * @param string $buttonText - Texto del botón
 * @param string $buttonHref - Enlace del botón
 */
function renderHeroSection($title, $subtitle, $buttonText, $buttonHref = '/contacto') {
?>
    <section class="electric-background min-h-screen flex items-center justify-center relative px-4">
        <!-- Elementos de animación de electricidad -->
        <div class="electric-particle"></div>
        <div class="electric-particle"></div>
        <div class="electric-particle"></div>
        <div class="electric-particle"></div>
        <div class="electric-particle"></div>
        
        <!-- Chispas eléctricas -->
        <div class="electric-spark"></div>
        <div class="electric-spark"></div>
        <div class="electric-spark"></div>
        
        <!-- Ondas eléctricas -->
        <div class="electric-wave"></div>
        <div class="electric-wave"></div>
        
        <!-- Contenido principal -->
        <div class="hero-content max-w-4xl mx-auto px-4 sm:px-6 py-12 sm:py-16 text-center">
            <h1 class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-bold text-white mb-4 sm:mb-6 leading-tight drop-shadow-lg">
                <?php echo $title; ?>
            </h1>
            
            <p class="text-lg sm:text-xl md:text-2xl text-gray-200 mb-6 sm:mb-8 max-w-3xl mx-auto leading-relaxed drop-shadow-md">
                <?php echo $subtitle; ?>
            </p>
            
            <a href="<?php echo $buttonHref; ?>" class="group relative inline-flex items-center justify-center px-4 sm:px-8 py-3 sm:py-4 text-base sm:text-lg font-semibold text-white bg-gradient-to-r from-primary-500 to-primary-600 rounded-xl shadow-2xl hover:shadow-3xl transform hover:scale-105 transition-all duration-300 overflow-hidden min-w-[200px] sm:min-w-0">
                <span class="relative z-10 flex items-center justify-center text-center">
                    <span class="whitespace-nowrap"><?php echo $buttonText; ?></span>
                    <svg class="ml-2 w-4 h-4 sm:w-5 sm:h-5 group-hover:translate-x-1 transition-transform duration-300 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                    </svg>
                </span>
                <div class="absolute inset-0 bg-gradient-to-r from-primary-600 to-primary-700 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
            </a>
        </div>
    </section>
<?php
}
?>
