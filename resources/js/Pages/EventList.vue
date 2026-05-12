<template>
  <GuestLayout>
    <div>
      <div class="inner-page-banner-area" style="background-color: black; background-image: url('/images/Untitled%20design.png'); background-size: cover; background-position: center; padding: 80px 0; text-align: center;">
        <div  class="container">
          <div class="pagination-area">
            <h1 style="color: #fff; margin: 0;">All Events</h1>
            <ul style="list-style: none; margin-top: 15px; padding: 0;">
              <li style="display: inline; color: #fff;">
                <Link href="/" style="color: #f39c12; text-decoration: none;">Home</Link> 
                <span style="color: #fff;"> - </span> 
                <span style="color: #fff;">All Events</span>
              </li>
            </ul>
          </div>
        </div>
      </div>

      <div class="container">
        <div class="row">
          <div class="col-lg-12">
            <div class="d-flex justify-content-between align-items-center my-4">
              <h2 style="color: #002147;">Events List</h2>
              <Link href="/events/create" class="btn-apply-now">
                <i class="fas fa-plus"></i> Add Event
              </Link>
            </div>
          </div>
        </div>

        <div v-if="!events || events.length === 0" class="text-center py-5">
          <p>No events found. <Link href="/events/create">Add your first event</Link></p>
        </div>

        <div v-else>
          <div v-for="event in events" :key="event.id" class="courses-box3">
            <div class="single-item-wrapper">
              <div class="courses-img-wrapper">
                <img class="img-responsive" :src="event.image || 'https://placehold.co/400x250/002147/white?text=EVENT'" :alt="event.event_name">
                <Link :href="'/events/' + event.id"><i class="fa fa-link" aria-hidden="true"></i></Link>
              </div>
              <div class="courses-content-wrapper">
                <h3 class="item-title">
                  <Link :href="'/events/' + event.id">{{ event.event_name }}</Link>
                </h3>
                <p class="item-content">{{ event.description || 'Join us for this exciting event.' }}</p>
                <ul class="courses-info">
                  <li>
                    LOCATION<br>
                    <span><i class="fas fa-map-marker-alt"></i> {{ event.location }}</span>
                  </li>
                  <li>
                    DATE<br>
                    <span><i class="far fa-calendar-alt"></i> {{ formatDate(event.date) }}</span>
                  </li>
                  <li>
                    STATUS<br>
                    <span><i class="fas fa-check-circle"></i> Open</span>
                  </li>
                </ul>
                <div class="action-buttons">
                  <Link :href="'/events/' + event.id" class="btn-view">
                    <i class="fas fa-eye"></i> View
                  </Link>
                  <Link :href="'/events/' + event.id + '/edit'" class="btn-edit">
                    <i class="fas fa-edit"></i> Edit
                  </Link>
                  
                  <Link :href="'/events/' + event.id" method="delete" as="button" class="btn-delete" onclick="return confirm('Are you sure you want to delete this event?')">
                    <i class="fas fa-trash"></i> Delete
                  </Link>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </GuestLayout>
</template>

<script>
// 1. Import Inertia Link and the layout
import { Link } from '@inertiajs/vue3';
import GuestLayout from '@/Layouts/GuestLayout.vue';

export default {
  components: {
    Link,
    GuestLayout
  },
  
  // 2. Accept events as a prop from Laravel instead of fetching via Axios
  props: {
    events: Array
  },

  methods: {
    formatDate(date) {
      const d = new Date(date)
      return d.toLocaleDateString('en-US', { month: 'short', day: 'numeric', year: 'numeric' })
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

.courses-box3 {
  background: #fff;
  border-radius: 8px;
  margin-bottom: 30px;
  overflow: hidden;
  box-shadow: 0 2px 15px rgba(0,0,0,0.08);
}

.single-item-wrapper {
  display: flex;
  flex-wrap: wrap;
}

.courses-img-wrapper {
  flex: 0 0 300px;
  position: relative;
  overflow: hidden;
}

.courses-img-wrapper img {
  width: 100%;
  height: 220px;
  object-fit: cover;
}

.courses-img-wrapper a {
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%) scale(0);
  background: #002147;
  color: #fff;
  width: 45px;
  height: 45px;
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  transition: 0.3s;
}

.courses-img-wrapper:hover a {
  transform: translate(-50%, -50%) scale(1);
}

.courses-content-wrapper {
  flex: 1;
  padding: 20px 25px;
}

.item-title {
  font-size: 1.3rem;
  font-weight: 600;
  margin-bottom: 10px;
}

.item-title a {
  color: #002147;
  text-decoration: none;
}

.item-title a:hover {
  color: #f39c12;
}

.item-content {
  color: #666;
  margin: 15px 0;
  line-height: 1.5;
}

.courses-info {
  display: flex;
  gap: 40px;
  list-style: none;
  padding: 0;
  margin: 20px 0;
}

.courses-info li {
  font-size: 0.75rem;
  color: #888;
  font-weight: 600;
  text-transform: uppercase;
}

.courses-info li span {
  display: block;
  font-size: 1rem;
  color: #002147;
  font-weight: 600;
  margin-top: 5px;
}

.courses-info li span i {
  margin-right: 5px;
  font-size: 0.85rem;
}

.action-buttons {
  display: flex;
  gap: 10px;
  margin-top: 15px;
}

.btn-view {
  background: #17a2b8;
  color: #fff;
  padding: 8px 20px;
  border-radius: 5px;
  text-decoration: none;
  font-size: 0.85rem;
  transition: 0.3s;
}

.btn-view:hover {
  background: #138496;
  color: #fff;
}

.btn-edit {
  background: #ffc107;
  color: #333;
  padding: 8px 20px;
  border-radius: 5px;
  text-decoration: none;
  font-size: 0.85rem;
  transition: 0.3s;
}

.btn-edit:hover {
  background: #e0a800;
  color: #333;
}

.btn-delete {
  background: #dc3545;
  color: #fff;
  padding: 8px 20px;
  border-radius: 5px;
  border: none;
  cursor: pointer;
  font-size: 0.85rem;
  transition: 0.3s;
}

.btn-delete:hover {
  background: #c82333;
}

.btn-apply-now {
  background: #002147;
  color: #fff;
  padding: 10px 25px;
  border-radius: 5px;
  text-decoration: none;
  font-weight: 500;
  transition: 0.3s;
}

.btn-apply-now:hover {
  background: #f39c12;
  color: #fff;
}

h2 {
  font-size: 1.8rem;
  font-weight: 600;
  margin: 0;
}

@media (max-width: 768px) {
  .single-item-wrapper {
    flex-direction: column;
  }
  
  .courses-img-wrapper {
    flex: 0 0 auto;
  }
  
  .courses-info {
    flex-wrap: wrap;
    gap: 20px;
  }
  
  .action-buttons {
    flex-wrap: wrap;
  }
  
  .d-flex {
    flex-direction: column;
    gap: 15px;
    align-items: flex-start !important;
  }
}
</style>