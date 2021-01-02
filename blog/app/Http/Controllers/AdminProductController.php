<?php

namespace App\Http\Controllers;

use App\Category;
use App\CollectionHelper;
use App\Components\Recusive;
use App\Http\Requests\ProductAddRequest;
use App\Product;
use App\ProductImage;
use App\ProductTag;
use App\Tag;
use App\Traits\StorageImageTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AdminProductController extends Controller
{
    use StorageImageTrait;
    private $category;
    private $product;
    private $productImage;
    private $tag;
    private $productTag;
    public function __construct(Category $category, Product $product, ProductImage $productImage, Tag $tag, ProductTag $productTag)
    {
        $this->category = $category;
        $this->product = $product;
        $this->productImage = $productImage;
        $this->tag = $tag;
        $this->productTag = $productTag;
    }

    public function getCategory($parentID) {
        $data = $this->category->all();
        $recursive = new Recusive($data);
        $htmlOption = $recursive->categoryRecusive($parentID);
        return $htmlOption;
    }

    public function index(Request $request) {
        if($request->get('sortPrice') && $request->get('sortPrice') == 'descPrice' ) {
//            dd('Desc');
            $products1 = Product::all();
            $products2 = $products1->sortByDesc('price');
            $pageSize = 5;
            $products = CollectionHelper::paginate($products2, $pageSize);
            $htmlOption = $this->getCategory($parentID = '');
            return view('admin.product.index', compact('products', 'htmlOption'));
            //        $roles = $roles->sortByDesc(function('price')
//        {
//            return $role->created_at;
//        });
        } elseif ($request->get('sortPrice') && $request->get('sortPrice') == 'escPrice') {
            $products1 = Product::all();
            $products2 = $products1->sortBy('price');
            $pageSize = 5;
            $products = CollectionHelper::paginate($products2, $pageSize);
            $htmlOption = $this->getCategory($parentID = '');
            return view('admin.product.index', compact('products', 'htmlOption'));
        } else {
            $products = $this->product->latest()->paginate(5);
            $htmlOption = $this->getCategory($parentID = '');
            return view('admin.product.index', compact('products', 'htmlOption'));
        }
    }

    public function create() {
        $htmlOption = $this->getCategory($parentID = '');
        return view('admin.product.add', compact('htmlOption'));
    }

    public function store(ProductAddRequest $request) {
        try {
            DB::beginTransaction();
            $dataProductCreate = [
                'name' => $request->name,
                'price' => $request->price,
                'content' => $request->contents,
                'user_id' => auth()->id(),
                'category_id' => $request->category_id,
            ];

            $dataUploadFeatureImage = $this->storageTraitUpload($request, 'feature_image_path', 'product');
            if (!empty($dataUploadFeatureImage)) {
                $dataProductCreate['feature_image_name'] = $dataUploadFeatureImage['file_name'];
                $dataProductCreate['feature_image_path'] = $dataUploadFeatureImage['file_path'];
            }


            $product  = $this->product->query()->create($dataProductCreate);

            //Insert data to product_images
            if ($request->hasFile('image_path')) {
                foreach ($request->image_path as $fileItem) {
                    $dataProductImageDetail = $this->storageTraitUploadMutiple($fileItem, 'product');
                    $product->images()->create([
                        'image_path' => $dataProductImageDetail['file_path'],
                        'iamge_name' => $dataProductImageDetail['file_name']
                    ]);
                }
            }

            //Insert tags for product
            if (!empty($request->tags)) {
                foreach ($request->tags as $tagItem) {
                    $tagInstance = $this->tag->query()->firstOrCreate(['name' => $tagItem ]);
                    $tagIds[] = $tagInstance->id;
                }
            }
            $product->tags()->attach($tagIds);
            DB::commit();
            return redirect()->route('product.index');
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error('Message: ' . $exception->getMessage() . 'Line :' . $exception->getLine());
        }

    }

    public function edit($id) {
        $product = $this->product->find($id);
        $htmlOption = $this->getCategory($product->category_id);
        return view('admin.product.edit', compact('htmlOption', 'product'));
    }

    public function update(Request $request, $id) {
        try {
            DB::beginTransaction();
            $dataProductUpdate = [
                'name' => $request->name,
                'price' => $request->price,
                'content' => $request->contents,
                'user_id' => auth()->id(),
                'category_id' => $request->category_id,
            ];
            $dataUploadFeatureImage = $this->storageTraitUpload($request, 'feature_image_path', 'product');
            if (!empty($dataUploadFeatureImage)) {
                $dataProductUpdate['feature_image_name'] = $dataUploadFeatureImage['file_name'];
                $dataProductUpdate['feature_image_path'] = $dataUploadFeatureImage['file_path'];
            }
            $this->product->find($id)->update($dataProductUpdate);
            $product  = $this->product->find($id);

            //Insert data to product_images
            if ($request->hasFile('image_path')) {
                $this->productImage->where('product_id', $id)->delete();
                foreach ($request->image_path as $fileItem) {
                    $dataProductImageDetail = $this->storageTraitUploadMutiple($fileItem, 'product');
                    $product->images()->create([
                        'image_path' => $dataProductImageDetail['file_path'],
                        'iamge_name' => $dataProductImageDetail['file_name']
                    ]);
                }
            }

            //Insert tags for product
            if (!empty($request->tags)) {
                foreach ($request->tags as $tagItem) {
                    $tagInstance = $this->tag->firstOrCreate(['name' => $tagItem ]);
                    $tagIds[] = $tagInstance->id;
                }
            }
            $product->tags()->sync($tagIds);
            DB::commit();
            return redirect()->route('product.index');
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error('Message: ' . $exception->getMessage() . 'Line :' . $exception->getLine());
        }
    }

    public function delete($id) {

        try {
            $this->product->find($id)->delete();
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
