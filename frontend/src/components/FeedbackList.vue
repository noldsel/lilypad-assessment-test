<template>
  <v-container>
    <h2>Card List</h2>
    <v-row>

      <v-col cols="12" md="4">
        <Filters v-model="ratingFilter"/>
      </v-col>

      <v-col
        v-for="item in items"
        :key="item.id"
        cols="12" 
      >
        <v-card >
            <v-card-title class="d-flex justify-space-between">
              <div>{{ item.customer_name }} </div>

              
            </v-card-title>
            <v-card-text>
              <v-rating 
                :model-value="item.rating" 
                icon="mdi-star" half-increments
                color="yellow-darken-3"
                readonly
              />


              
              <div>
                {{ item.message }}
              </div>

            </v-card-text>
            <v-card-subtitle class="text-grey">
              Submitted on {{ formatDate(item.created_at) }}
            </v-card-subtitle>
          </v-card>
      </v-col>
    </v-row>
    <v-pagination
      v-model="currentPage"
      :length="pageCount"
      :total-visible="5"
      @update="fetchFeedbacks"
    ></v-pagination>
    
  </v-container>
</template>

<script setup>
import { ref, onMounted, watch, computed } from 'vue'
// import axios from 'axios'
import api from '@/plugins/axios'
import Filters from './Filters.vue';
import eventBus from '@/eventBus';




const items = ref([]);
const currentPage = ref(1);
const itemsPerPage = 3;
const totalItems = ref(0);
const ratingFilter = ref(null);

// const ratingOptions = [
//   { title: 'All Ratings', value: null },
//   { title: '1 Star', value: 1 },
//   { title: '2 Stars', value: 2 },
//   { title: '3 Stars', value: 3 },
//   { title: '4 Stars', value: 4 },
//   { title: '5 Stars', value: 5 }
// ];

const fetchFeedbacks = async () => {
  console.log('calling fetch')
  
  try {
    const response = await api.get('/api/feedback', {
      params: {
        page: currentPage.value,
        perPage: itemsPerPage,
        filters: {
          rating: ratingFilter.value
        }
      }
    })
    items.value = response.data.data
    console.log('items', response.data.data)
    totalItems.value = response.data.total_feedback_count; 
  } catch (error) {
    console.error('Error fetching feedbacks:', error)
  }
}

const formatDate = (date) => new Date(date).toLocaleString()

// onMounted(fetchFeedbacks)
onMounted(() => {
  fetchFeedbacks();
  eventBus.on('feedback-submitted', handleFeedback);
});

const handleFeedback = () => {
  fetchFeedbacks();
};

watch(currentPage, fetchFeedbacks); 
watch(ratingFilter, fetchFeedbacks);

const pageCount = computed(() => {
  return Math.ceil(totalItems.value / itemsPerPage);
});

// const paginatedItems = computed(() => {
//   return items;
//   // const start = (currentPage.value - 1) * itemsPerPage;
//   // const end = start + itemsPerPage;
//   // console.log('Paginated items:', items.value.slice(start, end));  // Debugging paginated items
//   // return items.value.slice(start, end);
// });

</script>
