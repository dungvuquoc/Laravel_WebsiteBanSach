<?php

namespace App\Http\Controllers;

use App\Category;
use App\Components\Recusive;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PostProductController extends Controller
{
    private $product;
    private $category;
    public function __construct(Product $product, Category $category)
    {
        $this->product = $product;
        $this->category = $category;
    }

    public function getCategory($parentID) {
        $data = $this->category->all();
        $recursive = new Recusive($data);
        $htmlOption = $recursive->categoryRecusive($parentID);
        return $htmlOption;
    }

    public function search(Request $request) {
        $search = $request->get('search');
        $products = $this->product->query()->where('name', 'like', '%'.$search.'%')->paginate(5);
        $htmlOption = $this->getCategory($parentID = '');
        return view('admin.product.index', compact('products', 'htmlOption'));
    }

    public function searchCategoryProduct(Request $request) {
        $search = $request->get('category_id');
        $products = $this->product->query()->where('category_id', 'like', '%'.$search.'%')->paginate(5);
        $htmlOption = $this->getCategory($parentID = '');
        return view('admin.product.index', compact('products', 'htmlOption'));
    }

    public function sortPrice(Request $request) {
        $request->get('category_id');
    }
}
