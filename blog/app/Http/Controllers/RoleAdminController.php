<?php

namespace App\Http\Controllers;

use App\Menu;
use App\User;
use Illuminate\Http\Request;

class RoleAdminController extends Controller
{
    private $html = '';

    public function menuRecursiveAdd() {
        $data = User::all();
        foreach ($data as $dataItem) {
            $this->html .= '<option value="' .$dataItem->id. '">' .$dataItem->email. '</option>';
        }
        return $this->html;
    }

    public function index() {

        $optionSelect = $this->menuRecursiveAdd();
        return view('admin.roleAdmin.index', compact('optionSelect'));
    }

    public function store(Request $request)
    {

//        dd($request->email1);
        $user = User::find($request->email1);
//        dd($user->roles_simple);
        $admin = "admin";
        $user->update([
            'roles_simple' => $request->Roles1
        ]);
        dd($request->Roles1);
        return view('admin.roleAdmin.add');
    }
}
