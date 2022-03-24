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
}
