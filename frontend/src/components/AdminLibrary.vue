<template>
  <div class="container" style="padding-top: 40px;">
    <h2 style="margin-bottom: 30px; color: #002147;">Manage Library</h2>
    
    <div style="background: white; padding: 25px; border-radius: 8px; margin-bottom: 30px; box-shadow: 0 2px 10px rgba(0,0,0,0.05);">
      <h3 style="margin-bottom: 20px; font-size: 20px;">Add New Book</h3>
      <form @submit.prevent="submitBook">
        <div style="margin-bottom: 15px;">
          <label style="display: block; margin-bottom: 5px; font-weight: 600;">Title:</label>
          <input type="text" v-model="form.title" required style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 4px;">
        </div>
        <div style="margin-bottom: 15px;">
          <label style="display: block; margin-bottom: 5px; font-weight: 600;">Author:</label>
          <input type="text" v-model="form.author" required style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 4px;">
        </div>
        <div style="margin-bottom: 15px;">
          <label style="display: block; margin-bottom: 5px; font-weight: 600;">Description:</label>
          <textarea v-model="form.description" required rows="3" style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 4px; resize: vertical;"></textarea>
        </div>
        <div style="margin-bottom: 20px;">
          <label style="display: block; margin-bottom: 5px; font-weight: 600;">Image Cover:</label>
          <input type="file" @change="handleFileUpload" accept="image/*" style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 4px; background: #f9f9f9;">
        </div>
        <button type="submit" style="background: #002147; color: white; padding: 12px 25px; border: none; border-radius: 4px; cursor: pointer; font-weight: bold;">
          Save Book
        </button>
      </form>
    </div>

    <h3 style="margin-bottom: 15px; font-size: 20px; color: #002147;">Existing Books</h3>
    
    <div v-if="books.length === 0" style="color: #666; padding: 20px; background: white; border-radius: 8px; text-align: center;">
      No books in the library yet.
    </div>

    <div v-for="book in books" :key="book.id" style="background: white; padding: 15px 20px; margin-bottom: 12px; border-radius: 8px; display: flex; justify-content: space-between; align-items: center; box-shadow: 0 2px 5px rgba(0,0,0,0.05);">
      <div>
        <strong style="color: #002147; font-size: 16px;">{{ book.title }}</strong> 
        <span style="color: #666;">by {{ book.author }}</span>
      </div>
      
      <div style="display: flex; gap: 10px;">
        <router-link 
          :to="`/admin/library/${book.id}/edit`" 
          style="background: #f39c12; color: white; padding: 8px 16px; border-radius: 4px; text-decoration: none; font-weight: 500; font-size: 14px; display: inline-block;">
          Edit
        </router-link>
        
        <button 
          @click="deleteBook(book.id)" 
          style="background: #e74c3c; color: white; border: none; padding: 8px 16px; border-radius: 4px; cursor: pointer; font-weight: 500; font-size: 14px;">
          Delete
        </button>
      </div>
    </div>
  </div>
</template>

<script>
// If you use an interceptor for tokens, you can change this to import axios from '../axios.js';
import axios from 'axios';

export default {
  data() {
    return {
      books: [],
      form: {
        title: '',
        author: '',
        description: ''
      },
      imageFile: null
    }
  },
  methods: {
    async fetchBooks() {
      try {
        const response = await axios.get('/books');
        this.books = response.data;
      } catch (error) {
        console.error("Error fetching books:", error);
      }
    },
    handleFileUpload(event) {
      this.imageFile = event.target.files[0];
    },
    async submitBook() {
      let formData = new FormData();
      formData.append('title', this.form.title);
      formData.append('author', this.form.author);
      formData.append('description', this.form.description);
      
      if (this.imageFile) {
        formData.append('image', this.imageFile);
      }

      try {
        await axios.post('/books', formData, {
          headers: {
            'Content-Type': 'multipart/form-data'
          }
        });
        alert('Book saved!');
        this.fetchBooks(); 
        
        // Reset form completely
        this.form = { title: '', author: '', description: '' };
        this.imageFile = null;
        document.querySelector('input[type="file"]').value = ''; 
      } catch (error) {
        console.error(error);
        alert('Failed to save book.');
      }
    },
    async deleteBook(id) {
      if(confirm('Are you sure you want to delete this book?')) {
        try {
          await axios.delete(`/books/${id}`);
          this.fetchBooks();
        } catch (error) {
          console.error(error);
          alert('Failed to delete book.');
        }
      }
    }
  },
  mounted() {
    this.fetchBooks();
  }
}
</script>