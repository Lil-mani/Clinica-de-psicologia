<script setup>
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import { Link } from '@inertiajs/vue3';
</script>

<template>
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-900">
        <div>
            <!-- Estilo inline para aumentar o tamanho da fonte -->
            <Link href="/" class="text-white" style="font-size: 60px;">
                Instituto <span style="color: #89ffdb;">Psi</span>
            </Link>
        </div>

        <div
            class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg"
        >
            <slot />
        </div>
    </div>
</template>

<style>
.bg-gray-900 {
    background-color: #474a59; /* Cor de fundo alterada */
}
</style>
