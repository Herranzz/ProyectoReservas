<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        $user = new User;

        $user->nombre = 'admin';
        $user->apellido = 'admin';
        $user->codigo = 'admin';
        $user->email = 'admin@educa.jcyl.es';
        $user->password = 'admin';
        $user->role = 'admin';
        $user->created_at = new \DateTime();

        $user->save();
    }


        
    
}
