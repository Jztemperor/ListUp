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
                                    v-model="form.firstName"
                                />
                                <label for="firstname">First Name</label>
                            </FloatLabel>
                        </InputGroup>
                        <small
                            class="text-red-500"
                            v-if="form.errors.firstName"
                        >
                            {{ form.errors.firstName }}
                        </small>
                    </div>

                    <div class="col-span-1">
                        <InputGroup class="col-span-1">
                            <InputGroupAddon>
                                <i class="pi pi-user"></i>
                            </InputGroupAddon>
                            <FloatLabel>
                                <InputText
                                    id="lastname"
                                    v-model="form.lastName"
                                />
                                <label for="lastname">Last Name</label>
                            </FloatLabel>
                        </InputGroup>
                        <small
                            class="text-red-500"
                            v-if="form.errors.lastName"
                            >{{ form.errors.lastName }}</small
                        >
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
                                <i class="pi pi-phone"></i>
                            </InputGroupAddon>
                            <FloatLabel>
                                <InputMask
                                    mask="(999)-999-9999"
                                    id="phone"
                                    v-model="form.phone"
                                />
                                <label for="phone">Phone</label>
                            </FloatLabel>
                        </InputGroup>
                        <small class="text-red-500" v-if="form.errors.phone">{{
                            form.errors.phone
                        }}</small>
                    </div>

                    <div class="col-span-2">
                        <InputGroup class="col-span-1">
                            <InputGroupAddon>
                                <i class="pi pi-briefcase"></i>
                            </InputGroupAddon>
                            <FloatLabel>
                                <Dropdown
                                    v-model="form.role"
                                    :options="roles"
                                    optionLabel="name"
                                    placeholder="Select a Role"
                                    checkmark
                                    :highlightOnSelect="false"
                                    class="w-full md:w-14rem"
                                />
                                <label for="phone"
                                    >Are you a Realtor or a Customer?</label
                                >
                            </FloatLabel>
                        </InputGroup>
                        <small class="text-red-500" v-if="form.errors.role">{{
                            form.errors.role
                        }}</small>
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
                                    v-model="form.password_confirmation"
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
                            <Link href="" class="text-brand-color"
                                >Sign in!</Link
                            >
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
import Dropdown from "primevue/dropdown";

// Init form
const form = useForm({
    firstName: null,
    lastName: null,
    email: null,
    phone: null,
    role: null,
    password: null,
    password_confirmation: null,
});

const roles = [{ name: "Customer" }, { name: "Realtor" }];

// Submit event
const createAccount = () => form.post(route("account.store"));
</script>
