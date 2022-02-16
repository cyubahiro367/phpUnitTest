<?php

use PHPUnit\Framework\TestCase;

use function PHPUnit\Framework\assertArrayHasKey;

class UserTest extends TestCase
{
    public function testThatWeCanGetTheFirstName()
    {
        $user = new App\Models\User;

        $user->setFirstName('Billy');

        $this->assertEquals($user->getFirstName(), 'Billy');
    }

    public function testThatWeCanGetTheLastName()
    {
        $user = new App\Models\User;

        $user->setLastName('Garett');

        $this->assertEquals($user->getLastName(), 'Garett');
    }

    public function testFullNameIsReturned()
    {
        $user = new App\Models\User;

        $user->setFirstName('      Billy');

        $user->setLastName('Garett            ');

        $this->assertEquals($user->getFullName(), 'Billy Garett');
    }

    public function testEmailAddressCanBeSet()
    {
        $user = new App\Models\User;

        $user->setEmail('Billy@gmail.com');

        $this->assertEquals($user->getEmail(), 'Billy@gmail.com');
    }

    public function testEmailVariablesContainCorrectValues()
    {
        $user = new App\Models\User;
        
        $user->setFirstName('Billy');

        $user->setLastName('Garett');

        $user->setEmail('Billy@gmail.com');

        $emailVariables = $user->getEmailVariables();

        $this->assertArrayHasKey('full_name', $emailVariables);

        $this->assertArrayHasKey('email', $emailVariables);

        $this->assertEquals($emailVariables['full_name'], 'Billy Garett');

        $this->assertEquals($emailVariables['email'], 'Billy@gmail.com');
    }
}