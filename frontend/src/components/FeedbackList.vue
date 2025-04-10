<template>
  <v-container>
    <v-row>
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
              >

              </v-rating>

              
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




const items = ref([]);
const currentPage = ref(1);
const itemsPerPage = 3;
const totalItems = ref(0);

const fetchFeedbacks = async () => {
  console.log('calling fetch')
  
  try {
    const response = await api.get('/api/feedback', {
      params: {
        page: currentPage.value,
        perPage: itemsPerPage
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

onMounted(fetchFeedbacks)

watch(currentPage, fetchFeedbacks); 

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
