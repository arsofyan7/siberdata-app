<script setup>
import { Head, Link } from '@inertiajs/vue3';
import { ShieldCheck, LockKeyhole, ArrowRight, UserCircle, ServerCog, Search, Inbox } from 'lucide-vue-next';
import { ref, computed } from 'vue';
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
    },
    schemes: {
        type: Array,
        default: () => [],
    }
});

const searchQuery = ref('');
const selectedCategory = ref('all');
const isMobileMenuOpen = ref(false);

const filteredSchemes = computed(() => {
    return props.schemes.filter(scheme => {
        const matchesCategory = selectedCategory.value === 'all' || scheme.category === selectedCategory.value;
        const query = searchQuery.value.toLowerCase();
        const matchesSearch = scheme.name.toLowerCase().includes(query) || scheme.code.toLowerCase().includes(query);
        return matchesCategory && matchesSearch;
    });
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

            <!-- Schemes Section & Filter -->
            <div id="schemes" class="mt-8">
                <div class="text-center mb-12">
                    <h2 class="text-3xl font-extrabold text-slate-900 sm:text-4xl">Daftar Skema Unggulan</h2>
                    <p class="mt-4 max-w-2xl text-xl text-slate-500 mx-auto">Pilih skema sertifikasi yang sesuai dengan karir dan profesi Anda.</p>
                </div>

                <!-- Filter UI Section -->
                <div class="mb-10 bg-white rounded-2xl shadow-sm border border-slate-200 p-4 sm:p-5">
                    <div class="flex flex-col md:flex-row gap-4 items-center justify-between">
                        <!-- Category Pills (Scrollable on mobile) -->
                        <div class="w-full md:w-auto flex items-center space-x-2 overflow-x-auto pb-2 md:pb-0 scrollbar-hide">
                            <button 
                                @click="selectedCategory = 'all'"
                                :class="[
                                    'whitespace-nowrap px-5 py-2.5 rounded-full text-sm font-semibold transition-all duration-300',
                                    selectedCategory === 'all' ? 'bg-slate-800 text-white shadow-md' : 'bg-slate-100 text-slate-600 hover:bg-slate-200'
                                ]"
                            >
                                Semua Skema
                            </button>
                            <button 
                                @click="selectedCategory = 'cyber'"
                                :class="[
                                    'whitespace-nowrap px-5 py-2.5 rounded-full text-sm font-semibold transition-all duration-300',
                                    selectedCategory === 'cyber' ? 'bg-indigo-600 text-white shadow-md shadow-indigo-200' : 'bg-slate-100 text-slate-600 hover:bg-indigo-50 hover:text-indigo-700'
                                ]"
                            >
                                Keamanan Siber
                            </button>
                            <button 
                                @click="selectedCategory = 'pdp'"
                                :class="[
                                    'whitespace-nowrap px-5 py-2.5 rounded-full text-sm font-semibold transition-all duration-300',
                                    selectedCategory === 'pdp' ? 'bg-emerald-600 text-white shadow-md shadow-emerald-200' : 'bg-slate-100 text-slate-600 hover:bg-emerald-50 hover:text-emerald-700'
                                ]"
                            >
                                Pelindungan Data Pribadi (PDP)
                            </button>
                        </div>

                        <!-- Search Bar -->
                        <div class="w-full md:w-80 relative group">
                            <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                                <Search class="h-5 w-5 text-slate-400 group-focus-within:text-slate-600 transition-colors" />
                            </div>
                            <input 
                                v-model="searchQuery"
                                type="text" 
                                class="block w-full pl-10 pr-4 py-2.5 border-slate-200 rounded-xl leading-5 bg-slate-50 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-slate-500/20 focus:border-slate-500 focus:bg-white transition-all sm:text-sm" 
                                placeholder="Cari skema, kode..." 
                            >
                        </div>
                    </div>
                </div>

                <!-- Schemes Grid -->
                <div v-if="filteredSchemes.length > 0" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-16">
                    <div v-for="scheme in filteredSchemes" :key="scheme.id" 
                         class="bg-white rounded-2xl shadow-sm hover:shadow-xl border overflow-hidden transition-all duration-300 transform hover:-translate-y-1 group flex flex-col h-full relative"
                         :class="scheme.category === 'cyber' ? 'border-indigo-100/50 hover:shadow-indigo-500/10' : 'border-emerald-100/50 hover:shadow-emerald-500/10'">
                        
                        <div class="absolute top-0 right-0 w-24 h-24 rounded-bl-3xl opacity-50 transition-opacity pointer-events-none"
                             :class="scheme.category === 'cyber' ? 'bg-gradient-to-bl from-indigo-50 to-transparent group-hover:opacity-100' : 'bg-gradient-to-bl from-emerald-50 to-transparent group-hover:opacity-100'"></div>

                        <div class="p-6 flex-grow relative z-10 flex flex-col">
                            <div class="flex justify-between items-start mb-5">
                                <span class="inline-flex flex-shrink-0 items-center px-3 py-1 rounded-full text-xs font-bold font-mono text-white shadow-sm ring-1 ring-inset"
                                      :class="scheme.category === 'cyber' ? 'bg-gradient-to-r from-indigo-500 to-blue-500 ring-indigo-500/20' : 'bg-gradient-to-r from-emerald-500 to-teal-500 ring-emerald-500/20'">
                                    {{ scheme.code }}
                                </span>
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-slate-100 text-slate-600 border border-slate-200">
                                    Level {{ scheme.level }}
                                </span>
                            </div>
                            
                            <!-- Icon and Muted Category Name -->
                            <div class="flex items-center mb-3">
                                <component :is="scheme.category === 'cyber' ? ServerCog : LockKeyhole" 
                                           class="w-4 h-4 mr-2" 
                                           :class="scheme.category === 'cyber' ? 'text-indigo-500' : 'text-emerald-500'" />
                                <span class="text-xs font-bold uppercase tracking-wider"
                                      :class="scheme.category === 'cyber' ? 'text-indigo-600' : 'text-emerald-600'">
                                    {{ scheme.category === 'cyber' ? 'Keamanan Siber' : 'PDP' }}
                                </span>
                            </div>

                            <h4 class="text-xl font-bold text-slate-800 transition-colors leading-snug"
                                :class="scheme.category === 'cyber' ? 'group-hover:text-indigo-700' : 'group-hover:text-emerald-700'">
                                {{ scheme.name }}
                            </h4>
                        </div>

                        <div class="px-6 py-4 border-t border-slate-100 mt-auto relative z-10 transition-colors"
                             :class="scheme.category === 'cyber' ? 'bg-slate-50/50 group-hover:bg-indigo-50/30' : 'bg-slate-50/50 group-hover:bg-emerald-50/30'">
                            <Link :href="route('scheme.detail', scheme.slug)" 
                                  class="w-full text-sm font-bold py-2.5 rounded-xl flex items-center justify-center transition-colors shadow-sm"
                                  :class="scheme.category === 'cyber' ? 'text-white bg-indigo-600 hover:bg-indigo-700' : 'text-emerald-700 bg-emerald-100 hover:bg-emerald-200'">
                                Detail Skema <ArrowRight class="w-4 h-4 ml-1.5" />
                            </Link>
                        </div>
                    </div>
                </div>

                <!-- Empty State -->
                <div v-else class="flex flex-col items-center justify-center py-16 px-4 text-center bg-white rounded-3xl border border-dashed border-slate-300">
                    <div class="w-20 h-20 mb-5 rounded-full bg-slate-100 flex items-center justify-center">
                        <Inbox class="w-10 h-10 text-slate-400" />
                    </div>
                    <h3 class="text-xl font-bold text-slate-900 mb-2">Skema Tidak Ditemukan</h3>
                    <p class="text-slate-500 max-w-sm mb-6">
                        Maaf, tidak ada skema sertifikasi yang cocok dengan kata kunci atau filter yang dipilih.
                    </p>
                    <button @click="searchQuery = ''; selectedCategory = 'all'" 
                            class="px-6 py-2.5 bg-white border border-slate-200 rounded-xl text-sm font-bold text-slate-700 hover:bg-slate-50 transition-colors shadow-sm focus:outline-none focus:ring-2 focus:ring-slate-500/20">
                        Reset Pencarian
                    </button>
                </div>

            </div>

            <!-- Footer partial in page -->
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
