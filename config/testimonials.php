<?php
/**
 * Configuración de reseñas de clientes
 * Datos centralizados para el carrusel de testimonios
 */

$testimonials = [
    [
        'name' => 'guillem_title',
        'date' => '2025-03-19',
        'review' => 'guillem_review',
        'initial' => 'g',
        'color' => 'bg-purple-500',
        'stars' => 5,
        'showReadMore' => true
    ],
    [
        'name' => 'lidia_title',
        'date' => '2025-03-14',
        'review' => 'lidia_review',
        'initial' => 'L',
        'color' => 'bg-red-700',
        'stars' => 5,
        'showReadMore' => false
    ],
    [
        'name' => 'agusti_title',
        'date' => '2025-03-13',
        'review' => 'agusti_review',
        'initial' => 'A',
        'color' => 'bg-green-600',
        'stars' => 4,
        'showReadMore' => false
    ],
    [
        'name' => 'alejandro_title',
        'date' => '2024-12-28',
        'review' => 'alejandro_review',
        'initial' => 'A',
        'color' => 'bg-amber-700',
        'stars' => 5,
        'showReadMore' => true
    ],
    [
        'name' => 'isidre_title',
        'date' => '2024-12-27',
        'review' => 'isidre_review',
        'initial' => 'I',
        'color' => 'bg-pink-500',
        'stars' => 5,
        'showReadMore' => false
    ],
    [
        'name' => 'belkis_title',
        'date' => '2024-12-18',
        'review' => 'belkis_review',
        'initial' => 'B',
        'color' => 'bg-amber-700',
        'stars' => 5,
        'showReadMore' => false
    ]
];

/**
 * Obtener reseñas con traducciones
 */
function getTestimonials() {
    global $testimonials;
    $translatedTestimonials = [];
    
    foreach ($testimonials as $testimonial) {
        $translatedTestimonials[] = [
            'name' => t($testimonial['name'], 'testimonials'),
            'date' => $testimonial['date'],
            'review' => t($testimonial['review'], 'testimonials'),
            'initial' => $testimonial['initial'],
            'color' => $testimonial['color'],
            'stars' => $testimonial['stars'],
            'showReadMore' => $testimonial['showReadMore']
        ];
    }
    
    return $translatedTestimonials;
}
?>
