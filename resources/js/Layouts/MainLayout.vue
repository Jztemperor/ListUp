<template>
    <PrimaryMenu></PrimaryMenu>

    <div class="fixed bottom-0 right-0 w-full sm:w-auto px-3">
    <Toast
      v-if="messages.length > 0"
      v-for="(message, index) in messages"
        :key="index"
        :message="message.message"
        :type="message.type"
    />
  </div>
    <slot></slot>
</template>

<script setup>
import PrimaryMenu from "@/Components/PrimaryMenu.vue";
import Toast from "@/Components/Toast.vue";
import { ref, watch, onMounted } from "vue";
import { usePage } from "@inertiajs/vue3";

// TODO: Refactor toast logic into a BaseComponent

// Get global props
const page = usePage();

// State
const messages = ref([]);


// Check for message onMounted
onMounted(() => {
  if(page.props.flash.message) {
    messages.value.push(page.props.flash.message);
  }
})

// Check for messages so we can stack them
watch(() => page.props.flash.message, (newValue) => {
  if(newValue) {
    messages.value.push(newValue);
  }
})

</script>
