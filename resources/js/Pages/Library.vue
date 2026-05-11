<template>
  <GuestLayout>
    <div>
      <div class="inner-page-banner-area" style="background-color: black; background-image: url('https://images.unsplash.com/photo-1507842217343-583bb7270b66?q=80&w=2000&auto=format&fit=crop'); background-size: cover; background-position: center; padding: 80px 0; text-align: center;">
        <div class="container">
          <div class="pagination-area">
            <h1 style="color: #fff; margin: 0;">Digital Library</h1>
            <ul style="list-style: none; margin-top: 15px; padding: 0;">
              <li style="display: inline; color: #fff;">
                <Link href="/" style="color: #f39c12; text-decoration: none;">Home</Link> 
                <span style="color: #fff;"> - </span> 
                <span style="color: #fff;">Library</span>
              </li>
            </ul>
          </div>
        </div>
      </div>

      <div class="container" style="margin-top: 60px; margin-bottom: 60px;">
        <div class="row">
          <div class="col-lg-12 mb-4">
            <h2 style="color: #002147; margin-bottom: 0;">Collection of Books</h2>
          </div>
        </div>

        <div v-if="books.length === 0" class="text-center py-5">
          <p style="color: #666;">No books available in the collection yet.</p>
        </div>

        <div v-else class="row">
          <div v-for="book in books" :key="book.id" class="col-lg-4 col-md-6 col-sm-12 mb-4">
            <div class="service-card" style="text-align: left; padding: 30px;">
              <div class="service-icon" style="margin: 0 0 20px 0; width: 60px; height: 60px;">
                <i class="fas fa-book" style="font-size: 25px;"></i>
              </div>
              <h3 style="font-size: 1.3rem; margin-bottom: 5px;">{{ book.title }}</h3>
              <p style="color: #f39c12; font-weight: bold; font-size: 0.9rem; margin-bottom: 15px;">
                By {{ book.author }}
              </p>
              <p style="color: #666; font-size: 0.95rem; line-height: 1.6;">
                {{ book.description }}
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </GuestLayout>
</template>

<script>
import { Link } from '@inertiajs/vue3';
import GuestLayout from '@/Layouts/GuestLayout.vue';

export default {
  components: { Link, GuestLayout },
  props: { books: Array }
}
</script>

<style scoped>
.service-card { background: #fff; border-radius: 10px; transition: all 0.3s ease; box-shadow: 0 5px 20px rgba(0,0,0,0.08); height: 100%; }
.service-card:hover { transform: translateY(-10px); box-shadow: 0 15px 35px rgba(0,0,0,0.12); }
.service-icon { background: #002147; border-radius: 50%; display: flex; align-items: center; justify-content: center; transition: 0.3s; }
.service-card:hover .service-icon { background: #f39c12; }
.service-icon i { color: #fff; }
</style>