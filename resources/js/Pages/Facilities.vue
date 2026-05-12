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
        <h1 class="text-5xl font-bold text-white mb-4">Featured Facilities</h1>
        <div class="w-20 h-1 bg-white"></div>
      </div>
    </div>

    <!-- Facilities Grid Section -->
    <div class="max-w-7xl mx-auto px-4 py-16">
      <div class="mb-12">
        <h2 class="text-3xl font-bold text-gray-900 mb-2">Our Campus Facilities</h2>
        <p class="text-gray-600">Explore the world-class facilities available to our students</p>
      </div>

      <!-- Facilities Grid -->
      <div v-if="facilities.length > 0" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        <div
          v-for="facility in facilities"
          :key="facility.id"
          class="bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300"
        >
          <!-- Facility Image -->
          <div class="h-48 bg-gradient-to-br from-blue-400 to-blue-600 flex items-center justify-center">
            <svg
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

            <!-- View Details Button -->
            <button
              class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-lg transition-colors duration-200"
            >
              View Details
            </button>
          </div>
        </div>
      </div>

      <!-- Empty State -->
      <div v-else class="text-center py-12">
        <p class="text-gray-600 text-lg">No facilities available at the moment.</p>
      </div>
    </div>

    <!-- Footer -->
    <Footer />
  </div>
</template>

<script setup>
import { defineProps } from 'vue'
import Footer from '@/Components/Footer.vue'

defineProps({
  facilities: {
    type: Array,
    default: () => [],
  },
})
</script>

<style scoped>
/* Add any additional styling here if needed */
</style>
