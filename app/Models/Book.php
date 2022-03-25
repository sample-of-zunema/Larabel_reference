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

    // 5.4.2.1. DBファサードを利用したクエリビルダの取得
    // DBファサードからBooksテーブルのクエリビルダを取得
    $query = \Illuminate\Support\Facades\DB::table('books');

    // 5.4.2.2. Connectionクラスからクエリビルダを取得
    // 1. サービスコンテナからDatabaseManagerクラスのインスタンスを取得
    $db = \Illuminate\Foundation\Application::getInstance()->make('db');
    // 2. 上記インスタンスからConnectionクラスのインスタンスを取得
    $connection = $db->connection();
    // 3. 上記インスタンスからクエリビルダを取得
    $query = $connection->table('books');
}
