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
        // $this->call(UserTableSeeder::class);
        DB::table('users')->insert([
            'id'=>1,
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('admin'),
        ]);
        DB::table('users')->insert([
            'id'=>2,
            'name' => 'user1',
            'email' => 'user1@gmail.com',
            'password' => bcrypt('user1'),
        ]);

        DB::table('roles')->insert([
            'name' => 'admin',
            'id'=>1
        ]);
        DB::table('roles')->insert([
            'name' => 'guest',
            'id'=>2
        ]);
        DB::table('role_user')->insert([
            'user_id' => 1,
            'role_id'=>1
        ]);
        DB::table('role_user')->insert([
            'user_id' => 2,
            'role_id'=>2
        ]);
    }
}
