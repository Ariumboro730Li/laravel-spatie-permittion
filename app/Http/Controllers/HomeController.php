<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

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
        $user = User::where("id", Auth::user()->id)->with("roles")->with("permissions")->first()->permissions;
        if ($user) {
            foreach ($user as $key => $value) {
                $permissions[] = $value->name;
            }
        }
        return view('home')->with("permissions", $permissions);
    }

    public function getUser($id){
        if ($id == "me") {
            $id = Auth::user()->id;
        }
        $user = User::where("id", $id)->with("roles")->with("permissions")->first();
        return response($user, 200);
    }
}
