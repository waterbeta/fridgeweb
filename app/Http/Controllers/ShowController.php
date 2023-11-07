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
use PDO;

class ShowController extends Controller
{
    public function edit(Request $request): View
    {
        $userId = auth()->user()->id;
        $userFridges = Fridge::where('users_id', $userId)->get();

        return view('show.show-fridge',  ['userFridges' => $userFridges]);
    }

    public function showcomment(Request $request)
    {
        $pdo = new PDO('mysql:host=mysql; dbname=fridgeweb; charset=utf8', 'sail', 'password');
        $fridges = $pdo->prepare('select * from fridges where users_id=?');
        $fridges->execute([auth()->user()->id]);
        foreach ($fridges as $fridge) {
            $comments = $pdo->prepare('select * from comment where fridge_id=? and solve=? order by created_at desc');
            $comments->execute([$fridge['id'], 0]);
            $data[] = [
                'fridge' => $fridge,
                'comments' => $comments
            ];
        }

        return view('show.show-comment', compact('data'));
    }
    public function solved(Request $request)
    {
        $pdo = new PDO('mysql:host=mysql; dbname=fridgeweb; charset=utf8', 'sail', 'password');
        $sql = $pdo->prepare('update comment set solve=1, updated_at=CURRENT_TIMESTAMP() where id=?');
        $sql->execute([$request->input('id')]);
        return redirect()->back();
    }
    public function solvedcomment(Request $request)
    {
        $pdo = new PDO('mysql:host=mysql; dbname=fridgeweb; charset=utf8', 'sail', 'password');
        $fridges = $pdo->prepare('select * from fridges where users_id=?');
        $fridges->execute([auth()->user()->id]);
        foreach ($fridges as $fridge) {
            $comments = $pdo->prepare('select * from comment where fridge_id=? and solve=? order by updated_at desc');
            $comments->execute([$fridge['id'], 1]);
            $data[] = [
                'fridge' => $fridge,
                'comments' => $comments
            ];
        }

        return view('show.show-solvedcomment', compact('data'));
    }

    public function expiredproduct(Request $request)
    {
        $pdo = new PDO('mysql:host=mysql; dbname=fridgeweb; charset=utf8', 'sail', 'password');
        $expired = $pdo->prepare('select * from product where STR_TO_DATE(alarm_time, "%Y%m%d_%H%i")<NOW() and exist=?');
        $expired->execute([1]);
        foreach ($expired as $expire) {
            $fridge = $pdo->prepare('select * from fridges where id=?');
            $fridge->execute([$expire['fridge_id']]);
            $data[] = [
                'fridge' => $fridge,
                'expire' => $expire
            ];
        }

        return view('expiredproduct', compact('data'));
    }
}