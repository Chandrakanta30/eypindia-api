<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Address;

class AddressController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $addresslist=Address::get();
        return json_encode(['code'=>200,'address'=>$addresslist]);
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
        $newaddress=new Address();
        $newaddress->user_id=1;
        $newaddress->address_name=$request->address_name;
        $newaddress->address_line1=$request->address_line1;
        $newaddress->address_line2=$request->address_line2;
        $newaddress->zipcode=$request->zipcode;
        $newaddress->city=$request->city;
        $newaddress->state=$request->state;
        $newaddress->country=$request->country;
        $newaddress->phone=$request->phone;
        $newaddress->save();

        return json_encode(['code'=>200,'address'=>$newaddress,'message'=>'New address added successfully.']);
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
        $newaddress=Address::find($id);
        $newaddress->user_id=1;
        $newaddress->address_name=$request->address_name;
        $newaddress->address_line1=$request->address_line1;
        $newaddress->address_line2=$request->address_line2;
        $newaddress->zipcode=$request->zipcode;
        $newaddress->city=$request->city;
        $newaddress->state=$request->state;
        $newaddress->country=$request->country;
        $newaddress->phone=$request->phone;
        $newaddress->save();

        return json_encode(['code'=>200,'address'=>$newaddress]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $address = Address::find($id);
        $flight->delete();
        return json_encode(['code'=>200,'responce'=>'Message has been deleted successfully.']);
    }
}
