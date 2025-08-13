/**
 * JavaScript principal para Rochas Energy
 * Optimizado para rendimiento y accesibilidad
 */

// Esperar a que el DOM esté listo
document.addEventListener('DOMContentLoaded', function() {
    
    // Optimización de rendimiento - Intersection Observer para animaciones
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };
    
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('animate-in');
            }
        });
    }, observerOptions);
    
    // Observar elementos de servicio
    document.querySelectorAll('.service-card').forEach(card => {
        observer.observe(card);
    });
    
    // Optimización para preferencias de movimiento reducido
    if (window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
        document.documentElement.classList.add('reduce-motion');
    }
    
    // Optimización para dispositivos móviles
    if (window.innerWidth <= 768) {
        document.documentElement.classList.add('mobile-device');
    }
    
    // Lazy loading de imágenes
    if ('IntersectionObserver' in window) {
        const imageObserver = new IntersectionObserver((entries, observer) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const img = entry.target;
                    img.src = img.dataset.src;
                    img.classList.remove('lazy');
                    imageObserver.unobserve(img);
                }
            });
        });
        
        document.querySelectorAll('img[data-src]').forEach(img => {
            imageObserver.observe(img);
        });
    }
    
    // Mejoras de accesibilidad
    // Navegación por teclado mejorada
    document.addEventListener('keydown', function(e) {
        // Escape para cerrar modales o menús
        if (e.key === 'Escape') {
            const openModals = document.querySelectorAll('.modal[data-open="true"]');
            openModals.forEach(modal => {
                modal.setAttribute('data-open', 'false');
            });
        }
    });
    
    // Mejoras de rendimiento
    // Debounce para eventos de scroll
    let scrollTimeout;
    window.addEventListener('scroll', function() {
        if (scrollTimeout) {
            clearTimeout(scrollTimeout);
        }
        scrollTimeout = setTimeout(function() {
            // Optimizaciones durante el scroll
            document.body.classList.add('scrolling');
        }, 100);
    });
    
    // Optimización de formularios
    document.querySelectorAll('form').forEach(form => {
        form.addEventListener('submit', function(e) {
            // Prevenir envío múltiple
            const submitButton = form.querySelector('button[type="submit"]');
            if (submitButton) {
                submitButton.disabled = true;
                submitButton.textContent = 'Enviando...';
            }
        });
    });
    
    // Mejoras de UX
    // Feedback visual para botones
    document.querySelectorAll('button, a[href^="tel:"], a[href^="mailto:"]').forEach(button => {
        button.addEventListener('click', function(e) {
            // Efecto de ripple para botones
            const ripple = document.createElement('span');
            const rect = this.getBoundingClientRect();
            const size = Math.max(rect.width, rect.height);
            const x = e.clientX - rect.left - size / 2;
            const y = e.clientY - rect.top - size / 2;
            
            ripple.style.width = ripple.style.height = size + 'px';
            ripple.style.left = x + 'px';
            ripple.style.top = y + 'px';
            ripple.classList.add('ripple');
            
            this.appendChild(ripple);
            
            setTimeout(() => {
                ripple.remove();
            }, 600);
        });
    });
    
    // Optimización de enlaces externos
    document.querySelectorAll('a[href^="http"]').forEach(link => {
        if (link.hostname !== window.location.hostname) {
            link.setAttribute('target', '_blank');
            link.setAttribute('rel', 'noopener noreferrer');
        }
    });
    
    // Mejoras de SEO y analytics
    // Tracking de eventos importantes
    const trackEvent = (eventName, data = {}) => {
        if (typeof gtag !== 'undefined') {
            gtag('event', eventName, data);
        }
        // Fallback para analytics personalizado
        console.log('Event tracked:', eventName, data);
    };
    
    // Tracking de clicks en botones importantes
    document.querySelectorAll('.cta-button, .contact-button').forEach(button => {
        button.addEventListener('click', function() {
            trackEvent('button_click', {
                button_text: this.textContent.trim(),
                button_location: this.closest('section')?.className || 'unknown'
            });
        });
    });
    
    // Tracking de tiempo en página
    let startTime = Date.now();
    window.addEventListener('beforeunload', function() {
        const timeOnPage = Date.now() - startTime;
        trackEvent('time_on_page', {
            duration: Math.round(timeOnPage / 1000)
        });
    });
    
    // Optimización de rendimiento
    // Preload de recursos críticos
    const preloadResource = (href, as) => {
        const link = document.createElement('link');
        link.rel = 'preload';
        link.href = href;
        link.as = as;
        document.head.appendChild(link);
    };
    
    // Preload de imágenes críticas
    const criticalImages = document.querySelectorAll('img[data-critical="true"]');
    criticalImages.forEach(img => {
        preloadResource(img.src, 'image');
    });
    
    // Optimización de fuentes
    if ('fonts' in document) {
        document.fonts.ready.then(() => {
            document.documentElement.classList.add('fonts-loaded');
        });
    }
    
    // Mejoras de accesibilidad adicionales
    // Skip links para navegación por teclado
    const skipLinks = document.querySelectorAll('.skip-link');
    skipLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.focus();
                target.scrollIntoView({ behavior: 'smooth' });
            }
        });
    });
    
    // Mejoras de contraste dinámico
    if (window.matchMedia('(prefers-contrast: high)').matches) {
        document.documentElement.classList.add('high-contrast');
    }
    
    // Optimización para pantallas de alta densidad
    if (window.devicePixelRatio > 1) {
        document.documentElement.classList.add('high-dpi');
    }
    
    console.log('Rochas Energy - JavaScript loaded and optimized');
});

// Service Worker para cache offline (futuro)
if ('serviceWorker' in navigator) {
    window.addEventListener('load', function() {
        // Registrar service worker cuando esté listo
        // navigator.serviceWorker.register('/sw.js');
    });
}
