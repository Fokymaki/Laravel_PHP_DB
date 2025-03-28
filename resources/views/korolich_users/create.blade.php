<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Добавить пользователя</title>
</head>
<body>
    <h1>Добавить пользователя</h1>
    <<form action="{{ route('korolich_users.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <label>ФИО:</label>
          <input type="text" name="full_name" required><br>
    
        <label>Дата рождения:</label>
          <input type="date" name="birth_date" required><br>
    
        <label>Телефон:</label>
          <input type="text" name="phone" required><br>
    
        <label>Email:</label>
          <input type="email" name="email" required><br>
    
        <label>Логин:</label>
          <input type="text" name="username" required><br>
    
        <label>Пароль:</label>
          <input type="password" name="password" required><br>
    
        <label>Фото:</label>
          <input type="file" name="photo"><br>
    
        <button type="submit">Добавить</button>
    </form>
  
</body>
</html>
