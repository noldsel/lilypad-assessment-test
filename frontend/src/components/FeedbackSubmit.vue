<template>
  <div>
    
    <v-btn @click="showModal = true" color="primary">Submit Feedback</v-btn>


    <v-dialog v-model="showModal" max-width="500px">
      <v-card>
        <v-card-title>
          <span class="headline">Feedback Form</span>
        </v-card-title>

        <v-card-text>
          
          <v-text-field
            v-model="name"
            label="Customer Name"
            outlined
            density="compact"
          ></v-text-field>

          <!-- <v-rating
            v-model="rating"
            label="Rating"
            outlined
            dense
            color="amber"
            background-color="grey lighten-4"
          ></v-rating> -->
          <div>How happy are you with this app?</div>
          <v-rating 
            v-model="rating" 
            :max="5"
            >
            <template v-slot:item="{ index, isFilled }">
              <v-icon 
                :icon="getIcon(index, isFilled)" 
                size="36" 
                color="yellow-darken-3"
              />
            </template>
          </v-rating>

          <v-textarea
            v-model="message"
            label="Message"
            outlined
            density="compact"
            rows="4"
          ></v-textarea>

          
        </v-card-text>

        <v-card-actions>
          <v-btn @click="submitFeedback" color="primary">Submit</v-btn>
          <v-btn @click="showModal = false" color="grey">Cancel</v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>
  </div>
</template>

<script setup>
import { ref, computed } from 'vue';
import api from '@/plugins/axios'

import eventBus from '@/eventBus';


const showModal = ref(false);
const name = ref('');
const rating = ref(null);
const message = ref('');

const outlinedIcons = [
  'mdi-emoticon-cry-outline',
  'mdi-emoticon-sad-outline',
  'mdi-emoticon-neutral-outline',
  'mdi-emoticon-happy-outline',
  'mdi-emoticon-excited-outline',
]

const filledIcons = [
  'mdi-emoticon-cry',
  'mdi-emoticon-sad',
  'mdi-emoticon-neutral',
  'mdi-emoticon-happy',
  'mdi-emoticon-excited',
]

const getIcon = (index, isFilled) => {
  return isFilled ? filledIcons[index] : outlinedIcons[index]
}

const submitFeedback = async () => {
  
//   console.log('Name:', name.value);
//   console.log('Rating:', rating.value);
//   console.log('Message:', message.value);

  try {
    await api.post('/api/feedback', {
        customer_name: name.value,
        message: message.value,
        rating: rating.value
    })
    // items.value = response.data.data
    // console.log('items', response.data.data)
    // totalItems.value = response.data.total_feedback_count; 
  } catch (error) {
    console.error('Error fetching feedbacks:', error)
  } finally {
    eventBus.emit('feedback-submitted');
  }

  
  showModal.value = false;

  
  name.value = '';
  rating.value = null;
  message.value = '';
};
</script>

