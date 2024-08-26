@extends('layouts.app')

@section('content')

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="container d-flex justify-content-center align-items-center mt-5">
        <div class="card p-4 shadow-sm" style="max-width: 400px; width: 100%;">
            <h2 class="text-center mb-4">Вход</h2>
            <div class="tab-content">
                <div class="tab-pane fade show active" id="login" role="tabpanel" aria-labelledby="login-tab">
                    <form action="{{ url('login/user') }}" method="POST">
                        @csrf
                        <div class="form-group mb-3">
                            <label for="loginEmail" class="form-label">Email адрес</label>
                            <input type="email" name="email" class="form-control" id="loginEmail" placeholder="Введите email">
                        </div>
                        <div class="form-group mb-4">
                            <label for="loginPassword" class="form-label">Пароль</label>
                            <input type="password" name="password" class="form-control" id="loginPassword" placeholder="Введите пароль">
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Войти</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
