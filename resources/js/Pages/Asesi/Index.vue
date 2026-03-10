<script setup>
import { Head, Link } from '@inertiajs/vue3';
import { 
    Award, 
    Clock, 
    CalendarCheck, 
    PlayCircle, 
    FolderEdit, 
    Download, 
    ChevronRight,
    Sparkles,
    ShieldCheck,
    LayoutDashboard,
    FolderOpen,
    CalendarDays,
    LogOut,
    Sun,
    Moon,
    Monitor
} from 'lucide-vue-next';
import { ref, onMounted, computed, watch } from 'vue';

const props = defineProps({
    stats: {
        type: Object,
        default: () => ({
            sertifikasi_saya: 0,
            status_terakhir: 'Menunggu Pendaftaran',
            masa_berlaku: '-'
        })
    }
});

const isLoaded = ref(false);
const theme = ref('system'); // 'light', 'dark', 'system'
const isDark = ref(false);

const applyThemeClasses = () => {
    if (theme.value === 'dark' || (theme.value === 'system' && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
        document.documentElement.classList.add('dark');
        isDark.value = true;
    } else {
        document.documentElement.classList.remove('dark');
        isDark.value = false;
    }
}

const setTheme = (t) => {
    theme.value = t;
    localStorage.setItem('siberdata-theme', t);
    applyThemeClasses();
}

onMounted(() => {
    // Check saved theme
    const savedTheme = localStorage.getItem('siberdata-theme');
    if (savedTheme) {
        theme.value = savedTheme;
    }
    
    applyThemeClasses();

    // Listen for OS theme changes if on system
    window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', () => {
        if (theme.value === 'system') {
            applyThemeClasses();
        }
    });

    setTimeout(() => {
        isLoaded.value = true;
    }, 100);
});
</script>

