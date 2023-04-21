
@extends('app')

@section('content')


    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ $book->title }}</div>

                    <div class="card-body">
                        <p><strong>Author:</strong> {{ $book->author }}</p>
                        <p><strong>Description:</strong> {{ $book->description }}</p>
                        <p><strong>Published Date:</strong> {{ $book->published_date }}</p>

                    </div>
                </div>
            </div>
        </div>
    </div>



    @endsection

