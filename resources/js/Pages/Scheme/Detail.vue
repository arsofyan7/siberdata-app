<script setup>
import { Head, Link } from '@inertiajs/vue3';
import { ref } from 'vue';
import { 
    ShieldCheck, 
    LockKeyhole, 
    ArrowLeft, 
    Briefcase,
    FileText,
    GraduationCap,
    UserCircle,
    Menu,
    X
} from 'lucide-vue-next';
import CarouselBackground from '@/Components/CarouselBackground.vue';

const props = defineProps({
    canLogin: Boolean,
    canRegister: Boolean,
    scheme: Object,
    detail: Object,
});

const themeColor = props.scheme.category === 'cyber' ? 'indigo' : 'emerald';
const isCyber = props.scheme.category === 'cyber';

const isMobileMenuOpen = ref(false);
const activeTab = ref('profil');

const tabs = [
    { id: 'profil', label: 'Profil & Definisi', icon: UserCircle },
    { id: 'tugas', label: 'Tugas & Tanggung Jawab', icon: Briefcase },
    { id: 'persyaratan', label: 'Persyaratan Sertifikasi', icon: GraduationCap },
];
</script>

<template>
    <Head :title="`Detail Skema: ${scheme.name}`" />

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
                        <Link href="/skema" class="text-sm font-bold text-blue-700 transition-colors">Skema</Link>
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
                                <Link v-if="canRegister" :href="route('register')" class="inline-flex items-center justify-center px-5 py-2.5 border border-transparent text-sm font-bold rounded-xl text-white bg-indigo-600 hover:bg-indigo-700 shadow-sm transition-all hover:shadow-md hover:-translate-y-0.5"
                                      :class="isCyber ? 'bg-indigo-600 hover:bg-indigo-700' : 'bg-emerald-600 hover:bg-emerald-700'">
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
                    <Link href="/skema" @click="isMobileMenuOpen = false" class="block px-3 py-3 rounded-md text-base font-bold text-blue-700 bg-slate-50 transition-colors">Skema</Link>
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
                            <Link v-if="canRegister" :href="route('register')" @click="isMobileMenuOpen = false" class="mt-4 block w-full text-center px-5 py-3 border border-transparent text-base font-bold rounded-xl text-white shadow-sm transition-colors"
                                  :class="isCyber ? 'bg-indigo-600 hover:bg-indigo-700' : 'bg-emerald-600 hover:bg-emerald-700'">
                                Portal Asesi
                            </Link>
                        </template>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Main Content -->
        <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-8">
            
            <div class="mb-6">
                <Link href="/#schemes" class="inline-flex items-center text-sm font-medium text-slate-500 hover:text-slate-800 transition-colors">
                    <ArrowLeft class="w-4 h-4 mr-2" /> Kembali ke Daftar Skema
                </Link>
            </div>

            <!-- Header Section -->
            <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden mb-8">
                <div 
                    class="h-24 w-full"
                    :class="isCyber ? 'bg-gradient-to-r from-indigo-600 to-blue-500' : 'bg-gradient-to-r from-emerald-600 to-teal-500'"
                ></div>
                <div class="px-6 sm:px-8 py-8 relative -mt-12">
                    <div 
                        class="h-20 w-20 rounded-2xl shadow-lg flex items-center justify-center mb-6 bg-white border-4 border-white"
                    >
                        <ShieldCheck v-if="isCyber" class="w-10 h-10 text-indigo-600" />
                        <LockKeyhole v-else class="w-10 h-10 text-emerald-600" />
                    </div>

                    <h1 class="text-3xl sm:text-4xl font-extrabold text-slate-900 mb-2 leading-tight">
                        {{ scheme.name }}
                    </h1>
                    <div v-if="detail && detail.profil" class="text-lg text-slate-600 max-w-4xl mt-3">
                        <p v-if="typeof detail.profil === 'string'">{{ detail.profil }}</p>
                        <div v-else-if="Array.isArray(detail.profil)" class="flex flex-wrap gap-2">
                            <span v-for="(p, i) in detail.profil" :key="i" class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-slate-100 text-slate-700 border border-slate-200 shadow-sm">{{ p }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Content Grid with Sticky Sidebar -->
            <div class="flex flex-col lg:flex-row gap-8 items-start">
                
                <!-- Left: Details Tabs -->
                <div class="flex-grow w-full lg:w-2/3 bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
                    
                    <!-- Tabs Navigation -->
                    <div class="border-b border-slate-200 overflow-x-auto custom-scrollbar">
                        <nav class="flex px-4 sm:px-6 space-x-6 min-w-max" aria-label="Tabs">
                            <button 
                                v-for="tab in tabs" :key="tab.id"
                                @click="activeTab = tab.id"
                                class="whitespace-nowrap py-4 px-1 border-b-2 font-bold text-sm flex items-center transition-colors outline-none"
                                :class="[
                                    activeTab === tab.id 
                                        ? (isCyber ? 'border-indigo-600 text-indigo-700' : 'border-emerald-600 text-emerald-700')
                                        : 'border-transparent text-slate-500 hover:text-slate-700 hover:border-slate-300'
                                ]"
                            >
                                <component :is="tab.icon" class="w-5 h-5 mr-2" 
                                    :class="activeTab === tab.id ? (isCyber ? 'text-indigo-600' : 'text-emerald-600') : 'text-slate-400'" 
                                />
                                {{ tab.label }}
                            </button>
                        </nav>
                    </div>

                    <!-- Tab Content -->
                    <div class="p-6 sm:p-8" v-if="detail">
                        
                        <!-- Profil & Definisi -->
                        <div v-show="activeTab === 'profil'" class="space-y-8 animate-in fade-in slide-in-from-bottom-2 duration-300">
                            <section>
                                <h3 class="text-xl font-bold text-slate-900 mb-3 border-b border-slate-100 pb-2">Definisi</h3>
                                <p class="text-slate-600 leading-relaxed">{{ detail.definisi }}</p>
                            </section>

                            <section>
                                <h3 class="text-xl font-bold text-slate-900 mb-3 border-b border-slate-100 pb-2">Lingkup Bidang</h3>
                                <p v-if="typeof detail.lingkup_bidang === 'string'" class="text-slate-600 leading-relaxed">{{ detail.lingkup_bidang }}</p>
                                <ul v-else-if="Array.isArray(detail.lingkup_bidang)" class="space-y-2 list-disc list-inside text-slate-600">
                                    <li v-for="(item, i) in detail.lingkup_bidang" :key="i">{{ item }}</li>
                                </ul>
                            </section>

                            <section>
                                <h3 class="text-xl font-bold text-slate-900 mb-3 border-b border-slate-100 pb-2">Jenjang Karier</h3>
                                <div class="inline-flex items-center px-4 py-2 bg-slate-50 rounded-lg border border-slate-200 text-slate-700 font-medium w-full lg:w-max">
                                    <ArrowRight class="w-4 h-4 mr-2 text-slate-400 flex-shrink-0" />
                                    <span class="break-words max-w-full">{{ detail.jenjang_karier }}</span>
                                </div>
                            </section>
                        </div>

                        <!-- Tugas & Tanggung Jawab -->
                        <div v-show="activeTab === 'tugas'" class="space-y-8 animate-in fade-in slide-in-from-bottom-2 duration-300">
                            
                            <!-- For PDP Schemes -->
                            <section v-if="detail.tugas && !detail.tugas_utama">
                                <h3 class="text-xl font-bold text-slate-900 mb-3 border-b border-slate-100 pb-2">Tugas Utama</h3>
                                <ul class="space-y-3">
                                    <li v-for="(tugasItem, index) in detail.tugas" :key="index" class="flex items-start">
                                        <CheckCircle2 class="flex-shrink-0 w-5 h-5 mt-0.5 mr-3 text-emerald-500" />
                                        <span class="text-slate-600">{{ tugasItem }}</span>
                                    </li>
                                </ul>
                            </section>

                            <!-- For CYBER Schemes -->
                            <div v-if="detail.tugas_utama && detail.tugas_utama.length > 0" class="space-y-6">
                                <section>
                                    <h3 class="text-xl font-bold text-slate-900 mb-3 border-b border-slate-100 pb-2">Tugas Utama</h3>
                                    <div class="space-y-3">
                                        <div v-for="(tu, i) in detail.tugas_utama" :key="i" class="p-4 bg-slate-50 border border-slate-200 rounded-xl">
                                            <div class="font-bold text-slate-800">{{ tu.deskripsi }}</div>
                                            <div v-if="tu.kode_skkni" class="text-sm font-mono text-indigo-600 mt-1 flex items-center">
                                                <FileText class="w-3 h-3 mr-1" /> {{ tu.kode_skkni }}
                                            </div>
                                        </div>
                                    </div>
                                </section>

                                <section v-if="detail.tugas_khusus && detail.tugas_khusus.length > 0">
                                    <h3 class="text-xl font-bold text-slate-900 mb-3 border-b border-slate-100 pb-2">Tugas Khusus</h3>
                                    <div class="space-y-3">
                                        <div v-for="(tk, idx) in detail.tugas_khusus" :key="idx" class="p-4 bg-slate-50 border border-slate-200 rounded-xl">
                                            <div class="font-bold text-slate-800">{{ tk.deskripsi }}</div>
                                            <div v-if="tk.kode_skkni" class="text-sm font-mono text-indigo-600 mt-1 flex items-center">
                                                <FileText class="w-3 h-3 mr-1" /> {{ tk.kode_skkni }}
                                            </div>
                                        </div>
                                    </div>
                                </section>
                            </div>

                            <div class="grid sm:grid-cols-2 gap-8 pt-4">
                                <section>
                                    <h3 class="text-xl font-bold text-slate-900 mb-3 border-b border-slate-100 pb-2">Tanggung Jawab</h3>
                                    <p v-if="typeof detail.tanggung_jawab === 'string'" class="text-slate-600 leading-relaxed">{{ detail.tanggung_jawab }}</p>
                                    <ul v-else-if="Array.isArray(detail.tanggung_jawab)" class="space-y-2">
                                        <li v-for="(item, i) in detail.tanggung_jawab" :key="i" class="flex items-start">
                                            <div class="w-1.5 h-1.5 rounded-full bg-slate-400 mt-2.5 mr-2.5 flex-shrink-0"></div>
                                            <span class="text-slate-600 leading-relaxed">{{ item }}</span>
                                        </li>
                                    </ul>
                                </section>

                                <section>
                                    <h3 class="text-xl font-bold text-slate-900 mb-3 border-b border-slate-100 pb-2">Wewenang</h3>
                                    <p v-if="typeof detail.wewenang === 'string'" class="text-slate-600 leading-relaxed">{{ detail.wewenang }}</p>
                                    <ul v-else-if="Array.isArray(detail.wewenang)" class="space-y-2">
                                        <li v-for="(item, i) in detail.wewenang" :key="i" class="flex items-start">
                                            <div class="w-1.5 h-1.5 rounded-full bg-slate-400 mt-2.5 mr-2.5 flex-shrink-0"></div>
                                            <span class="text-slate-600 leading-relaxed">{{ item }}</span>
                                        </li>
                                    </ul>
                                    <span v-else class="text-slate-400 italic">Tidak ada wewenang spesifik</span>
                                </section>
                            </div>
                        </div>

                        <!-- Persyaratan -->
                        <div v-show="activeTab === 'persyaratan'" class="space-y-8 animate-in fade-in slide-in-from-bottom-2 duration-300">
                            <section>
                                <h3 class="text-xl font-bold text-slate-900 mb-3 border-b border-slate-100 pb-2">Kualifikasi Pendidikan & Pengalaman</h3>
                                <div class="p-4 bg-slate-50 rounded-xl border border-slate-200 flex items-start">
                                    <GraduationCap class="w-6 h-6 mr-3 text-slate-400 flex-shrink-0" />
                                    <span class="text-slate-700 font-medium">{{ detail.kualifikasi }}</span>
                                </div>
                            </section>

                            <section>
                                <h3 class="text-xl font-bold text-slate-900 mb-3 border-b border-slate-100 pb-2">Dokumen Persyaratan</h3>
                                <div class="p-4 bg-slate-50 rounded-xl border border-slate-200 flex flex-col sm:flex-row items-start">
                                    <FileText class="w-6 h-6 mb-3 sm:mb-0 sm:mr-3 text-slate-400 flex-shrink-0" />
                                    <div class="w-full">
                                        <p v-if="typeof detail.persyaratan === 'string'" class="text-slate-700">{{ detail.persyaratan }}</p>
                                        <ul v-else-if="Array.isArray(detail.persyaratan)" class="space-y-2 list-disc list-inside text-slate-700">
                                            <li v-for="(item, i) in detail.persyaratan" :key="i">{{ item }}</li>
                                        </ul>
                                    </div>
                                </div>
                            </section>
                            
                            <section>
                                <h3 class="text-xl font-bold text-slate-900 mb-3 border-b border-slate-100 pb-2">Metode Verifikasi / Uji</h3>
                                <p class="text-slate-600 leading-relaxed">{{ detail.verifikasi }}</p>
                            </section>
                        </div>

                    </div>
                    <div v-else class="p-8 text-center text-slate-500">
                        <p>Detail skema sedang diverifikasi.</p>
                    </div>
                </div>

                <!-- Right: Sticky Sidebar / Action Card -->
                <div class="w-full lg:w-1/3 lg:sticky lg:top-24 space-y-6">
                    <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6 flex flex-col items-center text-center">
                        <div class="mb-5 space-y-3 w-full">
                            <div class="flex justify-between items-center py-3 border-b border-slate-100">
                                <span class="text-sm font-medium text-slate-500">Kategori</span>
                                <span class="text-sm font-bold uppercase" :class="isCyber ? 'text-indigo-600' : 'text-emerald-600'">
                                    {{ isCyber ? 'Cyber Security' : 'Data Privacy' }}
                                </span>
                            </div>
                            <div class="flex justify-between items-center py-3 border-b border-slate-100">
                                <span class="text-sm font-medium text-slate-500">Kode Skema</span>
                                <span class="text-sm font-bold font-mono text-slate-800 bg-slate-100 px-2 py-0.5 rounded">{{ scheme.code }}</span>
                            </div>
                            <div class="flex justify-between items-center py-3 border-b border-slate-100">
                                <span class="text-sm font-medium text-slate-500">Level KKNI</span>
                                <span class="text-sm font-bold text-slate-800">Level {{ scheme.level }}</span>
                            </div>
                            <div class="flex flex-col items-start py-3 text-left w-full" v-if="detail">
                                <span class="text-sm font-medium text-slate-500 mb-1">Acuan Sertifikasi:</span>
                                <span class="text-sm font-semibold text-slate-700">{{ detail.sertifikasi }}</span>
                            </div>
                        </div>

                        <!-- CTA Button -->
                        <Link
                            :href="route('register')"
                            class="w-full justify-center inline-flex items-center px-6 py-4 border border-transparent text-base font-bold rounded-xl text-white shadow-md transition-all hover:shadow-lg hover:-translate-y-0.5"
                            :class="isCyber ? 'bg-indigo-600 hover:bg-indigo-700 shadow-indigo-500/30' : 'bg-emerald-600 hover:bg-emerald-700 shadow-emerald-500/30'"
                        >
                            Daftar Sertifikasi Sekarang
                        </Link>
                        
                        <p class="mt-4 text-xs text-slate-400 flex items-center justify-center">
                            <LockKeyhole class="w-3 h-3 mr-1" /> Transaksi aman melalui Portal Asesi
                        </p>
                    </div>
                </div>

            </div>
        </div>
    </div>
</template>

<style scoped>
.custom-scrollbar::-webkit-scrollbar {
    height: 4px;
}
.custom-scrollbar::-webkit-scrollbar-track {
    background: transparent;
}
.custom-scrollbar::-webkit-scrollbar-thumb {
    background-color: #cbd5e1;
    border-radius: 10px;
}
</style>
