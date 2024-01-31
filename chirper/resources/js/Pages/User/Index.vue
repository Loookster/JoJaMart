<script setup>
import { ref, computed } from 'vue';
import UserLayout from './Layout/UserLayout.vue';
import Hero from "./Layout/Hero.vue";
// Import Products component if it's needed
import Products from '../User/Components/Products.vue';

const { products } = defineProps(['products']);

const itemsPerPage = 4;

const currentIndex = ref(0);

const visibleProducts = computed(() => {
  return products.data.slice(currentIndex.value, currentIndex.value + itemsPerPage);
});

const nextItem = () => {
  currentIndex.value = (currentIndex.value + itemsPerPage) % products.data.length;
};

const prevItem = () => {
  currentIndex.value = (currentIndex.value - itemsPerPage + products.data.length) % products.data.length;
};
</script>

<template>
    <!-- Header -->
    <UserLayout>
        <!-- End of Header -->

        <!-- Main Content -->

        <!-- Hero Section -->

        <Hero></Hero>

        <!-- End of Hero Section -->

        <div class="bg-white">
            <div class="mx-auto max-w-2xl px-4 py-16 sm:px-6 sm:py-24 lg:max-w-7xl lg:px-8">
                <h2 class="text-2xl font-bold tracking-tight text-gray-900">Latest Products</h2>

            <Products :products="visibleProducts"></Products>
            <div class="flex justify-between mt-4">
                    <button @click="prevItem"  class="px-4 py-2 text-white bg-gray-800 rounded-md" >Previous</button>
                    <button @click="nextItem"  class="px-4 py-2 text-white bg-gray-800 rounded-md">Next</button>
                </div>

                </div>
        </div>



        <!-- End of Main Content -->

        <!-- Footer -->

    </UserLayout>
    <!-- End of footer-->
</template>
