<template>
  <div class="lg:w-full">
    <div class="input-container">
      <label
        class="input-placeholder text-gray2 bg-white px-2 rounded-sm text-sm"
        :class="{ 'active': isFocused || modelValue }"
      >
        <slot />
      </label>
      <input
        :value="modelValue"
        :step="inputStep"
        :type="inputType"
        @focus="isFocused = true"
        @blur="isFocused = false"
        @input="updateModelValue"
        class="input"
      />
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      modelValue: '',
      isFocused: false,
    };
  },
  props: {
    inputType: {
      type: String,
      default: 'text',
    },
    inputStep: {
      type: Number,
      default: '1',
    },
    modelValue: {
      type: String,
      required: true,
    },
  },
  watch: {
    value(newVal) {
      this.modelValue = newVal; // Actualizar modelValue cuando cambia value
    },
  },
  emits: ['update:modelValue'],
  setup(props, { emit }) {

    const updateModelValue = (event) => {
      emit('update:modelValue', event.target.value);
    };
    

    return {
      updateModelValue,
    };
  
  },
};
</script>

<style scoped>
.input-container {
  position: relative;
}
.input-placeholder {
  position: absolute;
  top: 50%;
  left: 8px;
  transform: translateY(-50%);
  transition: transform 0.2s ease-in-out, color 0.1s ease-in-out;
  pointer-events: none;
}
.input-placeholder.active {
  transform: translateY(-150%) scale(0.80);
  color: #35F69A;
}
</style>
