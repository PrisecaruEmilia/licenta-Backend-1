<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProductList;
use App\Models\Category;
use App\Models\Subcategory;
use Image;

class ProductListController extends Controller
{
    public function ProductListByRemark(Request $request)
    {
        $remark = $request->remark;
        $productlist  = ProductList::where('remark', $remark)->limit(8)->get();
        return $productlist;
    }

    public function ProductListByCategory(Request $request)
    {
        $category = $request->category;
        $productlist  = ProductList::where('category', $category)->get();
        return $productlist;
    }
    public function ProductListBySubcategory(Request $request)
    {
        $category = $request->category;
        $subcategory = $request->subcategory;
        $productlist  = ProductList::where('category', $category)->where('subcategory', $subcategory)->get();
        return $productlist;
    }

    public function ProductBySearch(Request $request)
    {
        $key = $request->key;
        $productlist = ProductList::where('title', 'LIKE', "%{$key}%")->orWhere('brand', 'LIKE', "%{$key}%")->get();
        return $productlist;
    }

    public function SimilarProduct(Request $request)
    {
        $subcategory = $request->subcategory;
        $productlist = ProductList::where('subcategory', $subcategory)->orderBy('id', 'desc')->limit(6)->get();
        return $productlist;
    }

    public function GetAllProduct()
    {

        $products = ProductList::latest()->paginate(10);
        return view('backend.product.product_all', compact('products'));
    }

    public function AddProduct()
    {

        $category = Category::orderBy('category_name', 'ASC')->get();
        $subcategory = Subcategory::orderBy('subcategory_name', 'ASC')->get();
        return view('backend.product.product_add', compact('category', 'subcategory'));
    }
}
