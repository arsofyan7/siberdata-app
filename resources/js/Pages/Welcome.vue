<script setup>
import { Head, Link } from '@inertiajs/vue3';
import { ShieldCheck, LockKeyhole, ArrowRight, UserCircle, ServerCog, Search, Inbox, Menu, X, Award, Users, FileText, Download } from 'lucide-vue-next';
import { ref, onMounted, onUnmounted } from 'vue';
import CarouselBackground from '@/Components/CarouselBackground.vue';

const props = defineProps({
    canLogin: {
        type: Boolean,
    },
    canRegister: {
        type: Boolean,
    },
    laravelVersion: {
        type: String,
        required: true,
    },
    phpVersion: {
        type: String,
        required: true,
    }
});

const isMobileMenuOpen = ref(false);

// 1. Stats Data (Impact Counter)
const statsRef = ref(null);
const stats = ref([
    { label: 'Skema Sertifikasi', targetValue: 13, value: 0, suffix: '', icon: Award },
    { label: 'Asesor Kompeten', targetValue: 50, value: 0, suffix: '+', icon: Users },
    { label: 'Asesi Terdaftar', targetValue: 1000, value: 0, suffix: '+', icon: ShieldCheck },
]);

// 2. Documents Data (Resource Center)
const documents = ref([
    { title: 'SKKNI Bidang Keamanan Siber', category: 'Standar Kompetensi', url: '#' },
    { title: 'SKKNI Pelindungan Data Pribadi', category: 'Standar Kompetensi', url: '#' },
    { title: 'Panduan Asesmen Online Asesi', category: 'Panduan Teknis', url: '#' },
    { title: 'Katalog Skema Sertifikasi 2026', category: 'Dokumen Skema', url: '#' },
]);

// 3. News Data (Knowledge Hub)
const news = ref([
    { title: 'LSP Siberdata Resmi Terakreditasi Penuh', category: 'Berita', summary: 'LSP Siberdata kini secara sah menjadi lembaga sertifikasi yang diakui penuh untuk menyelenggarakan uji kompetensi Siber.', image: 'https://images.unsplash.com/photo-1550751827-4bd374c3f58b?auto=format&fit=crop&q=80&w=800' },
    { title: 'Pentingnya Sertifikasi PDP di Era Digital', category: 'Artikel', summary: 'Mengapa setiap perusahaan teknologi wajib memfasilitasi pelindungan data pelanggan secara profesional sesuai standar UU PDP.', image: 'https://picsum.photos/seed/pdptech/800/600' },
    { title: 'Tips Menghadapi Uji Kompetensi Siber', category: 'Tips & Trik', summary: 'Persiapan yang matang dan pemahaman mendalam tentang standar SKKNI menjadi kunci keberhasilan peserta.', image: 'https://images.unsplash.com/photo-1516321318423-f06f85e504b3?auto=format&fit=crop&q=80&w=800' },
]);

// 4. Partners & Accreditations (Trust Badges)
const partners = ref([
    { name: 'BNSP', logo: 'https://placehold.co/400x150/ffffff/475569?text=Logo+BNSP&font=montserrat' },
    { name: 'KOMINFO', logo: 'https://placehold.co/400x150/ffffff/475569?text=Logo+KOMINFO&font=montserrat' },
    { name: 'BSSN', logo: 'https://placehold.co/400x150/ffffff/475569?text=Logo+BSSN&font=montserrat' },
]);

let observer = null;

onMounted(() => {
    observer = new IntersectionObserver((entries) => {
        if (entries[0].isIntersecting) {
            stats.value.forEach(stat => {
                let start = 0;
                const duration = 2000;
                const stepTime = Math.abs(Math.floor(duration / stat.targetValue));
                
                const timer = setInterval(() => {
                    start += Math.ceil(stat.targetValue / 100);
                    if (start >= stat.targetValue) {
                        stat.value = stat.targetValue;
                        clearInterval(timer);
                    } else {
                        stat.value = start;
                    }
                }, stepTime > 0 ? stepTime : 10);
            });
            observer.disconnect();
        }
    }, { threshold: 0.1 });

    if (statsRef.value) {
        observer.observe(statsRef.value);
    }
});

