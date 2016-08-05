<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();


        $this->call(CountryTableSeeder::class);


        $this->call(RoleTableSeeder::class);
        $this->call(UserTableSeeder::class);
        $this->call(UserRoleSeeder::class);

        $this->call(StateAssetTableSeeder::class);


        // | activities | -< | companies |
        $this->call(ActivityTableSeeder::class);
        $this->call(CompanyTableSeeder::class);


        // |suppliers| >-< |currencies|
        $this->call(CurrencyTableSeeder::class);
        $this->call(SupplierTableSeeder::class);
        $this->call(CurrencySupplierTableSeeder::class);


        //$this->call(UserRoleTableSeeder::class);
        // $this->call(CityTableSeeder::class);

        Model::reguard();
    }
}
