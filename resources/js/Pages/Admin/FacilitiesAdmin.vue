<template>
  <div class="min-h-screen bg-white">
    <!-- Hero Section -->
    <div class="relative h-96 bg-gradient-to-r from-blue-600 to-yellow-500 overflow-hidden">
      <!-- Background Image -->
      <div
        class="absolute inset-0 opacity-40"
        style="
          background-image: url('/images/facilities-hero.jpg');
          background-size: cover;
          background-position: center;
        "
      ></div>

      <!-- Overlay Content -->
      <div class="relative h-full flex flex-col items-center justify-center">
        <h1 class="text-5xl font-bold text-white mb-4">Manage Facilities</h1>
        <div class="w-20 h-1 bg-white"></div>
      </div>
    </div>

    <!-- Main Content -->
    <div class="max-w-7xl mx-auto px-4 py-16">
      <!-- Alert Messages -->
      <div v-if="successMessage" class="mb-4 p-4 bg-green-50 border border-green-200 rounded-lg">
        <p class="text-green-800">{{ successMessage }}</p>
      </div>

      <div v-if="errorMessage" class="mb-4 p-4 bg-red-50 border border-red-200 rounded-lg">
        <p class="text-red-800">{{ errorMessage }}</p>
      </div>

      <!-- Header with Create Button -->
      <div class="flex justify-between items-center mb-12">
        <div>
          <h2 class="text-3xl font-bold text-gray-900 mb-2">Our Campus Facilities</h2>
          <p class="text-gray-600">Manage and update facility information</p>
        </div>
        <button
          @click="openCreateModal"
          class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 px-6 rounded-lg transition-colors"
        >
          + Create Facility
        </button>
      </div>

      <!-- Facilities Grid -->
      <div v-if="facilities.length > 0" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        <div
          v-for="facility in facilities"
          :key="facility.id"
          class="bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300"
        >
          <!-- Facility Image -->
          <div class="h-48 bg-gradient-to-br from-blue-400 to-blue-600 flex items-center justify-center overflow-hidden">
            <img
              v-if="facility.image_path"
              :src="`/storage/${facility.image_path}`"
              :alt="facility.name"
              class="w-full h-full object-cover"
            />
            <svg
              v-else
              class="w-16 h-16 text-white opacity-50"
              fill="none"
              stroke="currentColor"
              viewBox="0 0 24 24"
            >
              <path
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="2"
                d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"
              ></path>
            </svg>
          </div>

          <!-- Facility Content -->
          <div class="p-6">
            <h3 class="text-xl font-bold text-gray-900 mb-2">{{ facility.name }}</h3>

            <div v-if="facility.building" class="mb-3">
              <p class="text-sm text-gray-600">
                <span class="font-semibold">Building:</span> {{ facility.building }}
              </p>
            </div>

            <div v-if="facility.location" class="mb-3">
              <p class="text-sm text-gray-600">
                <span class="font-semibold">Location:</span> {{ facility.location }}
              </p>
            </div>

            <div v-if="facility.capacity" class="mb-3">
              <p class="text-sm text-gray-600">
                <span class="font-semibold">Capacity:</span> {{ facility.capacity }}
              </p>
            </div>

            <div v-if="facility.operational_hours" class="mb-4">
              <p class="text-sm text-gray-600">
                <span class="font-semibold">Hours:</span> {{ facility.operational_hours }}
              </p>
            </div>

            <p v-if="facility.description" class="text-gray-700 text-sm mb-4">
              {{ facility.description }}
            </p>

            <!-- Action Buttons -->
            <div class="flex gap-2">
              <button
                @click="openEditModal(facility)"
                class="flex-1 bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-lg transition-colors"
              >
                Edit
              </button>
              <button
                @click="deleteFacility(facility.id)"
                class="flex-1 bg-red-600 hover:bg-red-700 text-white font-semibold py-2 px-4 rounded-lg transition-colors"
              >
                Delete
              </button>
            </div>
          </div>
        </div>
      </div>

      <!-- Empty State -->
      <div v-else class="text-center py-12">
        <p class="text-gray-600 text-lg mb-4">No facilities available at the moment.</p>
        <button
          @click="openCreateModal"
          class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-6 rounded-lg transition-colors"
        >
          Create First Facility
        </button>
      </div>
    </div>

    <!-- Modal Backdrop -->
    <div
      v-if="showModal"
      class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center p-4 z-50"
      @click="closeModal"
    >
      <!-- Modal -->
      <div
        class="bg-white rounded-lg shadow-xl max-w-md w-full max-h-96 overflow-y-auto"
        @click.stop
      >
        <!-- Modal Header -->
        <div class="sticky top-0 bg-white border-b border-gray-200 px-6 py-4">
          <h2 class="text-xl font-bold text-gray-900">
            {{ editingId ? 'Edit Facility' : 'Create New Facility' }}
          </h2>
        </div>

        <!-- Modal Content -->
        <form @submit.prevent="saveFacility" class="p-6 space-y-4">
          <!-- Name -->
          <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Name *</label>
            <input
              v-model="form.name"
              type="text"
              required
              class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
              placeholder="e.g., Main Library"
            />
          </div>

          <!-- Building -->
          <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Building *</label>
            <input
              v-model="form.building"
              type="text"
              required
              class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
              placeholder="e.g., Building A"
            />
          </div>

          <!-- Location -->
          <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Location *</label>
            <input
              v-model="form.location"
              type="text"
              required
              class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
              placeholder="e.g., Campus Center"
            />
          </div>

          <!-- Capacity -->
          <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Capacity</label>
            <input
              v-model.number="form.capacity"
              type="number"
              class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
              placeholder="e.g., 500"
            />
          </div>

          <!-- Operational Hours -->
          <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Operational Hours</label>
            <input
              v-model="form.operational_hours"
              type="text"
              class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
              placeholder="e.g., 08:00 - 22:00"
            />
          </div>

          <!-- Description -->
          <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Description</label>
            <textarea
              v-model="form.description"
              rows="3"
              class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
              placeholder="Enter facility description"
            ></textarea>
          </div>

          <!-- Modal Footer -->
          <div class="flex gap-2 pt-4">
            <button
              type="submit"
              :disabled="isLoading"
              class="flex-1 bg-blue-600 hover:bg-blue-700 disabled:bg-gray-400 text-white font-semibold py-2 px-4 rounded-lg transition-colors"
            >
              {{ isLoading ? 'Saving...' : (editingId ? 'Update' : 'Create') }}
            </button>
            <button
              @click="closeModal"
              type="button"
              class="flex-1 bg-gray-300 hover:bg-gray-400 text-gray-900 font-semibold py-2 px-4 rounded-lg transition-colors"
            >
              Cancel
            </button>
          </div>
        </form>
      </div>
    </div>

    <!-- Footer -->
    <Footer />
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import axios from 'axios'
import Footer from '@/Components/Footer.vue'

