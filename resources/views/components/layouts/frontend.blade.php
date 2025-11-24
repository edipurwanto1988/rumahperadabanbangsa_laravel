<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rumah Peradaban Bangsa Foundation - Membangun Manusia, Menegakkan Peradaban</title>
    
    <!-- Meta Tags for Google -->
    <meta name="description" content="RPB Foundation adalah lembaga sosial non-profit yang berfokus pada penguatan peradaban bangsa melalui pembangunan manusia, ekonomi, sosial, budaya, dan lingkungan secara terpadu.">
    <meta name="keywords" content="RPB Foundation, Rumah Peradaban Bangsa, Yayasan Sosial, Pendidikan Karakter, Pemberdayaan Ekonomi, Pelestarian Lingkungan, Ketahanan Sosial, Bela Negara, Donasi, Relawan">
    <meta name="author" content="Rumah Peradaban Bangsa Foundation">
    <meta name="robots" content="index, follow">
    
    <!-- Open Graph Meta Tags for Facebook & LinkedIn -->
    <meta property="og:title" content="Rumah Peradaban Bangsa Foundation - Membangun Manusia, Menegakkan Peradaban">
    <meta property="og:description" content="RPB Foundation adalah lembaga sosial non-profit yang berfokus pada penguatan peradaban bangsa melalui pembangunan manusia, ekonomi, sosial, budaya, dan lingkungan secara terpadu.">
    <meta property="og:image" content="{{ asset('images/Yosua_Siburian.jpeg') }}">
    <meta property="og:url" content="{{ url('/') }}">
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="Rumah Peradaban Bangsa Foundation">
    <meta property="og:locale" content="id_ID">
    
    <!-- Twitter Card Meta Tags -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="Rumah Peradaban Bangsa Foundation - Membangun Manusia, Menegakkan Peradaban">
    <meta name="twitter:description" content="RPB Foundation adalah lembaga sosial non-profit yang berfokus pada penguatan peradaban bangsa melalui pembangunan manusia, ekonomi, sosial, budaya, dan lingkungan secara terpadu.">
    <meta name="twitter:image" content="{{ asset('images/Yosua_Siburian.jpeg') }}">
    <meta name="twitter:url" content="{{ url('/') }}">
    
    <!-- Additional Meta Tags -->
    <link rel="canonical" href="{{ url('/') }}">
    <meta name="theme-color" content="#0540AD">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap');
        
        * {
            font-family: 'Inter', sans-serif;
        }
        
        .gradient-bg {
            background: linear-gradient(135deg, #091C53 0%, #1E3063 50%, #0540AD 100%);
        }
        
        .text-gradient {
            background: linear-gradient(135deg, #84C1FA 0%, #CEE6FD 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        
        .pillar-card {
            transition: all 0.3s ease;
            backdrop-filter: blur(10px);
        }
        
        .pillar-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(0,0,0,0.1);
        }
        
        .program-card {
            transition: all 0.3s ease;
            border: 2px solid transparent;
        }
        
        .program-card:hover {
            border-color: #84C1FA;
            transform: scale(1.02);
        }
        
        .partner-logo {
            transition: all 0.3s ease;
            filter: grayscale(100%);
            opacity: 0.7;
        }
        
        .partner-logo:hover {
            filter: grayscale(0%);
            opacity: 1;
            transform: scale(1.1);
        }
        
        .floating {
            animation: floating 3s ease-in-out infinite;
        }
        
        @keyframes floating {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
            100% { transform: translateY(0px); }
        }
        
        .slide-in {
            opacity: 0;
            transform: translateY(30px);
            transition: all 0.6s ease;
        }
        
        .slide-in.active {
            opacity: 1;
            transform: translateY(0);
        }
        
        .parallax {
            background-attachment: fixed;
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
        }
        
        .glass-effect {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        
        .mission-number {
            background: linear-gradient(135deg, #84C1FA 0%, #CEE6FD 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            font-weight: 800;
        }
        
        html {
            scroll-behavior: smooth;
        }
    </style>
</head>
<body class="bg-gray-50">
    @include('partials.header')

    <main>
        {{ $slot }}
    </main>

    @include('partials.footer')

    <!-- Image Modal -->
    <div id="imageModal" class="fixed inset-0 bg-black bg-opacity-75 flex items-start justify-center z-50 hidden" onclick="closeImageModal()">
        <div class="relative max-w-4xl max-h-full p-4 h-full w-full flex items-start justify-center overflow-auto">
            <img id="modalImage" src="" alt="Full size image" class="max-w-full object-contain">
            <button class="absolute top-2 right-2 bg-white text-black rounded-full w-10 h-10 flex items-center justify-center text-xl font-bold hover:bg-gray-200 transition" onclick="closeImageModal()">&times;</button>
        </div>
    </div>

    <!-- WhatsApp Floating Button -->
    <div class="fixed bottom-6 right-6 flex items-end z-50">
        <span class="bg-white text-gray-800 px-3 py-1 rounded-lg mr-2 shadow-md opacity-0 transition-opacity duration-300" id="whatsapp-tooltip">Jhoe</span>
        <a href="https://wa.me/6281388181442" class="bg-green-500 text-white rounded-full w-16 h-16 flex items-center justify-center shadow-lg hover:bg-green-600 transition-all duration-300" target="_blank">
            <i class="fab fa-whatsapp text-2xl"></i>
        </a>
    </div>

    <script>
        // WhatsApp tooltip functionality
        document.addEventListener('DOMContentLoaded', function() {
            const whatsappButton = document.querySelector('.fixed.bottom-6.right-6 a');
            const tooltip = document.getElementById('whatsapp-tooltip');
            
            if (whatsappButton && tooltip) {
                // Show tooltip on hover
                whatsappButton.addEventListener('mouseenter', function() {
                    tooltip.style.opacity = '1';
                });
                
                // Hide tooltip when mouse leaves
                whatsappButton.addEventListener('mouseleave', function() {
                    tooltip.style.opacity = '0';
                });
            }
        });

        // Mobile Menu Toggle
        const mobileMenuBtn = document.getElementById('mobileMenuBtn');
        const mobileMenu = document.getElementById('mobileMenu');
        
        if (mobileMenuBtn && mobileMenu) {
            mobileMenuBtn.addEventListener('click', () => {
                mobileMenu.classList.toggle('hidden');
            });
        }

        // Smooth Scroll
        function scrollToSection(sectionId) {
            const section = document.getElementById(sectionId);
            if (section) {
                section.scrollIntoView({ behavior: 'smooth' });
            }
        }

        // Intersection Observer for Animations
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('active');
                }
            });
        }, observerOptions);

        // Observe all slide-in elements
        document.addEventListener('DOMContentLoaded', () => {
            document.querySelectorAll('.slide-in').forEach(el => {
                observer.observe(el);
            });
        });

        // Parallax Effect
        window.addEventListener('scroll', () => {
            const scrolled = window.pageYOffset;
            const parallax = document.querySelector('.gradient-bg');
            if (parallax) {
                parallax.style.transform = `translateY(${scrolled * 0.5}px)`;
            }
            
            // Prevent overlap between sections
            const tentangSection = document.getElementById('tentang');
            const berandaSection = document.getElementById('beranda');
            if (tentangSection && berandaSection) {
                const tentangTop = tentangSection.getBoundingClientRect().top;
                
                // If about section is approaching the hero section
                if (tentangTop < window.innerHeight && tentangTop > 0) {
                    berandaSection.style.zIndex = "1";
                    tentangSection.style.zIndex = "10";
                }
            }
        });

        // Counter Animation
        function animateCounter(element, target, duration = 2000) {
            let start = 0;
            const increment = target / (duration / 16);
            
            function updateCounter() {
                start += increment;
                if (start < target) {
                    element.textContent = Math.floor(start);
                    requestAnimationFrame(updateCounter);
                } else {
                    element.textContent = target;
                }
            }
            
            updateCounter();
        }

        // Add hover effects to cards
        document.addEventListener('DOMContentLoaded', () => {
            document.querySelectorAll('.program-card, .pillar-card').forEach(card => {
                card.addEventListener('mouseenter', function() {
                    this.style.transform = 'translateY(-5px)';
                });
                
                card.addEventListener('mouseleave', function() {
                    this.style.transform = 'translateY(0)';
                });
            });
        });

        // Smooth scroll for navigation links
        document.addEventListener('DOMContentLoaded', () => {
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function (e) {
                    // Only prevent default if it's a hash link on the same page
                    if (this.getAttribute('href').startsWith('#')) {
                        e.preventDefault();
                        const targetId = this.getAttribute('href').substring(1);
                        const target = document.getElementById(targetId);
                        if (target) {
                            const offsetTop = target.offsetTop - 100; // Adjust for fixed navigation height
                            window.scrollTo({
                                top: offsetTop,
                                behavior: 'smooth'
                            });
                        }
                        // Close mobile menu if open
                        if (mobileMenu) {
                            mobileMenu.classList.add('hidden');
                        }
                    }
                });
            });
        });

        // Add loading animation
        window.addEventListener('load', () => {
            document.body.classList.add('loaded');
        });

        // Image Modal Functions
        function openImageModal(imageSrc) {
            const modal = document.getElementById('imageModal');
            const modalImage = document.getElementById('modalImage');
            if (modal && modalImage) {
                modalImage.src = imageSrc;
                modal.classList.remove('hidden');
                document.body.style.overflow = 'hidden'; // Prevent scrolling when modal is open
            }
        }

        function closeImageModal() {
            const modal = document.getElementById('imageModal');
            if (modal) {
                modal.classList.add('hidden');
                document.body.style.overflow = 'auto'; // Re-enable scrolling when modal is closed
            }
        }
    </script>
</body>
</html>
