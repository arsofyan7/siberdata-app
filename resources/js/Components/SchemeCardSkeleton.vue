<script setup>
import { ServerCog, LockKeyhole, ArrowRight } from 'lucide-vue-next';
</script>

<template>
    <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden relative flex flex-col h-full animate-pulse">
        
        <!-- Decoration element skeleton -->
        <div class="absolute top-0 right-0 w-24 h-24 rounded-bl-3xl bg-slate-100 opacity-50 pointer-events-none"></div>

        <div class="p-6 flex-grow relative z-10 flex flex-col">
            <div class="flex justify-between items-start mb-5">
                <!-- Code Badge Skeleton -->
                <div class="h-6 w-20 bg-slate-200 rounded-full"></div>
                <!-- Level Badge Skeleton -->
                <div class="h-6 w-16 bg-slate-200 rounded-full border border-slate-100"></div>
            </div>
            
            <!-- Category Icon & Name Skeleton -->
            <div class="flex items-center mb-4">
                <div class="w-4 h-4 bg-slate-200 rounded-full mr-2"></div>
                <div class="h-4 w-28 bg-slate-200 rounded"></div>
            </div>

            <!-- Title Skeleton (2 lines) -->
            <div class="space-y-3 mt-1">
                <div class="h-6 bg-slate-200 rounded-md w-full"></div>
                <div class="h-6 bg-slate-200 rounded-md w-3/4"></div>
            </div>
        </div>

        <!-- Button Section Skeleton -->
        <div class="px-6 py-4 border-t border-slate-100 mt-auto relative z-10 bg-slate-50/50">
            <div class="w-full h-10 bg-slate-200 rounded-xl"></div>
        </div>
    </div>
</template>
