<template>
  <v-container>
    <h2>Table List</h2>
    <v-row>

      <v-col cols="12" md="4">
        <v-select
          v-model="ratingFilter"
          :items="ratingOptions"
          label="Filter by Rating"
          item-text="title"
          item-value="value"
          @change="fetchFeedbacks" 
          density="compact"
          width="300"
        >
        <!-- <template v-slot:item="slotProps">
             <div v-html="slotProps.item.title"></div>
             
          </template> -->
        </v-select>
      </v-col>

      
    </v-row>
    
    
    <v-data-table-server
      :headers="headers"
      :items="items"
      :items-per-page="itemsPerPage"
      :items-length="totalItems"

      :loading="loading"
      :custom-filter="ratingFilter"
      @update:page="handlePageChange"
      @update:items-per-page="fetchFeedbacks"
      item-value="id"
    >

    <template v-slot:[`item.rating`]="{ item }">
      <v-rating 
        :model-value="item.rating" 
        icon="mdi-star" half-increments
        color="yellow-darken-3"
        readonly
      />
    </template>

    </v-data-table-server>
    
  </v-container>
</template>

<script setup>
import { ref, onMounted, watch, computed } from 'vue'
// import axios from 'axios'
import api from '@/plugins/axios'




const items = ref([]);
const currentPage = ref(1);
const itemsPerPage = 10;
const totalItems = ref(0);
const ratingFilter = ref(null);
const loading = ref(false);

const ratingOptions = [
  { title: 'All Ratings', value: null },
  { title: '1 Star', value: 1 },
  { title: '2 Stars', value: 2 },
  { title: '3 Stars', value: 3 },
  { title: '4 Stars', value: 4 },
  { title: '5 Stars', value: 5 }
];



const headers = [
  {
    title: "Name",
    align: "start",
    sortable: false,
    key: "customer_name",
  },
  {
    title: "Message",
    align: "start",
    sortable: false,
    key: "message",
  },
  {
    title: "Rating",
    align: "start",
    sortable: false,
    key: "rating",
  },

];

const fetchFeedbacks = async () => {
  console.log('calling fetch')
  
  try {
    loading.value = true
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
    // console.log('items', response.data.data)
    totalItems.value = response.data.total_feedback_count; 

    console.log('total items', totalItems.value)
  } catch (error) {
    console.error('Error fetching feedbacks:', error)
  } finally {
    loading.value = false
  }
}

const formatDate = (date) => new Date(date).toLocaleString()

const handlePageChange = (page) => {
  currentPage.value = page;
  fetchFeedbacks(); // Fetch new page data
};

onMounted(fetchFeedbacks)

watch(currentPage, fetchFeedbacks); 
watch(ratingFilter, fetchFeedbacks);





</script>
