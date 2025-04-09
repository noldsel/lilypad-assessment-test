<template>
  <main >
    <h1>Simple Form</h1>
    <FeedbackList />
    <form @submit.prevent="handleSubmit">
      <label for="name">Name:</label>
      <input
        id="name"
        type="text"
        v-model="name"
        placeholder="Enter your name"
        required
      />
      <button type="submit">Submit</button>
    </form>

    <p v-if="submitted">Submitted name: {{ name }}</p>
  </main>
</template>

<script setup>
import { ref } from 'vue'
import FeedbackList from './FeedbackList.vue'

const name = ref('')
const submitted = ref(false)

function handleSubmit() {
  submitted.value = true
}
</script>

<style scoped>
.form-container {
  max-width: 400px;
  margin: 2rem auto;
  padding: 1.5rem;
  border: 1px solid #ccc;
  border-radius: 8px;
}

input {
  display: block;
  width: 100%;
  margin-top: 0.5rem;
  margin-bottom: 1rem;
  padding: 0.5rem;
  font-size: 1rem;
}

button {
  padding: 0.5rem 1rem;
  font-size: 1rem;
}
</style>