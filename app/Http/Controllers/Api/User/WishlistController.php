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
        $wishlist->user_id=1;
        $wishlist->product_id=$request->product_id;
        $wishlist->save();
        return json_encode(['code'=>200,'message'=>'Product has been added to the wishlist']);


    }

    public function remove(Request $request,$id){
        Wishlist::where('id','=',$id)->delete();
        return json_encode(['code'=>200,'message'=>'Product has been removed from the wishlist']);

    }
    public function get(){
        $wishlist=Wishlist::with(['product'])->get();
        return json_encode(['code'=>200,'wishlist'=>$wishlist,'message'=>'Product has been removed from the wishlist']);

    }
}
