<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
class ProductController extends Controller
{
    public function show($id)
    {
        $product_details=Product::with('galleries')->find($id);
        $category_products=Product::with('galleries')->where('category_id',$product_details->category_id)->get();
       
        return json_encode(['code'=>200,'product_details'=>$product_details,'category_products'=>$category_products]);
        
    }
    public function showCategoryProducts($id){
        $category_products=Product::with('galleries')->where('category_id',$id)->get();
        $category_details=Category::with('subs')->find($id);
        return json_encode(['code'=>200,'product_details'=>$category_products,'category_details'=>$category_details]);
    }
}
