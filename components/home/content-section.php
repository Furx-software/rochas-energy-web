<?php
/**
 * Componente de sección de contenido reutilizable
 * @param string $title - Título de la sección
 * @param string $subtitle - Subtítulo de la sección
 * @param string $content - Contenido HTML de la sección
 * @param string $bgClass - Clases CSS para el fondo
 * @param string $titleClass - Clases CSS para el título
 */
function renderContentSection($title, $subtitle, $content, $bgClass = 'bg-white', $titleClass = 'text-2xl sm:text-3xl md:text-4xl font-bold text-neutral-800 mb-4') {
?>
    <section class="py-16 sm:py-20 <?php echo $bgClass; ?>">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12 sm:mb-16">
                <h2 class="<?php echo $titleClass; ?>">
                    <?php echo $title; ?>
                </h2>
                <p class="text-lg sm:text-xl text-neutral-600 max-w-2xl mx-auto">
                    <?php echo $subtitle; ?>
                </p>
            </div>
            
            <?php echo $content; ?>
        </div>
    </section>
<?php
}
?>