<template>
    <Head title="Mission Center - Portal Asesi" />

    <div class="min-h-screen flex font-sans transition-colors duration-300 relative overflow-hidden bg-slate-50 text-slate-900 dark:bg-slate-950 dark:text-slate-200">
        
        <!-- Mesh Gradients Background (Adjusted for Light/Dark) -->
        <div class="fixed top-[-20%] left-[-10%] w-[50%] h-[50%] bg-violet-400/20 dark:bg-violet-900/30 rounded-full mix-blend-multiply dark:mix-blend-screen filter blur-[100px] pointer-events-none transition-colors duration-700"></div>
        <div class="fixed bottom-[-10%] right-[-5%] w-[40%] h-[50%] bg-cyan-400/20 dark:bg-cyan-900/20 rounded-full mix-blend-multiply dark:mix-blend-screen filter blur-[100px] pointer-events-none transition-colors duration-700"></div>
        <div class="fixed top-[30%] right-[30%] w-[25%] h-[25%] bg-emerald-400/10 dark:bg-emerald-900/10 rounded-full mix-blend-multiply dark:mix-blend-screen filter blur-[80px] pointer-events-none transition-colors duration-700"></div>

        <!-- Sidebar Navigation -->
        <aside class="w-64 bg-white/80 dark:bg-slate-950/80 backdrop-blur-xl border-r border-slate-200 dark:border-slate-800/50 flex-col hidden md:flex sticky top-0 h-screen z-20 transition-colors duration-300">
            <div class="h-20 flex items-center px-6 border-b border-slate-200 dark:border-slate-800/50 transition-colors duration-300">
                <ShieldCheck class="w-8 h-8 text-cyan-600 dark:text-cyan-400 mr-3" />
                <span class="font-extrabold text-lg tracking-tight text-slate-900 dark:text-white">LSP <span class="text-cyan-600 dark:text-cyan-400">Siber</span></span>
            </div>
            
            <nav class="flex-grow py-6 px-4 space-y-2">
                <Link href="/portal-asesi" class="flex items-center gap-3 px-4 py-3 rounded-xl bg-cyan-50 dark:bg-cyan-500/10 text-cyan-700 dark:text-cyan-400 font-bold border border-cyan-200 dark:border-cyan-500/20 shadow-sm dark:shadow-[0_0_15px_rgba(34,211,238,0.1)] transition-colors duration-300">
                    <LayoutDashboard class="w-5 h-5" /> Home
                </Link>
                <Link href="#" class="flex items-center gap-3 px-4 py-3 rounded-xl text-slate-600 dark:text-slate-400 font-medium hover:bg-slate-100 dark:hover:bg-slate-900 hover:text-slate-900 dark:hover:text-slate-200 transition-colors duration-300">
                    <Award class="w-5 h-5 text-slate-400 dark:text-slate-500" /> Sertifikasi
                </Link>
                <Link href="#" class="flex items-center gap-3 px-4 py-3 rounded-xl text-slate-600 dark:text-slate-400 font-medium hover:bg-slate-100 dark:hover:bg-slate-900 hover:text-slate-900 dark:hover:text-slate-200 transition-colors duration-300">
                    <FolderOpen class="w-5 h-5 text-slate-400 dark:text-slate-500" /> Dokumen Saya
                </Link>
                <Link href="#" class="flex items-center gap-3 px-4 py-3 rounded-xl text-slate-600 dark:text-slate-400 font-medium hover:bg-slate-100 dark:hover:bg-slate-900 hover:text-slate-900 dark:hover:text-slate-200 transition-colors duration-300">
                    <CalendarDays class="w-5 h-5 text-slate-400 dark:text-slate-500" /> Jadwal Uji
                </Link>
            </nav>

            <div class="p-4 border-t border-slate-200 dark:border-slate-800/50 transition-colors duration-300">
                <Link :href="route('dashboard')" class="flex items-center gap-3 px-4 py-3 rounded-xl text-slate-600 dark:text-slate-400 font-medium hover:bg-slate-100 dark:hover:bg-slate-900 hover:text-slate-900 dark:hover:text-slate-200 transition-colors duration-300">
                    <LogOut class="w-5 h-5 text-slate-400 dark:text-slate-500" /> Kembali ke Utama
                </Link>
            </div>
        </aside>

        <!-- Main Content Area -->
        <main class="flex-grow overflow-y-auto h-screen relative z-10 w-full flex flex-col">
            
            <!-- Welcome Header (Interactive Gradient adjustments) -->
            <div class="bg-gradient-to-r from-violet-100 via-blue-50 to-cyan-50 dark:from-violet-900/40 dark:via-blue-900/20 dark:to-cyan-900/10 border-b border-slate-200 dark:border-slate-800/50 pt-10 pb-20 px-6 sm:px-10 relative transition-colors duration-300">
                <div class="max-w-6xl mx-auto flex flex-col sm:flex-row justify-between items-start gap-4 transition-all duration-1000 ease-out transform" :class="isLoaded ? 'translate-y-0 opacity-100' : 'translate-y-10 opacity-0'">
                    
                    <div>
                        <div class="flex items-center gap-2 mb-4">
                            <span class="flex items-center justify-center w-8 h-8 rounded-full bg-cyan-100 dark:bg-cyan-500/20 border border-cyan-200 dark:border-cyan-500/30 text-cyan-600 dark:text-cyan-400 shadow-sm dark:shadow-[0_0_15px_rgba(34,211,238,0.2)]">
                                <Sparkles class="w-4 h-4" />
                            </span>
                            <span class="text-cyan-700 dark:text-cyan-400 font-bold uppercase tracking-widest text-xs">Mission Center</span>
                        </div>
                        <h1 class="text-4xl sm:text-5xl font-extrabold text-slate-900 dark:text-white mb-3 tracking-tight">
                            Selamat Datang, 
                            <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-cyan-500 dark:from-cyan-400 dark:to-blue-400">
                                {{ $page.props.auth.user.name }}
                            </span>
                        </h1>
                        <p class="text-slate-600 dark:text-slate-400 text-lg sm:text-xl max-w-2xl font-medium">
                            Siapkan diri Anda untuk pengakuan kompetensi tingkat nasional. Kami siap memandu perjalanan sertifikasi Anda.
                        </p>
                    </div>

                    <!-- Theme Switcher -->
                    <div class="mt-2 sm:mt-0 flex bg-white/50 dark:bg-slate-900/50 p-1.5 rounded-full border border-slate-200 dark:border-slate-700/50 shadow-sm backdrop-blur-sm self-end sm:self-auto transition-colors duration-300">
                        <button @click="setTheme('light')" 
                                class="p-2 rounded-full transition-all duration-300"
                                :class="theme === 'light' ? 'bg-white shadow text-slate-800 dark:bg-transparent dark:text-slate-400' : 'text-slate-500 hover:text-slate-700 dark:text-slate-500 dark:hover:text-slate-300'">
                            <Sun class="w-4 h-4" />
                        </button>
                        <button @click="setTheme('system')" 
                                class="p-2 rounded-full transition-all duration-300"
                                :class="theme === 'system' ? 'bg-white shadow text-slate-800 dark:bg-slate-800 dark:text-white dark:shadow-md' : 'text-slate-500 hover:text-slate-700 dark:text-slate-500 dark:hover:text-slate-300'">
                            <Monitor class="w-4 h-4" />
                        </button>
                        <button @click="setTheme('dark')" 
                                class="p-2 rounded-full transition-all duration-300"
                                :class="theme === 'dark' ? 'bg-slate-800 shadow-md text-slate-100 dark:bg-slate-800 dark:text-white' : 'text-slate-500 hover:text-slate-700 dark:text-slate-500 dark:hover:text-slate-300'">
                            <Moon class="w-4 h-4" />
                        </button>
                    </div>

                </div>
            </div>

            <div class="max-w-6xl mx-auto px-6 sm:px-10 -mt-12 pb-16 w-full flex-grow">
                
                <!-- Status Cards (The Big Three) -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
                    
                    <!-- Card 1 -->
                    <div class="bg-white/90 dark:bg-slate-900/60 backdrop-blur-xl border border-blue-200 dark:border-blue-500/30 rounded-2xl p-6 shadow-md dark:shadow-[0_8px_30px_rgba(59,130,246,0.1)] hover:shadow-lg dark:hover:shadow-[0_8px_30px_rgba(59,130,246,0.2)] hover:-translate-y-1 transition-all duration-300">
                        <div class="flex justify-between items-start mb-4">
                            <div class="w-12 h-12 bg-blue-50 dark:bg-blue-500/10 border border-blue-100 dark:border-blue-500/20 rounded-xl flex items-center justify-center text-blue-600 dark:text-blue-400">
                                <Award class="w-6 h-6" />
                            </div>
                            <span class="px-3 py-1 bg-blue-100 dark:bg-blue-500/10 text-blue-700 dark:text-blue-400 text-xs font-bold rounded-full border border-blue-200 dark:border-blue-500/20">Aktif</span>
                        </div>
                        <p class="text-slate-500 dark:text-slate-400 text-sm font-bold mb-1 uppercase tracking-wider">Sertifikasi Saya</p>
                        <h3 class="text-3xl font-black text-slate-900 dark:text-white">{{ stats.sertifikasi_saya }}<span class="text-lg font-bold text-slate-400 dark:text-slate-500 ml-2">Skema</span></h3>
                    </div>

                    <!-- Card 2 -->
                    <div class="bg-white/90 dark:bg-slate-900/60 backdrop-blur-xl border border-amber-200 dark:border-amber-500/30 rounded-2xl p-6 shadow-md dark:shadow-[0_8px_30px_rgba(245,158,11,0.1)] hover:shadow-lg dark:hover:shadow-[0_8px_30px_rgba(245,158,11,0.2)] hover:-translate-y-1 transition-all duration-300">
                        <div class="flex justify-between items-start mb-4">
                            <div class="w-12 h-12 bg-amber-50 dark:bg-amber-500/10 border border-amber-100 dark:border-amber-500/20 rounded-xl flex items-center justify-center text-amber-600 dark:text-amber-400">
                                <Clock class="w-6 h-6" />
                            </div>
                            <span class="px-3 py-1 bg-amber-100 dark:bg-amber-500/10 text-amber-700 dark:text-amber-400 text-xs font-bold rounded-full border border-amber-200 dark:border-amber-500/20">Pending</span>
                        </div>
                        <p class="text-slate-500 dark:text-slate-400 text-sm font-bold mb-1 uppercase tracking-wider">Status Terakhir</p>
                        <h3 class="text-xl font-extrabold text-slate-800 dark:text-white leading-tight mt-2">{{ stats.status_terakhir }}</h3>
                    </div>

                    <!-- Card 3 -->
                    <div class="bg-white/90 dark:bg-slate-900/60 backdrop-blur-xl border border-emerald-200 dark:border-emerald-500/30 rounded-2xl p-6 shadow-md dark:shadow-[0_8px_30px_rgba(16,185,129,0.1)] hover:shadow-lg dark:hover:shadow-[0_8px_30px_rgba(16,185,129,0.2)] hover:-translate-y-1 transition-all duration-300">
                        <div class="flex justify-between items-start mb-4">
                            <div class="w-12 h-12 bg-emerald-50 dark:bg-emerald-500/10 border border-emerald-100 dark:border-emerald-500/20 rounded-xl flex items-center justify-center text-emerald-600 dark:text-emerald-400">
                                <CalendarCheck class="w-6 h-6" />
                            </div>
                            <span class="px-3 py-1 bg-slate-100 dark:bg-slate-800 text-slate-600 dark:text-slate-400 text-xs font-bold rounded-full border border-slate-200 dark:border-slate-700">Validitas</span>
                        </div>
                        <p class="text-slate-500 dark:text-slate-400 text-sm font-bold mb-1 uppercase tracking-wider">Masa Berlaku Sertifikat</p>
                        <h3 class="text-xl font-extrabold text-slate-700 dark:text-slate-300 mt-2">{{ stats.masa_berlaku }}</h3>
                    </div>

                </div>

                <!-- Main Action Cards -->
                <h3 class="text-2xl font-bold text-slate-900 dark:text-white mb-6 relative">Tindakan Cepat</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-12">
                    
                    <!-- Action 1 -->
                    <div class="group relative bg-gradient-to-br from-blue-500 to-cyan-600 dark:from-cyan-600 dark:to-blue-700 rounded-3xl p-8 hover:-translate-y-2 transition-all duration-300 shadow-xl shadow-blue-500/20 dark:shadow-[0_10px_40px_rgba(34,211,238,0.2)] overflow-hidden">
                        <div class="absolute inset-0 bg-[url('https://grainy-gradients.vercel.app/noise.svg')] opacity-20 mix-blend-overlay pointer-events-none"></div>
                        <div class="absolute top-0 right-0 p-6 opacity-20 group-hover:scale-125 transition-transform duration-500 text-white">
                            <PlayCircle class="w-32 h-32" />
                        </div>
                        <div class="relative z-10 flex flex-col h-full">
                            <h4 class="text-2xl font-extrabold text-white mb-2">Mulai Pendaftaran</h4>
                            <p class="text-blue-50 dark:text-cyan-100/80 mb-8 font-medium">Pilih skema sertifikasi keamanan siber yang sesuai dengan kompetensi Anda.</p>
                            <Link href="/register-certification" class="mt-auto inline-flex items-center w-fit px-5 py-2.5 bg-white/20 hover:bg-white/30 dark:bg-white/10 dark:hover:bg-white/20 backdrop-blur-md rounded-xl text-white font-bold transition-all border border-white/30 dark:border-white/20">
                                Daftar Sekarang <ChevronRight class="w-5 h-5 ml-1" />
                            </Link>
                        </div>
                    </div>

                    <!-- Action 2 -->
                    <div class="group relative bg-gradient-to-br from-purple-500 to-fuchsia-600 dark:from-violet-600 dark:to-fuchsia-700 rounded-3xl p-8 hover:-translate-y-2 transition-all duration-300 shadow-xl shadow-purple-500/20 dark:shadow-[0_10px_40px_rgba(139,92,246,0.2)] overflow-hidden">
                        <div class="absolute inset-0 bg-[url('https://grainy-gradients.vercel.app/noise.svg')] opacity-20 mix-blend-overlay pointer-events-none"></div>
                        <div class="absolute top-0 right-0 p-6 opacity-20 group-hover:scale-125 transition-transform duration-500 text-white">
                            <FolderEdit class="w-32 h-32" />
                        </div>
                        <div class="relative z-10 flex flex-col h-full">
                            <h4 class="text-2xl font-extrabold text-white mb-2">Lengkapi Portofolio</h4>
                            <p class="text-purple-50 dark:text-violet-100/80 mb-8 font-medium">Unggah dokumen persyaratan dasar seperti KTP, Ijazah, dan CV Anda.</p>
                            <Link href="#" class="mt-auto inline-flex items-center w-fit px-5 py-2.5 bg-white/20 hover:bg-white/30 dark:bg-white/10 dark:hover:bg-white/20 backdrop-blur-md rounded-xl text-white font-bold transition-all border border-white/30 dark:border-white/20">
                                Upload Dokumen <ChevronRight class="w-5 h-5 ml-1" />
                            </Link>
                        </div>
                    </div>

                    <!-- Action 3 -->
                    <div class="group relative bg-white dark:bg-slate-800 rounded-3xl p-8 hover:-translate-y-2 transition-all duration-300 shadow-xl shadow-slate-200 dark:shadow-[0_10px_40px_rgba(0,0,0,0.2)] border border-slate-200 dark:border-slate-700 hide-on-mobile lg:block">
                        <div class="absolute top-0 right-0 p-6 opacity-5 dark:opacity-10 group-hover:scale-125 transition-transform duration-500 text-slate-900 dark:text-slate-100">
                            <Download class="w-32 h-32" />
                        </div>
                        <div class="relative z-10 flex flex-col h-full">
                            <h4 class="text-2xl font-extrabold text-slate-800 dark:text-white mb-2">Panduan Sistem</h4>
                            <p class="text-slate-500 dark:text-slate-400 mb-8 font-medium">Unduh buku panduan teknis penggunaan portal asesi dan jadwal ujian.</p>
                            <a href="#" class="mt-auto inline-flex items-center w-fit px-5 py-2.5 bg-slate-100 dark:bg-slate-900 hover:bg-slate-200 dark:hover:bg-slate-700 rounded-xl text-slate-700 dark:text-slate-300 font-bold transition-all border border-slate-200 dark:border-slate-700">
                                Download PDF <ChevronRight class="w-5 h-5 ml-1" />
                            </a>
                        </div>
                    </div>

                </div>

                <!-- Timeline Progress -->
                <div class="bg-white dark:bg-slate-900/60 backdrop-blur-xl border border-slate-200 dark:border-slate-800 rounded-3xl p-8 shadow-sm dark:shadow-lg transition-colors">
                    <h3 class="text-xl font-bold text-slate-900 dark:text-white mb-8">Alur Sertifikasi</h3>
                    
                    <div class="relative">
                        <!-- Horizontal Line -->
                        <div class="hidden md:block absolute top-1/2 left-0 w-full h-1 bg-slate-200 dark:bg-slate-800 -translate-y-1/2 z-0"></div>
                        
                        <div class="flex flex-col md:flex-row justify-between relative z-10 gap-8 md:gap-0">
                            
                            <!-- Step 1 -->
                            <div class="flex flex-col items-center group cursor-default">
                                <div class="w-12 h-12 rounded-full bg-cyan-500 border-4 border-white dark:border-slate-950 flex items-center justify-center shadow-md dark:shadow-[0_0_15px_rgba(34,211,238,0.5)] z-10 font-bold text-white dark:text-slate-950 mb-3 transition-colors">1</div>
                                <h4 class="text-slate-900 dark:text-white font-bold text-center">Pendaftaran</h4>
                                <p class="text-slate-500 dark:text-slate-400 text-xs font-medium text-center max-w-[120px] mt-1">Pilih skema & isi APL-01</p>
                            </div>
                            
                            <!-- Step 2 -->
                            <div class="flex flex-col items-center group cursor-default">
                                <div class="w-12 h-12 rounded-full bg-slate-100 dark:bg-slate-800 border-4 border-white dark:border-slate-950 flex items-center justify-center text-slate-400 dark:text-slate-300 z-10 font-bold mb-3 shadow-sm transition-colors">2</div>
                                <h4 class="text-slate-500 dark:text-slate-400 font-bold text-center">Verifikasi</h4>
                                <p class="text-slate-400 dark:text-slate-500 text-xs font-medium text-center max-w-[120px] mt-1">Pengecekan portofolio oleh Asesor</p>
                            </div>

                            <!-- Step 3 -->
                            <div class="flex flex-col items-center group cursor-default">
                                <div class="w-12 h-12 rounded-full bg-slate-100 dark:bg-slate-800 border-4 border-white dark:border-slate-950 flex items-center justify-center text-slate-400 dark:text-slate-300 z-10 font-bold mb-3 shadow-sm transition-colors">3</div>
                                <h4 class="text-slate-500 dark:text-slate-400 font-bold text-center">Uji Kompetensi</h4>
                                <p class="text-slate-400 dark:text-slate-500 text-xs font-medium text-center max-w-[120px] mt-1">Pelaksanaan asesmen tes/wawancara</p>
                            </div>

                            <!-- Step 4 -->
                            <div class="flex flex-col items-center group cursor-default">
                                <div class="w-12 h-12 rounded-full bg-slate-100 dark:bg-slate-800 border-4 border-white dark:border-slate-950 flex items-center justify-center text-slate-400 dark:text-slate-300 z-10 font-bold mb-3 shadow-sm transition-colors">4</div>
                                <h4 class="text-slate-500 dark:text-slate-400 font-bold text-center">Keputusan</h4>
                                <p class="text-slate-400 dark:text-slate-500 text-xs font-medium text-center max-w-[120px] mt-1">Penerbitan SKKNI & E-Certificate</p>
                            </div>

                        </div>
                    </div>
                </div>

            </div>
        </main>
    </div>
</template>
