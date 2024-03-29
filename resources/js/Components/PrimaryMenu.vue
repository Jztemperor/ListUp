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
            <div v-if="user">
                <Link
                    :href="route('account.create')"
                    class="p-[1rem] hover:bg-hover-light rounded text-light-gray"
                    >My Account</Link
                >

                <Link
                    :href="route('logout')"
                    method="delete"
                    class="p-[1rem] hover:bg-hover-light rounded"
                    as="button"
                    >Logout</Link
                >
            </div>

            <div v-else>
                <Link
                    :href="route('account.create')"
                    class="p-[1rem] hover:bg-hover-light rounded"
                    >Sign Up</Link
                >
                <Link
                    :href="route('login')"
                    class="p-[1rem] hover:bg-hover-light rounded"
                    >Sign in</Link
                >
            </div>
        </template>
    </Menubar>
</template>

<script setup>
import { ref } from "vue";
import { Link } from "@inertiajs/vue3";
import { usePage } from "@inertiajs/vue3";
import { computed } from "vue";
import Menubar from "primevue/menubar";

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

// Acces shared props (HandleInertiaRequest.php)
const page = usePage();
const user = computed(() => page.props.user);
</script>
