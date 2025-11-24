<x-layouts.frontend>
    <!-- Hero Section -->
    <section id="beranda" class="gradient-bg min-h-screen flex items-center justify-center text-white relative overflow-hidden z-0">
        <div class="absolute inset-0">
            <div class="absolute top-20 left-10 w-32 h-32 bg-blue-400 rounded-full opacity-20 floating"></div>
            <div class="absolute top-40 right-20 w-24 h-24 bg-blue-300 rounded-full opacity-20 floating" style="animation-delay: 1s;"></div>
            <div class="absolute bottom-20 left-1/4 w-40 h-40 bg-blue-500 rounded-full opacity-10 floating" style="animation-delay: 2s;"></div>
        </div>
        
        <div class="container mx-auto px-6 text-center relative z-10">
            <div class="slide-in">
                <h1 class="text-5xl md:text-7xl font-bold mb-6">
                    Rumah Peradaban Bangsa Foundation
                </h1>
                <p class="text-xl md:text-2xl mb-8 text-blue-100">
                    Mandira Peradaban Nusantara untuk Kemajuan, Keharmonisan, dan Kemuliaan Bangsa
                </p>
                <p class="text-lg max-w-3xl mx-auto mb-12 text-blue-50">
                    Rumah Peradaban Bangsa Foundation lahir dari kesadaran luhur bahwa peradaban adalah fondasi paling halus namun paling menentukan bagi kejayaan sebuah bangsa. Dengan semangat Dharma Negara, kami hadir sebagai wadah penyambung nilai, ruang penguatan karakter bangsa, dan jembatan kolaborasi lintas sektor.
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <button onclick="scrollToSection('tentang')" class="bg-white text-blue-900 px-8 py-4 rounded-full font-semibold hover:bg-blue-50 transition transform hover:scale-105">
                        <i class="fas fa-info-circle mr-2"></i>Telusuri Lebih Lanjut
                    </button>
                    <button onclick="scrollToSection('program')" class="border-2 border-white text-white px-8 py-4 rounded-full font-semibold hover:bg-white hover:text-blue-900 transition transform hover:scale-105">
                        <i class="fas fa-rocket mr-2"></i>Lihat Program Kami
                    </button>
                </div>
            </div>
        </div>
        
        <div class="absolute bottom-10 left-1/2 transform -translate-x-1/2 animate-bounce">
            <i class="fas fa-chevron-down text-3xl text-blue-200"></i>
        </div>
    </section>

    <!-- About Section -->
    <section id="tentang" class="py-32 bg-gradient-to-br from-blue-50 to-indigo-100 relative">
        <div class="absolute top-0 left-0 w-full h-8 bg-gradient-to-br from-blue-50 to-indigo-100"></div>
        <div class="container mx-auto px-6">
            <div class="text-center mb-16 slide-in">
                <h2 class="text-5xl font-bold text-blue-900 mb-4">Latar Belakang dan Tantangan Bangsa</h2>
                <div class="w-24 h-1 bg-gradient-to-r from-blue-500 to-indigo-600 mx-auto mb-6"></div>
                <p class="text-xl text-gray-700 max-w-3xl mx-auto">
                    RPB Foundation hadir untuk menjawab tantangan bangsa dalam membangun peradaban yang adiluhung
                </p>
            </div>
            
            <!-- Legal Foundation Information -->
            <div class="bg-white p-8 rounded-2xl shadow-xl mb-12 border-l-4 border-blue-600 slide-in">
                <h3 class="text-2xl font-bold text-blue-800 mb-4 flex items-center">
                    <i class="fas fa-gavel text-blue-600 mr-3"></i>
                    Legalitas Yayasan
                </h3>
                <div class="bg-blue-50 p-6 rounded-xl">
                    <p class="text-lg font-semibold text-blue-900 mb-2">KEPUTUSAN MENTERI HUKUM DAN HAK ASASI MANUSIA REPUBLIK INDONESIA</p>
                    <p class="text-xl font-bold text-blue-800 mb-4">NOMOR AHU-0012858.AH.01.04.Tahun 2024</p>
                    <p class="text-lg text-blue-900 font-medium mb-2">TENTANG</p>
                    <p class="text-xl font-bold text-blue-800">PENGESAHAN PENDIRIAN YAYASAN RUMAH PERADABAN BANGSA</p>
                </div>
            </div>
            
            <div class="grid md:grid-cols-2 gap-12 items-center">
                <div class="slide-in">
                    <div class="bg-white p-8 rounded-2xl shadow-xl border-l-4 border-blue-600">
                        <h3 class="text-2xl font-bold text-blue-800 mb-4 flex items-center">
                            <i class="fas fa-lightbulb text-yellow-500 mr-3"></i>
                            Visi Peradaban Bangsa
                        </h3>
                        <p class="text-gray-700 leading-relaxed mb-6">
                            Dalam perjalanan bangsa menuju kejayaan, dibutuhkan fondasi kuat berupa manusia unggul, ekonomi berdaya, lingkungan lestari, serta budaya dan nilai kebangsaan yang kokoh.
                        </p>
                        <div class="flex items-center text-blue-600 font-medium">
                            <i class="fas fa-arrow-right mr-2"></i>
                            <span>Mewujudkan Indonesia yang tangguh dan berdaya saing</span>
                        </div>
                    </div>
                    
                    <div class="bg-white p-8 rounded-2xl shadow-xl mt-8 border-l-4 border-indigo-600">
                        <h3 class="text-2xl font-bold text-blue-800 mb-4 flex items-center">
                            <i class="fas fa-exclamation-triangle text-red-500 mr-3"></i>
                            Tantangan Pembangunan
                        </h3>
                        <ul class="space-y-4">
                            <li class="flex items-start">
                                <div class="bg-blue-100 rounded-full w-12 h-12 flex items-center justify-center mr-4 flex-shrink-0">
                                    <i class="fas fa-balance-scale text-blue-600"></i>
                                </div>
                                <div>
                                    <h4 class="font-semibold text-blue-800">Ketimpangan Sosial</h4>
                                    <p class="text-gray-700">Masih tingginya kesenjangan antar kelompok masyarakat</p>
                                </div>
                            </li>
                            <li class="flex items-start">
                                <div class="bg-green-100 rounded-full w-12 h-12 flex items-center justify-center mr-4 flex-shrink-0">
                                    <i class="fas fa-leaf text-green-600"></i>
                                </div>
                                <div>
                                    <h4 class="font-semibold text-blue-800">Degradasi Lingkungan</h4>
                                    <p class="text-gray-700">Kerusakan alam yang berkelanjutan membutuhkan solusi nyata</p>
                                </div>
                            </li>
                            <li class="flex items-start">
                                <div class="bg-purple-100 rounded-full w-12 h-12 flex items-center justify-center mr-4 flex-shrink-0">
                                    <i class="fas fa-book text-purple-600"></i>
                                </div>
                                <div>
                                    <h4 class="font-semibold text-blue-800">Literasi Kebangsaan</h4>
                                    <p class="text-gray-700">Rendahnya pemahaman nilai-nilai dasar negara</p>
                                </div>
                            </li>
                            <li class="flex items-start">
                                <div class="bg-red-100 rounded-full w-12 h-12 flex items-center justify-center mr-4 flex-shrink-0">
                                    <i class="fas fa-users text-red-600"></i>
                                </div>
                                <div>
                                    <h4 class="font-semibold text-blue-800">Ketahanan Sosial</h4>
                                    <p class="text-gray-700">Melemahnya solidaritas dan persatuan bangsa</p>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
                
                <div class="slide-in">
                    <div class="relative">
                        <div class="absolute -inset-4 bg-gradient-to-r from-blue-600 to-indigo-700 rounded-2xl blur-lg opacity-30"></div>
                        <div class="relative bg-white p-2 rounded-2xl shadow-2xl w-full aspect-[4/3]">
                            <img src="{{ asset('images/Yosua_Siburian2.jpeg') }}" alt="Rumah Peradaban Bangsa Foundation" class="w-full h-full object-cover object-top rounded-xl cursor-pointer" onclick="openImageModal('{{ asset('images/Yosua_Siburian.jpeg') }}')">
                            <div class="absolute bottom-4 left-4 bg-gradient-to-r from-blue-600 to-indigo-700 text-white px-4 py-2 rounded-lg">
                                <p class="font-bold">Membangun Peradaban Bangsa</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="mt-8 bg-gradient-to-br from-blue-600 to-indigo-700 p-6 rounded-2xl text-white">
                        <h3 class="text-xl font-bold mb-3">Mengapa RPB Foundation?</h3>
                        <p class="mb-4">Kami hadir sebagai solusi integratif untuk mengatasi tantangan bangsa melalui pendekatan holistic dan berkelanjutan.</p>
                        <div class="flex items-center text-blue-100">
                            <i class="fas fa-quote-left mr-2"></i>
                            <span>Membangun Manusia, Menegakkan Peradaban</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Vision & Mission Section -->
    <section id="visi-misi" class="py-32 bg-gray-50">
        <div class="container mx-auto px-6">
            <div class="text-center mb-16 slide-in">
                <h2 class="text-4xl font-bold text-blue-900 mb-4">Tri Darma Mahottama: Visi Peradaban</h2>
                <p class="text-xl text-gray-700 max-w-3xl mx-auto">
                    Menjadikan Indonesia bangsa adiluhung yang maju dalam ilmu, matang dalam budaya, dan kukuh dalam karakter kebangsaan
                </p>
            </div>

            <!-- Tri Darma Mahottama -->
            <div class="grid md:grid-cols-3 gap-8 mb-16">
                <div class="bg-white p-8 rounded-2xl shadow-lg text-center slide-in">
                    <div class="inline-flex items-center justify-center w-20 h-20 bg-blue-100 rounded-full mb-6">
                        <i class="fas fa-brain text-3xl text-blue-600"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-blue-900 mb-4">Jñana Utama</h3>
                    <h4 class="text-lg font-semibold text-blue-800 mb-3">Penguatan Pengetahuan</h4>
                    <p class="text-gray-700 leading-relaxed">
                        Membentuk masyarakat berpengetahuan, kritis, cerdas, dan bijaksana dalam merespons dinamika zaman
                    </p>
                </div>

                <div class="bg-white p-8 rounded-2xl shadow-lg text-center slide-in" style="animation-delay: 0.1s;">
                    <div class="inline-flex items-center justify-center w-20 h-20 bg-purple-100 rounded-full mb-6">
                        <i class="fas fa-theater-masks text-3xl text-purple-600"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-blue-900 mb-4">Samskara Luhur</h3>
                    <h4 class="text-lg font-semibold text-blue-800 mb-3">Peradaban dan Kebudayaan</h4>
                    <p class="text-gray-700 leading-relaxed">
                        Menghidupkan nilai-nilai luhur Nusantara sebagai sumber harmoni, keindahan, dan identitas bangsa
                    </p>
                </div>

                <div class="bg-white p-8 rounded-2xl shadow-lg text-center slide-in" style="animation-delay: 0.2s;">
                    <div class="inline-flex items-center justify-center w-20 h-20 bg-red-100 rounded-full mb-6">
                        <i class="fas fa-users text-3xl text-red-600"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-blue-900 mb-4">Sangaskara Bangsa</h3>
                    <h4 class="text-lg font-semibold text-blue-800 mb-3">Keutuhan Kebangsaan</h4>
                    <p class="text-gray-700 leading-relaxed">
                        Membangun kohesi sosial, rasa kebersamaan, adab publik, dan integritas sebagai pilar persatuan Indonesia Raya
                    </p>
                </div>
            </div>

            <!-- Catur Adi Pradhana -->
            <div class="text-center mb-12 slide-in">
                <h2 class="text-4xl font-bold text-blue-900 mb-4">Catur Adi Pradhana: Misi Strategis</h2>
                <p class="text-xl text-gray-700 max-w-3xl mx-auto">
                    Empat pilar misi strategis untuk mewujudkan visi peradaban bangsa
                </p>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6">
                <div class="mission-card slide-in bg-white p-6 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300">
                    <div class="flex items-center mb-4">
                        <span class="mission-number text-4xl font-bold mr-4">01</span>
                        <i class="fas fa-book-open text-2xl text-blue-600"></i>
                    </div>
                    <h4 class="text-xl font-semibold text-blue-900 mb-3">Literasi Kebangsaan</h4>
                    <p class="text-gray-700">Penjernihan wacana publik agar ruang publik bebas dari polarisasi</p>
                </div>

                <div class="mission-card slide-in bg-white p-6 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300" style="animation-delay: 0.1s;">
                    <div class="flex items-center mb-4">
                        <span class="mission-number text-4xl font-bold mr-4">02</span>
                        <i class="fas fa-user-graduate text-2xl text-blue-600"></i>
                    </div>
                    <h4 class="text-xl font-semibold text-blue-900 mb-3">Penguatan Karakter</h4>
                    <p class="text-gray-700">Membangun generasi unggul melalui pendidikan karakter dan kepemimpinan berbasis nilai</p>
                </div>

                <div class="mission-card slide-in bg-white p-6 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300" style="animation-delay: 0.2s;">
                    <div class="flex items-center mb-4">
                        <span class="mission-number text-4xl font-bold mr-4">03</span>
                        <i class="fas fa-handshake text-2xl text-blue-600"></i>
                    </div>
                    <h4 class="text-xl font-semibold text-blue-900 mb-3">Kolaborasi Holistik</h4>
                    <p class="text-gray-700">Menyambungkan pemerintah, swasta, akademisi, dan komunitas dalam satu garis kerja peradaban</p>
                </div>

                <div class="mission-card slide-in bg-white p-6 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300" style="animation-delay: 0.3s;">
                    <div class="flex items-center mb-4">
                        <span class="mission-number text-4xl font-bold mr-4">04</span>
                        <i class="fas fa-seedling text-2xl text-blue-600"></i>
                    </div>
                    <h4 class="text-xl font-semibold text-blue-900 mb-3">Pemberdayaan Berkelanjutan</h4>
                    <p class="text-gray-700">Model pemberdayaan yang menumbuhkan kemandirian dengan pendekatan humanis</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Five Pillars Section -->
    <section id="pilar" class="py-32 bg-white">
        <div class="container mx-auto px-6">
            <div class="text-center mb-16 slide-in">
                <h2 class="text-4xl font-bold text-blue-900 mb-4">Lima Pilar Ketahanan Peradaban</h2>
                <p class="text-xl text-gray-700 max-w-3xl mx-auto">
                    RPB Foundation berpegang pada lima pilar fundamental yang menjadi landasan ketahanan peradaban bangsa
                </p>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                <div class="pillar-card bg-gradient-to-br from-blue-50 to-blue-100 p-8 rounded-2xl text-center">
                    <div class="inline-flex items-center justify-center w-16 h-16 bg-blue-600 rounded-full mb-6">
                        <span class="text-2xl font-bold text-white">01</span>
                    </div>
                    <h3 class="text-xl font-bold text-blue-900 mb-4">Ketahanan Pengetahuan Publik</h3>
                    <p class="text-gray-700">Melindungi bangsa dari informasi menyesatkan, polarisasi, dan penurunan kualitas literasi melalui program edukasi dan forum penjernihan</p>
                </div>

                <div class="pillar-card bg-gradient-to-br from-green-50 to-green-100 p-8 rounded-2xl text-center">
                    <div class="inline-flex items-center justify-center w-16 h-16 bg-green-600 rounded-full mb-6">
                        <span class="text-2xl font-bold text-white">02</span>
                    </div>
                    <h3 class="text-xl font-bold text-blue-900 mb-4">Kohesi Sosial Nasional</h3>
                    <p class="text-gray-700">Membangun platform sosial-budaya yang menciptakan rasa kebersamaan, saling memahami, dan dialog lintas identitas</p>
                </div>

                <div class="pillar-card bg-gradient-to-br from-emerald-50 to-emerald-100 p-8 rounded-2xl text-center">
                    <div class="inline-flex items-center justify-center w-16 h-16 bg-emerald-600 rounded-full mb-6">
                        <span class="text-2xl font-bold text-white">03</span>
                    </div>
                    <h3 class="text-xl font-bold text-blue-900 mb-4">Peradaban Ekonomi Rakyat</h3>
                    <p class="text-gray-700">Penguatan UMKM berbasis nilai kearifan lokal agar berdaya, adaptif, dan terhubung ke pasar</p>
                </div>

                <div class="pillar-card bg-gradient-to-br from-purple-50 to-purple-100 p-8 rounded-2xl text-center">
                    <div class="inline-flex items-center justify-center w-16 h-16 bg-purple-600 rounded-full mb-6">
                        <span class="text-2xl font-bold text-white">04</span>
                    </div>
                    <h3 class="text-xl font-bold text-blue-900 mb-4">Pendidikan Karakter Kebangsaan</h3>
                    <p class="text-gray-700">Merawat pendidikan karakter, integritas, etika publik, dan jiwa gotong royong untuk menghadapi tantangan masa depan</p>
                </div>

                <div class="pillar-card bg-gradient-to-br from-red-50 to-red-100 p-8 rounded-2xl text-center">
                    <div class="inline-flex items-center justify-center w-16 h-16 bg-red-600 rounded-full mb-6">
                        <span class="text-2xl font-bold text-white">05</span>
                    </div>
                    <h3 class="text-xl font-bold text-blue-900 mb-4">Diplomasi Budaya Nasional</h3>
                    <p class="text-gray-700">Memperkuat soft power Indonesia melalui pertunjukan seni, kajian kearifan lokal, dan diplomasi budaya</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Programs Section -->
    <section id="program" class="py-32 bg-gray-50">
        <div class="container mx-auto px-6">
            <div class="text-center mb-16 slide-in">
                <h2 class="text-4xl font-bold text-blue-900 mb-4">Pañca Maha Karya: Program Kerja Utama</h2>
                <p class="text-xl text-gray-700 max-w-3xl mx-auto">
                    Lima program utama untuk mewujudkan visi peradaban bangsa
                </p>
            </div>

            <div class="space-y-12">
                <!-- Program 1 -->
                <div class="bg-white rounded-2xl shadow-lg overflow-hidden slide-in">
                    <div class="bg-gradient-to-r from-blue-600 to-blue-700 text-white p-6">
                        <div class="flex items-center">
                            <div class="text-4xl font-bold mr-4">1</div>
                            <h3 class="text-2xl font-bold">Akademi Peradaban & Kepemimpinan Nusantara</h3>
                        </div>
                    </div>
                    <div class="p-6">
                        <p class="text-gray-700 leading-relaxed">
                            Program untuk generasi muda, ASN, perangkat desa mencakup literasi kebangsaan, kepemimpinan berbasis nilai, komunikasi publik beradab, dan manajemen komunitas
                        </p>
                        <div class="mt-4 flex flex-wrap gap-2">
                            <span class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-sm">Literasi Kebangsaan</span>
                            <span class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-sm">Kepemimpinan</span>
                            <span class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-sm">Komunikasi Publik</span>
                        </div>
                    </div>
                </div>

                <!-- Program 2 -->
                <div class="bg-white rounded-2xl shadow-lg overflow-hidden slide-in" style="animation-delay: 0.1s;">
                    <div class="bg-gradient-to-r from-purple-600 to-purple-700 text-white p-6">
                        <div class="flex items-center">
                            <div class="text-4xl font-bold mr-4">2</div>
                            <h3 class="text-2xl font-bold">Pusat Diplomasi Budaya dan Festival Nusantara</h3>
                        </div>
                    </div>
                    <div class="p-6">
                        <p class="text-gray-700 leading-relaxed">
                            Kolaborasi dengan kementerian untuk festival budaya, forum lintas suku & agama, dan pelestarian warisan leluhur
                        </p>
                        <div class="mt-4 flex flex-wrap gap-2">
                            <span class="bg-purple-100 text-purple-800 px-3 py-1 rounded-full text-sm">Diplomasi Budaya</span>
                            <span class="bg-purple-100 text-purple-800 px-3 py-1 rounded-full text-sm">Festival Budaya</span>
                            <span class="bg-purple-100 text-purple-800 px-3 py-1 rounded-full text-sm">Warisan Leluhur</span>
                        </div>
                    </div>
                </div>

                <!-- Program 3 -->
                <div class="bg-white rounded-2xl shadow-lg overflow-hidden slide-in" style="animation-delay: 0.2s;">
                    <div class="bg-gradient-to-r from-green-600 to-green-700 text-white p-6">
                        <div class="flex items-center">
                            <div class="text-4xl font-bold mr-4">3</div>
                            <h3 class="text-2xl font-bold">Inkubasi UMKM & Peradaban Ekonomi Sosial</h3>
                        </div>
                    </div>
                    <div class="p-6">
                        <p class="text-gray-700 leading-relaxed">
                            Pengembangan produk lokal, pelatihan branding & digitalisasi, riset pasar, dan konsolidasi ekosistem desa ekonomi kreatif
                        </p>
                        <div class="mt-4 flex flex-wrap gap-2">
                            <span class="bg-green-100 text-green-800 px-3 py-1 rounded-full text-sm">UMKM</span>
                            <span class="bg-green-100 text-green-800 px-3 py-1 rounded-full text-sm">Branding</span>
                            <span class="bg-green-100 text-green-800 px-3 py-1 rounded-full text-sm">Ekonomi Kreatif</span>
                        </div>
                    </div>
                </div>

                <!-- Program 4 -->
                <div class="bg-white rounded-2xl shadow-lg overflow-hidden slide-in" style="animation-delay: 0.3s;">
                    <div class="bg-gradient-to-r from-red-600 to-red-700 text-white p-6">
                        <div class="flex items-center">
                            <div class="text-4xl font-bold mr-4">4</div>
                            <h3 class="text-2xl font-bold">Forum Harmoni Nasional</h3>
                        </div>
                    </div>
                    <div class="p-6">
                        <p class="text-gray-700 leading-relaxed">
                            Dialog kebangsaan, penguatan kohesi sosial, penanganan isu keretakan sosial, dan peneguhan ruang publik damai
                        </p>
                        <div class="mt-4 flex flex-wrap gap-2">
                            <span class="bg-red-100 text-red-800 px-3 py-1 rounded-full text-sm">Dialog Kebangsaan</span>
                            <span class="bg-red-100 text-red-800 px-3 py-1 rounded-full text-sm">Kohesi Sosial</span>
                            <span class="bg-red-100 text-red-800 px-3 py-1 rounded-full text-sm">Ruang Publik Damai</span>
                        </div>
                    </div>
                </div>

                <!-- Program 5 -->
                <div class="bg-white rounded-2xl shadow-lg overflow-hidden slide-in" style="animation-delay: 0.4s;">
                    <div class="bg-gradient-to-r from-emerald-600 to-emerald-700 text-white p-6">
                        <div class="flex items-center">
                            <div class="text-4xl font-bold mr-4">5</div>
                            <h3 class="text-2xl font-bold">Gerakan Jagaddhita Indonesia</h3>
                        </div>
                    </div>
                    <div class="p-6">
                        <p class="text-gray-700 leading-relaxed">
                            Pendidikan masyarakat, kesehatan komunitas, lingkungan berkelanjutan, pemulihan sosial, dan kampanye budaya hidup berkualitas
                        </p>
                        <div class="mt-4 flex flex-wrap gap-2">
                            <span class="bg-emerald-100 text-emerald-800 px-3 py-1 rounded-full text-sm">Pendidikan Masyarakat</span>
                            <span class="bg-emerald-100 text-emerald-800 px-3 py-1 rounded-full text-sm">Kesehatan Komunitas</span>
                            <span class="bg-emerald-100 text-emerald-800 px-3 py-1 rounded-full text-sm">Lingkungan Berkelanjutan</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Values Section -->
    <section id="nilai" class="py-32 bg-gradient-to-br from-indigo-50 to-blue-100">
        <div class="container mx-auto px-6">
            <div class="text-center mb-16 slide-in">
                <h2 class="text-4xl font-bold text-blue-900 mb-4">Sadguna Luhur: Struktur Nilai</h2>
                <p class="text-xl text-gray-700 max-w-3xl mx-auto">
                    Enam nilai fundamental yang menjadi landasan karakter dan tindakan RPB Foundation
                </p>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                <div class="bg-white p-8 rounded-2xl shadow-lg text-center slide-in">
                    <div class="inline-flex items-center justify-center w-16 h-16 bg-blue-600 rounded-full mb-6">
                        <i class="fas fa-balance-scale text-2xl text-white"></i>
                    </div>
                    <h3 class="text-xl font-bold text-blue-900 mb-4">Dharma</h3>
                    <p class="text-gray-700">Integritas dan ketepatan laku dalam setiap tindakan</p>
                </div>

                <div class="bg-white p-8 rounded-2xl shadow-lg text-center slide-in" style="animation-delay: 0.1s;">
                    <div class="inline-flex items-center justify-center w-16 h-16 bg-pink-600 rounded-full mb-6">
                        <i class="fas fa-heart text-2xl text-white"></i>
                    </div>
                    <h3 class="text-xl font-bold text-blue-900 mb-4">Karuna</h3>
                    <p class="text-gray-700">Kemanusiaan yang utuh penuh kasih dan empati</p>
                </div>

                <div class="bg-white p-8 rounded-2xl shadow-lg text-center slide-in" style="animation-delay: 0.2s;">
                    <div class="inline-flex items-center justify-center w-16 h-16 bg-purple-600 rounded-full mb-6">
                        <i class="fas fa-brain text-2xl text-white"></i>
                    </div>
                    <h3 class="text-xl font-bold text-blue-900 mb-4">Sattwa</h3>
                    <p class="text-gray-700">Kejernihan nalar dalam berpikir dan bertindak</p>
                </div>

                <div class="bg-white p-8 rounded-2xl shadow-lg text-center slide-in" style="animation-delay: 0.3s;">
                    <div class="inline-flex items-center justify-center w-16 h-16 bg-green-600 rounded-full mb-6">
                        <i class="fas fa-handshake text-2xl text-white"></i>
                    </div>
                    <h3 class="text-xl font-bold text-blue-900 mb-4">Saukhya</h3>
                    <p class="text-gray-700">Harmoni sosial dalam kehidupan berbangsa</p>
                </div>

                <div class="bg-white p-8 rounded-2xl shadow-lg text-center slide-in" style="animation-delay: 0.4s;">
                    <div class="inline-flex items-center justify-center w-16 h-16 bg-orange-600 rounded-full mb-6">
                        <i class="fas fa-hammer text-2xl text-white"></i>
                    </div>
                    <h3 class="text-xl font-bold text-blue-900 mb-4">Utsaha</h3>
                    <p class="text-gray-700">Semangat berkarya tanpa henti untuk kemajuan</p>
                </div>

                <div class="bg-white p-8 rounded-2xl shadow-lg text-center slide-in" style="animation-delay: 0.5s;">
                    <div class="inline-flex items-center justify-center w-16 h-16 bg-red-600 rounded-full mb-6">
                        <i class="fas fa-star text-2xl text-white"></i>
                    </div>
                    <h3 class="text-xl font-bold text-blue-900 mb-4">Pradhana</h3>
                    <p class="text-gray-700">Keteladanan dan profesionalitas dalam pelayanan</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Benefits Section -->
    <section id="manfaat" class="py-32 bg-white">
        <div class="container mx-auto px-6">
            <div class="text-center mb-16 slide-in">
                <h2 class="text-4xl font-bold text-blue-900 mb-4">Manfaat Lintas Sektor</h2>
                <p class="text-xl text-gray-700 max-w-3xl mx-auto">
                    RPB Foundation memberikan manfaat nyata bagi berbagai sektor pembangunan bangsa
                </p>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-5 gap-6">
                <div class="bg-gradient-to-br from-blue-50 to-blue-100 p-6 rounded-xl text-center slide-in">
                    <div class="text-3xl mb-4">🏛️</div>
                    <h3 class="text-lg font-semibold text-blue-900 mb-3">Pemerintah Pusat</h3>
                    <p class="text-sm text-gray-700">Mendukung pembangunan karakter bangsa, menguatkan kesadaran publik, membantu pengendalian isu sosial, dan memperkuat kohesi dalam keberagaman</p>
                </div>

                <div class="bg-gradient-to-br from-green-50 to-green-100 p-6 rounded-xl text-center slide-in" style="animation-delay: 0.1s;">
                    <div class="text-3xl mb-4">🏙️</div>
                    <h3 class="text-lg font-semibold text-blue-900 mb-3">Pemerintah Daerah</h3>
                    <p class="text-sm text-gray-700">Menghidupkan budaya lokal, mengembangkan ekonomi kreatif, dan mendorong komunitas berdaya mandiri</p>
                </div>

                <div class="bg-gradient-to-br from-purple-50 to-purple-100 p-6 rounded-xl text-center slide-in" style="animation-delay: 0.2s;">
                    <div class="text-3xl mb-4">⚖️</div>
                    <h3 class="text-lg font-semibold text-blue-900 mb-3">Lembaga Negara</h3>
                    <p class="text-sm text-gray-700">Menyediakan ruang dialog dan pemahaman nilai, menyokong literasi hukum, etika, dan kebangsaan</p>
                </div>

                <div class="bg-gradient-to-br from-orange-50 to-orange-100 p-6 rounded-xl text-center slide-in" style="animation-delay: 0.3s;">
                    <div class="text-3xl mb-4">👥</div>
                    <h3 class="text-lg font-semibold text-blue-900 mb-3">Komunitas & Masyarakat</h3>
                    <p class="text-sm text-gray-700">Meningkatkan kapasitas, penguatan karakter, dan pemberdayaan ekonomi untuk kesejahteraan bersama</p>
                </div>

                <div class="bg-gradient-to-br from-red-50 to-red-100 p-6 rounded-xl text-center slide-in" style="animation-delay: 0.4s;">
                    <div class="text-3xl mb-4">💼</div>
                    <h3 class="text-lg font-semibold text-blue-900 mb-3">Sektor Swasta</h3>
                    <p class="text-sm text-gray-700">Program CSR berbasis peradaban, penguatan reputasi sosial, dan kolaborasi pembangunan berkelanjutan</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Partners Section -->
    <section id="mitra" class="py-32 bg-gray-50">
        <div class="container mx-auto px-6">
            <div class="text-center mb-16 slide-in">
                <h2 class="text-4xl font-bold text-blue-900 mb-4">Model Kolaborasi Ekosistem</h2>
                <p class="text-xl text-gray-700 max-w-3xl mx-auto">
                    Rumah Peradaban Bangsa Foundation bekerja melalui model kolaborasi yang menghubungkan seluruh pemangku kepentingan dalam satu visi peradaban
                </p>
            </div>

            <div class="grid md:grid-cols-3 gap-8">
                <div class="text-center h-full">
                    <div class="bg-blue-50 p-6 rounded-xl h-full">
                        <div class="text-4xl mb-4">🏛️</div>
                        <h3 class="text-lg font-semibold text-blue-900 mb-3">Pemerintah</h3>
                        <ul class="text-sm text-gray-700 space-y-1 text-left">
                            <li>• Kementerian terkait</li>
                            <li>• Lembaga kepresidenan</li>
                            <li>• Pemerintah daerah</li>
                            <li>• BNPT, BIN, dan lembaga strategis</li>
                        </ul>
                    </div>
                </div>

                <div class="text-center h-full">
                    <div class="bg-purple-50 p-6 rounded-xl h-full">
                        <div class="text-4xl mb-4">🎓</div>
                        <h3 class="text-lg font-semibold text-blue-900 mb-3">Akademisi & Komunitas</h3>
                        <ul class="text-sm text-gray-700 space-y-1 text-left">
                            <li>• Universitas dan lembaga riset</li>
                            <li>• Tokoh budaya dan adat</li>
                            <li>• Organisasi masyarakat</li>
                            <li>• Forum lintas agama</li>
                        </ul>
                    </div>
                </div>

                <div class="text-center h-full">
                    <div class="bg-green-50 p-6 rounded-xl h-full">
                        <div class="text-4xl mb-4">💼</div>
                        <h3 class="text-lg font-semibold text-blue-900 mb-3">Swasta & Media</h3>
                        <ul class="text-sm text-gray-700 space-y-1 text-left">
                            <li>• Korporasi dan UMKM</li>
                            <li>• Media massa</li>
                            <li>• Platform digital</li>
                            <li>• Industri kreatif</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="kontak" class="gradient-bg py-32 text-white">
        <div class="container mx-auto px-6">
            <div class="text-center mb-16 slide-in">
                <h2 class="text-4xl font-bold mb-4">Bergabunglah Bersama Kami</h2>
                <p class="text-xl text-blue-100 mb-8">
                    "Peradaban bukanlah warisan, tetapi perjuangan yang diwariskan."
                </p>
                <p class="text-lg text-blue-200 mb-12">
                    — Rumah Peradaban Bangsa Foundation
                </p>
            </div>

            <div class="grid md:grid-cols-2 gap-12 max-w-4xl mx-auto">
                <div class="slide-in">
                    <div class="bg-white/10 backdrop-filter backdrop-blur-lg p-8 rounded-2xl">
                        <h3 class="text-2xl font-semibold mb-6">Informasi Kontak</h3>
                        <div class="space-y-4">
                            <div class="flex items-center">
                                <i class="fas fa-globe text-2xl mr-4"></i>
                                <div>
                                    <p class="font-semibold">Website</p>
                                    <p class="text-blue-100">www.rumahperadabanbangsa.com</p>
                                </div>
                            </div>
                            <div class="flex items-center">
                                <i class="fab fa-instagram text-2xl mr-4"></i>
                                <div>
                                    <p class="font-semibold">Instagram</p>
                                    <p class="text-blue-100">@rumahperadabanbangsa</p>
                                </div>
                            </div>
                            <div class="flex items-center">
                                <i class="fas fa-envelope text-2xl mr-4"></i>
                                <div>
                                    <p class="font-semibold">Email</p>
                                    <p class="text-blue-100">info@rumahperadabanbangsa.com</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="slide-in">
                    <div class="bg-white/10 backdrop-filter backdrop-blur-lg p-8 rounded-2xl">
                        <h3 class="text-2xl font-semibold mb-6">Dukungan Anda</h3>
                        <p class="mb-6 text-blue-100">
                            Bergabunglah dalam perjuangan membangun peradaban bangsa yang adiluhung
                        </p>
                        <div class="flex flex-col sm:flex-row gap-4">
                            <a href="https://wa.me/6281388181442?text=Halo%20Jhoe,%20saya%20tertarik%20untuk%20memberikan%20donasi%20ke%20RPB%20Foundation." class="bg-white text-blue-900 px-6 py-3 rounded-full font-semibold hover:bg-blue-50 transition flex-1 text-center" target="_blank">
                                <i class="fas fa-hand-holding-heart mr-2"></i>Donasi
                            </a>
                            <a href="https://wa.me/6281388181442?text=Halo%20Jhoe,%20saya%20tertarik%20untuk%20menjadi%20relawan%20di%20RPB%20Foundation." class="border-2 border-white text-white px-6 py-3 rounded-full font-semibold hover:bg-white hover:text-blue-900 transition flex-1 text-center" target="_blank">
                                <i class="fas fa-users mr-2"></i>Relawan
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-layouts.frontend>
