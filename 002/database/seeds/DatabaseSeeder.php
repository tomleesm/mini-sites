<?php

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
        $faker = \Faker\Factory::create();
        $hash = bcrypt('12345678');

        $userId = DB::table('users')->insertGetId([
            'name' => $faker->name(),
            'email' => $faker->unique()->email(),
            'password' => $hash,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        for($i = 0; $i < 105; $i++) {
            DB::table('posts')->insert([
                'title' => $faker->sentence(),
                'content' => $faker->text(),
                'created_at' => now(),
                'updated_at' => now(),
                'user_id' => $userId
            ]);
        }
    }
}
