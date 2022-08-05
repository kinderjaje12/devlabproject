<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class InstrumentGrade extends Model
{
    use HasFactory, SoftDeletes;

    public static function totalVotesForSingleInstrument($id){
        return count(InstrumentGrade::where('instruments_id',$id)->get());
    }
}
