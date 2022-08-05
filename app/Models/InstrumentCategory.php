<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class InstrumentCategory extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable=['name','photo'];

    public function hasManyInstruments(): HasMany
    {
        return $this->hasMany(Instrument::class);
    }

    public function findCategoryById($id): Instrument
    {
        return $this->findOrFail($id);
    }

}
