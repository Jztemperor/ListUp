<template>
    <div class="grid grid-cols-2 gap-4 h-full">
        <h1
            class="absolute text-brand-color font-bold text-3xl tracking-widest p-5"
        >
            <Link :href="route('index.index')">ListUp</Link>
        </h1>
        <div class="h-full flex flex-col items-center justify-center">
            <h1 class="text-brand-color text-3xl mb-8">Create an account!</h1>

            <form @submit.prevent="createAccount">
                <div class="grid gird-cols-2 gap-4">
                    <div class="col-span-1">
                        <InputGroup>
                            <InputGroupAddon>
                                <i class="pi pi-user"></i>
                            </InputGroupAddon>
                            <FloatLabel>
                                <InputText
                                    id="firstname"
                                    v-model="formData.firstName"
                                />
                                <label for="firstname">First Name</label>
                            </FloatLabel>
                        </InputGroup>
                    </div>

                    <div class="col-span-1">
                        <InputGroup class="col-span-1">
                            <InputGroupAddon>
                                <i class="pi pi-user"></i>
                            </InputGroupAddon>
                            <FloatLabel>
                                <InputText
                                    id="lastname"
                                    v-model="formData.lastName"
                                />
                                <label for="lastname">Last Name</label>
                            </FloatLabel>
                        </InputGroup>
                    </div>

                    <div class="col-span-2">
                        <InputGroup class="col-span-1">
                            <InputGroupAddon>
                                <i class="pi pi-envelope"></i>
                            </InputGroupAddon>
                            <FloatLabel>
                                <InputText
                                    type="email"
                                    id="email"
                                    v-model="formData.email"
                                />
                                <label for="email">E-mail</label>
                            </FloatLabel>
                        </InputGroup>
                    </div>

                    <div class="col-span-2">
                        <InputGroup class="col-span-1">
                            <InputGroupAddon>
                                <i class="pi pi-phone"></i>
                            </InputGroupAddon>
                            <FloatLabel>
                                <InputMask
                                    mask="(999)-999-9999"
                                    id="phone"
                                    v-model="formData.phone"
                                />
                                <label for="phone">Phone</label>
                            </FloatLabel>
                        </InputGroup>
                    </div>

                    <div class="col-span-1">
                        <InputGroup class="col-span-1">
                            <InputGroupAddon>
                                <i class="pi pi-lock"></i>
                            </InputGroupAddon>
                            <FloatLabel>
                                <Password
                                    id="password"
                                    :feedback="false"
                                    toggleMask
                                    v-model="formData.password"
                                />
                                <label for="password">Password</label>
                            </FloatLabel>
                        </InputGroup>
                    </div>

                    <div class="col-span-1">
                        <InputGroup class="col-span-1">
                            <InputGroupAddon>
                                <i class="pi pi-lock"></i>
                            </InputGroupAddon>
                            <FloatLabel>
                                <Password
                                    id="password_confirmation"
                                    :feedback="false"
                                    toggleMask
                                    v-model="formData.password_confirmation"
                                />
                                <label for="password_confirmation"
                                    >Confirm Password</label
                                >
                            </FloatLabel>
                        </InputGroup>
                    </div>

                    <div class="col-span-2">
                        <Button
                            type="submit"
                            class="w-full mb-2"
                            label="Submit"
                        />
                        <p>
                            Already have an account?
                            <Link class="text-brand-color">Sign in!</Link>
                        </p>
                    </div>
                </div>
            </form>
        </div>

        <div class="bg-auth-background bg-bottom bg-cover bg-no-repeat"></div>
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

// Init formData
const formData = useForm({
    firstName: null,
    lastName: null,
    email: null,
    phone: null,
    password: null,
    password_confirmation: null,
});

// Submit event
const createAccount = () => {
    formData.post(route("account.store"));
};
</script>
