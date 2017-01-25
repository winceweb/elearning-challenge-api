<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Category;
use App\Lesson;
use App\Problematic;
use App\Commentary;
use App\Rating;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        // $this->call('OAuthClientSeeder');

      DB::statement('SET FOREIGN_KEY_CHECKS = 0');

      User::truncate();
      Category::truncate();
      Lesson::truncate();
      Problematic::truncate();
      Commentary::truncate();
      Rating::truncate();
      // oauth_clients::truncate();

      for ($i=0; $i < 10; $i++){

          DB::table('oauth_clients')->insert(
              [   'id' => "id$i",
                  'secret' => "secret$i",
                  'name' => "Test Client $i"
              ]
          );
      }

      factory(User::class, 10)->create();
      factory(Category::class, 5)->create();
      factory(Lesson::class, 20)->create();
      factory(Problematic::class, 50)->create();
      factory(Commentary::class, 100)->create();
      factory(Rating::class, 300)->create();
      // factory(Mark::class, 150)->create();
      // Enable it back
      DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
