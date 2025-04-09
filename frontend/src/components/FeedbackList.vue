<template>
  <v-container>
    <v-data-table-server
      v-model:items-per-page="pagination.itemsPerPage"
      v-model:page="pagination.page"
      :items-length="pagination.total"
      :items="feedbacks"
      :loading="loading"
      item-value="id"
      class="elevation-1"
    >
      <template #item="{ item }">
        <v-card class="my-2">
          <v-card-title class="d-flex justify-space-between">
            <span>{{ item.customer_name }}</span>
            <v-chip color="primary" variant="elevated">
              Rating: {{ item.rating }}
            </v-chip>
          </v-card-title>
          <v-card-text>{{ item.message }}</v-card-text>
          <v-card-subtitle class="text-grey">
            Submitted on {{ formatDate(item.created_at) }}
          </v-card-subtitle>
        </v-card>
      </template>

      <template #no-data>
        <v-alert type="info">No feedback available.</v-alert>
      </template>
    </v-data-table-server>
  </v-container>
</template>

<script setup>
import { ref, onMounted, watch } from 'vue'
// import axios from 'axios'
import api from '@/plugins/axios'

const feedbacks = ref([])
const loading = ref(false)

const pagination = ref({
  page: 1,
  itemsPerPage: 10,
  total: 0,
})

const fetchFeedbacks = async () => {
  loading.value = true
  try {
    const { data } = await api.get('/api/feedback')
    feedbacks.value = data
    pagination.value.total = data.length
  } catch (error) {
    console.error('Error fetching feedbacks:', error)
  } finally {
    loading.value = false
  }
}

const formatDate = (date) => new Date(date).toLocaleString()

onMounted(fetchFeedbacks)

// Optionally refetch when pagination changes
watch(() => [pagination.value.page, pagination.value.itemsPerPage], fetchFeedbacks)
</script>
