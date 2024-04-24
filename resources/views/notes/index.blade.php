@extends('layout.app')

@section('content')
    <div class="my-4">
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <p class="text-center m-0">{{ session('success') }}</p>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @elseif (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <p class="text-center m-0">{{ session('error') }}</p>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
    </div>

    <div class="container mt-4">
        @if ($notes->isEmpty())
            <div class="alert alert-info" role="alert">
                You have no notes yet.
            </div>
        @endif

        <div class="row">
            @foreach ($notes as $note)
                <div class="col-md-4">
                    <div class="card mb-3">
                        <div class="card-body">
                            <h5 class="card-title">{{ $note->title }}</h5>
                            <p class="card-text">{{ $note->content }}</p>
                            <div class="d-flex gap-3 align-items-center">
                                <a href="{{ route('notes.show', $note) }}" class="btn btn-outline-primary"
                                    title="View Note">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('notes.edit', $note) }}" class="btn btn-outline-secondary"
                                    title="Edit Note">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('notes.destroy', $note) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-outline-danger" title="Delete Note"
                                        onclick="return confirm('Are you sure you want to delete this note?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <a href="{{ route('notes.create') }}" class="btn btn-primary my-2">Create Note</a>

        {{-- Pagination --}}
        <div>
            {{ $notes->links() }}
        </div>
    </div>
@endsection