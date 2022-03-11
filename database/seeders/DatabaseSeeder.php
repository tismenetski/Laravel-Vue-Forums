<?php

namespace Database\Seeders;


use App\Models\Comment;
use App\Models\Post;
use App\Models\Reply;
use App\Models\Tag;
use App\Models\Topic;
use App\Models\User;
use Illuminate\Database\Seeder;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

//        $factory->define(App\User::class, function (Faker\Generator $faker) {
//            return [
//                'name' => $faker->name,
//                'email' => $faker->email,
//                'password' => bcrypt(str_random(10)),
//                'remember_token' => str_random(10),
//            ];
//        });

        $this->call(CategorySeeder::class);
        User::factory()->count(500)->create();
        Topic::factory()->count(20)->create();
        Post::factory()->count(200)->create();
        Tag::factory()->count(20)->create();
        Comment::factory()->count(400)->create();
        Reply::factory()->count(600)->create();


//        DB::table('users')->insert([
//            'name' => Str::random(10),
//            'email' => Str::random(10).'@gmail.com',
//            'password' => Hash::make('password'),
//        ]);

    }
}
