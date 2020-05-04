<?php

namespace Tests\Unit;

use App\User;
use PHPUnit\Framework\TestCase;

class UserModelTest extends TestCase
{
    /**
     * A basic unit test example.
     * @test
     * @return void
     */
    public function user_has_email()
    {

        $user = User::create(['name'=>'suhail', 'email'=>'abc@abc.com','password'=>'secret' ]);

      $this->assertEquals('abc@abc.com', $user->email);

    }
}

