<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use HasFactory, SoftDeletes;

    public function hasManyBaskets(): HasMany
    {
        return $this->hasMany(Basket::class,'orders_id','id')->with('belongsToInstrument');
    }

    public function belongsToUser(): BelongsTo
    {
        return $this->belongsTo(User::class,'users_id','id');
    }
}
