<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProductList;
use App\Models\ProductDetails;
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

    public function StoreProduct(Request $request)
    {

        $request->validate([
            'product_code' => 'required',
        ], [
            'product_code.required' => 'Input Product Code'

        ]);

        $image = $request->file('image');
        $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
        Image::make($image)->resize(711, 960)->save('upload/product/' . $name_gen);
        $save_url = 'http://127.0.0.1:8000/upload/product/' . $name_gen;

        $product_id = ProductList::insertGetId([
            'title' => $request->title,
            'price' => $request->price,
            'special_price' => $request->special_price,
            'category' => $request->category,
            'subcategory' => $request->subcategory,
            'remark' => $request->remark,
            'brand' => $request->brand,
            'product_code' => $request->product_code,
            'image' => $save_url,

        ]);

        /////// Insert Into Product Details Table //////
        $image1 = $request->file('image_one');
        $name_gen1 = hexdec(uniqid()) . '.' . $image1->getClientOriginalExtension();
        Image::make($image1)->resize(711, 960)->save('upload/productdetails/' . $name_gen1);
        $save_url1 = 'http://127.0.0.1:8000/upload/productdetails/' . $name_gen1;


        $image2 = $request->file('image_two');
        $name_gen2 = hexdec(uniqid()) . '.' . $image2->getClientOriginalExtension();
        Image::make($image2)->resize(711, 960)->save('upload/productdetails/' . $name_gen2);
        $save_url2 = 'http://127.0.0.1:8000/upload/productdetails/' . $name_gen2;


        $image3 = $request->file('image_three');
        $name_gen3 = hexdec(uniqid()) . '.' . $image3->getClientOriginalExtension();
        Image::make($image1)->resize(711, 960)->save('upload/productdetails/' . $name_gen3);
        $save_url3 = 'http://127.0.0.1:8000/upload/productdetails/' . $name_gen3;



        $image4 = $request->file('image_four');
        $name_gen4 = hexdec(uniqid()) . '.' . $image4->getClientOriginalExtension();
        Image::make($image4)->resize(711, 960)->save('upload/productdetails/' . $name_gen4);
        $save_url4 = 'http://127.0.0.1:8000/upload/productdetails/' . $name_gen4;

        ProductDetails::insert([
            'product_id' => $product_id,
            'image_one' => $save_url1,
            'image_two' => $save_url2,
            'image_three' => $save_url3,
            'image_four' => $save_url4,
            'short_description' => $request->short_description,
            'color' =>  $request->color,
            'size' =>  $request->size,
            'long_description' => $request->long_description,

        ]);


        $notification = array(
            'message' => 'Product Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.product')->with($notification);
    } // End Method

    public function EditProduct($id)
    {

        $category = Category::orderBy('category_name', 'ASC')->get();
        $subcategory = Subcategory::orderBy('subcategory_name', 'ASC')->get();
        $product = ProductList::findOrFail($id);
        $details = ProductDetails::where('product_id', $id)->get();
        return view('backend.product.product_edit', compact('category', 'subcategory', 'product', 'details'));
    }

    public function UpdateProduct(Request $request)
    {

        $request->validate([
            'product_code' => 'required',
        ], [
            'product_code.required' => 'Input Product Code'

        ]);
        // dd($request->id);
        $product = ProductList::findOrFail($request->id);
        $details = ProductDetails::where('product_id', $request->id)->get();
        $image = $request->file('image');
        if ($image !== null) {
            $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            Image::make($image)->resize(711, 960)->save('upload/product/' . $name_gen);
            $save_url = 'http://127.0.0.1:8000/upload/product/' . $name_gen;
        } else {
            $save_url = $product->image;
        }


        ProductList::findOrFail($request->id)->update([
            'title' => $request->title,
            'price' => $request->price,
            'special_price' => $request->special_price,
            'category' => $request->category,
            'subcategory' => $request->subcategory,
            'remark' => $request->remark,
            'brand' => $request->brand,
            'product_code' => $request->product_code,
            'image' => $save_url,

        ]);

        /////// Insert Into Product Details Table //////
        $image1 = $request->file('image_one');
        if ($image1 !== null) {
            $name_gen1 = hexdec(uniqid()) . '.' . $image1->getClientOriginalExtension();
            Image::make($image1)->resize(711, 960)->save('upload/productdetails/' . $name_gen1);
            $save_url1 = 'http://127.0.0.1:8000/upload/productdetails/' . $name_gen1;
        } else {
            $save_url1 = $details[0]->image_one;
        }



        $image2 = $request->file('image_two');
        if ($image2 !== null) {
            $name_gen2 = hexdec(uniqid()) . '.' . $image2->getClientOriginalExtension();
            Image::make($image2)->resize(711, 960)->save('upload/productdetails/' . $name_gen2);
            $save_url2 = 'http://127.0.0.1:8000/upload/productdetails/' . $name_gen2;
        } else {
            $save_url2 = $details[0]->image_two;
        }



        $image3 = $request->file('image_three');
        if ($image3 !== null) {
            $name_gen3 = hexdec(uniqid()) . '.' . $image3->getClientOriginalExtension();
            Image::make($image1)->resize(711, 960)->save('upload/productdetails/' . $name_gen3);
            $save_url3 = 'http://127.0.0.1:8000/upload/productdetails/' . $name_gen3;
        } else {
            $save_url3 = $details[0]->image_three;
        }




        $image4 = $request->file('image_four');
        if ($image4 !== null) {
            $name_gen4 = hexdec(uniqid()) . '.' . $image4->getClientOriginalExtension();
            Image::make($image4)->resize(711, 960)->save('upload/productdetails/' . $name_gen4);
            $save_url4 = 'http://127.0.0.1:8000/upload/productdetails/' . $name_gen4;
        } else {
            $save_url4 = $details[0]->image_four;
        }


        ProductDetails::findOrFail($details[0]->id)->update([
            'product_id' => $request->id,
            'image_one' => $save_url1,
            'image_two' => $save_url2,
            'image_three' => $save_url3,
            'image_four' => $save_url4,
            'short_description' => $request->short_description,
            'color' =>  $request->color,
            'size' =>  $request->size,
            'long_description' => $request->long_description,

        ]);


        $notification = array(
            'message' => 'Product Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.product')->with($notification);
    } // End Method

    public function DeleteProduct($id)
    {
        $details = ProductDetails::where('product_id', $id)->get();

        ProductList::findOrFail($id)->delete();
        ProductDetails::findOrFail($details[0]->id)->delete();

        $notification = array(
            'message' => 'Product Deleted Successfully',
            'alert-type' => 'success'
        );


        return redirect()->back()->with($notification);
    }
}
