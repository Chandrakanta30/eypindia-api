<?php

namespace App\Http\Controllers\Api\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Wishlist;
class WishlistController extends Controller
{
    //

    public function add(Request $request){
        $wishlist=new Wishlist();
        $user_id = auth('api')->id();
        $wishlist->user_id=$user_id;
        $wishlist->product_id=$request->product_id;
        $wishlist->save();
        return json_encode(['code'=>200,'message'=>'Product has been added to the wishlist']);


    }

    public function remove(Request $request,$id){
        Wishlist::where('id','=',$id)->delete();
        return json_encode(['code'=>200,'message'=>'Product has been removed from the wishlist']);

    }
    public function get(){
        $user_id = auth('api')->id();
        $wishlist=Wishlist::with(['product'])->where('user_id',$user_id)->get();
        return json_encode(['code'=>200,'wishlist'=>$wishlist,'message'=>'Product has been removed from the wishlist']);

    }
}
