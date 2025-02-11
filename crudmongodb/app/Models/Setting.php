<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
//use Illuminate\Database\Eloquent\Model;
use MongoDB\Laravel\Eloquent\Model;
use MongoDB\Laravel\Eloquent\SoftDeletes;

class Setting extends Model
{
    use HasFactory,SoftDeletes;

    protected $connection = 'mongodb';

    protected $collection = 'settings'; 
}
