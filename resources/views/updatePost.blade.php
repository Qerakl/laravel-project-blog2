@extends('layouts.app')

@section('content')
    <div class="container py-5">
        <div class="card p-4 shadow-sm">
            <h2 class="text-center mb-4">Редактировать пост</h2>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            @foreach ($posts as $post)
            <form method="POST" action="{{ route('post.update', $post->id) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group mb-3">
                    <label for="postTitle" class="form-label">Заголовок</label>
                    <input type="text" name="title" class="form-control" id="postTitle" value="{{ $post->title }}" placeholder="Введите заголовок">
                </div>
                <div class="form-group mb-4">
                    <label for="postContent" class="form-label">Контент</label>
                    <textarea name="content" class="form-control" id="postContent" rows="6" placeholder="Введите текст поста">{{ $post->content }}</textarea>
                </div>
                <div class="form-group mb-4">
                    <label for="postImage" class="form-label">Изображение</label>
                    <input type="file" name="img" class="form-control" id="postImage">
                </div>
                <button type="submit" class="btn btn-primary w-100">Сохранить изменения</button>
            </form>
            @endforeach
        </div>
    </div>
@endsection
