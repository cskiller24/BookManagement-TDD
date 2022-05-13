<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\Review;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        Review::factory()->count(50)->create();

        $book = Book::query()->inRandomOrder()->get(); //array
        foreach (User::all() as $user) {
            $id = $book->random()->take(rand(1,5))->pluck('id');
            $user->favorites()->attach($id);
        }
    }
}
