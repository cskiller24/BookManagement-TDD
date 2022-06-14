<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\Image;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $book = Book::factory()->create();

        Image::factory()->bookTest($book)->create();
    }
}
