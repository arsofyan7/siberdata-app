<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
import { 
    ShieldCheck, 
    UserCheck, 
    GraduationCap, 
    ArrowRight, 
    Sparkles,
    TerminalSquare,
    Activity,
    Newspaper,
    ShieldAlert,
    CheckCircle2
} from 'lucide-vue-next';
import { computed, onMounted, ref } from 'vue';
import dayjs from 'dayjs';

const props = defineProps({
    roles: { type: Array, default: () => [] },
    stats: { type: Array, default: () => [] },
    activities: { type: Array, default: () => [] },
    latestNews: { type: Array, default: () => [] },
    securityStatus: {
        type: Object,
        default: () => ({ password_strength: 'Terlindungi', mfa_enabled: false })
    }
});

const isAdmin = computed(() => {
    return props.roles.some(r => ['super_admin', 'manajer_mutu', 'staf_admin'].includes(r));
});

const isAsesor = computed(() => {
    return props.roles.includes('asesor');
});

const isLoaded = ref(false);

onMounted(() => {
    // Staggered animation trigger
    setTimeout(() => {
        isLoaded.value = true;
    }, 100);
});

const formatDate = (dateString) => {
    if (!dateString) return '';
    return dayjs(dateString).format('DD-MM-YYYY HH:mm');
};
</script>

