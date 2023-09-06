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
class AddFridgeController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('add.fridge', [
            'user' => $request->user(),
        ]);
    }
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'city' => ['required', 'string', 'max:255'],
            'dist' => ['required', 'string', 'max:255'],
            'address' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'max:255'],
            'company' => ['required', 'string', 'max:255'],
            'telephone' => ['required', 'string', 'max:255'],
        ]);

        $fridge = Fridge::create([
            'name' => $request->name,
            'city' => $request->city,
            'dist' => $request->dist,
            'address' => $request->address,
            'email' => $request->email,
            'company' => $request->company,
            'telephone' => $request->telephone,
            'users_id' => auth()->user()->id,
        ]);

        


        return redirect(RouteServiceProvider::HOME);
    }


}