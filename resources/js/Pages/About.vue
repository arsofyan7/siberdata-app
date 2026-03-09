<script setup>
import { Head, Link } from '@inertiajs/vue3';
import { 
    ShieldCheck, 
    UserCircle, 
    Menu, 
    X, 
    Shield, 
    Users, 
    Award, 
    Lightbulb, 
    Zap,
    MapPin,
    Mail,
    Phone
} from 'lucide-vue-next';
import { ref } from 'vue';
import CarouselBackground from '@/Components/CarouselBackground.vue';

const props = defineProps({
    canLogin: Boolean,
    canRegister: Boolean,
    laravelVersion: String,
    phpVersion: String,
});

const isMobileMenuOpen = ref(false);

const coreValues = [
    {
        letter: 'S',
        title: 'Sinergi',
        desc: 'Kolaborasi kuat dengan pemangku kepentingan keamanan siber.',
        icon: Users,
        color: 'text-indigo-600',
        bg: 'bg-indigo-100'
    },
    {
        letter: 'I',
        title: 'Integritas',
        desc: 'Kejujuran dan etika tinggi dalam asesmen.',
        icon: Shield,
        color: 'text-emerald-600',
        bg: 'bg-emerald-100'
    },
    {
        letter: 'B',
        title: 'Berstandar',
        desc: 'Patuh pada regulasi BNSP dan standar teknis.',
        icon: Award,
        color: 'text-blue-600',
        bg: 'bg-blue-100'
    },
    {
        letter: 'E',
        title: 'Expertise',
        desc: 'Didorong oleh keahlian mendalam di dunia privasi.',
        icon: Lightbulb,
        color: 'text-amber-600',
        bg: 'bg-amber-100'
    },
    {
        letter: 'R',
        title: 'Responsif',
        desc: 'Cepat tanggap terhadap ancaman siber baru.',
        icon: Zap,
        color: 'text-red-600',
        bg: 'bg-red-100'
    }
];
</script>

