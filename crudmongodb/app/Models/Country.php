<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use MongoDB\Laravel\Eloquent\Model;
use MongoDB\Laravel\Eloquent\SoftDeletes;

class Country extends Model
{
    use HasFactory,SoftDeletes;

    protected $dates = ['deleted_at'];

	protected $connection = 'mongodb';

    protected $collection = 'countries'; 
}
