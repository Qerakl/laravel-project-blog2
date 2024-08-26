@extends('layouts.app')

@section('content')
    <div class="container d-flex justify-content-center align-items-center mt-5">
        <div class="card p-4 shadow-sm" style="max-width: 400px; width: 100%;">
            <h2 class="text-center mb-4">Регистрация</h2>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ url('add/user') }}">
                @csrf
                <div class="form-group mb-3">
                    <label for="registerUsername" class="form-label">Имя</label>
                    <input type="text" name="name" class="form-control" id="registerUsername" placeholder="Введите имя">
                </div>
                <div class="form-group mb-3">
                    <label for="registerEmail" class="form-label">Email адрес</label>
                    <input type="email" name="email" class="form-control" id="registerEmail" placeholder="Введите email">
                </div>
                <div class="form-group mb-4">
                    <label for="registerPassword" class="form-label">Пароль</label>
                    <input type="password" name="password" class="form-control" id="registerPassword" placeholder="Введите пароль">
                </div>
                <button type="submit" class="btn btn-primary w-100">Зарегистрироваться</button>
            </form>
        </div>
    </div>
@endsection
