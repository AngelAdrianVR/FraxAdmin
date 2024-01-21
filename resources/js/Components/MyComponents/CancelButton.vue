<script setup>
defineProps({
    type: {
        type: String,
        default: 'submit',
    },
});
</script>

<template>
    <button :type="type" class="text-center px-4 py-2 bg-gray4 border border-transparent rounded-full font-semibold text-xs text-secondary tracking-widest hover:bg-[#cecece] active:bg-[#acacac] active:scale-95 disabled:active:scale-100 disabled:cursor-not-allowed disabled:opacity-50 disabled:bg-gray2 focus:outline-none focus:ring-0 transition ease-in-out duration-100">
        <slot />
    </button>
</template>
