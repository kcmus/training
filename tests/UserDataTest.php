<?php

namespace App\Tests;

use App\Fixture\Data\UserData;
use PHPUnit\Framework\TestCase;

class UserDataTest extends TestCase
{
  public function testUserFixtureData(): void
  {
    $userData = new UserData();
    $userRecords = $userData->getData();
    $userOne = $userRecords[0];

    // UserData ID
    $this->assertEquals(1, $userOne[0]);
    // UserData Email
    $this->assertEquals('user_one@example.org', $userOne[1]);
    // UserData Roles (empty array)
    $this->assertEmpty($userOne[2]);
    // Plain text password
    $this->assertEquals('user-one-!', $userOne[3]);
  }
}
