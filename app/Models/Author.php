<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    use HasFactory;

    // // t_authorテーブルを関連づける
    // protected $table = 't_author';
    // // テーブルの主キーを　id　ではなく　author_id　とする
    // protected $primarykey = 'author_id';
    // // タイムスタンプを記録しない（デフォルトではtrue）
    // protected $timestamps = false;
    // // nameとkanaカラムを指定可能にする（編集可能なカラムを設定）
    // protected $fillable = [
    //     'name',
    //     'kana',
    // ];
    // // id、created_at、updated_atは任意での指定を不可とする（編集を認めないカラムを設定）
    // protected $guarded = [
    //     'id',
    //     'created_at',
    //     'updated_at',
    // ];


    // // レコードの全権取得
    $authors = \App\Models\Author::all();

    foreach ($authors as $author) {
        echo $author->name    //nameカラムの値を出力する
    }
    // レコード数の取得
    $count = $authors->count();
    // filterメソッドを使った絞り込み
    $filtered_authors = $authors->filter(
        function ($author) {
            // idが5より大きいレコードを抽出する
            return $author->id > 5;
        }
    );
    // 絞り込んだ結果をforeach文で取得する
    foreach ($filtered_authors as $author) {
        echo $author->name;
    }

    // authors テーブルの id=10 のレコードを取得
    $author = \App\Models\Author::find(10);

    // findOrFailメソッドの利用
    try{
        // authors テーブルの id=11 のレコードを取得
        $author = \App\Models\Author::findOrFail(11);
    } catch (\Illuminate\Database\Eloquent\ModeNotFoundException $e) {
        // 見つからなかった場合の処理
    }

    // whereXXXメソッドを利用した条件指定
    // authors テーブルで name='山田太郎' のレコードを取得する
    $authors = \App\Models\Author::whereName('山田太郎')->get();

    // 新しいレコードの登録 - create、save
    // createメソッド利用のパターン
    \App\Models\Author::create([
        'name' => '著者A',
        'kana' => 'チョシャA',
    ]);
    // saveメソッド利用のパターン
    $author = new \App\Models\Author();

    $author->name = '著者A';
    $author->kana = 'チョシャA';

    $author->save();

    // データ更新 - update
    $author = \App\Models\Author::find(1)->update(['name' => '著者B']);
    // saveメソッドによるデータ更新
    $author = \App\Models\Author::find(1);

    // authorテーブルのid=1のレコードを以下の通り変更
    $author->name = '著者B';
    $author->kana = 'チョシャB';

    $author->save();

    // データ削除 - delete、destroy
    // id=1のレコードを削除する
    $author = \App\Models\Author::find(1);
    $author->delete();

    // destroyメソッドによるデータ削除
    // id=1のレコードを削除する
    \App\Models\Author::destroy(1);

    // id=1,3,5のレコードを削除する
    \App\Models\Author::destroy([1,3,5]);
    // または、以下でも動作する
    \App\Models\Author::destroy(1, 3, 5);


    // 1. クエリビルダによるデータ抽出
    // $authorsテーブルでidが1または2のレコードを取得する
    $authors = \App\Models\Author::where('id', 1)->orWhere('id', 2)->get();

    // authorsテーブルでidが5以上のレコードをid順に取得する
    $authors = \App\Models\Author::where('id', '>=', 5)
                    ->orderBy('id')
                    ->get();


    

}
