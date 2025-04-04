<?php

namespace App\Http\Controllers;

use App\Models\ServicesManager;
use Illuminate\Http\Request;

class ServicesManagerController extends Controller
{
    public function index()
    {
        $services = ServicesManager::all();
        return view('service_manager.index', compact('services'));
    }

    public function create()
    {
        return view('service_manager.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'service_name' => 'required|string|max:255',
            'activity' => 'required|boolean',
        ]);

        ServicesManager::create([
            'service_name' => $request->service_name,
            'activity' => $request->activity,
        ]);

        return redirect()->route('service_manager.index')->with('success', 'Услуга добавлена!');
    }

    public function destroy($id)
    {
        $service = ServicesManager::findOrFail($id);
        $service->delete();
        
        return redirect()->route('service_manager.index')->with('success', 'Услуга удалена!');
    }
}
