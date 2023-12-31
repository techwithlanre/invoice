<script setup>
import { onMounted, ref } from 'vue';

defineProps({
  modelValue: {
    type: String,
    required: true,
  },

  options: {
    type: Array
  }
});

defineEmits(['update:modelValue']);

const input = ref(null);

onMounted(() => {
  if (input.value.hasAttribute('autofocus')) {
    input.value.focus();
  }
});

defineExpose({ focus: () => input.value.focus() });

</script>

<template>
  <select
      class="border-gray-300 focus:border-primary focus:ring-primary focus:ring-opacity-50 rounded-md shadow-sm"
      :value="modelValue"
      @change="$emit('update:modelValue', $event.target.value)"
      ref="input"
  ><option v-for="(option, index) in options" :value="option.id" :key="index">{{ option.name }}</option></select>
</template>

<style scoped>

</style>