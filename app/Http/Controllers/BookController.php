<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Storage;

class BookController extends Controller
{
    /**
     * Display the library page (Student View).
     * Accessible by: All users
     * Route: GET /library
     */
    public function showPage()
    {
        $books = Book::all();
        
        return Inertia::render('Library', [
            'books' => $books,
        ]);
    }

    /**
     * Display the admin library management page.
     * Accessible by: Authenticated users (Admins)
     * Route: GET /admin/library
     */
    public function adminPage()
    {
        // Passing books here is recommended so the Admin page has data to show
        return Inertia::render('Admin/LibraryAdmin', [
            'books' => Book::latest()->get()
        ]);
    }

    /**
     * Display a listing of the books.
     * Accessible by: Students (Read-only) and Admins
     * Route: GET /api/books
     */
    public function index()
    {
        $books = Book::all();
        
        return response()->json($books, 200);
    }

    /**
     * Store a newly created book in the database.
     * Accessible by: Admins
     * Route: POST /api/books
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title'       => 'required|string|max:255',
            'author'      => 'required|string|max:255',
            'description' => 'nullable|string',
            'image'       => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Handle cover image upload (similar to facilities image)
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imagePath = $image->store('books', 'public');
            $validatedData['image_path'] = $imagePath;
        }

        $book = Book::create($validatedData);

        return response()->json([
            'message' => 'Book added successfully!',
            'data'    => $book
        ], 201);
    }

    /**
     * Display the specified book.
     * Route: GET /api/books/{id}
     */
    public function show($id)
    {
        $book = Book::findOrFail($id);
        
        return response()->json($book, 200);
    }

    /**
     * Update the specified book in the database.
     * Accessible by: Admins
     * Route: PUT /api/books/{id}
     */
    public function update(Request $request, $id)
    {
        $book = Book::findOrFail($id);

        $validatedData = $request->validate([
            'title'       => 'sometimes|required|string|max:255',
            'author'      => 'sometimes|required|string|max:255',
            'description' => 'nullable|string',
            'image'       => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Handle image upload and replace old one
        if ($request->hasFile('image')) {
            // Delete old cover if exists
            if ($book->image_path && Storage::disk('public')->exists($book->image_path)) {
                Storage::disk('public')->delete($book->image_path);
            }
            
            $image = $request->file('image');
            $imagePath = $image->store('books', 'public');
            $validatedData['image_path'] = $imagePath;
        }

        $book->update($validatedData);

        return response()->json([
            'message' => 'Book updated successfully!',
            'data'    => $book
        ], 200);
    }

    /**
     * Remove the specified book from the database.
     * Accessible by: Admins
     * Route: DELETE /api/books/{id}
     */
    public function destroy($id)
    {
        $book = Book::findOrFail($id);

        // Optional: Delete the image file from storage when book is deleted
        if ($book->image_path) {
            Storage::disk('public')->delete($book->image_path);
        }

        $book->delete();

        return response()->json([
            'message' => 'Book deleted successfully!'
        ], 200);
    }
}