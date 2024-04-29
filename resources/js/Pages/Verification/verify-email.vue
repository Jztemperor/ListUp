<template>
    <h1 class="gap-4 my-10 text-3xl text-center lg:text-4xl xl:text-5xl text-brand-color">Verify your account!</h1>
    <p class="p-2 my-5 text-center xl:p-0">Thank you for creating an account with us! <span class="font-bold text-brand-color">Verification steps:</span></p>
    
    <ol class="flex flex-col items-center justify-center w-full p-5 xl:p-0">
        <div>
            <li class="mb-3">
            <span class="font-bold text-brand-color">1. Check Your Email:</span> 
            A verification link has been sent to the email address you provided during registration.</li>

        <li class="mb-3">
            <span class="font-bold text-brand-color">2. Open Your Inbox:</span> 
            Go to your email inbox and look for an email from us. If you don’t see it in your inbox, please check your spam or junk folder.
        </li>

        <li class="mb-3">
            <span class="font-bold text-brand-color">
                3. Click the Verification Link:
            </span>
            In the email, you will find a link to verify your account. Click on the provided link to complete the verification process.
        </li class="mb-3">

        <li class="mb-3">
            <span class="font-bold text-brand-color">
               4. Confirmation:
            </span>
            Once you click the link, you will be redirected to our website, and your account will be successfully verified.
        </li>

        <li class="mb-3">
            <span class="font-bold text-brand-color">
               Did not receive our mail?
            </span>
           <form @submit.prevent="form.post(route('verification.send'))" class="inline">
                <button type="submit" class="ml-2 underline">Resend Email Verification</button>
            </form>
        </li>

        </div>
    </ol>


    <div class="mt-3 text-center ">
        <p class="mb-5">
            <span class="font-bold text-brand-color">Note:</span> 
            If you encounter any issues or did not receive the verification email, please contact our support team at <span class="font-bold text-brand-color">support@listup.com</span> for assistance.
        </p>

        <p>Thank you for choosing our platform. We look forward to providing you with a great experience!</p>
    </div>

</template>

<script setup>
import { useForm } from "@inertiajs/vue3";

const form = useForm({});


</script>