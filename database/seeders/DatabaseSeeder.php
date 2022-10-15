<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\Image;
use App\Models\Review;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
    //     // create admin
    //     DB::table('users')->insert([
    //         'name' => 'Admin',
    //         'email' => 'admin@bookmanagement.com',
    //         'password' => Hash::make('password'),
    //         'is_admin' => true,
    //         'email_verified_at' => now()
    //     ]);
    //     // add genres
    //     $this->call(GenreSeeder::class);
    //     // create users
    //     // Add books to usere
    //     $users = User::factory()
    //         ->count(20)
    //         ->has(
    //             Book::factory()
    //                 ->count(rand(1, 5))
    //                 ->has(
    //                     Review::factory()->count(rand(1,3))
    //                     )
    //                 ->has(Image::factory())
    //                 ->existingGenre()
    //         )->create();
    //     // Attach images to books

    //     // Add favorites
    //     $books = Book::inRandomOrder()->pluck('id');
    //     $books->each(function ($item, $key) use ($users) {
    //         DB::table('favorites')->insert([
    //             'user_id' => $users->random(1)->pluck('id')->toArray()[0],
    //             'book_id' => $item
    //         ]);
    //     });

        // $books = Book::all();
        // foreach ($books as $book) {
        //     $book->images()->save(Image::factory()->create());
        //     Review::factory()->for($book)->count(rand(1, 3))->create();

        // }

        User::factory()
            ->count(20)
            ->has(
                Book::factory()
                    ->count(rand(1, 5))
                    ->has(
                        Review::factory()->count(rand(1,3))
                        )
                    ->has(Image::factory())
                    ->existingGenre()
            )->create();

        $books = Book::inRandomOrder()->pluck('id');
        $users = User::all();
        $books->each(function ($item, $key) use ($users) {
                    DB::table('favorites')->insert([
                        'user_id' => $users->random(1)->pluck('id')->toArray()[0],
                        'book_id' => $item
                    ]);
                });
    }
}
