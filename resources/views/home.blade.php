@extends('layouts.app')

@section('content')
    <!-- Статьи -->
    <div class="container py-5">
        <div class="row">
            @foreach($posts as $post)
            <div class="col-md-4 d-flex align-items-stretch">
                <div class="card mb-4 shadow-sm h-100">
                    <img src="{{ asset('storage/'. $post->img) }}" class="card-img-top" alt="{{ $post->title }}">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">{{ $post->title }}</h5>
                        <div class="mt-auto">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <small class="text-muted">{{ $post->created_at->format('d M Y') }}</small>
                                <a href="{{ url('post', $post->id) }}" class="btn btn-primary btn-sm">Читать далее</a>
                            </div>
                            
                            @if (Auth::check() && Auth::user()->id == $post->user_id)
                            <div class="d-flex justify-content-end">
                                <a href="{{ url('post/edit', $post->id) }}" class="btn btn-outline-secondary btn-sm me-2">Изменить</a>
                                <form action="{{ route('post.destroy', $post->id) }}" method="POST" onsubmit="return confirm('Вы уверены, что хотите удалить этот пост?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-outline-danger btn-sm">Удалить</button>
                                </form>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

    </div>
@endsection
