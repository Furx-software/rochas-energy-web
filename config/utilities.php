<?php
/**
 * Utilidades generales del sitio
 */

/**
 * Obtener el año actual
 * @return string Año actual en formato Y (ej: 2025)
 */
function getCurrentYear() {
    return date('Y');
}

/**
 * Obtener el año actual con formato completo
 * @return string Año actual en formato Y (ej: 2025)
 */
function getCurrentYearFull() {
    return date('Y');
}

/**
 * Obtener el año actual con formato corto
 * @return string Año actual en formato y (ej: 25)
 */
function getCurrentYearShort() {
    return date('y');
}

/**
 * Reemplazar el año en un texto
 * @param string $text Texto que contiene el año a reemplazar
 * @param string $oldYear Año a reemplazar (por defecto 2024)
 * @return string Texto con el año actualizado
 */
function replaceYear($text, $oldYear = '2024') {
    return str_replace($oldYear, getCurrentYear(), $text);
}

/**
 * Obtener copyright dinámico
 * @param string $language Idioma (es/en)
 * @return string Texto de copyright con año actual
 */
function getDynamicCopyright($language = 'es') {
    $copyright = $language === 'es' 
        ? '© ' . getCurrentYear() . ' Rochas Energy. Todos los derechos reservados.'
        : '© ' . getCurrentYear() . ' Rochas Energy. All rights reserved.';
    
    return $copyright;
}

/**
 * Obtener fecha actual formateada
 * @param string $format Formato de fecha (por defecto 'd/m/Y')
 * @return string Fecha formateada
 */
function getCurrentDate($format = 'd/m/Y') {
    return date($format);
}

/**
 * Obtener fecha y hora actual
 * @param string $format Formato de fecha y hora (por defecto 'd/m/Y H:i:s')
 * @return string Fecha y hora formateada
 */
function getCurrentDateTime($format = 'd/m/Y H:i:s') {
    return date($format);
}

/**
 * Verificar si es año bisiesto
 * @return bool True si es año bisiesto
 */
function isLeapYear() {
    return date('L') == 1;
}

/**
 * Obtener el día del año
 * @return int Día del año (1-366)
 */
function getDayOfYear() {
    return date('z') + 1;
}

/**
 * Obtener días restantes del año
 * @return int Días restantes del año
 */
function getDaysRemainingInYear() {
    $dayOfYear = getDayOfYear();
    $totalDays = isLeapYear() ? 366 : 365;
    return $totalDays - $dayOfYear;
}

/**
 * Obtener información del año actual
 * @return array Array con información del año
 */
function getYearInfo() {
    return [
        'year' => getCurrentYear(),
        'year_short' => getCurrentYearShort(),
        'is_leap' => isLeapYear(),
        'day_of_year' => getDayOfYear(),
        'days_remaining' => getDaysRemainingInYear(),
        'total_days' => isLeapYear() ? 366 : 365
    ];
}
?>
