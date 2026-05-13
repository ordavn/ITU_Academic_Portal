<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BookController extends Controller
{
    // EVERYONE: Get all books
    public function index()
    {
        return response()->json(Book::latest()->get());
    }

    // ADMIN ONLY: Create a new book
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'author' => 'required|string',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $data = $request->all();

        // Handle Image Upload
        if ($request->hasFile('image')) {
            // Saves to storage/app/public/books
            $imagePath = $request->file('image')->store('books', 'public');
            $data['image'] = $imagePath;
        }

        $book = Book::create($data);
        return response()->json(['message' => 'Book created successfully!', 'book' => $book]);
    }

    // EVERYONE / ADMIN: Fetch a single book for the edit form
    public function show($id)
    {
        $book = Book::findOrFail($id);
        return response()->json($book, 200);
    }

    // ADMIN ONLY: Update an existing book
    public function update(Request $request, $id)
    {
        $book = Book::findOrFail($id);

        $validatedData = $request->validate([
            'title'       => 'sometimes|required|string|max:255',
            'author'      => 'sometimes|required|string|max:255',
            'description' => 'sometimes|required|string',
            'image'       => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Handle image upload & delete the old one
        if ($request->hasFile('image')) {
            // Delete the old image so your server doesn't get cluttered
            if ($book->image && Storage::disk('public')->exists($book->image)) {
                Storage::disk('public')->delete($book->image);
            }
            
            $imagePath = $request->file('image')->store('books', 'public');
            $validatedData['image'] = $imagePath;
        }

        $book->update($validatedData);

        return response()->json([
            'message' => 'Book updated successfully!',
            'data'    => $book
        ], 200);
    }

    // ADMIN ONLY: Delete a book
    public function destroy($id)
    {
        $book = Book::findOrFail($id);

        // Delete the image file from the server if it exists
        if ($book->image) {
            Storage::disk('public')->delete($book->image);
        }

        $book->delete();
        return response()->json(['message' => 'Book deleted successfully!']);
    }
}