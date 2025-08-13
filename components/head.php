<!DOCTYPE html>
<html lang="<?php echo $current_lang ?? 'es'; ?>" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $page_title ?? t('default_title', 'meta'); ?></title>
    <meta name="description" content="<?php echo $page_description ?? t('default_description', 'meta'); ?>">
    
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico">
    
    <!-- Tailwind CSS -->
    <link href="/css/style.css" rel="stylesheet">
    
    <!-- Optimizaciones móviles para botones -->
    <link href="/css/mobile-optimizations.css" rel="stylesheet">
    
    <!-- CSS específico para servicios -->
    <?php if (isset($page) && $page === 'servicios'): ?>
    <link href="/css/services.css" rel="stylesheet">
    <?php endif; ?>
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Meta tags adicionales -->
    <meta name="robots" content="index, follow">
    <meta name="author" content="Rochas Energy">
    
    <!-- Open Graph -->
    <meta property="og:title" content="<?php echo $page_title ?? t('default_title', 'meta'); ?>">
    <meta property="og:description" content="<?php echo $page_description ?? t('default_description', 'meta'); ?>">
    <meta property="og:type" content="website">
    <meta property="og:url" content="<?php echo $_SERVER['REQUEST_URI'] ?? ''; ?>">
    
    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="<?php echo $page_title ?? t('default_title', 'meta'); ?>">
    <meta name="twitter:description" content="<?php echo $page_description ?? t('default_description', 'meta'); ?>">
</head>
<body class="bg-neutral-900 font-sans h-full flex flex-col">
