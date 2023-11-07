<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDO;

class FridgeController extends Controller
{
    public function selectTable(Request $request)
    {
        $pdo = new PDO('mysql:host=mysql; dbname=fridgeweb; charset=utf8', 'sail', 'password');
        $sql = $pdo->prepare('select * from fridges where city=? and dist=?');
        $sql->execute([$request->input('county'), $request->input('area')]);
        $fridges = $sql->fetchAll();

        return view('selecttable', compact('fridges'));
    }

    public function detail(Request $request)
    {
        $pdo = new PDO('mysql:host=mysql; dbname=fridgeweb; charset=utf8', 'sail', 'password');
        $sql = $pdo->prepare('select * from fridges where id=?');
        $sql->execute([$request->input('id')]);
        $fridges = $sql->fetchAll();
        $sql = $pdo->prepare('select * from product where fridge_id=? and exist=? order by alarm_time desc');
        $sql->execute([$request->input('id'), 1]);
        $products = $sql->fetchAll();

        return view('fridgedetail', compact('fridges', 'products'));
    }

    public function comment(Request $request)
    {
        $pdo = new PDO('mysql:host=mysql; dbname=fridgeweb; charset=utf8', 'sail', 'password');
        $sql = $pdo->prepare('insert into comment values(null, ?, ?, default, ?, ?)');
        if($sql->execute([htmlspecialchars($request->input('content')), $request->input('id'), now(), now()]))
            return redirect()->back() ->with('alert', '回報成功！');
    }
}