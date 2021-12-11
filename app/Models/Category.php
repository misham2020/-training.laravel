<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'slug'];

    public function ads()
    {
        return $this->belongsToMany(Ads::class, 'ads_category', 'category_id', 'ads_id');
    }

}