<template>
    <Head title="About - LSP Siberdata" />

    <div class="min-h-screen bg-slate-50 font-sans text-slate-900 pb-20 relative overflow-hidden selection:bg-blue-500 selection:text-white">
        
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
                        <Link href="/about" class="text-sm font-bold text-blue-700 transition-colors">About</Link>
                        
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
                    <Link href="/about" @click="isMobileMenuOpen = false" class="block px-3 py-3 rounded-md text-base font-bold text-blue-700 bg-slate-50 transition-colors">About</Link>
                    
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

        <!-- Main Content -->
        <main class="relative z-10">

            <!-- Hero Section -->
            <div class="py-20 lg:py-28 relative overflow-hidden">
                <div class="absolute inset-0 bg-gradient-to-br from-indigo-900 via-blue-900 to-emerald-900 opacity-90 mix-blend-multiply"></div>
                <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center">
                    <h1 class="text-4xl md:text-5xl lg:text-6xl font-extrabold text-white tracking-tight leading-tight mb-6">
                        Membangun Kepercayaan <br class="hidden sm:block"/> di Dunia Digital
                    </h1>
                    <p class="text-lg md:text-xl text-indigo-100 font-medium max-w-2xl mx-auto">
                        LSP Siberdata hadir sebagai pionir validasi kompetensi ahli keamanan siber dan perlindungan data pribadi di Indonesia.
                    </p>
                </div>
            </div>

            <!-- Visi & Misi Layout -->
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mt-10 lg:-mt-16 mb-20 relative z-20">
                <div class="bg-white/90 backdrop-blur-xl border border-white/40 shadow-xl rounded-3xl p-8 md:p-12 lg:p-16">
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-20 items-center">
                        <!-- Visi -->
                        <div>
                            <div class="inline-flex items-center justify-center px-4 py-1.5 rounded-full text-sm font-bold text-indigo-700 bg-indigo-100 mb-6">
                                VISI LSP SIBERDATA
                            </div>
                            <h2 class="text-3xl md:text-4xl font-extrabold text-slate-900 leading-snug mb-6">
                                Terkemuka & Terpercaya
                            </h2>
                            <p class="text-lg text-slate-600 leading-relaxed font-medium">
                                "Menjadi lembaga sertifikasi profesi terkemuka dan terpercaya dalam mencetak SDM unggul yang kompeten di bidang keamanan siber dan pelindungan data pribadi untuk mendukung ketahanan digital Indonesia."
                            </p>
                        </div>

                        <!-- Misi -->
                        <div class="lg:border-l border-slate-200 lg:pl-12">
                            <div class="inline-flex items-center justify-center px-4 py-1.5 rounded-full text-sm font-bold text-emerald-700 bg-emerald-100 mb-6">
                                MISI KAMI
                            </div>
                            <ul class="space-y-6">
                                <li class="flex items-start">
                                    <div class="flex-shrink-0 w-8 h-8 rounded-full bg-slate-100 text-slate-700 font-bold flex items-center justify-center mr-4 mt-1">
                                        1
                                    </div>
                                    <p class="text-slate-700 font-medium">Melaksanakan sertifikasi kompetensi sesuai standar nasional (SKKNI) dan internasional.</p>
                                </li>
                                <li class="flex items-start">
                                    <div class="flex-shrink-0 w-8 h-8 rounded-full bg-slate-100 text-slate-700 font-bold flex items-center justify-center mr-4 mt-1">
                                        2
                                    </div>
                                    <p class="text-slate-700 font-medium">Menjamin mutu asesmen dengan asesor profesional dan independen.</p>
                                </li>
                                <li class="flex items-start">
                                    <div class="flex-shrink-0 w-8 h-8 rounded-full bg-slate-100 text-slate-700 font-bold flex items-center justify-center mr-4 mt-1">
                                        3
                                    </div>
                                    <p class="text-slate-700 font-medium">Membangun kemitraan dengan industri dan pemerintah.</p>
                                </li>
                                <li class="flex items-start">
                                    <div class="flex-shrink-0 w-8 h-8 rounded-full bg-slate-100 text-slate-700 font-bold flex items-center justify-center mr-4 mt-1">
                                        4
                                    </div>
                                    <p class="text-slate-700 font-medium">Menyelenggarakan tata kelola lembaga yang transparan dan akuntabel.</p>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Core Values (SIBER) -->
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mb-24">
                <div class="text-center mb-16">
                    <h2 class="text-3xl font-extrabold text-slate-900 sm:text-4xl mb-4">Core Values</h2>
                    <p class="text-xl text-slate-500 max-w-2xl mx-auto">Prinsip dasar yang menjadi landasan kami dalam mencetak tenaga profesional.</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-6">
                    <div v-for="(val, index) in coreValues" :key="index" class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6 hover:shadow-xl transition-all duration-300 hover:-translate-y-2 group">
                        <div class="flex items-center justify-between mb-6">
                            <div :class="`w-12 h-12 rounded-xl ${val.bg} ${val.color} flex items-center justify-center`">
                                <component :is="val.icon" class="w-6 h-6" />
                            </div>
                            <span class="text-4xl font-black text-slate-100 group-hover:text-slate-200 transition-colors">{{ val.letter }}</span>
                        </div>
                        <h3 class="text-xl font-bold text-slate-900 mb-3">{{ val.title }}</h3>
                        <p class="text-sm text-slate-600 leading-relaxed">{{ val.desc }}</p>
                    </div>
                </div>
            </div>

            <!-- Contact & Location (Glassmorphism) -->
            <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 mb-24">
                <div class="bg-indigo-900/80 backdrop-blur-xl rounded-3xl overflow-hidden shadow-2xl relative">
                    <!-- Decor element -->
                    <div class="absolute -top-32 -right-32 w-64 h-64 rounded-full bg-emerald-500 opacity-20 blur-3xl mix-blend-screen pointer-events-none"></div>
                    <div class="absolute -bottom-32 -left-32 w-64 h-64 rounded-full bg-blue-500 opacity-30 blur-3xl mix-blend-screen pointer-events-none"></div>
                    
                    <div class="px-8 py-12 md:p-16 relative z-10 text-center text-white">
                        <h2 class="text-3xl font-extrabold mb-4">Hubungi Kami</h2>
                        <p class="text-indigo-200 mb-10 max-w-lg mx-auto">Pusat layanan informasi dan konsultasi sertifikasi kompetensi profesi LSP Siberdata.</p>
                        
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 text-center max-w-3xl mx-auto">
                            <!-- Location -->
                            <div class="flex flex-col items-center">
                                <div class="w-14 h-14 rounded-full bg-white/10 flex items-center justify-center mb-4">
                                    <MapPin class="w-6 h-6 text-emerald-400" />
                                </div>
                                <h4 class="font-bold text-lg mb-2">Kantor Pusat</h4>
                                <p class="text-sm text-indigo-100 leading-relaxed">Jalan Banda No. 30,<br/>Kota Bandung, Jawa Barat</p>
                            </div>

                            <!-- Phone -->
                            <div class="flex flex-col items-center">
                                <div class="w-14 h-14 rounded-full bg-white/10 flex items-center justify-center mb-4">
                                    <Phone class="w-6 h-6 text-blue-400" />
                                </div>
                                <h4 class="font-bold text-lg mb-2">Telepon / WhatsApp</h4>
                                <a href="tel:+6285189998970" class="text-sm text-indigo-100 hover:text-white transition-colors">+62 851-8999-8970</a>
                            </div>

                            <!-- Email -->
                            <div class="flex flex-col items-center">
                                <div class="w-14 h-14 rounded-full bg-white/10 flex items-center justify-center mb-4">
                                    <Mail class="w-6 h-6 text-indigo-400" />
                                </div>
                                <h4 class="font-bold text-lg mb-2">Email Layanan</h4>
                                <a href="mailto:lspsiberdata@gmail.com" class="text-sm text-indigo-100 hover:text-white transition-colors">lspsiberdata@gmail.com</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Footer partial in page -->
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 border-t border-slate-200/60 pt-8 pb-8 flex flex-col md:flex-row justify-between items-center relative z-10">
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

        </main>
    </div>
</template>
