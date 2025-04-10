<template>
  <!-- <main > -->
    
    
    <v-container fluid>
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

      <v-row>
        <v-col cols="12">
          <FeedbackListTable />
        </v-col>
      </v-row>
      
      
    </v-container>
    
   
  <!-- </main> -->
</template>

<script setup>

import FeedbackList from './FeedbackList.vue'
import FeedbackStats from './FeedbackStats.vue'
import FeedbackSubmit from './FeedbackSubmit.vue'
import FeedbackListTable from './FeedbackListTable.vue'


</script>

<style scoped>
.spacer {
  margin-bottom: 20px; /* Adjust the spacing as needed */
}
</style>