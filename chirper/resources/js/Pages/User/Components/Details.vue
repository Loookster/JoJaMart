<script setup>
import { ref, reactive } from 'vue';
import { router, usePage } from '@inertiajs/vue3';
import UserLayout from '../Layout/UserLayout.vue'

const { products } = defineProps(['products']);

const inStock = ref('');
// Add currentIndex variable
const currentIndex = ref(0);

const updateCurrentIndex = (index) => {
    currentIndex.value = index;
};

// Next and Previous image handlers
const nextImage = () => {
    currentIndex.value = (currentIndex.value + 1) % products.product_images.length;
};

const prevImage = () => {
    currentIndex.value = (currentIndex.value - 1 + products.product_images.length) % products.product_images.length;
};

const state = reactive({
    quantity: 1, // Initial quantity
});


const addToCart = (product) => {
    console.log(product);
    router.post(route('product.add', { product, quantity: state.quantity }));
}


</script>

<template>
    <UserLayout>
        <section class="py-10 font-poppins dark:bg-gray-800">
            <div class="max-w-6xl px-4 mx-auto">
                <div class="flex flex-wrap mb-24 -mx-4">
                    <div class="w-full px-4 mb-8 md:w-1/2 md:mb-0">
                        <div class="sticky top-0 overflow-hidden ">
                            <!-- Div for Main Img -->
                            <div class="relative mb-6 lg:mb-10 lg:h-96">
                                <!-- Left Next img Button -->
                                <a @click.prevent="prevImage"
                                    class="absolute left-0 transform lg:ml-2 top-1/2 translate-1/2" href="#">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                        class="w-5 h-5 text-blue-500 bi bi-chevron-left dark:text-blue-200"
                                        viewBox="0 0 16 16">
                                        <path fill-rule="evenodd"
                                            d="M11.354 1.646a.5.5 0 0 1 0 .708L5.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0z">
                                        </path>
                                    </svg>
                                </a>
                                <!-- End -->
                                <!-- Current Image -->
                                <img v-if="products.product_images.length > 0"
                                    :src="`/${products.product_images[currentIndex].image}`"
                                    class="object-contain w-full lg:h-full"
                                    src="https://i.postimg.cc/0jwyVgqz/Microprocessor1-removebg-preview.png" alt="">
                                <img v-else
                                    src="https://upload.wikimedia.org/wikipedia/commons/thumb/6/65/No-Image-Placeholder.svg/330px-No-Image-Placeholder.svg.png"
                                    class="object-contain w-full lg:h-full" alt="">
                                <!-- End -->
                                <!-- Right next img Button -->
                                <a @click.prevent="nextImage"
                                    class="absolute right-0 transform lg:mr-2 top-1/2 translate-1/2" href="#">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                        class="w-5 h-5 text-blue-500 bi bi-chevron-right dark:text-blue-200"
                                        viewBox="0 0 16 16">
                                        <path fill-rule="evenodd"
                                            d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z">
                                        </path>
                                    </svg>
                                </a>
                                <!-- End -->
                            </div>
                            <!-- Images List  -->
                            <div class="flex-wrap hidden -mx-2 md:flex">
                                <div v-for="(image, index) in products.product_images" :key="index"
                                    class="w-1/2 p-2 sm:w-1/4">
                                    <a @click.prevent="updateCurrentIndex(index)"
                                        class="block border border-gray-200 hover:border-blue-400 dark:border-gray-700 dark:hover:border-blue-300"
                                        href="#">
                                        <img v-if="products.product_images.length > 0" :src="`/${image.image}`"
                                            class="object-contain w-full lg:h-28" :alt="`Image ${index}`">
                                    </a>
                                </div>
                            </div>
                            <!-- End of Image List -->
                        </div>
                    </div>
                    <div class="w-full px-4 md:w-1/2">
                        <div class="lg:pl-20">
                            <div class="mb-6 ">

                                <h2
                                    class="max-w-xl mt-6 mb-6 text-xl font-semibold leading-loose tracking-wide text-gray-700 md:text-2xl dark:text-gray-300">
                                    {{ products.title }}
                                </h2>
                                <p class="inline-block text-2xl font-semibold text-gray-700 dark:text-gray-400 ">
                                    <span>${{ products.price }}</span>
                                </p>
                            </div>
                            <div class="mb-6">
                                <h2 class="mb-2 text-lg font-bold text-gray-700 dark:text-gray-400">Description:</h2>
                                <div class="bg-gray-100 dark:bg-gray-700 rounded-xl">
                                    <div class="p-3 lg:p-5">
                                        <div class="p-2 rounded-xl lg:p-6 dark:bg-gray-800 bg-gray-50">
                                            <p class="mb-2 text-sm font-medium text-black-500 dark:text-gray-400">
                                                {{ products.description }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="py-6 mb-6 border-t border-b border-gray-200 dark:border-gray-700">
                                <!-- check Instock -->
                                <span v-if="products.inStock == 1"
                                    class="text-base text-gray-600 dark:text-gray-400">In
                                    stock</span>
                                <span v-else class="text-base text-gray-600 dark:text-gray-400">Out of stock</span>

                            </div>
                            <div class="mb-6 "></div>
                            <div class="flex flex-wrap items-center mb-6">
                                <div class="mb-4 mr-4 lg:mb-0">
                                    <div class="w-28">
                                        <div class="relative flex flex-row w-full h-10 bg-transparent rounded-lg">
                                            <!-- Quantity buttons for updating carts -->

                                            <button @click="state.quantity > 1 && (state.quantity -= 1)"
                                                :disabled="products.inStock == 0"
                                                class="w-20 h-full text-gray-600 bg-gray-100 border-r rounded-l outline-none cursor-pointer dark:border-gray-700 dark:hover:bg-gray-700 dark:text-gray-400 hover:text-gray-700 dark:bg-gray-900 hover:bg-gray-300">
                                                <span class="m-auto text-2xl font-thin">-</span>
                                            </button>
                                            <!-- input quantity for updating carts -->
                                            <input type="number" v-model="state.quantity"
                                                :disabled="products.inStock == 0"
                                                class="flex items-center w-full font-semibold text-center text-gray-700 placeholder-gray-700 bg-gray-100 outline-none dark:text-gray-400 dark:placeholder-gray-400 dark:bg-gray-900 focus:outline-none text-md hover:text-black"
                                                placeholder="1">
                                            <button @click="state.quantity += 1" :disabled="products.inStock == 0"
                                                class="w-20 h-full text-gray-600 bg-gray-100 border-l rounded-r outline-none cursor-pointer dark:border-gray-700 dark:hover:bg-gray-700 dark:text-gray-400 dark:bg-gray-900 hover:text-gray-700 hover:bg-gray-300">
                                                <span class="m-auto text-2xl font-thin">+</span>
                                            </button>
                                            <!-- end of quantity buttons -->
                                        </div>
                                    </div>
                                </div>
                                <!-- Call Add to cart  -->
                                <button @click.prevent="addToCart(products)" :disabled="products.inStock === 1"
                                    class="'w-full px-4 py-3 text-center text-blue-600 bg-blue-100 border border-blue-600 dark:hover:bg-gray-900 dark:text-gray-400 dark:border-gray-700 dark:bg-gray-700 hover:bg-blue-600 hover:text-gray-100 lg:w-1/2 rounded-xl']">
                                    Add to cart
                                </button>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </section>
    </UserLayout>
</template>
