<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Редактировать пользователя</title>
</head>
<body>
    <h1>Редактировать пользователя</h1>

    <!-- Выводим сообщения об ошибках и успехе -->
    @if(session('message'))
        <div style="color: green;">{{ session('message') }}</div>
    @endif
    <form action="{{ route('korolich_users.update', $user->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        
        <label for="full_name">ФИО:</label>
        <input type="text" id="full_name" name="full_name" value="{{ old('full_name', $user->full_name) }}" required>
        <br>

        <label for="birth_date">Дата рождения:</label>
        <input type="date" id="birth_date" name="birth_date" value="{{ old('birth_date', $user->birth_date) }}" required>
        <br>

        <label for="phone">Телефон:</label>
        <input type="text" id="phone" name="phone" value="{{ old('phone', $user->phone) }}" required>
        <br>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" required>
        <br>

        <label for="username">Логин:</label>
        <input type="text" id="username" name="username" value="{{ old('username', $user->username) }}" required>
        <br>

        <label>Фото:</label>
        <input type="file" id="photo"  name="photo"  value="{{ old('photo', 'storage/'.$user->photo) }}">
        <br>

        @if($user->photo)
            <p>Текущее фото:</p>
            <img src="{{ asset('storage/'.$user->photo) }}" width="100">
        @else
            <p>Нет фото</p>
        @endif
        <br>


        <button type="submit">Сохранить изменения</button>
    </form>

    <br>
    <a href="{{ route('korolich_users.index') }}">Назад к списку пользователей</a>
</body>
</html>
