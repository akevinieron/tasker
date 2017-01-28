<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call('UsersTableSeeder');

        DB::table('users')->insert([
            'firstname' => 'Admin',
            'lastname' => 'Tasker',
            'email' => 'admin@tasker.com',
            'password' => app('hash')->make('admin'),
        ]);
    }
}
