<script setup>
import { Head, Link } from '@inertiajs/vue3';
import { ShieldCheck, UserCircle, Search, Menu, X, ArrowRight, Calendar, BookOpen } from 'lucide-vue-next';
import { ref, computed, watch, onMounted } from 'vue';
import CarouselBackground from '@/Components/CarouselBackground.vue';

const props = defineProps({
    canLogin: { type: Boolean },
    canRegister: { type: Boolean },
    posts: { type: Array, default: () => [] }
});

const searchQuery = ref('');
const selectedCategory = ref('all');
const isMobileMenuOpen = ref(false);

const categories = computed(() => {
    const cats = new Set(props.posts.map(p => p.category));
    return ['all', ...Array.from(cats)];
});

const filteredPosts = computed(() => {
    return props.posts.filter(post => {
        const matchesCategory = selectedCategory.value === 'all' || post.category === selectedCategory.value;
        const query = searchQuery.value.toLowerCase();
        const matchesSearch = post.title.toLowerCase().includes(query) || (post.content && post.content.toLowerCase().includes(query));
        return matchesCategory && matchesSearch;
    });
});

const formatDate = (dateString) => {
    if (!dateString) return '';
    const date = new Date(dateString);
    return new Intl.DateTimeFormat('id-ID', { day: 'numeric', month: 'long', year: 'numeric' }).format(date);
};

const getBadgeColor = (category) => {
    switch(category) {
        case 'Berita': return 'bg-blue-100 text-blue-800 border-blue-200';
        case 'Artikel': return 'bg-emerald-100 text-emerald-800 border-emerald-200';
        case 'Tips & Trik': return 'bg-amber-100 text-amber-800 border-amber-200';
        case 'Pengumuman': return 'bg-rose-100 text-rose-800 border-rose-200';
        default: return 'bg-slate-100 text-slate-800 border-slate-200';
    }
};

const isLoading = ref(true);

onMounted(() => {
    setTimeout(() => { isLoading.value = false; }, 600);
});

watch([searchQuery, selectedCategory], () => {
    isLoading.value = true;
    setTimeout(() => { isLoading.value = false; }, 400);
});
</script>

