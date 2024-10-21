@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h2 class="mb-0">Authors</h2>
                        {{-- <a class="btn btn-success" href="{{ route('authors.create') }}">Create Author</a>
                        <a class="btn btn-warning" href="{{ route('books.create') }}">Create Book</a> --}}
                    </div>

                    <div class="card-body">
                        @if ($message = Session::get('success'))
                            <div class="alert alert-success">
                                <p>{{ $message }}</p>
                            </div>
                        @endif

                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Books</th>
                                    <th class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($authors as $author)
                                    <tr>
                                        <td>{{ $author->id }}</td>
                                        <td>{{ $author->name }}</td>
                                        <td>
                                            <ul class="list-unstyled">
                                                @foreach ($author->books as $book)
                                                    <li>{{ $book->title }}</li>
                                                @endforeach
                                            </ul>
                                        </td>
                                        <td class="text-center">
                                            <a class="btn btn-primary btn-sm"
                                                href="{{ route('authors.edit', $author->id) }}">Edit</a>

                                            <form action="{{ route('authors.destroy', $author->id) }}" method="POST"
                                                style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm"
                                                    onclick="return confirm('Are you sure you want to delete this author?')">
                                                    Delete
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        @if ($authors->isEmpty())
                            <div class="alert alert-info text-center">No authors available.</div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
