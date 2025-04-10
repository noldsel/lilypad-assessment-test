<template>
    <v-select
      v-model="internalValue"
      :items="options"
      label="Filter by Rating"
      item-text="title"
      item-value="value"
      density="compact"
      @update:modelValue="emitChange"
    />
  </template>
  
  <script setup>
  import { ref, watch, toRefs } from 'vue'
  
  const props = defineProps({
    modelValue: [Number, null],
  })

  console.log('props', props.modelValue)
  
  const emit = defineEmits(['update:modelValue'])
  
  const internalValue = ref(props.modelValue)
  
  const options = [
    { title: 'All Ratings', value: null },
    { title: '1 Star', value: 1 },
    { title: '2 Stars', value: 2 },
    { title: '3 Stars', value: 3 },
    { title: '4 Stars', value: 4 },
    { title: '5 Stars', value: 5 },
  ]
  
  watch(() => props.modelValue, (val) => {
    internalValue.value = val
  })
  
  const emitChange = () => {
    emit('update:modelValue', internalValue.value)
  }
  </script>