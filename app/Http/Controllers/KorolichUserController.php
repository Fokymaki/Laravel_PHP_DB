<?php
namespace App\Http\Controllers;

use App\Models\KorolichUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;


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
            $photo = $request->file('photo');
           
            $photoPath= $photo->store('profile_photo', 'public');
    
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
            if($post->photo){
                Storage::disk('public') -> delete($post->photo);
            }
            $post->delete();
            return redirect()->route('korolich_users.index')
            ->with('success', 'Post deleted successfully');
        }

    // Обновление  данных пользователя
        
        public function update(Request $request,$id)
        {
            
            $user = KorolichUser::find($id);
            $photoPath = $user->photo;
            Log::info($user);

            if ($request->hasFile('photo')) {
                if($user->photo)
                {
                    Storage::disk('public') -> delete($user->photo);
                }
                $photo = $request->file('photo');
                $photoPath= $photo->store('profile_photo', 'public');
                Log::info("Path Photo". $photoPath);
            }
            
           
           
            $user->update([
                'full_name' => $request->full_name,
                'birth_date' => $request->birth_date,
                'phone' => $request->phone,
                'email' => $request->email,
                'username' => $request->username,
                'photo' => $photoPath,
            ]);

            session()->flash('message', 'Пользователь обновлен!');
            return redirect()->route('korolich_users.index');
        }

}
