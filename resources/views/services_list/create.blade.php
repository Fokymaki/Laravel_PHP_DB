<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Добавить услугу</title>
</head>
<body>
    <h1>Добавить услугу</h1>

    <form action="{{ route('services_list.store') }}" method="POST">
        @csrf

        <label for="service_id">Услуга:</label>
        <select id ="service_id" name = service_id required>
            <option value="" disabled selected>Выберете услугу</option>
            @foreach ($services as $service)
            <option value="{{ $service->id }}">{{$service->service_name }} </option>
                
            @endforeach

        </select>
        <br>

        <label>
            <input type="checkbox" id="is_by_agreement" name="is_by_agreement">
            Оплата по договоренности
        </label>
        <br>

        <label>
            <input type="checkbox" id="is_hourly_type" name="is_hourly_type">
            Почасовая оплата
        </label>
        <input type="number" id="hourly_payment" name="hourly_payment" placeholder="Введите сумму за час">
        <br>

        <label>
            <input type="checkbox" id="is_work_type" name="is_work_type">
            Оплата за работу
        </label>
        <input type="number" id="work_payment" name="work_payment" placeholder="Введите сумму за работу">
        <br>

        <label>
            <input type="checkbox" name="is_active">
            Активен
        </label>
        <br>

        <button type="submit">Добавить</button>
    </form>

    <br>
    <a href="{{ route('services_list.index') }}">Назад</a>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let agreementCheckbox = document.getElementById('is_by_agreement');
            let hourlyCheckbox = document.getElementById('is_hourly_type');
            let workCheckbox = document.getElementById('is_work_type');

            let hourlyPayment = document.getElementById('hourly_payment');
            let workPayment = document.getElementById('work_payment');

            function toggleFields() {
                if (agreementCheckbox.checked) {
                    hourlyCheckbox.checked = false;
                    workCheckbox.checked = false;
                    hourlyPayment.disabled = true;
                    workPayment.disabled = true;
                } else {
                    hourlyPayment.disabled = !hourlyCheckbox.checked;
                    workPayment.disabled = !workCheckbox.checked;
                }
            }

            agreementCheckbox.addEventListener('change', toggleFields);
            hourlyCheckbox.addEventListener('change', toggleFields);
            workCheckbox.addEventListener('change', toggleFields);
        });
    </script>
</body>
</html>
