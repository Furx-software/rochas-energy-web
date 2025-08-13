<?php
// Incluir componentes optimizados
require_once '../components/home/button.php';
require_once '../config/performance.php';

// Configurar metadatos para SEO
$page_title = t('terms_title', 'meta');
$page_description = t('terms_description', 'meta');
$page_keywords = 'términos condiciones, uso sitio web, servicios energéticos, contratación';
$page_author = t('author', 'meta');
$page_canonical = 'https://rochasenergy.com/terminos-condiciones';

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
        <?php for ($i = 0; $i < 8; $i++): ?>
        <div class="energy-particle absolute w-1 h-1 bg-pink-400 rounded-full opacity-60 animate-pulse" 
             style="top: <?php echo rand(5, 95); ?>%; left: <?php echo rand(5, 95); ?>%; animation-delay: <?php echo $i * 0.4; ?>s;"></div>
        <?php endfor; ?>
        
        <!-- Efectos de energía optimizados -->
        <div class="energy-particle absolute bottom-20 right-20 w-12 h-12 bg-gradient-to-r from-pink-400 to-pink-600 rounded-full opacity-20 blur-sm animate-pulse"></div>
    </div>
    
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <!-- Badge optimizado -->
        <div class="inline-flex items-center px-4 py-2 bg-white/60 backdrop-blur-sm rounded-full text-neutral-700 text-sm font-medium mb-8 shadow-sm">
            <svg class="w-4 h-4 mr-2 text-primary-500" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
                <path fill-rule="evenodd" d="M4 4a2 2 0 00-2 2v4a2 2 0 002 2V6h10a2 2 0 00-2-2H4zm2 6a2 2 0 012-2h8a2 2 0 012 2v4a2 2 0 01-2 2H8a2 2 0 01-2-2v-4zm6 4a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"></path>
            </svg>
            <?php echo t('terms_badge', 'legal'); ?>
        </div>
        
        <h1 id="hero-title" class="text-4xl sm:text-5xl md:text-6xl font-bold text-neutral-800 mb-8 leading-tight">
            <?php echo t('terms_title', 'legal'); ?>
        </h1>
        
        <p class="text-xl sm:text-2xl text-neutral-700 max-w-4xl mx-auto leading-relaxed">
            <?php echo t('terms_subtitle', 'legal'); ?>
        </p>
    </div>
</section>

