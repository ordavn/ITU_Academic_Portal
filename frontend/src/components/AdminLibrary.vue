<template>
  <div class="container" style="padding-top: 40px;">
    <h2>Manage Library</h2>
    
    <div style="background: white; padding: 20px; border-radius: 8px; margin-bottom: 30px;">
      <h3>Add New Book</h3>
      <form @submit.prevent="submitBook">
        <div style="margin-bottom: 10px;">
          <label>Title:</label>
          <input type="text" v-model="form.title" required style="width: 100%; padding: 8px;">
        </div>
        <div style="margin-bottom: 10px;">
          <label>Author:</label>
          <input type="text" v-model="form.author" required style="width: 100%; padding: 8px;">
        </div>
        <div style="margin-bottom: 10px;">
          <label>Description:</label>
          <textarea v-model="form.description" required style="width: 100%; padding: 8px;"></textarea>
        </div>
        <div style="margin-bottom: 10px;">
          <label>Image Cover:</label>
          <input type="file" @change="handleFileUpload" accept="image/*" style="width: 100%; padding: 8px;">
        </div>
        <button type="submit" style="background: #002147; color: white; padding: 10px 20px; border: none; cursor: pointer;">Save Book</button>
      </form>
    </div>

    <div v-for="book in books" :key="book.id" style="background: white; padding: 15px; margin-bottom: 10px; display: flex; justify-content: space-between; align-items: center;">
      <div>
        <strong>{{ book.title }}</strong> by {{ book.author }}
      </div>
      <button @click="deleteBook(book.id)" style="background: red; color: white; border: none; padding: 5px 10px; cursor: pointer;">Delete</button>
    </div>
  </div>
</template>

<script>
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
      imageFile: null // Store the actual file here
    }
  },
  methods: {
    async fetchBooks() {
      const response = await axios.get('/books');
      this.books = response.data;
    },
    handleFileUpload(event) {
      // Grab the first file the user selected
      this.imageFile = event.target.files[0];
    },
    async submitBook() {
      // Because we are sending a file, we MUST use FormData instead of a standard JSON object
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
            'Content-Type': 'multipart/form-data' // Tell Laravel we are sending files
          }
        });
        alert('Book saved!');
        this.fetchBooks(); // Refresh the list
        // Reset form
        this.form = { title: '', author: '', description: '' };
        this.imageFile = null;
      } catch (error) {
        console.error(error);
        alert('Failed to save book.');
      }
    },
    async deleteBook(id) {
      if(confirm('Are you sure?')) {
        await axios.delete(`/books/${id}`);
        this.fetchBooks();
      }
    }
  },
  mounted() {
    this.fetchBooks();
  }
}
</script>