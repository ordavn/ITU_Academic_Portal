<template>
  <div class="container" style="padding-top: 40px; padding-bottom: 40px;">
    <h2 style="margin-bottom: 30px;">Create New Facility</h2>
    
    <div style="background: white; padding: 30px; border-radius: 8px; max-width: 600px; box-shadow: 0 2px 8px rgba(0,0,0,0.1);">
      <form @submit.prevent="submitFacility">
        <div style="margin-bottom: 20px;">
          <label style="display: block; margin-bottom: 8px; font-weight: bold;">Facility Name: *</label>
          <input 
            type="text" 
            v-model="form.name" 
            required 
            placeholder="e.g., Computer Lab"
            style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 4px; box-sizing: border-box;">
        </div>

        <div style="margin-bottom: 20px;">
          <label style="display: block; margin-bottom: 8px; font-weight: bold;">Building: *</label>
          <input 
            type="text" 
            v-model="form.building" 
            required 
            placeholder="e.g., Building A"
            style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 4px; box-sizing: border-box;">
        </div>

        <div style="margin-bottom: 20px;">
          <label style="display: block; margin-bottom: 8px; font-weight: bold;">Location: *</label>
          <input 
            type="text" 
            v-model="form.location" 
            required 
            placeholder="e.g., 2nd Floor, Room 210"
            style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 4px; box-sizing: border-box;">
        </div>

        <div style="margin-bottom: 20px;">
          <label style="display: block; margin-bottom: 8px; font-weight: bold;">Capacity:</label>
          <input 
            type="number" 
            v-model="form.capacity" 
            placeholder="e.g., 50"
            style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 4px; box-sizing: border-box;">
        </div>

        <div style="margin-bottom: 20px;">
          <label style="display: block; margin-bottom: 8px; font-weight: bold;">Operational Hours:</label>
          <input 
            type="text" 
            v-model="form.operational_hours" 
            placeholder="e.g., 08:00 - 17:00"
            style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 4px; box-sizing: border-box;">
        </div>

        <div style="margin-bottom: 20px;">
          <label style="display: block; margin-bottom: 8px; font-weight: bold;">Description:</label>
          <textarea 
            v-model="form.description" 
            placeholder="Describe the facility..."
            rows="4"
            style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 4px; box-sizing: border-box; resize: vertical;"></textarea>
        </div>

        <div style="margin-bottom: 20px;">
          <label style="display: block; margin-bottom: 8px; font-weight: bold;">Facility Image:</label>
          <input 
            type="file" 
            @change="handleFileUpload" 
            accept="image/*" 
            style="width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 4px; box-sizing: border-box;">
          <small style="color: #666; display: block; margin-top: 5px;">Supported formats: JPEG, PNG, JPG, GIF (Max 2MB)</small>
          
          <div v-if="imagePreview" style="margin-top: 15px;">
            <img 
              :src="imagePreview" 
              alt="Preview" 
              style="max-width: 100%; height: auto; max-height: 200px; border-radius: 4px;">
          </div>
        </div>

        <div style="display: flex; gap: 10px; justify-content: flex-start;">
          <button 
            type="submit"
            style="background: #002147; color: white; padding: 12px 30px; border: none; border-radius: 4px; cursor: pointer; font-weight: bold;"
            :style="{ opacity: submitting ? 0.6 : 1 }"
            :disabled="submitting"
          >
            {{ submitting ? 'Creating...' : 'Create Facility' }}
          </button>
          <router-link 
            to="/admin/facilities"
            style="background: #999; color: white; padding: 12px 30px; border-radius: 4px; text-decoration: none; cursor: pointer; font-weight: bold; display: inline-block;">
            Cancel
          </router-link>
        </div>
      </form>

      <div v-if="errorMessage" style="background: #ffebee; color: #c62828; padding: 12px; border-radius: 4px; margin-top: 20px;">
        {{ errorMessage }}
      </div>
    </div>
  </div>
</template>

<script>
import axios from '../axios.js';

export default {
  data() {
    return {
      form: {
        name: '',
        building: '',
        location: '',
        capacity: null,
        operational_hours: '',
        description: ''
      },
      imageFile: null,
      imagePreview: null,
      submitting: false,
      errorMessage: ''
    }
  },
  methods: {
    handleFileUpload(event) {
      const file = event.target.files[0];
      if (file) {
        this.imageFile = file;
        // Create preview
        const reader = new FileReader();
        reader.onload = (e) => {
          this.imagePreview = e.target.result;
        };
        reader.readAsDataURL(file);
      }
    },
    async submitFacility() {
      this.errorMessage = '';
      this.submitting = true;

      try {
        const formData = new FormData();
        formData.append('name', this.form.name);
        formData.append('building', this.form.building);
        formData.append('location', this.form.location);
        formData.append('capacity', this.form.capacity || null);
        formData.append('operational_hours', this.form.operational_hours);
        formData.append('description', this.form.description);

        if (this.imageFile) {
          formData.append('image', this.imageFile);
        }

        const token = localStorage.getItem('adminToken');
        const response = await axios.post('/facilities', formData, {
          headers: {
            'Authorization': `Bearer ${token}`,
            'Content-Type': 'multipart/form-data'
          }
        });

        alert('Facility created successfully!');
        this.$router.push('/admin/facilities');
      } catch (error) {
        console.error('Error creating facility:', error);
        this.errorMessage = error.response?.data?.message || 'Failed to create facility. Please try again.';
      } finally {
        this.submitting = false;
      }
    }
  }
}
</script>

<style scoped>
.container {
  max-width: 700px;
  margin: 0 auto;
  padding-left: 20px;
  padding-right: 20px;
}
</style>