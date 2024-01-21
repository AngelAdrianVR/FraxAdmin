<!-- LoadingSpinner.vue -->

<template>
  <div v-if="loading" class="fixed top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 z-50">
    <div class="animate-spin rounded-full h-16 w-16 border-t-4 border-blue-500"></div>
    <!-- Puedes ajustar la clase 'border-blue-500' para cambiar el color del spinner -->
  </div>
</template>

<script>
export default {
  props: {
    loading: {
      type: Boolean,
      required: true,
    },
  },
};
</script>

