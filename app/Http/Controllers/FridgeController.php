<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDO;

class FridgeController extends Controller
{
    public function selectTable(Request $request)
    {
        $pdo = new PDO('mysql:host=mysql; dbname=fridgeweb; charset=utf8', 'sail', 'password');
        $sql = $pdo->prepare('select * from fridges where address like ?');
        $address = $request->input('county') . $request->input('area');
        $sql->execute(['%' . $address . '%']);
        $fridges = $sql->fetchAll();

        return view('selecttable', compact('fridges'));
    }
}