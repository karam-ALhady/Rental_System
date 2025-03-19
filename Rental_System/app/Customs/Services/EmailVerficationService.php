<?php

namespace App\Customs\Services;

use App\Models\EmailVerificationToken;
use App\Notifications\EmailVerifacationNotification;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Str;

final class EmailVerficationService
{

function sendVerificationLink(object $user) : void {
Notification::send($user,new EmailVerifacationNotification($this->generateVerificationLink($user->email)));

}


 public function generateVerificationLink(string $email): string
{
    $checkIfTokenExists= EmailVerificationToken::where('email',$email)->first();
    if($checkIfTokenExists) $checkIfTokenExists->delete();
    $token=Str::uuid();
    $url=config('app.url'). "?token=".$token."&email=".$email;
    $saveToken= EmailVerificationToken::create([
        "email"=>$email,
        "token"=>$token,
        "expired_at"=>now()->addMinutes(60),
    ]);
    if($saveToken){
        return $url;
    }
    return  "";

}
}
