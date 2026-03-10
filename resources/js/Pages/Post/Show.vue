<script setup>
import { Head, Link } from '@inertiajs/vue3';
import { ShieldCheck, UserCircle, Menu, X, ArrowLeft, Calendar, User, Tag, Share2, Facebook, Twitter, Linkedin, Check } from 'lucide-vue-next';
import { ref, onMounted } from 'vue';
import { toast } from 'vue-sonner';

const props = defineProps({
    canLogin: { type: Boolean },
    canRegister: { type: Boolean },
    post: { type: Object, required: true }
});

const isMobileMenuOpen = ref(false);
const isScrolled = ref(false);
const showCopyTooltip = ref(false);

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

const copyLink = () => {
    navigator.clipboard.writeText(window.location.href);
    showCopyTooltip.value = true;
    toast.success('Link berita berhasil disalin!');
    setTimeout(() => { showCopyTooltip.value = false; }, 2000);
};

onMounted(() => {
    window.addEventListener('scroll', () => {
        isScrolled.value = window.scrollY > 20;
    });
});
</script>

<template>
    <Head :title="post.title + ' - Siberdata LSP'" />

    <div class="min-h-screen bg-slate-50 font-sans text-slate-900 selection:bg-blue-500 selection:text-white pb-20">
        
        <!-- Navbar -->
        <nav :class="['fixed w-full z-50 transition-all duration-300 border-b', isScrolled ? 'bg-white/90 backdrop-blur-md border-slate-200 shadow-sm py-2' : 'bg-white border-transparent py-4']">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-center">
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
                    <Link href="/berita" class="block px-3 py-3 rounded-md text-base font-medium text-slate-700 hover:text-blue-700 hover:bg-slate-50">Back to Berita</Link>
                </div>
            </div>
        </nav>

        <!-- Main Content -->
        <main class="pt-32 pb-16">
            <article class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
                
                <!-- Back Button & Breadcrumb -->
                <div class="mb-8">
                    <Link href="/berita" class="inline-flex items-center text-sm font-semibold text-slate-500 hover:text-blue-700 transition-colors group">
                        <ArrowLeft class="w-4 h-4 mr-2 transition-transform group-hover:-translate-x-1" />
                        Kembali ke Knowledge Hub
                    </Link>
                </div>

                <!-- Article Header -->
                <header class="mb-10 text-center md:text-left">
                    <div class="flex flex-wrap items-center justify-center md:justify-start gap-4 mb-6">
                        <span :class="['px-3 py-1 rounded-full text-xs font-bold border', getBadgeColor(post.category)]">
                            {{ post.category }}
                        </span>
                        <div class="flex items-center text-sm font-medium text-slate-500">
                            <Calendar class="w-4 h-4 mr-1.5" />
                            {{ formatDate(post.created_at) }}
                        </div>
                    </div>
                    <h1 class="text-4xl md:text-5xl lg:text-5xl font-extrabold text-slate-900 tracking-tight leading-tight mb-6">
                        {{ post.title }}
                    </h1>
                </header>

                <!-- Featured Image -->
                <div class="mb-12 rounded-3xl overflow-hidden shadow-xl shadow-slate-200/50 border border-slate-200 bg-white aspect-video relative">
                    <img v-if="post.thumbnail" :src="'/storage/' + post.thumbnail" :alt="post.title" class="w-full h-full object-cover" />
                    <div v-else class="w-full h-full bg-slate-100 flex items-center justify-center">
                        <ShieldCheck class="w-24 h-24 text-slate-300" />
                    </div>
                </div>

                <!-- Article Body & Sidebar -->
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-12">
                    
                    <!-- Content -->
                    <div class="lg:col-span-8 prose prose-slate prose-lg md:prose-xl max-w-none prose-headings:font-bold prose-headings:tracking-tight prose-a:text-blue-600 prose-img:rounded-2xl prose-img:shadow-md">
                        <div v-html="post.content"></div>
                    </div>

                    <!-- Sidebar Share/Author -->
                    <div class="lg:col-span-4 space-y-8">
                        <!-- Sticky container -->
                        <div class="sticky top-32">
                            <!-- Share block -->
                            <div class="bg-white rounded-3xl p-6 border border-slate-200 shadow-sm">
                                <h3 class="text-lg font-bold text-slate-900 mb-4 flex items-center gap-2">
                                    <Share2 class="w-5 h-5 text-blue-600" /> Bagikan Artikel
                                </h3>
                                <div class="flex flex-wrap gap-2">
                                    <button @click="copyLink" class="flex-1 flex justify-center items-center py-2.5 px-4 bg-slate-50 hover:bg-slate-100 text-slate-700 rounded-xl border border-slate-200 transition-colors font-semibold text-sm relative">
                                        <span v-if="showCopyTooltip" class="flex items-center text-emerald-600"><Check class="w-4 h-4 mr-1"/> Disalin</span>
                                        <span v-else>Salin Link</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </article>
        </main>
    </div>
</template>
