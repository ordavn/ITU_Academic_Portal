<template>
  <div>
    <div class="inner-page-banner-area" style="background: linear-gradient(135deg, #002147 0%, #004080 100%); padding: 60px 0; text-align: center;">
      <div class="container">
        <h1 style="color: #fff; margin: 0;">Add New Event</h1>
        <ul style="list-style: none; margin-top: 15px; padding: 0;">
          <li style="display: inline; color: #fff;">
            <router-link to="/admin/dashboard" style="color: #f39c12; text-decoration: none;">Admin</router-link>
            <span style="color: #fff;"> - </span>
            <span style="color: #fff;">Add Event</span>
          </li>
        </ul>
      </div>
    </div>

    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="form-wrapper" style="background: #fff; padding: 40px; border-radius: 10px; box-shadow: 0 2px 15px rgba(0,0,0,0.05); margin: 40px 0;">
            <form @submit.prevent="submitForm">

              <div class="form-group" style="margin-bottom: 25px;">
                <label style="display: block; margin-bottom: 8px; font-weight: 600; color: #002147;">
                  <i class="fas fa-tag"></i> Event Name
                </label>
                <input type="text" v-model="form.event_name" required style="width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 5px; font-size: 16px;" placeholder="Enter event name">
              </div>

              <div class="form-group" style="margin-bottom: 25px;">
                <label style="display: block; margin-bottom: 8px; font-weight: 600; color: #002147;">
                  <i class="far fa-calendar-alt"></i> Date
                </label>
                <input type="date" v-model="form.date" required style="width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 5px; font-size: 16px;">
              </div>

              <div class="form-group" style="margin-bottom: 25px;">
                <label style="display: block; margin-bottom: 8px; font-weight: 600; color: #002147;">
                  <i class="fas fa-map-marker-alt"></i> Location
                </label>
                <input type="text" v-model="form.location" required style="width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 5px; font-size: 16px;" placeholder="Enter location">
              </div>

              <div class="form-group" style="margin-bottom: 25px;">
                <label style="display: block; margin-bottom: 8px; font-weight: 600; color: #002147;">
                  <i class="fas fa-align-left"></i> Description
                </label>
                <textarea v-model="form.description" rows="5" style="width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 5px; font-size: 16px; font-family: inherit;" placeholder="Describe the event..."></textarea>
              </div>

              <div class="form-group" style="margin-bottom: 25px;">
                <label style="display: block; margin-bottom: 8px; font-weight: 600; color: #002147;">
                  <i class="fas fa-image"></i> Image URL (Brochure)
                </label>
                <input type="text" v-model="form.image" style="width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 5px; font-size: 16px;" placeholder="https://picsum.photos/id/104/400/250">
                <small style="color: #888; display: block; margin-top: 5px;">Leave empty to use default image</small>
              </div>

              <div v-if="form.image" style="margin-bottom: 25px;">
                <label style="display: block; margin-bottom: 8px; font-weight: 600; color: #002147;">Preview:</label>
                <img :src="form.image" style="max-width: 200px; border-radius: 5px; border: 1px solid #ddd;">
              </div>

              <div class="form-buttons" style="display: flex; gap: 15px; margin-top: 30px;">
                <button type="submit" class="btn-submit">
                  <i class="fas fa-save"></i> Save Event
                </button>
                <router-link to="/admin/events" class="btn-cancel">
                  <i class="fas fa-times"></i> Cancel
                </router-link>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import axios from '../axios'

export default {
  data() {
    return {
      form: {
        event_name: '',
        date: '',
        location: '',
        description: '',
        image: ''
      }
    }
  },
  methods: {
    submitForm() {
      axios.post('/events', this.form)
        .then(() => {
          this.$router.push('/admin/events')
        })
        .catch(error => {
          console.error('Error:', error)
          alert('Error creating event')
        })
    }
  }
}
</script>

<style scoped>
.container {
  max-width: 1200px;
  margin: 0 auto;
  padding: 0 15px;
}

.btn-submit {
  background: #28a745;
  color: #fff;
  padding: 12px 30px;
  border: none;
  border-radius: 5px;
  font-size: 16px;
  font-weight: 500;
  cursor: pointer;
  transition: 0.3s;
}

.btn-submit:hover {
  background: #218838;
}

.btn-cancel {
  background: #6c757d;
  color: #fff;
  padding: 12px 30px;
  border-radius: 5px;
  text-decoration: none;
  font-size: 16px;
  font-weight: 500;
  transition: 0.3s;
  display: inline-block;
}

.btn-cancel:hover {
  background: #5a6268;
  color: #fff;
}

.form-group input:focus,
.form-group textarea:focus {
  outline: none;
  border-color: #f39c12;
  box-shadow: 0 0 5px rgba(243, 156, 18, 0.3);
}
</style>