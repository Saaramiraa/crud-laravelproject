<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Author;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    public function index()
    {
        $authors = Author::with('books')->get();
        return view('authors.index', compact('authors'));
    }

    public function create()
    {
        return view('authors.create');
    }

    public function store(Request $request)
    {
        $request->validate(['name' => 'required']);
        Author::create($request->all());
        return redirect()->route('authors.index')->with('success', 'Author created successfully.');
    }

    public function edit(Author $author)
    {
        return view('authors.edit', compact('author'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'books' => 'required|array',
            'books.*.title' => 'required',
        ]);

        $author = Author::find($id);
        $author->name = $request->input('name');
        $author->save();

        // Update or create books for the author
        foreach ($request->input('books') as $bookData) {
            if (isset($bookData['id'])) {
                // Update existing book
                $book = Book::find($bookData['id']);
                $book->update(['title' => $bookData['title']]);
            } else {
                // Create new book if no id is provided
                $author->books()->create(['title' => $bookData['title']]);
            }
        }

        return redirect()->route('authors.index')->with('success', 'Author and books updated successfully.');
    }


    public function destroy(Author $author)
    {
        $author->delete();
        return redirect()->route('authors.index')->with('success', 'Author deleted successfully.');
    }
}
