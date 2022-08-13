<?php

namespace Database\Seeders;

use App\Models\Genre;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GenreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $nonFiction = [
            "Art/architecture",
            "Autobiography",
            "Biography",
            "Business/economics",
            "Crafts/hobbies",
            "Cookbook",
            "Diary",
            "Dictionary",
            "Encyclopedia",
            "Guide",
            "Health/fitness",
            "History",
            "Home and garden",
            "Humor",
            "Journal",
            "Math",
            "Memoir",
            "Philosophy",
            "Prayer",
            "Religion, spirituality, and new age",
            "Textbook",
            "True crime",
            "Review",
            "Science",
            "Self help",
            "Sports and leisure",
            "Travel",
            "True crime"
        ];

        $fiction = [
            "Action and adventure",
            "Alternate history",
            "Anthology",
            "Chick lit",
            "Children's",
            "Classic",
            "Comic book",
            "Coming-of-age",
            "Crime",
            "Drama",
            "Fairytale",
            "Fantasy",
            "Graphic novel",
            "Historical fiction",
            "Horror",
            "Mystery",
            "Paranormal romance",
            "Picture book",
            "Poetry",
            "Political thriller",
            "Romance",
            "Satire",
            "Science fiction",
            "Short story",
            "Suspense",
            "Thriller",
            "Western",
            "Young adult"
        ];

        Genre::query()->insert($this->createArray($fiction, 'Fiction'));
        Genre::query()->insert($this->createArray($nonFiction, 'Non-Fiction'));
    }

    protected function createArray(array $genres, string $type): array
    {
        $toQuery = [];
        foreach($genres as $value) {
            $toQuery[] = Genre::factory()->make(['title' => $value, 'type' => $type])->toArray();
        }

        return $toQuery;
    }
}
