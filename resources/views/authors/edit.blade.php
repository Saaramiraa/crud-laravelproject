@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Edit Author</div>

                    <div class="card-body">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        @if (!$author)
                            <div class="alert alert-danger">Author not found.</div>
                        @else
                            <form action="{{ route('authors.update', $author->id) }}" method="POST">
                                @csrf
                                @method('PUT')

                                <!-- Author Name -->
                                <div class="mb-3">
                                    <label for="name" class="form-label">Name</label>
                                    <input type="text" class="form-control" id="name" name="name"
                                        value="{{ old('name', $author->name) }}" required>
                                </div>

                                <!-- Books -->
                                <div class="mb-3">
                                    <label for="books" class="form-label">Books</label>
                                    <div id="books">
                                        @foreach ($author->books as $index => $book)
                                            <div class="input-group mb-2">
                                                <input type="text" class="form-control"
                                                    name="books[{{ $index }}][title]"
                                                    value="{{ old('books.' . $index . '.title', $book->title) }}" required>
                                                <input type="hidden" name="books[{{ $index }}][id]"
                                                    value="{{ $book->id }}">
                                                <button type="button" class="btn btn-danger btn-sm"
                                                    onclick="deleteBook({{ $book->id }})">Delete</button>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-primary">Update Author</button>
                                <a href="{{ route('authors.index') }}" class="btn btn-secondary">Cancel</a>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function deleteBook(bookId) {
            if (confirm('Are you sure you want to delete this book?')) {
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = '{{ url('books') }}/' + bookId;
                const token = document.createElement('input');
                token.type = 'hidden';
                token.name = '_token';
                token.value = '{{ csrf_token() }}';
                form.appendChild(token);
                const method = document.createElement('input');
                method.type = 'hidden';
                method.name = '_method';
                method.value = 'DELETE';
                form.appendChild(method);
                document.body.appendChild(form);
                form.submit();
            }
        }
    </script>
@endsection
