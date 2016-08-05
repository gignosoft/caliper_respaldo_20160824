<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/


$factory->define(App\Models\Country::class, function (Faker\Generator $faker) {
    return [
        'name'          => $faker->country,
        'user_control'  => 'seeder',
    ];
});

$factory->define(App\Models\City::class, function (Faker\Generator $faker) {
    return [
        'name'          => $faker->city,
        'user_control'  => 'seeder',
    ];
});

$factory->defineAs(App\Models\Role::class, 'admin', function (Faker\Generator $faker) {

    return [
        'name'          => 'admin',
        'user_control'  => 'seeder',
    ];
});

$factory->defineAs(App\Models\Role::class, 'visitor', function (Faker\Generator $faker) {

    return [
        'name'          => 'visitor',
        'user_control'  => 'seeder',
    ];
});


$factory->define(App\Models\User::class, function (Faker\Generator $faker) {

    $max_id_city = \App\models\City::max('id');

    $simulaRut_1    = strval( rand(11111111, 19999999) );
    $simulaRut_2    = strval( rand(0, 9) );
    $simulaRut      = $simulaRut_1."-".$simulaRut_2;

    return [
        'identifier'        => $simulaRut,
        'fist_name'         => $faker->firstName,
        'last_name'         => $faker->lastName,
        'city_id'           => rand(1, $max_id_city),
        'user_control'      => 'seeder',
        'email'             => $faker->safeEmail,
        'password'          => bcrypt('secret'),
        'remember_token'    => str_random(10),
    ];
});

// StateAssetTable

$factory->defineAs(\App\Models\StateAsset::class,'nuevo', function (Faker\Generator $faker){

    return [
        'name'          => 'nuevo',
        'user_control'  => 'seeder',
    ];

});

$factory->defineAs(\App\Models\StateAsset::class,'usado', function (Faker\Generator $faker){

    return [
        'name'          => 'usado',
        'user_control'  => 'seeder',
    ];

});



/*

| activities | -< | companies |

 */
// activities

$factory->define(\App\Models\Activity::class, function (Faker\Generator $faker){

    return [
        'name'          => $faker->word,
        'user_control'  => 'seeder',
    ];

});


//companies
$factory->define(App\Models\Company::class, function (Faker\Generator $faker) {

$max_activity_id = \App\models\Activity::max('id');

$simulaRut_1    = strval( rand(71111111, 79999999) );
$simulaRut_2    = strval( rand(0, 9) );
$simulaRut      = $simulaRut_1."-".$simulaRut_2;

return [
    'name'              => $faker->company,
    'identifier'        => $simulaRut,
    'activity_id'       => rand(1, $max_activity_id),

    'user_control'      => 'seeder',
];
});


// |suppliers| >-< |currencies|

$factory->define(\App\Models\Supplier::class, function (Faker\Generator $faker){

    $max_company_id = \App\models\Company::max('id');
    $max_id_city    = \App\models\City::max('id');

    return [
        'company_id'    => rand(1, $max_company_id),
        'city_id'       => rand(1, $max_id_city),
        'name'          => $faker->name,
        'description'   => $faker->paragraph,

        'user_control'  => 'seeder',
    ];

});

$factory->defineAs(\App\Models\Currency::class,'clp', function (Faker\Generator $faker){

    return [
        'name'          => 'CLP',
        'user_control'  => 'seeder',
    ];

});







