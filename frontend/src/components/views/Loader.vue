<template>
  <div v-if="isLoading" class="fixed inset-0 bg-black/30 flex items-center justify-center z-50">
    <div class="animate-spin rounded-full h-12 w-12 border-4 border-white border-t-transparent"></div>
  </div>
</template>

<script setup>
import { useLoaderStore } from '../../stores/loader.js'
import {computed} from 'vue'
const loader = useLoaderStore()  // Access Pinia store
const isLoading = computed(() => loader.isLoading)  // Use computed to make it reactive
</script>
