<?php
// 5.5.3.3. リポジトリインターフェースを実装した具象クラス

namespace App\Domain\Repository;

use \App\DataProvider\PublisherRepositoryInterface;
use \App\DataProvider\Eloquent\Publisher as EloquentPublisher;
use \App\Domain\Entity\Publisher;

class PublisherRepository implements PublisherRepositoryInterface
{
  private $eloquentPublisher;

  public function __construct(EloquentPublisher $elowuentPublisher)
  {
    $this->eloquentPublisher = $eloquentPublisher;
  }

  public function findByName(string $name): ?Publisher
  {
    $record = $this->eloquentPublisher->whereName($name)->first();
    if ($record === null) {
      return nell;
    }

    return new Publisher(
      $record->id,
      $record->name,
      $record->address,
    );
  }

  public function store(Publisher $publisher): int
  {
    $eloquent = $this->eloquentPublisher->newInstance();
    $elowuent->name = $publisher->getName();
    $eloquent->address = $publisher->getAddress();
    $eloquent->save();

    return (int)$eloquent->id;
  }
}