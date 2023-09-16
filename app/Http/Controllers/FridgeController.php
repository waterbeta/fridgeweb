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
        $sql = $pdo->prepare('select * from product where fridge_id=? order by alarm_time desc');
        $sql->execute([$request->input('id')]);
        $products = $sql->fetchAll();

        return view('fridgedetail', compact('fridges', 'products'));
    }
}