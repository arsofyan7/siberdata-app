<script setup>
import { Head, Link, useForm } from '@inertiajs/vue3';
import { 
    Award, 
    User, 
    Briefcase, 
    CheckCircle, 
    ChevronRight,
    ChevronLeft,
    ShieldCheck,
    Save
} from 'lucide-vue-next';
import { ref, computed, onMounted } from 'vue';

const props = defineProps({
    schemes: Array,
    selectedSchemeId: String
});

const currentStep = ref(1);
const totalSteps = 4;

const form = useForm({
    scheme_id: props.selectedSchemeId || '',
    personal_data: {
        nik: '',
        full_name: '',
        address: '',
        phone: ''
    },
    work_data: {
        company: '',
        job_title: '',
        office_address: ''
    }
});

const nextStep = () => {
    if (currentStep.value < totalSteps) currentStep.value++;
};

const prevStep = () => {
    if (currentStep.value > 1) currentStep.value--;
};

const submit = () => {
    form.post('/register-certification', {
        preserveScroll: true,
        onSuccess: () => {
            // Optional: redirect handling exists in controller
        }
    });
};

const steps = [
    { title: 'Pilih Skema', icon: Award },
    { title: 'Data Pribadi', icon: User },
    { title: 'Pekerjaan', icon: Briefcase },
    { title: 'Konfirmasi', icon: CheckCircle }
];

const selectedScheme = computed(() => {
    return props.schemes.find(s => s.id === form.scheme_id);
});

onMounted(() => {
    // If scheme was auto-selected via URL, jump to step 2 if desired
    // if(form.scheme_id) currentStep.value = 2;
});
</script>

