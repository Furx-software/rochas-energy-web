<?php
/**
 * Componente de skeleton loader para mejorar la UX
 * @param string $type - Tipo de skeleton (hero, testimonial, button, etc.)
 * @return string - HTML del skeleton
 */
function renderSkeletonLoader($type = 'general') {
    switch ($type) {
        case 'hero':
            return '
            <div class="animate-pulse">
                <div class="h-16 bg-gray-200 rounded-lg mb-4"></div>
                <div class="h-8 bg-gray-200 rounded mb-2"></div>
                <div class="h-6 bg-gray-200 rounded mb-4"></div>
                <div class="h-12 bg-gray-200 rounded-lg w-48 mx-auto"></div>
            </div>';
            
        case 'testimonial':
            return '
            <div class="animate-pulse">
                <div class="bg-white rounded-xl shadow-lg p-6 h-full">
                    <div class="flex items-start justify-between mb-4">
                        <div class="flex items-center">
                            <div class="w-12 h-12 bg-gray-200 rounded-full mr-3"></div>
                            <div>
                                <div class="h-4 bg-gray-200 rounded w-24 mb-2"></div>
                                <div class="h-3 bg-gray-200 rounded w-16"></div>
                            </div>
                        </div>
                        <div class="w-6 h-6 bg-gray-200 rounded"></div>
                    </div>
                    <div class="flex items-center mb-3">
                        <div class="flex space-x-1">
                            <div class="w-4 h-4 bg-gray-200 rounded"></div>
                            <div class="w-4 h-4 bg-gray-200 rounded"></div>
                            <div class="w-4 h-4 bg-gray-200 rounded"></div>
                            <div class="w-4 h-4 bg-gray-200 rounded"></div>
                            <div class="w-4 h-4 bg-gray-200 rounded"></div>
                        </div>
                    </div>
                    <div class="space-y-2">
                        <div class="h-4 bg-gray-200 rounded"></div>
                        <div class="h-4 bg-gray-200 rounded w-3/4"></div>
                        <div class="h-4 bg-gray-200 rounded w-1/2"></div>
                    </div>
                </div>
            </div>';
            
        case 'button':
            return '
            <div class="animate-pulse">
                <div class="h-12 bg-gray-200 rounded-xl w-48 mx-auto"></div>
            </div>';
            
        case 'feature':
            return '
            <div class="animate-pulse text-center">
                <div class="w-16 h-16 bg-gray-200 rounded-full mx-auto mb-4"></div>
                <div class="h-6 bg-gray-200 rounded w-32 mx-auto mb-2"></div>
                <div class="h-4 bg-gray-200 rounded w-48 mx-auto"></div>
            </div>';
            
        default:
            return '
            <div class="animate-pulse">
                <div class="h-4 bg-gray-200 rounded mb-2"></div>
                <div class="h-4 bg-gray-200 rounded w-3/4"></div>
            </div>';
    }
}

/**
 * Mostrar skeleton loader mientras se carga el contenido
 * @param string $elementId - ID del elemento a reemplazar
 * @param string $type - Tipo de skeleton
 */
function showSkeletonLoader($elementId, $type = 'general') {
    echo '<div id="' . $elementId . '-skeleton">' . renderSkeletonLoader($type) . '</div>';
    echo '<div id="' . $elementId . '-content" class="hidden">';
}

/**
 * Ocultar skeleton loader y mostrar contenido
 * @param string $elementId - ID del elemento
 */
function hideSkeletonLoader($elementId) {
    echo '</div>';
    echo '<script>
        document.addEventListener("DOMContentLoaded", function() {
            const skeleton = document.getElementById("' . $elementId . '-skeleton");
            const content = document.getElementById("' . $elementId . '-content");
            if (skeleton && content) {
                skeleton.style.display = "none";
                content.classList.remove("hidden");
            }
        });
    </script>';
}
?>
