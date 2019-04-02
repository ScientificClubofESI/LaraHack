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
        // Create New Admin 
        $user = factory(User::class)->create();
        // Login And redirect to the Dashboard
        $response = $this->actingAs($user)
        ->get(route('main'))
        ->assertStatus(302)
        ->assertRedirect(route('statistics'));
    }
}
