<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Fridge;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
class ShowController extends Controller
{

    public function edit(Request $request): View
    {
        $userId = auth()->user()->id;
        $userFridges = Fridge::where('users_id', $userId)->get();

        return view('show.show-fridge',  ['userFridges' => $userFridges]);
    }
}