<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Owner extends Model
{
    use HasFactory;

    protected $guarded=[];

    public function User(){
        return $this->belongsTo(User::class);
    }

    public function Properties(){
        return $this->hasMany(Property::class,'owner_id');
    }
}
