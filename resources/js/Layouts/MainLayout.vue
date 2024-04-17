<template>
    <PrimaryMenu></PrimaryMenu>

    <div class="fixed bottom-0 right-0 w-full sm:w-auto px-3">
    <Toast
      v-if="$page.props.flash.message"
      :message="$page.props.flash.message.message"
      :type="$page.props.flash.message.type"
    />
  </div>
    <slot></slot>
</template>

<script setup>
import PrimaryMenu from "@/Components/PrimaryMenu.vue";
import Toast from "@/Components/Toast.vue";
</script>
