<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    // hasOneメソッドによるリレーション定義
    public function detail()
    {
        return $this->hasOne('\App\Models\Bookdetail');
    }

    // belongsToメソッドによるリレーション定義（Book.php）
    public function author()
    {
        return $this->belongsTo('\App\Models\Author');
    }
}
