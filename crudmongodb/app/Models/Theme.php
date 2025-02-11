<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use MongoDB\Laravel\Eloquent\Model;
use MongoDB\Laravel\Eloquent\SoftDeletes;

class Theme extends Model
{
    use HasFactory,SoftDeletes;

    protected $connection = 'mongodb';

    protected $collection = 'themes'; 

    protected $dates = ['deleted_at'];
}
