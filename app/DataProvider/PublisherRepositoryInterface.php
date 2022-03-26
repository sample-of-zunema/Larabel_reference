<?php
// 5.5.3.1. リポジトリインターフェース

namespace App\DataProvider;

use App\Domain\Entity\publisher;

interface PublisherRepositoryInterface
{
  public function finByName(string $name): ?Publisher;

  public function store(Publisher $publisher): int;
}