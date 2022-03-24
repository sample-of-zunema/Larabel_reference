<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;  //5. の論理削除の為に追加

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


    // 2. 結果をJSONで取得する
    // データ抽出の結果をJSON形式て取得する
    $author = \App\Models\Author::find(1);
    return $author->toJson();
    // toJsonメソッドの取得結果
    {"id":1,"name":"著者名1","kana":"チョシャメイ1","created_at":"2022-03-23 22:52:00","updated_at":"2022-03-23 22:52:00"}


    // 3. カラムの値に対して固定の編集を加える
    // Authorクラスにアクセサとミューテータを定義する
    public function getKanaAttribute(string $value): string
    {
        //KANAカラムの値を半角カナに変換
        return mb_convert_kana($value, "k");
    }
    public function setKanaAttribute(string $value): void
    {
        // KANAカラムの値を全角カナに変換
        $this->attributes['kana'] = mb_convert_kana($value, "KV");
    }

    // アクセサやミューテータが定義されたカラムの利用
    // データ取得時
    $authors = \App\Models\Author::all();
    foreach ($authors as $author) {
        echo $author->kana;  // 半角カナの値が返される
    }
    // データ登録時
    $author = new \App\Models\Author();
    $author->name = $request->input('name');
    $author->name = $request->input('kana'); // 登録時に全角カナに変換される
    $author->save();


    // 4. 「データがない場合のみ登録」をシンプルに実装する
    // データがない場合のみデータを登録する
    $author = \App\Models\Author::where('name', '著書A')->first();
    if (empty($author)) {
        $author = \App\Models\Author::create(['name' => '著者A']);
    }
    // firstOrCreateメソッドの利用
    $author = \App\Models\Author::firstOrCreate(['name' => '著者A']);
    // firstOrNewメソッドの利用
    $author = \App\Models\Author::firstOrNew(['name' => '著者A']);
    $author->save();


    // 5. 論理削除を利用する
    // SoftDeletesトレイトの定義
    use SoftDeletes;

    // 論理削除データも含めたデータ操作
    // 削除済みのレコードも含めて取得する
    $authors = \App\Models\Author::withTrashed()->get();

    // 削除済みレコードのみ取得する
    $deleted_authors = \App\Models\Author::onlyTrashed()->get();

}