onUnmounted(() => {
    if (observer) observer.disconnect();
});
</script>

<template>
    <Head title="Siberdata LSP - Sertifikasi Profesional" />

    <div class="min-h-screen bg-slate-50 font-sans text-slate-900 selection:bg-blue-500 selection:text-white pb-20 relative overflow-hidden">
        
        <CarouselBackground />

        <!-- Navbar -->
        <nav class="relative z-50 bg-white/80 backdrop-blur-md border-b border-slate-200 sticky top-0 transition-all duration-300">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16 sm:h-20">
                    <!-- Logo -->
                    <div class="flex items-center">
                        <Link href="/" class="flex items-center gap-2 group">
                            <ShieldCheck class="h-8 w-8 text-blue-700 group-hover:scale-110 transition-transform duration-300" />
                            <span class="font-extrabold text-xl tracking-tight text-slate-800">
                                LSP <span class="text-blue-700">Siberdata</span>
                            </span>
                        </Link>
                    </div>

                    <!-- Desktop Menu -->
                    <div class="hidden md:flex items-center space-x-8">
                        <Link href="/" class="text-sm font-bold text-slate-600 hover:text-blue-700 transition-colors">Home</Link>
                        <Link href="/skema" class="text-sm font-bold text-slate-600 hover:text-blue-700 transition-colors">Skema</Link>
                        <Link href="/about" class="text-sm font-bold text-slate-600 hover:text-blue-700 transition-colors">About</Link>
                        
                        <div class="h-6 w-px bg-slate-300 mx-2"></div>
                        
                        <div v-if="canLogin" class="flex items-center space-x-6">
                            <Link v-if="$page.props.auth.user" :href="route('dashboard')" class="text-sm font-bold text-slate-600 hover:text-blue-700 transition-colors">
                                Portal Admin
                            </Link>
                            <template v-else>
                                <Link :href="route('login')" class="text-sm font-bold text-slate-600 hover:text-blue-700 transition-colors flex items-center group">
                                    <UserCircle class="w-4 h-4 mr-1.5 group-hover:text-blue-700 text-slate-400 transition-colors" />
                                    Login Asesor
                                </Link>
                                <Link v-if="canRegister" :href="route('register')" class="inline-flex items-center justify-center px-5 py-2.5 border border-transparent text-sm font-bold rounded-xl text-white bg-indigo-600 hover:bg-indigo-700 shadow-sm transition-all hover:shadow-md hover:-translate-y-0.5">
                                    Portal Asesi
                                </Link>
                            </template>
                        </div>
                    </div>

                    <!-- Mobile Menu Button -->
                    <div class="flex items-center md:hidden">
                        <button @click="isMobileMenuOpen = !isMobileMenuOpen" class="text-slate-500 hover:text-slate-700 focus:outline-none p-2 rounded-md hover:bg-slate-100 transition-colors">
                            <Menu v-if="!isMobileMenuOpen" class="h-6 w-6" />
                            <X v-else class="h-6 w-6" />
                        </button>
                    </div>
                </div>
            </div>

            <!-- Mobile Dropdown Menu -->
            <div v-show="isMobileMenuOpen" class="md:hidden absolute top-full left-0 w-full bg-white border-b border-slate-200 shadow-lg animate-in slide-in-from-top-2 duration-200">
                <div class="px-4 pt-2 pb-6 space-y-1">
                    <Link href="/" @click="isMobileMenuOpen = false" class="block px-3 py-3 rounded-md text-base font-bold text-slate-700 hover:text-blue-700 hover:bg-slate-50 transition-colors">Home</Link>
                    <Link href="/skema" @click="isMobileMenuOpen = false" class="block px-3 py-3 rounded-md text-base font-bold text-slate-700 hover:text-blue-700 hover:bg-slate-50 transition-colors">Skema</Link>
                    <Link href="/about" @click="isMobileMenuOpen = false" class="block px-3 py-3 rounded-md text-base font-bold text-slate-700 hover:text-blue-700 hover:bg-slate-50 transition-colors">About</Link>
                    
                    <div class="border-t border-slate-100 my-2 pt-2"></div>
                    
                    <div v-if="canLogin" class="space-y-1">
                        <Link v-if="$page.props.auth.user" :href="route('dashboard')" @click="isMobileMenuOpen = false" class="block px-3 py-3 rounded-md text-base font-bold text-slate-700 hover:text-blue-700 hover:bg-slate-50 transition-colors">
                            Portal Admin
                        </Link>
                        <template v-else>
                            <Link :href="route('login')" @click="isMobileMenuOpen = false" class="flex items-center px-3 py-3 rounded-md text-base font-bold text-slate-700 hover:text-blue-700 hover:bg-slate-50 transition-colors">
                                <UserCircle class="w-5 h-5 mr-2 text-slate-400" />
                                Login Asesor
                            </Link>
                            <Link v-if="canRegister" :href="route('register')" @click="isMobileMenuOpen = false" class="mt-4 block w-full text-center px-5 py-3 border border-transparent text-base font-bold rounded-xl text-white bg-indigo-600 hover:bg-indigo-700 shadow-sm transition-colors">
                                Portal Asesi
                            </Link>
                        </template>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Main Content Container  -->
        <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-16">
            
            <!-- Headers -->
            <div class="text-center mb-20 max-w-4xl mx-auto">
                <h1 class="text-4xl md:text-5xl lg:text-6xl font-extrabold text-slate-900 tracking-tight leading-tight mb-6">
                    Sertifikasi Profesi <br/>
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-800 to-indigo-600">
                        Keamanan Siber & PDP Terpercaya
                    </span>
                </h1>
                <p class="text-lg md:text-xl text-slate-500 font-medium">
                    Validasi keahlian Anda melalui uji kompetensi berstandar nasional bersama Lembaga Sertifikasi Profesi Siberdata.
                </p>
                
                <div class="mt-8 flex justify-center gap-4">
                    <Link href="/skema" class="inline-flex items-center justify-center px-8 py-3 border border-transparent text-base font-bold rounded-xl text-white bg-blue-600 hover:bg-blue-700 shadow-md transition-all hover:-translate-y-1">
                        Lihat Skema Unggulan
                    </Link>
                </div>
            </div>

            <!-- 1. Stats Segment (Impact Counter) -->
            <div ref="statsRef" class="mt-12 grid grid-cols-1 md:grid-cols-3 gap-8 relative z-20">
                <div v-for="stat in stats" :key="stat.label" class="bg-white/80 backdrop-blur-md rounded-2xl p-8 text-center border border-slate-200 shadow-sm hover:shadow-lg transition-all duration-300 group hover:-translate-y-2">
                    <div class="inline-flex items-center justify-center p-4 bg-indigo-50 text-indigo-600 rounded-2xl mb-5 group-hover:scale-110 transition-transform duration-300">
                        <component :is="stat.icon" class="w-8 h-8" />
                    </div>
                    <div class="text-4xl font-black text-slate-800 tracking-tight flex justify-center items-center">
                        {{ stat.value }}<span class="text-blue-600 ml-1">{{ stat.suffix }}</span>
                    </div>
                    <div class="text-sm font-bold text-slate-500 mt-2 uppercase tracking-wide">{{ stat.label }}</div>
                </div>
            </div>

            <!-- 2. Resource Center (Documents) -->
            <div class="mt-32 relative z-20">
                <div class="text-center mb-12">
                    <h2 class="text-3xl font-extrabold text-slate-900 tracking-tight">Resource Center</h2>
                    <p class="text-slate-500 mt-3 font-medium">Dokumen Standar dan Panduan Kompetensi Resmi</p>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                    <div v-for="(doc, index) in documents" :key="index" class="bg-white rounded-2xl p-6 border border-slate-200 shadow-sm hover:shadow-xl hover:border-teal-200 transition-all duration-300 group relative overflow-hidden flex flex-col">
                        <div class="absolute top-0 right-0 w-32 h-32 bg-teal-500/5 rounded-bl-[100px] -mr-8 -mt-8 transition-transform group-hover:scale-110"></div>
                        <div class="inline-flex items-center justify-center p-3 bg-teal-50 text-teal-600 rounded-xl mb-6 shadow-[0_0_15px_rgba(20,184,166,0.15)] group-hover:shadow-[0_0_25px_rgba(20,184,166,0.35)] transition-all">
                            <FileText class="w-6 h-6" />
                        </div>
                        <div class="text-[11px] font-extrabold text-teal-600 mb-2 uppercase tracking-widest">{{ doc.category }}</div>
                        <h3 class="text-lg font-bold text-slate-800 leading-snug mb-6 flex-grow">{{ doc.title }}</h3>
                        <a :href="doc.url" class="inline-flex items-center text-sm font-bold text-blue-600 hover:text-blue-800 group-hover:translate-x-1 transition-transform mt-auto">
                            Lihat Dokumen
                            <ArrowRight class="w-4 h-4 ml-1.5" />
                        </a>
                    </div>
                </div>
            </div>

            <!-- 3. Knowledge Hub (News) -->
            <div class="mt-32 relative z-20">
                <div class="text-center mb-12">
                    <div class="inline-flex items-center justify-center px-3 py-1 bg-indigo-50 border border-indigo-100 text-indigo-600 text-xs font-bold rounded-full mb-3 uppercase tracking-widest">
                        Wawasan & Berita
                    </div>
                    <h2 class="text-3xl font-extrabold text-slate-900 tracking-tight">Knowledge Hub</h2>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <div v-for="(item, index) in news" :key="index" class="bg-white rounded-2xl border border-slate-200 shadow-sm hover:shadow-xl hover:border-indigo-100 transition-all duration-300 overflow-hidden group flex flex-col">
                        <div class="relative h-56 overflow-hidden">
                            <div class="absolute inset-0 bg-slate-900/10 z-10 group-hover:bg-transparent transition-colors"></div>
                            <img :src="item.image" :alt="item.title" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110" />
                            <div class="absolute top-4 left-4 z-20">
                                <span class="px-3 py-1 bg-white/95 backdrop-blur-sm text-indigo-700 text-xs font-bold rounded-full shadow-sm">
                                    {{ item.category }}
                                </span>
                            </div>
                        </div>
                        <div class="p-6 flex flex-col flex-grow">
                            <h3 class="text-xl font-bold text-slate-800 mb-3 group-hover:text-indigo-600 transition-colors line-clamp-2 leading-tight">{{ item.title }}</h3>
                            <p class="text-slate-500 text-sm leading-relaxed mb-6 flex-grow line-clamp-3">{{ item.summary }}</p>
                            <div class="mt-auto">
                                <button class="text-sm font-bold text-indigo-600 hover:text-indigo-800 transition-colors inline-flex items-center group-hover:translate-x-1">
                                    Baca Selengkapnya
                                    <ArrowRight class="w-4 h-4 ml-1.5" />
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- 4. Trust Badges (Partners) -->
            <div class="mt-32 pt-16 border-t border-slate-200/60 pb-16 relative z-20">
                <div class="text-center mb-10">
                    <p class="text-sm font-bold text-slate-400 uppercase tracking-widest">Didukung dan Terakreditasi Oleh</p>
                </div>
                <div class="flex flex-wrap justify-center items-center gap-12 sm:gap-24 opacity-80 hover:opacity-100 transition-opacity duration-500">
                    <div v-for="(partner, index) in partners" :key="index" class="group flex flex-col items-center">
                        <img :src="partner.logo" :alt="partner.name" class="h-16 md:h-20 object-contain grayscale opacity-60 group-hover:grayscale-0 group-hover:opacity-100 transition-all duration-500 ease-out transform group-hover:scale-105" />
                        <span class="mt-4 text-xs font-bold text-slate-400 opacity-0 group-hover:opacity-100 transition-opacity duration-300 tracking-wider">{{ partner.name }}</span>
                    </div>
                </div>
            </div>
            <div class="mt-20 border-t border-slate-200/60 pt-8 pb-8 flex flex-col md:flex-row justify-between items-center relative z-10">
                <div class="flex items-center mb-4 md:mb-0">
                    <ShieldCheck class="h-6 w-6 text-slate-400 mr-2" />
                    <p class="text-sm font-medium text-slate-500">
                        &copy; 2026 LSP Siberdata. Terakreditasi Nasional.
                    </p>
                </div>
                <div class="text-xs text-slate-400 font-mono">
                    Laravel v{{ laravelVersion }} (PHP v{{ phpVersion }})
                </div>
            </div>

        </div>
    </div>
</template>
