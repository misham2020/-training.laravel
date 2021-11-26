<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ads extends Model
{
    use HasFactory;


    public function user() {
		return $this->belongsTo(User::class);
	}

    public function cat() {
		return $this->belongsToMany(Category::class,'ads_category', 'ads_id', 'category_id');
	}
	public function imges() {
		return $this->hasMany(Image::class);
	}
}
