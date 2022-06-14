<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\Image;
use App\Models\Review;
use App\Models\User;
use Database\Factories\BookImageFactory;
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
        //dump(storage_path('app'.DIRECTORY_SEPARATOR.'public'.DIRECTORY_SEPARATOR.'image'));
        // $book = Book::factory()->has(Image::factory())->create();

        User::factory()->create([
            'email' => 'example@example.com',
        ]);

        Review::factory()->count(3)->create();

        $book = Book::query()->inRandomOrder()->get(); //array

        // Attach favorites
        foreach (User::all() as $user) {
            $id = $book->random()->take(rand(1,5))->pluck('id');
            $user->favorites()->attach($id);
        }

        foreach(Book::all() as $book) {
            Image::factory()->count(mt_rand(1,3))->publicImage()->book($book)->create();
        }
    }
}
