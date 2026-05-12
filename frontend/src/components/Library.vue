<template>
  <div class="container" style="padding-top: 40px;">
    <h2 style="color: #002147; margin-bottom: 30px;">University Library</h2>
    
    <div class="row">
      <div v-for="book in books" :key="book.id" class="col-lg-4 col-md-6" style="margin-bottom: 20px;">
        <div class="card" style="background: white; padding: 20px; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.1);">
          <img v-if="book.image" :src="`http://localhost:8000/storage/${book.image}`" alt="Book Cover" style="width: 100%; height: 250px; object-fit: cover; border-radius: 4px; margin-bottom: 15px;">
          
          <h3 style="font-size: 18px; margin-bottom: 5px;">{{ book.title }}</h3>
          <p style="color: #f39c12; font-weight: 600; font-size: 14px; margin-bottom: 10px;">{{ book.author }}</p>
          <p style="color: #666; font-size: 14px;">{{ book.description }}</p>
        </div>
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