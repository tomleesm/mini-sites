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

        $userIdList = [];
        for($i = 0; $i < 30; $i++) {
            $userId = DB::table('users')->insertGetId([
                'name' => $faker->name(),
                'email' => $faker->unique()->email(),
                'password' => $hash,
                'created_at' => now(),
                'updated_at' => now()
            ]);
            array_push($userIdList, $userId);
        }

        for($i = 0; $i < 1000; $i++) {
            DB::table('posts')->insert([
                'title' => $faker->sentence(),
                'content' => $faker->text(),
                'created_at' => now(),
                'updated_at' => now(),
                'user_id' => $userIdList[$faker->numberBetween(0, 29)]
            ]);
        }
    }
}
