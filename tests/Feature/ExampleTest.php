<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{

    use RefreshDatabase;
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testBasicTest()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    /**
     * A basic test example.
     * @test
     * @return void
     */
    public function Auth_user()
    {
       $this->assertAuthenticatedAs(factory(User::class)->create());
            $response = $this->get('/user/index');
            $response->assertStatus(200);



        


    }







}
