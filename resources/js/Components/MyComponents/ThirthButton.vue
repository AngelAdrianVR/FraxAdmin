<script setup>
defineProps({
    type: {
        type: String,
        default: 'submit',
    },
});
</script>

<template>
    <button :type="type" class="text-center px-4 py-2 border border-primary rounded-full font-semibold text-xs text-primary tracking-widest hover:border-[#4dd292] active:border-[#3ca572] active:scale-95 disabled:active:scale-100 disabled:cursor-not-allowed disabled:opacity-50 disabled:border-gray2 disabled:text-gray2 focus:outline-none focus:ring-0 transition ease-in-out duration-100">
        <slot />
    </button>
</template>
