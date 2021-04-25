<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        /*   Db::insert("set FOREIGN_KEY_checks=0");
        DB::table('users')->truncate();
        DB::table('posts')->truncate();
        DB::table('roles')->truncate();
        \App\Models\User::factory(10)
            ->has(\App\Models\Post::factory()->count(1))
            ->create();*/
        Db::insert("set FOREIGN_KEY_checks=0");
        DB::table('users')->truncate();
        DB::table('posts')->truncate();
        DB::table('roles')->truncate();
        DB::table('photos')->truncate();
        DB::table('comments')->truncate();
        DB::table('categories')->truncate();
        DB::insert('insert into roles ( name) values (?)', ['administrator']);
        DB::insert('insert into roles ( name) values (?)', ['subscriper']);
        DB::insert('insert into categories ( name) values (?)', ['php']);
        DB::insert('insert into categories ( name) values (?)', ['java']);
    }
}
