<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
</script>

<template>
    <Head title="Admin Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Admin Control Panel</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                    <div class="p-6 text-gray-900 border-b border-gray-200">
                        <h3 class="text-lg font-bold">Welcome back, {{ $page.props.auth.user.name }}!</h3>
                        <p class="text-gray-600 mt-1">Select an administrative module below to manage the academic portal.</p>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    
                    <Link href="/events" class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 hover:bg-blue-50 hover:border-blue-300 border border-transparent transition duration-150 ease-in-out group">
                        <div class="text-blue-600 mb-3">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        </div>
                        <h3 class="text-lg font-bold text-gray-900 group-hover:text-blue-700">Manage Events</h3>
                        <p class="text-sm text-gray-600 mt-2">Create, edit, and delete campus events, summer courses, and gatherings.</p>
                    </Link>

                    <Link href="route('library.index')" class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 hover:bg-yellow-50 hover:border-yellow-300 border border-transparent transition duration-150 ease-in-out group">
                        <div class="text-yellow-500 mb-3">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                        </div>
                        <h3 class="text-lg font-bold text-gray-900 group-hover:text-yellow-700">Manage Library</h3>
                        <p class="text-sm text-gray-600 mt-2">Add new books to the digital collection or remove outdated materials.</p>
                    </Link>

                    <Link href="/admin/facilities" class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 hover:bg-green-50 hover:border-green-300 border border-transparent transition duration-150 ease-in-out group">
                        <div class="text-green-600 mb-3">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                        </div>
                        <h3 class="text-lg font-bold text-gray-900 group-hover:text-green-700">Manage Facilities</h3>
                        <p class="text-sm text-gray-600 mt-2">Update information about campus labs, sports complexes, and classrooms.</p>
                    </Link>

                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>