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

// |suppliers| >-< |pay_metods|
$factory->defineAs(\App\Models\PayMetod::class,'Contado', function (Faker\Generator $faker){

    return [
        'name'          => 'Contado',
        'user_control'  => 'seeder',
    ];

});
$factory->defineAs(\App\Models\PayMetod::class,'30', function (Faker\Generator $faker){

    return [
        'name'          => '30 días',
        'user_control'  => 'seeder',
    ];

});

// | levels | -< | positions |
$factory->defineAs(\App\Models\Level::class,'1', function (Faker\Generator $faker){

    return [
        'name'          => '1',
        'user_control'  => 'seeder',
    ];

});
$factory->defineAs(\App\Models\Level::class,'2', function (Faker\Generator $faker){

    return [
        'name'          => '2',
        'user_control'  => 'seeder',
    ];

});
$factory->defineAs(\App\Models\Level::class,'3', function (Faker\Generator $faker){

    return [
        'name'          => '3',
        'user_control'  => 'seeder',
    ];

});

$factory->define(\App\Models\Position::class, function (Faker\Generator $faker){

    $max_level_id = \App\models\Level::max('id');

    return [
        'name'          => $faker->jobTitle,
        'level_id'      => rand(1, $max_level_id),

        'user_control'  => 'seeder',
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

// AssetTableSeeder
$factory->define(\App\Models\Asset::class, function (Faker\Generator $faker){

    $max_supplier_id     = \App\models\Supplier::max('id');
    $max_state_asset_id = \App\models\StateAsset::max('id');

    return [
        'name'              => $faker->domainName,
        'description'       => $faker->paragraph,
        'code'              => $faker->postcode,
        'supplier_id'       => rand(1, $max_supplier_id),
        'state_asset_id'    => rand(1, $max_state_asset_id),
        'available'         => 1,

        'user_control'  => 'seeder',
    ];

});


// |state_assignments| >-< |assignments|

$factory->define(\App\Models\Assignment::class, function (Faker\Generator $faker){ // no deben ser mas assignaciones que assets

    $max_user_id = \App\models\User::max('id');
    $max_asset_id = \App\models\Asset::max('id');
    
    $arr_state_assignments = [
        '0' => 'En prestamo',
        '1' => 'Entregado',
        '2' => 'En mantención',
        '3' => 'Perdido',
    ];


    $index = rand(0,3);

    // se verifica que esté disponible antes de un prestamo.
    $asset_id = 0;
    $assets      = \App\Models\Asset::where('available', '=', '1')->take(1) ->get();

    foreach($assets as $asset)
    {
        if(!is_null($asset->id))
        {
            $asset_id   = $asset->id;
        }else{
            dd('no deben ser mas assignaciones que assets');
        }
    }

    // si el estado no es entregado, se indica que el asset no està disponible.
    $asset2= \App\Models\Asset::find($asset_id);
    if($index != 1)
     {
         $asset2->available = 0;
     }else{
         $asset2->available = 1;
     }
    $asset2->save();


    return [
        'user_id'   => rand(1, $max_user_id),
        'asset_id'  => $asset_id,
        'name'      => $arr_state_assignments[$index],

        'user_control'  => 'seeder',
    ];



});

