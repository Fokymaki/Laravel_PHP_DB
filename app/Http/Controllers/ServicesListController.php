<?php

namespace App\Http\Controllers;

use App\Models\ServicesList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ServicesListController extends Controller
{
    // Отображение списка услуг
    public function index()
    {
        $services = ServicesList::all();
        return view('services_list.index', compact('services'));
    }

    // Форма для создания нового сервиса
    public function create()
    {
        $services = \App\Models\ServicesManager::all();
        return view('services_list.create',compact ('services'));
    }

    // Сохранение новой услуги
    public function store(Request $request)
    {
        //Log::info('Полученные данные:', $request->all());

        $request->validate([
            'service_id' => 'required|string|max:255',
            'hourly_payment' => 'nullable|numeric',
            'work_payment' => 'nullable|numeric',
        ]);

        // Обработка чекбоксов
        $is_by_agreement = $request->has('is_by_agreement');
        $is_hourly_type = $request->has('is_hourly_type');
        $is_work_type = $request->has('is_work_type');

        // Если выбран "по договоренности", обнуляем другие платежи
        $hourly_payment = $is_hourly_type ? $request->hourly_payment : null;
        $work_payment = $is_work_type ? $request->work_payment : null;
        if ($is_by_agreement) {
            $hourly_payment = null;
            $work_payment = null;
        }

        ServicesList::create([
            'service_id' => $request->service_id,
            'is_by_agreement' => $is_by_agreement,
            'is_hourly_type' => $is_hourly_type,
            'is_work_type' => $is_work_type,
            'hourly_payment' => $hourly_payment,
            'work_payment' => $work_payment,
            'is_active' => $request->has('is_active'),
        ]);

        session()->flash('success', 'Сервис успешно добавлен!');
        return redirect()->route('services_list.index');
    }

    // Форма для редактирования услуг
    public function edit($id)
    {
        $service = ServicesList::findOrFail($id);
        return view('services_list.edit', compact('service'));
    }

    // Обновление данных услуг
    public function update(Request $request, $id)
    {
        //Log::info('Обновление данных:', $request->all());

        $service = ServicesList::findOrFail($id);

        $request->validate([
            'service_id' => 'required|string|max:255',
            'hourly_payment' => 'nullable|numeric',
            'work_payment' => 'nullable|numeric',
        ]);

        $is_by_agreement = $request->has('is_by_agreement');
        $is_hourly_type = $request->has('is_hourly_type');
        $is_work_type = $request->has('is_work_type');

        $hourly_payment = $is_hourly_type ? $request->hourly_payment : null;
        $work_payment = $is_work_type ? $request->work_payment : null;
        if ($is_by_agreement) {
            $hourly_payment = null;
            $work_payment = null;
        }

        $service->update([
            'service_id' => $request->service_id,
            'is_by_agreement' => $is_by_agreement,
            'is_hourly_type' => $is_hourly_type,
            'is_work_type' => $is_work_type,
            'hourly_payment' => $hourly_payment,
            'work_payment' => $work_payment,
            'is_active' => $request->has('is_active'),
        ]);

        session()->flash('success', 'Услуга успешно обновлена!');
        return redirect()->route('services_list.index');
    }

    // Удаление услуг
    public function destroy($id)
    {
        $service = ServicesList::findOrFail($id);
        $service->delete();

        session()->flash('success', 'Услуга удалена!');
        return redirect()->route('services_list.index');
    }
}
