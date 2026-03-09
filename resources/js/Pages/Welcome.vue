<script setup>
import { Head, Link } from '@inertiajs/vue3';
import { ShieldCheck, LockKeyhole, ArrowRight, UserCircle, ServerCog, Search, Inbox } from 'lucide-vue-next';
import { ref } from 'vue';
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
