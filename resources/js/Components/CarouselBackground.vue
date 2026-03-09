<script setup>
import { ref, onMounted, onUnmounted } from 'vue';

const bgImages = [
    '/images/hero1.png',
    '/images/hero2.png',
    '/images/hero3.png'
];

const currentBgIndex = ref(0);
let bgInterval;

onMounted(() => {
    bgInterval = setInterval(() => {
        currentBgIndex.value = (currentBgIndex.value + 1) % bgImages.length;
    }, 5000); // Change image every 5 seconds
});

onUnmounted(() => {
    if (bgInterval) clearInterval(bgInterval);
});
</script>

<template>
    <!-- Interactive Background Carousel -->
    <div class="absolute inset-0 z-0 overflow-hidden bg-slate-100">
        <template v-for="(img, index) in bgImages" :key="index">
            <div 
                class="absolute inset-0 bg-cover bg-center transition-opacity duration-1000 ease-in-out"
                :class="index === currentBgIndex ? 'opacity-20 scale-105' : 'opacity-0 scale-100'"
                :style="`background-image: url('${img}');`"
            ></div>
        </template>
        <!-- Overlay Gradient for Readability -->
        <div class="absolute inset-x-0 bottom-0 h-[60%] bg-gradient-to-t from-slate-50 to-transparent"></div>
    </div>

    <!-- Dynamic Motif Subtitle Pattern overlay -->
    <div class="absolute inset-0 z-0 pointer-events-none opacity-[0.03]" style="background-image: url('data:image/svg+xml,%3Csvg width=\'60\' height=\'60\' viewBox=\'0 0 60 60\' xmlns=\'http://www.w3.org/2000/svg\'%3E%3Cg fill=\'none\' fill-rule=\'evenodd\'%3E%3Cg fill=\'%23000000\' fill-opacity=\'1\'%3E%3Cpath d=\'M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z\'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E');"></div>

    <!-- Abstract Background Glow Shapes -->
    <div class="absolute inset-0 z-0 pointer-events-none overflow-hidden mix-blend-multiply">
        <div class="absolute -top-[10%] -right-[5%] w-[40%] h-[40%] rounded-full bg-blue-100 opacity-60 blur-[100px]"></div>
        <div class="absolute top-[20%] -left-[10%] w-[30%] h-[50%] rounded-full bg-indigo-50 opacity-50 blur-[80px]"></div>
        <div class="absolute bottom-[10%] right-[10%] w-[25%] h-[40%] rounded-full bg-emerald-50 opacity-50 blur-[90px]"></div>
    </div>
</template>
