<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;
    protected $guarded=[];

public function User(){
    return $this->belongsTo(User::class);
}

public function Contracts(){
    return $this->hasMany(Contract::class,'client_id');
}

}
