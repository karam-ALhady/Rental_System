<?php

namespace App\Http\Controllers;

use App\Models\Owner;
use Illuminate\Http\Request;

class OwnerController extends Controller
{
    public function getAllOwners(){
        $owners=Owner::all();
        if($owners->isNotEmpty()){
            return response()->json([
        'message'=>'all owners have been goten',
        'data'=>$owners,
        ],200);
        }
        else{
            return response()->json([
                'message'=>'no data have been found',
                'data'=>[],
            ],404);
        }
    }
public function getOwnerProperties(Request $request){
$owner_properties=Owner::where('id',$request->id)->Properties()->get();

if($owner_properties->isNotEmpty()){
    return response()->json([
        'message'=>'these is the owner properties',
        'data'=>$owner_properties,
    ],200);
}
else{
    return response()->json([
        'mesasage'=>'there is no properties for this owner',
        'data'=>[],
    ],404);
}
}



public function myProperties(){

}


}
