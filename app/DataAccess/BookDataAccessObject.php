<?php
// データ操作専用のクラスを作ってクエリビルダを利用する例

namespace App\DataAccess;

use Illuminate\Database\DatabaseManager;

class BookDataAccessObject
{
  /** @var DatabaseManager */
  protected $db;
  /** @var string */
  protected $table = 'books';

  public function __construct(DatabaseManager $db)
  {
    $this->db = $db;
  }

  public function find($id)
  {
    $query = $this->db->connection()
        ->table($this->table);
  }

}