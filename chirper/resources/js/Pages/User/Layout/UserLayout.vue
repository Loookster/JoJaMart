<script setup>

import Header from "./Header.vue";
import Footer from "./Footer.vue";

import { onMounted } from "vue";
import { initFlowbite } from "flowbite";

onMounted(() => {
    initFlowbite();
});
</script>

<template>
<!-- Header -->
<Header></Header>
<!-- End of Header -->
<slot/>
<!-- End of Main Content -->

<!-- Footer -->
<Footer></Footer>
<!-- End of footer-->


</template>
