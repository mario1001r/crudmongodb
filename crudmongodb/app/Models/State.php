<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use MongoDB\Laravel\Eloquent\Model;
use MongoDB\Laravel\Eloquent\SoftDeletes;
use MongoDB\Laravel\Relations\BelongsTo;
use MongoDB\Laravel\Relations\BelongsToMany;

class State extends Model
{
    use HasFactory,SoftDeletes;

    protected $dates = ['deleted_at'];

	protected $connection = 'mongodb';

    protected $collection = 'states'; 

    public function country():BelongsTo
    {
        return $this->belongsTo(Country::class,'country_id', 'id');
    }

    public function city():BelongsToMany
    {
        return $this->belongsToMany(City::class);
    }
}
