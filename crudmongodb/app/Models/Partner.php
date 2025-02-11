<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
//use Illuminate\Database\Eloquent\Model;
use MongoDB\Laravel\Eloquent\Model;
use MongoDB\Laravel\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Partner extends Model
{
    use HasFactory,SoftDeletes;

    protected $connection = 'mongodb';

    protected $collection = 'partners';
    
    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class,'country_id', 'id');
    }

    public function state(): BelongsTo
    {
        return $this->belongsTo(State::class,'state_id', 'id');
    }

    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class,'city_id', 'id');
    }

}