<template>
    <Head title="Knowledge Hub - Siberdata LSP" />

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
                        <Link href="/dokumen" class="text-sm font-bold text-slate-600 hover:text-blue-700 transition-colors">Dokumen</Link>
                        <Link href="/berita" class="text-sm font-bold text-blue-700 transition-colors">Berita</Link>
                        <Link href="/about" class="text-sm font-bold text-slate-600 hover:text-blue-700 transition-colors">About</Link>
                        
                        <div class="h-6 w-px bg-slate-300 mx-2"></div>
                        
                        <div v-if="canLogin" class="flex items-center space-x-6">
                            <Link v-if="$page.props.auth.user" :href="route('dashboard')" class="text-sm font-bold text-slate-600 hover:text-blue-700 transition-colors">Portal Admin</Link>
                            <template v-else>
                                <Link :href="route('login')" class="text-sm font-bold text-slate-600 hover:text-blue-700 transition-colors flex items-center group">
                                    <UserCircle class="w-4 h-4 mr-1.5 group-hover:text-blue-700 text-slate-400 transition-colors" /> Login Asesor
                                </Link>
                                <Link v-if="canRegister" :href="route('register')" class="inline-flex items-center justify-center px-5 py-2.5 border border-transparent text-sm font-bold rounded-xl text-white bg-indigo-600 hover:bg-indigo-700 shadow-sm transition-all hover:shadow-md hover:-translate-y-0.5">
                                    Portal Asesi
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

            <!-- Mobile menu -->
            <div v-show="isMobileMenuOpen" class="md:hidden bg-white border-b border-slate-200 absolute w-full shadow-lg">
                <div class="px-4 pt-2 pb-6 space-y-1">
                    <Link href="/" class="block px-3 py-3 rounded-md text-base font-medium text-slate-700 hover:text-blue-700 hover:bg-slate-50">Home</Link>
                    <Link href="/skema" class="block px-3 py-3 rounded-md text-base font-medium text-slate-700 hover:text-blue-700 hover:bg-slate-50">Skema</Link>
                    <Link href="/dokumen" class="block px-3 py-3 rounded-md text-base font-medium text-slate-700 hover:text-blue-700 hover:bg-slate-50">Dokumen</Link>
                    <Link href="/berita" class="block px-3 py-3 rounded-md text-base font-bold text-blue-700 bg-blue-50/50">Berita</Link>
                    <Link href="/about" class="block px-3 py-3 rounded-md text-base font-medium text-slate-700 hover:text-blue-700 hover:bg-slate-50">About</Link>
                </div>
            </div>
        </nav>

        <!-- Main Content -->
        <main class="relative z-10 pt-16 sm:pt-24 pb-16">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                
                <!-- Header -->
                <div class="text-center max-w-3xl mx-auto mb-16">
                    <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-blue-100/80 border border-blue-200 text-blue-700 text-sm font-semibold mb-6 backdrop-blur-sm">
                        <BookOpen class="w-4 h-4" />
                        Knowledge Hub
                    </div>
                    <h1 class="text-4xl md:text-5xl font-extrabold text-slate-900 tracking-tight mb-6">
                        Berita & Wawasan <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-700 to-teal-500">Terkini</span>
                    </h1>
                    <p class="text-lg md:text-xl text-slate-600 leading-relaxed">
                        Ikuti perkembangan terbaru di dunia keamanan siber, artikel edukasi, dan pengumuman resmi dari LSP Siberdata.
                    </p>
                </div>

                <!-- Search & Filters -->
                <div class="mb-12 space-y-6">
                    <!-- Search Bar -->
                    <div class="relative max-w-2xl mx-auto group">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <Search class="h-5 w-5 text-slate-400 group-focus-within:text-blue-600 transition-colors" />
                        </div>
                        <input 
                            v-model="searchQuery"
                            type="text" 
                            class="block w-full pl-11 pr-4 py-4 md:py-5 border-slate-200 rounded-2xl leading-5 bg-white/80 backdrop-blur-md placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 sm:text-lg transition-all shadow-sm group-hover:shadow-md hover:border-blue-300" 
                            placeholder="Cari berdasarkan judul atau isi artikel..."
                        >
                    </div>

                    <!-- Categories Pill -->
                    <div class="flex flex-wrap items-center justify-center gap-3">
                        <button 
                            @click="selectedCategory = 'all'"
                            :class="['px-5 py-2.5 rounded-full text-sm font-semibold transition-all duration-300 shadow-sm border', selectedCategory === 'all' ? 'bg-slate-800 text-white border-slate-800 scale-105' : 'bg-white/80 text-slate-600 border-slate-200 hover:bg-slate-50 hover:border-slate-300 backdrop-blur-sm']"
                        >
                            Semua Kategori <span class="ml-1.5 opacity-60 text-xs">({{ props.posts.length }})</span>
                        </button>

                        <button 
                            v-for="category in categories.filter(c => c !== 'all')" 
                            :key="category"
                            @click="selectedCategory = category"
                            :class="['px-5 py-2.5 rounded-full text-sm font-semibold transition-all duration-300 shadow-sm border', selectedCategory === category ? 'bg-slate-800 text-white border-slate-800 scale-105' : 'bg-white/80 text-slate-600 border-slate-200 hover:bg-slate-50 hover:border-slate-300 backdrop-blur-sm']"
                        >
                            {{ category }} <span class="ml-1.5 opacity-60 text-xs">({{ props.posts.filter(p => p.category === category).length }})</span>
                        </button>
                    </div>
                </div>

                <!-- Posts Grid -->
                <div class="min-h-[400px]">
                    <div v-if="isLoading" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                        <div v-for="n in 6" :key="n" class="bg-white rounded-3xl p-4 border border-slate-200 shadow-sm h-96 animate-pulse">
                            <div class="h-48 bg-slate-200 rounded-2xl mb-4"></div>
                            <div class="h-6 bg-slate-200 rounded-full w-3/4 mb-3"></div>
                            <div class="h-4 bg-slate-200 rounded-full w-full mb-2"></div>
                            <div class="h-4 bg-slate-200 rounded-full w-5/6"></div>
                        </div>
                    </div>

                    <div v-else-if="filteredPosts.length === 0" class="text-center py-20 bg-white/50 backdrop-blur-sm rounded-3xl border border-slate-200 shadow-sm">
                        <div class="w-20 h-20 bg-slate-100 rounded-full flex items-center justify-center mx-auto mb-6">
                            <Search class="h-10 w-10 text-slate-400" />
                        </div>
                        <h3 class="text-2xl font-bold text-slate-900 mb-2">Tidak ada artikel ditemukan</h3>
                        <p class="text-slate-500 max-w-md mx-auto">Kami tidak dapat menemukan artikel yang cocok dengan pencarian atau filter Anda.</p>
                        <button @click="searchQuery = ''; selectedCategory = 'all'" class="mt-8 px-6 py-3 bg-white border border-slate-300 text-slate-700 font-semibold rounded-xl hover:bg-slate-50 transition-colors shadow-sm">
                            Reset Pencarian
                        </button>
                    </div>

                    <div v-else class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                        <div v-for="(post, index) in filteredPosts" :key="post.id" 
                            class="bg-white/90 backdrop-blur-md rounded-3xl overflow-hidden border border-slate-200/60 shadow-sm hover:shadow-xl hover:shadow-blue-900/5 transition-all duration-300 group flex flex-col h-full hover:-translate-y-1">
                            <div class="h-56 overflow-hidden relative">
                                <img v-if="post.thumbnail" :src="'/storage/' + post.thumbnail" :alt="post.title" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105" />
                                <div v-else class="w-full h-full bg-slate-100 flex items-center justify-center">
                                    <ShieldCheck class="w-16 h-16 text-slate-300" />
                                </div>
                                <div class="absolute top-4 right-4">
                                    <span :class="['px-3 py-1 rounded-full text-xs font-bold border backdrop-blur-md shadow-sm', getBadgeColor(post.category)]">
                                        {{ post.category }}
                                    </span>
                                </div>
                            </div>
                            <div class="p-6 flex-1 flex flex-col">
                                <div class="flex items-center gap-2 text-slate-500 text-xs font-medium mb-3">
                                    <Calendar class="w-3.5 h-3.5" />
                                    {{ formatDate(post.created_at) }}
                                </div>
                                <h3 class="text-xl font-bold text-slate-900 leading-snug mb-3 group-hover:text-blue-700 transition-colors line-clamp-2">
                                    {{ post.title }}
                                </h3>
                                <!-- Strip HTML tags for preview and clamp to 3 lines -->
                                <p class="text-slate-600 text-sm leading-relaxed mb-6 line-clamp-3" v-html="post.content.replace(/<[^>]*>?/gm, '')"></p>
                                
                                <div class="mt-auto">
                                    <Link :href="route('post.show', post.slug)" class="inline-flex items-center text-sm font-bold text-blue-600 hover:text-blue-800 transition-colors">
                                        Baca Selengkapnya
                                        <ArrowRight class="ml-1 w-4 h-4 transition-transform group-hover:translate-x-1" />
                                    </Link>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</template>
