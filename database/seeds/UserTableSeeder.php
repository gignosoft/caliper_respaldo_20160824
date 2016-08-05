<?php

use Illuminate\Database\Seeder;
use \App\Models\User;
use \App\Models\Role;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /*
         * Técnica hecha debido a que no hay certeza que faker me genere un dato único,
         * por tanto si se cae la base de datos, se atrapa el error.
         */                      
        $users = factory(User::class, 10)->make();
        foreach ($users as $user)
        {
            repeat:
            try
            {
                $user->save();
            } catch (\Illuminate\Database\QueryException $e) {
                $user = factory(User::class)->make();
                goto repeat;
            }
        }
    

    }
}
