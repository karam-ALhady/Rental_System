<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddPropertiesRequest;
use App\Models\Property;
use Illuminate\Http\Request;

class PropertyController extends Controller
{
    public function getAllProperties(){
        $allProperties=Property::all();
        if($allProperties->isNotEmpty()){
        return response()->json([
           'message'=>'all properties have been goten',
           'data'=>$allProperties,
        ],200);
    }
        else{
            return response()->json([
                'message'=>'no properties found',
                'data'=>[],
            ],404);
        }
}
public function addProperties(AddPropertiesRequest $request){
if(!auth()->check()){
    return response()->json(['message'=>'Unauthorized'],401);
}
$user_role=auth()->user()->role;
if($user_role!=='owner'){
    return response()->json(['message' => 'Access denied. Only owners can add properties.'], 403);
}
$property=Property::create([
    'type'=>$request->type,
    'governorate' => $request->governorate,
    'address_detailes' => $request->address_detailes,
    'price' => $request->price,
    'owner_id'=>auth()->id(),
]);
return response()->json([
    'message' => 'Property added successfully!',
    'property' => $property,
], 201);
}
}
