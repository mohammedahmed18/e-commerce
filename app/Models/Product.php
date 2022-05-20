<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    public function images(){
        return $this->hasMany(Image::class);
    }
     public function admin(){
        return $this->belongsTo(Admin::class);
    }
    public function categories()
    {
        return $this->belongsToMany(Category::class,'categorizes');
    }


}
