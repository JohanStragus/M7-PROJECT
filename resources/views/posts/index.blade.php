@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="my-4">Blog_M7</h1>

    <!-- Botón para crear un nuevo post -->
    <a href="{{ route('posts.create') }}" class="btn btn-success mb-3">Create</a>

    <!-- Lista de posts -->
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Posts</h5>
            <ul class="list-group list-group-flush">
                @foreach($posts as $post)
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <!-- Título del post como enlace a la vista de detalles -->
                        <a href="{{ route('posts.show', $post->id) }}" class="text-decoration-none">
                            {{ $post->title }}
                        </a>

                        <!-- Botones Edit y Delete -->
                        <div>
                            <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-sm btn-success">Edit</a>
                            <form action="{{ route('posts.destroy', $post->id) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                            </form>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</div>
@endsection
