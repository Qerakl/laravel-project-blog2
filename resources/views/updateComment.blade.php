@extends('layouts.app')

@section('content')
    <div class="container py-5">
        <div class="card p-4 shadow-sm">
            <h2 class="text-center mb-4">Редактировать комментарий</h2>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            @foreach ($comments as $comment)
            <form method="POST" action="{{ url('comment/update', $comment->id) }}">
                @csrf
                @method('PUT')
                <div class="form-group mb-4">
                    <label for="commentContent" class="form-label">Комментарий</label>
                    <textarea name="content" class="form-control" id="commentContent" rows="4" placeholder="Введите комментарий">{{ $comment->content }}</textarea>
                </div>
                <button type="submit" class="btn btn-primary w-100">Сохранить изменения</button>
            </form>
            @endforeach
        </div>
    </div>
@endsection
