<template>
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <div class="detail-wrapper">
          <div v-if="loading" class="text-center py-5">
            <i class="fas fa-spinner fa-spin fa-2x" style="color:#002147;"></i>
          </div>
          
          <div v-else-if="event">
            <!-- Banner -->
            <div class="inner-page-banner-area" style="background: linear-gradient(135deg, #002147 0%, #004080 100%); padding: 60px 0; text-align: center; border-radius: 10px; margin-bottom: 40px;">
              <div class="container">
                <div class="pagination-area">
                  <h1 style="color: #fff; margin: 0;">{{ event.event_name }}</h1>
                  <ul style="list-style: none; padding: 0; margin-top: 15px;">
                    <li style="display: inline; color: #fff;">
                      <router-link to="/" style="color: #f39c12; text-decoration: none;">Home</router-link> 
                      <span style="color: #fff;"> - </span> 
                      <span style="color: #fff;">Event Details</span>
                    </li>
                  </ul>
                </div>
              </div>
            </div>

            <!-- Content -->
            <div class="courses-details-area">
              <div class="row">
                <!-- Left Column -->
                <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                  <div class="courses-details-content">
                    <!-- Image -->
                    <div class="courses-img-wrapper" style="margin-bottom: 30px; text-align: center;">
                      <img 
                        :src="event.image || 'https://placehold.co/800x400/002147/white?text=NO+BROCHURE+AVAILABLE'" 
                        :alt="event.event_name" 
                        class="event-brochure-image"
                      >
                    </div>

                    <!-- Title -->
                    <h2 style="color: #002147; font-weight: 600; margin-top: 0;">{{ event.event_name }}</h2>
                    
                    <!-- Info Tags -->
                    <div class="courses-info-tags" style="margin: 20px 0; display: flex; gap: 30px; flex-wrap: wrap;">
                      <div>
                        <i class="fas fa-map-marker-alt" style="color: #f39c12; margin-right: 8px;"></i>
                        <strong>Location:</strong> {{ event.location }}
                      </div>
                      <div>
                        <i class="far fa-calendar-alt" style="color: #f39c12; margin-right: 8px;"></i>
                        <strong>Date:</strong> {{ formatDate(event.date) }}
                      </div>
                      <div>
                        <i class="fas fa-check-circle" style="color: #28a745; margin-right: 8px;"></i>
                        <strong>Status:</strong> Open
                      </div>
                    </div>
                    
                    <!-- Description -->
                    <div class="courses-description" style="margin: 30px 0;">
                      <h4 style="color: #002147; margin-bottom: 15px;">About This Event</h4>
                      <p style="line-height: 1.8; color: #555;">{{ event.description || 'No description available for this event.' }}</p>
                    </div>

                    <!-- Back Button -->
                    <router-link to="/events" class="btn-back">
                      <i class="fas fa-arrow-left"></i> Back to Events List
                    </router-link>
                  </div>
                </div>
                
                <!-- Right Column (Sidebar) -->
                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                  <div class="sidebar" style="background: #f8f9fa; padding: 25px; border-radius: 10px;">
                    <h4 style="color: #002147; margin-bottom: 20px;">Event Information</h4>
                    <ul style="list-style: none; padding: 0;">
                      <li style="padding: 10px 0; border-bottom: 1px solid #dee2e6;">
                        <i class="fas fa-calendar-week" style="width: 30px; color: #f39c12;"></i>
                        <strong>Date:</strong> {{ formatDate(event.date) }}
                      </li>
                      <li style="padding: 10px 0; border-bottom: 1px solid #dee2e6;">
                        <i class="fas fa-clock" style="width: 30px; color: #f39c12;"></i>
                        <strong>Time:</strong> 09:00 - 17:00 (WIB)
                      </li>
                      <li style="padding: 10px 0; border-bottom: 1px solid #dee2e6;">
                        <i class="fas fa-map-pin" style="width: 30px; color: #f39c12;"></i>
                        <strong>Location:</strong> {{ event.location }}
                      </li>
                      <li style="padding: 10px 0;">
                        <i class="fas fa-users" style="width: 30px; color: #f39c12;"></i>
                        <strong>Quota:</strong> 40 participants
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
          </div>
          
          <div v-else class="text-center py-5">
            <h3>Event not found</h3>
            <router-link to="/events" class="btn-back">Back to List</router-link>
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
      event: null,
      loading: true
    }
  },
  mounted() {
    const id = this.$route.params.id
    console.log('Event ID:', id)
    axios.get(`/events/${id}`)
      .then(response => {
        this.event = response.data.data
        this.loading = false
      })
      .catch(error => {
        console.error('Error:', error)
        this.loading = false
      })
  },
  methods: {
    formatDate(date) {
      const d = new Date(date)
      return d.toLocaleDateString('en-US', { month: 'long', day: 'numeric', year: 'numeric' })
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

.row {
  display: flex;
  flex-wrap: wrap;
}

.col-lg-8 {
  width: 66.666%;
  padding: 0 15px;
}

.col-lg-4 {
  width: 33.333%;
  padding: 0 15px;
}

.col-md-8, .col-md-4, .col-sm-12, .col-xs-12 {
  padding: 0 15px;
}

.btn-back {
  display: inline-block;
  background: #002147;
  color: #fff;
  padding: 12px 25px;
  border-radius: 5px;
  text-decoration: none;
  font-weight: 500;
  margin-top: 20px;
  transition: 0.3s;
}

.btn-back:hover {
  background: #f39c12;
  color: #fff;
}

.courses-details-content {
  background: #fff;
  padding: 30px;
  border-radius: 10px;
  box-shadow: 0 2px 15px rgba(0,0,0,0.05);
}

.event-brochure-image {
  width: 100%;
  max-width: 100%;
  height: auto;
  border-radius: 10px;
  box-shadow: 0 4px 15px rgba(0,0,0,0.1);
  object-fit: contain;
  background-color: #f8f9fa;
}

@media (max-width: 768px) {
  .col-lg-8, .col-lg-4 {
    width: 100%;
    margin-bottom: 30px;
  }
  
  .courses-details-content {
    padding: 20px;
  }
}
</style>