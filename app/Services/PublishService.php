<?php
// 5.5.2.2. ビジネスロジックを受け持つPublisherServiceクラス

namespace App\Services;

// 5.5.3.4. サービスクラスのリファクタリング　App\DataProvider\Eloquent\Publisher　→　App\DataProvider\PublisherRepositoryInterface　に変更
// use App\DataProvider\Eloquent\Publisher;
use App\DataProvider\PublisherRepositoryInterface;
use App\Domain\Entity\Publisher;


class PublisherService
{
  // // 5.5.3.4. リポジトリ使用のためコメントアウトする
  // public function exists(string $name): bool
  // {
  //   $count = Publisher::whereName($name)->count();
  //   if ($count > 0) {
  //     return true;
  //   }
  //   return false;
  // }

  // public function store(string $name, string $address): int
  // {
  //   $publisher = Publisher::create(
  //     [
  //       'name' => $name,
  //       'address' => $address,
  //     ]
  //   );
  //   return (int)$publisher->id;
  // }

  // 5.5.3.4. にて追加
  private $publisher;

  public function __construct(PublisherRepositoryInterface $publisher)
  {
    $this->publisher = $publisher;
  }

  public function exists(string $name): bool
  {
    if (!$this->publisher->findByName($name)) {
      return false;
    }
    return true;
  }

  public function store(string $name, string $address): int
  {
    return $this->publisher->store(new Publisher(null, $name, $address));
  }
}