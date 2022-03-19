<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [

    'post_id', 'user_id' , 'title', 'content'
    ];

    protected $with  = [
        'replies', 'user'
    ];


    protected $appends = ['votes'];

    public function getVotesAttribute() {
        return $this->getAttribute('upvotes')- $this->getAttribute('downvotes');
    }


    public function post() {
        return $this->belongsTo(Post::class);
    }

    public function replies() {
        return $this->hasMany(Reply::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }
}
