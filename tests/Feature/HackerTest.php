<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Faker\Factory as Faker;

require_once 'vendor/autoload.php';

class HackerTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testExample()
    {
        $response = $this->get('/');
        $response->assertStatus(200);
    }

    public function testRegisterWithoutTeam()
    {
        $faker = Faker::create();

        $data = [ 
            'first_name'  => $faker->name,
            'last_name' => $faker->name,
            'email' => $faker->email,
            'birthday' => $faker->date($format = 'Y/m/d'),
            'sex' => 'male',
            'phone' => $faker->e164PhoneNumber,
            'motivation' => $faker->text($maxNbChars = 200),
            'github'=> $faker->url,
            'linked_in'=> $faker->url,
            'skills' => $faker->text($maxNbChars = 150),
            'size' => 'XL',
        ] ;
        $response = $this->withHeaders([
            'X-CSRF-TOKEN' => csrf_token() ,
        ])->json('POST', route('store') , $data );

        $response
            ->assertStatus(201)
            ->assertJson([
                'created' => true,
            ]);
    }
}
