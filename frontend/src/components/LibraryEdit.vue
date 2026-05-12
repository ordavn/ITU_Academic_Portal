<template>
  <div class="container" style="padding-top: 40px; padding-bottom: 40px;">
    <h2 style="margin-bottom: 30px;">Edit Book</h2>
    
    <div v-if="loading" style="text-align: center; padding: 40px;">
      <p>Loading book details...</p>
    </div>

    <div v-else style="background: white; padding: 30px; border-radius: 8px; max-width: 600px; box-shadow: 0 2px 8px rgba(0,0,0,0.1);">
      <form @submit.prevent="submitBook">
        <div style="margin-bottom: 20px;">
          <label style="display: block; margin-bottom: 8px; font-weight: bold;">Book Title: *</label>
          <input type="text" v-model="form.title" required style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 4px;">
        </div>

        <div style="margin-bottom: 20px;">
          <label style="display: block; margin-bottom: 8px; font-weight: bold;">Author: *</label>
          <input type="text" v-model="form.author" required style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 4px;">
        </div>

        <div style="margin-bottom: 20px;">
          <label style="display: block; margin-bottom: 8px; font-weight: bold;">Description:</label>
          <textarea v-model="form.description" rows="4" style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 4px; resize: vertical;"></textarea>
        </div>

        <div style="margin-bottom: 20px;">
          <label style="display: block; margin-bottom: 8px; font-weight: bold;">Book Cover:</label>
          <input type="file" @change="handleFileUpload" accept="image/*" style="width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 4px;">
          
          <div v-if="form.image && !imagePreview" style="margin-top: 15px;">
            <p style="margin-bottom: 10px; color: #666; font-size: 14px;">Current Cover:</p>
            <img :src="`http://127.0.0.1:8000/storage/${form.image}`" alt="Current" style="max-height: 200px; border-radius: 4px;">
          </div>
          
          <div v-if="imagePreview" style="margin-top: 15px;">
            <p style="margin-bottom: 10px; color: #666; font-size: 14px;">New Cover Preview:</p>
            <img :src="imagePreview" alt="Preview" style="max-height: 200px; border-radius: 4px;">
          </div>
        </div>

        <div style="display: flex; gap: 10px;">
          <button type="submit" :disabled="submitting" :style="`background: #002147; color: white; padding: 12px 30px; border: none; border-radius: 4px; cursor: pointer; font-weight: bold; opacity: ${submitting ? 0.6 : 1};`">
            {{ submitting ? 'Updating...' : 'Update Book' }}
          </button>
          <router-link to="/admin/library" style="background: #999; color: white; padding: 12px 30px; border-radius: 4px; text-decoration: none; font-weight: bold;">
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
      bookId: null,
      form: { title: '', author: '', description: '', image: null },
      imageFile: null,
      imagePreview: null,
      submitting: false,
      loading: true,
      errorMessage: ''
    }
  },
  methods: {
    async fetchBook() {
      try {
        const response = await axios.get(`/books/${this.bookId}`);
        const book = response.data;
        this.form = {
          title: book.title,
          author: book.author,
          description: book.description,
          image: book.image 
        };
      } catch (error) {
        this.errorMessage = 'Failed to load book details';
      } finally {
        this.loading = false;
      }
    },
    handleFileUpload(event) {
      const file = event.target.files[0];
      if (file) {
        this.imageFile = file;
        const reader = new FileReader();
        reader.onload = (e) => { this.imagePreview = e.target.result; };
        reader.readAsDataURL(file);
      }
    },
    async submitBook() {
      this.errorMessage = '';
      this.submitting = true;

      try {
        const formData = new FormData();
        formData.append('title', this.form.title);
        formData.append('author', this.form.author);
        formData.append('description', this.form.description || '');

        if (this.imageFile) {
          formData.append('image', this.imageFile);
        }

        const token = localStorage.getItem('adminToken');
        
        // Remember the PUT trick for FormData!
        await axios.post(`/books/${this.bookId}?_method=PUT`, formData, {
          headers: {
            'Authorization': `Bearer ${token}`,
            'Content-Type': 'multipart/form-data'
          }
        });

        alert('Book updated successfully!');
        this.$router.push('/admin/library');
      } catch (error) {
        this.errorMessage = error.response?.data?.message || 'Failed to update book.';
      } finally {
        this.submitting = false;
      }
    }
  },
  mounted() {
    this.bookId = this.$route.params.id;
    this.fetchBook();
  }
}
</script>