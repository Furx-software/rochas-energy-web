<?php
/**
 * Componente de botón reutilizable
 * @param string $text - Texto del botón
 * @param string $href - Enlace del botón
 * @param string $icon - Icono SVG (opcional)
 * @param string $target - Target del enlace (opcional)
 * @param string $rel - Rel del enlace (opcional)
 * @return string - HTML del botón
 */
function renderButton($text, $href = '#', $icon = null, $target = '', $rel = '') {
    $targetAttr = $target ? "target=\"$target\"" : '';
    $relAttr = $rel ? "rel=\"$rel\"" : '';
    $iconHtml = $icon ? $icon : '';
    
    $html = '<a href="' . $href . '" ' . $targetAttr . ' ' . $relAttr . ' class="group relative inline-flex items-center justify-center px-4 sm:px-8 py-3 sm:py-4 text-base sm:text-lg font-semibold text-white bg-gradient-to-r from-primary-500 to-primary-600 rounded-xl shadow-2xl hover:shadow-3xl transform hover:scale-105 transition-all duration-300 overflow-hidden min-w-[200px] sm:min-w-0">';
    $html .= '<span class="relative z-10 flex items-center justify-center text-center">';
    if ($iconHtml) {
        $html .= $iconHtml;
    }
    $html .= '<span class="whitespace-nowrap">' . $text . '</span>';
    $html .= '<svg class="ml-2 w-4 h-4 sm:w-5 sm:h-5 group-hover:translate-x-1 transition-transform duration-300 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">';
    $html .= '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>';
    $html .= '</svg>';
    $html .= '</span>';
    $html .= '<div class="absolute inset-0 bg-gradient-to-r from-primary-600 to-primary-700 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>';
    $html .= '</a>';
    
    return $html;
}
?>
