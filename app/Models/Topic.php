<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'content' , 'category_id'
    ];


    public function category() {
        return $this->belongsTo(Category::class);
    }

    public function posts() {
        return $this->hasMany(Post::class)->with(['user' => function($query){
            $query->select( 'id' ,'username');
        }]);
    }

    public function comments() {
        return $this->hasManyThrough(Comment::class,Post::class );
    }


}
