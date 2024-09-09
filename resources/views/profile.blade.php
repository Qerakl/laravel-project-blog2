@extends('layouts.app')

@section('content')
    <div class="container py-5">
        <div class="row">
            <!-- Информация о пользователе -->
            <div class="col-md-4">
                <div class="card p-4 shadow-sm">
                    <h2 class="text-center mb-4">Профиль пользователя</h2>

                    @foreach ($users as $user)
                    <div class="text-center mb-4">
                        <img src="{{ asset('storage/' . $user->avatar) }}" alt="Profile Image" class="img-fluid rounded-circle" style="width: 150px; height: 150px; object-fit: cover;">
                    </div>

                    <div class="mb-3">
                        <h5 class="text-center">{{ $user->name }}</h5>
                        <p class="text-center text-muted">{{ $user->email }}</p>
                    </div>

                    <!-- Дополнительная информация -->
                    <div class="mb-3">
                        <h6>О пользователе</h6>
                        <p>{{ $user->bio ?? 'Информация не предоставлена' }}</p>
                    </div>
                    @endforeach
                </div>
            </div>

            <!-- Посты пользователя -->
            <div class="col-md-8">
                <div class="card p-4 shadow-sm">
                    <h2 class="text-center mb-4">Посты пользователя</h2>

                    @foreach ($posts as $post)
                    <div class="post mb-4">
                        <div class="card post-card shadow-sm border-0">
                            <div class="card-body p-3">
                                <!-- Изображение поста -->
                                @if($post->img)
                                <div class="post-image mb-3">
                                    <img src="{{ asset('storage/' . $post->img) }}" class="img-fluid rounded" style="max-height: 400px; object-fit: cover; width: 100%;" alt="{{ $post->title }}">
                                </div>
                                @endif

                                <!-- Заголовок и текст поста -->
                                <h6 class="card-title mb-2">{{ $post->title }}</h6>
                                <p class="card-text">{{ Str::limit($post->content, 200, '...') }}</p>

                                <!-- Лайки и комментарии -->
                                <div class="d-flex justify-content-between align-items-center mt-3">
                                    <div class="d-flex align-items-center">
                                        <button class="btn btn-sm btn-outline-primary me-2">
                                            <i class="far fa-heart"></i> Лайк ({{ $post->likes_count }})
                                        </button>
                                        <a href="{{ url('post', $post->id) }}" class="btn btn-sm btn-outline-secondary">
                                            <i class="far fa-comment"></i> Комментарии ({{ $post->comments_count }})
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
