<template>
    <!-- Render menuber -->
    <Menubar :model="items">
        <!-- LOGO (Before menu items) -->
        <template #start>
            <h1
                class="text-brand-color font-bold text-2xl tracking-widest hidden min-[961px]:inline"
            >
                <Link :href="route('index.index')">ListUp</Link>
            </h1>
        </template>

        <!-- Custom rendering for menu items -->
        <template #item="{ item }">
            <div class="p-[1rem]">
                <Link :href="route(item.route)" class="cursor-pointer">
                    {{ item.label }}
                </Link>
            </div>
        </template>

        <!-- Render elements after menubar -->
        <template #end>
            <div>
                <a href="" class="p-[1rem] hover:bg-hover-light rounded"
                    >Sign Up</a
                >
                <a href="" class="p-[1rem] hover:bg-hover-light rounded"
                    >Sign in</a
                >
            </div>
        </template>
    </Menubar>
</template>

<script setup>
import { ref, onMounted, onBeforeUnmount } from "vue";
import { Link } from "@inertiajs/vue3";
import Menubar from "primevue/menubar";

const hidden = ref(true);

// Menu items
const items = ref([
    {
        label: "Home",
        route: "index.index",
    },
    { label: "Buy", route: "index.index" },
    { label: "Rent", route: "index.index" },
    { label: "Sell", route: "index.index" },
    { label: "Calculate Payments", route: "index.index" },
    { label: "Discover", route: "index.index" },
]);
</script>
