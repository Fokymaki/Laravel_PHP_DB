<?php
namespace App\Http\Controllers;

use App\Models\KorolichUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;



class KorolichUserController extends Controller
{
    // Отображение списка пользователей
    public function index()
    {
        $users = KorolichUser::all();
        return view('korolich_users.index', compact('users'));
    }

    // Форма для добавления пользователя
    public function create()
    {
        return view('korolich_users.create');
    }
    public function edit($id)
    {
        $user = KorolichUser::find($id);
        return view('korolich_users.edit', compact('user'));
    }

    // Сохранение нового пользователя
    public function store(Request $request)
    {
        $photoPath = null;
        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('photos', 'public');
        }
        
        KorolichUser::create([
            'full_name' => $request->full_name,
            'birth_date' => $request->birth_date,
            'phone' => $request->phone,
            'email' => $request->email,
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'photo' => $photoPath,
        ]);

        session()->flash('message', 'Пользователь добавлен!');
        return redirect()->route('korolich_users.index')->with('success', 'Пользователь добавлен!');
    }

    // Удаление пользователя
        public function destroy($id)
        {
            $post = KorolichUser::find($id);
            $post->delete();
            return redirect()->route('korolich_users.index')
            ->with('success', 'Post deleted successfully');
        }

    // Обновление  данных пользователя
        
        public function update(Request $request,$id)
        {
            $user = KorolichUser::find($id);
            $user->update([
                'full_name' => $request->full_name,
                'birth_date' => $request->birth_date,
                'phone' => $request->phone,
                'email' => $request->email,
                'username' => $request->username,
            ]);

            session()->flash('message', 'Пользователь обновлен!');
            return redirect()->route('korolich_users.index');
        }

}
