<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contract extends Model
{
    use HasFactory;
    protected $guarded=[];

    public function Property(){
        return $this->belongsTo(Property::class);
    }

    public function Client(){
        return $this->belongsTo(Client::class);
    }

}
