<?php
// Incluir componentes optimizados
require_once 'components/home/button.php';
require_once 'config/performance.php';

// Configurar metadatos para SEO
$page_title = t('privacy_title', 'meta');
$page_description = t('privacy_description', 'meta');
$page_keywords = 'política privacidad, protección datos, RGPD, cookies, información personal';
$page_author = t('author', 'meta');
$page_canonical = 'https://rochasenergy.com/politica-privacidad';

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
                <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd"></path>
            </svg>
            <?php echo t('privacy_badge', 'legal'); ?>
        </div>
        
        <h1 id="hero-title" class="text-4xl sm:text-5xl md:text-6xl font-bold text-neutral-800 mb-8 leading-tight">
            <?php echo t('privacy_title', 'legal'); ?>
        </h1>
        
        <p class="text-xl sm:text-2xl text-neutral-700 max-w-4xl mx-auto leading-relaxed">
            <?php echo t('privacy_subtitle', 'legal'); ?>
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
                    <?php echo t('privacy_general_title', 'legal'); ?>
                </h2>
                <p class="text-lg text-neutral-600 leading-relaxed mb-6">
                    <?php echo t('privacy_general_desc', 'legal'); ?>
                </p>
                <p class="text-lg text-neutral-600 leading-relaxed">
                    <?php echo t('privacy_general_desc2', 'legal'); ?>
                </p>
            </div>

            <!-- Responsable del Tratamiento -->
            <div class="mb-16">
                <h2 class="text-3xl font-bold text-neutral-800 mb-6">
                    <?php echo t('privacy_controller_title', 'legal'); ?>
                </h2>
                <div class="bg-neutral-50 rounded-2xl p-8 mb-6">
                    <h3 class="text-xl font-semibold text-neutral-800 mb-4">
                        <?php echo t('privacy_company_name', 'legal'); ?>
                    </h3>
                    <div class="space-y-3 text-neutral-600">
                        <p><strong><?php echo t('privacy_address', 'legal'); ?>:</strong> <?php echo t('privacy_address_value', 'legal'); ?></p>
                        <p><strong><?php echo t('privacy_email', 'legal'); ?>:</strong> <a href="mailto:<?php echo t('privacy_email_value', 'legal'); ?>" class="text-primary-600 hover:text-primary-700"><?php echo t('privacy_email_value', 'legal'); ?></a></p>
                        <p><strong><?php echo t('privacy_phone', 'legal'); ?>:</strong> <a href="tel:<?php echo t('privacy_phone_value', 'legal'); ?>" class="text-primary-600 hover:text-primary-700"><?php echo t('privacy_phone_value', 'legal'); ?></a></p>
                    </div>
                </div>
            </div>

            <!-- Datos que Recopilamos -->
            <div class="mb-16">
                <h2 class="text-3xl font-bold text-neutral-800 mb-6">
                    <?php echo t('privacy_data_title', 'legal'); ?>
                </h2>
                <p class="text-lg text-neutral-600 leading-relaxed mb-6">
                    <?php echo t('privacy_data_desc', 'legal'); ?>
                </p>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="bg-primary-50 rounded-xl p-6">
                        <h3 class="text-lg font-semibold text-primary-800 mb-3">
                            <?php echo t('privacy_data_personal', 'legal'); ?>
                        </h3>
                        <ul class="text-neutral-600 space-y-2">
                            <li>• <?php echo t('privacy_data_name', 'legal'); ?></li>
                            <li>• <?php echo t('privacy_data_email', 'legal'); ?></li>
                            <li>• <?php echo t('privacy_data_phone', 'legal'); ?></li>
                            <li>• <?php echo t('privacy_data_address', 'legal'); ?></li>
                        </ul>
                    </div>
                    
                    <div class="bg-accent-50 rounded-xl p-6">
                        <h3 class="text-lg font-semibold text-accent-800 mb-3">
                            <?php echo t('privacy_data_technical', 'legal'); ?>
                        </h3>
                        <ul class="text-neutral-600 space-y-2">
                            <li>• <?php echo t('privacy_data_ip', 'legal'); ?></li>
                            <li>• <?php echo t('privacy_data_browser', 'legal'); ?></li>
                            <li>• <?php echo t('privacy_data_device', 'legal'); ?></li>
                            <li>• <?php echo t('privacy_data_cookies', 'legal'); ?></li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Finalidad del Tratamiento -->
            <div class="mb-16">
                <h2 class="text-3xl font-bold text-neutral-800 mb-6">
                    <?php echo t('privacy_purpose_title', 'legal'); ?>
                </h2>
                <p class="text-lg text-neutral-600 leading-relaxed mb-6">
                    <?php echo t('privacy_purpose_desc', 'legal'); ?>
                </p>
                
                <div class="space-y-4">
                    <div class="flex items-start gap-4 p-4 bg-neutral-50 rounded-xl">
                        <div class="w-8 h-8 bg-primary-100 rounded-lg flex items-center justify-center flex-shrink-0 mt-1">
                            <span class="text-primary-600 font-bold text-sm">1</span>
                        </div>
                        <div>
                            <h4 class="font-semibold text-neutral-800 mb-2"><?php echo t('privacy_purpose_service', 'legal'); ?></h4>
                            <p class="text-neutral-600"><?php echo t('privacy_purpose_service_desc', 'legal'); ?></p>
                        </div>
                    </div>
                    
                    <div class="flex items-start gap-4 p-4 bg-neutral-50 rounded-xl">
                        <div class="w-8 h-8 bg-primary-100 rounded-lg flex items-center justify-center flex-shrink-0 mt-1">
                            <span class="text-primary-600 font-bold text-sm">2</span>
                        </div>
                        <div>
                            <h4 class="font-semibold text-neutral-800 mb-2"><?php echo t('privacy_purpose_communication', 'legal'); ?></h4>
                            <p class="text-neutral-600"><?php echo t('privacy_purpose_communication_desc', 'legal'); ?></p>
                        </div>
                    </div>
                    
                    <div class="flex items-start gap-4 p-4 bg-neutral-50 rounded-xl">
                        <div class="w-8 h-8 bg-primary-100 rounded-lg flex items-center justify-center flex-shrink-0 mt-1">
                            <span class="text-primary-600 font-bold text-sm">3</span>
                        </div>
                        <div>
                            <h4 class="font-semibold text-neutral-800 mb-2"><?php echo t('privacy_purpose_analytics', 'legal'); ?></h4>
                            <p class="text-neutral-600"><?php echo t('privacy_purpose_analytics_desc', 'legal'); ?></p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Base Legal -->
            <div class="mb-16">
                <h2 class="text-3xl font-bold text-neutral-800 mb-6">
                    <?php echo t('privacy_legal_title', 'legal'); ?>
                </h2>
                <p class="text-lg text-neutral-600 leading-relaxed mb-6">
                    <?php echo t('privacy_legal_desc', 'legal'); ?>
                </p>
                
                <div class="bg-yellow-50 border border-yellow-200 rounded-xl p-6">
                    <h3 class="text-lg font-semibold text-yellow-800 mb-3">
                        <?php echo t('privacy_legal_bases', 'legal'); ?>
                    </h3>
                    <ul class="text-neutral-700 space-y-2">
                        <li>• <strong><?php echo t('privacy_legal_consent', 'legal'); ?></strong> - <?php echo t('privacy_legal_consent_desc', 'legal'); ?></li>
                        <li>• <strong><?php echo t('privacy_legal_contract', 'legal'); ?></strong> - <?php echo t('privacy_legal_contract_desc', 'legal'); ?></li>
                        <li>• <strong><?php echo t('privacy_legal_legitimate', 'legal'); ?></strong> - <?php echo t('privacy_legal_legitimate_desc', 'legal'); ?></li>
                    </ul>
                </div>
            </div>

            <!-- Conservación de Datos -->
            <div class="mb-16">
                <h2 class="text-3xl font-bold text-neutral-800 mb-6">
                    <?php echo t('privacy_retention_title', 'legal'); ?>
                </h2>
                <p class="text-lg text-neutral-600 leading-relaxed mb-6">
                    <?php echo t('privacy_retention_desc', 'legal'); ?>
                </p>
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="text-center p-6 bg-neutral-50 rounded-xl">
                        <div class="text-3xl font-bold text-primary-600 mb-2">5</div>
                        <div class="text-sm text-neutral-600"><?php echo t('privacy_retention_years', 'legal'); ?></div>
                        <div class="text-lg font-semibold text-neutral-800 mt-2"><?php echo t('privacy_retention_contact', 'legal'); ?></div>
                    </div>
                    
                    <div class="text-center p-6 bg-neutral-50 rounded-xl">
                        <div class="text-3xl font-bold text-primary-600 mb-2">2</div>
                        <div class="text-sm text-neutral-600"><?php echo t('privacy_retention_years', 'legal'); ?></div>
                        <div class="text-lg font-semibold text-neutral-800 mt-2"><?php echo t('privacy_retention_analytics', 'legal'); ?></div>
                    </div>
                    
                    <div class="text-center p-6 bg-neutral-50 rounded-xl">
                        <div class="text-3xl font-bold text-primary-600 mb-2">1</div>
                        <div class="text-sm text-neutral-600"><?php echo t('privacy_retention_year', 'legal'); ?></div>
                        <div class="text-lg font-semibold text-neutral-800 mt-2"><?php echo t('privacy_retention_cookies', 'legal'); ?></div>
                    </div>
                </div>
            </div>

            <!-- Derechos del Usuario -->
            <div class="mb-16">
                <h2 class="text-3xl font-bold text-neutral-800 mb-6">
                    <?php echo t('privacy_rights_title', 'legal'); ?>
                </h2>
                <p class="text-lg text-neutral-600 leading-relaxed mb-6">
                    <?php echo t('privacy_rights_desc', 'legal'); ?>
                </p>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-4">
                        <div class="flex items-center gap-3">
                            <svg class="w-5 h-5 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                            </svg>
                            <span class="text-neutral-700"><?php echo t('privacy_right_access', 'legal'); ?></span>
                        </div>
                        <div class="flex items-center gap-3">
                            <svg class="w-5 h-5 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                            </svg>
                            <span class="text-neutral-700"><?php echo t('privacy_right_rectification', 'legal'); ?></span>
                        </div>
                        <div class="flex items-center gap-3">
                            <svg class="w-5 h-5 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                            </svg>
                            <span class="text-neutral-700"><?php echo t('privacy_right_erasure', 'legal'); ?></span>
                        </div>
                    </div>
                    
                    <div class="space-y-4">
                        <div class="flex items-center gap-3">
                            <svg class="w-5 h-5 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                            </svg>
                            <span class="text-neutral-700"><?php echo t('privacy_right_portability', 'legal'); ?></span>
                        </div>
                        <div class="flex items-center gap-3">
                            <svg class="w-5 h-5 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                            </svg>
                            <span class="text-neutral-700"><?php echo t('privacy_right_opposition', 'legal'); ?></span>
                        </div>
                        <div class="flex items-center gap-3">
                            <svg class="w-5 h-5 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                            </svg>
                            <span class="text-neutral-700"><?php echo t('privacy_right_restriction', 'legal'); ?></span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Contacto -->
            <div class="mb-16">
                <h2 class="text-3xl font-bold text-neutral-800 mb-6">
                    <?php echo t('privacy_contact_title', 'legal'); ?>
                </h2>
                <p class="text-lg text-neutral-600 leading-relaxed mb-6">
                    <?php echo t('privacy_contact_desc', 'legal'); ?>
                </p>
                
                <div class="bg-primary-50 rounded-2xl p-8">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <h3 class="text-lg font-semibold text-primary-800 mb-3">
                                <?php echo t('privacy_contact_email', 'legal'); ?>
                            </h3>
                            <a href="mailto:<?php echo t('privacy_contact_email_value', 'legal'); ?>" class="text-primary-600 hover:text-primary-700 font-medium">
                                <?php echo t('privacy_contact_email_value', 'legal'); ?>
                            </a>
                        </div>
                        
                        <div>
                            <h3 class="text-lg font-semibold text-primary-800 mb-3">
                                <?php echo t('privacy_contact_postal', 'legal'); ?>
                            </h3>
                            <p class="text-neutral-700">
                                <?php echo t('privacy_contact_postal_value', 'legal'); ?>
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Actualizaciones -->
            <div class="mb-16">
                <h2 class="text-3xl font-bold text-neutral-800 mb-6">
                    <?php echo t('privacy_updates_title', 'legal'); ?>
                </h2>
                <p class="text-lg text-neutral-600 leading-relaxed mb-6">
                    <?php echo t('privacy_updates_desc', 'legal'); ?>
                </p>
                
                <div class="bg-blue-50 border border-blue-200 rounded-xl p-6">
                    <div class="flex items-start gap-4">
                        <svg class="w-6 h-6 text-blue-600 mt-1" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
                        </svg>
                        <div>
                            <h3 class="text-lg font-semibold text-blue-800 mb-2">
                                <?php echo t('privacy_updates_notice', 'legal'); ?>
                            </h3>
                            <p class="text-blue-700">
                                <?php echo t('privacy_updates_notice_desc', 'legal'); ?>
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Fecha de Última Actualización -->
            <div class="text-center py-8 border-t border-neutral-200">
                <p class="text-neutral-500">
                    <?php echo t('privacy_last_updated', 'legal'); ?>: 
                    <span class="font-medium"><?php echo t('privacy_last_updated_date', 'legal'); ?></span>
                </p>
            </div>

        </div>
    </div>
</section>

<!-- CTA Final -->
<section class="py-20 sm:py-32 bg-gradient-to-br from-neutral-900 via-neutral-800 to-primary-900 relative overflow-hidden">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h2 class="text-3xl sm:text-4xl md:text-5xl font-bold text-white mb-8">
            <?php echo t('privacy_cta_title', 'legal'); ?>
        </h2>
        <p class="text-xl text-white/90 max-w-3xl mx-auto leading-relaxed mb-12">
            <?php echo t('privacy_cta_desc', 'legal'); ?>
        </p>
        
        <div class="flex flex-col sm:flex-row gap-6 justify-center items-center">
            <a href="/contacto" class="inline-flex items-center justify-center px-8 py-4 bg-white text-primary-600 font-semibold rounded-xl hover:bg-neutral-100 transition-all duration-300 transform hover:scale-105">
                <?php echo t('privacy_cta_contact', 'legal'); ?>
            </a>
            
            <a href="/terminos-condiciones" class="inline-flex items-center justify-center px-8 py-4 border-2 border-white text-white font-semibold rounded-xl hover:bg-white hover:text-primary-600 transition-all duration-300">
                <?php echo t('privacy_cta_terms', 'legal'); ?>
            </a>
        </div>
    </div>
</section>
