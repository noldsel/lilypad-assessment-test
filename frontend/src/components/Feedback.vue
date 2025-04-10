<template>
  <main >
    
    <v-container width="100%">
      <h1>LilyPad POS Feedback</h1>
      <v-row>
        <v-col cols="6">
          <FeedbackStats />
          <div class="spacer"></div>
          <FeedbackSubmit />
        </v-col>
        <v-col cols="6">
          <FeedbackList />
        </v-col>
      </v-row>
      
      
    </v-container>
    
   
  </main>
</template>

<script setup>

import FeedbackList from './FeedbackList.vue'
import FeedbackStats from './FeedbackStats.vue'
import FeedbackSubmit from './FeedbackSubmit.vue'


</script>

<style scoped>
.spacer {
  margin-bottom: 20px; /* Adjust the spacing as needed */
}
</style>