<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bookdetail extends Model
{
    /**
     * 書籍詳細と紐づく書籍レコードを取得
     */
    public function book()
    {
        return $this->belongsTo('\App\Models\Book');
    }
    // // リレーション定義されたカラムの呼び出し方
    // $book = \App\Models\Book::find(1);
    // echo $book->detail->isbn;  // 書籍から書籍詳細を経由してISBNを取得する
}
