@extends('layouts.app')

@section('content')
    <!-- Посты -->
    <div class="container py-5">
        @foreach($posts as $post)
        <div class="post mb-4" style="max-width: 650px; margin: 0 auto;">
            <div class="card post-card shadow-sm border-0">
                <div class="card-body p-3">
                    <!-- Верхняя часть поста с аватаркой и именем пользователя -->
                    @foreach($users as $user)
                    <div class="d-flex align-items-center mb-3">
                        <img src="{{ asset('storage/'. $user->avatar ) }}" class="rounded-circle me-3" alt="avatar" width="60" height="60">
                        <div>
                            <h6 class="mb-0 fw-bold">{{ $user->name }}</h6>
                            <small class="text-muted">{{ $post->created_at->diffForHumans() }}</small>
                        </div>
                    </div>
                    @endforeach

                    <!-- Изображение поста -->
                    @if($post->img)
                    <div class="post-image mb-3">
                        <img src="{{ asset('storage/'. $post->img) }}" class="img-fluid rounded" style="max-height: 400px; object-fit: cover; width: 100%;" alt="{{ $post->title }}">
                    </div>
                    @endif

                    <!-- Заголовок и текст поста -->
                    <h6 class="card-title mb-2">{{ $post->title }}</h6>
                    <p class="card-text">{{ Str::limit($post->content, 200, '...') }}</p>

                    <!-- Лайки и комментарии, социальные действия -->
                    <div class="d-flex justify-content-between align-items-center mt-3">
                        <div class="d-flex align-items-center">
                            <a href="{{ url('like', $post->id) }}" class="btn btn-sm btn-outline-secondary">
                                <i class="far fa-comment"></i> Лайки ({{ $post->likes_count }})
                            </a>
                            <a href="{{ url('post', $post->id) }}" class="btn btn-sm btn-outline-secondary">
                                <i class="far fa-comment"></i> Комментарии ({{ $post->comments_count }})
                            </a>
                        </div>

                        <!-- Действия для автора поста -->
                        @if (Auth::check() && Auth::user()->id == $post->user_id)
                        <div class="d-flex align-items-center">
                            <a href="{{ url('post/edit', $post->id) }}" class="btn btn-sm btn-outline-secondary me-2">Изменить</a>
                            <form action="{{ route('post.destroy', $post->id) }}" method="POST" onsubmit="return confirm('Вы уверены, что хотите удалить этот пост?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger">Удалить</button>
                            </form>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
@endsection
