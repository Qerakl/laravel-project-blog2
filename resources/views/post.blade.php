@extends('layouts.app')

@section('content')
    <!-- Контент статьи -->
    @foreach ($posts as $post)
        <div class="container mt-5">
            <div class="bg-white p-5 shadow-sm rounded">
                <h1 class="mb-3">{{ $post->title }}</h1>
                <p class="text-muted">Дата публикации: {{ $post->created_at->format('d M Y') }}</p>
                <img src="{{ asset('storage/'. $post->img) }}" class="img-fluid mb-4 rounded" alt="{{ $post->title }}">
                <p class="lead">{{ $post->content }}</p>
            </div>
        </div>
    @endforeach

    <!-- Раздел комментариев -->
    <div class="comments-section container mt-5">
        <h3 class="mb-4">Комментарии</h3>
        <form action="{{ url('comment', $post->id) }}" method="POST">
            @csrf
            <div class="form-group mb-3">
                <label for="comment" class="form-label">Ваш комментарий:</label>
                <textarea class="form-control" name="content" id="comment" rows="3" placeholder="Напишите свой комментарий здесь..."></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Отправить</button>
        </form>

        <div class="comment mt-5">
            @foreach ($comments as $comment)
                @if(!empty($users))
                @foreach($users as $user)
                <div class="card mb-3">
                    <div class="card-body">
                        <h5 class="card-title">{{ $user->name }}</h5>
                        <p class="card-text">{{ $comment->content }}</p>
                        @if(session('user.id') == $comment->user_id)
                        <div class="d-flex justify-content-end">
                            <a href="{{ url('comment/edit', $comment->id) }}" class="btn btn-sm btn-outline-primary me-2">Изменить</a>
                            <form action="{{ url('comment/delete', $comment->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger">Удалить</button>
                            </form>
                        </div>
                        @endif
                    </div>
                </div>
                @endforeach
                @endif
            @endforeach
        </div>
    </div>
@endsection
