<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Http\Requests\AdminRequest;
use App\Http\Requests\LoginRequest;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use function Psy\debug;

class UsersController extends Controller
{
    /**
     * Реєстрація нового користувача.
     */
    public function add(ContactRequest $request)
    {
        $users = new User();
        $users->name       = $request->input('name');
        $users->email      = $request->input('email');
        $users->password   = Hash::make($request->input('password'));
        $users->save();
        return redirect()->route('authorization')->with('success', 'Дякуємо за реєстрацію');
    }
    /**
     * Авторизація користувача.
     */
    public function login(LoginRequest $request)
    {
        $user = User::where('email', $request->get('email'))->first();
        if($user){
            $credentials = $request->only('email', 'password');
            Auth::attempt($credentials);
        }
        if(Auth::check()){
            return redirect()->route('admin')->with('success', 'Вітаю в адмін вікні');
        }
    }
    /**
     * Вихід з адмін меню.
     */
    public function logout(){
        Auth::logout();
        return redirect()->route('home')->with('success', 'Ви вийшли з адмін вікна');
    }
}
