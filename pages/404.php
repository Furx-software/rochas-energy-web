<!-- Página 404 con diseño moderno y animaciones -->
<div class="min-h-screen flex items-center justify-center electric-background relative overflow-hidden">
    <!-- Partículas eléctricas animadas -->
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
    <div class="relative z-10 text-center px-4 sm:px-6 lg:px-8 max-w-4xl mx-auto">
        <!-- Número 404 con efecto de gradiente -->
        <div class="mb-8 relative">
            <h1 class="text-8xl md:text-[10rem] lg:text-[12rem] font-black leading-none bg-gradient-to-r from-primary-400 via-primary-500 to-accent-400 bg-clip-text text-transparent animate-pulse">
                404
            </h1>
            <!-- Efecto de sombra -->
            <div class="absolute inset-0 text-8xl md:text-[10rem] lg:text-[12rem] font-black leading-none text-neutral-800 opacity-10 -z-10 transform translate-x-1 translate-y-1">
                404
            </div>
        </div>

        <!-- Mensaje principal -->
        <div class="mb-12">
            <h2 class="text-3xl md:text-4xl lg:text-5xl font-bold text-white mb-6 leading-tight">
                <?php echo t('title', '404'); ?>
            </h2>
            <p class="text-xl md:text-2xl text-neutral-300 max-w-2xl mx-auto leading-relaxed">
                <?php echo t('subtitle', '404'); ?>
            </p>
        </div>

        <!-- Botones de acción con diseño moderno -->
        <div class="flex flex-col sm:flex-row gap-6 justify-center mb-16">
            <a href="/" class="group relative inline-flex items-center justify-center px-8 py-4 text-lg font-semibold text-white bg-gradient-to-r from-primary-500 to-primary-600 rounded-xl shadow-lg hover:shadow-xl transform hover:-translate-y-1 transition-all duration-300 overflow-hidden">
                <!-- Efecto de brillo -->
                <div class="absolute inset-0 bg-gradient-to-r from-transparent via-white/20 to-transparent -translate-x-full group-hover:translate-x-full transition-transform duration-1000"></div>
                <span class="relative flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                    </svg>
                    <?php echo t('back_home', '404'); ?>
                </span>
            </a>
            
            <a href="/contacto" class="group relative inline-flex items-center justify-center px-8 py-4 text-lg font-semibold text-primary-500 bg-white/10 backdrop-blur-sm border border-white/20 rounded-xl shadow-lg hover:shadow-xl transform hover:-translate-y-1 transition-all duration-300 hover:bg-white/20">
                <span class="relative flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                    </svg>
                    <?php echo t('contact_us', '404'); ?>
                </span>
            </a>
        </div>
    </div>
</div>
