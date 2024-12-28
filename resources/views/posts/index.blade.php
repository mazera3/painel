@extends('layouts.app')

@section('content')
    <h1>Posts</h1>
    <ul>
        @foreach ($posts as $post)
            <li>
                <a href="{{ route('posts.show', $post->slug) }}">
                    {{ $post->title }}
                </a>
                <p>{{ $post->excerpt }}</p>
            </li>
        @endforeach
    </ul>

    {{ $posts->links() }} <!-- Links de paginação -->
@endsection
