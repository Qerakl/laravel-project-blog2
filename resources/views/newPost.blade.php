@extends('layouts.app')

@section('content')
    <!-- Контент статьи -->
    <h2 class="text-center mb-4">Написать пост</h2>
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
    <div class="container mt-5">
        <form action="{{ route('post.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="text" class="form-control" name="title" id="floatingInput" placeholder="Название поста" required>
            <label for="floatingInput">Введите название поста</label>
            <input type="file" name="img">
            <textarea class="form-control" id="comment" rows="3" name="content" required>текст поста</textarea>
            <button type="submit" class="btn btn-primary">Отправить</button>
        </form>
    </div>
@endsection
