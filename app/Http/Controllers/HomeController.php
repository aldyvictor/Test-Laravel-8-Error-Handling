<?php

namespace App\Http\Controllers;

use App\Exceptions\UserNotFoundException;
use Illuminate\Http\Request;
use App\Models\User;

use App\Services\UserService;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    // public function show($username)
    // {
    //     try {
    //         $user = User::where('username', $username)->firstOrFail();
    //         $user->load(['projects']);
    //     } catch (ModelNotFoundException $exception) {
    //         return view('users.notfound');
    //     } catch (RelationNotFoundException $exception) {
    //         return view('users.relations');
    //     }

    //     return view('show', compact('user'));
    // }

    public function show($username)
    {
        try {
            $user = (new UserService())->findByUsername($username);
        } catch (UserNotFoundException $exception) {
            return view('users.notfound', ['error' => $exception->getMessage()]);
        }

        return view('show', compact('user'));
    }
}
