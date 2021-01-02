<?php

namespace App\Http\Controllers;

use App\Category;
use App\Components\Recusive;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Psy\Util\Str;

class CategoryController extends Controller
{
    private $category;

    public function __construct(Category $category) {
        $this->category = $category;
    }

    public function getCategory($parentID) {
        $data = $this->category->all();
        $recursive = new Recusive($data);
        $htmlOption = $recursive->categoryRecusive($parentID);
        return $htmlOption;
    }

    public function index() {
        $categories = $this->category->latest()->paginate(5);
        return view('admin.category.index', compact('categories'));
    }

    public function create() {
        $htmlOption = $this->getCategory($parentID = '');
        return view('admin.category.add', compact('htmlOption'));
    }

    public function store(Request $request) {
//        dd($request->parent_id);
        $this->category->create([
           'name' => $request->name,
            'parent_id' => $request->parent_id,
            'slug' => $request->name
        ]);
        return redirect()->route('categories.index');
    }

    public function edit($id) {
        $category = $this->category->find($id);
        $htmlOption = $this->getCategory($category->parent_id);
        return view('admin.category.edit', compact('category', 'htmlOption'));
    }

    public function update($id, Request $request) {
        $category = $this->category->find($id);
        $category->update([
            'name' => $request->name,
            'parent_id' => $request->parent_id,
            'slug' => $request->name
        ]);
        return redirect()->route('categories.index');
    }

    public function delete($id) {
        try {
            $this->category->find($id)->delete();
            return response()->json([
                'code' => 200,
                'message' => 'Delete success'
            ], 200);
        } catch (\Exception $exception) {
            Log::error('Lỗi : ' . $exception->getMessage() . '---Line: ' . $exception->getLine());
            return response()->json([
                'code' => 500,
                'message' => 'Delete fail'
            ], 500);
        }
    }
}
