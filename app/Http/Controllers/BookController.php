<?php

namespace App\Http\Controllers;
use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->query('search');
        $books = Book::where(function ($query) use ($search) {
            if ($search) {
                $query->where('Title', 'like', '%' . $search . '%')
                    ->orWhere('Author', 'like', '%' . $search . '%')
                    ->orWhere('Description', 'like', '%' . $search . '%')
                    ->orWhere('Published_Date', 'like', '%' . $search . '%');
            }

        })->simplepaginate(4);



        return view('index', compact('books', 'search'));
    }

//

    public function create()
    {
        return view('create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|max:20',
            'author' => 'required|alpha|max:25',
            'description' => 'required|max:40',
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
            'title' => 'required|max:20',
            'author' => 'required|alpha|max:25',
            'description' => 'required|max:40',
            'published_date' => 'before:today|required|',
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


