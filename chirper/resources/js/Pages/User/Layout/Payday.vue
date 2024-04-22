<script setup>
import { ref, computed, onMounted, onUnmounted } from 'vue';

const saleEndDate = new Date('2024-03-25T23:59:59'); // Set your sale end date here
const currentTime = ref(new Date());

const timeLeft = computed(() => {
  const timeDiff = saleEndDate - currentTime.value;
  const days = Math.floor(timeDiff / (1000 * 60 * 60 * 24));
  const hours = Math.floor((timeDiff % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
  const minutes = Math.floor((timeDiff % (1000 * 60 * 60)) / (1000 * 60));
  const seconds = Math.floor((timeDiff % (1000 * 60)) / 1000);
  return `${days}d ${hours}h ${minutes}m ${seconds}s`;
});

const saleActive = computed(() => currentTime.value < saleEndDate);

const timerInterval = setInterval(() => {
  currentTime.value = new Date();
}, 1000);

onUnmounted(() => {
  clearInterval(timerInterval);
});
</script>

<template>
<div class="relative bg-slate-800 py-10 px-12 flex justify-between items-center  shadow-md">
  <div class="ml-24">
    <p class=" text-5xl font-semibold text-white">Limited Time Sale!</p>
    <div class="flex justify-left mt-3">
      <p class="text-3xl text-white font-bold" v-if="saleActive">Ending in: {{ timeLeft }}</p>
      <p class="text-3xl text-white font-bold" v-else>Sale Ended!</p>
    </div>
  </div>
  <div class="bg-slate-800 p-2 rounded-lg flex justify-end mr-32">
    <img src="/product_images/Macpng.png" alt="Sale Image" class="w-3/5 h-2/4  rounded-lg shadow-md" />
  </div>
</div>
  </template>

