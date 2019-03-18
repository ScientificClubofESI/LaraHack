<?php

use Faker\Generator as Faker;

$factory->define(App\Hacker::class, function (Faker $faker) {
    return [
        "first_name"=>$faker->firstName,
        "last_name"=>$faker->lastName,
        "email"=>$faker->email,
        "birthday"=>$faker->date('Y-m-d','2000-01-01'),
        "sex"=>$faker->randomElement(['male','female']),
        "phone_number"=>$faker->phoneNumber,
        "motivation"=>$faker->realText(),
        "github"=>$faker->url,
        "linked_in"=>$faker->url,
        "skills"=>$faker->realText(),
        "size"=>$faker->randomElement(['S','M','L','XL']),
        "team_id"=>$faker->randomElement([3,4,5,6,7,8,9]), // The ideas of teams u have created , you can edit however you want
        "decision"=>'not_yet',
    ];
});