<template>
    <Head title="Pendaftaran APL-01 - Portal Asesi" />

    <div class="min-h-screen font-sans bg-slate-50 text-slate-900 dark:bg-slate-950 dark:text-slate-200 py-12 px-4 sm:px-6 lg:px-8 relative overflow-hidden transition-colors duration-300">
        
        <!-- Mesh Gradients -->
        <div class="fixed top-[-10%] left-[-10%] w-[50%] h-[50%] bg-violet-400/20 dark:bg-violet-900/30 rounded-full mix-blend-multiply dark:mix-blend-screen filter blur-[100px] pointer-events-none"></div>
        <div class="fixed bottom-[-10%] right-[-5%] w-[40%] h-[50%] bg-cyan-400/20 dark:bg-cyan-900/20 rounded-full mix-blend-multiply dark:mix-blend-screen filter blur-[100px] pointer-events-none"></div>

        <div class="max-w-4xl mx-auto relative z-10">
            
            <!-- Header -->
            <div class="text-center mb-12">
                <div class="inline-flex items-center justify-center p-3 bg-cyan-100 dark:bg-cyan-500/20 rounded-2xl mb-4 border border-cyan-200 dark:border-cyan-500/30">
                    <ShieldCheck class="w-10 h-10 text-cyan-600 dark:text-cyan-400" />
                </div>
                <h1 class="text-3xl sm:text-4xl font-extrabold text-slate-900 dark:text-white tracking-tight bg-clip-text">Formulir Pendaftaran Sertifikasi</h1>
                <p class="mt-3 text-slate-600 dark:text-slate-400 font-medium">Lengkapi Biodata APL-01 untuk memulai perjalanan kompetensi Anda.</p>
            </div>

            <!-- Progress Tracker -->
            <div class="mb-10">
                <div class="flex items-center justify-between relative">
                    <div class="absolute left-0 top-1/2 -translate-y-1/2 w-full h-1 bg-slate-200 dark:bg-slate-800 z-0 rounded-full"></div>
                    <div class="absolute left-0 top-1/2 -translate-y-1/2 h-1 bg-cyan-500 z-0 rounded-full transition-all duration-500" :style="`width: ${((currentStep - 1) / (totalSteps - 1)) * 100}%`"></div>
                    
                    <div v-for="(step, index) in steps" :key="index" class="relative z-10 flex flex-col items-center">
                        <div class="w-10 h-10 rounded-full flex items-center justify-center font-bold border-4 transition-colors duration-300"
                             :class="currentStep > index + 1 ? 'bg-cyan-500 text-white border-white dark:border-slate-950 shadow-[0_0_15px_rgba(34,211,238,0.5)]' : 
                                     currentStep === index + 1 ? 'bg-white dark:bg-slate-900 text-cyan-600 dark:text-cyan-400 border-cyan-500 shadow-[0_0_15px_rgba(34,211,238,0.3)]' : 
                                     'bg-slate-100 dark:bg-slate-800 text-slate-400 dark:text-slate-500 border-white dark:border-slate-950'">
                            <component :is="step.icon" class="w-5 h-5" v-if="currentStep <= index + 1" />
                            <CheckCircle class="w-5 h-5" v-else />
                        </div>
                        <span class="text-xs font-bold mt-2" 
                              :class="currentStep >= index + 1 ? 'text-cyan-700 dark:text-cyan-400' : 'text-slate-500 dark:text-slate-500'">
                            {{ step.title }}
                        </span>
                    </div>
                </div>
            </div>

            <!-- Form Card (Glassmorphism) -->
            <div class="bg-white/80 dark:bg-slate-900/60 backdrop-blur-xl border border-slate-200 dark:border-slate-800 rounded-3xl p-8 shadow-xl relative overflow-hidden">
                <form @submit.prevent="submit">
                    
                    <!-- STEP 1: Pilih Skema -->
                    <div v-if="currentStep === 1" class="animate-fade-in">
                        <h2 class="text-xl font-bold dark:text-white mb-6">Pilih Skema Sertifikasi</h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <label v-for="s in schemes" :key="s.id" 
                                   class="relative flex cursor-pointer rounded-2xl border p-5 shadow-sm focus:outline-none transition-all duration-200"
                                   :class="form.scheme_id === s.id ? 'bg-cyan-50 dark:bg-cyan-500/10 border-cyan-500 dark:border-cyan-500 ring-2 ring-cyan-500 dark:ring-cyan-500' : 'bg-white dark:bg-slate-800 border-slate-200 dark:border-slate-700 hover:border-cyan-300 dark:hover:border-slate-600'">
                                <input type="radio" name="scheme" :value="s.id" v-model="form.scheme_id" class="sr-only" />
                                <div class="flex w-full items-center justify-between">
                                    <div class="flex items-center">
                                        <div class="text-sm">
                                            <p class="font-bold text-slate-900 dark:text-white">{{ s.name }}</p>
                                            <div class="text-slate-500 dark:text-slate-400 mt-1 text-xs font-mono bg-slate-100 dark:bg-slate-900 px-2 py-1 rounded inline-block">{{ s.code }}</div>
                                        </div>
                                    </div>
                                    <CheckCircle v-if="form.scheme_id === s.id" class="h-6 w-6 text-cyan-600 dark:text-cyan-400" />
                                </div>
                            </label>
                        </div>
                        <p v-if="!form.scheme_id && form.errors.scheme_id" class="text-red-500 text-sm mt-4">{{ form.errors.scheme_id }}</p>
                    </div>

                    <!-- STEP 2: Data Pribadi -->
                    <div v-if="currentStep === 2" class="animate-fade-in">
                        <h2 class="text-xl font-bold dark:text-white mb-6">Data Pribadi Asesi</h2>
                        <div class="space-y-6">
                            <div>
                                <label class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-2">NIK (16 Digit)</label>
                                <input type="text" v-model="form.personal_data.nik" maxlength="16" class="w-full rounded-xl border border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-900/50 text-slate-900 dark:text-white focus:border-cyan-500 focus:ring-cyan-500 px-4 py-3" placeholder="Masukkan 16 digit NIK pendudukan" />
                            </div>
                            <div>
                                <label class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-2">Nama Lengkap (Sesuai KTP)</label>
                                <input type="text" v-model="form.personal_data.full_name" class="w-full rounded-xl border border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-900/50 text-slate-900 dark:text-white focus:border-cyan-500 focus:ring-cyan-500 px-4 py-3" placeholder="Contoh: John Doe" />
                            </div>
                            <div>
                                <label class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-2">Alamat Tinggal</label>
                                <textarea v-model="form.personal_data.address" rows="3" class="w-full rounded-xl border border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-900/50 text-slate-900 dark:text-white focus:border-cyan-500 focus:ring-cyan-500 px-4 py-3" placeholder="Masukkan alamat domisili saat ini"></textarea>
                            </div>
                            <div>
                                <label class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-2">Nomor HP / WhatsApp Aktif</label>
                                <input type="tel" v-model="form.personal_data.phone" class="w-full rounded-xl border border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-900/50 text-slate-900 dark:text-white focus:border-cyan-500 focus:ring-cyan-500 px-4 py-3" placeholder="08xxxxxxxxxx" />
                            </div>
                        </div>
                    </div>

                    <!-- STEP 3: Pekerjaan -->
                    <div v-if="currentStep === 3" class="animate-fade-in">
                        <h2 class="text-xl font-bold dark:text-white mb-6">Data Pekerjaan/Instansi</h2>
                        <div class="space-y-6">
                            <div>
                                <label class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-2">Nama Perusahaan / Instansi</label>
                                <input type="text" v-model="form.work_data.company" class="w-full rounded-xl border border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-900/50 text-slate-900 dark:text-white focus:border-cyan-500 focus:ring-cyan-500 px-4 py-3" placeholder="Contoh: PT Teknologi Siber Maju" />
                            </div>
                            <div>
                                <label class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-2">Jabatan Saat Ini</label>
                                <input type="text" v-model="form.work_data.job_title" class="w-full rounded-xl border border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-900/50 text-slate-900 dark:text-white focus:border-cyan-500 focus:ring-cyan-500 px-4 py-3" placeholder="Contoh: IT Security Analyst" />
                            </div>
                            <div>
                                <label class="block text-sm font-bold text-slate-700 dark:text-slate-300 mb-2">Alamat Kantor/Instansi</label>
                                <textarea v-model="form.work_data.office_address" rows="3" class="w-full rounded-xl border border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-900/50 text-slate-900 dark:text-white focus:border-cyan-500 focus:ring-cyan-500 px-4 py-3" placeholder="Alamat lengkap instansi tempat bekerja saat ini"></textarea>
                            </div>
                        </div>
                    </div>

                    <!-- STEP 4: Konfirmasi -->
                    <div v-if="currentStep === 4" class="animate-fade-in">
                        <div class="text-center mb-6">
                            <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-full bg-emerald-100 dark:bg-emerald-500/20 mb-4">
                                <CheckCircle class="h-8 w-8 text-emerald-600 dark:text-emerald-400" />
                            </div>
                            <h2 class="text-2xl font-bold dark:text-white">Konfirmasi Data Registrasi</h2>
                            <p class="text-slate-500 dark:text-slate-400 mt-2">Pastikan semua isian ini valid sebelum Anda menyerahkan form APL-01.</p>
                        </div>

                        <div class="bg-slate-50 dark:bg-slate-900/50 border border-slate-200 dark:border-slate-700 rounded-2xl p-6 space-y-4 text-sm mb-6">
                            <div class="flex flex-col sm:flex-row sm:justify-between border-b pb-4 dark:border-slate-700">
                                <span class="font-bold text-slate-500 dark:text-slate-400">Skema Tujuan:</span>
                                <span class="text-slate-900 dark:text-white font-bold text-right">{{ selectedScheme?.name || '-' }}</span>
                            </div>
                            <div class="flex flex-col sm:flex-row sm:justify-between border-b pb-4 dark:border-slate-700">
                                <span class="font-bold text-slate-500 dark:text-slate-400">Nama Asesi:</span>
                                <span class="text-slate-900 dark:text-white dark:font-medium text-right">{{ form.personal_data.full_name || '-' }} (NIK: {{ form.personal_data.nik }})</span>
                            </div>
                            <div class="flex flex-col sm:flex-row sm:justify-between border-b pb-4 dark:border-slate-700">
                                <span class="font-bold text-slate-500 dark:text-slate-400">Kontak:</span>
                                <span class="text-slate-900 dark:text-white dark:font-medium text-right">{{ form.personal_data.phone || '-' }}</span>
                            </div>
                            <div class="flex flex-col sm:flex-row sm:justify-between">
                                <span class="font-bold text-slate-500 dark:text-slate-400">Instansi:</span>
                                <span class="text-slate-900 dark:text-white dark:font-medium text-right">{{ form.work_data.company || '-' }} ({{ form.work_data.job_title }})</span>
                            </div>
                        </div>
                    </div>

                    <!-- Navigation Buttons -->
                    <div class="mt-10 flex items-center justify-between border-t border-slate-200 dark:border-slate-800 pt-6">
                        <button type="button" @click="prevStep" v-show="currentStep > 1"
                                class="inline-flex items-center px-5 py-2.5 border border-slate-300 dark:border-slate-700 rounded-xl shadow-sm text-sm font-bold text-slate-700 dark:text-slate-300 bg-white dark:bg-slate-800 hover:bg-slate-50 dark:hover:bg-slate-700 focus:outline-none transition-colors">
                            <ChevronLeft class="w-4 h-4 mr-2" /> Kembali
                        </button>
                        <div v-show="currentStep === 1"></div>

                        <button type="button" @click="nextStep" v-if="currentStep < totalSteps"
                                class="inline-flex items-center px-6 py-2.5 border border-transparent rounded-xl shadow-md text-sm font-bold text-white bg-cyan-600 hover:bg-cyan-700 focus:outline-none transition-colors"
                                :disabled="currentStep === 1 && !form.scheme_id">
                            Selanjutnya <ChevronRight class="w-4 h-4 ml-2" />
                        </button>

                        <button type="submit" v-if="currentStep === totalSteps" :disabled="form.processing"
                                class="inline-flex items-center px-6 py-2.5 border border-transparent rounded-xl shadow-md shadow-emerald-500/30 text-sm font-bold text-white bg-emerald-600 hover:bg-emerald-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500 dark:focus:ring-offset-slate-900 transition-colors disabled:opacity-50">
                            <Save class="w-4 h-4 mr-2" /> {{ form.processing ? 'Memproses...' : 'Kirim Pendaftaran' }}
                        </button>
                    </div>

                </form>
            </div>
            
        </div>
    </div>
</template>

<style scoped>
.animate-fade-in {
    animation: fadeIn 0.4s ease-out forwards;
}

@keyframes fadeIn {
    from { opacity: 0; transform: translateY(10px); }
    to { opacity: 1; transform: translateY(0); }
}
</style>
