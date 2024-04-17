<template>
    <Transition name="fade">
      <div v-if="isVisible" :class="['min-w-full sm:w-80 text-sm text-white p-4 rounded flex flex-row justify-between align-center mb-3',  `flash-${type}`]">
        <div> {{ message }} </div>
        <button @click="hideToast">&times;</button>
      </div>
    </Transition>
</template>

<script setup>
import {ref, onMounted} from "vue";
import { usePage } from "@inertiajs/vue3";

    // UsePage to access global props
    const page = usePage();

    // Props
    defineProps({
        message: String,
        type: String
    })

    // State
    const isVisible = ref(false);

    onMounted(() => {
        isVisible.value = true;

        // Remove the toast after 3 seconds (or on click)
        setTimeout(() => {
            hideToast();
        }, 3000)
    });

    const hideToast = () => {
        isVisible.value = false;
        
        // Need to remove the props so it triggers a re-render
        // Re-render needs to happen after leave animation (0.5s)
        setTimeout(() => {
            page.props.flash.message = null;
        }, 500)
    };


</script>

<!-- Scoped Styles for different toast types, and Transitions -->
<style scoped>
.flash-success {
  background-color: #4caf50; 
}

.flash-error,
.flash-danger {
  background-color: #ff5252; 
}

.fade-enter-active,
.fade-leave-active {
  transition: opacity 0.5s ease;
}

.fade-enter-from,
.fade-leave-to {
    opacity: 0;
}
</style>