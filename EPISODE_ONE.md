# Creating a user fixture
###### Part 1, episode 1

Using the chosen IDE perform the following tasks:

1. Create a new directory in the *src* folder named *Fixture/Data*.
2. Create a new PHP class named *UserData* inside the *src/Fixture/Data* directory.

What this *UserData* class will do is represent an array of data that reflects the data as selected from the database.
Try to keep it simple in order to expedite the tutorial. However, the data can be in any format of preference such as:

- JSON
- XML
- CSV
- and more

For simplicity, use CSV.

Open the newly created *UserData* class in the chose IDE. The class should look something like the following.

```php
<?php

namespace App\Fixture\Data;

class UserData
{
}
```

The *UserData* class needs to be able to represent some user data structures that represent the user table in the
database. The tutorial already provides a *User* entity, which can be found in the *src/Entity* directory.

To complete this goal, add a new method to the *UserData* class called *getData*. Make the method return an empty array
for now. The *UserData* object should now look like the following.

```php
<?php

namespace App\Fixture\Data;

class UserData
{
    public function getData(): array
    {
        return [];
    }
}
```

Investigate the *User* entity class by navigating to the *src/Entity/User.php* file and opening it your IDE. You should
be able to observe that there are four fields in the database.

- id
- email
- roles
- password<sup>1</sup>

With this information the return data in the *UserData::getData* method can now be modified to return data that will
represent a *User* entity. Update the *UserData::getData* method so that it returns some example user data.

```php
public function getData(): array
{
    return [
      [1, 'user_one@example.org', [], 'user-one-!'],
      [2, 'user_two@example.org', [], 'user-two-@'],
      [3, 'user_three@example.org', [], 'user-three-#'],
      [4, 'user_four@example.org', [], 'user-four-$'],
    ];
}
```

There isn't enough information about the application yet that allows the definition of the user roles, so just use an
empty array for now. As for the password field, enter the plain password for the *UserData::getData* records. The data
here is intended for testing purposes only. The idea here is to use the plain text password later to generate real
hashes for the provided passwords.

There is now a fully functioning fixture for user data, albeit, it isn't implemented yet.

###### Part 2, episode 1

With the *UserData* class defined as it is, can you identify some functionality that can be refactored to make the class
more extensible and, or, more reusable?

Take a look at the following refactoring of the *UserData* class and try to determine why this might be better? Is it better?
What additional refactoring should be done to make fixtures, in general, more extensible?

```php
<?php

namespace App\Fixture\Data;

class UserData
{
    protected array $fixtureData = [
        // [id, email, roles, password]
        [1, 'user_one@example.org', [], 'user-one-!'],
        [2, 'user_two@example.org', [], 'user-two-@'],
        [3, 'user_three@example.org', [], 'user-three-#'],
        [4, 'user_four@example.org', [], 'user-four-$'],
    ];

    public function getData(): array
    {
        return $this->fixtureData;  
    }
}
```

Consider an abstract class that implements the *UserData::getClass* method. Would it be worth creating an
*AbstractFixtureData* that implements the *getData* method?

Review the following block of code and take some notes on what is happening.
What are the benefits? 
What are the consequences?

```php
<?php
namespace App\Fixtures\Data\AbstractFixtureData;

abstract class AbstractFixtureData
{
    protected array $fixtureData = [];

    public function getData(): array
    {
        return $this->fixtureData;
    }
}

```

Take a look at the definition for the class constant. This can be overridden through inheritance, which also provides 
a case for polymorphism in that the class inheriting the base class changes the behavior of the original.

With the use of the *AbstractFixtureData* class, the *UserData* class now can be refactored. It's now a very simple
class.

```php
<?php

namespace App\Fixtures\Data\UserData;

class UserData extends AbstractFixtureData
{
    protected array $fixtureData = [
        // [id, email, roles, password]
        [1, 'user_one@example.org', [], 'user-one-!'],
        [2, 'user_two@example.org', [], 'user-two-@'],
        [3, 'user_three@example.org', [], 'user-three-#'],
        [4, 'user_four@example.org', [], 'user-four-$'],
    ];
}
```

Remember, *UserData* inherits all the functionality that is present in the *AbstractFixtureData* class. When you 
instantiate *UserClass*, *UserClass* contains a *getData* method which returns the *fixtureData* variable as defined 
in the *UserData* class instead of from the *AbstractFixtureData* class.

This is basic inheritance and polymorphism.

###### Part 3, episode 1

A test can be written to confirm the validity of the inheritance and the polymorphism via the *AbstractFixtureData*
class and the *UserData* class.

In a terminal run the following commands

```console
composer req phpunit --dev
symfony console make:test
```

When prompted "Which test type would you like?:" enter *TestCase*.
When prompted "The name of the test class (e.g. BlogPostTest):" enter *UserDataTest*.

Navigate to *tests/UserDataTest.php* in your IDE project files list and open it for editing.

Rename the *testSomething* method to read *testUserFixtureData*. Change the content of the *testUserFixtureData* method 
to contain the following.

```php
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
```

The *UserDataTest* class should look like the following.

```php
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
```

Once the unit test class is completed, the test can be run with the following command.

```console
bin/phpunit
```

Once the test completes, you should see something like the following.

```console
PHPUnit 9.6.19 by Sebastian Bergmann and contributors.

Testing 
.                                                                   1 / 1 (100%)

Time: 00:00.006, Memory: 6.00 MB

OK (1 test, 4 assertions)
```

!Fin
---
<sup>1. The hashed value of the password.</sup>