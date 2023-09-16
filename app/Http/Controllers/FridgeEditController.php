<?php

namespace App\Http\Controllers;

use App\Http\Requests\FridgeeditUpdateRequest;
use App\Http\Controllers\Controller;
use App\Models\Fridge;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
class FridgeEditController extends Controller
{

    public function edit($fridgeId)
    {
        // 确保这里正确接收了 $fridgeId 参数
        $fridge = Fridge::find($fridgeId);
        $userId = auth()->user()->id;
        $userFridges = Fridge::where('users_id', $userId)->get();
        if ($userFridges->pluck('id')->contains($fridgeId)) {
            return view('fridgeedit.edit', ['fridge' => $fridge]);
        } else {
            return abort(403);
        }
    }
    public function update(FridgeeditUpdateRequest $request): RedirectResponse
    {
        // Assuming you want to update a fridge record based on form data
        $fridge = Fridge::findOrFail($request->fridgeId); // Replace 'fridgeId' with the actual parameter name

        $fridge->update($request->validated()); // Assuming you're using validated data

        return Redirect::route('show');
    }
    public function delete($fridgeId)
    {
        // Find the fridge by its ID
        $fridge = Fridge::find($fridgeId);

        // Check if the fridge exists
        if (!$fridge) {
            // Handle the case where the fridge doesn't exist (e.g., show an error message)
            return redirect()->route('show')->with('error', 'Fridge not found');
        }

        // Delete the fridge
        $fridge->delete();

        // Redirect back to the fridge list or another appropriate page
        return redirect()->route('show')->with('success', 'Fridge deleted successfully');
    }
}
