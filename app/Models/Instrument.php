<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Instrument extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded=['id','rate'];
    public function belongsToInstrumentCategory(): BelongsTo
    {
        return $this->belongsTo(InstrumentCategory::class,'instrument_category_id');
    }

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class,'instruments_id');
    }

    public function hasManyGrades(): HasMany
    {
        return $this->hasMany(InstrumentGrade::class);
    }

    public function hasManyBaskets(): HasMany
    {
        return $this->hasMany(Basket::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

}