const facilities = ref([])
const editingId = ref(null)
const isLoading = ref(false)
const showModal = ref(false)
const successMessage = ref('')
const errorMessage = ref('')

const form = ref({
  name: '',
  building: '',
  location: '',
  capacity: null,
  operational_hours: '',
  description: '',
})

const defaultForm = {
  name: '',
  building: '',
  location: '',
  capacity: null,
  operational_hours: '',
  description: '',
}

// Fetch all facilities on mount
onMounted(async () => {
  await fetchFacilities()
})

const fetchFacilities = async () => {
  try {
    const response = await axios.get('/api/facilities')
    facilities.value = response.data
  } catch (error) {
    console.error('Error fetching facilities:', error)
    errorMessage.value = 'Failed to load facilities'
    setTimeout(() => (errorMessage.value = ''), 3000)
  }
}

const openCreateModal = () => {
  editingId.value = null
  form.value = { ...defaultForm }
  showModal.value = true
}

const openEditModal = (facility) => {
  editingId.value = facility.id
  form.value = { ...facility }
  showModal.value = true
}

const closeModal = () => {
  showModal.value = false
  resetForm()
}

const saveFacility = async () => {
  isLoading.value = true
  try {
    if (editingId.value) {
      // Update existing facility
      await axios.put(`/api/facilities/${editingId.value}`, form.value)
      successMessage.value = 'Facility updated successfully!'
    } else {
      // Create new facility
      await axios.post('/api/facilities', form.value)
      successMessage.value = 'Facility created successfully!'
    }

    closeModal()
    await fetchFacilities()
    setTimeout(() => (successMessage.value = ''), 3000)
  } catch (error) {
    console.error('Error saving facility:', error)
    errorMessage.value = error.response?.data?.message || 'Failed to save facility'
    setTimeout(() => (errorMessage.value = ''), 3000)
  } finally {
    isLoading.value = false
  }
}

const deleteFacility = async (id) => {
  if (!confirm('Are you sure you want to delete this facility?')) {
    return
  }

  try {
    await axios.delete(`/api/facilities/${id}`)
    successMessage.value = 'Facility deleted successfully!'
    await fetchFacilities()
    setTimeout(() => (successMessage.value = ''), 3000)
  } catch (error) {
    console.error('Error deleting facility:', error)
    errorMessage.value = 'Failed to delete facility'
    setTimeout(() => (errorMessage.value = ''), 3000)
  }
}

const resetForm = () => {
  editingId.value = null
  form.value = { ...defaultForm }
}
</script>

<style scoped>
/* Add any additional styling here if needed */
</style>
