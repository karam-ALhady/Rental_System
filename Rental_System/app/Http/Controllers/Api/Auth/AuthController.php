<?php

namespace App\Http\Controllers\Api\Auth;

use App\Customs\Services\EmailVerficationService;
use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegistrationRequest;
use App\Models\Client;
use App\Models\Owner;
use App\Models\User;
use Illuminate\Http\Request;

use function PHPUnit\Framework\returnSelf;

class AuthController extends Controller
{
    public function __construct(private EmailVerficationService $service){

    }

    public function login(LoginRequest $request){
        $token=auth()->attempt($request->validated());
        if($token){
            return $this->responseWithToken($token,auth()->user());
        }
        else{
            return response()->json([
                'status'=>'failed',
                'message'=>'Invalid user'
            ],401);
        }
    }


    public function register(RegistrationRequest $request)
    {
        $user=User::create($request->validated());
        if($user){

            if($request->role==='owner'){
                Owner::create(['user_id'=>$user->id]);
            }
            if($request->role==='client'){
                Client::create(['user_id'=>$user->id]);
            }
           // $this->service->sendVerificationLink($user);
            $token=auth()->login($user);
            return $this->responseWithToken($token,$user);
        }
        else{
            return response()->json([
                'status'=>'failed',
                'message'=>'an error occure'
            ],500);
        }
    }


    public function responseWithToken($token,$user)
    {
        return response()->json([
            'status'=>'success',
            'user'=>$user,
            'access_token'=>$token,
            'type'=>'bearer'
        ]);

    }



}
