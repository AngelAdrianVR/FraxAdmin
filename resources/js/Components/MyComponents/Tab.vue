<template>
    <div>
        <p :class="active ? 'text-primary' : ''"
            class="px-2 py-1 cursor-pointer ml-5 transition duration-300 ease-in-out text-sm md:text-base">
           {{ label }}
        </p>
    </div>
</template>
<script>
export default {
    props: {
        label: String,
        active: Boolean,
    }
}
</script>