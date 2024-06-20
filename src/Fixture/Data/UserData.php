<?php

namespace App\Fixture\Data;

class UserData
{
  public function getData(): array
  {
    return [
      [1, 'user_one@example.org', [], 'user-one-!'],
      [2, 'user_two@example.org', [], 'user-two-@'],
      [3, 'user_three@example.org', [], 'user-three-#'],
      [4, 'user_four@example.org', [], 'user-four-$'],
    ];
  }
}
