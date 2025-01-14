<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comments extends Model
{
    protected $guarded=[];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function blog()
    {
        return $this->belongsTo(Blog::class);
    }

    public function replies()
    {
        return $this->hasMany(CommentReply::class);
    }


}
