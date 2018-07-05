<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    // 数据模型
    protected $fillable = [
        'name', 'description',
    ];
}
