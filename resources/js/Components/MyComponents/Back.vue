<template>
  <button @click="goBack" class="flex justify-center items-center rounded-full py-[9px] px-3 focus:outline-none hover-3dbuttom">
        <i class="fa-solid fa-angle-left"></i>
  </button>
</template>

<script>
export default {
  methods: {
    goBack() {
      // Puedes personalizar esta lógica según tus necesidades
      // En este ejemplo, se utiliza la función history.back() para retroceder una página
      window.history.back();
    },
  },
};
</script>
