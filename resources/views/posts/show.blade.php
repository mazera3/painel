<div>
    @extends('layouts.app')

    @section('content')
        <h1>{{ $post->title }}</h1>
        <p>Publicado em {{ $post->created_at->format('d/m/Y') }}</p>
        <div>
            {!! $post->content !!}
        </div>
        <a href="{{ route('posts.index') }}">Voltar para a lista</a>
    @endsection

</div>
