<?php

namespace App\Http\Controllers;

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
use PDO;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class FridgeContentController extends Controller
{
    public function edit($fridgeId)
    {       
        $pdo = new PDO('mysql:host=mysql; dbname=fridgeweb; charset=utf8', 'sail', 'password');
        $userId = auth()->user()->id;
        $sql = $pdo->prepare('select * from fridges where id=?');
        $sql->execute([$fridgeId]);
        $fridge = $sql->fetch();
        $sql = $pdo->prepare('SELECT * FROM product WHERE fridge_id = ? AND exist <> 0 ORDER BY alarm_time DESC');
        $sql->execute([$fridgeId]);
        $products = $sql->fetchAll();
        
        $userFridges = Fridge::where('users_id', $userId)->get();
        if ($userFridges->pluck('id')->contains($fridgeId)) {
            return view('content.edit', compact('fridge', 'products'));
        } else {
            return abort(403);
        }    
    
    }
    public function update(Request $request,$fridgeId, $productId)
    {       
        DB::table('product')
        ->where('id', $productId)
        ->update([
            'exist' => '0',
        ]);
        $pdo = new PDO('mysql:host=mysql; dbname=fridgeweb; charset=utf8', 'sail', 'password');
        $userId = auth()->user()->id;
        $sql = $pdo->prepare('select * from fridges where id=?');
        $sql->execute([$fridgeId]);
        $fridge = $sql->fetch();
        $sql = $pdo->prepare('SELECT * FROM product WHERE fridge_id = ? AND exist <> 0 ORDER BY alarm_time DESC');
        $sql->execute([$fridgeId]);
        $products = $sql->fetchAll();
        
        $userFridges = Fridge::where('users_id', $userId)->get();
        if ($userFridges->pluck('id')->contains($fridgeId)) {
            return view('content.edit', compact('fridge', 'products'));
        } else {
            return abort(403);
        }    
    }
}
