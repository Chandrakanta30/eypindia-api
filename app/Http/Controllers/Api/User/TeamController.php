<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\usertree;
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
class TeamController extends Controller
{

    private $usertree='';


    public function checkUser(Request $request ){
        $userid = str_replace('EL', '', $request->user_id);
        $userdetails=User::find($userid);
        return json_encode(['code'=>200,'userdetails'=>$userdetails,'message'=>'You have been successfully refered','data'=>$userid]);
    }
    public function getdownlineList(Request $request ){
        $userid = ($request->user_id);
        $getalldownlineusers=$this->getAllDownlineusers($userid);
        $alldownlineusers=[];
        // print_r($getalldownlineusers);
        // foreach ($getalldownlineusers as $key => $value) {
        //     $userdetails=User::find($value);
        //     array_push($alldownlineusers,$userdetails);
        // }

        
        // return json_encode(['code'=>200,'userdetails'=>$alldownlineusers,'message'=>'You have been successfully refered']);
    }
    public function getAllDownlineusers($userid){
        
        $usersarray=explode(",",$userid);
        $userslist='';
        $alldownlineusers=[];
        $usersarray=array_filter($usersarray);
        if($this->usertree==''){
            $this->usertree=$userid;
        }else{
            $this->usertree=$this->usertree.",".$userid;
        }
        
        if(sizeof($usersarray)>0){
            
            foreach ($usersarray as $key => $value) {
    
                $userdetails=usertree::where("user_id","=",$value)->first();
                if((is_null($userdetails->p1)) && (is_null($userdetails->p2)) && (is_null($userdetails->p3)) && (is_null($userdetails->p4)) && (is_null($userdetails->p5)) && (is_null($userdetails->p6)) && (is_null($userdetails->p7)) && (is_null($userdetails->p8)) && (is_null($userdetails->p9)) && (is_null($userdetails->p10))){

                    $allusers=explode(",",$this->usertree);
                    foreach ($allusers as $key => $value) {
                        if($value){
                        $userdetails=User::find($value);
                        array_push($alldownlineusers,$userdetails);
                        }
                    }
                    
                    echo json_encode(['code'=>200,'userdetails'=>$this->usertree,'userslist'=>$alldownlineusers,'message'=>'You have been successfully refered']);
                }
                if(!is_null($userdetails->p1)){
                 $userslist=$userslist.$userdetails->p1.",";
                 }
                 if(!is_null($userdetails->p2)){
                     $userslist=$userslist.$userdetails->p2.",";
                 }
                 if(!is_null($userdetails->p3)){
                     $userslist=$userslist.$userdetails->p3.",";
                 }
                 if(!is_null($userdetails->p4)){
                     $userslist=$userslist.$userdetails->p4.",";
                 }
                 if(!is_null($userdetails->p5)){
                     $userslist=$userslist.$userdetails->p5.",";
                 }
                 if(!is_null($userdetails->p6)){
                     $userslist=$userslist.$userdetails->p6.",";
                 }
                 if(!is_null($userdetails->p7)){
                     $userslist=$userslist.$userdetails->p7.",";
                 }
                 if(!is_null($userdetails->p8)){
                     $userslist=$userslist.$userdetails->p8.",";
                 }
                 if(!is_null($userdetails->p9)){
                     $userslist=$userslist.$userdetails->p9.",";
                 }
                 if(!is_null($userdetails->p10)){
                     $userslist=$userslist.$userdetails->p10.",";
                 }
                 if($userslist!=''){
                    $this->getAllDownlineusers($userslist);
                 }
                 
    
            }

        }else{
            $allusers=explode(",",$this->usertree);
            foreach ($allusers as $key => $value) {
                if($value){
                    $userdetails=User::find($value);
                array_push($alldownlineusers,$userdetails);

                }
                
            }
            echo json_encode(['code'=>200,'userdetails'=>$this->usertree,'userslist'=>$alldownlineusers,'message'=>'You have been successfully refered']);
        }
    }
}
