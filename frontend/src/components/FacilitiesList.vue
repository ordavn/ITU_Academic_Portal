<template>
  <div class="container" style="padding-top: 40px; padding-bottom: 40px;">
    <h2 style="margin-bottom: 30px; text-align: center;">Facilities</h2>
    
    <!-- Loading State -->
    <div v-if="loading" style="text-align: center; padding: 40px;">
      <p>Loading facilities...</p>
    </div>

    <!-- No Facilities Message -->
    <div v-else-if="facilities.length === 0" style="background: white; padding: 40px; border-radius: 8px; text-align: center;">
      <p style="font-size: 16px; color: #666;">No facilities available at the moment.</p>
    </div>

    <!-- Facilities Grid -->
    <div v-else style="display: grid; grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); gap: 20px;">
      <div 
        v-for="facility in facilities" 
        :key="facility.id"
        style="background: white; border-radius: 8px; overflow: hidden; box-shadow: 0 2px 8px rgba(0,0,0,0.1); transition: transform 0.3s, box-shadow 0.3s; cursor: pointer;"
        @click="selectFacility(facility)"
        @mouseenter="$event.currentTarget.style.boxShadow = '0 4px 16px rgba(0,0,0,0.15)'; $event.currentTarget.style.transform = 'translateY(-5px)'"
        @mouseleave="$event.currentTarget.style.boxShadow = '0 2px 8px rgba(0,0,0,0.1)'; $event.currentTarget.style.transform = 'translateY(0)'">
        
        <!-- Facility Image -->
        <div style="width: 100%; height: 200px; overflow: hidden; background: #f0f0f0;">
          <img 
            v-if="facility.image_path"
            :src="`http://127.0.0.1:8000/storage/${facility.image_path}`"
            :alt="facility.name"
            style="width: 100%; height: 100%; object-fit: cover;">
          <div v-else style="width: 100%; height: 100%; display: flex; align-items: center; justify-content: center; background: #e0e0e0; color: #999;">
            <span>No Image</span>
          </div>
        </div>

        <!-- Facility Details -->
        <div style="padding: 15px;">
          <h3 style="margin: 0 0 10px 0; color: #002147;">{{ facility.name }}</h3>
          
          <div style="margin-bottom: 8px;">
            <strong style="color: #666;">Building:</strong> {{ facility.building }}
          </div>

          <div style="margin-bottom: 8px;">
            <strong style="color: #666;">Location:</strong> {{ facility.location }}
          </div>

          <div v-if="facility.capacity" style="margin-bottom: 8px;">
            <strong style="color: #666;">Capacity:</strong> {{ facility.capacity }} people
          </div>

          <div v-if="facility.operational_hours" style="margin-bottom: 12px;">
            <strong style="color: #666;">Hours:</strong> {{ facility.operational_hours }}
          </div>

          <p v-if="facility.description" style="color: #666; font-size: 14px; line-height: 1.4;">
            {{ facility.description.substring(0, 100) }}{{ facility.description.length > 100 ? '...' : '' }}
          </p>
        </div>
      </div>
    </div>

    <!-- Facility Detail Modal -->
    <div v-if="selectedFacility" style="position: fixed; top: 0; left: 0; right: 0; bottom: 0; background: rgba(0,0,0,0.5); display: flex; align-items: center; justify-content: center; z-index: 1000;">
      <div style="background: white; border-radius: 8px; max-width: 500px; width: 90%; max-height: 80vh; overflow-y: auto; position: relative;">
        <!-- Close Button -->
        <button 
          @click="selectedFacility = null"
          style="position: absolute; top: 15px; right: 15px; background: #f44336; color: white; border: none; border-radius: 50%; width: 30px; height: 30px; cursor: pointer; font-size: 18px; z-index: 10;">
          ×
        </button>

        <!-- Modal Image -->
        <div style="width: 100%; height: 250px; overflow: hidden; background: #f0f0f0;">
          <img 
            v-if="selectedFacility.image_path"
            :src="`http://127.0.0.1:8000/storage/${selectedFacility.image_path}`"
            :alt="selectedFacility.name"
            style="width: 100%; height: 100%; object-fit: cover;">
          <div v-else style="width: 100%; height: 100%; display: flex; align-items: center; justify-content: center; background: #e0e0e0; color: #999;">
            <span>No Image</span>
          </div>
        </div>

        <!-- Modal Details -->
        <div style="padding: 25px;">
          <h2 style="margin: 0 0 15px 0; color: #002147;">{{ selectedFacility.name }}</h2>

          <div style="margin-bottom: 12px;">
            <strong style="color: #002147;">Building:</strong>
            <p style="margin: 5px 0 0 0; color: #666;">{{ selectedFacility.building }}</p>
          </div>

          <div style="margin-bottom: 12px;">
            <strong style="color: #002147;">Location:</strong>
            <p style="margin: 5px 0 0 0; color: #666;">{{ selectedFacility.location }}</p>
          </div>

          <div v-if="selectedFacility.capacity" style="margin-bottom: 12px;">
            <strong style="color: #002147;">Capacity:</strong>
            <p style="margin: 5px 0 0 0; color: #666;">{{ selectedFacility.capacity }} people</p>
          </div>

          <div v-if="selectedFacility.operational_hours" style="margin-bottom: 12px;">
            <strong style="color: #002147;">Operational Hours:</strong>
            <p style="margin: 5px 0 0 0; color: #666;">{{ selectedFacility.operational_hours }}</p>
          </div>

          <div v-if="selectedFacility.description" style="margin-bottom: 12px;">
            <strong style="color: #002147;">Description:</strong>
            <p style="margin: 5px 0 0 0; color: #666; line-height: 1.6;">{{ selectedFacility.description }}</p>
          </div>

          <button 
            @click="selectedFacility = null"
            style="width: 100%; background: #002147; color: white; padding: 10px; border: none; border-radius: 4px; cursor: pointer; margin-top: 15px;">
            Close
          </button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import axios from '../axios.js';

export default {
  data() {
    return {
      facilities: [],
      selectedFacility: null,
      loading: true
    }
  },
  methods: {
    async fetchFacilities() {
      try {
        this.loading = true;
        const response = await axios.get('/facilities');
        this.facilities = response.data;
      } catch (error) {
        console.error('Failed to fetch facilities:', error);
        alert('Failed to load facilities');
      } finally {
        this.loading = false;
      }
    },
    selectFacility(facility) {
      this.selectedFacility = facility;
    }
  },
  mounted() {
    this.fetchFacilities();
  }
}
</script>

<style scoped>
.container {
  max-width: 1200px;
  margin: 0 auto;
  padding-left: 20px;
  padding-right: 20px;
}

@media (max-width: 768px) {
  div[style*="grid-template-columns"] {
    grid-template-columns: 1fr !important;
  }
}
</style>
