<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Список услуг</title>
</head>
<body>
    <h1>Список услуг</h1>

    @if(session('success'))
        <div style="color: green;">{{ session('success') }}</div>
    @endif

    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Название услуги</th>
                <th>Тип оплаты</th>
                <th>Сумма</th>
                <th>Активность</th>
                <th>Действия</th>
            </tr>
        </thead>
        <tbody>
            @foreach($services as $service)
                <tr>
                    <td>{{ $service->id }}</td>
                    <td>{{ $service->service_id }}</td>
                    <td>
                        @if($service->is_by_agreement)
                            По договоренности
                        @elseif($service->is_hourly_type)
                            Почасовая
                        @elseif($service->is_work_type)
                            За работу
                        @endif
                    </td>
                    <td>
                        @if($service->is_hourly_type)
                            {{ $service->hourly_payment }} руб/час
                        @elseif($service->is_work_type)
                            {{ $service->work_payment }} руб
                        @endif
                    </td>
                    <td>
                        {{ $service->is_active ? 'Да' : 'Нет' }}
                    </td>
                    <td>
                        <form action="{{ route('services_list.destroy', $service->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Удалить?')">Удалить</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <br>
    <a href="{{ route('services_list.create') }}">Добавить сервис</a>
</body>
</html>
