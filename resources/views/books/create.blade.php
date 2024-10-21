@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        Create Book
                    </div>

                    <div class="card-body">
                        <form action="{{ route('books.store') }}" method="POST">
                            @csrf
                            <div class="form-group mb-3">
                                <label for="title" class="form-label">Book Title</label>
                                <input type="text" name="title" class="form-control" required>
                            </div>

                            <div class="form-group mb-3">
                                <label for="author_id" class="form-label">Author</label>
                                <select name="author_id" class="form-control">
                                    <option disabled selected>Choose an Author</option>
                                    @foreach ($authors as $author)
                                        <option value="{{ $author->id }}">{{ $author->name }}</option>
                                    @endforeach
                                </select>
                            </div>


                            <button type="submit" class="btn btn-success">Create Book</button>
                            <a href="{{ route('authors.index') }}" class="btn btn-secondary">Cancel</a>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