<!-- Contenido Principal -->
<section class="py-20 sm:py-32 bg-white">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="prose prose-lg max-w-none">
            
            <!-- Información General -->
            <div class="mb-16">
                <h2 class="text-3xl font-bold text-neutral-800 mb-6">
                    <?php echo t('terms_general_title', 'legal'); ?>
                </h2>
                <p class="text-lg text-neutral-600 leading-relaxed mb-6">
                    <?php echo t('terms_general_desc', 'legal'); ?>
                </p>
                <p class="text-lg text-neutral-600 leading-relaxed">
                    <?php echo t('terms_general_desc2', 'legal'); ?>
                </p>
            </div>

            <!-- Información de la Empresa -->
            <div class="mb-16">
                <h2 class="text-3xl font-bold text-neutral-800 mb-6">
                    <?php echo t('terms_company_title', 'legal'); ?>
                </h2>
                <div class="bg-neutral-50 rounded-2xl p-8 mb-6">
                    <h3 class="text-xl font-semibold text-neutral-800 mb-4">
                        <?php echo t('terms_company_name', 'legal'); ?>
                    </h3>
                    <div class="space-y-3 text-neutral-600">
                        <p><strong><?php echo t('terms_address', 'legal'); ?>:</strong> <?php echo t('terms_address_value', 'legal'); ?></p>
                        <p><strong><?php echo t('terms_email', 'legal'); ?>:</strong> <a href="mailto:<?php echo t('terms_email_value', 'legal'); ?>" class="text-primary-600 hover:text-primary-700"><?php echo t('terms_email_value', 'legal'); ?></a></p>
                        <p><strong><?php echo t('terms_phone', 'legal'); ?>:</strong> <a href="tel:<?php echo t('terms_phone_value', 'legal'); ?>" class="text-primary-600 hover:text-primary-700"><?php echo t('terms_phone_value', 'legal'); ?></a></p>
                        <p><strong><?php echo t('terms_cif', 'legal'); ?>:</strong> <?php echo t('terms_cif_value', 'legal'); ?></p>
                    </div>
                </div>
            </div>

            <!-- Servicios -->
            <div class="mb-16">
                <h2 class="text-3xl font-bold text-neutral-800 mb-6">
                    <?php echo t('terms_services_title', 'legal'); ?>
                </h2>
                <p class="text-lg text-neutral-600 leading-relaxed mb-6">
                    <?php echo t('terms_services_desc', 'legal'); ?>
                </p>
                
                <div class="space-y-4">
                    <div class="flex items-start gap-4 p-4 bg-primary-50 rounded-xl">
                        <div class="w-8 h-8 bg-primary-100 rounded-lg flex items-center justify-center flex-shrink-0 mt-1">
                            <span class="text-primary-600 font-bold text-sm">1</span>
                        </div>
                        <div>
                            <h4 class="font-semibold text-primary-800 mb-2"><?php echo t('terms_service_consulting', 'legal'); ?></h4>
                            <p class="text-neutral-600"><?php echo t('terms_service_consulting_desc', 'legal'); ?></p>
                        </div>
                    </div>
                    
                    <div class="flex items-start gap-4 p-4 bg-accent-50 rounded-xl">
                        <div class="w-8 h-8 bg-accent-100 rounded-lg flex items-center justify-center flex-shrink-0 mt-1">
                            <span class="text-accent-600 font-bold text-sm">2</span>
                        </div>
                        <div>
                            <h4 class="font-semibold text-accent-800 mb-2"><?php echo t('terms_service_management', 'legal'); ?></h4>
                            <p class="text-neutral-600"><?php echo t('terms_service_management_desc', 'legal'); ?></p>
                        </div>
                    </div>
                    
                    <div class="flex items-start gap-4 p-4 bg-neutral-50 rounded-xl">
                        <div class="w-8 h-8 bg-neutral-100 rounded-lg flex items-center justify-center flex-shrink-0 mt-1">
                            <span class="text-neutral-600 font-bold text-sm">3</span>
                        </div>
                        <div>
                            <h4 class="font-semibold text-neutral-800 mb-2"><?php echo t('terms_service_installations', 'legal'); ?></h4>
                            <p class="text-neutral-600"><?php echo t('terms_service_installations_desc', 'legal'); ?></p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Condiciones de Uso -->
            <div class="mb-16">
                <h2 class="text-3xl font-bold text-neutral-800 mb-6">
                    <?php echo t('terms_usage_title', 'legal'); ?>
                </h2>
                <p class="text-lg text-neutral-600 leading-relaxed mb-6">
                    <?php echo t('terms_usage_desc', 'legal'); ?>
                </p>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="bg-green-50 rounded-xl p-6">
                        <h3 class="text-lg font-semibold text-green-800 mb-3">
                            <?php echo t('terms_usage_allowed', 'legal'); ?>
                        </h3>
                        <ul class="text-neutral-600 space-y-2">
                            <li>• <?php echo t('terms_usage_browse', 'legal'); ?></li>
                            <li>• <?php echo t('terms_usage_contact', 'legal'); ?></li>
                            <li>• <?php echo t('terms_usage_services', 'legal'); ?></li>
                            <li>• <?php echo t('terms_usage_legal', 'legal'); ?></li>
                        </ul>
                    </div>
                    
                    <div class="bg-red-50 rounded-xl p-6">
                        <h3 class="text-lg font-semibold text-red-800 mb-3">
                            <?php echo t('terms_usage_prohibited', 'legal'); ?>
                        </h3>
                        <ul class="text-neutral-600 space-y-2">
                            <li>• <?php echo t('terms_usage_illegal', 'legal'); ?></li>
                            <li>• <?php echo t('terms_usage_harm', 'legal'); ?></li>
                            <li>• <?php echo t('terms_usage_spam', 'legal'); ?></li>
                            <li>• <?php echo t('terms_usage_unauthorized', 'legal'); ?></li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Condiciones de Contratación -->
            <div class="mb-16">
                <h2 class="text-3xl font-bold text-neutral-800 mb-6">
                    <?php echo t('terms_contract_title', 'legal'); ?>
                </h2>
                <p class="text-lg text-neutral-600 leading-relaxed mb-6">
                    <?php echo t('terms_contract_desc', 'legal'); ?>
                </p>
                
                <div class="space-y-6">
                    <div class="border border-neutral-200 rounded-xl p-6">
                        <h3 class="text-xl font-semibold text-neutral-800 mb-4">
                            <?php echo t('terms_contract_acceptance', 'legal'); ?>
                        </h3>
                        <p class="text-neutral-600 mb-4"><?php echo t('terms_contract_acceptance_desc', 'legal'); ?></p>
                        <ul class="text-neutral-600 space-y-2">
                            <li>• <?php echo t('terms_contract_acceptance_1', 'legal'); ?></li>
                            <li>• <?php echo t('terms_contract_acceptance_2', 'legal'); ?></li>
                            <li>• <?php echo t('terms_contract_acceptance_3', 'legal'); ?></li>
                        </ul>
                    </div>
                    
                    <div class="border border-neutral-200 rounded-xl p-6">
                        <h3 class="text-xl font-semibold text-neutral-800 mb-4">
                            <?php echo t('terms_contract_obligations', 'legal'); ?>
                        </h3>
                        <p class="text-neutral-600 mb-4"><?php echo t('terms_contract_obligations_desc', 'legal'); ?></p>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <h4 class="font-semibold text-neutral-800 mb-2"><?php echo t('terms_contract_client', 'legal'); ?></h4>
                                <ul class="text-neutral-600 space-y-1 text-sm">
                                    <li>• <?php echo t('terms_contract_client_1', 'legal'); ?></li>
                                    <li>• <?php echo t('terms_contract_client_2', 'legal'); ?></li>
                                    <li>• <?php echo t('terms_contract_client_3', 'legal'); ?></li>
                                </ul>
                            </div>
                            <div>
                                <h4 class="font-semibold text-neutral-800 mb-2"><?php echo t('terms_contract_company', 'legal'); ?></h4>
                                <ul class="text-neutral-600 space-y-1 text-sm">
                                    <li>• <?php echo t('terms_contract_company_1', 'legal'); ?></li>
                                    <li>• <?php echo t('terms_contract_company_2', 'legal'); ?></li>
                                    <li>• <?php echo t('terms_contract_company_3', 'legal'); ?></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Precios y Pagos -->
            <div class="mb-16">
                <h2 class="text-3xl font-bold text-neutral-800 mb-6">
                    <?php echo t('terms_pricing_title', 'legal'); ?>
                </h2>
                <p class="text-lg text-neutral-600 leading-relaxed mb-6">
                    <?php echo t('terms_pricing_desc', 'legal'); ?>
                </p>
                
                <div class="bg-yellow-50 border border-yellow-200 rounded-xl p-6">
                    <h3 class="text-lg font-semibold text-yellow-800 mb-3">
                        <?php echo t('terms_pricing_important', 'legal'); ?>
                    </h3>
                    <ul class="text-neutral-700 space-y-2">
                        <li>• <strong><?php echo t('terms_pricing_free', 'legal'); ?></strong> - <?php echo t('terms_pricing_free_desc', 'legal'); ?></li>
                        <li>• <strong><?php echo t('terms_pricing_commission', 'legal'); ?></strong> - <?php echo t('terms_pricing_commission_desc', 'legal'); ?></li>
                        <li>• <strong><?php echo t('terms_pricing_transparency', 'legal'); ?></strong> - <?php echo t('terms_pricing_transparency_desc', 'legal'); ?></li>
                    </ul>
                </div>
            </div>

            <!-- Limitación de Responsabilidad -->
            <div class="mb-16">
                <h2 class="text-3xl font-bold text-neutral-800 mb-6">
                    <?php echo t('terms_liability_title', 'legal'); ?>
                </h2>
                <p class="text-lg text-neutral-600 leading-relaxed mb-6">
                    <?php echo t('terms_liability_desc', 'legal'); ?>
                </p>
                
                <div class="space-y-4">
                    <div class="bg-red-50 border border-red-200 rounded-xl p-6">
                        <h3 class="text-lg font-semibold text-red-800 mb-3">
                            <?php echo t('terms_liability_exclusions', 'legal'); ?>
                        </h3>
                        <ul class="text-neutral-700 space-y-2">
                            <li>• <?php echo t('terms_liability_exclusion_1', 'legal'); ?></li>
                            <li>• <?php echo t('terms_liability_exclusion_2', 'legal'); ?></li>
                            <li>• <?php echo t('terms_liability_exclusion_3', 'legal'); ?></li>
                            <li>• <?php echo t('terms_liability_exclusion_4', 'legal'); ?></li>
                        </ul>
                    </div>
                    
                    <div class="bg-blue-50 border border-blue-200 rounded-xl p-6">
                        <h3 class="text-lg font-semibold text-blue-800 mb-3">
                            <?php echo t('terms_liability_limit', 'legal'); ?>
                        </h3>
                        <p class="text-blue-700">
                            <?php echo t('terms_liability_limit_desc', 'legal'); ?>
                        </p>
                    </div>
                </div>
            </div>

            <!-- Propiedad Intelectual -->
            <div class="mb-16">
                <h2 class="text-3xl font-bold text-neutral-800 mb-6">
                    <?php echo t('terms_intellectual_title', 'legal'); ?>
                </h2>
                <p class="text-lg text-neutral-600 leading-relaxed mb-6">
                    <?php echo t('terms_intellectual_desc', 'legal'); ?>
                </p>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="bg-neutral-50 rounded-xl p-6">
                        <h3 class="text-lg font-semibold text-neutral-800 mb-3">
                            <?php echo t('terms_intellectual_protected', 'legal'); ?>
                        </h3>
                        <ul class="text-neutral-600 space-y-2">
                            <li>• <?php echo t('terms_intellectual_content', 'legal'); ?></li>
                            <li>• <?php echo t('terms_intellectual_design', 'legal'); ?></li>
                            <li>• <?php echo t('terms_intellectual_logo', 'legal'); ?></li>
                            <li>• <?php echo t('terms_intellectual_software', 'legal'); ?></li>
                        </ul>
                    </div>
                    
                    <div class="bg-neutral-50 rounded-xl p-6">
                        <h3 class="text-lg font-semibold text-neutral-800 mb-3">
                            <?php echo t('terms_intellectual_usage', 'legal'); ?>
                        </h3>
                        <ul class="text-neutral-600 space-y-2">
                            <li>• <?php echo t('terms_intellectual_personal', 'legal'); ?></li>
                            <li>• <?php echo t('terms_intellectual_noncommercial', 'legal'); ?></li>
                            <li>• <?php echo t('terms_intellectual_attribution', 'legal'); ?></li>
                            <li>• <?php echo t('terms_intellectual_modification', 'legal'); ?></li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Privacidad y Protección de Datos -->
            <div class="mb-16">
                <h2 class="text-3xl font-bold text-neutral-800 mb-6">
                    <?php echo t('terms_privacy_title', 'legal'); ?>
                </h2>
                <p class="text-lg text-neutral-600 leading-relaxed mb-6">
                    <?php echo t('terms_privacy_desc', 'legal'); ?>
                </p>
                
                <div class="bg-green-50 border border-green-200 rounded-xl p-6">
                    <div class="flex items-start gap-4">
                        <svg class="w-6 h-6 text-green-600 mt-1" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                        </svg>
                        <div>
                            <h3 class="text-lg font-semibold text-green-800 mb-2">
                                <?php echo t('terms_privacy_compliance', 'legal'); ?>
                            </h3>
                            <p class="text-green-700 mb-4">
                                <?php echo t('terms_privacy_compliance_desc', 'legal'); ?>
                            </p>
                            <a href="/politica-privacidad" class="inline-flex items-center text-green-600 hover:text-green-700 font-medium">
                                <?php echo t('terms_privacy_policy', 'legal'); ?>
                                <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modificaciones -->
            <div class="mb-16">
                <h2 class="text-3xl font-bold text-neutral-800 mb-6">
                    <?php echo t('terms_modifications_title', 'legal'); ?>
                </h2>
                <p class="text-lg text-neutral-600 leading-relaxed mb-6">
                    <?php echo t('terms_modifications_desc', 'legal'); ?>
                </p>
                
                <div class="bg-blue-50 border border-blue-200 rounded-xl p-6">
                    <div class="flex items-start gap-4">
                        <svg class="w-6 h-6 text-blue-600 mt-1" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
                        </svg>
                        <div>
                            <h3 class="text-lg font-semibold text-blue-800 mb-2">
                                <?php echo t('terms_modifications_notice', 'legal'); ?>
                            </h3>
                            <p class="text-blue-700">
                                <?php echo t('terms_modifications_notice_desc', 'legal'); ?>
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Ley Aplicable y Jurisdicción -->
            <div class="mb-16">
                <h2 class="text-3xl font-bold text-neutral-800 mb-6">
                    <?php echo t('terms_law_title', 'legal'); ?>
                </h2>
                <p class="text-lg text-neutral-600 leading-relaxed mb-6">
                    <?php echo t('terms_law_desc', 'legal'); ?>
                </p>
                
                <div class="bg-neutral-50 rounded-xl p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <h3 class="text-lg font-semibold text-neutral-800 mb-3">
                                <?php echo t('terms_law_applicable', 'legal'); ?>
                            </h3>
                            <p class="text-neutral-600"><?php echo t('terms_law_applicable_desc', 'legal'); ?></p>
                        </div>
                        
                        <div>
                            <h3 class="text-lg font-semibold text-neutral-800 mb-3">
                                <?php echo t('terms_law_jurisdiction', 'legal'); ?>
                            </h3>
                            <p class="text-neutral-600"><?php echo t('terms_law_jurisdiction_desc', 'legal'); ?></p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Contacto -->
            <div class="mb-16">
                <h2 class="text-3xl font-bold text-neutral-800 mb-6">
                    <?php echo t('terms_contact_title', 'legal'); ?>
                </h2>
                <p class="text-lg text-neutral-600 leading-relaxed mb-6">
                    <?php echo t('terms_contact_desc', 'legal'); ?>
                </p>
                
                <div class="bg-primary-50 rounded-2xl p-8">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <h3 class="text-lg font-semibold text-primary-800 mb-3">
                                <?php echo t('terms_contact_email', 'legal'); ?>
                            </h3>
                            <a href="mailto:<?php echo t('terms_contact_email_value', 'legal'); ?>" class="text-primary-600 hover:text-primary-700 font-medium">
                                <?php echo t('terms_contact_email_value', 'legal'); ?>
                            </a>
                        </div>
                        
                        <div>
                            <h3 class="text-lg font-semibold text-primary-800 mb-3">
                                <?php echo t('terms_contact_postal', 'legal'); ?>
                            </h3>
                            <p class="text-neutral-700">
                                <?php echo t('terms_contact_postal_value', 'legal'); ?>
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Fecha de Última Actualización -->
            <div class="text-center py-8 border-t border-neutral-200">
                <p class="text-neutral-500">
                    <?php echo t('terms_last_updated', 'legal'); ?>: 
                    <span class="font-medium"><?php echo t('terms_last_updated_date', 'legal'); ?></span>
                </p>
            </div>

        </div>
    </div>
</section>

<!-- CTA Final -->
<section class="py-20 sm:py-32 bg-gradient-to-br from-neutral-900 via-neutral-800 to-primary-900 relative overflow-hidden">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h2 class="text-3xl sm:text-4xl md:text-5xl font-bold text-white mb-8">
            <?php echo t('terms_cta_title', 'legal'); ?>
        </h2>
        <p class="text-xl text-white/90 max-w-3xl mx-auto leading-relaxed mb-12">
            <?php echo t('terms_cta_desc', 'legal'); ?>
        </p>
        
        <div class="flex flex-col sm:flex-row gap-6 justify-center items-center">
            <a href="/contacto" class="inline-flex items-center justify-center px-8 py-4 bg-white text-primary-600 font-semibold rounded-xl hover:bg-neutral-100 transition-all duration-300 transform hover:scale-105">
                <?php echo t('terms_cta_contact', 'legal'); ?>
            </a>
            
            <a href="/politica-privacidad" class="inline-flex items-center justify-center px-8 py-4 border-2 border-white text-white font-semibold rounded-xl hover:bg-white hover:text-primary-600 transition-all duration-300">
                <?php echo t('terms_cta_privacy', 'legal'); ?>
            </a>
        </div>
    </div>
</section>
