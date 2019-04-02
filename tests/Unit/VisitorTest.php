<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class VisitorTest extends TestCase
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

    // Acess Normally To The Main Page

    public function testMainPage()
    {
        $response = $this->get(route('home'))
        ->assertSuccessful()
        ->assertViewIs('main');
    }

    // Can't Access To the Admin Dashboard 

    public function testAdminDash()
    {
        $response = $this->assertGuest()
        ->get(route('main'))
        ->assertRedirect(route('login')); 
    }

}
