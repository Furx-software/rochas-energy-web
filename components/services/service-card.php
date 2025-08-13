<?php
/**
 * Componente de tarjeta de servicio reutilizable
 * @param string $title - Título del servicio
 * @param string $description - Descripción del servicio
 * @param string $icon - Icono SVG del servicio
 * @param array $features - Lista de características del servicio
 * @param string $bgClass - Clases CSS para el fondo (primary o accent)
 * @param string $iconClass - Clases CSS para el icono
 */
function renderServiceCard($title, $description, $icon, $features = [], $bgClass = 'primary', $iconClass = 'primary') {
    $bgGradient = $bgClass === 'primary' ? 'from-primary-50 to-primary-100' : 'from-accent-50 to-accent-100';
    $iconBg = $iconClass === 'primary' ? 'bg-primary-500' : 'bg-accent-500';
    $checkColor = $iconClass === 'primary' ? 'text-primary-500' : 'text-accent-500';
    
    $html = '<div class="group relative">';
    $html .= '<div class="bg-gradient-to-br ' . $bgGradient . ' rounded-2xl p-8 shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2">';
    $html .= '<div class="w-16 h-16 ' . $iconBg . ' rounded-xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300">';
    $html .= $icon;
    $html .= '</div>';
    $html .= '<h3 class="text-xl font-bold text-neutral-800 mb-4">' . $title . '</h3>';
    $html .= '<p class="text-neutral-700 leading-relaxed mb-6">' . $description . '</p>';
    
    if (!empty($features)) {
        $html .= '<ul class="space-y-3 text-sm text-neutral-600">';
        foreach ($features as $feature) {
            $html .= '<li class="flex items-center">';
            $html .= '<svg class="w-4 h-4 ' . $checkColor . ' mr-3 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">';
            $html .= '<path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>';
            $html .= '</svg>';
            $html .= $feature;
            $html .= '</li>';
        }
        $html .= '</ul>';
    }
    
    $html .= '</div>';
    $html .= '</div>';
    
    return $html;
}
?>
