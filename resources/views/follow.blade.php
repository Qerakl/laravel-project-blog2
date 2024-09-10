@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h2>Поиск пользователей</h2>

    <form action="{{ url('follow') }}" method="GET">
        <div class="input-group mb-3">
            <input type="text" class="form-control" name="query" placeholder="Введите имя или email для поиска">
            <button class="btn btn-primary" type="submit">Найти</button>
        </div>
    </form>

    @if(isset($users))
        <div class="row">
            @foreach($users as $user)
                <div class="col-md-4">
                    <div class="card mb-4">
                        <div class="card-body text-center">
                            <img src="{{ asset('storage/' . $user->avatar) }}" alt="avatar" class="rounded-circle mb-3" width="100" height="100">
                            <h5>{{ $user->name }}</h5>
                            <p>{{ $user->email }}</p>


                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
