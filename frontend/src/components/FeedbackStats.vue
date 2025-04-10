<template>
    <v-card
      class="d-flex flex-column mx-auto py-8"
      elevation="10"
      height="500"
      width="100%"
    >
      <div class="d-flex justify-center mt-auto text-h5 ">
        Rating overview
      </div>
  
      <div class="d-flex align-center flex-column my-auto">
        <div class="text-h2 mt-5">
          {{ feedbackStats.average_rating }}
          <span class="text-h6 ml-n3">/5</span>
        </div>
  
        <v-rating
          :model-value="feedbackStats.average_rating"
          color="yellow-darken-3"
          half-increments
          readonly
        ></v-rating>
        <div class="px-3">{{ feedbackStats.total_ratings }} ratings</div>
      </div>

      <v-list
            bg-color="transparent"
            class="d-flex flex-column-reverse"
            density="compact"
        >
            <v-list-item
            v-for="(count, rating) in feedbackStats.ratings_count"
            :key="rating"
            >
            <v-progress-linear
                :model-value="(count / feedbackStats.total_ratings) * 100" 
                class="mx-n5"
                color="yellow-darken-3"
                height="20"
                rounded
            ></v-progress-linear>

            <template v-slot:prepend>
                <span>{{ rating }}</span>
                <v-icon class="mx-3" icon="mdi-star"></v-icon>
            </template>

            <template v-slot:append>
                <div class="rating-values">
                <span class="d-flex justify-end">{{ count }}</span>
                </div>
            </template>
            </v-list-item>
        </v-list>

        
  
      <!-- <v-list
        bg-color="transparent"
        class="d-flex flex-column-reverse"
        density="compact"
      >
        <v-list-item v-for="(rating,i) in 5" :key="i">
          <v-progress-linear
            :model-value="rating * 15"
            class="mx-n5"
            color="yellow-darken-3"
            height="20"
            rounded
          ></v-progress-linear>
  
          <template v-slot:prepend>
            <span>{{ rating }}</span>
            <v-icon class="mx-3" icon="mdi-star"></v-icon>
          </template>
  
          <template v-slot:append>
            <div class="rating-values">
              <span class="d-flex justify-end"> {{ rating * 224 }} </span>
            </div>
          </template>
        </v-list-item>
      </v-list> -->
    </v-card>
  </template>
<script setup>
import { ref, onMounted, watch } from 'vue'

import api from '@/plugins/axios'

const feedbackStats = ref([])
const loading = ref(false)

const fetchFeedbackStats = async () => {
  loading.value = true
  try {
    const { data } = await api.get('/api/stats')
    feedbackStats.value = data.data
    // pagination.value.total = data.length
  } catch (error) {
    console.error('Error fetching feedbacks:', error)
  } finally {
    loading.value = false
  }
}

onMounted(fetchFeedbackStats)
</script>
<style scoped>
.rating-values {
   width: 25px;
}
</style>