<?php

namespace App\Http\Controllers;

use App\Category;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    private $product;
    private $category;
    public function __construct(Product $product, Category $category)
    {
        $this->product = $product;
        $this->category = $category;
    }
    public function search(Request $request) {
        $search = $request->get('search');
        $categories = $this->category->query()->where('name', 'like', '%'.$search.'%')->paginate(5);
        return view('admin.category.index', ['categories' => $categories]);
    }

    public function searchSlider(Request $request) {
        $search = $request->get('search');
        $sliders = DB::table('sliders')->where('name', 'like', '%'.$search.'%')->paginate(5);
        return view('admin.slider.index', ['sliders' => $sliders]);
    }

    public function searchRole(Request $request) {
        $search = $request->get('search');
        $roles = DB::table('roles')->where('name', 'like', '%'.$search.'%')->paginate(5);
        return view('admin.role.index', ['roles' => $roles]);
    }

    public function searchUser(Request $request) {
        $search = $request->get('search');
        $users = DB::table('users')->where('name', 'like', '%'.$search.'%')->paginate(5);
        return view('admin.user.index', ['users' => $users]);
    }
}
