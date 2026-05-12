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