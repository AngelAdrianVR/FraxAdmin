<script setup>
defineProps({
    type: {
        type: String,
        default: 'button',
    },
});
</script>

<template>
    <button :type="type" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-full font-semibold text-xs text-gray-700 tracking-widest shadow-sm active:scale-95 disabled:active:scale-100 disabled:cursor-not-allowed disabled:opacity-50 disabled:bg-gray2 focus:outline-none focus:ring-0 transition ease-in-out duration-100">
        <slot />
    </button>
</template>
