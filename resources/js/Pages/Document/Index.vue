<script setup>
import { Head, Link } from '@inertiajs/vue3';
import { ShieldCheck, UserCircle, Search, Menu, X, FileText, Download, Filter } from 'lucide-vue-next';
import { ref, computed, watch, onMounted } from 'vue';
import CarouselBackground from '@/Components/CarouselBackground.vue';

const props = defineProps({
    canLogin: { type: Boolean },
    canRegister: { type: Boolean },
    documents: { type: Array, default: () => [] }
});

const searchQuery = ref('');
const selectedType = ref('all');
const isMobileMenuOpen = ref(false);

const types = computed(() => {
    const cats = new Set(props.documents.map(d => d.type));
    return ['all', ...Array.from(cats)];
});

const filteredDocuments = computed(() => {
    return props.documents.filter(doc => {
        const matchesType = selectedType.value === 'all' || doc.type === selectedType.value;
        const query = searchQuery.value.toLowerCase();
        const matchesSearch = doc.name.toLowerCase().includes(query) || (doc.description && doc.description.toLowerCase().includes(query));
        return matchesType && matchesSearch;
    });
});

const getDocIconColor = (type) => {
    switch(type) {
        case 'SKKNI TIK': return 'text-blue-500 bg-blue-100';
        case 'SKKNI PDP': return 'text-teal-500 bg-teal-100';
        default: return 'text-slate-500 bg-slate-100';
    }
};

const isLoading = ref(true);

onMounted(() => {
    setTimeout(() => { isLoading.value = false; }, 600);
});

watch([searchQuery, selectedType], () => {
    isLoading.value = true;
    setTimeout(() => { isLoading.value = false; }, 400);
});
</script>

