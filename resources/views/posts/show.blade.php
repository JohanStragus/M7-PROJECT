@extends('layouts.app')

@section('content')
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $post->title }}</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100 text-gray-900">
    <!-- Container principal centrado -->
    <div class="max-w-4xl mx-auto py-8">

        <!-- Título del post -->
        <h1 class="text-4xl font-bold mb-4 text-center text-indigo-600">{{ $post->title }}</h1>

        <!-- Información adicional del post -->
        <div class="flex justify-between items-center mb-4">
            <span class="text-sm text-gray-500">Author: <b>{{ $post->user->name }}</b></span>
            <span class="text-sm text-gray-500">Created at: {{ $post->created_at->format('Y-m-d') }}</span>
        </div>

        <!-- Contenido del post -->
        <div class="bg-white p-6 rounded-lg shadow-md">
            <p class="text-lg text-gray-700 mb-6">{{ $post->content }}</p>
        </div>

        <!-- Comentarios -->
        <div class="mt-8">
            <h2 class="text-2xl font-semibold mb-4 text-indigo-500">Comments</h2>

            <!-- Mostrar formulario de comentario si el usuario está autenticado -->
            @auth
                <form action="{{ route('comments.store') }}" method="POST" class="mb-4">
                    @csrf
                    <input type="hidden" name="post_id" value="{{ $post->id }}">
                    <textarea name="content" class="w-full p-2 border rounded-md" placeholder="Add a comment..." required></textarea>
                    <button type="submit" class="mt-2 bg-indigo-500 text-white font-semibold px-4 py-2 rounded">Submit</button>
                </form>
            @else
                <!-- Mostrar mensaje de inicio de sesión si el usuario no está autenticado -->
                <p class="text-red-500 mb-4">You need to be logged in to comment.</p>
                <a href="{{ route('login') }}" class="text-indigo-500">Login</a> or 
                <a href="{{ route('register') }}" class="text-indigo-500">create an account</a> to leave a comment.
            @endauth

            <!-- Lista de comentarios -->
            <table class="min-w-full bg-white rounded-lg shadow-md mt-4">
                <tbody>
                    @foreach ($post->comments as $comment)
                    <tr class="border-t">
                        <td class="px-4 py-2 text-gray-700">{{ $comment->content }}</td>
                        <td class="px-4 py-2 font-bold text-gray-900">{{ $comment->user->name }}</td>
                        <!-- Verificar si el usuario es admin para mostrar el botón de eliminar -->
                        @if(Auth::check() && Auth::user()->isAdmin())
                        <td class="px-4 py-2">
                            <form action="{{ route('comments.destroy', $comment) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500">Delete</button>
                            </form>
                        </td>
                        @endif
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>
@endsection
