<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\User ; 
class AdminTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->assertTrue(true);
    }   

    public function testAdminLogin()
    {
        $user = factory(User::class)->create();
        $response = $this->actingAs($user)
        ->get(route('main'))
        ->assertStatus(302)
        ->assertRedirect(route('statistics'));
    }
}
