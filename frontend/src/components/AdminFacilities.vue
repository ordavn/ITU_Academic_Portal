<template>
  <div class="container" style="padding-top: 40px; padding-bottom: 40px;">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px;">
      <h2 style="margin: 0;">Manage Facilities</h2>
      <router-link 
        to="/admin/facilities/create" 
        style="background: #002147; color: white; padding: 10px 20px; border-radius: 4px; text-decoration: none; cursor: pointer;">
        + Add New Facility
      </router-link>
    </div>

    <!-- Loading State -->
    <div v-if="loading" style="text-align: center; padding: 40px;">
      <p>Loading facilities...</p>
    </div>

    <!-- No Facilities Message -->
    <div v-else-if="facilities.length === 0" style="background: white; padding: 20px; border-radius: 8px; text-align: center;">
      <p>No facilities found. Create your first facility!</p>
    </div>

    <!-- Facilities List -->
    <div v-else style="background: white; border-radius: 8px; overflow: hidden; box-shadow: 0 2px 8px rgba(0,0,0,0.1);">
      <table style="width: 100%; border-collapse: collapse;">
        <thead>
          <tr style="background: #f5f5f5; border-bottom: 2px solid #ddd;">
            <th style="padding: 15px; text-align: left; font-weight: bold;">Name</th>
            <th style="padding: 15px; text-align: left; font-weight: bold;">Building</th>
            <th style="padding: 15px; text-align: left; font-weight: bold;">Location</th>
            <th style="padding: 15px; text-align: left; font-weight: bold;">Capacity</th>
            <th style="padding: 15px; text-align: center; font-weight: bold;">Actions</th>
          </tr>
        </thead>
        <tbody>
          <tr 
            v-for="facility in facilities" 
            :key="facility.id"
            style="border-bottom: 1px solid #eee; hover-background: #f9f9f9;">
            <td style="padding: 15px;">
              <strong>{{ facility.name }}</strong>
            </td>
            <td style="padding: 15px;">{{ facility.building }}</td>
            <td style="padding: 15px;">{{ facility.location }}</td>
            <td style="padding: 15px;">{{ facility.capacity || 'N/A' }}</td>
            <td style="padding: 15px; text-align: center;">
              <router-link 
                :to="`/admin/facilities/${facility.id}/edit`"
                style="background: #4CAF50; color: white; padding: 8px 12px; border: none; border-radius: 4px; cursor: pointer; text-decoration: none; margin-right: 8px; display: inline-block;">
                Edit
              </router-link>
              <button 
                @click="deleteFacility(facility.id)"
                style="background: #f44336; color: white; padding: 8px 12px; border: none; border-radius: 4px; cursor: pointer;">
                Delete
              </button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</template>

<script>
import axios from '../axios.js';

export default {
  data() {
    return {
      facilities: [],
      loading: true
    }
  },
  methods: {
    async fetchFacilities() {
      try {
        this.loading = true;
        const token = localStorage.getItem('adminToken');
        const response = await axios.get('/facilities', {
          headers: {
            'Authorization': `Bearer ${token}`
          }
        });
        this.facilities = response.data;
      } catch (error) {
        console.error('Failed to fetch facilities:', error);
        alert('Failed to load facilities');
      } finally {
        this.loading = false;
      }
    },
    async deleteFacility(id) {
      if(confirm('Are you sure you want to delete this facility?')) {
        try {
          const token = localStorage.getItem('adminToken');
          await axios.delete(`/facilities/${id}`, {
            headers: {
              'Authorization': `Bearer ${token}`
            }
          });
          alert('Facility deleted successfully!');
          this.fetchFacilities();
        } catch (error) {
          console.error('Failed to delete facility:', error);
          alert('Failed to delete facility');
        }
      }
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

tr:hover {
  background: #f9f9f9;
}
</style>
