<script setup>
import { ref, computed } from 'vue';
import UserLayout from './Layout/UserLayout.vue';
import Hero from "./Layout/Hero.vue";
import Products from '../User/Components/Products.vue';
import Abubots from './Layout/Abubots.vue';
import Payday from './Layout/Payday.vue';

const { products, productsByCategory, productsByBrand } = defineProps(['products', 'productsByCategory', 'productsByBrand']);

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

        <!-- ABUBOTS -->
        <Abubots></Abubots>
        <!-- End of ABUBOTS -->

        <!-- Latest Products -->
        <div class="mx-auto max-w-2xl px-4 py-16 sm:px-6 sm:py-24 lg:max-w-7xl lg:px-8">
            <h2 class="text-3xl font-bold tracking-tight text-gray-900">Latest Products</h2>
            <div class="flex justify-between items-center mt-4">
                <button @click="prevItem" class="px-4 py-2 text-white bg-gray-800 rounded-md">&lt;</button>
                <Products :products="visibleProducts"></Products>
                <button @click="nextItem" class="px-4 py-2 text-white bg-gray-800 rounded-md">&gt;</button>
            </div>
        </div>
        <!-- End of Latest Products -->

        <!-- Limited Sale  -->
        <Payday></Payday>
        <!-- End of Limited Sale -->

        <!-- Product By Category -->
        <div class="mx-auto max-w-2xl px-4 py-10 sm:px-6 sm:py-10 lg:max-w-7xl lg:px-8 flex flex-col items-center">
            <h2 class="text-3xl font-bold tracking-tight text-gray-900">Products By Category</h2>
            <div class="flex justify-between items-center mt-4">
                <!-- Iterate through products by category here -->
                <Products :products="productsByCategory" ></Products>
            </div>
        </div>
        <!-- End of Product By Category -->

        <!-- Product By Brand -->
        <div class="mx-auto max-w-2xl px-4 py-10 sm:px-6 sm:py-10 lg:max-w-7xl lg:px-8 flex flex-col items-center">
            <h2 class="text-3xl font-bold tracking-tight text-gray-900 mb-2">Products By Brand</h2>
            <div class="flex justify-between items-center">
                <!-- Iterate through products by category here -->
                <Products :products="productsByBrand" ></Products>
            </div>
        </div>
        <!-- End of Product By Brand -->

        <!-- End of Main Content -->
    </UserLayout>
</template>
