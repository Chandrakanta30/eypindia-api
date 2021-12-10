<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\usertree;
use App\Models\Scheme;
use App\Models\SchemePayment;

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use DB;

class SchemeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $allschemes=Scheme::with('user')->with('payments')->where('agent_id',auth('api')->id())->get();
        return response()->json(['code' => 200,'customers'=>$allschemes ,'message' => 'Registration successful']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
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
            $referance_Details=$this->getNodeWithUser(auth('api')->id());
            
            $referdetails=explode(",",$referance_Details);
            $node=usertree::where('user_id','=',$referdetails[0])->update([$referdetails[1] => $user->id]);
            $scheme=new Scheme();
            $scheme->scheme_name=$request->scheme_name;
            $scheme->customer_id=$user->id;
            $scheme->agent_id=auth('api')->id();
            $scheme->scheme_number=$request->scheme_number;
            $scheme->start_date=$request->start_date;
            $scheme->marurity_date=$request->marurity_date;
            $scheme->amount=$request->amount;
            $scheme->payment_mode=$request->payment_mode;
            $ts1 = strtotime($request->start_date);
            $ts2 = strtotime($request->marurity_date);
            $year1 = date('Y', $ts1);
            $year2 = date('Y', $ts2);
            $month1 = date('m', $ts1);
            $month2 = date('m', $ts2);
            $diff = (($year2 - $year1) * 12) + ($month2 - $month1);
            $scheme->roi=$request->roi;
            $scheme->number_of_months=$diff;


            $scheme->save();






            return response()->json(['code' => 200, 'message' => 'Registration successful']);
        } else {
            return response()->json(['code' => 401, 'message' => 'Data already exists']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
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
    public function paymentsList(){
        $allPayments=DB::table('scheme_payments')
            ->leftJoin('schemes', 'schemes.id', '=', 'scheme_payments.scheme_id')
            ->leftJoin('users', 'schemes.customer_id', '=', 'users.id')
            ->where('schemes.agent_id',auth('api')->id())
            ->select('users.name','users.photo','schemes.*','scheme_payments.*')
            ->get();
        return response()->json(['code' => 200,'payments'=>$allPayments ,'message' => 'Registration successful']);

    }

    public function details($id){
        $allschemes=Scheme::with('user')->with('payments')->where('agent_id',auth('api')->id())->where('id',$id)->get();
        return response()->json(['code' => 200,'customers'=>$allschemes ,'message' => 'Registration successful']);
    }
}
