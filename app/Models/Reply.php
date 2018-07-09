<?php

namespace App\Models;

class Reply extends Model
{
    protected $fillable = ['content'];

    // 一对一
    public function topic()
    {
        // 一条回复属于一个话题
        return $this->belongsTo(Topic::class);
    }
    public function user()
    {
        // 一个条回复属于一个作者所有
        return $this->belongsTo(User::class);
    }
}
