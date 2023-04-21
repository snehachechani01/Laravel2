@extends('app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Books</h1>
                <a class="btn btn-primary" href="{{ route('books.create') }}">Create Book</a>
                <hr>
                <form action="{{ route('books.search') }}" method="GET">
                    <input type="text" name="query" placeholder="Search for books...">
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
                                <a class="btn btn-secondary" href="{{ route('books.edit', $book->id) }}">Edit</a>
                                <form action="{{ route('books.destroy', $book->id) }}" method="POST" style="display: inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

                <!-- Display pagination links -->
                {{ $books->render() }}
            </div>
        </div>
    </div>
@endsection