<template>
    <Head title="Command Center" />

    <AuthenticatedLayout>
        <!-- Full Custom Dark Container -->
        <div class="min-h-[calc(100vh-65px)] bg-slate-950 relative overflow-hidden font-sans pb-12">
            
            <!-- Mesh Gradient Background Elements for Futurism -->
            <div class="absolute top-[-20%] left-[-10%] w-[50%] h-[50%] bg-indigo-900/40 rounded-full mix-blend-screen filter blur-[120px] pointer-events-none"></div>
            <div class="absolute bottom-[-10%] right-[-5%] w-[40%] h-[50%] bg-emerald-900/20 rounded-full mix-blend-screen filter blur-[100px] pointer-events-none"></div>
            <div class="absolute top-[30%] right-[20%] w-[25%] h-[25%] bg-blue-900/20 rounded-full mix-blend-screen filter blur-[80px] pointer-events-none"></div>

            <div class="py-8 relative z-10 w-full h-full">
                <div class="max-w-[90rem] mx-auto px-4 sm:px-6 lg:px-8">
                    
                    <!-- TOP BAR: Header & Security Health Widget -->
                    <div 
                        class="mb-10 transition-all duration-1000 ease-out transform flex flex-col xl:flex-row xl:items-end justify-between gap-6"
                        :class="isLoaded ? 'translate-y-0 opacity-100' : 'translate-y-10 opacity-0'"
                    >
                        <div>
                            <div class="flex items-center gap-2 mb-3">
                                <Sparkles class="w-5 h-5 text-emerald-400 animate-pulse" />
                                <span class="text-slate-400 font-medium tracking-widest text-xs uppercase">Siberdata Command Center V1.0</span>
                            </div>
                            <h2 class="text-4xl md:text-5xl font-extrabold tracking-tight mb-2">
                                <span class="bg-clip-text text-transparent bg-gradient-to-r from-white via-slate-200 to-slate-400 drop-shadow-sm">Welcome, </span>
                                <span class="text-emerald-400 drop-shadow-[0_0_15px_rgba(52,211,153,0.5)]">{{ $page.props.auth.user.name }}</span>
                            </h2>
                        </div>
                        
                        <!-- Security Health Widget -->
                        <div class="flex flex-col sm:flex-row items-start sm:items-center gap-4 bg-slate-900/60 backdrop-blur-md border border-slate-700/50 p-4 rounded-2xl shadow-lg">
                            <div class="flex items-center gap-3">
                                <div class="relative group cursor-help">
                                    <div class="w-10 h-10 rounded-full flex items-center justify-center bg-emerald-500/10 border border-emerald-500/30 text-emerald-400 z-10 relative" title="Password kuat menggunakan standard hashing (Bcrypt/Argon2)">
                                        <CheckCircle2 v-if="securityStatus.mfa_enabled" class="w-5 h-5" />
                                        <ShieldCheck v-else class="w-5 h-5" />
                                    </div>
                                    <div class="absolute top-0 right-0 w-3 h-3 bg-emerald-500 rounded-full border-2 border-slate-900 z-20 animate-ping"></div>
                                    <div class="absolute top-0 right-0 w-3 h-3 bg-emerald-500 rounded-full border-2 border-slate-900 z-20"></div>
                                </div>
                                <div class="group cursor-help relative">
                                    <p class="text-xs text-slate-400 uppercase tracking-wider font-semibold mb-0.5">Security Status</p>
                                    <p class="text-sm font-bold text-white flex items-center gap-1.5" title="Indikator keamanan akun Anda. Semakin tinggi tingkat pelindungan password & OTP, semakin aman data Anda.">
                                        {{ securityStatus.password_strength }}
                                    </p>
                                </div>
                            </div>
                            <div class="h-10 w-px bg-slate-700/50 hidden sm:block"></div>
                            <div class="flex items-center gap-2">
                                <span v-if="securityStatus.mfa_enabled" class="px-3 py-1 bg-emerald-500/10 border border-emerald-500/30 text-emerald-400 text-[10px] font-bold rounded-full uppercase tracking-widest">
                                    MFA Active
                                </span>
                                <span v-else class="px-3 py-1 bg-amber-500/10 border border-amber-500/30 text-amber-400 text-[10px] font-bold rounded-full uppercase tracking-widest flex items-center gap-1">
                                    <ShieldAlert class="w-3 h-3" /> MFA Disabled
                                </span>
                                
                                <span v-for="role in roles.length ? roles : ['asesi']" :key="role" 
                                        class="px-3 py-1 bg-blue-500/10 border border-blue-500/30 text-blue-300 text-[10px] font-bold rounded-full uppercase tracking-widest">
                                    {{ role.replace('_', ' ') }}
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- GRID LAYOUT -->
                    <div class="grid grid-cols-1 xl:grid-cols-3 gap-6">
                        
                        <!-- LEFT COLUMN: Service Cards (2 cols span) -->
                        <div class="xl:col-span-2 flex flex-col gap-6">
                            
                            <!-- PORTALS -->
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                
                                <!-- Portal Asesi -->
                                <div 
                                    class="group relative rounded-3xl p-[1px] bg-gradient-to-br from-slate-800 to-slate-900 hover:from-emerald-500 hover:to-blue-600 transition-all duration-500 hover:scale-[1.02] shadow-2xl hover:shadow-[0_0_30px_rgba(52,211,153,0.15)] transform h-full"
                                    :class="isLoaded ? 'translate-y-0 opacity-100' : 'translate-y-10 opacity-0'"
                                    style="transition-delay: 150ms;"
                                >
                                    <div class="relative h-full bg-slate-950/80 backdrop-blur-xl rounded-[23px] p-8 flex flex-col overflow-hidden">
                                        <div class="absolute inset-0 bg-gradient-to-br from-emerald-500/5 to-blue-500/10 opacity-0 group-hover:opacity-100 transition-opacity duration-500 pointer-events-none"></div>
                                        
                                        <div class="w-14 h-14 rounded-2xl bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 flex items-center justify-center mb-6 group-hover:scale-110 group-hover:bg-emerald-500 group-hover:text-slate-950 group-hover:shadow-[0_0_20px_rgba(52,211,153,0.4)] transition-all duration-500 relative z-10">
                                            <GraduationCap class="w-7 h-7" />
                                        </div>
                                        
                                        <h4 class="text-2xl font-bold text-white mb-2 relative z-10">Portal Asesi</h4>
                                        <p class="text-slate-400 text-sm mb-8 flex-grow leading-relaxed relative z-10">
                                            Kelola profil, lengkapi pra-asesmen, dan pantau sertifikasi.
                                        </p>
                                        
                                        <Link href="/portal-asesi" class="inline-flex items-center text-sm font-bold text-emerald-400 group-hover:text-emerald-300 transition-colors mt-auto relative z-10 w-fit">
                                            Akses Sistem
                                            <ArrowRight class="w-4 h-4 ml-2 group-hover:translate-x-2 transition-transform duration-300" />
                                        </Link>
                                    </div>
                                </div>

                                <!-- Panel Admin -->
                                <div 
                                    v-if="isAdmin" 
                                    class="group relative rounded-3xl p-[1px] bg-gradient-to-br from-slate-800 to-slate-900 hover:from-indigo-500 hover:to-violet-600 transition-all duration-500 hover:scale-[1.02] shadow-2xl hover:shadow-[0_0_30px_rgba(99,102,241,0.15)] transform h-full"
                                    :class="isLoaded ? 'translate-y-0 opacity-100' : 'translate-y-10 opacity-0'"
                                    style="transition-delay: 300ms;"
                                >
                                    <div class="relative h-full bg-slate-950/80 backdrop-blur-xl rounded-[23px] p-8 flex flex-col overflow-hidden">
                                        <div class="absolute inset-0 bg-gradient-to-br from-indigo-500/5 to-violet-500/10 opacity-0 group-hover:opacity-100 transition-opacity duration-500 pointer-events-none"></div>
                                        
                                        <div class="w-14 h-14 rounded-2xl bg-indigo-500/10 border border-indigo-500/20 text-indigo-400 flex items-center justify-center mb-6 group-hover:scale-110 group-hover:bg-indigo-500 group-hover:text-white group-hover:shadow-[0_0_20px_rgba(99,102,241,0.4)] transition-all duration-500 relative z-10">
                                            <ShieldCheck class="w-7 h-7" />
                                        </div>
                                        
                                        <h4 class="text-2xl font-bold text-white mb-2 relative z-10">Panel Admin</h4>
                                        <p class="text-slate-400 text-sm mb-8 flex-grow leading-relaxed relative z-10">
                                            Kelola skema, data pengguna, dokumen SKKNI, dan konfigurasi.
                                        </p>
                                        
                                        <a href="/admin" class="inline-flex items-center text-sm font-bold text-indigo-400 group-hover:text-indigo-300 transition-colors mt-auto relative z-10 w-fit">
                                            Buka Console
                                            <ArrowRight class="w-4 h-4 ml-2 group-hover:translate-x-2 transition-transform duration-300" />
                                        </a>
                                    </div>
                                </div>

                                <!-- Portal Asesor -->
                                <div 
                                    v-if="isAsesor" 
                                    class="group relative rounded-3xl p-[1px] bg-gradient-to-br from-slate-800 to-slate-900 hover:from-blue-500 hover:to-cyan-600 transition-all duration-500 hover:scale-[1.02] shadow-2xl hover:shadow-[0_0_30px_rgba(59,130,246,0.15)] transform h-full"
                                    :class="isLoaded ? 'translate-y-0 opacity-100' : 'translate-y-10 opacity-0'"
                                    style="transition-delay: 450ms;"
                                >
                                    <div class="relative h-full bg-slate-950/80 backdrop-blur-xl rounded-[23px] p-8 flex flex-col overflow-hidden">
                                        <div class="absolute inset-0 bg-gradient-to-br from-blue-500/5 to-cyan-500/10 opacity-0 group-hover:opacity-100 transition-opacity duration-500 pointer-events-none"></div>
                                        
                                        <div class="w-14 h-14 rounded-2xl bg-blue-500/10 border border-blue-500/20 text-blue-400 flex items-center justify-center mb-6 group-hover:scale-110 group-hover:bg-blue-500 group-hover:text-slate-950 group-hover:shadow-[0_0_20px_rgba(59,130,246,0.4)] transition-all duration-500 relative z-10">
                                            <UserCheck class="w-7 h-7" />
                                        </div>
                                        
                                        <h4 class="text-2xl font-bold text-white mb-2 relative z-10">Portal Asesor</h4>
                                        <p class="text-slate-400 text-sm mb-8 flex-grow leading-relaxed relative z-10">
                                            Akses jadwal penilaian, evaluasi portofolio, dan input nilai.
                                        </p>
                                        
                                        <Link href="/portal-asesor" class="inline-flex items-center text-sm font-bold text-blue-400 group-hover:text-blue-300 transition-colors mt-auto relative z-10 w-fit">
                                            Buka Akses
                                            <ArrowRight class="w-4 h-4 ml-2 group-hover:translate-x-2 transition-transform duration-300" />
                                        </Link>
                                    </div>
                                </div>

                            </div>

                            <!-- QUICK STATS (BOTTOM LEFT) -->
                            <div 
                                class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 transition-all duration-1000 ease-out transform"
                                :class="isLoaded ? 'translate-y-0 opacity-100' : 'translate-y-10 opacity-0'"
                                style="transition-delay: 500ms;"
                            >
                                <div v-for="(stat, index) in stats" :key="index" class="bg-slate-900/40 backdrop-blur-md rounded-2xl p-6 border border-slate-800/80 relative overflow-hidden group">
                                    <div class="absolute -right-4 -bottom-4 opacity-5 group-hover:opacity-20 transition-opacity text-slate-100">
                                        <Activity class="w-24 h-24" />
                                    </div>
                                    <p class="text-slate-400 text-sm font-medium mb-1 relative z-10">{{ stat.label }}</p>
                                    <h3 class="text-3xl font-black text-white tracking-tight drop-shadow-[0_0_10px_rgba(255,255,255,0.2)] relative z-10">
                                        {{ stat.value }}
                                    </h3>
                                </div>
                            </div>
                            
                            <!-- BULLETIN BOARD (Updates) -->
                            <div 
                                v-if="latestNews.length"
                                class="bg-slate-900/40 backdrop-blur-md rounded-3xl p-6 border border-slate-800/80 transition-all duration-1000 ease-out transform"
                                :class="isLoaded ? 'translate-y-0 opacity-100' : 'translate-y-10 opacity-0'"
                                style="transition-delay: 600ms;"
                            >
                                <div class="flex items-center gap-2 mb-5 pb-4 border-b border-slate-800">
                                    <Newspaper class="w-5 h-5 text-blue-400" />
                                    <h3 class="font-bold text-lg text-slate-200">LSP Updates</h3>
                                </div>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div v-for="news in latestNews" :key="news.id" class="bg-slate-950/50 rounded-2xl p-4 border border-slate-800 hover:border-blue-500/30 transition-colors group">
                                        <span class="text-xs text-slate-500 mb-2 block font-mono">{{ formatDate(news.created_at) }}</span>
                                        <h4 class="text-slate-200 font-bold mb-2 group-hover:text-blue-400 transition-colors line-clamp-2">
                                            {{ news.title }}
                                        </h4>
                                        <div class="text-sm text-slate-400 line-clamp-2" v-html="news.content"></div>
                                        <a :href="'/berita/' + news.slug" class="text-xs text-blue-400 font-bold mt-4 inline-flex items-center hover:text-blue-300">
                                            Read More <ArrowRight class="w-3 h-3 ml-1" />
                                        </a>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <!-- RIGHT COLUMN: Terminal Log / Recent Activity -->
                        <div 
                            class="xl:col-span-1 transition-all duration-1000 ease-out transform h-full"
                            :class="isLoaded ? 'translate-x-0 opacity-100' : 'translate-x-10 opacity-0'"
                            style="transition-delay: 400ms;"
                        >
                            <div class="bg-[#0a0f16]/90 backdrop-blur-3xl rounded-[2rem] border border-emerald-500/30 shadow-[0_0_20px_rgba(16,185,129,0.05)] h-full overflow-hidden flex flex-col font-mono text-sm relative group">
                                <!-- Glare effect -->
                                <div class="absolute top-0 left-0 right-0 h-px bg-gradient-to-r from-transparent via-emerald-500/50 to-transparent"></div>
                                
                                <div class="bg-slate-900/80 px-5 py-4 border-b border-emerald-500/20 flex flex-row items-center justify-between">
                                    <div class="flex items-center gap-3">
                                        <TerminalSquare class="w-5 h-5 text-emerald-400" />
                                        <span class="text-emerald-400 font-bold tracking-widest text-xs uppercase">System.Log</span>
                                    </div>
                                    <div class="flex gap-1.5">
                                        <div class="w-3 h-3 rounded-full bg-slate-700"></div>
                                        <div class="w-3 h-3 rounded-full bg-slate-700"></div>
                                        <div class="w-3 h-3 rounded-full bg-emerald-500/50"></div>
                                    </div>
                                </div>
                                
                                <div class="p-5 flex-grow overflow-y-auto space-y-4">
                                    <template v-if="activities.length">
                                        <div v-for="activity in activities" :key="activity.id" class="flex flex-col gap-1">
                                            <span class="text-emerald-500/70 text-xs">[{{ formatDate(activity.created_at) }}]</span>
                                            <span class="text-slate-300 break-words leading-relaxed">
                                                <span class="text-indigo-400">{{ activity.log_name || 'system' }}</span>: {{ activity.description }}
                                            </span>
                                        </div>
                                    </template>
                                    <template v-else>
                                        <div class="flex flex-col gap-1">
                                            <span class="text-emerald-500/70 text-xs">[{{ dayjs().format('DD-MM-YYYY HH:mm') }}]</span>
                                            <span class="text-slate-300">System initialized. No recent activities recorded.</span>
                                        </div>
                                        <div class="flex flex-col gap-1 opacity-50">
                                            <span class="text-emerald-500/70 text-xs">[{{ dayjs().subtract(5, 'minute').format('DD-MM-YYYY HH:mm') }}]</span>
                                            <span class="text-slate-300">Authentication successful via Gateway 1.</span>
                                        </div>
                                    </template>
                                    <div class="flex items-center gap-2 pt-2 animate-pulse mt-4">
                                        <span class="text-emerald-400">root@siberdata:~$</span>
                                        <span class="w-2 h-4 bg-emerald-400"></span>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            
            <!-- Footer from Welcome.vue -->
            <div class="max-w-[90rem] mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
                <div class="mt-8 border-t border-slate-800/60 pt-8 flex flex-col md:flex-row justify-between items-center">
                    <div class="flex items-center mb-4 md:mb-0">
                        <ShieldCheck class="h-6 w-6 text-slate-500 mr-2" />
                        <p class="text-sm font-medium text-slate-500">
                            &copy; 2026 LSP Siberdata. Terakreditasi Nasional.
                        </p>
                    </div>
                </div>
            </div>

        </div>
    </AuthenticatedLayout>
</template>

<style scoped>
/* Specific fonts and styles if needed */
@import url('https://fonts.googleapis.com/css2?family=JetBrains+Mono:wght@400;700&display=swap');

.font-mono {
    font-family: 'JetBrains Mono', 'Courier New', Courier, monospace;
}
</style>
