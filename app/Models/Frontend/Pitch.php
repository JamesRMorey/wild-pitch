<?php

namespace App\Models\Frontend;

use App\Traits\UUID;
use Illuminate\Database\Eloquent\Model;

class Pitch extends Model
{
    use UUID;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'description',
        'img',
        'difficulty'
    ];

}
