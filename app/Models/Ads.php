<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Ads extends Model
{
    use HasFactory;

    //use Sluggable;

    protected $table = 'ads';
    protected $fillable = ['title', 'cost', 'user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function cat()
    {
        return $this->belongsToMany(Category::class, 'ads_category', 'ads_id', 'category_id');
    }

    public function imges()
    {
        return $this->hasMany(Image::class);
    }

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    /*  public function sluggable(): array
     {
         return [
             'slug' => [
                 'source' => 'title'
             ]
         ];
     } */

}
