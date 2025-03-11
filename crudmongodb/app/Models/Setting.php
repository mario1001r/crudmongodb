<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
//use Illuminate\Database\Eloquent\Model;
use MongoDB\Laravel\Eloquent\Model;
use MongoDB\Laravel\Eloquent\SoftDeletes;
use MongoDB\Laravel\Relations\BelongsTo;

class Setting extends Model
{
    use HasFactory,SoftDeletes;

    protected $connection = 'mongodb';

    protected $collection = 'settings'; 

    public function theme():BelongsTo
    {
        return $this->BelongsTo(Theme::class,'theme_id','id');
    }
}
