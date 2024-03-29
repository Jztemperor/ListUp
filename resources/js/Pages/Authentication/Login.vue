<template>
    <div class="min-[1010px]:grid grid-cols-2 gap-4 h-full">
        <h1
            class="sm:fixed sm:block sm:text-brand-color sm:font-bold sm:text-3xl sm:tracking-widest sm:p-5 hidden"
        >
            <Link :href="route('index.index')">ListUp</Link>
        </h1>
        <div class="h-full flex flex-col items-center justify-center">
            <h1 class="text-brand-color text-3xl mb-8">Sign in!</h1>

            <form @submit.prevent="login" class="min-[639px]:w-auto w-11/12">
                <div class="grid gird-cols-2 gap-4 pl-2 pr-2">
                    <div class="col-span-2">
                        <InputGroup class="col-span-1">
                            <InputGroupAddon>
                                <i class="pi pi-envelope"></i>
                            </InputGroupAddon>
                            <FloatLabel>
                                <InputText
                                    type="email"
                                    id="email"
                                    v-model="form.email"
                                />
                                <label for="email">E-mail</label>
                            </FloatLabel>
                        </InputGroup>
                        <small class="text-red-500" v-if="form.errors.email">{{
                            form.errors.email
                        }}</small>
                    </div>

                    <div class="col-span-2">
                        <InputGroup class="col-span-1">
                            <InputGroupAddon>
                                <i class="pi pi-lock"></i>
                            </InputGroupAddon>
                            <FloatLabel>
                                <Password
                                    id="password"
                                    :feedback="false"
                                    toggleMask
                                    v-model="form.password"
                                />
                                <label for="password">Password</label>
                            </FloatLabel>
                        </InputGroup>
                        <small
                            class="text-red-500"
                            v-if="form.errors.password"
                            >{{ form.errors.password }}</small
                        >
                    </div>

                    <div class="col-span-2">
                        <Button
                            type="submit"
                            class="w-full mb-2"
                            label="Login"
                        />
                        <div class="flex justify-between text-sm sm:text-md">
                            <p>
                                Not a member?
                                <Link
                                    :href="route('account.create')"
                                    class="text-brand-color"
                                    >Sign up!</Link
                                >
                            </p>

                            <p>
                                Back to
                                <Link
                                    :href="route('index.index')"
                                    class="text-brand-color"
                                    >Home</Link
                                >
                            </p>
                        </div>
                    </div>
                </div>
            </form>
        </div>

        <div
            class="hidden min-[1010px]:block bg-auth-background bg-bottom bg-cover bg-no-repeat"
        ></div>
    </div>
</template>

<script setup>
import FloatLabel from "primevue/floatlabel";
import InputText from "primevue/inputtext";
import InputGroupAddon from "primevue/inputgroupaddon";
import InputGroup from "primevue/inputgroup";
import InputMask from "primevue/inputmask";
import Password from "primevue/password";
import Button from "primevue/button";
import { Link } from "@inertiajs/vue3";
import { useForm } from "@inertiajs/vue3";
import Dropdown from "primevue/dropdown";

// Init form
const form = useForm({
    email: null,
    password: null,
});

// Submit event
const login = () => form.post(route("login"));
</script>
