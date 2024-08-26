@extends('layouts.app')

@section('content')
    <div class="container py-5">
        <div class="row">
            <!-- Обновление профиля -->
            @if ($errors->any())
                        <div class="alert alert-danger mb-4">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
            <div class="col-md-4">
                <div class="card p-4 shadow-sm">
                    <h2 class="text-center mb-4">Профиль</h2>

                    

                    <div class="text-center mb-4">
                        <img alt="Profile Image" class="img-fluid rounded-circle" style="width: 150px; height: 150px; object-fit: cover;">
                    </div>
                    @foreach ($users as $user)
                        
                    @endforeach
                    <form method="POST" action="profile/update" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group mb-3">
                            <label for="profileName" class="form-label">Имя</label>
                            <input type="text" name="name" class="form-control" id="profileName" value="{{ $user->name }}" placeholder="Введите ваше имя">
                        </div>
                        <div class="form-group mb-3">
                            <label for="profileEmail" class="form-label">Email адрес</label>
                            <input type="email" name="email" class="form-control" id="profileEmail" value="{{ $user->email }}" placeholder="Введите ваш email">
                        </div>
                        <div class="form-group mb-4">
                            <label for="profileImage" class="form-label">Изображение профиля</label>
                            <input type="file" name="profile_image" class="form-control" id="profileImage">
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Сохранить изменения</button>
                    </form>
                </div>
            </div>

            <!-- Изменение пароля -->
            <div class="col-md-8">
                <div class="card p-4 shadow-sm">
                    <h2 class="text-center mb-4">Изменить пароль</h2>
                    
                    <form method="POST" action="profile/password-update">
                        @csrf
                        <div class="form-group mb-3">
                            <label for="currentPassword" class="form-label">Текущий пароль</label>
                            <input type="password" name="current_password" class="form-control" id="currentPassword" placeholder="Введите текущий пароль">
                        </div>
                        <div class="form-group mb-3">
                            <label for="newPassword" class="form-label">Новый пароль</label>
                            <input type="password" name="new_password" class="form-control" id="newPassword" placeholder="Введите новый пароль">
                        </div>
                        <div class="form-group mb-4">
                            <label for="confirmPassword" class="form-label">Подтвердите новый пароль</label>
                            <input type="password" name="new_password_confirmation" class="form-control" id="confirmPassword" placeholder="Подтвердите новый пароль">
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Обновить пароль</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
