<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Список пользователей</title>
</head>
<body>
    <h1>Список пользователей</h1>
    <a href="{{ route('korolich_users.create') }}"> Добавить пользователя</a>
    <table border="1" cellpadding="10" cellspacing="0">
        <thead>
            <tr>
                <th>ID</th>
                <th>ФИО</th>
                <th>Дата рождения</th>
                <th>Телефон</th>
                <th>Email</th>
                <th>Логин</th>
                <th>Фото</th>
                <th>Действия</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->full_name }}</td>
                <td>{{ $user->birth_date }}</td>
                <td>{{ $user->phone }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->username }}</td>
                <td>
                    @if($user->photo)
                        <img src="{{ asset( "storage/".$user->photo) }}" width="100" height="100" alt="Фото">
                    @else
                        Нет фото
                    @endif
                </td>
                <td>
                    <!-- Кнопка для редактирования -->
                    <a href="{{ route('korolich_users.edit', $user->id) }}" class="btn btn-primary">Изменить</a>
                    <!-- Форма для удаления пользователя -->
                    <form action="{{ route('korolich_users.destroy', $user->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('Вы уверены, что хотите удалить этого пользователя?')" class="btn btn-danger">Удалить</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
