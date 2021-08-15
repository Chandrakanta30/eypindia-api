<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use App\Models\usertree;
class AuthController extends Controller
{
    public function register(Request $request)
    {
        $user = User::where('email', $request->email)
            ->first();

        if (!$user) {
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = bcrypt($request->password);
            if ($request->has('avatar') && $request->avatar != 'undefined') {
                $user->photo = handleBase64Upload($request->avatar, 250, 250);
            } else {
                $user->photo = 'https://res.cloudinary.com/resellmall/image/upload/v1597306395/businessman_d9v84o.png';
            }
            if ($request->has('device_id')) {
                $user->device_id = $request->device_id;
            }

            if ($request->has('fcm_token')) {
                $user->fcm_token = $request->fcm_token;
            }
            $user->save();
            $usertree=new usertree();
            $usertree->user_id=$user->id;
            $usertree->save();
            $referance_Details=$this->getNodeWithUser($request->referance_user_id);
            
            $referdetails=explode(",",$referance_Details);
            $node=usertree::where('user_id','=',$referdetails[0])->update([$referdetails[1] => $user->id]);


            return response()->json(['code' => 200, 'message' => 'Registration successful']);
        } else {
            return response()->json(['code' => 401, 'message' => 'Data already exists']);
        }
    }

    public function login(Request $request)
    {
      
        $validator = Validator::make($request->all(), [
            'email' => 'required|exists:users',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Data does not exists!',
                'code' => 401,
            ]);
        }

        $credentials = request(['email', 'password']);

        if (!Auth::attempt($credentials)) {
            return response()->json([
                'message' => 'Incorrect credentials',
                'code' => 401,
            ]);
        } else {

            $user = auth()->user();
            if ($request->has('device_id') && $request->has('fcm_token')) {
                $user->device_id = $request->device_id;
                $user->fcm_token = $request->fcm_token;
                $user->save();
            }

            $tokenResult = $user->createToken('Personal Access Token');
            $token = $tokenResult->token;
            $token->expires_at = Carbon::now()->addWeeks(5);
            $token->save();


            return response()->json([
                'message' => 'Login successful',
                'user' => $user,
                'access_token' => $tokenResult->accessToken,
                'code' => 200
            ]);
        }
    }

    public function userDetails(Request $request){
        return response()->json([
            'message' => 'User details',
            'user_details' => auth('api')->user(),
            'code' => 200
        ]);
    }

    public function getNodeWithUser($user_id){
        $userids=explode(",",$user_id);
        $childelements='';
        foreach ($userids as $key => $uid) {
           $userdetails=usertree::where('user_id','=',$uid)->first();
           if(is_null($userdetails->p1)){
            return $userdetails->user_id.",p1";
           }else{
            $childelements=$childelements.",".$userdetails->p1;
           }
           if(is_null($userdetails->p2)){
            return $userdetails->user_id.",p2";
           }else{
            $childelements=$childelements.",".$userdetails->p2;
           }
           if(is_null($userdetails->p3)){
            return $userdetails->user_id.",p3";
           }else{
            $childelements=$childelements.",".$userdetails->p3;
           }
           if(is_null($userdetails->p4)){
            return $userdetails->user_id.",p4";
           }else{
            $childelements=$childelements.",".$userdetails->p4;
           }
           if(is_null($userdetails->p5)){
            return $userdetails->user_id.",p5";
           }else{
            $childelements=$childelements.",".$userdetails->p5;
           }


           if(is_null($userdetails->p6)){
            return $userdetails->user_id.",p6";
           }else{
            $childelements=$childelements.",".$userdetails->p6;
           }


           if(is_null($userdetails->p7)){
            return $userdetails->user_id.",p7";
           }else{
            $childelements=$childelements.",".$userdetails->p7;
           }


           if(is_null($userdetails->p8)){
            return $userdetails->user_id.",p8";
           }else{
            $childelements=$childelements.",".$userdetails->p8;
           }


           if(is_null($userdetails->p9)){
            return $userdetails->user_id.",p9";
           }else{
            $childelements=$childelements.",".$userdetails->p9;
           }


           if(is_null($userdetails->p10)){
            return $userdetails->user_id.",p10";
           }else{
            $childelements=$childelements.",".$userdetails->p10;
           }
           $this->getNodeWithUser($childelements);

           
        }

    }
}