<template>
    <Head title="Dokumen Resmi - Siberdata LSP" />

    <div class="min-h-screen bg-slate-50 font-sans text-slate-900 selection:bg-blue-500 selection:text-white pb-20 relative overflow-hidden">
        <CarouselBackground />

        <!-- Navbar -->
        <nav class="relative z-50 bg-white/80 backdrop-blur-md border-b border-slate-200 sticky top-0 transition-all duration-300">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16 sm:h-20">
                    <div class="flex items-center">
                        <Link href="/" class="flex items-center gap-2 group">
                            <ShieldCheck class="h-8 w-8 text-blue-700 group-hover:scale-110 transition-transform duration-300" />
                            <span class="font-extrabold text-xl tracking-tight text-slate-800">
                                LSP <span class="text-blue-700">Siberdata</span>
                            </span>
                        </Link>
                    </div>

                    <div class="hidden md:flex items-center space-x-8">
                        <Link href="/" class="text-sm font-bold text-slate-600 hover:text-blue-700 transition-colors">Home</Link>
                        <Link href="/skema" class="text-sm font-bold text-slate-600 hover:text-blue-700 transition-colors">Skema</Link>
                        <Link href="/dokumen" class="text-sm font-bold text-blue-700 transition-colors">Dokumen</Link>
                        <Link href="/berita" class="text-sm font-bold text-slate-600 hover:text-blue-700 transition-colors">Berita</Link>
                        <Link href="/about" class="text-sm font-bold text-slate-600 hover:text-blue-700 transition-colors">About</Link>
                        
                        <div class="h-6 w-px bg-slate-300 mx-2"></div>
                        
                        <div v-if="canLogin" class="flex items-center space-x-6">
                            <Link v-if="$page.props.auth.user" :href="route('dashboard')" class="text-sm font-bold text-slate-600 hover:text-blue-700 transition-colors">Portal Admin</Link>
                            <template v-else>
                                <Link :href="route('login')" class="text-sm font-bold text-slate-600 hover:text-blue-700 transition-colors flex items-center group">
                                    <UserCircle class="w-4 h-4 mr-1.5 group-hover:text-blue-700 text-slate-400 transition-colors" /> Login Asesor
                                </Link>
                            </template>
                        </div>
                    </div>

                    <div class="flex items-center md:hidden">
                        <button @click="isMobileMenuOpen = !isMobileMenuOpen" class="text-slate-500 hover:text-slate-700 p-2 rounded-md hover:bg-slate-100 transition-colors">
                            <Menu v-if="!isMobileMenuOpen" class="h-6 w-6" />
                            <X v-else class="h-6 w-6" />
                        </button>
                    </div>
                </div>
            </div>

            <div v-show="isMobileMenuOpen" class="md:hidden bg-white border-b border-slate-200 absolute w-full shadow-lg">
                <div class="px-4 pt-2 pb-6 space-y-1">
                    <Link href="/" class="block px-3 py-3 rounded-md text-base font-medium text-slate-700 hover:text-blue-700 hover:bg-slate-50">Home</Link>
                    <Link href="/skema" class="block px-3 py-3 rounded-md text-base font-medium text-slate-700 hover:text-blue-700 hover:bg-slate-50">Skema</Link>
                    <Link href="/dokumen" class="block px-3 py-3 rounded-md text-base font-bold text-blue-700 bg-blue-50/50">Dokumen</Link>
                    <Link href="/berita" class="block px-3 py-3 rounded-md text-base font-medium text-slate-700 hover:text-blue-700 hover:bg-slate-50">Berita</Link>
                    <Link href="/about" class="block px-3 py-3 rounded-md text-base font-medium text-slate-700 hover:text-blue-700 hover:bg-slate-50">About</Link>
                </div>
            </div>
        </nav>

        <!-- Main Content -->
        <main class="relative z-10 pt-16 sm:pt-24 pb-16">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                
                <!-- Header -->
                <div class="text-center max-w-3xl mx-auto mb-16">
                    <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-teal-100/80 border border-teal-200 text-teal-700 text-sm font-semibold mb-6 backdrop-blur-sm">
                        <FileText class="w-4 h-4" />
                        Resource Center
                    </div>
                    <h1 class="text-4xl md:text-5xl font-extrabold text-slate-900 tracking-tight mb-6">
                        Dokumen Standar & <span class="text-transparent bg-clip-text bg-gradient-to-r from-teal-600 to-blue-500">Panduan</span>
                    </h1>
                    <p class="text-lg md:text-xl text-slate-600 leading-relaxed">
                        Unduh dokumen SKKNI, panduan teknis asesmen, dan formulir pendaftaran ujian kompetensi LSP Siberdata.
                    </p>
                </div>

                <!-- Search & Filters -->
                <div class="mb-12 space-y-6">
                    <div class="relative max-w-2xl mx-auto group">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <Search class="h-5 w-5 text-slate-400 group-focus-within:text-teal-600 transition-colors" />
                        </div>
                        <input 
                            v-model="searchQuery"
                            type="text" 
                            class="block w-full pl-11 pr-4 py-4 md:py-5 border-slate-200 rounded-2xl leading-5 bg-white/80 backdrop-blur-md placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-teal-500 sm:text-lg transition-all shadow-sm group-hover:shadow-md hover:border-teal-300" 
                            placeholder="Cari nama dokumen atau deskripsi..."
                        >
                    </div>

                    <div class="flex flex-wrap items-center justify-center gap-3">
                        <button 
                            @click="selectedType = 'all'"
                            :class="['px-5 py-2.5 rounded-full text-sm font-semibold transition-all duration-300 shadow-sm border', selectedType === 'all' ? 'bg-slate-800 text-white border-slate-800 scale-105' : 'bg-white/80 text-slate-600 border-slate-200 hover:bg-slate-50 hover:border-slate-300 backdrop-blur-sm']"
                        >
                            Semua Dokumen <span class="ml-1.5 opacity-60 text-xs">({{ props.documents.length }})</span>
                        </button>

                        <button 
                            v-for="type in types.filter(t => t !== 'all')" 
                            :key="type"
                            @click="selectedType = type"
                            :class="['px-5 py-2.5 rounded-full text-sm font-semibold transition-all duration-300 shadow-sm border', selectedType === type ? 'bg-slate-800 text-white border-slate-800 scale-105' : 'bg-white/80 text-slate-600 border-slate-200 hover:bg-slate-50 hover:border-slate-300 backdrop-blur-sm']"
                        >
                            {{ type }} <span class="ml-1.5 opacity-60 text-xs">({{ props.documents.filter(d => d.type === type).length }})</span>
                        </button>
                    </div>
                </div>

                <!-- Documents Grid -->
                <div class="min-h-[400px]">
                    <div v-if="isLoading" class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div v-for="n in 4" :key="n" class="bg-white rounded-3xl p-6 border border-slate-200 shadow-sm animate-pulse flex items-start space-x-4">
                            <div class="w-12 h-12 bg-slate-200 rounded-xl"></div>
                            <div class="flex-1 space-y-3">
                                <div class="h-5 bg-slate-200 rounded-full w-2/3"></div>
                                <div class="h-4 bg-slate-200 rounded-full w-full"></div>
                            </div>
                        </div>
                    </div>

                    <div v-else-if="filteredDocuments.length === 0" class="text-center py-20 bg-white/50 backdrop-blur-sm rounded-3xl border border-slate-200 shadow-sm">
                        <div class="w-20 h-20 bg-slate-100 rounded-full flex items-center justify-center mx-auto mb-6">
                            <FileText class="h-10 w-10 text-slate-400" />
                        </div>
                        <h3 class="text-2xl font-bold text-slate-900 mb-2">Dokumen tidak ditemukan</h3>
                        <p class="text-slate-500 max-w-md mx-auto">Coba gunakan kata kunci lain atau pilih kategori Semua Dokumen.</p>
                        <button @click="searchQuery = ''; selectedType = 'all'" class="mt-8 px-6 py-3 bg-white border border-slate-300 text-slate-700 font-semibold rounded-xl hover:bg-slate-50 transition-colors shadow-sm">
                            Reset Pencarian
                        </button>
                    </div>

                    <div v-else class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-6">
                        <div v-for="doc in filteredDocuments" :key="doc.id" 
                            class="bg-white/90 backdrop-blur-md rounded-3xl p-6 border border-slate-200/60 shadow-sm hover:shadow-lg transition-all duration-300 group flex items-start gap-5 hover:-translate-y-1">
                            <div :class="['p-3 rounded-2xl flex-shrink-0', getDocIconColor(doc.type)]">
                                <FileText class="w-8 h-8" />
                            </div>
                            <div class="flex-1">
                                <div class="flex items-center gap-2 mb-2">
                                    <span class="text-xs font-bold text-slate-500 uppercase tracking-wider">{{ doc.type }}</span>
                                </div>
                                <h3 class="text-lg font-bold text-slate-900 leading-snug mb-2 group-hover:text-teal-700 transition-colors">
                                    {{ doc.name }}
                                </h3>
                                <p class="text-slate-600 text-sm leading-relaxed mb-4">
                                    {{ doc.description || 'Tidak ada deskripsi.' }}
                                </p>
                                
                                <div class="flex items-center">
                                    <a v-if="doc.file_path" :href="'/storage/' + doc.file_path" target="_blank" download class="inline-flex items-center text-sm font-bold text-teal-600 hover:text-teal-800 transition-colors hover:bg-teal-50 px-4 py-2 rounded-xl -ml-4">
                                        <Download class="w-4 h-4 mr-2" />
                                        Unduh Dokumen (PDF)
                                    </a>
                                    <span v-else class="text-sm font-medium text-slate-400 flex items-center">
                                        File tidak tersedia
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </main>
    </div>
</template>
