<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Добавить</title>

</head>
<body>
    <h1>Добавить</h1>

    <form action="{{ route('service_manager.store') }}" method="POST">
        @csrf
        <label for="service_name">Название услуги:</label>
        <input type="text" id="service_name" name="service_name" required>
        <br>

        <label for="activity">Активность:</label>
        <select id="activity" name="activity">
            <option value="1">Активен</option>
            <option value="0">Неактивен</option>
        </select>
        <br>

        <button type="submit">Добавить</button>
    </form>

    <br>
    <a href="{{ route('service_manager.index') }}">Назад к списку услуг</a>
</body>
</html>
