<?php

namespace App\Fixture\Data;

use App\Fixture\AbstractFixtureData;

class UserData extends AbstractFixtureData
{
  protected array $fixtureData = [
    # [id, email, roles, password]
    [1, 'user_one@example.org', [], 'user-one-!'],
    [2, 'user_two@example.org', [], 'user-two-@'],
    [3, 'user_three@example.org', [], 'user-three-#'],
    [4, 'user_four@example.org', [], 'user-four-$'],
  ];
}
