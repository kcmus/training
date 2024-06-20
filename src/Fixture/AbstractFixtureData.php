<?php

namespace App\Fixture;

class AbstractFixtureData
{
  protected array $fixtureData = [];

  public function getData(): array
  {
    return $this->fixtureData;
  }
}
