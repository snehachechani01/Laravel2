@extends('app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h3>BOOK HEAVEN</h3>
                <a class="btn btn-primary" href="{{ route('books.create') }}">Create Book</a>
                <a class="btn btn-primary" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    Logout
                </a>

                <hr>
                <form action="{{ route('books.index') }}" method="GET">
                    <input type="text" name="search" value="{{$search ?? ''}}" placeholder="Search for books...">
                    <button type="submit">Search</button>
                </form>



                <br>
                <table class="table">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Title</th>
                        <th>Author</th>
                        <th>Description</th>
                        <th>Published Date</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($books as $book)
                        <tr>
                            <td>{{ $book->id }}</td>
                            <td>{{ $book->title }}</td>
                            <td>{{ $book->author }}</td>
                            <td>{{ $book->description }}</td>
                            <td>{{ $book->published_date }}</td>
                            <td>
                                <a class="btn btn-secondary" href="{{ route('books.edit', $book->id) }}" onclick="return confirm('Are you sure you want to edit this book?')">Edit</a>

                                <form action="{{ route('books.destroy', $book->id) }}" method="POST" style="display: inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this book?')">Delete</button>

                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

                <!-- Display pagination links -->
                {{ $books->render() }}

                <form id="logout-form" action="{{ route('logout') }}" method="GET" style="display: none;">
                    @csrf
                </form>
            </div>
        </div>
    </div>
@endsection
