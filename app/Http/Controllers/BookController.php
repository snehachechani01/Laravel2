<?php

namespace App\Http\Controllers;
use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index()
    {
        $books = Book::simplePaginate(5);

        return view('index', compact('books'));
    }

    public function search(Request $request)
    {

        $query = $request->input('query');
        $books = Book::where('title', 'LIKE', "%{$query}%")
            ->orWhere('author', 'LIKE', "%{$query}%")
            ->orWhere('published_date', 'LIKE', "%{$query}%");
//            ->paginate(5);
            return view('search', compact('books'));
    }


    public function create()
    {
        return view('create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required',
            'author' => 'required',
            'description' => 'required',
            'published_date' => 'before:today|required|',
        ]);

        $book = Book::create($validatedData);

        return redirect('/books')->with('success', 'Book has been added');
    }

    public function show($id)
    {
        $book = Book::findOrFail($id);

        return view('show', compact('book'));
    }

    public function edit($id)
    {
        $book = Book::findOrFail($id);

        return view('edit', compact('book'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'title' => 'required',
            'author' => 'required',
            'description' => 'required',
            'published_date' => 'required|date',
        ]);

        Book::whereId($id)->update($validatedData);

        return redirect('/books')->with('success', 'Book has been updated');
    }

    public function destroy($id)
    {
        $book = Book::findOrFail($id);

        $book->delete();

        return redirect('/books')->with('success', 'Book has been deleted');
    }


}


