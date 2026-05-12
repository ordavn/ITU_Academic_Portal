<template>
  <div>
    <div class="library-hero">
      <div class="hero-overlay"></div>
      <div class="hero-content">
        <h1>Library</h1>
        <div class="hero-breadcrumb">
          <router-link to="/" class="home-link">Home</router-link> - <span>Library</span>
        </div>
      </div>
    </div>

    <div class="container library-content">
      <div class="row">
        <div v-for="book in books" :key="book.id" class="col-lg-4 col-md-6 book-col">
          <div class="book-card">
            <img v-if="book.image" :src="`http://localhost:8000/storage/${book.image}`" alt="Book Cover" class="book-cover">
            
            <div class="book-info">
              <h3 class="book-title">{{ book.title }}</h3>
              <p class="book-author">{{ book.author }}</p>
              <p class="book-desc">{{ book.description }}</p>
            </div>
          </div>
        </div>
      </div>
      
      <div v-if="books.length === 0" class="no-books">
        <p>No books available in the library at the moment.</p>
      </div>
    </div>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  data() {
    return {
      books: []
    }
  },
  async mounted() {
    try {
      const response = await axios.get('/books');
      this.books = response.data;
    } catch (error) {
      console.error("Error fetching library:", error);
    }
  }
}
</script>

<style scoped>
/* ========================
   Hero Banner Styles 
======================== */
.library-hero {
  position: relative;
  background-image: url('/images/library-images.jpg'); 
  background-size: cover;
  background-position: center;
  padding: 60px 0;
  text-align: center;
  margin-bottom: 50px;
}

/* Dark overlay to make the white text readable */
.hero-overlay {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: rgba(0, 33, 71, 0.6); /* Matches your IN-TECH dark blue */
}

.hero-content {
  position: relative;
  z-index: 1;
}

.hero-content h1 {
  color: #ffffff;
  font-size: 48px;
  font-weight: 700;
  margin-bottom: 10px;
  text-shadow: 2px 2px 4px rgba(0,0,0,0.5);
}

.hero-breadcrumb {
  display: flex;
  justify-content: center;
  align-items: center;
  gap: 8px; /* Adds nice spacing between Home - Library */
  color: #ffffff;
  font-size: 16px;
  font-weight: 500;
}

.home-link {
  color: #f39c12; /* Your IN-TECH Orange highlight */
  text-decoration: none;
  transition: 0.3s;
}

.home-link:hover {
  color: #ffffff;
}

/* ========================
   Library Grid Styles 
======================== */
.library-content {
  padding-bottom: 60px;
}

.book-col {
  margin-bottom: 30px;
}

.book-card {
  background: #ffffff;
  border-radius: 8px;
  box-shadow: 0 4px 15px rgba(0,0,0,0.05);
  overflow: hidden;
  height: 100%;
  transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.book-card:hover {
  transform: translateY(-5px); /* Creates a cool floating effect on hover */
  box-shadow: 0 8px 25px rgba(0,0,0,0.15);
}

.book-cover {
  width: 100%;
  height: 250px;
  object-fit: cover;
  border-bottom: 3px solid #f39c12; /* Small orange accent line under the image */
}

.book-info {
  padding: 20px;
}

.book-title {
  font-size: 18px;
  color: #002147;
  margin-bottom: 8px;
  font-weight: 700;
}

.book-author {
  color: #f39c12;
  font-weight: 600;
  font-size: 14px;
  margin-bottom: 15px;
}

.book-desc {
  color: #666;
  font-size: 14px;
  line-height: 1.6;
}

.no-books {
  text-align: center;
  padding: 40px;
  color: #666;
  font-style: italic;
  width: 100%;
}
</style>