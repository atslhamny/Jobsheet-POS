<?php

namespace App\Http\Controllers;

use App\Models\UserModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        // // $data = [
        // //     'nama' => 'Pelanggan Pertama',

        // // ];
        // // UserModel::where('username', 'customer-1')->update($data);

        // $data  = [
        //     'level_id' => 2,
        //     'username' => 'manager_tiga',
        //     'nama' => 'Manager 3',
        //     'password' => Hash::make('12345')
        // ];
        // UserModel::create($data);

        // $user = UserModel::all();
        $user = UserModel::findOr(20, ['username', 'nama'], function() {
            abort(404);
        });
        return view('user', ['data' => $user]);
    }
}

?>