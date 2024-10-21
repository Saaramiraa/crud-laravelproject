<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Author;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function create()
    {
        $authors = Author::all();
        return view('books.create', compact('authors'));
    }

    public function store(Request $request)
    {
        $request->validate(['title' => 'required', 'author_id' => 'required']);
        Book::create($request->all());
        return redirect()->route('authors.index')->with('success', 'Book created successfully.');
    }

    // public function destroy(Book $book)
    // {
    //     $book->delete();
    //     return redirect()->route('authors.index')->with('success', 'Book deleted successfully.');
    // }

    public function destroy(Book $bookId)
    {
        // Use the injected model directly
        if ($bookId) {
            $bookId->delete();
            return redirect()->back()->with('success', 'Book deleted successfully.');
        }

        return redirect()->back()->with('error', 'Book not found.');
    }
}
