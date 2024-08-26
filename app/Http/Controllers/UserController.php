<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public $user;
    public function __construct(){
        $this->user = new User();
    }

    public function logup(Request $request){
        $credentials = $request->validate([
            'name' => ['required'],
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            return back()->withErrors([
                'email' => 'Данная почта уже занята',
            ])->onlyInput('email');
        }
        if(!empty($user = User::where('name', $request->name)->first())){
           return back()->withErrors([
                'email' => 'Данная почта уже занята',
            ])->onlyInput('email');
        }
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        Auth::login($user);
            $users = $this->user->select_user($request->email);
            foreach($users as $user){
                session(['user.name' => $user->name]);
                session(['user.id' => $user->id]);
                session(['user.email' => $user->email]);
            }
        return redirect('/');
    }
    public function login(Request $request){
            $credentials = $request->validate([
                'email' => ['required', 'unique:users'],
                'password' => ['required', 'min:4']
            ]);

        if (Auth::attempt($credentials)) {
            $users = $this->user->select_user($request->email);
            foreach($users as $user){
                Auth::loginUsingId($user->id);
                session(['user.name' => $user->name]);
                session(['user.id' => $user->id]);
                session(['user.email' => $user->email]);
            }
            return redirect('/');
        }
        
        return back()->withErrors([
            'email' => 'Неверный логин или пароль',
        ])->onlyInput('email');
    }
    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
    public function profile(){
        $user = $this->user->select_user(session('user.email'));
        return view('profile', ['users' => $user]);
    }
    public function update(Request $request){
        $credentials = $request->validate([
            'name' => ['required'],
            'email' => ['required', 'email'],
        ]);
        $id = session('user.id');
        if(empty($request->img)){
            User::where('id', $id)->update([
                'name' => $request->name,
                'email' => $request->email,
            ]);
            $users = $this->user->select_user($request->email);
            foreach($users as $user){
                session(['user.name' => $user->name]);
                session(['user.email' => $user->email]);
            }
            return redirect('/');
        }
        /*$posts = User::where('id', $id)->get();
        foreach($posts as $post){
            Storage::delete('public/'.$post->img);
        }
        $img = $request->file('img')->store('public');
        $img = $request->img->hashName();
        User::where('id', $id)->update([
            'title' => $title,
            'content' => $content,
            'img' => $img
        ]);
        return redirect('/');*/
    }
    public function password_update(Request $request){
        $credentials = $request->validate([
            'current_password' => ['required'],
            'new_password' => ['required'],
            'new_password_confirmation' => ['required'],
        ]);
        if(Auth::attempt(['email' => session('user.email'), 'password' => $request->current_password])){
                if($request->new_password === $request->new_password_confirmation){
                    User::where('id', session('user.id'))->update([
                        'password' => Hash::make( $request->new_password)
                    ]);
                    return redirect('/');}
                else{
                    return back()->withErrors([
                        'new_password' => 'Пароли не совподают',
                    ])->onlyInput('new_password');
                }
        }
        else{
            return back()->withErrors([
                'current_password' => 'старый пароль не совподает',
            ])->onlyInput('current_password');
        }
    }

}
