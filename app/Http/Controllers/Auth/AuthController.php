<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\LoginRequest;
use App\Models\Parcel;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function index()
    {
        return view('login');
    }

    public function login(LoginRequest $request)
    {
        $loginCredentials = $request->safe()->only(['email', 'password']);

        if (auth()->attempt($loginCredentials)) {
            $request->session()->regenerate();
            $user = auth()->user();
            $routeName = ($user->user_type == 1) ? 'client.home' : 'biker.home';
            return redirect()->route($routeName);
        } else {
            return redirect()->back()->with(['alert-message' => 'Email or password incorrect', 'alert-type' => 'error']);
        }
    }

    public function logout(Request $request)
    {
        if (auth()->check()) {
            auth()->logout();
            $request->session()->invalidate();
            session()->flash('success', 'Logout success');
            return redirect()->route('login');
        }
    }

    public function home()
    {
        $pending = 0;
        $picked = 0;
        $delivered = 0;
        $user = auth()->user();

        if ($user->user_type == 1) {
            $pending = Parcel::where(['owner_id' => auth()->id(), 'status' => 0])->count();
            $picked = Parcel::where(['owner_id' => auth()->id(), 'status' => 1])->count();
            $delivered = Parcel::where(['owner_id' => auth()->id(), 'status' => 2])->count();
            $view = 'client.home';
        } else {
            $pending = Parcel::where(['status' => 0])->count();
            $picked = Parcel::where(['biker_id' => auth()->id(), 'status' => 1])->count();
            $delivered = Parcel::where(['biker_id' => auth()->id(), 'status' => 2])->count();
            $view = 'biker.home';
        }
        return view($view, compact('pending', 'picked', 'delivered'));
    }
}
