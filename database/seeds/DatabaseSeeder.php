<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\Accounts;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {  
        Accounts::insert(array(
            'username' => 'administrator',
            'password' => bcrypt('administrator'),
            'role' => 'administrator',
        ));
    }
}
