<?php

namespace App\Models;

use App\Models\User;

use App\Http\Controllers\PostController;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory; 

    protected $guarded = [];

    public function user() {
        return $this->belongsTo(User::class);
    }

    // //image mutator
    // public function setPostImageAttribute($value) {
    //     $this->attributes['post_image'] = asset($value)
    // }

    //image accessor
    public function getPostImageAttribute($value) {
        return asset($value);
    }
}
