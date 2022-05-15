<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProductList;
use App\Models\Favorites;

class FavoriteController extends Controller
{
    public function AddFavorite(Request $request)
    {

        $product_code = $request->product_code;
        $email = $request->email;
        $productDetails = ProductList::where('product_code', $product_code)->get();

        $result = Favorites::insert([

            'product_name' => $productDetails[0]['title'],
            'image' => $productDetails[0]['image'],
            'product_code' => $product_code,
            'email' => $email,

        ]);
        return $result;
    }

    public function FavoriteList(Request $request)
    {

        $email = $request->email;
        $result = Favorites::where('email', $email)->get();
        return $result;
    }
}
