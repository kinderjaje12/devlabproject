<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable=['description'];

    public function belongsToInstrument(): BelongsTo
    {
        return $this->belongsTo(Instrument::class,'instruments_id','id');
    }

    public function  belongsToUser(): BelongsTo
    {
        return $this->belongsTo(User::class,'users_id','id');
    }
}
