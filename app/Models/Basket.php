<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Basket extends Model
{
    use HasFactory, SoftDeletes;

    public function belongsToInstrument(){
        return $this->belongsTo(Instrument::class,'instruments_id','id');
    }
}
