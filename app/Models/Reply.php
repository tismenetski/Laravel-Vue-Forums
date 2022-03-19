<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
    use HasFactory;

    protected $fillable = [

        'comment_id', 'user_id' , 'title', 'content'
    ];

    protected $with  = [
         'user'
    ];

    protected $appends = ['votes'];

    public function getVotesAttribute() {
        return $this->getAttribute('upvotes')- $this->getAttribute('downvotes');
    }



    public function comment() {
       return $this->belongsTo(Comment::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }
}
