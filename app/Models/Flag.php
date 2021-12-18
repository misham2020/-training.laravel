<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Flag extends Model
{
    use HasFactory;

    protected $fillable = [
        'name'
    ];

    public function ads_flag()
    {
        return $this->hasMany(Ads::class);
    }
}
