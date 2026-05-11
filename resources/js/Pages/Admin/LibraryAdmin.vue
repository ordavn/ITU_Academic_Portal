<template>
  <AuthenticatedLayout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">Library Management (All-in-One)</h2>
    </template>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
          
          <div class="flex justify-between items-center mb-6">
            <h3 class="text-lg font-bold text-gray-800">Book List</h3>
            <button @click="openCreateModal" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded shadow">
              + Add New Book
            </button>
          </div>

          <table class="w-full text-left border-collapse">
            <thead>
              <tr class="bg-gray-100 border-b">
                <th class="p-3">Title</th>
                <th class="p-3">Author</th>
                <th class="p-3 text-right">Actions</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="book in books" :key="book.id" class="border-b hover:bg-gray-50">
                <td class="p-3 font-semibold">{{ book.title }}</td>
                <td class="p-3">{{ book.author }}</td>
                <td class="p-3 text-right space-x-3">
                  <button @click="openEditModal(book)" class="text-indigo-600 hover:text-indigo-900 font-bold">Edit</button>
                  
                  <Link 
                    :href="`/admin/library/${book.id}`" 
                    method="delete" 
                    as="button"
                    class="text-red-600 hover:text-red-800 font-bold"
                    onclick="return confirm('Delete this book permanently?')"
                  >
                    Delete
                  </Link>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>

    <Modal :show="showModal" @close="closeModal">
      <div class="p-6">
        <h2 class="text-lg font-bold text-gray-900 mb-4">
          {{ isEditing ? 'Edit Book Details' : 'Add New Book' }}
        </h2>
        
        <form @submit.prevent="submit">
          <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700">Title</label>
            <input v-model="form.title" type="text" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500" required>
          </div>

          <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700">Author</label>
            <input v-model="form.author" type="text" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500" required>
          </div>

          <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700">Description</label>
            <textarea v-model="form.description" rows="3" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500" required></textarea>
          </div>

          <div class="mt-6 flex justify-end">
            <button type="button" @click="closeModal" class="bg-gray-200 text-gray-800 px-4 py-2 rounded mr-3">Cancel</button>
            <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded shadow hover:bg-blue-700" :disabled="form.processing">
              {{ isEditing ? 'Update Book' : 'Save Book' }}
            </button>
          </div>
        </form>
      </div>
    </Modal>
  </AuthenticatedLayout>
</template>

<script setup>
import { ref } from 'vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import Modal from '@/Components/Modal.vue';
import { Link, useForm } from '@inertiajs/vue3';

const props = defineProps({
  books: Array
});

const showModal = ref(false);
const isEditing = ref(false);
const selectedBookId = ref(null);

const form = useForm({
  title: '',
  author: '',
  description: ''
});

// Open modal for a NEW book
const openCreateModal = () => {
  isEditing.value = false;
  form.reset();
  showModal.value = true;
};

// Open modal to EDIT an existing book
const openEditModal = (book) => {
  isEditing.value = true;
  selectedBookId.value = book.id;
  
  // Fill the form with existing data
  form.title = book.title;
  form.author = book.author;
  form.description = book.description;
  
  showModal.value = true;
};

const closeModal = () => {
  showModal.value = false;
  form.reset();
};

const submit = () => {
  if (isEditing.value) {
    // Perform PATCH for Update
    form.patch(`/admin/library/${selectedBookId.value}`, {
      onSuccess: () => closeModal(),
    });
  } else {
    // Perform POST for Create
    form.post('/admin/library', {
      onSuccess: () => closeModal(),
    });
  }
};
</script>